#负责压缩数据流
        gzip              on;  
        gzip_min_length   1000;  
        gzip_types        text/plain text/css application/x-javascript;

        #设定负载均衡的服务器列表
        #weigth参数表示权值，权值越高被分配到的几率越大
        upstream hello{
            server 192.168.68.43:8080 weight=1;
            server 192.168.68.45:8080 weight=1;            
        }

        server {
            #侦听的80端口
            listen       80;
            server_name  localhost;
            #设定查看Nginx状态的地址
            location /nginxstatus{
            stub_status on;
            access_log on;
            auth_basic "nginxstatus";
            auth_basic_user_file htpasswd;
            }
            #匹配以jsp结尾的，tomcat的网页文件是以jsp结尾
            location / {
                index index.jsp;
                proxy_pass   http://hello;    #在这里设置一个代理，和upstream的名字一样
                #以下是一些反向代理的配置可删除
                proxy_redirect             off; 
                #后端的Web服务器可以通过X-Forwarded-For获取用户真实IP
                proxy_set_header           Host $host; 
                proxy_set_header           X-Real-IP $remote_addr; 
                proxy_set_header           X-Forwarded-For $proxy_add_x_forwarded_for; 
                client_max_body_size       10m; #允许客户端请求的最大单文件字节数
                client_body_buffer_size    128k; #缓冲区代理缓冲用户端请求的最大字节数
                proxy_connect_timeout      300; #nginx跟后端服务器连接超时时间(代理连接超时)
                proxy_send_timeout         300; #后端服务器数据回传时间(代理发送超时)
                proxy_read_timeout         300; #连接成功后，后端服务器响应时间(代理接收超时)
                proxy_buffer_size          4k; #设置代理服务器（nginx）保存用户头信息的缓冲区大小
                proxy_buffers              4 32k; #proxy_buffers缓冲区，网页平均在32k以下的话，这样设置
                proxy_busy_buffers_size    64k; #高负荷下缓冲大小（proxy_buffers*2）
                proxy_temp_file_write_size 64k; #设定缓存文件夹大小，大于这个值，将从upstream服务器传
            }
        }
