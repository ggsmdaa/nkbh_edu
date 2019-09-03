<?php
include_once 'inc/config.inc.php';
include_once 'inc/mysql.inc.php';
include_once 'inc/tool.inc.php';
$link=connect();
$member_id=is_login($link);
$template['title']='南滨在线学习平台';

?>
<?php include 'inc/header.inc.php'?>

<div class="course-nav-row clearfix">
<span class="hd">分类：</span>
<ul class="course-nav" type="none">
  <li class="course-nav-item cur-course-nav"><a href="list_all.php">全部</a></li>
    <?php 
    $query="select * from t_consts_classify order by sort desc";
    $result_classify=execute($link, $query);
    while($date_classify=mysqli_fetch_assoc($result_classify)){
?>
     <li class="course-nav-item"><a href="list.php?id=<?php echo $date_classify['id']?>"><?php echo $date_classify['name']?></a></li>
<?php }?>  
</ul>
</div>

<!-- 课程-start-->
<div class="main-content clearfix">	 
<div class="listpage">
  <h1 style="margin-bottom:20px;">课程
  <div class="btn-group float-right" role="group" aria-label="Basic example" style="margin-right: 17%;">
    <button type="button" class="btn btn-secondary">最新</button>
    <button type="button" class="btn btn-secondary">最热</button>
  </div>
  </h1>

    <?php 
	$query="select t_course.name,t_course.id,t_course.picture,t_course.classify,t_course.short_brief,t_consts_classify.name clfname,t_consts_classify.id clfid 
from t_course,t_consts_classify where t_course.classify=t_consts_classify.id";
	$result_course=execute($link, $query);
    while ($data_course=mysqli_fetch_assoc($result_course)){
          
        
    ?>
        <div class="course-card-container">
            <a href="class.php?id=<?php echo $data_course['id']?>">
                <div class="course-card-img">
                    <img src="admin/<?php if($data_course['picture']!=''){echo $data_course['picture'];}else{echo 'course.png';}?>">
                </div>
                <div class="course-card-content">
                    <h3 class="course-card-name"><?php echo $data_course['name']?></h3>
                    <p title="<?php echo $data_course['short_brief']?>"><?php echo $data_course['short_brief']?></p>
                    <div class="clearfix course-card-bottom">
        				<div class="course-card-info"><?php echo $data_course['clfname']?></div>
        			</div>
                </div>
            </a>
        </div>
<?php }?>


    </div></a>
    </div>
</div>
</div>
<!-- 课程-end-->


<?php include 'inc/footer.inc.php'?>