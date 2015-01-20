<?php
header("Content-type: application/json;charset=utf-8");
require_once $_SERVER["DOCUMENT_ROOT"] . "/mcar/server/lib/config.php";
require_once ROOT . '/server/functions/Query_data_func.php';


    $result = Query::getCar();

   
   echo json_encode($result);

