<?php
header("Content-type: application/json;charset=utf-8");


if(isset($_POST['d']) && isset($_POST['lang']))
{
require_once $_SERVER["DOCUMENT_ROOT"] . "/irestaurant/server/lib/config.php";
$inputdate = $_POST['d'];
$inputhour = $_POST['h'];

if($inputhour == '0')
{
	$inputhour = date('H:i:', strtotime('00:00:00'));
}
if($inputdate != 0)
{
	$inputdate = $inputdate." ".$inputhour;
	$inputdate = date('Y-m-d H:i:s', strtotime($inputdate));
	$wheredate = "WHERE modified_date >'".$inputdate."'";
}
else
{
	$wheredate = "";
}
	$result = MQuery::getProduct($wheredate,$_POST['lang']);
}
else
{
 $result = Error_message::response_number(2001);
}
echo json_encode($result);
