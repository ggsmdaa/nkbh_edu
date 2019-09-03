<?php 
include_once '../inc/config.inc.php';
include_once '../inc/mysql.inc.php';
include_once '../inc/tool.inc.php';
include_once '../inc/upload.inc.php';
$template['title']='视频管理';
$link=connect();

if(!isset($_GET['id']) || !is_numeric($_GET['id'])){
    skip('class_module.php','id参数错误！');
}
$query="select * from t_course_section where id={$_GET['id']}";
$result_section=execute($link,$query);

if(!mysqli_num_rows($result_section)){
    skip('class_module.php','这条课程章节信息不存在！');
}
$data_section=mysqli_fetch_assoc($result_section);
if(isset($_POST['submit'])){
	$save_path='uploads'.date('/Y/m/d/');//写上服务器上文件系统的路径，而不是url地址
	$upload=upload($save_path,'45M','video_url',array('mp4'));
	if($upload['return']){
	    $query="update t_course_section set video_url='{$upload['save_path']}' where id={$_GET['id']}";
		execute($link, $query);
		if(mysqli_affected_rows($link)==1){
		  skip("chapter_module.php?id=$data_section[course_id]",'视频设置成功！');
		}else{
			skip("chapter_module.php?id=$data_section[course_id]",'视频设置失败，请重试');
		}
	}else{
		skip('class_module.php',$upload['error']);
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
                <h3>原视频：</h3>
                <video width="320" height="240" controls>
                    <source src="<?php if($data_section['video_url']!=''){echo $data_section['video_url'];}else{echo '暂无视频.mp4';}?>" type="video/mp4">
                您的浏览器不支持Video标签。
                </video>
    			<br/>
    			<hr/>
    			视频格式为MP4且视频大小不可超过40M！
    		</div>
    		<div style="margin:15px 0 0 0;">
    			<form method="post" enctype="multipart/form-data">
                    <input style="cursor:pointer;" width="100" type="file" name="video_url" />
                    <br /><br />
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