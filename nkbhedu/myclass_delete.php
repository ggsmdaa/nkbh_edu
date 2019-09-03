<?php 
include_once 'inc/config.inc.php';
include_once 'inc/mysql.inc.php';
include_once 'inc/tool.inc.php';
$link=connect();
$member_id=is_login($link);
if(!isset($_GET['id']) || !is_numeric($_GET['id'])){
	skip("myclass.php?id={$member_id}",'id参数错误！');
}

$query="delete from t_user_course_section where id={$_GET['id']}";
execute($link,$query);
if(mysqli_affected_rows($link)==1){
	skip("myclass.php?id={$member_id}",'恭喜你删除成功！');
}else{
	skip("myclass.php?id={$member_id}",'对不起删除失败，请重试！');
}
?>
