<?php

class Web{
    public static function Route($path){
        
        if ($path === "/"){
            System::View("/index");
        }else{
            System::View("$path");
        }
    }
}