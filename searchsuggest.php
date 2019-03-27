<?php
@ini_set("display_errors","1");
@ini_set("display_startup_errors","1");

require_once("include/dbcommon.php");
require_once getabspath('classes/searchclause.php');
add_nocache_headers();

$table = postvalue("table");
$strTableName = GetTableByShort( $table );

if( !checkTableName( $table ) )
	exit(0);

require_once("include/".$table."_variables.php");

if( !isLogged() )
	return;
if( !CheckSecurity(@$_SESSION["_".$strTableName."_OwnerID"], "Search") )
	return;


$searchFor = trim( postvalue('searchFor') );
// if nothing to search 
if($searchFor == '')
{
	echo printJSON( array('success' => true, 'result' => '') ); 
	return;
}

require_once getabspath('classes/controls/EditControlsContainer.php');

$searchOpt = postvalue("start") ? "Starts with" : "Contains";
$searchField = GoodFieldName( postvalue('searchField') );
$numberOfSuggests = GetGlobalData("searchSuggestsNumber", 10);
$whereClauses = array();

$pageType = postvalue('pageType');
if ( !$pageType )  
	$pageType = PAGE_LIST;

$forDashboardSimpleSearch = !$searchField && $pageType == PAGE_DASHBOARD ;
if( $forDashboardSimpleSearch ) 
{
	$dashSettings = new ProjectSettings( $strTableName, PAGE_DASHBOARD );
	$dashGoogleLikeFields = $dashSettings->getGoogleLikeFields();
	$dashSearchFields = $dashSettings->getDashboardSearchFields();

	$sfdata = array();
	// group fields by table
	foreach( $dashGoogleLikeFields as $g ) 
	{
		foreach( $dashSearchFields[ $g ] as $j => $data )
		{
			$sfdata[ $data['table'] ][] = $data['field'];
		}		
	}
	
	foreach( $sfdata as $table => $fields )
	{
		if ( $numberOfSuggests <= count( $result ) ) 
			break;
	
		if ( !count( $result ) ) 
			$result = array();
	
		$_result = getListOfSuggests( $fields, $table, $whereClauses, $numberOfSuggests - count( $result ) , $searchOpt, $searchFor );
		
		// add only distinct values
		foreach( $_result as $_data ) 
		{
			$found = false;
			foreach( $result as $data ) 
			{
				if( $data['realValue'] == $_data['realValue'] )
				{
					$found = true;
					break;
				}
			}
		
			if( !$found )
				$result[] = $_data;
		}
	}
	
	echo printJSON( array( 'success' => true, 'result' => $result ) );
	exit();
}


if( $pageType == PAGE_DASHBOARD )
{
	$dashSettings = new ProjectSettings( $strTableName, PAGE_DASHBOARD );
	$dashSearchFields = $dashSettings->getDashboardSearchFields();	

	$sfData = $dashSearchFields[ $searchField ][0];
	$searchField = GoodFieldName( $sfData['field'] );
	$table = GoodFieldName($sfData['table'] );
	
	if( !checkTableName( $table ) )
		exit(0);
	
	$strTableName = GetTableByShort( $table );
	
	require_once("include/".$table."_variables.php");
	
	foreach( $dashSettings->getDashboardElements() as $elem ) 
	{
		if( $elem['table'] == $strTableName ) 
		{
			$pageType = PAGE_LIST;
			
			if ( $elem['type'] == DASHBOARD_CHART ) 
				$pageType = PAGE_CHART;
			else if( $elem['type'] == DASHBOARD_REPORT )
				$pageType = PAGE_REPORT;
			
			break;
		}
	}
}


$pSetList = new ProjectSettings( $strTableName, $pageType );
if( $searchField == "" )
	$allSearchFields = $pSetList->getGoogleLikeFields();
else	
	// array of fields which were added in wizard for search
	$allSearchFields = $pSetList->getAllSearchFields();


$pSet = new ProjectSettings( $strTableName, PAGE_SEARCH );
$cipherer = new RunnerCipherer( $strTableName );
$_connection = $cman->byTable( $strTableName );


$detailKeys = array();
if( @$_SESSION[$strTableName."_mastertable"] != "" )
{
	$masterWhere = "";	
	$masterTablesInfoArr = $pSet->getMasterTablesArr($strTableName);
	for($i = 0; $i < count($masterTablesInfoArr); $i++) 
	{
		if( $_SESSION[$strTableName."_mastertable"] != $masterTablesInfoArr[$i]['mDataSourceTable'] )
			continue;
		
		$detailKeys = $masterTablesInfoArr[$i]['detailKeys'];
		for($j = 0; $j < count($detailKeys); $j++)
		{
			$mastervalue = $cipherer->MakeDBValue($detailKeys[$j], @$_SESSION[$strTableName."_masterkey".($j + 1)], "", true);
			if($mastervalue == "null")
				$masterWhere .= RunnerPage::_getFieldSQL($detailKeys[$j], $_connection, $pSet)." is NULL ";
			else
				$masterWhere .= RunnerPage::_getFieldSQLDecrypt($detailKeys[$j], $_connection, $pSet, $cipherer)."=".$mastervalue;
		}
		break;		
	}
	$whereClauses[] = $masterWhere;
}

$searchClauseObj = SearchClause::getSearchObject( $strTableName, "", $strTableName, $cipherer );
$searchClauseObj->processFiltersWhere( $_connection );
foreach( $searchClauseObj->filteredFields as $filteredField ) 
{
	$whereClauses[] = $filteredField["where"];
}

$result = getListOfSuggests( $allSearchFields, $strTableName, $whereClauses, $numberOfSuggests, $searchOpt, $searchFor, $searchField, $detailKeys );

$returnJSON = array();
$returnJSON['success'] = true;
$returnJSON['result'] = $result;
echo printJSON($returnJSON);
exit();
?>