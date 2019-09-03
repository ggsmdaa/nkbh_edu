<?php 
include_once '../inc/config.inc.php';
include_once '../inc/mysql.inc.php';
include_once '../inc/tool.inc.php';
?>

<?php include 'inc/header.inc.php'?>

<style>
.notice{
	width:40%;
	heigth:40%;
	margin:15% 35%;
    position: absolute;
    background-color:#ffffffe5;
    border:1px solid #eeeeee;
	border-radius:5px;
	padding:30px 0px;
}
.notice h2{
    text-align:center;
	color:#3c4f65;
	margin-bottom:50px;
}
.confirm_btn{
	margin-right:5%;
}
.notice a{
	text-align:center;
	background:#f3f8ff;
	border-radius:2px;
	margin:0px 10px;
	padding:6px 10px;
	color:#05445c;
	text-decoration:none;
	float:right;
	border:#105e62 solid 1px;
}
.notice a:hover{
	background:#deecff;
}
</style>
<body style="background-image:url('images/leaves.png');">
    <div class="notice">
    	<h2><?php echo $_GET['message']?></h2>
    	<div class="confirm_btn">
        	<a href="<?php echo $_GET['url']?>">
        		确定
        	</a>
        	<a href="<?php echo $_GET['return_url']?>">
        		取消
        	</a>
    	</div>
    </div>

<?php include 'inc/footer.inc.php'?>