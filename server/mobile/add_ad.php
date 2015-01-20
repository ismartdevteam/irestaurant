<?php

header("Content-type: application/json;charset=utf-8");
require_once $_SERVER["DOCUMENT_ROOT"] . "/mcar/server/lib/config.php";
require_once ROOT . '/server/functions/Query_data_func.php';

if (isset($_POST['title']) && isset($_POST['price']) && isset($_POST['desc']) && isset($_POST['phone']) && isset($_POST['cat_id']) && isset($_POST['imei'])) {
    $title = $_POST['title'];
    $price = (double) $_POST['price'];
    $desc = $_POST['desc'];
    $phone = $_POST['phone'];
    $category_id = (int) $_POST['cat_id'];
    $imei = $_POST['imei'];
    $image1 = null;
    $image2 = null;
    $image3 = null;
    if (isset($_POST['image1']))
        $image1 = $_POST['image1'];
    if (isset($_POST['image2']))
        $image2 = $_POST['image2'];

    if (isset($_POST['image3']))
        $image3 = $_POST['image3'];
    $result = Query::addAd($title, $price, $desc, $phone, $category_id, $imei, $image1, $image2, $image3);
} else
    $result = Error_message::response_number(2003);




echo json_encode($result);


