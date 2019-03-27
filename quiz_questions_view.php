<?php 
@ini_set("display_errors","1");
@ini_set("display_startup_errors","1");

require_once("include/dbcommon.php");
require_once("include/quiz_questions_variables.php");
require_once('include/xtempl.php');
require_once('classes/viewpage.php');
require_once("classes/searchclause.php");

add_nocache_headers();

if( !ViewPage::processEditPageSecurity( $strTableName ) )
	return;	





$layout = new TLayout("view_bootstrap_2col", "PurificGreen", "MobileGreen");
$layout->version = 3;
	$layout->bootstrapTheme = "cerulean";
		$layout->customCssPageName = "quiz_questions_view";
$layout->blocks["top"] = array();
$layout->containers["viewpage"] = array();
$layout->container_properties["viewpage"] = array(  );
$layout->containers["viewpage"][] = array("name"=>"wrapper",
	"block"=>"", "substyle"=>1 , "container"=>"header" );
$layout->containers["header"] = array();
$layout->container_properties["header"] = array(  );
$layout->containers["header"][] = array("name"=>"viewheader",
	"block"=>"viewheader", "substyle"=>1  );

$layout->skins["header"] = "";


$layout->skins["viewpage"] = "";

$layout->blocks["top"][] = "viewpage";
$layout->containers["fields"] = array();
$layout->container_properties["fields"] = array(  );
$layout->containers["fields"][] = array("name"=>"viewfields",
	"block"=>"", "substyle"=>1  );

$layout->skins["fields"] = "";

$layout->blocks["top"][] = "fields";
$layout->containers["bottombuttons"] = array();
$layout->container_properties["bottombuttons"] = array(  );
$layout->containers["bottombuttons"][] = array("name"=>"wrapper",
	"block"=>"", "substyle"=>1 , "container"=>"buttons" );
$layout->containers["buttons"] = array();
$layout->container_properties["buttons"] = array(  );
$layout->containers["buttons"][] = array("name"=>"wrapper",
	"block"=>"", "substyle"=>1 , "container"=>"leftbuttons" );
$layout->containers["leftbuttons"] = array();
$layout->container_properties["leftbuttons"] = array(  );
$layout->containers["leftbuttons"][] = array("name"=>"viewbuttons",
	"block"=>"viewbuttons", "substyle"=>1  );

$layout->skins["leftbuttons"] = "";


$layout->containers["buttons"][] = array("name"=>"wrapper",
	"block"=>"", "substyle"=>1 , "container"=>"leftbuttons_1" );
$layout->containers["leftbuttons_1"] = array();
$layout->container_properties["leftbuttons_1"] = array(  );
$layout->containers["leftbuttons_1"][] = array("name"=>"rightviewbuttons",
	"block"=>"rightviewbuttons", "substyle"=>1  );

$layout->skins["leftbuttons_1"] = "";


$layout->skins["buttons"] = "";


$layout->skins["bottombuttons"] = "";

$layout->blocks["top"][] = "bottombuttons";
$page_layouts["quiz_questions_view"] = $layout;




	
			


$layout = new TLayout("list_bootstrap1", "PurificGreen", "MobileGreen");
$layout->version = 3;
	$layout->bootstrapTheme = "cerulean";
		$layout->customCssPageName = "quiz_answers_list";
$layout->blocks["center"] = array();
$layout->containers["gridcontrols"] = array();
$layout->container_properties["gridcontrols"] = array(  );
$layout->containers["gridcontrols"][] = array("name"=>"wrapper",
	"block"=>"", "substyle"=>1 , "container"=>"add_delete" );
$layout->containers["add_delete"] = array();
$layout->container_properties["add_delete"] = array(  );
$layout->containers["add_delete"][] = array("name"=>"add",
	"block"=>"newrecord_controls_block", "substyle"=>1  );

$layout->containers["add_delete"][] = array("name"=>"recordcontrol",
	"block"=>"record_controls_block", "substyle"=>1  );

$layout->skins["add_delete"] = "";


