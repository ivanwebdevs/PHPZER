<?php
class System{
    public static function View($file){
        $path = __DIR__."/../view$file.php";
        if (file_exists($path)){
            require_once($path); 
        }else{
            echo "Error 404 not fouund";
        }
        
    }
    public static function LoadApi($file){
        header('Content-Type: application/json; charset=utf-8');
        $path = __DIR__."/../api$file.php";
        if (file_exists($path)){
            $result = require_once "$path";
            echo json_encode($result,JSON_PRETTY_PRINT);
        }else{
            echo json_encode(["status"=>"false","error"=>"404 Not Found"],JSON_PRETTY_PRINT);
            
        }
        
    }
}
