<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/irestaurant/server/lib/config.php";
class MQuery {
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