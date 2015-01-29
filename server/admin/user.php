<?php 
header("Content-type: application/json;charset=utf-8");
$user=json_decode(file_get_contents('php://input'));
$username=$user->username;
$password=$user->password;
require_once $_SERVER["DOCUMENT_ROOT"] . "/irestaurant/server/lib/config.php";
if(isset($username) && isset($password))
{
	$result=AQuery::Login($username,md5($password));
} 
else
{
	$result = Error_message::response_number(2001);
}
echo json_encode($result);
