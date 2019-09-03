<?php 
include_once '../inc/config.inc.php';
include_once '../inc/mysql.inc.php';
include_once '../inc/tool.inc.php';
include_once '../inc/upload.inc.php';
$template['title']='图片设置';
$link=connect();

if(!isset($_GET['id']) || !is_numeric($_GET['id'])){
    skip('class_module.php','id参数错误！');
}
$query="select * from t_course where id={$_GET['id']}";
$result_course=execute($link,$query);
if(!mysqli_num_rows($result_course)){
    skip('class_module.php','这条课程信息不存在！');
}
$data_course=mysqli_fetch_assoc($result_course);
if(isset($_POST['submit'])){
	$save_path='uploads'.date('/Y/m/d/');//写上服务器上文件系统的路径，而不是url地址
	$upload=upload($save_path,'20M','picture',array('jpg','jpeg','gif','png'));
	if($upload['return']){
	    $query="update t_course set picture='{$upload['save_path']}' where id={$_GET['id']}";
		execute($link, $query);
		if(mysqli_affected_rows($link)==1){
		    skip("class_browse.php?id={$_GET['id']}",'图片设置成功！');
		}else{
			skip("class_browse.php?id={$_GET['id']}",'图片设置失败，请重试！');
		}
	}else{
		skip("class_module_picture.php?id={$_GET['id']}",$upload['error']);
	}
}

//SUB_URL.
?>

<style type="text/css">
.submit {
	background-color: #3b7dc3;
	color:#fff;
	padding:5px 22px;
	border-radius:2px;
	border:0px;
	cursor:pointer;
	font-size:14px;
}
</style>
<?php include 'inc/header.inc.php'?>
<main class="lyear-layout-content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
    		<div>
    			<h3>原图片：</h3>
    			<img src="<?php if($data_course['picture']!=''){echo $data_course['picture'];}else{echo 'course.png';}?>" />
    			<br/>
    			<hr/>
    			最佳图片尺寸：305*172
    		</div>
    		<div style="margin:15px 0 0 0;">
    			<form method="post" enctype="multipart/form-data">
    				<input style="cursor:pointer;" width="100" type="file" name="picture" /><br /><br />
    				<input class="submit" type="submit" name="submit" value="保存" />
    			</form>
    		</div>
		   </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</main>
<?php include 'inc/footer.inc.php'?>