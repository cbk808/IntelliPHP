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
    protected $module;//入口模块
    protected $entry;//入口函数
    protected $app_conf;//app的配置数组
    public function __construct(){
        global $url_snippet,$count_url_snippet;
        $this->count_url_params=$count_url_snippet;
        $this->url_params=$url_snippet;
    }
    protected function init(){

    }
    public function run(){

    }
}