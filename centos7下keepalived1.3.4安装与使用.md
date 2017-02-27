# 一、下载keepalived到/root/
    http://www.keepalived.org/
# 二、安装keepalived
    > cd /root/
    > tar xf keepalived-1.3.4.tar.gz
    > cd keepalived-1.3.4
    > ./configure --prefix=/usr/local/keepalived
    > make && make install
#复制/sbin/keepalived到/usr/sbin下
    > cp /usr/local/keepalived/sbin/keepalived /usr/sbin/
    keepalived默认会读取/etc/keepalived/keepalived.conf配置文件

    > mkdir /etc/keepalived
    > cp /usr/local/keepalived/etc/keepalived/keepalived.conf /etc/keepalived/keepalived.conf
    
    复制sysconfig文件到/etc/sysconfig下
    > cp /usr/local/keepalived/etc/sysconfig/keepalived /etc/sysconfig/
    
    复制启动脚本到/etc/init.d下
    > cd /root/keepalived-1.3.4 ##这是解压目录下面的
    > cp ./keepalived/etc/init.d/keepalived /etc/init.d/
    > chmod 755 /etc/init.d/keepalived
# 三、keepalived的配置,两台虚拟主机上分别装上keepalived,keepalived的配置文件/etc/keepalived/keepalived.conf
    #这是master192.168.0.228鸡配置
    global_defs {
       notification_email {
         123@qq.com
       }
       notification_email_from 123@qq.com
       smtp_server 192.168.200.1
       smtp_connect_timeout 30
       router_id LVS_01
    }
    vrrp_instance VI_1 {
        state MASTER     #服务器状态，主MASTER 
        interface enp0s3 #端口
        virtual_router_id 51 ##当前实例的id，最多有个20个实例
        priority 150     # 主比副的大50
        advert_int 1 ##心跳的间隔一秒，如果对方接受不到信息立刻监管
        authentication { ##通讯密码
            auth_type PASS
            auth_pass 1111
        }
        virtual_ipaddress {
            192.168.0.174/24 #虚拟ip跟副鸡的虚拟ip必须相同
        }
    }
    
    #这是backup192.168.0.228鸡配置
    global_defs {
       notification_email {
         1812587695@qq.com
       }
       notification_email_from Alexandre.Cassen@firewall.loc
       smtp_server 192.168.200.1
       smtp_connect_timeout 30
       router_id LVS_02
    }
    vrrp_instance VI_1 {
        state BACKUP     #服务器状态，主MASTER 
        interface enp0s3 #端口
        virtual_router_id 51 ##当前实例的id，最多有个20个实例
        priority 100     # 主比副的大50
        advert_int 1 ##心跳的间隔一秒，如果对方接受不到信息立刻监管
        authentication { ##通讯密码
            auth_type PASS
            auth_pass 1111
        }
        virtual_ipaddress {
            192.168.0.174/24
        }
    }
 
# 启动、停止、重启
    > service keepalived start、stop、restart
# nginx配置注意
    2台鸡器：192.168.0.228和192.168.0.229，
    另外虚拟ip192.168.0.174，
    访问控制的时候本地机器host走虚拟ip192.168.0.174就可以了，
    如果228这台主鸡nginx驾崩，写一个脚本监控一下：如果nginx驾崩，立刻关闭keepalived的进程
    这个时候229这个鸡器就接管飘逸过来的虚拟ip174鸟，
    在此就实现了.如有雷同绝非巧合
