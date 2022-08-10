  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 id="pagetitle">Applicants</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="?page=dashboard">Home</a></li>
              <li class="breadcrumb-item active">Applicants</li>
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
              <h3 class="card-title" id="pagetitle">Applicant List</h3>              
            </div>

            
            
            <!-- /.card-header -->
            <div class="card-body">            
              <table id="applicant" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Full Name</th>
                  <th>Application #</th>
                  <th>Programme</th>
                  <th>Address</th>
                  <th>Mobile</th>
                  <th>Exam Passed</th>
                  <th>Percentage</th>
                  <th>Blood Group</th>
                  <th>Aadhaar</th>
                  <th>Voter ID</th>
                  <th>Category</th>
                  <th>Religion</th>
                </tr>
                </thead>
                <tbody>
                <?php
                    require_once '../config/dbconfig.php';
                    $mysqli = new mysqli(DBHOST, DBUSER, DBPWD, DBNAME);

                    if(isset($_GET['page']))
                    {
                        $query = "SELECT ta.fullname, ta.applicationid, ta.program, ta.permanentaddress, ta.mobile, tq.examinationpassed, tq.percentage, ta.bloodgroup, ta.aadhaar, ta.voterid, ta.category, ta.religion FROM tbl_applicant ta inner JOIN tbl_applicant_qualification tq ON ta.applicationid = tq.applicationid WHERE tq.examinationpassed = 'HSSLC or equivalent' ORDER BY ta.applicationid;";
                        //All Applicants
                        echo '<script>document.getElementById("pagetitle").innerHTML = "All Applications";</script>';
                        

                        $result = $mysqli->query($query);
                        while($row=$result->fetch_row()){
                            echo '<tr>';
                                echo '<td>'. $row[0] .'</td>';
                                echo '<td><a href="?page=details&applicationid='. $row[1].'&action='.$_GET['page'].'">'. $row[1] .'</a></td>';
                                echo '<td>'. $row[2] .'</td>';
                                echo '<td>'. $row[3] .'</td>';
                                echo '<td>'. $row[4] .'</td>';
                                echo '<td>'; if ($row[5]==='HSLC') {echo '<strong style="color: red;">'. $row[5] . '</strong>';} else {{echo '<strong style="color: blue;">'. $row[5] . '</strong>';}} echo '</td>';
                                echo '<td>'. $row[6] .'</td>';
                                echo '<td>'. $row[7] .'</td>';
                                echo '<td>'. $row[8] .'</td>';
                                echo '<td>'. $row[9] .'</td>';
                                echo '<td>'. $row[10] .'</td>';
                                echo '<td>'. $row[11] .'</td>';
                            echo '</tr>';
                        }
                    }
                ?>
                </tbody>
                <tfoot>
                <tr>
                <th>Full Name</th>
                  <th>Application #</th>
                  <th>Programme</th>
                  <th>Address</th>
                  <th>Mobile</th>
                  <th>Exam Passed</th>
                  <th>Percentage</th>
                  <th>Blood Group</th>
                  <th>Aadhaar</th>
                  <th>Voter ID</th>
                  <th>Category</th>
                  <th>Religion</th>
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