<?php

include BASE_DIR."/system/config/constants.php";
//注册自动装载函数

function autoLoader($class)
{
    $file_1=CORE_DIR."/".$class.".php";
    $file_2=LIB_DIR."/".$class.".php";
    preg_match("/^[A-Z][_a-z0-9]*/",$class,$matches);
    $cur_app_dir=$matches[0];
    $file_3=APP_DIR."/".strtolower($cur_app_dir)."/php/".$class.".php";
    if(file_exists($file_1)){
        include_once $file_1;
    }elseif(file_exists($file_2)){
        include_once $file_2;
    }elseif(file_exists($file_3)){
        include_once $file_3;
    }
}

//启用自动装载
spl_autoload_register("autoLoader");
Configure::$conf_files=include_once(CONF_DIR."/conf_files.php");

//初始化输入
$cur_app;//当前app
$url_snippet;//url片段数组
$count_url_snippet;//url片段个数

//启动路由功能
Router::start();




