<?php 
if(empty($_POST['username'])){
	skip('register.php', '用户名不得为空！');
}
if(mb_strlen($_POST['username'])>32){
	skip('register.php','用户名长度不要超过32个字符！');
}
if(mb_strlen($_POST['password'])<6){
	skip('register.php','密码不得少于6位！');
}

if($_POST['password']!=$_POST['confirm_password']){
	skip('register.php','两次密码输入不一致！');
}
if(strtolower($_POST['vcode'])!=strtolower($_SESSION['vcode'])){
	skip('register.php','验证码输入错误！');
}
$_POST=escape($link,$_POST);
$query="select * from t_user where username='{$_POST['username']}'";
$result=execute($link, $query);
if(mysqli_num_rows($result)){
	skip('register.php', '这个用户名已经被别人注册了！');
}
?>

