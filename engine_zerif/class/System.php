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
        try{
            header('Content-Type: application/json; charset=utf-8');
            $path = __DIR__."/../api$file.php";
            
            if (file_exists($path)){
                    $result = require_once "$path";
                    
                    if (isset($result['status'])){
                        echo json_encode($result,JSON_PRETTY_PRINT);
                    }
                    elseif(isset($result['msg'])){
                        $result['status'] = false;
                        echo json_encode($result,JSON_PRETTY_PRINT);
                    }else{
                        $result = [];
                        $result['status'] = false;
                        $result['msg'] = "Output tidak di set";
                        echo json_encode($result,JSON_PRETTY_PRINT);
                    }
                    
    
            }else{
                echo json_encode(["status_error"=>true,"status"=>false,"error"=>"404 Not Found"],JSON_PRETTY_PRINT);
                
            }
        }
        catch (ErrorException|Exception|Error $e) {
            // do something with $e
            echo json_encode([
                "status"=>false,
                "status_error"=>true,
                "msg"=>$e->getMessage()
                
                ],JSON_PRETTY_PRINT);
            
        }
        
        
    }
}
