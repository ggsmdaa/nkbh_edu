<!-- 返回顶部按钮 -->
<a class="go-top" href="#" title="返回顶部" id="go-top" style="display:none;"> 
  <i class="fas fa-angle-up"></i>
</a>
<!-- 右边悬浮栏-end -->



<!--页脚-->
<div class="jumbotron jumbotron-fluid text-center" style="margin-bottom:0;background-color: #384259f5;">
  <a href="javascript:void(0);" target="_blank" title="联系我们" class="text-muted">联系我们</a> 
  <a href="javascript:void(0);" target="_blank" title="常见问题" class="text-muted">常见问题</a> 
  <a href="javascript:void(0);" target="_blank" title="意见反馈" class="text-muted">意见反馈</a>
  <a href="javascript:void(0);" target="_blank" title="友情链接" class="text-muted">友情链接</a>
  <span>&nbsp;|&nbsp;&nbsp;©&nbsp;2019&nbsp;备案</span>
</div>

</body>
</html>


<script type="text/javascript">

//返回顶部
$(function(){
  $("#go-top").click(function() {
      $("html,body").animate({scrollTop:0}, 500);
  }); 
 })

// 处于页面上方时自动隐藏右边两个悬浮按钮

$(window).scroll(function(){   //开始监听滚动条
  var top = $(document).scrollTop();  //滚动条距离顶部的高度
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
<?php 
@close($link);
?>
