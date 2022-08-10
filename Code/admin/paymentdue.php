  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Payment Details</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="?page=dashboard">Home</a></li>
              <li class="breadcrumb-item active">Payment Details</li>
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
              <h3 class="card-title">Payment Details</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="applicant" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Application ID</th>
                  <th>Full Name</th>
                  <th>Course</th>
                  <th>Mobile</th>
                  <th>E-Mail</th>
                </tr>
                </thead>
                <tbody>
                <?php
                    require_once '../config/dbconfig.php';
                    $mysqli = new mysqli(DBHOST, DBUSER, DBPWD, DBNAME);

                    if(isset($_GET['page']))
                    {
                        $query = "select tp.applicationid, ta.fullname, ta.program, ta.mobile, ta.email from tbl_applicant_payment as tp inner join tbl_applicant as ta ON tp.applicationid = ta.applicationid where tp.status = 'unpaid';";
                        

                        $result = $mysqli->query($query);
                        while($row=$result->fetch_row()){
                            echo '<tr>';
                                echo '<td><a href="?page=collectfee&applicationid='. $row[0].'">'. $row[0] .'</a></td>';
                                echo '<td>'. $row[1] .'</td>';
                                echo '<td>'. $row[2] .'</td>';
                                echo '<td>'. $row[3] .'</td>';
                                echo '<td>'. $row[4] .'</td>';
                            echo '</tr>';
                        }
                    }
                ?>
                </tbody>
                <tfoot>
                <tr>
                  <th>Application ID</th>
                  <th>Full Name</th>
                  <th>Course</th>
                  <th>Mobile</th>
                  <th>E-Mail</th>
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


