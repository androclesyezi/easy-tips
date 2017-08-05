#!/usr/bin/env bash

#1、编写个shell脚本将当前目录下大于10K的文件转移到/tmp目录下

#/bin/sh

#Programm :

# Using for move currently directory to /tmp

for FileName in `ls -l | awk '$5>10240 {print $9}'`

do

mv $FileName /tmp

done

ls -al /tmp

echo "Done! "

#2、编写shell脚本获取本机的网络地址。

#比如：本机的ip地址是：192.168.100.2/255.255.255.0，那么它的网络地址是

#192.168.100.1/255.255.255.0

#方法一：

#!/bin/bash

#This script print ip and network

file="/etc/sysconfig/network-scripts/ifcfg-eth0"

if [ -f $file ] ;then

IP=`grep "IPADDR" $file|awk -F"=" '{ print $2 }'`

MASK=`grep "NETMASK" $file|awk -F"=" '{ print $2 }'`

echo "$IP/$MASK"

exit 1

fi

#方法二：

#!/bin/bash

#This programm will printf ip/network

#

IP=`ifconfig eth0 |grep 'inet ' |sed 's/^.*addr://g'|sed 's/ Bcast.*$//g'`

NETMASK=`ifconfig eth0 |grep 'inet '|sed 's/^.*Mask://g'`

echo "$IP/$NETMASK"

exit

#3、用Shell编程，判断一文件是不是字符设备文件，如果是将其拷贝到 /dev 目录下。

#参考程序：

#!/bin/sh

FILENAME=

echo "Input file name："

read FILENAME

if [ -c "$FILENAME" ]

then

cp $FILENAME /dev

fi

#4．请为下列shell程序添加注释，并说明程序的功能和调用方法：

#!/bin/sh

#

# /etc/rc.d/rc.httpd

#

# Start/stop/restart the Apache web server.

#

# To make Apache start automatically at boot, make this

# file executable: chmod 755 /etc/rc.d/rc.httpd

#

case "$1" in

'start')

/usr/sbin/apachectl start ;;

'stop')

/usr/sbin/apachectl stop ;;

'restart')

/usr/sbin/apachectl restart ;;

*)

echo "usage $0 start|stop|restart" ;;

esac

#参考答案：

#（1）程序注释

#!/bin/sh 定义实用的shell

#

# /etc/rc.d/rc.httpd 注释行，凡是以星号开始的行均为注释行。

#

# Start/stop/restart the Apache web server.

#

# To make Apache start automatically at boot, make this

# file executable: chmod 755 /etc/rc.d/rc.httpd

#

case "$1" in #case结构开始，判断“位置参数”决定执行的操作。本程序携带一个“位置参数”，即$1

'start') #若位置参数为start

/usr/sbin/apachectl start ;; #启动httpd进程

'stop') #若位置参数为stop

/usr/sbin/apachectl stop ;; #关闭httpd进程

'restart') #若位置参数为stop

/usr/sbin/apachectl restart ;; #重新启动httpd进程

*) #若位置参数不是start、stop或restart时

echo "usage $0 start|stop|restart" ;; #显示命令提示信息：程序的调用方法

esac #case结构结束

#（2）程序的功能是启动，停止或重新启动httpd进程

#（3）程序的调用方式有三种：启动，停止和重新启动。

#5．设计一个shell程序，添加一个新组为class1，然后添加属于这个组的30个用户，用户名的形式为stdxx，其中xx从01到30。

#参考答案：

#!/bin/sh

i=1

groupadd class1

while [ $i -le 30 ]

do

if [ $i -le 9 ] ;then

USERNAME=stu0${i}

else

USERNAME=stu${i}

fi

useradd $USERNAME

mkdir /home/$USERNAME

chown -R $USERNAME /home/$USERNAME

chgrp -R class1 /home/$USERNAME

i=$(($i+1))

done

#6．编写shell程序，实现自动删除50个账号的功能。账号名为stud1至stud50。

#参考程序：

#!/bin/sh

i=1

while [ $i -le 50 ]

do

userdel -r stud${i}

i=$(($i+1 ))

done

#7．某系统管理员需每天做一定的重复工作，请按照下列要求，编制一个解决 方案 ：

#（1）在下午4 :50删除/abc目录下的全部子目录和全部文件；

#（2）从早8:00～下午6:00每小时读取/xyz目录下x1文件中每行第一个域的全部数据加入到/backup目录下的bak01.txt文件内；

#（3）每逢星期一下午5:50将/data目录下的所有目录和文件归档并压缩为文件：backup.tar.gz；

#（4）在下午5:55将IDE接口的CD-ROM卸载（假设：CD-ROM的设备名为hdc）；

#（5）在早晨8:00前开机后启动。

#参考答案:

#解决方案：

#（1）用vi创建编辑一个名为prgx的crontab文件；

#prgx文件的内容：

#50 16 * * * rm -r /abc/*

#（2）、0 8-18/1 * * * cut -f1 /xyz/x1 >;>; /backup/bak01.txt

#（3）、50 17 * * * tar zcvf backup.tar.gz /data

#（4）、55 17 * * * umount /dev/hdc

