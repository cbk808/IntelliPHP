<?php
//注册自动装载函数
function autoLoader($class)
{
    if(file_exists(CORE_DIR."/".$class)){
        include_once CORE_DIR."/".$class;
    }elseif(file_exists(LIB_DIR."/".$class)){
        include_once LIB_DIR."/".$class;
    }
}
spl_autoload_register(autoLoader);
include BASE_DIR."/system/config/constants.php";
