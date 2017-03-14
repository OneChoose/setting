## svn配置学习
#第一部
  svnadmin create /home/svn/yaf
#第二部配置
  3个文件需要配置，分别是authz, password, svnserve.conf
  --authz的配置
  admin = username
  [yafcc:/]
  @admin = rw
  username = rw
  --password的配置
  username=123456
#第三部配置 启动
  svnserve -d -r /home/svn/

  svn co svn://127.0.0.1/yaf /home/output/demo/

  svn add --force *
  svn commit -m 'a'
