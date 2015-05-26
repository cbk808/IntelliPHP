<?php
/**
 * Created by PhpStorm.
 * User: midix
 * Date: 2015/5/26
 * Time: 19:46
 */

class AppBase {
    protected $url_params;//url参数数组
    protected $count_url_params;//url参数个数
    protected 
    protected
    public function __construct(){
        global $url_snippet,$count_usl_snippet;;
        $this->count_url_params=$count_usl_snippet;
        $this->url_params=$url_snippet;
    }
    protected function init(){

    }
    public function run(){

    }
}