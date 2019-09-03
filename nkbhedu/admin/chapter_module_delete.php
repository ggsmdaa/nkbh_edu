<?php
include_once '../inc/config.inc.php';
include_once '../inc/mysql.inc.php';
include_once '../inc/tool.inc.php';
$template['title']='删除';
if(!isset($_GET['id']) || !is_numeric($_GET['id'])){
    skip('class_module.php','id参数错误！');
}

$link=connect();

$query_chapter="select * from t_course_section where id={$_GET['id']}";
$result_chapter=execute($link,$query_chapter);
$data_chapter=mysqli_fetch_assoc($result_chapter);
$query="delete from t_course_section where id={$_GET['id']}";
execute($link,$query);
if(mysqli_affected_rows($link)==1){
    $link=connect();
    $query_section="delete from t_course_section where parent_id={$_GET['id']}";
    execute($link,$query_section);
    skip("chapter_module.php?id=$data_chapter[course_id]","恭喜你删除成功！");
}else{
    skip("chapter_module.php?id=$data_chapter[course_id]","对不起删除失败，请重试！");
}

?>