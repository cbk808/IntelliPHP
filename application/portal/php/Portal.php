<?php
/**
 * Created by PhpStorm.
 * User: midix
 * Date: 2015/5/26
 * Time: 18:06
 */

class Portal extends AppBase{
    public function __construct(){
        //首先做参数分析
        if($this->count_url_params>0){//如果参数个数不为0，则根据参数名进一步确定程序走向

        }else{//没有额外的参数, 默认打开index页面

        }
    }
    public function run(){

    }
}