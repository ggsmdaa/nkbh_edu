<?php 
include_once '../inc/config.inc.php';
include_once '../inc/mysql.inc.php';
include_once '../inc/tool.inc.php';
$template['title']='修改课程章节';
$link=connect();

if(!isset($_GET['id']) || !is_numeric($_GET['id'])){
	skip('chapter_module.php','id参数错误！');
}
$query="select * from t_course_section where id={$_GET['id']}";
$result=execute($link,$query);
$data=mysqli_fetch_assoc($result);
if(!mysqli_num_rows($result)){
	skip('chapter_module.php','此课程分类不存在！');
}
if(isset($_POST['submit'])){
	//验证
	$check_flag='update';
	include 'inc/check_chapter_module.inc.php';
	$query="update t_course_section set name='{$_POST['name']}' where id={$_GET['id']}";
  execute($link,$query);
	if(mysqli_affected_rows($link)==1){
		skip("chapter_module.php?id=$data[course_id]","修改成功！");
	}else{
		skip("chapter_module_update.php?id=$data[course_id]","修改失败,请重试！");
	}
}


?>

<?php include 'inc/header.inc.php'?>
<!--页面主要内容-->

<?php 
$query="select * from t_course_section where id={$_GET['id']}";
$result=execute($link,$query);
$data=mysqli_fetch_assoc($result);
?>
<main class="lyear-layout-content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <form method="post" class="row">
			  <div class="form-group col-md-12">
                <label for="title">修改课程章节&nbsp;:&nbsp;<?php echo $data['name']?></label>
              </div>
              <div class="form-group col-md-12">
                <label for="title">章节名&nbsp;：</label>
                <input type="text" class="form-control" name="name" value="<?php echo $data['name']?>" />
              </div>
              <div class="form-group col-md-12">
                <input type="submit" name="submit" class="btn btn-primary ajax-post" value="修改"></input>
                <button type="button" class="btn btn-default" onclick="javascript:history.back(-1);return false;">返 回</button>
              </div>
            </form>
   
          </div>
        </div>
      </div>
      
    </div>
    
  </div>
  
</main>
<!--End 页面主要内容-->
<?php include 'inc/footer.inc.php'?>
