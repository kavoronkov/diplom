<?php

class AutoLoader {
    static public function classLoader($className) {
        $classFile = str_ireplace("\\",DIRECTORY_SEPARATOR,$className);
        if(file_exists($classFile.".php")) {
            spl_autoload($className);
        }
    }
}