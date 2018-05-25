# PHP7中php.ini

    ######避免PHP信息暴露在http头中
    expose_php = Off
    
    ######避免暴露php调用mysql的错误信息
    display_errors = Off
    
    ######在关闭display_errors后开启PHP错误日志（路径在php-fpm.conf中配置）
    log_errors = On
    
    ######设置PHP的扩展库路径
    extension_dir = "/usr/local/php7/lib/php/extensions/no-debug-non-zts-20141001/"
    
    ######设置PHP的opcache
    zend_extension=opcache.so
    
    ######开启opcache
    [opcache]
    ; Determines if Zend OPCache is enabled
    opcache.enable=1
    ; 开启CLI
    opcache.enable_cli=1
    ; 可用内存, 酌情而定, 单位为：Mb
    opcache.memory_consumption=528
    ; Zend Optimizer + 暂存池中字符串的占内存总量.(单位:MB)
    opcache.interned_strings_buffer=8
    ; 对多缓存文件限制, 命中率不到 100% 的话, 可以试着提高这个值
    opcache.max_accelerated_files=10000
    ; Opcache 会在一定时间内去检查文件的修改时间, 这里设置检查的时间周期, 默认为 2, 定位为秒
    opcache.revalidate_freq=1
    ; 打开快速关闭, 打开这个在PHP Request Shutdown的时候回收内存的速度会提高
    opcache.fast_shutdown=1
    
    ######设置PHP的时区
    date.timezone = Asia/Shanghai
    
# php-fpm配置详解

    pid = /usr/local/var/run/php-fpm.pid
    #pid设置，一定要开启,上面是Mac平台的。默认在php安装目录中的var/run/php-fpm.pid。比如centos的在: /usr/local/php/var/run/php-fpm.pid
    error_log = /usr/local/var/log/php-fpm.log
    #错误日志，上面是Mac平台的，默认在php安装目录中的var/log/php-fpm.log，比如centos的在: /usr/local/php/var/log/php-fpm.log
    log_level = notice
    #错误级别. 上面的php-fpm.log纪录的登记。可用级别为: alert（必须立即处理）, error（错误情况）, warning（警告情况）, notice（一般重要信息）, debug（调试信息）. 默认: notice.
    emergency_restart_threshold = 60
    emergency_restart_interval = 60s
    #表示在emergency_restart_interval所设值内出现SIGSEGV或者SIGBUS错误的php-cgi进程数如果超过 emergency_restart_threshold个，php-fpm就会优雅重启。这两个选项一般保持默认值。0 表示 '关闭该功能'. 默认值: 0 (关闭).
    process_control_timeout = 0
    #设置子进程接受主进程复用信号的超时时间. 可用单位: s(秒), m(分), h(小时), 或者 d(天) 默认单位: s(秒). 默认值: 0.
    daemonize = yes
    #后台执行fpm,默认值为yes，如果为了调试可以改为no。在FPM中，可以使用不同的设置来运行多个进程池。 这些设置可以针对每个进程池单独设置。
    listen = 127.0.0.1:9000
    #fpm监听端口，即nginx中php处理的地址，一般默认值即可。可用格式为: 'ip:port', 'port', '/path/to/unix/socket'. 每个进程池都需要设置。如果nginx和php在不同的机器上，分布式处理，就设置ip这里就可以了。
    listen.backlog = -1
    #backlog数，设置 listen 的半连接队列长度，-1表示无限制，由操作系统决定，此行注释掉就行。backlog含义参考：http://www.3gyou.cc/?p=41
    listen.allowed_clients = 127.0.0.1
    #允许访问FastCGI进程的IP白名单，设置any为不限制IP，如果要设置其他主机的nginx也能访问这台FPM进程，listen处要设置成本地可被访问的IP。默认值是any。每个地址是用逗号分隔. 如果没有设置或者为空，则允许任何服务器请求连接。
    listen.owner = www
    listen.group = www
    listen.mode = 0666
    #unix socket设置选项，如果使用tcp方式访问，这里注释即可。
    user = www
    group = www
    #启动进程的用户和用户组，FPM 进程运行的Unix用户, 必须要设置。用户组，如果没有设置，则默认用户的组被使用。
    pm = dynamic
    #php-fpm进程启动模式，pm可以设置为static和dynamic和ondemand
    #如果选择static，则进程数就数固定的，由pm.max_children指定固定的子进程数。
    #如果选择dynamic，则进程数是动态变化的,由以下参数决定：
    pm.max_children = 50 #子进程最大数
    pm.start_servers = 2 #启动时的进程数，默认值为: min_spare_servers + (max_spare_servers - min_spare_servers) / 2
    pm.min_spare_servers = 1 #保证空闲进程数最小值，如果空闲进程小于此值，则创建新的子进程
    pm.max_spare_servers = 3 #，保证空闲进程数最大值，如果空闲进程大于此值，此进行清理
    pm.max_requests = 500
    #设置每个子进程重生之前服务的请求数. 对于可能存在内存泄漏的第三方模块来说是非常有用的. 如果设置为 '0' 则一直接受请求. 等同于 PHP_FCGI_MAX_REQUESTS 环境变量. 默认值: 0.
    pm.status_path = /status
    #FPM状态页面的网址. 如果没有设置, 则无法访问状态页面. 默认值: none. munin监控会使用到
    ping.path = /ping
    #FPM监控页面的ping网址. 如果没有设置, 则无法访问ping页面. 该页面用于外部检测FPM是否存活并且可以响应请求. 请注意必须以斜线开头 (/)。
    ping.response = pong
    #用于定义ping请求的返回相应. 返回为 HTTP 200 的 text/plain 格式文本. 默认值: pong.
    access.log = log/$pool.access.log
    #每一个请求的访问日志，默认是关闭的。
    access.format = "%R - %u %t \"%m %r%Q%q\" %s %f %{mili}d %{kilo}M %C%%"
    #设定访问日志的格式。
    slowlog = log/$pool.log.slow
    #慢请求的记录日志,配合request_slowlog_timeout使用，默认关闭
    request_slowlog_timeout = 10s
    #当一个请求该设置的超时时间后，就会将对应的PHP调用堆栈信息完整写入到慢日志中. 设置为 '0' 表示 'Off'
    request_terminate_timeout = 0
    #设置单个请求的超时中止时间. 该选项可能会对php.ini设置中的'max_execution_time'因为某些特殊原因没有中止运行的脚本有用. 设置为 '0' 表示 'Off'.当经常出现502错误时可以尝试更改此选项。
    rlimit_files = 1024
    #设置文件打开描述符的rlimit限制. 默认值: 系统定义值默认可打开句柄是1024，可使用 ulimit -n查看，ulimit -n 2048修改。
    rlimit_core = 0
    #设置核心rlimit最大限制值. 可用值: 'unlimited' 、0或者正整数. 默认值: 系统定义值.
    chroot =
    #启动时的Chroot目录. 所定义的目录需要是绝对路径. 如果没有设置, 则chroot不被使用.
    chdir =
    #设置启动目录，启动时会自动Chdir到该目录. 所定义的目录需要是绝对路径. 默认值: 当前目录，或者/目录（chroot时）
    catch_workers_output = yes
    #重定向运行过程中的stdout和stderr到主要的错误日志文件中. 如果没有设置, stdout 和 stderr 将会根据FastCGI的规则被重定向到 /dev/null . 默认值: 空.
