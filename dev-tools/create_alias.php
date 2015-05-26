<?php
/**
 * Created by PhpStorm.
 * User: midix
 * Date: 2015/5/26
 * Time: 15:08
 */

//结果数组
$res_arr=[];
//符合条件的文件处理后添加到结果数组
function add_alias($file,$res){
    global $res_arr;
    $pathname=basename(dirname($file));
    if($pathname=="core" || $pathname=="library"){
        $filename=explode(".",basename($file));
        $res_arr[$filename[0]]=basename($file);
    }
}

//执行遍历
function intelliTraverse($strInitPath = "", $bRecursive = true, $fnOperation, &$result) {
    if (!$fnOperation) {
        $fnOperation = function () {};
    }
    $current_dir = opendir($strInitPath);
    while (($file = readdir($current_dir)) !== false) {
        $sub_dir = $strInitPath . DIRECTORY_SEPARATOR . $file;
        if ($file == '.' || $file == '..') {
            continue;
        } else if (is_dir($sub_dir) && $bRecursive) {
            intelliTraverse($sub_dir, $bRecursive, $fnOperation, $result);
        } else {
            $fnOperation($strInitPath . DIRECTORY_SEPARATOR . $file, $result);
        }
    }
}
intelliTraverse("../system",true,"add_alias");

$alias_conf="<?php \n return ".var_export($res_arr,true).";";
$fl=fopen("../system/config/alias_conf.php","w+");
//file_put_contents()
fwrite($fl,$alias_conf);
fclose($fl);
