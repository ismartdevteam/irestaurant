<?php
session_start();
define("ROOT", $_SERVER["DOCUMENT_ROOT"]."/irestaurant");

require_once ROOT.'/server/lib/db.php';
require_once ROOT.'/server/functions/error_func.php';
require_once ROOT .'/server/functions/Mobile_data_func.php';

