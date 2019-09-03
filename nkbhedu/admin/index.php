<?php
include_once '../inc/config.inc.php';
include_once '../inc/mysql.inc.php';
include_once '../inc/tool.inc.php';
$link=connect();
$template['title']='后台管理首页';
if(!is_manage_login($link)){
  skip("login.php","你未登录，不可进行后台操作！");
}
?>
<?php include 'inc/header.inc.php'?>

<main class="lyear-layout-content">
  <div class="container-fluid">    
    
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-header">
            <h4>课程信息</h4>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>课程名称</th>
                    <th>授课教师</th>
                    <th>开始日期</th>
                    <th>最近更新</th>
                    <th>状态</th>
                  </tr>
                </thead>
                <tbody>
                
                
                <?php 
                $query="select * from t_course";
                $result=execute($link,$query);
                while ($data=mysqli_fetch_assoc($result)){
$html=<<<A
                <tr>
                    <td>{$data['id']}</td>
                    <td>{$data['name']}</td>
                    <td>{$data['create_user']}</td>
                    <td>{$data['create_time']}</td>
                    <td>{$data['update_time']}</td>
                    <td><span class="label label-warning">{$data['finish']}</span></td>
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


<?php include 'inc/footer.inc.php'?>