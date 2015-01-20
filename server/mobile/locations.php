
<?php
header("Content-type: application/json;charset=utf-8");
if( isset($_POST['lang']))
{	
	require_once $_SERVER["DOCUMENT_ROOT"] . "/irestaurant/server/lib/config.php";
	$result = MQuery::getLocations($_POST['lang']);
}
else
{
 $result = Error_message::response_number(2001);
}
echo json_encode($result);
