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



<div id="course_pdf" class="course_pdf">
    <embed src="../res/示范pdf.pdf" type="application/pdf" width="100%" height="550px">
  </div>

</div>
        
<a class="go-top-blackground" href="#" title="返回顶部" id="go-top" style="display:none;"> 
    <i class="fas fa-angle-up"></i>
  </a>

</body>
</html>

<script type="text/javascript">
  
  $(document).ready(function () {
      isClosed = false;
		  $('.hamburger').click(function () {
      hamburger_cross();      
    });
    function hamburger_cross() {
      if (isClosed == true) {          
        $('.overlay').hide();
        isClosed = false;
      } else {   
        $('.overlay').show(); 
        isClosed = true;
      }
    }
		$('[data-toggle="offcanvas"]').click(function () {
		  $('#wrapper').toggleClass('toggled');
    }); 
  }); 

    $("#course_click").click(function(){
	    if($("#hide_course").css("display")=="none"){
	  	  $("#hide_course").show();
	    }else{
	  	$("#hide_course").hide();
	    }
    });
    
//js鼠标移上去自动展开
function displaySubMenu(li) {            
  var subMenu = li.getElementsByTagName("ul")[0];
  subMenu.style.display = "block";
  }     
function hideSubMenu(li) {
    var subMenu = li.getElementsByTagName("ul")[0];             
    subMenu.style.display = "none";  
}

$(window).scroll(function(){
  var top = $(document).scrollTop();
  console.log(top)
  if(top > 70 ) {
    $('#go-top').fadeIn();
  }else{
    $('#go-top').fadeOut();
  }

  if(top > 70 ) {
    $('#myScrollspy').fadeIn();
  }else{
    $('#myScrollspy').fadeOut();
  }
})
</script>