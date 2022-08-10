  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Admission Lists</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="?page=dashboard">Home</a></li>
              <li class="breadcrumb-item active">Admission Lists</li>
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
                <h3 class="card-title">Open Application</h3>  
                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <div class="input-group-append">
                      <a href="?page=addadmission" class="btn btn-info float-right"><i class="fas fa-file-medical"></i>&nbsp;&nbsp;Add Admission</a>
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
                      <th>Session Year</th>
                      <th>Start Date</th>
                      <th>Close Date</th>
                      <th>Edit Till</th>
                      <th>Declaration</th>
                      <th>Status</th>
                      <th>Prefix</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>

                    <?php
                        require_once '../config/dbconfig.php';
                        $mysqli = new mysqli(DBHOST, DBUSER, DBPWD, DBNAME);
                        $query="select * from tbl_adm_application order by id ASC;";
                        $result = $mysqli->query($query); 

                        while($row = $result->fetch_row()){
                            echo '<tr>';
                            echo '<td>'. $row[0] .'</td>';
                            echo '<td>'. $row[1] .'</td>';
                            echo '<td>' . date('d-m-Y', strtotime($row[2])) .'</td>';
                            echo '<td>' . date('d-m-Y', strtotime($row[3])) .'</td>';
                            echo '<td>' . date('d-m-Y', strtotime($row[4])) .'</td>';
                            echo '<td>'. substr($row[5], 0 , 15) .' &hellip;</td>';
                            echo '<td>'. $row[6] .'</td>';
                            echo '<td>'. $row[7] .'</td>';   
                            if($_SESSION['$role'] != '1' && $_SESSION['$role'] != '2'){
                                echo '<td><a href="" class="btn btn-info"><i class="far fa-edit nav-icon"></i>&nbsp;Edit</a>';
                            }                            
                            else{
                                echo '<td><a href="?page=admissionedit&id='. $row[0] .'" class="btn btn-info"><i class="far fa-edit nav-icon"></i>&nbsp;Edit</a>
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
                                          <p>Are you sure to delete it? You will not be able to get it back anyway!</p>
                                        </div>
                                        <div class="modal-footer justify-content-between">
                                          <button type="button" class="btn btn-outline-light" data-dismiss="modal">No</button>
                                          <form action="" method="post">
                                          <input type="hidden" name="action" value="removeadmission">
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
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

