<?php 
include_once '../inc/config.inc.php';
include_once '../inc/mysql.inc.php';
include_once '../inc/tool.inc.php';
$link=connect();
$member_id=is_login($link);
if(!$member_id){
	skip('index.php','你没有登录，不需要退出！');
}
setcookie('manage[username]','',time()-3600);
setcookie('manage[password]','',time()-3600);
setcookie('manage[id]','',time()-3600);
skip('index.php','退出成功！');
?>