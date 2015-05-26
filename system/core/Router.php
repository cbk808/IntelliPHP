<?php
class Router
{
    static function get_url_snippet(){
        global $count_url_snippet;
        $stuff=$_SERVER['PHP_SELF'];
        $arr=explode("/",$stuff);
        array_shift($arr);
        $count_url_snippet=count($arr);
        return $arr;
    }
    static function start(){
        global $cur_app,$url_snippet,$count_url_snippet;
        $app_alias=Configure::get("app_alias");
        $url_snippet=self::get_url_snippet();
        if($app_alias[$url_snippet[0]]){
            $cur_app=Register::get($app_alias[$url_snippet[0]]);
        }else{
            $cur_app=Register::get("Portal");
            $_GET['cur_app']=$cur_app;
        }
        $cur_app->run();
    }
}
