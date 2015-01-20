<?php

class Error_message{
    public static function response_number($number){
        $number = (int)$number;
        switch($number){
            case 1000:
                $result["response"] = "Success";
                $result["response_number"] = 1;
       
                break;
            case 1001:
                $result["response"] = "No Result";
                $result["response_number"] = 2;
             
            case 2000:
                $result["response"] = "Unsuccessfull";
                $result["response_number"] = 0;

                break;
            case 2001:
                $result["response"] = "Request not matching parameters";
                $result["response_number"] = 3;

                break;
            case 2002:
                $result["response"] = "Error while query";
                $result["response_number"] = 4;

                break;
            default :
                $result["response"] = "Unknown Error";
                $result["response_number"] = 0;
         
                break;
        }
        return $result;
    }
}