<?php
/**
 * Created by PhpStorm.
 * User: midix
 * Date: 2015/5/26
 * Time: 18:06
 */

class Portal extends AppBase{
    public function __construct(){
        $this->app_conf=Configure::get("portal_conf");//加载当前app配置
        //首先做参数分析
        if($this->count_url_params>0){//如果参数个数不为0，则根据参数名进一步确定程序走向
            if(in_array($this->url_params[0],$this->app_conf['module'])){//如果在app配置中找到了相应的模块,则进行相应的赋值
                $this->moodule=Register::get("Portal".ucfirst($this->url_params[0]));
                if($this->url_params[1] && method_exists($this->url_params[1],$this->module)){//入口函数名正确
                    $this->entry=$this->url_params[0];
                }else{
                    $this->entry="index";
                }
            }
        }else{//没有额外的参数或者模块错误, 默认打开index页面
            $this->module=Register::get("PortalIndex");
            $this->entry="index";
        }
    }
    public function run(){
        $fn_name=$this->entry;
        $this->module->$fn_name();//执行入口函数
    }
    public function test(){
        echo "sadjflasjdfjalsd";
    }
}