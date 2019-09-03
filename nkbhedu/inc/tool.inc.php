<?php 
    function skip($url,$message){
$html=<<<A
    <meta http-equiv="refresh" content="3;URL={$url}" />
    <style>
    .notice{
    	width:40%;
    	heigth:40%;
    	margin:15% 30%;
        position: absolute;
        background-color:#ffffffe5;
        border:1px solid #eeeeee;
    	border-radius:5px;
    	padding:30px 0px;
    }
    .notice h3{
        text-align:center;
    	color:#3c4f65;
    	margin:50px 0px;
    }
    .notice p{
    	color:#3c4f65;
    	float:right;
    	margin:0px 20px;
    }
    .notice a{
    	text-align:center;
    	border-radius:2px;
    	margin:0px 10px;
    	padding:6px 10px;
    	color:#05445c;
    	float:right;
    }
    .notice a:hover{
    	text-decoration:none;
        color:#6b76ff;
    }
    </style>

    <body style="background-image:url('images/leaves.png');">
    <div class="notice">
        <h3> {$message}</h3>
        <p> 三秒后自动跳转！</p><br/>
        <a href="{$url}">点我立即跳转！</a>
    </div>
    </body>
    
  
A;
echo $html;
exit();
}


function is_login($link){
	if(isset($_COOKIE['nkbhoe']['username']) && isset($_COOKIE['nkbhoe']['password'])){
		$query="select * from t_user where username='{$_COOKIE['nkbhoe']['username']}' and sha1(password)='{$_COOKIE['nkbhoe']['password']}'";
		$result=execute($link,$query);
		if(mysqli_num_rows($result)==1){
			$data=mysqli_fetch_assoc($result);
			return $data['id'];
		}else{
			return false;
		}
	}else{
		return false;
	}
}
function is_manage_login($link){
	if(isset($_SESSION['manage']['username']) && isset($_SESSION['manage']['password'])){
		$query="select * from t_auth_user where username='{$_SESSION['manage']['username']}' and sha1(password)='{$_SESSION['manage']['password']}'";
		$result=execute($link,$query);
		if(mysqli_num_rows($result)==1){
			return true;
		}else{
			return false;
		}
	}else{
		return false;
	}
}
?>


