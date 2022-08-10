  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Pages</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="?page=dashboard">Home</a></li>
              <li class="breadcrumb-item active">Pages</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid"> 
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Pages</h3>  
                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <div class="input-group-append">
                      <a href="?page=pageedit" class="btn btn-info float-right"><i class="fas fa-file-plus"></i>&nbsp;&nbsp;Add Page</a>
                    </div>
                  </div>
                </div>              
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0" style="height: 500px;">
                <table class="table table-head-fixed text-nowrap">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Title</th>
                      <th>Page Content</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>

                    <?php
                        require_once '../config/dbconfig.php';
                        $mysqli = new mysqli(DBHOST, DBUSER, DBPWD, DBNAME);
                        $query="select * from tbl_pages order by id ASC;";
                        $result = $mysqli->query($query); 

                        while($row = $result->fetch_row()){
                            echo '<tr>';
                            echo '<td>'. $row[0] .'</td>';
                            echo '<td>'. $row[1] .'</td>';
                            echo '<td>'. substr(strip_tags(html_entity_decode($row[2])), 0, 55) .'&hellip;</td>';
                            echo '<td><a href="?page=pageedit&pageid='. $row[0] .'" class="btn btn-info"><i class="far fa-edit nav-icon"></i>&nbsp;Edit</a>
                            <button class="btn btn-danger" data-toggle="modal" data-target="#modal-danger"><i class="far fa-trash-alt nav-icon"></i>&nbsp;Delete</button></td>';
                            echo '</tr>';
                        }

                    ?>                   
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->

      <div class="modal fade" id="modal-danger">
        <div class="modal-dialog">
          <div class="modal-content bg-danger">
            <div class="modal-header">
              <h4 class="modal-title">Confirm it!</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p>Are you sure to delete that? You have to contact the administrator to delete manually!</p>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-outline-light" data-dismiss="modal">OK</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->


    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

