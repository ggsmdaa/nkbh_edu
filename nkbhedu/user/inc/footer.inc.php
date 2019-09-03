<!-- 返回顶部按钮 -->
<a class="go-top" href="#" title="返回顶部" id="go-top" style="display:none;"> 
  <i class="fas fa-angle-up"></i>
</a>
</div>

</body>
</html>

<script type="text/javascript">
$(document).ready(function () {
    isClosed = true;
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

//  二级隐藏课程：
//     隐藏内容：hide_course
//     点击：course_click
$("#course_click").click(function(){
  if($("#hide_course").css("display")=="none"){
    $("#hide_course").show();
  }else{
  $("#hide_course").hide();
  }
});

//鼠标移上去自动展开
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
  