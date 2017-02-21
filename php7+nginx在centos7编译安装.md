# php7+nginx在centos7编译安装
  小整理了一哈.
  ##安装一下源 
  yum install -y apr* autoconf automake bison bzip2 bzip2* cloog-ppl compat* cpp curl curl-devel fontconfig fontconfig-devel freetype freetype* freetype-devel gcc gcc-c++ gtk+-devel gd gettext gettext-devel glibc kernel kernel-headers keyutils keyutils-libs-devel krb5-devel libcom_err-devel libpng libpng-devel libjpeg* libsepol-devel libselinux-devel libstdc++-devel libtool* libgomp libxml2 libxml2-devel libXpm* libtiff libtiff* make mpfr ncurses* ntp openssl openssl-devel patch pcre-devel perl php-common php-gd policycoreutils telnet t1lib t1lib* nasm nasm* wget zlib-devel

  wget ftp://ftp.csx.cam.ac.uk/pub/software/programming/pcre/pcre-8.37.tar.gz
  tar zxvf pcre-8.37.tar.gz 
  cd pcre-8.37
  ./configure --prefix=/usr/local/pcre
  make
  make install

##下面是nginx的依赖软件 
    wget http://www.openssl.org/source/openssl-1.0.1q.tar.gz
    tar xf openssl-1.0.1q.tar.gz 
    cd openssl-1.0.1q
    ./config --prefix=/usr/local/openssl
    make && make install

    wget http://zlib.net/zlib-1.2.8.tar.gz
    tar zxvf zlib-1.2.8.tar.gz
    cd zlib-1.2.8
    ./configure --prefix=/usr/local/zlib
    make && make install

    groupadd www
    useradd -g www www -s /bin/false

    wget http://nginx.org/download/nginx-1.8.0.tar.gz
    tar zxvf nginx-1.8.0.tar.gz
    cd nginx-1.8.0
    ./configure --prefix=/usr/local/nginx --without-http_memcached_module --user=www --group=www --with-http_stub_status_module --with-http_ssl_module --with-http_gzip_static_module --with-openssl=/root/openssl-1.0.1q --with-zlib=/root/zlib-1.2.8 --with-pcre=/root/pcre-8.37
    --with-openssl=/root/openssl-1.0.1q --with-zlib=/root/zlib-1.2.8 --with-pcre=/root/pcre-8.37这里主要是指定的源码目录，不是安装目录
    make && make install

    ##以上nginx安装

    ##以下是安装php
    wget ftp://mcrypt.hellug.gr/pub/crypto/mcrypt/libmcrypt/libmcrypt-2.5.7.tar.gz
    tar xf libmcrypt-2.5.7.tar.gz
    cd libmcrypt-2.5.7
    ./configure --prefix=/usr/local/libmcrypt
    make && make install
    /sbin/ldconfig  ###这是什么，反正我也不知道，就是安装好libmcrypt，并且在这个目录下运行包含下面几条命令就不会报错：configure: error:  mcrypt.h not found. Please reinstall libmcrypt
    cd libltdl/   
    ./configure --enable-ltdl-install
    make
    make install 

    wget https://gmplib.org/download/gmp/gmp-6.1.0.tar.bz2
    tar xf gmp-6.1.0.tar.bz2 
    cd gmp-6.1.0
    ./configure --prefix=/usr/local/gmp
    make && make install

    ./configure \
    --prefix=/usr/local/php/7.0.0 \
    --with-config-file-path=/usr/local/php/7.0.0/etc \
    --with-config-file-scan-dir=/usr/local/php/7.0.0/etc/conf.d \
    --enable-fpm \
    --with-fpm-user=www \
    --with-fpm-group=www \
    --enable-soap \
    --with-openssl \
    --with-openssl-dir \
    --with-mcrypt \
    --with-pcre-regex \
    --with-zlib \
    --with-iconv \
    --with-bz2 \
    --enable-calendar \
    --with-curl \
    --with-cdb \
    --enable-dom \
    --enable-exif \
    --with-pcre-dir \
    --enable-ftp \
    --with-gd \
    --with-jpeg-dir \
    --with-png-dir \
    --with-freetype-dir \
    --with-gettext \
    --with-gmp \
    --with-mhash \
    --enable-mbstring \
    --with-libmbfl \
    --with-onig \
    --enable-pdo \
    --with-pdo-mysql \
    --with-zlib-dir \
    --with-readline \
    --enable-session \
    --enable-shmop \
    --enable-simplexml \
    --enable-sockets \
    --enable-sysvmsg \
    --enable-sysvsem \
    --enable-sysvshm \
    --enable-wddx \
    --with-libxml-dir \
    --with-xsl \
    --enable-zip \
    --enable-mysqlnd \
    --with-mysqli \
    make && make install
    ##配置php
    cp php.ini-production /usr/local/php/etc/php.ini  #复制php配置文件到安装目录

    rm -rf /etc/php.ini  #删除系统自带配置文件

    ln -s /usr/local/php/etc/php.ini /etc/php.ini   #添加软链接到 /etc目录

    cp /usr/local/php/etc/php-fpm.conf.default /usr/local/php/etc/php-fpm.conf  #拷贝模板文件为php-fpm配置文件

    ln -s /usr/local/php/etc/php-fpm.conf /etc/php-fpm.conf  #添加软连接到 /etc目录

    vi /usr/local/php/etc/php-fpm.conf #编辑

    user = www #设置php-fpm运行账号为www

    group = www #设置php-fpm运行组为www

    pid = run/php-fpm.pid #取消前面的分号

    :wq! #保存退出

    设置 php-fpm开机启动

    cp /usr/local/src/php-5.5.14/sapi/fpm/init.d.php-fpm /etc/rc.d/init.d/php-fpm #拷贝php-fpm到启动目录

    chmod +x /etc/rc.d/init.d/php-fpm #添加执行权限

    chkconfig php-fpm on #设置开机启动 

    ##配置nginx/conf/nginx.conf
    location ~ \.php$ {
    root           html;
    fastcgi_pass   127.0.0.1:9000;
    fastcgi_index  index.php;
    #    fastcgi_param  SCRIPT_FILENAME  /scripts$fastcgi_script_name;
    fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
    include        fastcgi_params;
    }
