<?php

header("Content-type: application/json;charset=utf-8");
require_once $_SERVER["DOCUMENT_ROOT"] . "/mcar/server/lib/config.php";
require_once ROOT . '/server/functions/Query_data_func.php';

if (isset($_POST['id'])) {
    $id = (int) $_POST['id'];
    $result = Query::getSeller($id);
} else
    $result = Error_message::response_number($number);

echo json_encode($result);

