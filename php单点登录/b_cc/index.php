<?php  
session_start();  
if(!empty($_SESSION['username']))  
{  
    echo "欢迎来到".$_SESSION['username']."的空间";  
}else{  
    echo "请先登录";  
}  
?>  