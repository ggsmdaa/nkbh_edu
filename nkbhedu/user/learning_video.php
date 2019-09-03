<?php
include_once '../inc/config.inc.php';
include_once '../inc/mysql.inc.php';
include_once '../inc/tool.inc.php';
$link=connect();
$template['title']='南滨在线学习平台';

if(!isset($_GET['id'])||!is_numeric($_GET['id'])){
  skip('../index.php', '课程章节记录id参数不合法!');
}
$query_section="select * from t_course_section where id={$_GET['id']}";
$result_section=execute($link, $query_section);
$data_section=mysqli_fetch_assoc($result_section);
if(mysqli_num_rows($result_section)==0){
    skip("../myclass.php?id=$member_id", "课程章节不存在!");
}
?>
<?php
    if(!$member_id=is_login($link)){
    skip('../login.php','你没有登陆，不能进行后台操作！');
}
?>
<?php include 'inc/header.inc.php'?>
<!-- 传来的是课程章节section.id -->


<!-- 左边导航栏 -->
<?php 
$query_navfirst_name="select t_course.id,t_course.name,
        t_course_section.id sectionid,t_course_section.course_id 
    from t_course,t_course_section 
    where t_course_section.id={$_GET['id']}
    and t_course.id=t_course_section.course_id";
$result_navfirst_name=execute($link, $query_navfirst_name);
$data_navfirst_name=mysqli_fetch_assoc($result_navfirst_name);

$query_navfirst="select t_user_course_section.id,t_user_course_section.user_id,
        t_user_course_section.section_id,
        t_course_section.id sectionid 
    from t_user_course_section,t_course_section 
    where t_course_section.id={$_GET['id']}
    and t_user_course_section.user_id=$member_id";
$result_navfirst=execute($link, $query_navfirst);
$data_navfirst=mysqli_fetch_assoc($result_navfirst);
?>
  <li class="sidebar-brand"><a href="../class.php?id=<?php echo $data_navfirst_name['course_id']?>"><?php echo $data_navfirst_name['name']?></a></li>
  <li><a href="learn.php?id=<?php echo $data_navfirst['id']?>"><i class="fas fa-scroll"></i>&nbsp;&nbsp;公告</a></li>
  <li onmouseover="displaySubMenu(this)" onmouseout="hideSubMenu(this)" class="nav-second-color">
    <a href="#"><i class="fab fa-leanpub"></i>&nbsp;&nbsp;课程学习</a>
    <ul>
       <li><a href="#" id="course_click">章节</a></li>
       <li><a href="#">拓展阅读</a></li>
       <li><a href="learn_src.php?id=<?php echo $data_navfirst_name['sectionid']?>">资料</a></li>
       <li><a href="#">教材</a></li>
   </ul>  
</li>
  <li><a href="#"><i class="fas fa-pen"></i>&nbsp;&nbsp;笔记 </a></li>
  <li><a href="#"><i class="far fa-comment"></i>&nbsp;&nbsp;讨论 </a></li>
  <li>
    <a href="../myclass.php?id=<?php echo $member_id?>">
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
$query_navsecond_chapter="select * from t_course_section
        where course_id={$data_section['course_id']} 
            and parent_id=0";
$result_navsecond_chapter=execute($link, $query_navsecond_chapter);
if(mysqli_num_rows($result_navsecond_chapter)){
  while ($data_navsecond_chapter=mysqli_fetch_assoc($result_navsecond_chapter)){
      echo "<h4>$data_navsecond_chapter[name]</h4>"
?>
<?php 
    $query_navsecond_section="select * from t_course_section where parent_id={$data_navsecond_chapter['id']}";
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

<?php 
// 点进该页面就更新一次user section数据
if($_GET['id']!=$data_navfirst['section_id']){
  $query="update t_user_course_section set section_id={$_GET['id']} where course_id={$data_section['course_id']} and user_id={$member_id}";
  execute($link,$query);
}
?>

<!-- 视频 -->
<div class="course-video">
  <p>章节：<?php echo $data_section['name']?></p>                       
    <video controls>
        <source src="../admin/<?php if($data_section['video_url']!=''){echo $data_section['video_url'];}else{echo '暂无视频.mp4';}?>" type="video/mp4">
        您的浏览器不支持html5，建议使用Chrome浏览器！
    </video>
</div>
                                           
  <!-- 笔记 -->
<div style="margin:5% 10%;">
    <div >
        <span style="color:#000;">写笔记：</span>
        <span style="margin-left: 10px;color:#b8b8b8;">长度小于200</span>
    </div>
    <form id="commentForm" action="" method="post"  style="margin: 5px 0px;">
        <input type="hidden" id="commentType" name="type" value="0"/>
        <input type="hidden" name="sectionId" value=""/>
        <input type="hidden" name="courseId" value=""/>
        <textarea id="content" name="content" rows="10" cols="100"></textarea>
    </form>
    <input type="button" value="发布" class="btn" onclick=""/>
</div>


<!-- 笔记-start -->

<div class="old_comment">
    <div class="old_comment-main">
        <img class="header" src="../res/img/header.jpg"/>
        <span class="user-name">我是张三</span>
</div>
    <div class="old_comment-content">
      <ol>
        <li>数据结构三要素：逻辑结构、存储结构、数据的运算</li>
        <li>数据结构构成:
          <ul>
            <li>数据项：最小的数据单位；</li>
            <li>数据元素：是组成数据的、有一定意义的基本单位，主要由数据项构成；</li>
            <li>数据对象：是性质相同的数据元素的集合，是数据的子集，主要由数据元素构成；</li>
            <li>抽象数据类型：一个数学模型以及定义在此模型上的一组操作。其三个组成部分为：数据对象、数据关系和基本操作。可以用抽象数据类型完整定义数据结构。</li>
          </ul>
        </li>
      </ol>
      </div>
    <div class="old_comment-footer text-muted text-right">2018-10-01</div>
</div>
<div class="old_comment">
    <div class="old_comment-main">
        <img class="header" src="../res/img/header.jpg">
        <span class="user-name">我是李四</span>
    </div>
    <div class="old_comment-content">
      <ol>
        <li>数据结构三要素：逻辑结构、存储结构、数据的运算</li>
        <li>数据结构构成:
          <ul>
            <li>数据项：最小的数据单位；</li>
            <li>数据元素：是组成数据的、有一定意义的基本单位，主要由数据项构成；</li>
            <li>数据对象：是性质相同的数据元素的集合，是数据的子集，主要由数据元素构成；</li>
            <li>抽象数据类型：一个数学模型以及定义在此模型上的一组操作。其三个组成部分为：数据对象、数据关系和基本操作。可以用抽象数据类型完整定义数据结构。</li>
          </ul>
        </li>
      </ol></div>
    <div class="old_comment-footer text-muted text-right">2017-12-17</div>
</div>
</div>


<?php include 'inc/footer.inc.php'?>