$layout->containers["gridcontrols"][] = array("name"=>"wrapper",
	"block"=>"", "substyle"=>1 , "container"=>"gridinfo" );
$layout->containers["gridinfo"] = array();
$layout->container_properties["gridinfo"] = array(  );
$layout->containers["gridinfo"][] = array("name"=>"details_found",
	"block"=>"details_found", "substyle"=>1  );

$layout->containers["gridinfo"][] = array("name"=>"printpanel",
	"block"=>"print_friendly", "substyle"=>1  );

$layout->containers["gridinfo"][] = array("name"=>"bsfieldhidepanel",
	"block"=>"field_hide_panel", "substyle"=>1  );

$layout->skins["gridinfo"] = "";


$layout->containers["gridcontrols"][] = array("name"=>"wrapper",
	"block"=>"", "substyle"=>1 , "container"=>"gridinfo_sort" );
$layout->containers["gridinfo_sort"] = array();
$layout->container_properties["gridinfo_sort"] = array(  );
$layout->containers["gridinfo_sort"][] = array("name"=>"reorder_records",
	"block"=>"reorder_records", "substyle"=>1  );

$layout->skins["gridinfo_sort"] = "";


$layout->skins["gridcontrols"] = "";

$layout->blocks["center"][] = "gridcontrols";
$layout->containers["tabs"] = array();
$layout->container_properties["tabs"] = array(  );
$layout->containers["tabs"][] = array("name"=>"bsgrid_tabs",
	"block"=>"grid_tabs", "substyle"=>1  );

$layout->skins["tabs"] = "";

$layout->blocks["center"][] = "tabs";
$layout->containers["messagerow"] = array();
$layout->container_properties["messagerow"] = array(  );
$layout->containers["messagerow"][] = array("name"=>"wrapper",
	"block"=>"", "substyle"=>1 , "container"=>"message" );
$layout->containers["message"] = array();
$layout->container_properties["message"] = array(  );
$layout->containers["message"][] = array("name"=>"message",
	"block"=>"message_block", "substyle"=>1  );

$layout->skins["message"] = "";


$layout->skins["messagerow"] = "";

$layout->blocks["center"][] = "messagerow";
$layout->containers["center"] = array();
$layout->container_properties["center"] = array(  );
$layout->containers["center"][] = array("name"=>"wrapper",
	"block"=>"", "substyle"=>1 , "container"=>"grid" );
$layout->containers["grid"] = array();
$layout->container_properties["grid"] = array(  );
$layout->containers["grid"][] = array("name"=>"grid",
	"block"=>"grid_block", "substyle"=>1  );

$layout->skins["grid"] = "";


$layout->skins["center"] = "";

$layout->blocks["center"][] = "center";
$layout->containers["pagination"] = array();
$layout->container_properties["pagination"] = array(  );
$layout->containers["pagination"][] = array("name"=>"pagination",
	"block"=>"pagination_block", "substyle"=>1  );

$layout->skins["pagination"] = "";

$layout->blocks["center"][] = "pagination";
$layout->blocks["left"] = array();
$layout->containers["left"] = array();
$layout->container_properties["left"] = array(  );
$layout->containers["left"][] = array("name"=>"searchpanel",
	"block"=>"searchPanel", "substyle"=>1  );

$layout->containers["left"][] = array("name"=>"filterpanel",
	"block"=>"filterPanel", "substyle"=>1  );

$layout->skins["left"] = "";

$layout->blocks["left"][] = "left";
$layout->blocks["top"] = array();
$layout->containers["menu"] = array();
$layout->container_properties["menu"] = array(  );
$layout->containers["menu"][] = array("name"=>"wrapper",
	"block"=>"", "substyle"=>1 , "container"=>"hdr" );
$layout->containers["hdr"] = array();
$layout->container_properties["hdr"] = array(  );
$layout->containers["hdr"][] = array("name"=>"logo",
	"block"=>"logo_block", "substyle"=>1  );

