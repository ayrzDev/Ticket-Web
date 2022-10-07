<?php

require_once("functionBase.php");

class extraClass{

    public function kisalt($kelime, $str = 10)
    {
    if (strlen($kelime) > $str){
        if (function_exists("mb_substr")) $kelime = mb_substr($kelime, 0, $str, "UTF-8").'..';
        else $kelime = substr($kelime, 0, $str).'..';
    }
    return $kelime;
    }
}

?>