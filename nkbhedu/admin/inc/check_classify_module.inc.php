<?php 


if(empty($_POST['name'])){
	skip('classify_module_add.php','课程名不得为空！');
}
if(mb_strlen($_POST['name'])>100){
	skip('classify_module_add.php','课程分类不得多于100个字符！');
}
if(!is_numeric($_POST['sort'])){
    skip('classify_module_add.php','排序只能是数字！');
}
$_POST=escape($link,$_POST);
switch ($check_flag){
	case 'add':
		$query="select * from t_consts_classify where name='{$_POST['name']}'";
		break;
	case 'update':
		$query="select * from t_consts_classify where name='{$_POST['name']}' and id!={$_GET['id']}";
		break;
	default:
		skip('classify_module_add.php','$check_flag参数错误！');
}
$result=execute($link,$query);
if(mysqli_num_rows($result)){
	skip('classify_module_add.php','这个分类已经有了！');
}
?>