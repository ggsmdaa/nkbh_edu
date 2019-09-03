<!DOCTYPE html>
<html lang="zh">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title><?php echo $template['title'] ?></title>

<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/materialdesignicons.min.css" rel="stylesheet">
<link href="css/style.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

</head>
<?php 
$current_url=basename($_SERVER['SCRIPT_NAME']);//获取当前url地址
$arr_current=parse_url($current_url);//将当前url拆分到数组里面
$current_path=$arr_current['path'];//将文件路径部分保存起来
?>
<body>
<div class="lyear-layout-web">
  <div class="lyear-layout-container">
    <!--左侧导航-->
    <aside class="lyear-layout-sidebar">
      <div class="lyear-layout-sidebar-scroll" style="height: 100%;"> 
        <nav class="sidebar-main">
          <ul class="nav nav-drawer">
            <li class="nav-item <?php if($current_path=='main_module.php'){echo 'active';}?> " >
                <div style="padding:18px 20px;font-size: 22px;text-align: left;">
                <a href="index.php">首页</a> 
                </div>
            </li>
            <li class="nav-item nav-item-has-subnav 
                <?php if($current_path=='classify_module.php'
                       ||$current_path=='classify_module_add.php'
                       ||$current_path=='classify_module_delete.php'
                       ||$current_path=='classify_module_update.php')
                    {echo 'active open';}
                ?> ">
              <a href="javascript:void(0)"><i class="fas fa-align-left"></i> 课程分类管理</a>
              <ul class="nav nav-subnav">
              	<li class="<?php 
              	             if($current_path=='classify_module.php')
              	             {echo 'active';}
              	           ?>">
              		<a href="classify_module.php">分类列表</a>
              	</li>
              	<li class="<?php 
              	             if($current_path=='classify_module_add.php')
              	             {echo 'active';}
              	           ?>">
              	    <a href="classify_module_add.php">添加分类</a>
              	</li>

              	</ul>
            </li>
            <li class="nav-item nav-item-has-subnav 
                <?php 
                if($current_path=='class_module.php'
                 ||$current_path=='class_module_update.php'
                 ||$current_path=='class_module_add.php'
                 ||$current_path=='class_module_delete.php'
                 ||$current_path=='class_module_picture.php'
                 ||$current_path=='class_browse.php'
                    ||$current_path=='chapter_module.php'
                    ||$current_path=='chapter_module_add.php'
                    ||$current_path=='chapter_module_delete.php'
                      ||$current_path=='chapter_module_update.php'
                      ||$current_path=='section_browse.php'
                      ||$current_path=='section_module_add.php'
                      ||$current_path=='section_module_delete.php'
                      ||$current_path=='section_module_update.php'
                      ||$current_path=='section_module_video.php')
                {echo 'active open';}
                ?>">
              <a href="javascript:void(0)"><i class="fas fa-file-video"></i> 课程管理</a>
              <ul class="nav nav-subnav">
                <li class="
                    <?php 
                    if($current_path=='class_module.php')
                    {echo 'active';}
                    ?>">
                    <a href="class_module.php">课程列表</a> 
                </li>
                <?php 
    			if($current_path=='class_browse.php'
    			 ||$current_path=='class_module_delete.php'
    			 ||$current_path=='class_module_update.php'
    			    ||$current_path=='chapter_module.php'
    			    ||$current_path=='chapter_module_add.php'
    			    ||$current_path=='chapter_module_delete.php'
    			    ||$current_path=='chapter_module_update.php'
    			      ||$current_path=='section_module_add.php'
    			      ||$current_path=='section_module_delete.php'
                ||$current_path=='section_module_update.php'
                ||$current_path=='section_module_video.php')
                {
$nav=<<<A
                <li class="nav-item nav-item-has-subnav active active open">
                    <a href="#!">课程内容</a>
                    <ul class="nav nav-subnav open">


A;
                echo $nav;
 

                ?>
                        <li class="nav-item 
                        <?php 
                        if($current_path=='class_browse.php'
                            ||$current_path=='class_module_delete.php'
                            ||$current_path=='class_module_update.php')
                        {echo 'active';}
                        ?>">
                           <a href="#!">课程详情管理</a>
                        </li>
                        <li class="nav-item 
                        <?php 
                        if($current_path=='chapter_module.php'
                            ||$current_path=='chapter_module_add.php'
                            ||$current_path=='chapter_module_delete.php'
                            ||$current_path=='chapter_module_update.php'
                            ||$current_path=='section_module_add.php'
                            ||$current_path=='section_module_delete.php'
                            ||$current_path=='section_module_update.php'
                            ||$current_path=='section_module_video.php')
                        {echo 'active';}
                        ?>">
                            <a href="#!">章节管理</a>
                        </li>
                    </ul>
                </li>
<?php }?>
                <li class="
                    <?php 
                    if($current_path=='class_module_add.php')
                    {echo 'active';}
                    ?>"> 
                    <a href="class_module_add.php">添加课程</a> 
                </li>

              </ul>
            </li>
            <li class="nav-item ">
              <a href="../index.php"><i class="fas fa-home"></i> 网站首页</a>
            </li>
            <li class="nav-item ">
              <a href="logout.php"><i class="fas fa-sign-out-alt"></i> 退出登录</a>
            </li>
          </ul>
        </nav>
        

      </div>
      
    </aside>
<!--End 左侧导航-->

    <!--头部信息-->
    <header class="lyear-layout-header">
      
      <nav class="navbar navbar-default">
        <div class="topbar">
          
          <div class="topbar-left">
            <div class="lyear-aside-toggler">
              <span class="lyear-toggler-bar"></span>
              <span class="lyear-toggler-bar"></span>
              <span class="lyear-toggler-bar"></span>
            </div>
            <span class="navbar-page-title"></span>
          </div>
        </div>
      </nav>
      
    </header>
    <!--End 头部信息-->
