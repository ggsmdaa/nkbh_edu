<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <title><?php echo $template['title'] ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="res/css/bootstrap4.min.css">
    <script src="res/js/jquery-3.2.1.min.js"></script>
    <script src="https://cdn.staticfile.org/popper.js/1.12.5/umd/popper.min.js"></script>
    <script src="res/js/bootstrap4.min.js"></script>
    <link rel="stylesheet" type="text/css" href="res/style.css">
    <link rel="icon" type="image/png" href="res/img/ico.png" sizes="16x16">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

</head>

<!-- 滚动监听 -->
<body data-spy="scroll" data-target="#myScrollspy" data-offset="1" style="background:url('res/img/leaves-pattern.png');">
<!-- 头部导航栏-start -->

<nav class="navbar navbar-expand-sm navbar-dark" style="background-color: #384259f5;">
  <!-- logo -->
  <a class="navbar-brand" href="index.php">
    <img src="../res/img/logo.png" alt="logo" style="width:40px;">
  </a>
  <!-- Brand -->
  <a class="navbar-brand" href="index.php">南滨在线</a>
  <!-- Toggler/collapsibe Button 折叠按钮--> 
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button> 


  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      


      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          	课程
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">

    <?php 
    $query="select * from t_consts_classify order by sort";
    $result_classify=execute($link, $query);
    while($date_classify=mysqli_fetch_assoc($result_classify)){
?>
     <a class="dropdown-item" href="list.php?id=<?php echo $date_classify['id'];?>"><?php echo $date_classify['name']?></a>
<?php }?>  

          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="list_all.php">全部</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="http://binhai.nankai.edu.cn/">关于我们</a>
      </li>
    <?php 
        	  if($member_id){
$str=<<<A
                <li class="nav-item" >
                    <a class="nav-link" href="myclass.php?id={'$member_id'}" target="_blank">您好！{$_COOKIE['nkbhoe']['username']}</a>
                </li>
                <li class="nav-item" >
                    <a class="nav-link" href="logout.php">退出</a>
                </li>

A;
        	   echo $str;		
            }else{
$str=<<<A
                <li class="nav-item" >
                    <a  class="nav-link" href="login.php">登录/注册</a>
                </li>
A;
        		echo $str;
        	  }
        ?>

    </ul>

    <form class="form-inline my-2 my-lg-0" action="search.php" method="get">
      <input class="form-control mr-sm-2" name="keyword" type="search" placeholder="请输入搜索内容......" aria-label="Search" value="<?php if(isset($_GET['keyword']))echo $_GET['keyword']?>"/>
      <button class="btn btn-outline-secondary my-2 my-sm-0" type="submit">搜索</button>
    </form>
    

  </div>
</nav>

<!-- 头部导航栏-end -->