
## mysql已经将之前的mysql_native_password认证，修改成了caching_sha2_password认证方式

 create user 'root2'@'%' identified with mysql_native_password by 'root2';
 grant all privileges on *.* to 'root2'@'%';
 grant all privileges on *.* to 'root2'@'%' with grant option;
 flush privileges;
