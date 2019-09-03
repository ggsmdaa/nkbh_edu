<?php 
if(empty($_POST['username'])){
	skip('login.php', '用户名不得为空！');
}
if(mb_strlen($_POST['username'])>32){
	skip('login.php', '用户名长度不要超过32个字符！');
}
if(empty($_POST['password'])){
	skip('login.php', '密码不得为空！');
}
if(empty($_POST['time']) || is_numeric($_POST['time']) || $_POST['time']>2592000){
	$_POST['time']=2592000;
}
?>