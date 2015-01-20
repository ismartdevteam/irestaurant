<?php

header("Content-type: application/json;charset=utf-8");
require_once $_SERVER["DOCUMENT_ROOT"] . "/irestaurant/server/lib/config.php";

	
if(isset($_GET['lang']))
    $result = MQuery::getCategories($_GET['lang']);
else
	$result = Error_message::response_number(2001);
echo json_encode($result);

