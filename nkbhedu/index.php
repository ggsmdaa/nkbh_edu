<?php
include_once 'inc/config.inc.php';
include_once 'inc/mysql.inc.php';
include_once 'inc/tool.inc.php';
$link=connect();
$member_id=is_login($link);
$template['title']='南滨在线学习平台';
?>
<?php include 'inc/header.inc.php'?>
<!-- 轮播-start -->
<div id="demo" class="carousel slide" data-ride="carousel">
    <!-- 指示符 -->
    <ul class="carousel-indicators">
      <li data-target="#demo" data-slide-to="0" class="active"></li>
      <li data-target="#demo" data-slide-to="1"></li>
      <li data-target="#demo" data-slide-to="1"></li>
    </ul>
   
    <!-- 轮播图片 -->
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="res/img/c1.jpg">
      </div>
      <div class="carousel-item">
        <img src="res/img/c2.jpg">
      </div>
      <div class="carousel-item">
        <img src="res/img/c3.jpg">
      </div>
    </div>
   
    <!-- 左右切换按钮 -->
    <a class="carousel-control-prev" href="#demo" data-slide="prev">
      <span class="carousel-control-prev-icon"></span>
    </a>
    <a class="carousel-control-next" href="#demo" data-slide="next" >
      <span class="carousel-control-next-icon"></span>
    </a>
</div>
<!-- 轮播-end -->

<!-- 右边主内容栏-start -->
<div class="container " style="padding: 10px 0;">
  <div class="d-flex flex-column">
 <!-- 推荐课程-start -->
  <div id="section1" >    
  <div class="p-2">
  <div class="main-content clearfix">	
    <div>
        <h1>推荐课程</h1>
        <label class="text-muted ">精选网校课程，满足你的学习兴趣。</label>
    </div>
	<?php 
	$query_recommend="SELECT * FROM t_course 
    WHERE recommend=1 ORDER BY sort limit 6";
	$result_recommend=execute($link, $query_recommend);
		while ($data_recommend=mysqli_fetch_assoc($result_recommend)){
    ?>
        <div class="course-card-container">
            <a href="class.php?id=<?php echo $data_recommend['id']?>">
                <div class="course-card-img">
                    <img src="admin/<?php if($data_recommend['picture']!=''){echo $data_recommend['picture'];}else{echo 'course.png';}?>">
                </div>
                <div class="course-card-content">
                    <h3 class="course-card-name">
                      <?php echo $data_recommend['name']?>
                    </h3>
                    <p title="<?php echo $data_recommend['short_brief']?>">
                      <?php echo $data_recommend['short_brief']?>
                    </p>
                </div>
            </a>
        </div>
<?php }?>
  </div> 
</div> 
</div> 
<!-- 推荐课程-end -->
<!-- 最新好课-start -->
  <div id="section2" > 
  <div class="p-2">
  <div class="main-content clearfix">
    <div>
      <h1>最新好课</h1>
      <label class="text-muted">看看老师们又有什么新的知识想要传授吧！</label>
    </div>
    
	<?php 
	$query="select * from t_course order by create_time desc limit 6 offset 0";
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
                </div>
            </a>
        </div>
<?php }?>
  </div> </div> </div> 
<!-- 最新好课-end -->

