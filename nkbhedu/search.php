<?php 
include_once 'inc/config.inc.php';
include_once 'inc/mysql.inc.php';
include_once 'inc/tool.inc.php';
include_once 'inc/page.inc.php';
$link=connect();
$member_id=is_login($link);

if(!isset($_GET['keyword'])){
	$_GET['keyword']='';
}
$_GET['keyword']=trim($_GET['keyword']);
$_GET['keyword']=escape($link,$_GET['keyword']);

$query_course="select count(*) from t_course where name like '%{$_GET['keyword']}%'";
$count_course=num($link,$query_course);

$template['title']='搜索页';
?>
<?php include 'inc/header.inc.php'?>

<div class="main-content clearfix">	 
<div class="listpage">

		<h3 style="margin-bottom:20px;">一共搜索到<?php echo $count_course?>个课程</h3>

		<div style="clear:both;"></div>

			<?php 
			$page=page($count_course,20);
			$query="select t_course.id,t_course.name,t_course.classify,t_course.picture,t_course.short_brief,
                           t_consts_classify.id clfid,t_consts_classify.name clfname
                            from t_course,t_consts_classify 
                            where t_course.name like '%{$_GET['keyword']}%' 
                                  and t_consts_classify.id=t_course.classify
			{$page['limit']}";
			$result_course=execute($link,$query);
			while($data_course=mysqli_fetch_assoc($result_course)){
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
	
    </div>
    </div>	

<nav aria-label="Page navigation example">
	<ul class="pagination justify-content-center">
		<?php 
		echo $page['html'];
		?>
	</ul>
</nav>

<?php include 'inc/footer.inc.php'?>