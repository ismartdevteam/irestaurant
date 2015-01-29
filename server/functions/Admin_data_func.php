<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/irestaurant/server/lib/config.php";


class AQuery {

    public static function Login($username, $password) {

        $db = DataBase::getInstance();
        $query = "SELECT username from admin where username = '$username' and password = '$password'";
        $check = $db->query($query);
        if ($check) {
            if ($check->num_rows > 0) {
                $result = Error_message::response_number(1000);
                $result["data"] = mysqli_fetch_assoc($check);
                if(!isset($_SESSION)){
                    session_start();
                }
                $_SESSION['uid']=uniqid('ang_');
                $result['uid']=$_SESSION['uid'];
            } else {
                $result = Error_message::response_number(2000);
            }
        } else {
            $result = Error_message::response_number(2001);
        }
        return $result;
    }

    public static function addAd($title, $price, $desc, $phone, $category_id, $imei, $image1, $image2, $image3) {
        $db = Database::getInstance();
        $query = "SELECT * from ads where imei='$imei' and created_date >= CURDATE() AND created_date < CURDATE() + INTERVAL 1 DAY ORDER BY id DESC";
        $check = $db->query($query);
        if ($check) {

            if ($check->num_rows > 2) {
                $result = Error_message::response_number(1003);
            } else {
                $name = date("Ymd");
                $time_index = date("hi");
                $image_path = null;
                $main_path = $name . '/' . $imei.'-'.$time_index;
                if (isset($image1)) {
                    Query::saveImage($image1, $imei . '-' . $time_index . '-1', $name);
                    $image_path = $main_path . '-1.jpg';
                }

                if (isset($image2)) {
                    Query::saveImage($image2, $imei . '-' . $time_index . '-2', $name);
                    $image_path.=',' . $main_path . '-2.jpg';
                }
                if (isset($image3)) {
                    Query::saveImage($image3, $imei . '-' . $time_index . '-3', $name);
                    $image_path.=',' . $main_path . '-3.jpg';
                }

                $insert_query = "INSERT INTO ads"
                . " VALUES (null,'$title',$price,'$desc','$phone',now(),$category_id,'$image_path',1,'$imei')";

                $insert = $db->query($insert_query);
                if ($insert)
                    $result = Error_message::response_number(1000);
                else
                    $result = Error_message::response_number(2000);
            }
        } else {
            $result = Error_message::response_number(2001);
        }
        return $result;
    }

    public static function saveImage($base64img, $name, $dir) {
        $filename = $_SERVER["DOCUMENT_ROOT"] . "/mcar/image_upload/ad_image/$dir";
        if (!file_exists($filename)) {
            mkdir($filename, 0700);
        }
        if (!defined('AD_UPLOAD_DIR'))
            define('AD_UPLOAD_DIR', $filename . "/");
        $base64img = str_replace('data:image/jpeg;base64,', '', $base64img);
        $data = base64_decode($base64img);
        $file = AD_UPLOAD_DIR . '' . $name . '.jpg';
        file_put_contents($file, $data);
    }


    


    public static function getCategories($lang) {
        $db = DataBase::getInstance();
        $lang=strtolower($lang);
        $query = 'select c.category_id,c.category_title_'.$lang.' category_title,c.category_icon,c.order_id ,c.created_date from category c order by c.category_id';
        
        $check = $db->query($query);
        if ($check) {
            if ($check->num_rows > 0) {
                $result = Error_message::response_number(1000);

                $subrow = array();
                while ($rows = mysqli_fetch_assoc($check)) {

                    $subrow[] = $rows;
                }
                $result['data'] = $subrow;
            } else {
                $result = Error_message::response_number(1001);
            }
        } else {
            $result = Error_message::response_number(2002);
        }
        return $result;
    }
    public static function getProduct($where,$lang) {
        $db = DataBase::getInstance();
        $lang=strtolower($lang);
        $pquery = 'select  p.product_id,p.product_name_'.$lang.' product_name,p.modified_date,p.product_description_'.$lang.' product_description,p.product_price,p.product_category,pi.image_id,pi.image_url from product p left join product_image pi on p.product_id=pi.product_id '.$where.' order by p.product_id, pi.image_id,p.modified_date desc';
        
        $check = $db->query($pquery);
        
        if ($check) {
            if ($check->num_rows > 0) {
                $result = Error_message::response_number(1000);
                $productId = 0;
                $productIndex = -1;
                $subrow = array();
                while ($rows = mysqli_fetch_assoc($check)) {
                    if($productId!=$rows['product_id']){
                        $productIndex++;
                        $productId=$rows['product_id'];
                        $subrow[$productIndex] ['product_id']=$rows['product_id'];
                        $subrow[$productIndex] ['product_name']=$rows['product_name'];
                        $subrow[$productIndex] ['product_description']=$rows['product_description'];
                        $subrow[$productIndex] ['product_price']=$rows['product_price'];
                        $subrow[$productIndex] ['product_category']=$rows['product_category'];
                        $subrow[$productIndex] ['images'] = array();
                    }
                    $subrow[$productIndex] ['images'][]=  array('image_id' => $rows['image_id'],'image_url'=>$rows['image_url']);
                    $subrow[$productIndex] ['modified_date']=$rows['modified_date'];
                }
                $result['last_update_date']=$subrow[$productIndex]['modified_date'];
                $result['data'] = $subrow;
            } else {
                $result = Error_message::response_number(1001);
            }
        } else {
            $result = Error_message::response_number(2002);
        }
        return $result;
    }

    public static function getLocations($lang){
        $db = DataBase::getInstance();
        $lang=strtolower($lang);
        $lquery = 'select l.location_id,l.location_name_'.$lang.' location_name,l.location_address,l.location_phone_numbers,l.location_lat_long,l.open_time,l.modified_date,li.image_id,li.image_url from location l left join location_image li on l.location_id=li.location_id order by l.location_id, li.image_id,l.modified_date desc';

        $check = $db->query($lquery);

        if ($check) {
            if ($check->num_rows > 0) {
                $result = Error_message::response_number(1000);
                $locationId = 0;
                $locationIndex = -1;
                $subrow = array();
                while ($rows = mysqli_fetch_assoc($check)) {
                    if($locationId!=$rows['location_id']){
                        $locationIndex++;
                        $locationId=$rows['location_id'];

                        $subrow[$locationIndex] ['location_id']=$rows['location_id'];
                        $subrow[$locationIndex] ['location_name']=$rows['location_name'];
                        $subrow[$locationIndex] ['location_address']=$rows['location_address'];
                        $subrow[$locationIndex] ['location_phone_numbers']=$rows['location_phone_numbers'];
                        $subrow[$locationIndex] ['location_lat_long']=$rows['location_lat_long'];
                        $subrow[$locationIndex] ['open_time']=$rows['open_time'];
                        $subrow[$locationIndex] ['images'] = array();
                    }
                    $subrow[$locationIndex] ['images'][]=  array('image_id' => $rows['image_id'],'image_url'=>$rows['image_url']);
                    $subrow[$locationIndex] ['modified_date']=$rows['modified_date'];
                }
                $result['data'] = $subrow;
            } else {
                $result = Error_message::response_number(1001);
            }
        } else {
            $result = Error_message::response_number(2002);
        }
        return $result;
    }
}