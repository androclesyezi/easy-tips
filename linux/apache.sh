#!/usr/bin/env bash

#1.启动
sudo apachectl -k start

#2.重新启动
sudo apachectl -k restart

#3.查看apache当前并发访问数?
#对比httpd.conf中MaxClients的数字差距多少。
netstat -an | grep ESTABLISHED | wc -l

#4.查看httpd进程数（即prefork模式下Apache能够处理的并发请求数）：
ps aux|grep httpd|wc -l
ps -ef|grep httpd|wc -l
#1388
#统计httpd进程数，连个请求会启动一个进程，使用于Apache服务器。表示Apache能够处理1388个并发请求，这个值Apache可根据负载情况自动调整。

#5.netstat -an会打印系统当前网络链接状态，而grep -i "80"是用来提取与80端口有关的连接的，wc -l进行连接数统计
netstat -nat|grep -i "80"|wc -l
#4341
#最终返回的数字就是当前所有80端口的请求总数。

#6.netstat -an会打印系统当前网络链接状态，而grep ESTABLISHED 提取出已建立连接的信息。 然后wc -l统计。
netstat -na|grep ESTABLISHED|wc -l
#376
#最终返回的数字就是当前所有80端口的已建立连接的总数。

#7.可查看所有建立连接的详细记录
netstat -nat||grep ESTABLISHED|wc

#8.查看Apache的并发请求数及其TCP连接状态：　
netstat -n | awk '/^tcp/
{
    ++S[$NF]
} END {
    for (a in S)
    print a, S[a]
}'

#LAST_ACK 5
#SYN_RECV 30
#ESTABLISHED 1597
#FIN_WAIT1 51
#FIN_WAIT2 504
#TIME_WAIT 1057
#
#其中:
#　　SYN_RECV表示正在等待处理的请求数；
#　　ESTABLISHED表示正常数据传输状态；
#　　TIME_WAIT表示处理完毕，等待超时结束的请求数。

#9.输出每个ip的连接数，以及总的各个状态的连接数
netstat -n | awk '/^tcp/
{
    n=split($(NF-1),array,":");
    if(n<=2)
        ++S[array[(1)]];
    else
        ++S[array[(4)]];
        ++s[$NF];
        ++N
} END {
    for(a in S){
        printf("%-20s %s\n", a, S[a]);
        ++I
    }
    printf("%-20s %s\n","TOTAL_IP",I);
    for(a in s)
        printf("%-20s %s\n",a, s[a]);
    printf("%-20s %s\n","TOTAL_LINK",N);
}'