<?php 
include_once '../inc/config.inc.php';
include_once '../inc/mysql.inc.php';
include_once '../inc/tool.inc.php';

$link=connect();

$template['title']='添加课程章节';
if(isset($_POST['submit'])){
	//验证用户填写的信息
	$check_flag='add';
  include 'inc/check_chapter_module.inc.php';
	$query="insert into t_course_section(name,parent_id,course_id) values('{$_POST['name']}','0','{$_GET['id']}')";
	execute($link,$query);
	if(mysqli_affected_rows($link)==1){
		skip("chapter_module.php?id=$_GET[id]",'恭喜你，添加成功！');
	}else{
		skip("chapter_module.php?id=$_GET[id]",'对不起，添加失败，请重试！');
	}
}

?>

<?php include 'inc/header.inc.php'?>
<!--页面主要内容-->

<main class="lyear-layout-content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <form method="post" class="row">

              <div class="form-group col-md-12">
                <label for="title">章节名</label>
                <input type="text" class="form-control" name="name" placeholder="请输入章节名" />
              </div>
              <div class="form-group col-md-12">
                <input type="submit" name="submit" class="btn btn-primary ajax-post" value="添加"/>
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