$layout->containers["hdr"][] = array("name"=>"bsnavbarcollapse",
	"block"=>"collapse_block", "substyle"=>1  );

$layout->skins["hdr"] = "";


$layout->containers["menu"][] = array("name"=>"wrapper",
	"block"=>"", "substyle"=>1 , "container"=>"menu_1" );
$layout->containers["menu_1"] = array();
$layout->container_properties["menu_1"] = array(  );
$layout->containers["menu_1"][] = array("name"=>"hmenu",
	"block"=>"menu_block", "substyle"=>1  );

$layout->containers["menu_1"][] = array("name"=>"wrapper",
	"block"=>"", "substyle"=>1 , "container"=>"more" );
$layout->containers["more"] = array();
$layout->container_properties["more"] = array(  );
$layout->containers["more"][] = array("name"=>"morebutton",
	"block"=>"more_list", "substyle"=>1  );

$layout->containers["more"][] = array("name"=>"loggedas",
	"block"=>"security_block", "substyle"=>1  );

$layout->skins["more"] = "";


$layout->containers["menu_1"][] = array("name"=>"wrapper",
	"block"=>"", "substyle"=>1 , "container"=>"more_1" );
$layout->containers["more_1"] = array();
$layout->container_properties["more_1"] = array(  );
$layout->containers["more_1"][] = array("name"=>"search",
	"block"=>"searchform_block", "substyle"=>1  );

$layout->skins["more_1"] = "";


$layout->skins["menu_1"] = "";


$layout->skins["menu"] = "";

$layout->blocks["top"][] = "menu";
$layout->blocks["topmiddle"] = array();
$layout->containers["breadcrumbs"] = array();
$layout->container_properties["breadcrumbs"] = array(  );
$layout->containers["breadcrumbs"][] = array("name"=>"wrapper",
	"block"=>"", "substyle"=>1 , "container"=>"bc" );
$layout->containers["bc"] = array();
$layout->container_properties["bc"] = array(  );
$layout->containers["bc"][] = array("name"=>"breadcrumbs",
	"block"=>"breadcrumbs", "substyle"=>1  );

$layout->skins["bc"] = "";


$layout->skins["breadcrumbs"] = "";

$layout->blocks["topmiddle"][] = "breadcrumbs";
$layout->containers["masterinfo"] = array();
$layout->container_properties["masterinfo"] = array(  );
$layout->containers["masterinfo"][] = array("name"=>"masterinfo",
	"block"=>"mastertable_block", "substyle"=>1  );

$layout->skins["masterinfo"] = "";

$layout->blocks["topmiddle"][] = "masterinfo";
$page_layouts["quiz_answers_list"] = $layout;




$pageMode = ViewPage::readViewModeFromRequest();

$xt = new Xtempl();

// $keys could not be set properly if editid params were no passed
$keys = array();
$keys["id"] = postvalue("editid1");

//array of params for classes
$params = array();
$params["id"] = postvalue("id");
$params["xt"] = &$xt;
$params["keys"] = $keys;
$params["mode"] = $pageMode;
$params["pageType"] = PAGE_VIEW;
$params["pageName"] = postvalue("page");
$params["tName"] = $strTableName;

$params["pdfMode"] = postvalue("pdf") !== "";

$params["masterTable"] = postvalue("mastertable");

if( $pageMode == VIEW_DASHBOARD ) 
{
	$params["dashElementName"] = postvalue("dashelement");
	$params["dashTName"] = postvalue("table");
	if(	postvalue("mapRefresh") )
	{
		$params["mapRefresh"] = true;
		$params["vpCoordinates"] = my_json_decode( postvalue("vpCoordinates") );
	}		
} 
if( $pageMode == VIEW_POPUP )
{
	$params["dashElementName"] = postvalue("dashelement");
	$params["dashTName"] = postvalue("dashTName");
}

if( $params["masterTable"] )
{
	$params["masterKeysReq"] = ViewPage::processMasterKeys();
}

$pageObject = new ViewPage($params);
$pageObject->init();

$pageObject->process();

?>