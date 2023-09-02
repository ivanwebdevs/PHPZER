<?php
class Api{
    public static function Route($path){
        
        if ($path === "/"){
            System::loadApi("/index");
        }else{
            System::loadApi("$path");
        }
    }
}