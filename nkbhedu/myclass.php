<?php 
include_once 'inc/config.inc.php';
include_once 'inc/mysql.inc.php';
include_once 'inc/tool.inc.php';
include_once 'inc/page.inc.php';
$link=connect();

$member_id=is_login($link);
if(!isset($_GET['id']) || !is_numeric($_GET['id'])){
	skip('index.php', '会员id参数不合法!');
}

$query="select * from t_user where id={$_GET['id']}";
$result_memebr=execute($link, $query);
if(mysqli_num_rows($result_memebr)!=1){
	skip('index.php','你所访问的会员不存在!');
}
$data_member=mysqli_fetch_assoc($result_memebr);

$template['title']='我的课程';
?>

<?php include 'inc/header.inc.php'?>


<div class="myclass-main">
  <!-- 左边导航栏 -->
  <div class="user-navigation">
    <ul>
      <li><a href="myclass.php?id=<?php echo $data_member['id'];?>"><i class="fas fa-book-reader"></i>&nbsp;&nbsp;我的课程</a></li>
      <li><a href="#"><i class="fas fa-pen-square"></i>&nbsp;&nbsp;我的笔记</a></li>
      <li><a href="#"><i class="fas fa-comment-dots"></i>&nbsp;&nbsp;我的讨论</a></li>
      <li><a href="#"><i class="fas fa-envelope-open-text"></i>&nbsp;&nbsp;个人信息</a></li>
    </ul>
  </div>


  <div class="my-course-main">
<?php 
$query="select t_user_course_section.id userlearnid,t_user_course_section.user_id,
								t_user_course_section.course_id,
							t_course.id,t_course.name,t_course.picture 
				from t_user_course_section,t_course 
				where t_user_course_section.user_id={$_GET['id']} and
							t_user_course_section.course_id=t_course.id 
				order by t_user_course_section.update_time";
$result_course=execute($link, $query);
while($data_course=mysqli_fetch_assoc($result_course)){
?>

    <div class="my-course-card">
      <div class="picture">
        <img src="admin/<?php echo $data_course['picture'];?>" style="width:190px;height:107px;"/>
        
        <?php 
        $url=urlencode("myclass_delete.php?id={$data_course['userlearnid']}");
        $return_url=urlencode($_SERVER['REQUEST_URI']);
        $message="你真的要删除课程 {$data_course['name']} 吗？";
        $delete_url="confirm.php?url={$url}&return_url={$return_url}&message={$message}";
        ?>

        <div><a href="<?php echo $delete_url?>" style="color:#aaa;margin-top:5px;">删除课程</a></div>
      </div>
      
      <div class="course-content">
				<h4><?php echo $data_course['name'];?></h4>
        
        <a href="user/learn.php?id=<?php echo $data_course['userlearnid'];?>"><button class="user-learn-btn">继续学习</button></a>
        
      </div>
    </div>
<?php }?>


  </div>
</div>


<?php include 'inc/footer.inc.php'?>