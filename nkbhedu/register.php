<?php 
define('IN_SFKBBS',true);
include_once 'inc/config.inc.php';
include_once 'inc/mysql.inc.php';
include_once 'inc/tool.inc.php';
$link=connect();
$member_id=is_login($link);
if($member_id){
    skip('index.php','你已经登录，请不要重复注册！');
}
if(isset($_POST['submit'])){
	include 'inc/check_register.inc.php';
	$query="insert into t_user(username,password,email,register_time) 
		values('{$_POST['username']}',md5('{$_POST['password']}'),'{$_POST['email']}'
		,now())";
	execute($link,$query);
	if(mysqli_affected_rows($link)==1){
		setcookie('nkbhoe[username]',$_POST['username']);
		setcookie('nkbhoe[password]',sha1(md5($_POST['password'])));
		skip('index.php','注册成功！');
	}else{
		skip('register.php','注册失败,请重试！');
	}
}
$template['title']='会员注册页';
?>

<?php include 'inc/header.inc.php'?>
<div style="margin:10%;">
<div class="register_box" id="register">
    <h3>注册</h3>
    <p>与志同道合的人一起学习</p>
    <form method="post">
        <div>
        	<label>用户名：</label>
        	<input type="text" name="username" placeholder="请输入用户名（2~6个汉字）" />
        </div>
        <div>
            <label>密码：</label>
            <input name="password" type="password" placeholder="请输入密码（6-10个字母或数字）">
        </div>
        <div>
            <label>确认密码：</label>
            <input name="confirm_password" type="password" placeholder="请确认密码">
        </div>
        <div>
            <label>邮箱：</label>
            <input name="email" type="email" placeholder="请输入邮箱">
        </div>
        
        <div>
			<label>验证码：</label>
			<input name="vcode" type="text" style="width:135px;" />
			<img class="vcode" src="inc/vcode.inc.php" />
		</div>

        <div class="register_input">
     	 	<input type="submit" name="submit" value="注册" />
    	</div>
        <a href="login.php">已有账号？点我登录</a>
    </form>
</div>
</div>


<script type="text/javascript">
$(function () {
  var errMsg;
  var val;
  $.each($("input"), function (i, val) {
	    $(val).blur(function () {
	      if ($(val).attr("name") == "username") {
	        $(".nickMsg").remove();
	        var usename = val.value;
	        var regName = /[\u4e00-\u9fa5]{2,6}/
	        if (usename == "" || usename.trim() == "") {
	          errMsg = "<span class='nickMsg' style='color:#7d7d7d;'>昵称不能为空</span>";
	        } else if (!regName.test(usename)) {
	          errMsg = "<span class='nickMsg' style='color:#7d7d7d;'>由2-6个汉字组成</span>";
	        } else {
	          errMsg = "<span class='nickMsg' style='color:#07456f;'>没问题！</span>";
	        }
	        $(this).parent().append(errMsg);
	      } 
	      if ($(val).attr("name") == "password") {
	        $(".passwordMsg").remove();
	        var password = val.value;
	        var regpassword = /^\w{6,10}$/;
	        if (password == "" || password.trim() == "") {
	          errMsg = "<span class='passwordMsg' style='color:#7d7d7d;'>密码不能为空</span>";
	        } else if (!regpassword.test(password)) {
	          errMsg = "<span class='passwordMsg' style='color:#7d7d7d;'>格式错误</span>";
	        } else {
	          errMsg = "<span class='passwordMsg' style='color:#07456f;'>这样就好啦!</span>";
	        }
	        $(this).parent().append(errMsg);
	      }else if ($(val).attr("name") == "email") {
	        $(".emailMsg").remove();
	        var email = val.value;
	        var regEmail = /^\w+@\w+((\.\w+)+)$/;
	        if (email == "" || email.trim() == "") {
	            errMsg = "<span class='emailMsg' style='color:#7d7d7d;'>邮箱不能为空</span>";
	            } else if (!regEmail.test(email)) {
	            errMsg = "<span class='emailMsg' style='color:#7d7d7d;'>邮箱账号@域名</span>";
	            } else {
	                errMsg = "<span class='emailMsg' style='color:#07456f;'>OK！</span>";
	            }
	        $(this).parent().append(errMsg);
	        }
	      });
	  });
	});
</script>
	
<?php include 'inc/footer.inc.php'?>