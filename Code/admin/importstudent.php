  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 id="pagetitle">Students</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="?page=dashboard">Home</a></li>
              <li class="breadcrumb-item active">Students</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title" id="pagetitle">Import Students</h3>              
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="applicant" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Full Name</th>
                  <th>Application #</th>
                  <th>Year</th>                                  
                  <th>Programme</th>
                  <th>Semester</th>  
                  <th>Mobile</th>
                  <th>DoB</th>
                  <th>Gender</th>
                  <th>Category</th>
                  <th>Religion</th>
                  <th>Email</th>
                </tr>
                </thead>
                <tbody>
                <?php
                    require_once '../config/dbconfig.php';
                    $mysqli = new mysqli(DBHOST, DBUSER, DBPWD, DBNAME);

                    if(isset($_GET['page']))
                    {
                                             
                        $query = "select fullname, applicationid, sessionyear, semester, mobile, dateofbirth, gender, category, religion, program, email from tbl_applicant where universityreg is NULL;";
                                                                     

                        $result = $mysqli->query($query);
                        while($row=$result->fetch_row()){
                            echo '<tr>';
                                echo '<td>'. $row[0] .'</td>';
                                echo '<td><a href="" data-toggle="modal" data-target="#modal-lg-'.$row[1].'">'. $row[1] .'</a></td>';
                                ?>
                                    <div class="modal fade" id="modal-lg-<?php echo $row[1]; ?>">
                                        <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h4 class="modal-title">Enter University Reg #, Roll No and Semester</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            </div>
                                            <div class="modal-body">
                                            <div class="card-body">
                                                <form role="form" action="" method="post">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                    <!-- text input -->
                                                    <div class="form-group">
                                                        <label>Registration #</label><code>*</code>
                                                        <input type="text" name="ureg" class="form-control" placeholder="University Registration #" required>
                                                    </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Roll No</label><code>*</code>
                                                        <input type="text" name="uroll" class="form-control" placeholder="University Roll #" required>
                                                    </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                    <!-- text input -->
                                                    <div class="form-group">
                                                        <label>Semester</label><code>*</code>
                                                        <select name="semester" class="form-control" required>
                                                            <option value="2nd Sem">2nd Sem</option>
                                                            <option value="3rd Sem">3rd Sem</option>
                                                            <option value="4th Sem">4th Sem</option>
                                                            <option value="5th Sem">5th Sem</option>
                                                            <option value="6th Sem">6th Sem</option>                                                            
                                                        </select>
                                                    </div>
                                                    </div>                                                    
                                                </div> 
                                            </div>
                                            <!-- /.card-body -->
                                            </div>
                                            <div class="modal-footer justify-content-between">
                                            <input type="hidden" name="action" value="updatestudent">
                                            <input type="hidden" name="id" value="<?php echo $row[1]; ?>">
                                            <input type="hidden" name="dob" value="<?php echo $row[6]; ?>">
                                            <input type="hidden" name="email" value="<?php echo $row[10]; ?>">
                                            <input type="hidden" name="fullname" value="<?php echo $row[0]; ?>">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                            </div>
                                            </form>
                                        </div>
                                        <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->
                                    </div>
                                    <!-- /.modal -->  
                                <?php
                                echo '<td>'. $row[2] .'</td>';
                                echo '<td>'. $row[9] .'</td>';
                                echo '<td>'. $row[3] .'</td>';
                                echo '<td>'. $row[4] .'</td>';
                                echo '<td>'. $row[5] .'</td>';
                                echo '<td>'. $row[6] .'</td>';
                                echo '<td>'. $row[7] .'</td>';
                                echo '<td>'. $row[8] .'</td>';
                                echo '<td>'. $row[10] .'</td>';
                            echo '</tr>';
                        }
                    }
                ?>
                </tbody>
                <tfoot>
                <tr>
                <th>Full Name</th>
                  <th>Application #</th>
                  <th>Year</th>                
                  <th>Programme</th>
                  <th>Semester</th>  
                  <th>Mobile</th>
                  <th>DoB</th>
                  <th>Gender</th>
                  <th>Category</th>
                  <th>Religion</th>
                  <th>Email</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->          
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->