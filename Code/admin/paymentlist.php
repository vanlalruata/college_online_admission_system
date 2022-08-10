  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Payment Lists</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="?page=dashboard">Home</a></li>
              <li class="breadcrumb-item active">Payment Lists</li>
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
                <h3 class="card-title">Payments</h3>  
                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <div class="input-group-append">
                      <a href="?page=addpayment" class="btn btn-info float-right"><i class="fas fa-rupee-sign"></i>&nbsp;&nbsp;Add Payment</a>
                    </div>
                  </div>
                </div>              
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0" style="height: 500px;">
              <table id="applicant" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Application ID</th>
                  <th>Payment Status</th>
                  <th>Amount (₹)</th>
                  <th>Transaction ID</th>
                  <th>Payment Date</th>
                </tr>
                </thead>
                <tbody>
                <?php
                    require_once '../config/dbconfig.php';
                    $mysqli = new mysqli(DBHOST, DBUSER, DBPWD, DBNAME);

                    if(isset($_GET['page']))
                    {
                        $query = "select applicationid, status, feeamount, transactionid, paymentdate, paymenttime from tbl_applicant_payment ORDER BY applicationid ASC";
                        
                        date_default_timezone_set('Asia/Kolkata');
                        $result = $mysqli->query($query);
                        while($row=$result->fetch_row()){
                            echo '<tr>';
                                echo '<td><a href="?page=paymentdetail&applicationid='. $row[0].'">'. $row[0] .'</a></td>';
                                echo '<td>'. ucfirst($row[1]) .'</td>';
                                echo '<td>₹ '. number_format($row[2],2,".",",") .'</td>';
                                echo '<td>'; if($row[3] != "") {echo $row[3];} echo '</td>';
                                $date = $row[4] . ' ' . $row[5];
                                echo '<td>'; 
                                if($row[4] != "") { echo date('d-m-Y h:i A', strtotime($date));}                                 
                                echo '</td>';
                            echo '</tr>';
                        }
                    }
                ?>
                </tbody>
                <tfoot>
                <tr>
                  <th>Application ID</th>
                  <th>Payment Status</th>
                  <th>Amount (₹)</th>
                  <th>Transaction ID</th>
                  <th>Payment Date</th>
                </tr>
                </tfoot>
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

