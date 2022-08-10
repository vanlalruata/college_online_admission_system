  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Page Editor</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="?page=dashboard">Home</a></li>
              <li class="breadcrumb-item active">Page Editor</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <?php

        $title = '';
        $content = '';

        $requestType = $_SERVER['REQUEST_METHOD'];
         if($requestType == 'GET'){
            if(isset($_GET['pageid'])){
                require_once '../config/dbconfig.php';
                
                $mysqli = new mysqli(DBHOST, DBUSER, DBPWD, DBNAME);
                $query="select pagetitle, pagecontent from tbl_pages where id = " . $_GET['pageid'].";";
                $result = $mysqli->query($query);               

                $row = $result->fetch_row();  
                $title = $row[0];
                $content = $row[1];
            }
        }
    ?>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
         <form action="" method="post" enctype="multipart/form-data">
            <div class="card card-outline card-info">
                <div class="card-header">
                <h3 class="card-title">
                    Page ID: 
                    <small><?php if(isset($_GET['pageid'])) { echo $_GET['pageid']; } ?></small>
                    <input type = "hidden" value="<?php if(isset($_GET['pageid'])) { echo $_GET['pageid']; }?>" name="pageid">
                </h3>
                
                <!-- tools box -->
                <div class="card-tools">
                    <button type="button" class="btn btn-tool btn-sm" data-card-widget="collapse" data-toggle="tooltip"
                            title="Collapse">
                    <i class="fas fa-minus"></i></button>                
                </div>
                <!-- /. tools -->
                </div>
                <!-- /.card-header -->
                <div class="card-body pad">
                <div class="mb-3">
                    <input type="text" class="form-control" id="title" name="title" Placeholder="Add Title Here Eg: Home" value="<?php  echo $title; ?>">
                </div>

                <div class="mb-3">
                    <textarea class="textarea" id="description" name="description" placeholder="Place some text here"
                            style="width: 100%; height: 400px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?php echo htmlspecialchars_decode($content); ?></textarea>
                </div>
                <div class="mb-6">
                    <input type="hidden" name="action" value="editpage">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>              
                </div>
            </div>
          </form>
        </div>
        <!-- /.col-->
      </div>
      <!-- ./row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper --> 