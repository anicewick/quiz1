<?php
@ini_set("display_errors","1");
@ini_set("display_startup_errors","1");


require_once("include/dbcommon.php");
require_once('classes/menupage.php');


Security::processLogoutRequest();
if(!isLogged())
{
	HeaderRedirect("login");
	return;
}


if (($_SESSION["MyURL"] == "") || (!isLoggedAsGuest())) {
	Security::saveRedirectURL();
}




$layout = new TLayout("menu_bootstrap1", "PurificGreen", "MobileGreen");
$layout->version = 3;
	$layout->bootstrapTheme = "cerulean";
		$layout->customCssPageName = "_menu";
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
	"block"=>"", "substyle"=>1 , "container"=>"login" );
$layout->containers["login"] = array();
$layout->container_properties["login"] = array(  );
$layout->containers["login"][] = array("name"=>"morebutton",
	"block"=>"more_list", "substyle"=>1  );

$layout->containers["login"][] = array("name"=>"loggedas",
	"block"=>"security_block", "substyle"=>1  );

$layout->skins["login"] = "";


$layout->skins["menu_1"] = "";


$layout->skins["menu"] = "";

$layout->blocks["top"][] = "menu";
$layout->containers["center"] = array();
$layout->container_properties["center"] = array(  );
$layout->containers["center"][] = array("name"=>"welcome",
	"block"=>"", "substyle"=>1  );

$layout->skins["center"] = "";

$layout->blocks["top"][] = "center";
$page_layouts["menu"] = $layout;




require_once('include/xtempl.php');
require_once(getabspath("classes/cipherer.php"));

include_once(getabspath("include/quiz_tests_events.php"));
$tableEvents["quiz_tests"] = new eventclass_quiz_tests;
include_once(getabspath("include/quiz_questions_events.php"));
$tableEvents["quiz_questions"] = new eventclass_quiz_questions;
include_once(getabspath("include/quiz_answers_events.php"));
$tableEvents["quiz_answers"] = new eventclass_quiz_answers;
include_once(getabspath("include/quiz_responses_events.php"));
$tableEvents["quiz_responses"] = new eventclass_quiz_responses;
include_once(getabspath("include/quiz_response_details_events.php"));
$tableEvents["quiz_response_details"] = new eventclass_quiz_response_details;
include_once(getabspath("include/quiz_messages_events.php"));
$tableEvents["quiz_messages"] = new eventclass_quiz_messages;
include_once(getabspath("include/quiz_category_events.php"));
$tableEvents["quiz_category"] = new eventclass_quiz_category;

$xt = new Xtempl();

//array of params for classes
$params = array();
$params["id"] = postvalue("id"); 
$params["xt"] = &$xt;
$params["tName"] = GLOBAL_PAGES;
$params["pageType"] = PAGE_MENU;
$params["isGroupSecurity"] = $isGroupSecurity;
$params["needSearchClauseObj"] = false;
$params["pageName"] = postvalue("page"); 

$pageObject = new MenuPage($params);
$pageObject->init();

$pageObject->process();
?>