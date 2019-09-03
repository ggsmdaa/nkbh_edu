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
$data=mysqli_fetch_assoc($result);
if(!mysqli_num_rows($result)){
    skip('class_module.php','这条课程信息不存在！');
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
<?php
$query="select * from t_course where id={$_GET['id']}";
$result=execute($link,$query);
$data=mysqli_fetch_assoc($result);
?>
          	<h4 style="margin:20px;">
          		课程名&nbsp;：&nbsp;<?php echo $data['name']?>
          	</h4>
			<hr/>
			<div>
				<img src="<?php if($data['picture']!=''){echo $data['picture'];}else{echo 'course.png';}?>" style="width:300px;height:auto;margin-left:30px;" />
				<a class="btn btn-info" href="class_module_picture.php?id=<?php echo $data['id']?>" style="margin-left:50px;">设置图片</a>
			</div>
			<hr/>

          	<h4>课程章节列表&nbsp;：&nbsp;</h4>
			<?php 
  $query="select t_course.id,t_course_section.course_id,t_course_section.parent_id,
    t_course_section.name,t_course_section.id sectionID  
          from t_course,t_course_section 
          where t_course.id=t_course_section.course_id and t_course.id={$_GET['id']} 
            and t_course_section.parent_id=0";
	$result_chapter=execute($link, $query);
	if(mysqli_num_rows($result_chapter)){
        while ($data_chapter=mysqli_fetch_assoc($result_chapter)){
    ?>
            <!--手风琴效果-->
                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                  <div class="panel panel-cyan">
                    <div class="panel-heading" role="tab" id="heading<?php echo $data_chapter['sectionID']?>">
                      <h4 class="panel-title">
                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $data_chapter['sectionID']?>" aria-expanded="false" aria-controls="collapse<?php echo $data_chapter['sectionID']?>">
                          <?php echo $data_chapter['name']?>
                        </a>
                      </h4>
                    </div>
                    <div id="collapse<?php echo $data_chapter['sectionID']?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading<?php echo $data_chapter['sectionID']?>">
         <?php 
  $query_section="select * from t_course_section 
    where t_course_section.parent_id={$data_chapter['sectionID']}";
	$result_section=execute($link, $query_section);
	if(mysqli_num_rows($result_section)){
        while ($data_section=mysqli_fetch_assoc($result_section)){
$html=<<<A
                        
            <div class="panel-body">
                <h4>{$data_section['name']}（{$data_section['time']}）</h4>
                <p>创建时间：{$data_section['create_time']}</p>
                <p>创建人员：{$data_section['create_user']}</p>
                <p>更新时间：{$data_section['update_time']}</p>
                <p>更新人员：{$data_section['update_user']}</p>
            </div>
                   
A;
    echo $html;
}
	}else{
        echo '<div style="padding:10px 0;">暂无章节...</div>';
    } ?>      
                    
 					</div>
                  </div>
                </div>
                <!--手风琴效果 End-->
<?php }
	}else{
        echo '<div style="padding:10px 0;">暂无课程章节...</div>';
    }?>
			<hr/>
				<table class="table table-browse-center">
                  <div class="form-group col-md-12">
                    <label>所属课程分类&nbsp;&nbsp;：</label>
    					<label><?php 
    					$query_classify="select * from t_consts_classify where id={$data['classify']}";
    					$result_classify=execute($link,$query_classify);
    					$data_classify=mysqli_fetch_assoc($result_classify);
    					if($data_classify['id']!=''){
    					    echo "{$data_classify['name']}&nbsp;&nbsp;&nbsp;&nbsp;[分类编号：{$data['classify']}]";
    					}else{
    					   echo "找不到分类名！";
    				    }
    					?></label>
    			  </div>
    
    			  <div class="form-group col-md-12">
    				<label>课程编号&nbsp;&nbsp;：
    					<?php echo $data['id']?>
    				</label>
    			  </div>
    			  
    			  <div class="form-group col-md-12">
                    <label for="seo_description">简要介绍&nbsp;&nbsp;：</label>
                    <p>
                    	<?php if($data['short_brief']!='')
    					        {echo $data['short_brief'];}
    					      else
    					        {echo '暂无简介';}
    					?>
    				</p>	
                  </div>
                 
    			  <div class="form-group col-md-12">
                    <label for="seo_description">教学简介&nbsp;&nbsp;：</label>
                    <p>
                    	<?php if($data['brief']!='')
    					        {echo $data['brief'];}
    					      else
    					        {echo '暂无简介';}
    					?>
    				</p>	
                  </div>
    
                  <div class="form-group col-md-12">
                    <label for="sort">排序&nbsp;&nbsp;：
                    	<?php echo $data['sort']?>
                    </label>
                  </div>
    
                  <div class="form-group col-md-12">
                    <label for="status">状态&nbsp;&nbsp;：
                    	<?php if($data['finish']==0){
                    	           echo '课程还未结束';
                    	       }else if($data['finish']==1){
                    	           echo '课程已结束！';
                    	       }
                    	?>
                    </label>
                  </div>
                  
                  <div class="form-group col-md-12">
                    <label for="status">是否推荐&nbsp;&nbsp;：
                    	<?php if($data['recommend']==0){
                    	           echo '否';
                    	       }else if($data['finish']==1){
                    	           echo '是';
                    	       }
                    	?>
                    </label>
                  </div>
                  
                  
                  <div class="form-group col-md-12">
                    <label for="sort">课程创建时间&nbsp;&nbsp;：
                    	<?php echo $data['create_time']?>
                    </label>
                  </div>
                  
                  <div class="form-group col-md-12">
                    <label for="sort">创建课程人员&nbsp;&nbsp;：
                    	<?php echo $data['create_user']?>
                    </label>
                  </div>
                  
                  <div class="form-group col-md-12">
                    <label for="sort">课程最近更新时间&nbsp;&nbsp;：
                    	<?php echo $data['create_time']?>
                    </label>
                  </div>
                  
                  <div class="form-group col-md-12">
                    <label for="sort">更新课程人员&nbsp;&nbsp;：
                    	<?php echo $data['create_user']?>
                    </label>
                  </div>

                  <div class="form-group col-md-12">
                    <a href="class_module_update.php?id=<?php echo $data['id']?>" class="btn btn-primary">修改课程</a>
                    <a href="chapter_module.php?id=<?php echo $data['id']?>" class="btn btn-primary">修改课程章节</a>
                    <button type="button" class="btn btn-default" onclick="javascript:history.back(-1);return false;">返 回</button>
                  </div>
				</table>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
<!--End 页面主要内容-->
<?php include 'inc/footer.inc.php'?>