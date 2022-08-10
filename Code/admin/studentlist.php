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
              <h3 class="card-title" id="pagetitle">Students List</h3>              
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="applicant" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Program</th>
                  <th>Academic Year</th>
                  <th>Semester</th>
                  <th>Full Name</th>
                  <th>University Reg</th>
                  <th>University Roll</th>
                  
                </tr>
                </thead>
                <tbody>
                <?php
                    require_once '../config/dbconfig.php';
                    $mysqli = new mysqli(DBHOST, DBUSER, DBPWD, DBNAME);

                    if(isset($_GET['page']))
                    {
                                             
                        $query = "select * from tbl_university_students where universityroll <> '';";
                                                                     

                        $result = $mysqli->query($query);
                        while($row=$result->fetch_row()){
                            echo '<tr>';
                                echo '<td>'. $row[0] .'</td>';   
                                echo '<td>'. $row[1] .'</td>';                            
                                echo '<td>'. $row[2] .'</td>';
                                echo '<td>'. $row[3] .'</td>';
                                echo '<td>'. $row[4] .'</td>';
                                echo '<td><a href="?page=ustudfee&universityroll='.$row[5].'">'. $row[5] .'</a></td>';
                            echo '</tr>';
                        }
                    }
                ?>
                </tbody>
                <tfoot>
                <tr>
                  <th>Program</th>
                  <th>Academic Year</th>
                  <th>Semester</th>
                  <th>Full Name</th>
                  <th>University Reg</th>
                  <th>University Roll</th>
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