<?php 
include_once '../inc/config.inc.php';
include_once '../inc/mysql.inc.php';
include_once '../inc/tool.inc.php';
$template['title']='章节添加页';
$link=connect();

if(!isset($_GET['id']) || !is_numeric($_GET['id'])){
    skip('class_module.php','id参数错误！');
}
$query_chapter="select * from t_course_section where id={$_GET['id']}";
$result_chapter=execute($link,$query_chapter);
$data_chapter=mysqli_fetch_assoc($result_chapter);
if(!mysqli_num_rows($result_chapter)){
    skip('class_module.php','这条课程章节信息不存在！');
}
if(isset($_POST['submit'])){
	//验证用户填写的信息
	$check_flag='add';
  include 'inc/check_section_modele.inc.php';
  
	$query="insert into t_course_section(parent_id,name,course_id) values('{$_POST['parent_id']}','{$_POST['name']}','{$data_chapter['course_id']}')";
	execute($link,$query);
	
	if(mysqli_affected_rows($link)==1){
		skip("chapter_module.php?id=$data_chapter[course_id]","恭喜你，添加成功！");
	}else{
		skip("chapter_module.php?id=$data_chapter[course_id]","对不起，添加失败，请重试！");
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
          	<h4 class="the_full_title">添加课程子章节</h4>
            <form method="post" class="row">
              <div class="form-group col-md-12">
                <label for="title">课程章节</label>
                <select class="form-control" name="parent_id" size="1">
                <option value="0">======请选择一个章节======</option>
                <?php 

                $query_parent="select * from t_course_section where parent_id=0";
                $result_parent=execute($link,$query_parent);
                
                while ($date_parent=mysqli_fetch_assoc($result_parent)){
                    if($_GET['id']==$date_parent['id']){
                        echo "<option selected='selected' value='{$date_parent['id']}'>{$date_parent['name']}</option>";
                    }else{
                        echo "<option value='{$date_parent['id']}'>{$date_parent['name']}</option>";
                    }
                }
                ?>
                </select>
              </div>

			  <div class="form-group col-md-12">
          <label for="title">子章节名称</label>
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


