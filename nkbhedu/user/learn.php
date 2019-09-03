<?php
include_once '../inc/config.inc.php';
include_once '../inc/mysql.inc.php';
include_once '../inc/tool.inc.php';
$link=connect();
$template['title']='南滨在线学习平台';

if(!isset($_GET['id'])||!is_numeric($_GET['id'])){
  skip('../index.php', '课程章节记录id参数不合法!');
}
$query_usersection="select * from t_user_course_section where id={$_GET['id']}";
$result_usersection=execute($link, $query_usersection);
$data_usersection=mysqli_fetch_assoc($result_usersection);
if(mysqli_num_rows($result_usersection)==0){
    skip('../index.php', '章节记录不存在!');
}
?>
<?php
    if(!$member_id=is_login($link)){
    skip('../login.php','你没有登陆，不能进行后台操作！');
}
?>
<?php include 'inc/header.inc.php'?>
<!-- 传来的是用户选择课程表的 id -->
<?php 
$query_navfirst="select t_user_course_section.id,t_user_course_section.user_id,
            t_user_course_section.course_id,
            t_course.id courseid,t_course.name 
from t_user_course_section,t_course
where t_user_course_section.id={$_GET['id']} 
      and t_user_course_section.course_id=t_course.id";
$result_navfirst=execute($link, $query_navfirst);
$data_navfirst=mysqli_fetch_assoc($result_navfirst);
?>
  <li class="sidebar-brand"><a href="../class.php?id=<?php echo $data_navfirst['course_id']?>"><?php echo $data_navfirst['name']?></a></li>
  <li><a href="learn.php?id=<?php echo $data_navfirst['id']?>"><i class="fas fa-scroll"></i>&nbsp;&nbsp;公告</a></li>
  <li onmouseover="displaySubMenu(this)" onmouseout="hideSubMenu(this)" class="nav-second-color">
    <a href="#"><i class="fab fa-leanpub"></i>&nbsp;&nbsp;课程学习</a>
    <ul>
       <li><a href="#" id="course_click">章节</a></li>
       <li><a href="#">拓展阅读</a></li>
       <li><a href="learn_src.php?id=<?php echo $_GET['id']?>">资料</a></li>
       <li><a href="#">教材</a></li>
   </ul>  
</li>
  <li><a href="#"><i class="fas fa-pen"></i>&nbsp;&nbsp;笔记 </a></li>
  <li><a href="#"><i class="far fa-comment"></i>&nbsp;&nbsp;讨论 </a></li>
  <li>
    <a href="../myclass.php?id=<?php echo $data_navfirst['user_id']?>">
      <i class="fas fa-book-open"></i>&nbsp;&nbsp;我的学习 
    </a>
  </li>
</ul>
</nav>
<!-- 滑动导航按钮 -->
<div id="page-content-wrapper">
<button type="button" class="hamburger is-closed animated fadeInLeft" data-toggle="offcanvas">
<i class="fas fa-bars fa-xs"></i>
</button>
<!-- style="display:none"默认隐藏 -->
<!--二层课程-->
<div class="hide_charpter" id="hide_course" style="display:none;">
<ul class="course" >
<!-- 章节名 -->
<?php 
$query_navsecond_chapter="select t_course_section.course_id sectionCourseid,
    t_course_section.parent_id,t_course_section.name,
    t_course_section.id sectionID,
      t_user_course_section.id,t_user_course_section.course_id 
        from t_user_course_section,t_course_section 
        where t_user_course_section.course_id=t_course_section.course_id 
            and t_user_course_section.id={$_GET['id']} 
            and t_course_section.parent_id=0";
$result_navsecond_chapter=execute($link, $query_navsecond_chapter);
if(mysqli_num_rows($result_navsecond_chapter)){
  while ($data_navsecond_chapter=mysqli_fetch_assoc($result_navsecond_chapter)){
      echo "<h4>$data_navsecond_chapter[name]</h4>"
?>
<?php 
    $query_navsecond_section="select * from t_course_section where t_course_section.parent_id={$data_navsecond_chapter['sectionID']}";
    $result_navsecond_section=execute($link, $query_navsecond_section);
    if(mysqli_num_rows($result_navsecond_section)){
      while ($data_navsecond_section=mysqli_fetch_assoc($result_navsecond_section)){
        echo "<a href='learning_video.php?id=$data_navsecond_section[id]' ><li>$data_navsecond_section[name]</li></a>";
      }
    }else{
      echo '<li>暂无子章节...</li>';
    } 
  }
}else{
    echo '<h4>暂无课程章节...</h4>';
}?>   
  </ul>
