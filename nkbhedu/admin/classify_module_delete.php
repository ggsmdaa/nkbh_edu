<?php
include_once '../inc/config.inc.php';
include_once '../inc/mysql.inc.php';
include_once '../inc/tool.inc.php';
$template['title']='删除';
if(!isset($_GET['id']) || !is_numeric($_GET['id'])){
    skip('classify_module.php','id参数错误！');
}

$link=connect();

$query="delete from t_consts_classify where id={$_GET['id']}";
execute($link,$query);
if(mysqli_affected_rows($link)==1){
    $link_course=connect();
    $query_course="delete from t_course where classify={$_GET['id']}";
    execute($link_course,$query_course);
    skip('classify_module.php','恭喜你删除成功！');
}else{
    skip('classify_module.php','对不起删除失败，请重试！');
}
?>