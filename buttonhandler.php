<?php
@ini_set("display_errors","1");
@ini_set("display_startup_errors","1");

require_once("include/dbcommon.php");
require_once("classes/button.php");

$params = (array)my_json_decode(postvalue('params'));
$buttId = $params['buttId'];
$eventId = postvalue('event');
$table = $params['table'];
$page = $params['page'];

// todo security check






// create table and non table handlers


		
?>
