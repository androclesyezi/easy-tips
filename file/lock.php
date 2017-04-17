<?php

//请写一段PHP代码，确保多个进程同时写入同一个文件成功（腾讯）

$fp = fopen("lock.txt","w+");
if (flock($fp,LOCK_EX)) {
    //获得写锁，写数据
    fwrite($fp, "write something");

    // 解除锁定
    flock($fp, LOCK_UN);
} else {
    echo "file is locking...";
}
fclose($fp);
?>