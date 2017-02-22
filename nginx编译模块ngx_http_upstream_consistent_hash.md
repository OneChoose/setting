# nginx编译模块ngx_http_upstream_consistent_hash

  查看nginx编译的configure参数
  ./nginx/sbin/nginx -V 注意这里是大V，小的v是查看版本
  
  添加模块ngx_http_upstream_consistent_hash
  wget https://github.com/replay/ngx_http_consistent_hash/archive/master.zip
  unzip master 解压生成ngx_http_consistent_hash-master文件
  添加模块方式：--add-module=PATH 
  --prefix=/usr/local/nginx --add-module=/root/ngx_http_consistent_hash-master
