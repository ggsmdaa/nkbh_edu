<?php
include_once '../inc/config.inc.php';
include_once '../inc/mysql.inc.php';
include_once '../inc/tool.inc.php';
$link=connect();

$template['title']='课程分类管理页';
?>

<?php include 'inc/header.inc.php'?>

<main class="lyear-layout-content">

  <div class="container-fluid">

    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-toolbar clearfix">
            <div class="toolbar-btn-action">
              <a class="btn btn-primary m-r-5" href="classify_module_add.php"><i class="mdi mdi-plus"></i> 新增</a>
        <!-- <a class="btn btn-danger" href="#!"><i class="mdi mdi-window-close"></i> 删除</a> -->
            </div>
          </div>

          <div class="card-body">

            <div class="table-responsive">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th>编号</th>
                    <th>课程分类名</th>
                    <th>排序</th>
                    <th>操作</th>
                  </tr>
                </thead>
                <tbody>

                <?php 
                $query="select * from t_consts_classify";
                $result=execute($link,$query);
                while ($data=mysqli_fetch_assoc($result)){
                    $url=urlencode("classify_module_delete.php?id={$data['id']}");
                    $return_url=urlencode($_SERVER['REQUEST_URI']);
                    $message="你真的要删除课程分类 {$data['name']} 吗？";
                    $delete_url="confirm.php?url={$url}&return_url={$return_url}&message={$message}";

$html=<<<A

                  <tr>
                    <th scope="row">{$data['id']}</th>
                    <td>{$data['name']}</td>
                    <td>{$data['sort']}</td>
                    <td>
                      <div class="btn-group">
                        <a href="classify_module_update.php?id={$data['id']}">[编辑]</a>&nbsp;&nbsp;
                        <a href="$delete_url">[删除]</a>
                      </div>
                    </td>
                  </tr>
                  
A;
			      echo $html;
		          }
		        ?> 
                </tbody>
              </table>
            </div>
   
          </div>
        </div>
      </div>
      
    </div>
    
  </div>
  
</main>
    <!--End 页面主要内容-->
    
<script type="text/javascript">

</script>
    
<?php include 'inc/footer.inc.php'?>