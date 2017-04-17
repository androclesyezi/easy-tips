<?php
/**
 * Created by PhpStorm.
 * User: yezi
 * Date: 2017/4/6
 * Time: 下午2:44
 */
// 方案一，使用php来模拟这个过程
function king($n,$m){
    $mokey = range(1, $n);
    $i = 0;

    while (count($mokey) >1) {
        $i += 1;
        $head = array_shift($mokey);//一个个出列最前面的猴子
        if ($i % $m !=0) {
            #如果不是m的倍数，则把猴子返回尾部，否则就抛掉，也就是出列
            array_push($mokey,$head);
        }else{
            echo $head;
        }
    }
    // 剩下的最后一个就是大王了
    echo $mokey[0];
}
// 测试
king(6,3);

// 方案二，使用数学方法解决
function josephus($n,$m){
    $r = 0;
    for ($i=2; $i <= $m ; $i++) {
        $r = ($r + $m) % $i;
    }

    return $r+1;
}
// 测试
//print_r(josephus(10,7));