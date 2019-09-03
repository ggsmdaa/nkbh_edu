<?php
include_once 'inc/config.inc.php';
include_once 'inc/mysql.inc.php';
include_once 'inc/tool.inc.php';
$link=connect();
$member_id=is_login($link);
$template['title']='南滨在线学习平台';

if(!isset($_GET['id']) || !is_numeric($_GET['id'])){
    skip('index.php', '课程id参数不合法!');
}
$query="select * from t_course where id={$_GET['id']}";
$result_course=execute($link, $query);
$date=mysqli_fetch_assoc($result_course);
if(mysqli_num_rows($result_course)==0){
    skip('index.php', '课程不存在!');
}
?>
<?php include 'inc/header.inc.php'?>


<!-- 基本信息-start -->
<div class="main-course">

	<div class="d-flex">
    <div class="p-2 course_module_img">
        <img class="radius-img" src="admin/<?php if($date['picture']!=''){echo $date['picture'];}else{echo 'course.png';}?>">
    </div>
    <div class="p-2 flex-grow-1">
      <div class="flex-column">
        <div class="course-title d-flex justify-content-start"><?php echo $date['name']?></div>
          <div class="d-flex justify-content-end">
            <?php 
            if($member_id=is_login($link)){
              $query="select * from t_user_course_section where course_id={$_GET['id']} and user_id={$member_id}";
              $result=execute($link, $query);
              $data=mysqli_fetch_assoc($result);
              if($data!=NULL){
                echo "<a href='user/learn.php?id=$data[id]' class='learn-btn' >继续学习</a>";
              }else{
                echo "<a href='user/startlearning.php?id=$_GET[id]' class='learn-btn' >开始学习</a>";
              }
            }else{
                echo "<a href='user/learn.php' class='learn-btn' >开始学习</a>";
              }
            ?>
          </div>
        </div>
      </div>
    </div>
    <div class="course-brief ">
		  <?php echo $date['brief']?>
    </div>
</div>
<!-- 基本信息-end -->


<!-- 课程内容-start -->
<div class="d-flex">
<!-- 左边栏 -->
  <div class="class-container">

    <div class="p-2 flex-shrink-1 w-100">

      <div class="class-container-bar">
        <ul class="nav nav-tabs">
          <li class="nav-item">
              <a class="nav-link" href="class.php?id=<?php echo $_GET['id']?>">课程详情</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="commend.php?id=<?php echo $_GET['id']?>">评论</a>
          </li>
        </ul>
      </div>

<!-- 评论-start -->

<div class="comment clearfix">
    <div class="comment-main">
        <img class="comment-header" src="../res/img/header.jpg">
        <span class="user-name">我是张三</span>
    </div>
    <div class="comment-content">这门课真实用！</div>
    <div class="comment-footer text-muted text-right">2018-10-01</div>
</div>


<div class="comment clearfix">
    <div class="comment-main">
        <img class="comment-header" src="../res/img/header.jpg">
        <span class="user-name">我是李四</span>
    </div>
    <div class="comment-content">for (int i = 0; i < 10000; i ) printf("讲的太好了！！！\n");</div>
    <div class="comment-footer text-muted text-right">2017-12-17</div></div>
</div>

<!-- 评论-end -->
  </div>

  <!-- 右边栏 -->
  <div class="p-2">
    <!-- 课程须知 -->
    <div class="class-container-right">
        <h4 class="mt-50">课程须知</h4>
        <li class="text-muted">
            由于本门课程是以C++为编码实现的，所以需要大家熟练掌握C++语言基础语法。</p>
        <li class="text-muted">
            本课程是程序世界中的核心课程</li></a>
    </div>
    <!-- 学到什么 -->
    <div class="class-container-right">
      <h4 class="mt-50">老师告诉你能学到什么？</h4>
      <li class="text-muted">
          什么是数据结构实现原理</li></a>
      <li class="text-muted">
          如何设计类，如何完善类的设计</li></a>
      <li class="text-muted">
          如何实现队列的相关函数</li></a>
      <li class="text-muted">
          如何检验代码的正确性，如何完善代码</li></a>
      <li class="text-muted">
          如何与实际相结合，利用数据结构解决实际问题</li></a>
    </div>

    <!-- 推荐课程 - start -->
    <div class="class-container-right">
      <h4 class="mt-50">推荐课程</h4>

      <?php 
	$query_recommend="select * from t_course where recommend=1 order by sort limit 6";
	$result_recommend=execute($link, $query_recommend);
		while ($data_recommend=mysqli_fetch_assoc($result_recommend)){
$html=<<<A
            <a href="class.php?id=$data_recommend[id]" class="text-muted">
              <li class="ellipsis oc-color-hover">$data_recommend[name]</li>
            </a>
A;
  echo $html;
}?>

    </div>
    <!-- 推荐课程 - end -->	
  </div>
</div>
<!-- 课程内容-end -->
<!-- 课程-end-->


<?php include 'inc/footer.inc.php'?>