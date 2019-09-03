<?php
include_once '../inc/config.inc.php';
include_once '../inc/mysql.inc.php';
include_once '../inc/tool.inc.php';
$link=connect();
if(!$member_id=is_login($link)){
    skip('../login.php','你没有登陆，不能开始学习！');
  }
if(!isset($_GET['id']) || !is_numeric($_GET['id'])){
    skip('index.php', '课程id参数不合法!');
}
// 传过来的是课程id
$query_course="select * from t_course where id={$_GET['id']}";
$result_course=execute($link, $query_course);
if(mysqli_num_rows($result_course)==0){
    skip('index.php', '课程不存在!');
}

// 查找第一个章节
$query_insert_section="select * from t_course_section 
    where course_id={$_GET['id']} and parent_id!=0 order by id limit 1";
$result_insert_section=execute($link, $query_insert_section);
$data_insert_section=mysqli_fetch_assoc($result_insert_section);
if(empty($data_insert_section)){
    skip("../class.php?id=$_GET[id]", "课程暂无章节，不能开始学习!");
}

// 添加数据并检查
$query_insert="insert into t_user_course_section(course_id,user_id,section_id) 
    values('{$_GET['id']}','{$member_id}','{$data_insert_section['id']}')";
execute($link,$query_insert);
if(mysqli_affected_rows($link)==1){
    skip("../myclass.php?id=$member_id","恭喜你成功添加课程！");
}else{
    skip("../class.php?id=$_GET[id]",'对不起，出现了未知错误，添加课程失败！');
}
?>
