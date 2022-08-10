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
              <table id="applicant" class="table table-head-fixed text-nowrap">
                <thead>
                <tr>
                  <th>Application #</th>
                  <th>Full Name</th>
                  <th>HSLC</th>
                  <th>HSSLC</th>
                  <th>Programme</th>
                  <th>Address</th>
                  <th>Mobile</th>
                  <th>Aadhaar</th>
                  <th>Email</th>
                </tr>
                </thead>
                <tbody>
                <?php
                    require_once '../config/dbconfig.php';
                    $mysqli = new mysqli(DBHOST, DBUSER, DBPWD, DBNAME);

                    if(isset($_GET['page']))
                    {
                        $query = "";
                        //Get only new application
                        if($_GET['page'] === "newapplication"){
                            $query = "select ta.fullname, ta.applicationid, ta.program, ta.permanentaddress, ta.mobile, ta.aadhaar, ta.email from tbl_applicant as ta where ta.bloodgroup IS NOT null AND ta.remark is null;";
                            echo '<script>document.getElementById("pagetitle").innerHTML = "New Applications";</script>';
                        }
                        //Get only Incomplete application
                        else if($_GET['page'] === "incomplete"){
                          $query = "SELECT `fullname`,`applicationid`,`program`,`permanentaddress`,`mobile` FROM `tbl_applicant` WHERE `bloodgroup` IS NULL ORDER BY `applicationid` ASC;";
                          echo '<script>document.getElementById("pagetitle").innerHTML = "Incomplete Applications";</script>';
                        }
                        //Get only Admitted
                        else if($_GET['page'] === "admitted"){
                            $query = "select ta.fullname, ta.applicationid, ta.program, ta.permanentaddress, ta.mobile, ta.aadhaar, ta.email from tbl_applicant as ta LEFT JOIN tbl_applicant_payment as tp ON ta.applicationid = tp.applicationid where ta.remark = 'approved' AND tp.status is null;";
                            echo '<script>document.getElementById("pagetitle").innerHTML = "Admitted Applications";</script>';
                        }
                        else if($_GET['page'] === "monitor"){
                            $query = "SELECT `fullname`,`applicationid`,`program`,`permanentaddress`,`mobile` FROM `tbl_applicant` WHERE `remark` = 'monitor' ORDER BY `applicationid` ASC;";
                            echo '<script>document.getElementById("pagetitle").innerHTML = "Verified Applications";</script>';
                        }
                        //Admission Confirmed with Fee Paid
                        else if($_GET['page'] === "feepaid"){
                          $query = "select ta.fullname, ta.applicationid, ta.program, ta.permanentaddress, ta.mobile, ta.aadhaar, ta.email from tbl_applicant as ta LEFT JOIN tbl_applicant_payment as tp ON ta.applicationid = tp.applicationid where ta.remark = 'feepaid' AND tp.status = 'paid';";
                          echo '<script>document.getElementById("pagetitle").innerHTML = "Admitted Applications";</script>';
                        }
                        else if($_GET['page'] === "rejected"){
                            $query = "select fullname, applicationid, program, permanentaddress, mobile from tbl_applicant, aadhaar, email where remark = 'rejected';";
                            echo '<script>document.getElementById("pagetitle").innerHTML = "Rejected Applications";</script>';
                        }
                        else if($_GET['page'] === "waiting"){
                          $query = "select fullname, applicationid, program, permanentaddress, mobile, aadhaar, email from tbl_applicant where remark = 'waiting';";
                          echo '<script>document.getElementById("pagetitle").innerHTML = "Awaiting Applications";</script>';
                        }
                        else if($_GET['page'] === "approved"){
                          $query = "select ta.fullname, ta.applicationid, ta.program, ta.permanentaddress, ta.mobile, ta.aadhaar, ta.email from tbl_applicant as ta where ta.remark = 'approved';";
                          echo '<script>document.getElementById("pagetitle").innerHTML = "Approved Applications";</script>';
                        }
                        else if($_GET['page'] === "allapp"){
                          $query = "select ta.fullname, ta.applicationid, ta.program, ta.permanentaddress, ta.mobile, ta.aadhaar, ta.email from tbl_applicant as ta;";
                          echo '<script>document.getElementById("pagetitle").innerHTML = "All Applications";</script>';
                        }
                        else if($_GET['page'] === "phyapplication"){
                          $query = "select ta.fullname, ta.applicationid, ta.program, ta.permanentaddress, ta.mobile, ta.aadhaar, ta.email from tbl_applicant as ta where ta.bloodgroup IS NOT null AND ta.remark is null AND disableperson = 'Yes' OR sportquota = 'Yes';";
                          echo '<script>document.getElementById("pagetitle").innerHTML = "Quota Applications";</script>';
                        }

                        $result = $mysqli->query($query);
                        while($row=$result->fetch_row()){
                            echo '<tr>';                                
                                echo '<td><a href="?page=details&applicationid='. $row[1].'&action='.$_GET['page'].'">'. $row[1] .'</a></td>';
                                echo '<td>'. $row[0] .'</td>';

                                //Educational Qualification
                                $eq = 0;
                                $qr = "SELECT `percentage` FROM `tbl_applicant_qualification` WHERE `applicationid` = '".$row[1]."';";
                                $rs = $mysqli->query($qr);
                                $st = 0;
                                while($rw=$rs->fetch_row()){
                                  echo '<td>'. $rw[0] . '%</td>';
                                  $eq++;
                                }
                                //If no Education, leave blank
                                if($eq < 2){
                                  echo '<td>&nbsp;</td>';
                                  echo '<td>&nbsp;</td>';
                                }

                                echo '<td>'. $row[2] .'</td>';
                                echo '<td>'. $row[3] .'</td>';
                                echo '<td>'. $row[4] .'</td>';
                                echo '<td>'. $row[5] .'</td>';
                                echo '<td>'. $row[6] .'</td>';
                            echo '</tr>';
                        }
                    }
                ?>
                </tbody>
                <tfoot>
                <tr>
                  <th>Application #</th>
                  <th>Full Name</th>
                  <th>HSLC</th>
                  <th>HSSLC</th>
                  <th>Programme</th>
                  <th>Address</th>
                  <th>Mobile</th>
                  <th>Aadhaar</th>
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


