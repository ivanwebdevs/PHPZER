<?php


class run{
    public static function start(){
        $list_class_zerif = scandir(__DIR__."/class");
        foreach ($list_class_zerif as $list_class_zerif_data){
            if (strpos($list_class_zerif_data,".php") !== false){
                require_once(__DIR__."/class/$list_class_zerif_data");
            }
        }
        
        $server = $_SERVER['SERVER_NAME'];
        $uri = $_SERVER['REQUEST_URI'];
        $path_server = parse_url($uri, PHP_URL_PATH);
        
        $is_root = false;
        if ($path_server === "/"){
            $is_root = true;
        }

        $data_process = explode("/",$path_server);
        if ($data_process[1] === "public"){
            $modified = str_replace("/public","",$path_server);
            header("Location: $modified");
            exit();
        }
        
        elseif($data_process[1] === "api"){
                require_once(__DIR__."/control/Api.php");
                $path_server = str_replace("/api","",$path_server);
                Api::Route($path_server);
        }else{
                require_once(__DIR__."/control/Web.php");
                Web::Route($path_server);
            }
        
    }   
}
run::start();
