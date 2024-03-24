<?php
namespace Magnet\App\Library;
class A{
    public function __construct(){
        echo "I am Class A <br/>";
    }

    public function read()
    {
        $files = scandir(DIR_CACHE,);
        return $files;    
    }
}
