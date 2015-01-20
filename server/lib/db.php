<?php

class Database {
    
    static $instance;
    public static function getInstance(){
        if(!isset(self::$instance)){
            $host="localhost";
            $user="root";
            $password="";
            $database="ismart_irestaurant";
            self::$instance=  mysqli_connect($host, $user, $password, $database);
            self::$instance->set_charset('utf8');
            self::$instance->query("SET timezone ='GMT'");
        }
        return self::$instance;
    }
}