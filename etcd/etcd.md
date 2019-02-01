# etcd

##### 

```
下载地址
https://github.com/etcd-io/etcd/releases
wget https://github.com/etcd-io/etcd/releases/download/v3.3.11/etcd-v3.3.11-linux-amd64.tar.gz

版本设置
vim /etc/profile
修改export ETCDCTL_API=3
source /etc/profile

tar xf etcd-v3.3.11-linux-amd64.tar.gz
cd etcd-v3.3.11-linux-amd64

配置文件
vim /etc/etcd/etcd.conf
​```集群配置1
name: etcd-1
data-dir: /root/etcd-v3.3.11-linux-amd64/data
listen-client-urls: http://192.168.0.180:2379,http://127.0.0.1:2379
advertise-client-urls: http://192.168.0.180:2379,http://127.0.0.1:2379
listen-peer-urls: http://192.168.0.180:2380
initial-advertise-peer-urls: http://192.168.0.180:2380
initial-cluster: etcd-1=http://192.168.0.180:2380,etcd-2=http://192.168.0.181:2380,etcd-3=http://192.168.0.182:2380
initial-cluster-token: etcd-cluster-token
initial-cluster-state: new

​```集群配置2
name: etcd-2
data-dir: /root/etcd-v3.3.11-linux-amd64/data
listen-client-urls: http://192.168.0.181:2379,http://127.0.0.1:2379
advertise-client-urls: http://192.168.0.181:2379,http://127.0.0.1:2379
listen-peer-urls: http://192.168.0.181:2380
initial-advertise-peer-urls: http://192.168.0.181:2380
initial-cluster: etcd-1=http://192.168.0.180:2380,etcd-2=http://192.168.0.181:2380,etcd-3=http://192.168.0.182:2380
initial-cluster-token: etcd-cluster-token
initial-cluster-state: new
​```
​```集群配置3
name: etcd-3
data-dir: /root/etcd-v3.3.11-linux-amd64/data
listen-client-urls: http://192.168.0.182:2379,http://127.0.0.1:2379
advertise-client-urls: http://192.168.0.182:2379,http://127.0.0.1:2379
listen-peer-urls: http://192.168.0.182:2380
initial-advertise-peer-urls: http://192.168.0.182:2380
initial-cluster: etcd-1=http://192.168.0.180:2380,etcd-2=http://192.168.0.181:2380,etcd-3=http://192.168.0.182:2380
initial-cluster-token: etcd-cluster-token
initial-cluster-state: new
​```


查看版本号：
./etcdctl version

启动etcd：
./etcd --config-file=/etc/etcd/etcd.conf

查看集群成员信息：
./etcdctl member list

查看集群成员状态
./etcdctl cluster-health

查看leader状态：
curl http://127.0.0.1:2379/v2/stats/leader
查看自己的状态：
curl http://127.0.0.1:2379/v2/stats/self

```

