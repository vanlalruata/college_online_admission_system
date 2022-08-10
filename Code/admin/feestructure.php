  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Fee Structure Form</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="?page=dashboard">Home</a></li>
              <li class="breadcrumb-item active">Fee Structure</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Fee Entry</h3>
              </div>
              <!-- /.card-header -->
              <?php 
              require_once '../config/dbconfig.php';
              $mysqli = new mysqli(DBHOST, DBUSER, DBPWD, DBNAME);

              if(isset($_GET['action']) && isset($_GET['id'])){   
                  
                if($_GET['action'] === "edit"){
                    $query = "select * from tbl_fee_details where id = ".$_GET['id'].";";
                    $result = $mysqli->query($query);
                    if($row = $result->fetch_row()){
                    ?>
                        <!-- form start -->
                        <form role="form" method="post" action="">
                        <div class="card-body">
                        <div class="form-group">
                            <label for="programme">Programme</label>
                            <input type="text" name="programme" class="form-control" id="programme" placeholder="Programme Name" value="<?php echo $row[1]; ?>" disabled required>                           
                        </div>
                        <div class="form-group">
                            <label for="semester">Year / Semester</label>
                            <input type="text" name="semester" class="form-control" id="semester" placeholder="Eg: 1 yr" value="<?php echo $row[2]; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="amount">Fee (₹)</label>
                            <input type="number" name="amount" class="form-control" id="amount" min="0.00" step="0.01" placeholder="500.50" value="<?php echo $row[3]; ?>" required>
                        </div>                  
                        </div>
                        <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
                        <!-- /.card-body -->
                        <?php                    
                    }    
                }    
              }
              else{
                    ?>
                        <!-- form start -->
                        <form role="form" method="post" action="">
                            <div class="card-body">
                            <div class="form-group">
                                <label for="programme">Programme</label>
                                <input type="text" name="programme" class="form-control" id="programme" placeholder="Programme Name" required>
                            </div>
                            <div class="form-group">
                                <label for="semester">Year / Semester</label>
                                <input type="text" name="semester" class="form-control" id="semester" placeholder="Eg: 1 yr" required>
                            </div>
                            <div class="form-group">
                                <label for="amount">Fee (₹)</label>
                                <input type="number" name="amount" class="form-control" id="amount" min="0.00" step="0.01" placeholder="500.50" required>
                            </div>                  
                            </div>
                            <!-- /.card-body -->

                    <?php
              }            
              
              ?>              
                <input type="hidden" name="action" value="addfee">    
                <div class="card-footer">
                  <center><button type="submit" class="btn btn-primary"><i class="fas fa-save"></i>&emsp;Save</button></center>
                </div>
              </form>
            </div>
            <!-- /.card -->
          </div>
          <!--/.col (left) -->
          <!-- right column -->
          <div class="col-md-6">
            <!-- general form elements disabled -->
            <div class="card card-warning">
              <div class="card-header">
                <h3 class="card-title">Fee Details</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
              <table class="table">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Programme</th>
                      <th style="width: 100px">Year</th>
                      <th style="width: 130px">Total Fee</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php                         
                         $query="select * from tbl_fee_details ORDER BY id;";
                         $result = $mysqli->query($query);
                         while($row = $result->fetch_row()){
                            echo '<tr>';
                            echo '<td>'.$row[0].'.</td>';
                            echo '<td>'.$row[1].'</td>';
                            echo '<td>'.$row[2].'</td>';
                            echo '<td align="right">₹ '.$row[3].'</td>';
                            echo '<td><a href="?page=feestructure&action=edit&id='.$row[0].'"><i class="fas fa-edit"></i></a>&ensp;<a href="?page=feestructure&action=&id=" data-toggle="modal" data-target="#modal-danger-' . $row[0] . '"><i class="fas fa-trash-alt"></i></a></td>';
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
                                          <p>Are you sure to delete this detail? You will not be able to get it back anyway!</p>
                                        </div>
                                        <div class="modal-footer justify-content-between">
                                          <button type="button" class="btn btn-outline-light" data-dismiss="modal">No</button>
                                          <form action="" method="post">
                                          <input type="hidden" name="action" value="deletefee">
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
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper --> 