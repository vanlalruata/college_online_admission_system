  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>User Lists</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="?page=dashboard">Home</a></li>
              <li class="breadcrumb-item active">User Lists</li>
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
                <h3 class="card-title">Users</h3>  
                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <div class="input-group-append">
                      <a href="?page=useredit" class="btn btn-info float-right"><i class="fas fa-user-plus"></i>&nbsp;&nbsp;Add User</a>
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
                      <th>Email</th>
                      <th>Full Name</th>
                      <th>Designation</th>
                      <th>Role</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>

                    <?php
                        require_once '../config/dbconfig.php';
                        $mysqli = new mysqli(DBHOST, DBUSER, DBPWD, DBNAME);
                        $query="select * from tbl_staff order by id ASC;";
                        $result = $mysqli->query($query); 

                        while($row = $result->fetch_row()){
                            echo '<tr>';
                            echo '<td>'. $row[0] .'</td>';
                            echo '<td>'. $row[1] .'</td>';
                            echo '<td>'. $row[3] .'</td>';
                            echo '<td>'. $row[5] .'</td>';
                            echo '<td>';
                                if((int)$row[6] === 1){ echo 'Principal'; } 
                                else if((int)$row[6] === 2){ echo 'Administrator'; } 
                                else if((int)$row[6] === 3){ echo 'Operator'; } 
                                else if((int)$row[6] === 4){ echo 'Staff'; } 
                                else { echo 'Unknown'; }                                 
                            echo '</td>';
                            if((($_SESSION['$role'] == '3') || ($_SESSION['$role'] == '4') || ($_SESSION['$role'] == '5')) && ((int)$row[6] != 1  || (int)$row[6] != 2)){
                                echo '<td><a href="" class="btn btn-info"><i class="far fa-edit nav-icon"></i>&nbsp;Edit</a>
                            <button class="btn btn-danger" data-toggle="modal" data-target="#modal-danger"><i class="far fa-trash-alt nav-icon"></i>&nbsp;Delete</button></td>';
                            }
                            
                            else{
                                echo '<td><a href="?page=useredit&userid='. $row[0] .'" class="btn btn-info"><i class="far fa-edit nav-icon"></i>&nbsp;Edit</a>
                                <button class="btn btn-danger" data-toggle="modal" data-target="#modal-danger-' . $row[0] . '"><i class="far fa-trash-alt nav-icon"></i>&nbsp;Delete</button></td>';
                                ?>
                                  <div class="modal fade" id="modal-danger-<?php echo $row[0]; ?>">
                                    <div class="modal-dialog">
                                      <div class="modal-content bg-danger">
                                        <div class="modal-header">
                                          <h4 class="modal-title">Confirm it!</h4>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                          </button>
                                        </div>
                                        <div class="modal-body">
                                          <p>Are you sure to delete this user? You will not be able to get it back anyway!</p>
                                        </div>
                                        <div class="modal-footer justify-content-between">
                                          <button type="button" class="btn btn-outline-light" data-dismiss="modal">No</button>
                                          <form action="" method="post">
                                          <input type="hidden" name="action" value="removeuser">
                                          <input type="hidden" name="id" value="<?php echo $row[0]; ?>">
                                          <button type="submit" class="btn btn-outline-light">Yes</button>
                                          </form>
                                        </div>
                                      </div>
                                      <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                  </div>
                                  <!-- /.modal -->
                                <?php
                            }

                            
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

