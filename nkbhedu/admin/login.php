<?php 
include_once '../inc/config.inc.php';
include_once '../inc/mysql.inc.php';
include_once '../inc/tool.inc.php';
$link=connect();
if(is_manage_login($link)){
	skip('index.php','您已经登录，请不要重复登录！');
}
if(isset($_POST['submit'])){
    if(empty($_POST['username'])){
        skip('login.php','管理员名称不得为空！');
    }
    if(mb_strlen($_POST['username'])>32){
        skip('login.php','管理员名称不得多余32个字符！');
    }
    if(mb_strlen($_POST['password'])<6){
        skip('login.php','密码不得少于6位！');
    }
	$_POST=escape($link,$_POST);
	$query="select * from t_auth_user where username='{$_POST['username']}' and password=md5('{$_POST['password']}')";
	$result=execute($link, $query);
	if(mysqli_num_rows($result)==1){
		$data=mysqli_fetch_assoc($result);
		$_SESSION['manage']['username']=$data['username'];
		$_SESSION['manage']['password']=sha1($data['password']);
		$_SESSION['manage']['id']=$data['id'];
		skip('index.php','登录成功！');
	}else{
		skip('login.php','用户名或者密码错误，请重试！');
	}
}
$template['title']='欢迎登录';

?>


<!DOCTYPE html>
<html>
<head>
    <title><?php echo $template['title'] ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="res/css/bootstrap4.min.css">
    <script src="res/js/jquery-3.2.1.min.js"></script>
    <script src="https://cdn.staticfile.org/popper.js/1.12.5/umd/popper.min.js"></script>
    <script src="res/js/bootstrap4.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../res/style.css">
    <link rel="icon" type="image/png" href="res/img/ico.png" sizes="16x16">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
</head>


<body style="background:url('../res/img/leaves-pattern.png');">
    
<div class="logo_box">
    <h3>南滨在线学习平台</h3>
    <p>后台登录</p>
    <form method="post">
        <div class="input_outer">
            <span class="user-name-ico"><i class="fas fa-user"></i></span>
            <input name="username" class="text" type="text" placeholder="请输入账户">
        </div>
        <div class="input_outer">
            <span class="user-psd-ico"><i class="fas fa-key"></i></span>
            <input id="password" name="password" class="text" type="password" placeholder="请输入密码">
        </div>
        <div class="login_btn">
          <input type="submit" name="submit" value="登录" />
        </div>
    </form>
</div>

	</body>
</html>
