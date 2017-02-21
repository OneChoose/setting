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
