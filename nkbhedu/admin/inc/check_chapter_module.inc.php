<?php 


if(empty($_POST['name'])){
	skip("chapter_module_add.php?id=$_GET[id]","课程章节名不得为空！");
}
if(mb_strlen($_POST['name'])>100){
	skip("chapter_module_add.php?id=$_GET[id]","课程章节名不得多于100个字符！");
}

$_POST=escape($link,$_POST);
switch ($check_flag){
	case 'add':
		$query="select * from t_course_section where name='{$_POST['name']}'";
		break;
	case 'update':
		$query="select * from t_course_section where name='{$_POST['name']}' and id!={$_GET['id']}";
		break;
	default:
		skip("chapter_module_add.php?id=$_GET[id]","$check_flag参数错误！");
}
$result=execute($link,$query);
if(mysqli_num_rows($result)){
	skip("chapter_module_add.php?id=$_GET[id]","这个章节名已经有了！");
}
?>