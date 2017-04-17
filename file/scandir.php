<?php
//写一个函数，能够遍历一个文件夹下的所有文件和子文件夹。（新浪）
function scandir($dir){
    $files = array();
    if(is_dir($dir)){
        if ($handle = opendir($dir)) {
            while (($file = readdir($handle))!== false) {
                if ($file!="." && $file!="..") {
                    if (is_dir($dir."/".$file)) {
                        $files[$file] = scandir($dir."/".$file);
                    } else {
                        $files[] = $dir."/".$file;
                    }
                }
            }
            closedir($handle);
            return $files;
        }
    }
}
?>