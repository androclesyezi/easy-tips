<?php
/**
 * Created by PhpStorm.
 * User: yezi
 * Date: 2017/4/18
 * Time: 上午10:00
 */
//一、有序队列：

//1、生产者：

$redis = new Redis();
$redis->pconnect('127.0.0.1', 6379);
$redis->zAdd('MQ', 1, 'need to do 1');
$redis->zAdd('MQ', 2, 'need to do 2');
//2、消费者：

while (true) {
    $pid = pcntl_fork();
    if ($pid == -1) {
        //创建子进程失败，不处理
    } else if ($pid == 0) {
        $redis = new Redis();
        $redis->connect('127.0.0.1', 6379);
        //执行有序查询，取出排序前10进行处理
        $redis->zRevRangeByScore('MQ', '+inf', '-inf', array('withscores'=>false, 'limit'=>array(0,10)));
        exit;
    } else {
        //主进行执行中，等待
        pcntl_wait($status);
    }
}


//二、无序队列：

//1、生产者：

$redis = new Redis();
$redis->pconnect('127.0.0.1', 6379);
$redis->LPUSH('MQ', 1, 'need to do 1');
$redis->LPUSH('MQ', 2, 'need to do 2');
//2、消费者：

while (true) {
    $pid = pcntl_fork();
    if ($pid == -1) {
        //创建子进程失败，不处理
    } else if ($pid == 0) {
        $redis = new Redis();
        $redis->connect('127.0.0.1', 6379);
        //执行出队处理，BLPOP是阻塞的出队方式，其实还可以用LPOP，不过用lPOP就要自行判断数据是否为空了
        $mq = $redis->BLPOP('MQ');
            //do something

        } else {
        //主进行执行中，等待
        pcntl_wait($status);
    }
}