</div>
</div>



<div class="learn-annocement-main">
  <div class="left">
<!-- 欢迎 -->
  <div class="welcome">
    <div class="welcome_card">
      
    <?php
    $query_user="select * from t_user where id={$member_id}";
    $result_user=execute($link, $query_user);
    $data_user=mysqli_fetch_assoc($result_user);
    ?>

      <p>亲爱的 &nbsp;<?php echo $data_user['username'] ?>&nbsp;，欢迎回来～</p>
      <p>你上一次学习到 &nbsp;
        <?php 
            $query_learndate="select t_user_course_section.id userlearnid,
                t_user_course_section.section_id,
                t_course_section.id sectionid,t_course_section.name,
                t_course_section.video_url
              from t_user_course_section,t_course_section 
              where t_user_course_section.id={$_GET['id']}
                and t_user_course_section.section_id=t_course_section.id";
            $result_learndate=execute($link, $query_learndate);
            $data_learndate=mysqli_fetch_assoc($result_learndate);
         echo "<a href='learning_video.php?id=$data_learndate[section_id]'>$data_learndate[name]</a>";
        ?>
       
      </p>
    </div>
    <a href="learning_video.php?id=<?php echo $data_learndate['section_id']?>" class="btn">继续学习</a>
  </div>
<!-- 公告 -->
  <div class="annocement">
    <h1>公告</h1>
  <div class="content-main">
    <div class="title">
        <h2>关于数据结构第二次课</h2>
    </div>
    <div class="main">
        <p>本次课程将从二分查找问题开始，介绍一种重要的数据结构--树。本次课程将从二分查找问题开始，介绍一种重要的数据结构--树。</p>
        <p style="color:#59c0c0;">本次课程将从二分查找问题开始，介绍一种重要的数据结构--树。本次课程将从二分查找问题开始，介绍一种重要的数据结构--树。</p>
        <p style="color:#ca6943;">本次课程将从二分查找问题开始，介绍一种重要的数据结构--树。</p>
        <p style="color:#78ad71;">本次课程将从二分查找问题开始，介绍一种重要的数据结构--树。本次课程将从二分查找问题开始，介绍一种重要的数据结构--树。</p>
        <p style="color:#d5e038;">本次课程将从二分查找问题开始，介绍一种重要的数据结构--树。</p>
    </div>
  </div>
  <div class="content-main">
    <div class="title">
      <h2>关于数据结构第三次课</h2>
    </div>
    <div class="main">
      <p>本次课程将从二分查找问题开始，介绍一种重要的数据结构--树。</p>
      <p>本次课程将从二分查找问题开始，介绍一种重要的数据结构--树。</p>
      <p>本次课程将从二分查找问题开始，介绍一种重要的数据结构--树。本次课程将从二分查找问题开始，介绍一种重要的数据结构--树。</p>
      <p>本次课程将从二分查找问题开始，介绍一种重要的数据结构--树。</p>
      <p>本次课程将从二分查找问题开始，介绍一种重要的数据结构--树。</p>
    </div>
  </div>
  </div>
  </div>

  <div class="right">
    <!-- 最近更新 -->
    <div class="update">
      <h4>最近更新课程内容</h4>
      <ul>

    <?php 
    $query_update="select t_user_course_section.id,t_user_course_section.course_id,
                  t_course_section.id sectionid,t_course_section.name,
                  t_course_section.update_time,t_course_section.course_id 
     from t_user_course_section,t_course_section 
     where t_user_course_section.id={$_GET['id']} 
          and t_course_section.course_id=t_user_course_section.course_id 
     order by t_course_section.update_time desc 
     limit 4 offset 0";
    $result_update=execute($link, $query_update);
    while($data_update=mysqli_fetch_assoc($result_update)){
      echo "<a href='learning_video.php?id=$data_update[sectionid]'><li>$data_update[name]</li></a>";
    }
    ?>

      </ul>
    </div>
  </div>
</div>



<?php include 'inc/footer.inc.php'?>