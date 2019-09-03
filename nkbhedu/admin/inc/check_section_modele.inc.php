<?php 
if(!is_numeric($_POST['parent_id'])){
	skip("section_module.php?id=$data_chapter[course_id]","所属章节不得为空！");
}
$query="select * from t_course_section where id={$_POST['parent_id']}";
$result=execute($link,$query);
if(mysqli_num_rows($result)==0){
	skip("section_module.php?id=$data_chapter[course_id]","所属章节不存在！");
}
if(empty($_POST['name'])){
	skip("section_module_add.php?id=$_GET[id]","章节名称不得为空！");
}
if(mb_strlen($_POST['name'])>255){
	skip("section_module_add.php?id=$_GET[id]","章节名称不得多于255个字符！");
}
$_POST=escape($link,$_POST);
switch ($check_flag){
	case 'add':
		$query="select * from t_course_section where name='{$_POST['name']}'";
		break;
	case 'update':
		$query="select * from t_course_setcion where name='{$_POST['name']}' and id!={$_GET['id']}";
		break;
	default:
		skip("section_module.php?id=$data_chapter[course_id]","$check_flag参数错误！");
}
$result=execute($link,$query);
if(mysqli_num_rows($result)){
	skip("section_module_add.php?id=$_GET[id]","这个课程已经有了！");
}

