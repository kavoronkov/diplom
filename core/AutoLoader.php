<?php

class AutoLoader {
    static public function classLoader($className) {
        $classFile = str_ireplace("\\",DIRECTORY_SEPARATOR,$className);
        if(self::fileExists($classFile,"php")) {
            spl_autoload($className);
        }else {
            echo "NO file!!!";
        }
    }

    static private function fileExists($file,$extension) {
        $paths = explode(PATH_SEPARATOR,get_include_path());
        foreach($paths as $path) {
            if(file_exists($path.DIRECTORY_SEPARATOR.$file.".".$extension)) {
                return true;
            }
        }
        return false;
    }
}