<div id="section3">
<!-- 讨论-start -->
  <div id="section31" >    
  <div class="p-2">

        <div class="main-content clearfix">     
            <div>
            	<h1><p>讨论</p></h1>
            	<label class="text-muted">有疑惑？说出来和大家一起解决！</label>
        	</div>
			<div style="width:85%;">
             	<div class="card-columns">
    
                <div class="card">
                  <div class="card-body" > 
                      <h5 class="card-title">土鸡蛋真的比养殖鸡蛋营养价值高么？</h5>
                      <p class="card-text text-muted">人们普遍认为土鸡蛋营养价值更高，有人去仔细了解过到底高在哪么？</p>
                      <a href="#" class="btn btn-primary">加入讨论</a>
                </div>
                </div>
          
                <div class="card">
                  <div class="card-body" > 
                      <h5 class="card-title">土鸡蛋真的比养殖鸡蛋营养价值高么？</h5>
                      <p class="card-text text-muted">人们普遍认为土鸡蛋营养价值更高，有人去仔细了解过到底高在哪么？</p>
                      <a href="#" class="btn btn-primary">加入讨论</a>
                </div>
                </div>
          
                <div class="card">
                  <div class="card-body" > 
                      <h5 class="card-title">土鸡蛋真的比养殖鸡蛋营养价值高么？</h5>
                      <p class="card-text text-muted">人们普遍认为土鸡蛋营养价值更高，有人去仔细了解过到底高在哪么？</p>
                      <a href="#" class="btn btn-primary">加入讨论</a>
                </div>
                </div>

          

          
             	</div>
       </div></div>
  </div>
  </div>
<!-- 讨论-end   -->
<!-- 活动-start -->
<div id="section32" >
  <div class="p-2">
	<div class="main-content clearfix">
      <div>
        <h1><p>活动</p></h1>
        <label class="text-muted">线下交流？活动宣传？</label>
      </div>  
      
      <div style="width:85%;">
      <div class="card-columns">
       

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">你选书，我买单——新书荐购会</h5>
              <p class="card-text text-muted">南开大学滨海学院图书馆</p>
            </div>
          </div>



        	<div class="card">
              <div class="card-body">
                <h5 class="card-title">“青年大学习”网上团课来啦！</h5>
                <p class="card-text text-muted">计算机团委</p>
              </div>
         	</div>



          <div class="card">
            <div class="card-body">
              <h5 class="card-title">践雷锋精神，行公益之心</h5>
              <p class="card-text text-muted">院团委</p>
            </div>
            </div>


       </div></div>
</div>
</div> 
</div>
<!-- 活动-end -->
</div>
<!-- 比赛信息-start -->
<div id="section4" >
  <div class="p-2">
  <div class="main-content clearfix"> 
    <div>        
      <h1><p>比赛信息</p></h1>
      <label class="text-muted">是时候检验下自己学到的知识了！</label>
    </div>  
      
    <div style="width:85%;">
    	<div class="card-columns">
    	
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Show英语，共赢10万大礼</h5>
                <p class="card-text text-muted">全国首届“图书馆杯全民英语口语风采展示活动”开启！</p>
              </div>
              </div>
        
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">多媒体大赛</h5>
                  <p class="card-text text-muted">第十五届“南开大学滨海学院多媒体大赛”作品征集中</p>
                </div>
               </div>
               
                <div class="card">
                  <div class="card-body">
                    <h5 class="card-title">高校微信小程序开发大赛</h5>
                    <p class="card-text text-muted">大赛面向全球高校在校生开放，旨在通过竞赛的方式提升学生进行Web应用的设计与开发能力。</p>
                  </div></div>

  </div>
    </div> 
  </div>
  </div> 
</div>
<!-- 比赛信息-end -->
</div> 

</div>
<!-- 右下角回到顶部和搜索-end -->
<!-- 右边主内容栏-end -->    
<nav id="myScrollspy" style="display:none;z-index: 999;">
<!-- 使用 .flex-column 设置垂直方向布局 -->
<ul class="nav nav-pills flex-column ">
  <li class="nav-item">
    <a class="nav-link active" href="#section1">推荐课程</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#section2">最新好课</a>
  </li>

  <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" data-toggle="dropdown" id="navbardrop" href="#">讨论/活动</a>
    <div class="dropdown-menu">
      <a class="dropdown-item" href="#section31">讨论</a>
      <a class="dropdown-item" href="#section32">活动</a>
    </div>
  </li>

  <li class="nav-item">
    <a class="nav-link" href="#section4">比赛信息</a>
  </li>
</ul>
</nav>

<?php include 'inc/footer.inc.php'?>