#（5）、由超级用户登录，用crontab执行 prgx文件中的内容：

#root@xxx:#crontab prgx；在每日早晨8:00之前开机后即可自动启动crontab。

#－－－－－－－－－－－－－－－－－－－－－－－－－－－－－－－－－－－－－－－－－－－－－－

#8．设计一个shell程序，在每月第一天备份并压缩/etc目录的所有内容，存放在/root/bak目录里，且文件名为如下形式yymmdd_etc，yy为年，mm为月，dd为日。Shell程序fileback存放在/usr/bin目录下。

#参考答案：

#（1）编写shell程序fileback：

#!/bin/sh

DIRNAME=`ls /root | grep bak`

if [ -z "$DIRNAME" ] ; then

mkdir /root/bak

cd /root/bak

fi

YY=`date +%y`

MM=`date +%m`

DD=`date +%d`

BACKETC=$YY$MM$DD_etc.tar.gz

tar zcvf $BACKETC /etc

echo "fileback finished!"

#（2）编写任务定时器：

echo "0 0 1 * * /bin/sh /usr/bin/fileback" >; /root/etcbakcron

crontab /root/etcbakcron

#或使用crontab -e 命令添加定时任务：

0 1 * * * /bin/sh /usr/bin/fileback

#9．有一普通用户想在每周日凌晨零点零分定期备份/user/backup到/tmp目录下，该用户应如何做？

#参考答案：（1）第一种方法：

#用户应使用crontab –e 命令创建crontab文件。格式如下：

#0 0 * * sun cp –r /user/backup /tmp

#（2）第二种方法：

#用户先在自己目录下新建文件file，文件内容如下：

#0 * * sun cp –r /user/backup /tmp

#然后执行 crontab file 使生效。

#10．设计一个Shell程序，在/userdata目录下建立50个目录，即user1～user50，并设置每个目录的权限，其中其他用户的权限为：读；文件所有者的权限为：读、写、执行；文件所有者所在组的权限为：读、执行。

#参考答案: 建立程序 Pro16如下：

#!/bin/sh

i=1

while [ i -le 50 ]

do

if [ -d /userdata ];then

mkdir -p -m 754 /userdata/user$i   加上-m 754 就不用写下面那一句了  -p 是递归建立目录

#chmod 754 /userdata/user$i

echo "user$i"

let "i = i + 1"

else

mkdir /userdata

mkdir -p -m /userdata/user$i

#chmod 754 /userdata/user$i

echo "user$i"

let "i = i + 1"

fi

done

#11.遍历目录和子目录的所有文件

function getdir(){
    for element in `ls $1`
    do
        dir_or_file=$1"/"$element
        if [ -d $dir_or_file ]
        then
            getdir $dir_or_file
        else
            echo $dir_or_file
        fi
    done
}
root_dir="/home/test"
getdir $root_dir




nginx 配制

复制代码 代码如下:

 log_format  main  '$remote_addr - $remote_user [$time_local] $request '
                      '"$status" $body_bytes_sent "$http_referer" '
                      '"$http_user_agent" "$http_x_forwarded_for" $request_time';
    access_log  /var/log/nginx/access.log  main buffer=32k;

从上面配置，可以看到：ip在 第一列，页面耗时是在最后一列，中间用空格分隔。 因此在awk 中，分别可以用：$1
$NF 读取到当前值。 其中NF是常量，代表整个列数。
下面是分析代码的shell文件，可以存为slow.sh
复制代码 代码如下:

#!/bin/sh
export PATH=/usr/bin:/bin:/usr/local/bin:/usr/X11R6/bin;
export LANG=zh_CN.GB2312;
function usage()
{
   echo "$0 filelog  options";
   exit 1;
}
function slowlog()
{
#set -x;
field=$2;
files=$1;
end=2;
msg="";
[[ $2 == '1' ]] && field=1&&end=2&&msg="总访问次数统计";
[[ $2 == '2' ]] && field=3&&end=4&&msg="平均访问时间统计";
echo -e "\r\n\r\n";
echo -n "$msg";
seq -s '#' 30 | sed -e 's/[0-9]*//g';
awk '{split($7,bbb,"?");arr[bbb[1]]=arr[bbb[1]]+$NF; arr2[bbb[1]]=arr2[bbb[1]]+1; } END{for ( i in arr ) { print i":"arr2[i]":"arr[i]":"arr[i]/arr2[i]}}' $1 | sort  -t: +$field -$end -rn |grep "pages" |head -30 | sed 's/:/\t/g'
}
[[ $# < 2 ]] && usage;
slowlog $1 $2;
只需要执行：slow.sh 日志文件  1或者2
1：三十条访问最平凡的页面
2：三十条访问最耗时的页面
执行结果如下：
chmod +x ./slow.sh
chmod +x slow.sh
./slow.sh /var/log/nginx/
./slow.sh /var/log/nginx/access.log 2

平均访问时间统计#############################
/pages/########1.php        4       120.456 30.114
/pages/########2.php 1       16.161  16.161
/pages/########3.php 212     1122.49 5.29475
/pages/########4.php     6       28.645  4.77417