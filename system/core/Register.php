<?php
/**
 * Created by PhpStorm.
 * User: midix
 * Date: 2015/5/26
 * Time: 14:13
 */

class Register {
    //已注册的对象数组
    protected static $objects;

    //注册一个对象
    static function set($alias,$object){
        self::$objects[$alias]=$object;
    }

    //取消注册
    static function _unset($name){
        unset(self::$objects[$name]);
    }

    //获取对象
    static function get($alias){
        if(!self::$objects[$alias]){

        }
        return self::$objects[$alias];
    }
}