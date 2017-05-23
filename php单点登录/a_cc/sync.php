<?php  
$redirect = empty($_GET['redirect']) ? 'a.cc' : $_GET['redirect'];  
if(empty($_GET['code'])){    
  header('Loaction:http://'.urldecode($redirect));  
  exit;  
}  
  
$apps = array(  
  'b.cc/slogin.php'  
);  
?>  
<!DOCTYPE html>  
<html>  
<head>  
<meta charset="UTF-8"/>  
<?php foreach($apps as $v): ?>  
<script type="text/javascript" src="http://<?php echo $v.'?code='.$_GET['code'] ?>"></script>  
<?php endforeach; ?>  
<title>passport</title>  
</head>  
<body>  
<script type="text/javascript">  
window.onload=function(){  
  location.replace('<?php echo $redirect; ?>');  
}  
</script>  
</body>  
</html>  