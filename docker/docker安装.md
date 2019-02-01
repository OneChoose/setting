### docker安装

```
1.要求centos7以上版本    
2.下载清华大学docker镜像
	cd /etc/yum.repos.d/
	wget https://mirrors.tuna.tsinghua.edu.cn/docker-ce/linux/centos/docker-ce.repo
3.然后vim替换docker原下载地址：
	vim docker-ce.repo
	:%s@https://download.docker.com/@https://mirrors.tuna.tsinghua.edu.cn/docker-ce/@
4.安装
	yum install docker-ce -y
```

### docker配置

##### 环境配置文件：

```
/etc/sysconfig/docker-network
/etc/sysconfig/docker-storage
/etc/sysconfig/docker
```

##### Unit File：

```
/usr/lib/systemd/system/docker.service
```

##### Docker Register配置文件：

```
/etc/containers/redisteres.conf
```

##### docker-ce

```
配置文件： /etc/docker/daemon.json
```

##### docker镜像加速

```
{
    "registry-mirrors": ["https://register.docker-cn.com"]
}
```



启动docker

```
systemctl start docker.service
```



### 