<?php

include BASE_DIR."/system/config/constants.php";
//注册自动装载函数

function autoLoader($class)
{
    if(file_exists(CORE_DIR."/".$class.".php")){
        include_once CORE_DIR."/".$class.".php";
    }elseif(file_exists(LIB_DIR."/".$class.".php")){
        include_once LIB_DIR."/".$class.".php";
    }elseif(file_exists(APP_DIR."/".$class.".php")){
        include_once APP_DIR."/".strtolower($class)."/php/".$class.".php";
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




