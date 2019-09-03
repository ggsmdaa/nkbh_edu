<?php 
include_once '../inc/config.inc.php';
include_once '../inc/mysql.inc.php';
include_once '../inc/tool.inc.php';
$template['title']='修改课程分类';
$link=connect();

if(!isset($_GET['id']) || !is_numeric($_GET['id'])){
	skip('classify_module.php','id参数错误！');
}

if(isset($_POST['submit'])){
	//验证
	$check_flag='update';
	include 'inc/check_classify_module.inc.php';
  $query="update t_consts_classify set name='{$_POST['name']}',
    sort='{$_POST['sort']}' where id={$_GET['id']}";
	execute($link,$query);
	if(mysqli_affected_rows($link)==1){
		skip('classify_module.php','修改成功！');
	}else{
		skip('classify_module.php','修改失败,请重试！');
	}
}

$query="select * from t_consts_classify where id={$_GET['id']}";
$result=execute($link,$query);
$data=mysqli_fetch_assoc($result);
if(!mysqli_num_rows($result)){
	skip('classify_module.php','此课程分类不存在！');
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
          
          <?php 
          $query="select * from t_consts_classify where id={$_GET['id']}";
          $result=execute($link,$query);
          $data=mysqli_fetch_assoc($result);
          ?>

                <label for="title">修改课程分类&nbsp;:&nbsp;<?php echo $data['name']?></label>
              </div>
              <div class="form-group col-md-12">
                <label for="title">课程分类</label>
                <input type="text" class="form-control" name="name" value="<?php echo $data['name']?>" />
              </div>
              <div class="form-group col-md-12">
                <label for="sort">排序</label>
                <input type="text" class="form-control" name="sort" value="0" />
              </div>
              <div class="form-group col-md-12">
                <input type="submit" name="submit" class="btn btn-primary ajax-post" value="修改"/>
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