  #!/bin/bash  
  rsync -avzP /www/data/ test@192.168.1.3::data  --password-file=/etc/rsync.password  #/etc/rsync.password  这是放密码的文件
