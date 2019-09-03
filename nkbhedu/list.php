<?php
include_once 'inc/config.inc.php';
include_once 'inc/mysql.inc.php';
include_once 'inc/tool.inc.php';
$link=connect();
$member_id=is_login($link);
$template['title']='南滨在线学习平台';

if(!isset($_GET['id']) || !is_numeric($_GET['id'])){
    skip('index.php', '父版块id参数不合法!');
}
$query="select * from t_consts_classify where id={$_GET['id']}";
$result_classify=execute($link, $query);
if(mysqli_num_rows($result_classify)==0){
    skip('index.php', '父版块不存在!');
}
?>
<?php include 'inc/header.inc.php'?>

<div class="course-nav-row clearfix">
	<span class="hd">分类：</span>
    <ul class="course-nav" type="none">
      <li class="course-nav-item"><a href="list_all.php">全部</a></li>
        <?php 
        $query="select * from t_consts_classify order by sort desc";
        $result_classify=execute($link, $query);
        while($date_classify=mysqli_fetch_assoc($result_classify)){
    ?>
         <li class="course-nav-item <?php if($_GET['id']==$date_classify['id']){echo 'cur-course-nav';}?>"><a href="list.php?id=<?php echo $date_classify['id']?>"><?php echo $date_classify['name'];?></a></li>
    <?php }?>  
    </ul>
</div>

<!-- 课程-start-->
<div class="main-content clearfix">	 
    <div class="listpage">
      <h1 style="margin-bottom:20px;">
    	       课程
          <div class="btn-group float-right" role="group" aria-label="Basic example" style="margin-right: 17%;">
            <button type="button" class="btn btn-secondary">最新</button>
            <button type="button" class="btn btn-secondary">最热</button>
          </div>
      </h1>


    <?php 
	$query="select t_course.name,t_course.id,t_course.picture,t_course.classify,t_course.short_brief,t_consts_classify.name clfname,t_consts_classify.id clfid 
from t_course,t_consts_classify where t_course.classify=t_consts_classify.id and t_consts_classify.id={$_GET['id']}";
	$result_course=execute($link, $query);
	if(mysqli_num_rows($result_course)){
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
<?php }
	}else{
        echo '<div style="padding:10px 0;">暂无课程...</div>';
    }?>


    </div>
    </div>

<!-- 课程-end-->


<?php include 'inc/footer.inc.php'?>