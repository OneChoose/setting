# VirtualBox虚拟机linux共享windows文件

    1.安装工具：yum update, yum install gcc kernel-devel -y,重启系统
  
    2.将光盘VBoxGuestAdditions.iso加入虚拟机

        2.1点击virtualbox设置->存储->控制器：IDE->属性分配光驱->选择D:\Program Files\Oracle\VirtualBox\VBoxGuestAdditions.iso(这是我virtualbox安装路径下面的文件)    【如果是mac到这里 http://download.virtualbox.org/ 下载VBoxGuestAdditions.iso文件】
        
      
    3.安装 VBoxGuestAdditions.iso镜像并挂载
  
        3.1 mount /dev/cdrom /cdrom (该cdrom是我在/目录下创建的文件夹);主要挂载的时候不要进入/cdrom目录，否则挂载不起的
        
        3.2 cd /cdrom; 
    
        3.3 sh ./VBoxLinuxAdditions.run;
    
    4.配置共享文件夹,本地主机创建共享文件夹 d:\share,点击运行的虚拟机设备——>共享文件夹设置——>机器文件，添加共享文件夹——>选中创建的文件夹，填写名字，选择永久分配——>点击确定
  
    5.在虚拟机linux中创建共享文件夹: mkdir mnt/share

    6.mount -t vboxsf share（这是指主机文件夹名） share（这是指终端挂载点名）,我这里是mount -t vboxsf share /mnt/share/
    
    7.假如您不想每一次都手动挂载，可以在linux中/etc/fstab下添加一项： share /mnt/share vboxsf rw,gid=100,uid=1000,auto 0 0

## 注释 你需要下载VirtualBox和安装VirtualBox对应的扩展版本，官网：Extension Pack  All Platforms 是对应的扩展版本指定链接
