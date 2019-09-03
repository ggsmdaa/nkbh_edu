<?php 
$member_id=is_login($link);
if(!$member_id=is_login($link)){
	skip('../login.php', '请登录之后再开始学习!');
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>南滨在线学习平台</title>
  <link href="../res/css/bootstrap3.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../res/style.css">
  <link rel="icon" type="image/png" href="../res/img/ico.png" sizes="16x16">
  <script src="../res/js/jquery-3.2.1.min.js"></script>
  <script src="../res/js/bootstrap3.min.js"></script>
  <!-- 图标、字体 -->	
  <script defer src="https://use.fontawesome.com/releases/v5.7.2/js/all.js" integrity="sha384-0pzryjIRos8mFBWMzSSZApWtPl/5++eIfzYmTgBBmXYdhvxPc+XcFEk+zJwDgWbP" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
</head>

<!-- <body style="background:#f7fbfc;"> -->
<body style="background:url(../res/img/white_wall_hash.png);">

 <!-- 滑动栏 -->	
<div id="wrapper">

 <nav class="navbar navbar-inverse navbar-fixed-top" id="sidebar-wrapper">
    <ul class="nav sidebar-nav">


