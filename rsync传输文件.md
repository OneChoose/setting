    #!/bin/bash  
    rsync -avzP /www/data/ test@192.168.1.3::data  --password-file=/etc/rsync.password  #/etc/rsync.password  这是放密码的文件
    1)拷贝本地文件。当SRC和DES路径信息都不包含有单个冒号":"分隔符时就启动这种工作模式。
      如：rsync -a  ./test.c  /backup
    2)使用一个远程shell程序(如rsh、ssh)来实现将本地机器的内容拷贝到远程机器。当DES路径地址包含单个冒号":"分隔符时启动该模式。
      如：rsync -avz  test.c  user@172.16.0.11:/home/user/src
    3)使用一个远程shell程序(如rsh、ssh)来实现将远程机器的内容拷贝到本地机器。当SRC地址路径包含单个冒号":"分隔符时启动该模式。
      如：rsync -avz user@172.16.0.11:/home/user/src  ./src
    4)从远程rsync服务器中拷贝文件到本地机。当SRC路径信息包含"::"分隔符时启动该模式。
      如：rsync -av user@172.16.0.11::www  /databack
    5)从本地机器拷贝文件到远程rsync服务器中。当DES路径信息包含"::"分隔符时启动该模式。
      如：rsync -av /databack user@172.16.0.11::www
    6)列远程机的文件列表。这类似于rsync传输，不过只要在命令中省略掉本地机信息即可。
      如：rsync -v rsync://172.16.78.192  /www 
    ssh端口更改后rsync的用法
    rsync  -e  'ssh -p 3333'  test.c  ustc@172.16.0.172:/home/ustc
