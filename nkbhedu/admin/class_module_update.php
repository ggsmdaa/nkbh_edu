<?php 
include_once '../inc/config.inc.php';
include_once '../inc/mysql.inc.php';
include_once '../inc/tool.inc.php';
$template['title']='课程修改页';
$link=connect();

if(!isset($_GET['id']) || !is_numeric($_GET['id'])){
	skip('class_module.php','id参数错误！');
}
$query="select * from t_course where id={$_GET['id']}";
$result=execute($link,$query);
if(!mysqli_num_rows($result)){
	skip('class_module.php','这条课程信息不存在！');
}
$date=mysqli_fetch_assoc($result);
if(isset($_POST['submit'])){
	//验证
	$check_flag='update';
	include 'inc/check_class_module.inc.php';
	$query="update t_course set classify='{$_POST['classify']}',name='{$_POST['name']}',brief='{$_POST['brief']}',short_brief='{$_POST['short_brief']}',sort='{$_POST['sort']}',finish='{$_POST['finish']}',recommend='{$_POST['recommend']}' where id={$_GET['id']}";
	execute($link,$query);
	if(mysqli_affected_rows($link)==1){
		skip('class_module.php','修改成功！');
	}else{
		skip('class_module.php','修改失败,请重试！');
	}
}
?>

<?php include 'inc/header.inc.php'?>

<style>
.the_full_title{
    text-align:center;
	color:#3c4f65;
    margin:20px;
}
</style>
<!--页面主要内容-->
<main class="lyear-layout-content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
          	<h4 class="the_full_title">修改课程&nbsp;：&nbsp;<?php echo $date['name']?></h4>
			  <form method="post" class="row">
              <div class="form-group col-md-12">
                <label for="title">所属课程分类</label>
                <select class="form-control" name="classify" size="1">
                <option value="0">======请选择一个课程分类======</option>
					<?php 
					$query="select * from t_consts_classify";
					$result_classify=execute($link,$query);
					while ($date_classify=mysqli_fetch_assoc($result_classify)){
						if($date['classify']==$date_classify['id']){
							echo "<option selected='selected' value='{$date_classify['id']}'>{$date_classify['name']}</option>";
						}else{
							echo "<option value='{$date_classify['id']}'>{$date_classify['name']}</option>";
						}
					}
					?>
				</select>
			  </div>

			  <div class="form-group col-md-12">
                <label for="title">课程名称</label>
                <input type="text" class="form-control" name="name" value="<?php echo $date['name']?>" />
              </div>
			  
			  <div class="form-group col-md-12">
          <label for="seo_description">简要介绍：<?php echo $date['short_brief']?></label>
          <textarea class="form-control" id="seo_description" name="short_brief" rows="2" ></textarea>
        </div>  
			  <div class="form-group col-md-12">
          <label for="seo_description">教学简介：<?php echo $date['short_brief']?></label>
          <textarea class="form-control" id="seo_description" name="brief" rows="7" ></textarea>
        </div>

          <div class="form-group col-md-12">
            <label for="sort">排序</label>
            <input type="text" class="form-control" name="sort" value="<?php echo $date['sort']?>" />
          </div>

              <div class="form-group col-md-12">
                <label for="status">状态</label>
                <div class="clearfix" style="margin:3px;">
                  <label class="lyear-radio radio-inline radio-primary">
                    <input type="radio" name="finish" value="0"><span>未结束</span>
                  </label>
                  <label class="lyear-radio radio-inline radio-primary">
                    <input type="radio" name="finish" value="1" checked><span>结束</span>
                  </label>
                </div>
                <div class="clearfix" style="margin:3px;">
                  <label class="lyear-radio radio-inline radio-primary">
                    <input type="radio" name="recommend" value="1"><span>推荐课程</span>
                  </label>
                  <label class="lyear-radio radio-inline radio-primary">
                    <input type="radio" name="recommend" value="0" checked><span>普通课程</span>
                  </label>
                </div>
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