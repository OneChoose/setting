# 下载安装gogs
    wget https://dl.gogs.io/gogs_v0.9.97_linux_amd64.tar.gz
    tar xf gogs_v0.9.97_linux_amd64.tar.gz
    cd gogs ##具体看解压路径
    ./gogs web   ##运行
    
## gogs 监听的是3000端口，你需要访问：http://你的ip:3000
## 安装yum install screen
    screen -S name 启动一个name的screen
    进入cd gogs
    启动./gogs web &
    这样就可以了
    ps aux | grep gogs查看
    [root@localhost ~]# ps aux | grep gogs
    root      5444  0.3  1.5 266992 29764 pts/2    Sl   13:18   0:00 ./gogs web
    root      5544  0.0  0.0 112664   972 pts/0    S+   13:20   0:00 grep --color=auto gogs
    
## supervisor安装配置gogs
    [program:gogs]
    command     = /root/gogs/gogs web #运行的命令
    directory   = /root/gogs/ #gogs程序所在的目录，执行command的目录
    user        = root
    startsecs   = 300 #程序重启时候停留在runing状态的秒数
    autostart=true    #supervisor启动的时候是否随着同时启动
    autorestart=true   #当程序跑出exit的时候，这个program会自动重启
    redirect_stderr         = true
    stdout_logfile_maxbytes = 50MB
    stdout_logfile_backups  = 10
    stdout_logfile          = /root/gogs/log/app.log


## tomcat + java安装
    #java安装
    wget http://download.oracle.com/otn-pub/java/jdk/8u111-b14/jdk-8u111-linux-x64.tar.gz?AuthParam=1477622795_2319ca5db1a2943e65c42f28a8cdf359 ##具体看官网下载地址
    tar xf jdk-8u111-linux-x64.tar.gz 
    mv jdk1.8.0_111 /usr/local/
    ##加入全局变量
    vi /etc/profile.d/java.sh
    JAVA_HOME=/usr/local/jdk1.8.0_111
    JAVA_BIN=/usr/local/jdk1.8.0_111/bin
    JRE_HOME=/usr/local/jdk1.8.0_111/jre
    PATH=$PATH:/usr/local/jdk1.8.0_111/bin:/usr/local/jdk1.8.0_111/jre/bin
    CLASSPATH=/usr/local/jdk1.8.0_111/jre/lib:/usr/local/jdk1.8.0_111/lib:/usr/local/jdk1.8.0_111/jre/lib/charsets.jar
    source /etc/profile ##运行脚本
    #tomcat安装
    wget http://apache.fayea.com/tomcat/tomcat-9/v9.0.0.M11/bin/apache-tomcat-9.0.0.M11.tar.gz
    tar xf apache-tomcat-9.0.0.M11.tar.gz  ##解压就可以用
    mv apache-tomcat-9.0.0.M11 /usr/local/tomcat ##放在安装软件的目录。凭自己习惯
    cd /usr/local/tomcat/bin
    ###其中./version.sh 可以查看tomcat的信息
    ##./startup.sh 运行tomcat
    
 ## jenkins安装
    wget http://mirrors.jenkins-ci.org/war-stable/latest/jenkins.war
    把jenkins的war包，移动到 /usr/local/tomcat/webapps/目录下,我的tomcat放在 /usr/local下面的
    ./startup.sh restart 重启过后，地址访问：http://127.0.0.1:8080/jenkins配置即可
  
 ## jenkins与gogs配置
    jenkins需要配置安装git plus
