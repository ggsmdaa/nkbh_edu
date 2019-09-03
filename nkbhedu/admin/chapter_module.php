<?php 
include_once '../inc/config.inc.php';
include_once '../inc/mysql.inc.php';
include_once '../inc/tool.inc.php';
$link=connect();

$template['title']='课程管理页';
?>

<?php include 'inc/header.inc.php'?>
<main class="lyear-layout-content">
  <div class="container-fluid">

    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-toolbar clearfix">
            <div class="toolbar-btn-action">
              <a class="btn btn-primary m-r-5" href="chapter_module_add.php?id=<?php echo $_GET['id']?>"><i class="mdi mdi-plus"></i> 新增</a>
            </div>
          </div>
          <div class="card-body">
            <div class="table-responsive">
            

                <?php 
                $query="select * from t_course_section where course_id={$_GET['id']} and parent_id=0";
                $result=execute($link,$query);
                while ($data=mysqli_fetch_assoc($result)){
                    $url=urlencode("chapter_module_delete.php?id={$data['id']}");
                    $return_url=urlencode($_SERVER['REQUEST_URI']);
                    $message="你真的要删除章节 {$data['name']} 吗？";
                    $delete_url="confirm.php?url={$url}&return_url={$return_url}&message={$message}";
?>
              <table class="table table-bordered">
                <thead>
                  <tr style="background: #e4f9f5;">
                    <th>章节编号：<?php echo $data['id']?></th>
                    <th>章节名：<?php echo $data['name']?></th>
                    <th>操作：
                        <div class="btn-group">
                            <a href="chapter_module_update.php?id=<?php echo $data['id']?>">[编辑]</a>
                            &nbsp;&nbsp;
                            <a href="section_module_add.php?id=<?php echo $data['id']?>">[添加]</a>
                            &nbsp;&nbsp;
                            <a href="<?php echo $delete_url?>">[删除]</a>
                        </div>
                    </th>
                  </tr>
                </thead>
                
                <?php 
	$query="select * from t_course_section where t_course_section.parent_id={$data['id']}";
	$result_section=execute($link, $query);
	if(mysqli_num_rows($result_section)){
        while ($data_section=mysqli_fetch_assoc($result_section)){
            $url_section=urlencode("section_module_delete.php?id={$data_section['id']}");
            $return_url_section=urlencode($_SERVER['REQUEST_URI']);
            $message_section="你真的要删除章节 {$data_section['name']} 吗？";
            $delete_url_section="confirm.php?url={$url_section}&return_url={$return_url_section}&message={$message_section}";
$html=<<<A
                <tbody>
                  <tr>
                  <th scope="row">{$data_section['id']}</th>
                  <td>{$data_section['name']}</td>
                    <td>
                      <div class="btn-group">
                        <a href="section_module_update.php?id={$data_section['id']}">[编辑]</a>
                        &nbsp;&nbsp;
                        <a href="section_module_video.php?id={$data_section['id']}">[视频管理]</a>
                        &nbsp;&nbsp;
                        <a href="$delete_url_section">[删除]</a>
                      </div>
                    </td>
                  </tr>
                </tbody>
A;
    echo $html;
}
	}else{
$none=<<<A
                <tbody>
                  <tr>
                    <th scope="row"></th>
                    <th><div style="padding:10px 0;">暂无子章节...</div></th>
                    <th></th>
	    
	               </tr>
	            </tbody>
A;
echo $none;
    } ?>  
              </table>
            
<?php }?>
        </div>    
          </div>
        </div>
      </div>
      
    </div>
    
  </div>
  
</main>
<!--End 页面主要内容--> 

<?php include 'inc/footer.inc.php'?>

