<?php 
if(!is_numeric($_POST['classify'])){
	skip('class_module_add.php','所属课程分类不得为空！');
}
$query="select * from t_consts_classify where id={$_POST['classify']}";
$result=execute($link,$query);
if(mysqli_num_rows($result)==0){
	skip('class_module_add.php','所属课程分类不存在！');
}
if(empty($_POST['name'])){
	skip('class_module_add.php','课程名称不得为空！');
}
if(mb_strlen($_POST['name'])>255){
	skip('class_module_add.php','课程名称不得多于255个字符！');
}
$_POST=escape($link,$_POST);
switch ($check_flag){
	case 'add':
		$query="select * from t_course where name='{$_POST['name']}'";
		break;
	case 'update':
		$query="select * from t_course where name='{$_POST['name']}' and id!={$_GET['id']}";
		break;
	default:
		skip('class_module.php','$check_flag参数错误！');
}
$result=execute($link,$query);
if(mysqli_num_rows($result)){
	skip('class_module_add.php','这个课程已经有了！');
}
if(empty($_POST['short_brief'])){
    skip('class_module_add.php','课程简述不得为空！');
}
if(mb_strlen($_POST['short_brief'])>100){
	skip('class_module_add.php','课程简介不得多于100个字符！');
}
if(!is_numeric($_POST['sort'])){
	skip('class_module_add.php','排序只能是数字！');
}
