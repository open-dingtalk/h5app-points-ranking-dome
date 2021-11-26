<?php

class Autoloader{
  
    public static function autoload($class) {
        $name = $class;
        if(false !== strpos($name,'\\')){
          $name = strstr($class, '\\', true);
        }
        
        $filename = PATH."/api/".$name.".php";
        if(is_file($filename)) {
            include $filename;
            return;
        }

        $filename = PATH."/request/".$name.".php";
        if(is_file($filename)) {
            include $filename;
            return;
        } 
        $filename = PATH."/".$name.".php";

        if(is_file($filename)) {
            include $filename;
            return;
        }    
    }
}

spl_autoload_register('Autoloader::autoload');
?>