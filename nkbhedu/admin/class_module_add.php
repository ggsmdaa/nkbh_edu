
<?php 
include_once '../inc/config.inc.php';
include_once '../inc/mysql.inc.php';
include_once '../inc/tool.inc.php';
$link=connect();
$template['title']='课程添加页';

if(isset($_POST['submit'])){
	//验证用户填写的信息
	$check_flag='add';
	include 'inc/check_class_module.inc.php';
	$query="insert into t_course(classify,name,short_brief,brief,sort,finish,recommend,picture) values({$_POST['classify']},'{$_POST['name']}','{$_POST['short_brief']}','{$_POST['brief']}','{$_POST['sort']}','{$_POST['finish']}','{$_POST['recommend']}','course.png')";
	execute($link,$query);
	
	if(mysqli_affected_rows($link)==1){
		skip('class_module_add.php','恭喜你，添加成功！');
	}else{
		skip('class_module_add.php','对不起，添加失败，请重试！');
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
          	<h4 class="the_full_title">添加课程</h4>
            <form method="post" class="row" enctype="multipart/form-data">
              <div class="form-group col-md-12">
                <label for="title">课程分类</label>
                <select class="form-control" name="classify" size="1">
                <option value="0">======请选择一个课程分类======</option>
					<?php 
					$query="select * from t_consts_classify";
					$result_classify=execute($link,$query);
					while ($data_classify=mysqli_fetch_assoc($result_classify)){
						echo "<option value='{$data_classify['id']}'>{$data_classify['name']}</option>";
					}
					?>
				</select>
			  </div>

			  <div class="form-group col-md-12">
                <label for="title">课程名称</label>
                <input type="text" class="form-control" name="name" placeholder="请输入课程名" />
              </div>
			  
              <div class="form-group col-md-12">
                <label for="seo_description">简要介绍</label>
                <textarea class="form-control" id="seo_description" name="short_brief" rows="3"  placeholder="用一两句话描述一下课程内容（30字以内）"></textarea>
              </div>

              <div class="form-group col-md-12">
                <label for="seo_description">详情简介</label>
                <textarea class="form-control" id="seo_description" name="brief" rows="7"  placeholder="简要描述一下课程详情（100字以内）"></textarea>
              </div>
              
              <div class="form-group col-md-12">
                <label for="sort">排序（数字越大首页排的越后！）</label>
                <input type="text" class="form-control" name="sort" value="0" />
              </div>

              <div class="form-group col-md-12">
                <label for="status">状态</label>
                <div class="clearfix">
                  <label class="lyear-radio radio-inline radio-primary">
                    <input type="radio" name="finish" value="0"><span>未结束</span>
                  </label>
                  <label class="lyear-radio radio-inline radio-primary">
                    <input type="radio" name="finish" value="1" checked><span>结束</span>
                  </label>
                </div>
                <div class="clearfix" style="margin:3px;">
                  <label class="lyear-radio radio-inline radio-primary">
                    <input type="radio" name="recommend" value="0"><span>推荐课程</span>
                  </label>
                  <label class="lyear-radio radio-inline radio-primary">
                    <input type="radio" name="recommend" value="1" checked><span>普通课程</span>
                  </label>
                </div>
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


