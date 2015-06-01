<?php
/**
 * Created by PhpStorm.
 * User: midix
 * Date: 2015/5/26
 * Time: 14:33
 */

class Configure {
    public static $conf_files;
    protected static $conf_array;
    static function get($file){
        if(!self::$conf_array[$file]){
            self::$conf_array[$file]=include_once(self::$conf_files[$file]);
        }
        return self::$conf_array[$file];
    }
    static function add($file,$path){
        self::$conf_files[$file]=$path;
    }
    static function set($file){

    }
}