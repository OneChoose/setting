###nginx虚拟主机配置
    		server {
			listen      80;
			server_name  ph2.cc;
			set         $root_path '/home/tutorial/public';
			root        $root_path;


			index index.php index.html index.htm;

			try_files $uri $uri/ @rewrite;

			location @rewrite {
				rewrite ^/(.*)$ /index.php?_url=/$1;
			}

			location ~ \.php {
				fastcgi_pass   127.0.0.1:9000;
				fastcgi_index  index.php;
				fastcgi_param  SCRIPT_FILENAME $root_path$fastcgi_script_name;
				include        fastcgi_params;
			}

			location ~* ^/(css|img|js|flv|swf|download)/(.+)$ {
				root $root_path;
			}

			location ~ /\.ht {
				deny all;
			}
		}
