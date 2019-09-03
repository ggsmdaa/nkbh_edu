<?php 
include_once '../inc/config.inc.php';
include_once '../inc/mysql.inc.php';
include_once '../inc/tool.inc.php';
$template['title']='添加课程分类';
$link=connect();

if(isset($_POST['submit'])){
	//验证用户填写的信息
	$check_flag='add';
	include 'inc/check_classify_module.inc.php';
	$query="insert into t_consts_classify(name,sort) values('{$_POST['name']}','{$_POST['sort']}')";
	execute($link,$query);
	if(mysqli_affected_rows($link)==1){
		skip('classify_module.php','恭喜你，添加成功！');
	}else{
		skip('classify_module_add.php','对不起，添加失败，请重试！');
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
                <label for="title">课程分类</label>
                <input type="text" class="form-control" name="name" placeholder="请输入课程分类" />
              </div>
              <div class="form-group col-md-12">
                <label for="sort">排序</label>
                <input type="text" class="form-control" name="sort" value="0" />
              </div>
              <div class="form-group col-md-12">
                <input type="submit" name="submit" class="btn btn-primary ajax-post" value="添加"></input>
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