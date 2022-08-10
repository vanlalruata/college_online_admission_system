   <!-- Content Wrapper. Contains page content -->
   <div class="">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Payment of Fee(s)</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a>Home</a></li>
              <li class="breadcrumb-item active">Payment</li>
              <li class="breadcrumb-item"><a href="logout.php"><i class="fas fa-sign-out-alt"></i>&nbsp;Logout</a></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>  
    <script>document.getElementById("pagetitle").innerHTML = "Payment for Admission";</script>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <?php
                          if(isset($_SESSION['$universityreg'])){
                            $_SESSION['$applicantid'] = $_SESSION['$universityreg'];                            
                          }

                          $query = "select fullname, programme, semester from tbl_university_students where universityroll = '" . $_SESSION['$universityreg'] ."';";
                          $result = $mysqli->query($query);
                          if($row = $result->fetch_row()){
                            echo '<h3 class="card-title">'.$row[0].'</h3>&emsp;('.$row[1] . ' / ' .$row[2].')';
                          }
                ?>
                             
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">              
                <table class="table">
                  <thead>
                        

                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Particular</th>
                      <th>Amount (₹)</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>                  
                      
                        <tr>
                        <td>1.</td>
                        <td>
                            College Admission
                        </td>
                        <td>
                            <?php

                               $feeamount = (float)$_POST['feeamount'];   
                              
                                if($row[1] === "B.A.Geography"){
                                  //$feeamount += 110;
                                }
                                
                               $feeamount += 500;                    

                               //echo '₹ ' . number_format((float)$feeamount, 2, '.', '') . ' Late Fee + 2% (+18%gst of trx) trx charges';                              
                               echo '₹ ' . number_format((float)$feeamount, 2, '.', '');

                                $fullname = '';
                                $email = '';
                                $mobile = '';
                                $address = '';                               


                            ?>
                        </td>
                        <td>
                            Click here to Pay: <a href="upi://pay?pa=GCCADM@SBI&amp;pn=GOVT CHAMPHAI COLLEGE ADM&amp;cu=INR" class="upi-pay1">GCCADM@SBI</a>
                            
                            <?php   
                            
                            /*
                            
                                $displayCurrency = 'INR';                             
                                $orderData = [
                                    'receipt'         => $_SESSION['$universityreg'],
                                    'amount'          => (int)(((int)$feeamount * 100) + (($feeamount * 100) * 0.023) + ((($feeamount * 100) * 0.023) * 0.18)), 
                                    'currency'        => 'INR',
                                    'payment_capture' => 1 
                                ];
                                
                                $razorpayOrder = $api->order->create($orderData);                                
                                $razorpayOrderId = $razorpayOrder['id'];                                
                                $_SESSION['razorpay_order_id'] = $razorpayOrderId;
                                
                                $displayAmount = $amount = $orderData['amount'];
                                
                                if ($displayCurrency !== 'INR')
                                {
                                    $url = "https://api.fixer.io/latest?symbols=$displayCurrency&base=INR";
                                    $exchange = json_decode(file_get_contents($url), true);
                                
                                    $displayAmount = $exchange['rates'][$displayCurrency] * $amount / 100;
                                }


                                $data = [
                                    "key"               => $apikey,
                                    "amount"            => ($feeamount + ((int)$feeamount * 0.023) + (((int)$feeamount * 0.023) * 0.18)),
                                    "name"              => "GCC",
                                    "description"       => "Fee Payment",
                                    "image"             => "dist/img/Logo.png",                                    
                                    "notes"             => [
                                    "address"           => $address,
                                    "merchant_order_id" => $_SESSION['$applicantid'],
                                    ],
                                    "theme"             => [
                                    "color"             => "#0086AD"
                                    ],
                                    "order_id"          => $razorpayOrderId,
                                ];
                                
                                if ($displayCurrency !== 'INR')
                                {
                                    $data['display_currency']  = $displayCurrency;
                                    $data['display_amount']    = $displayAmount;
                                }
                                
                                $json = json_encode($data);
                                
                                */

                            ?>
                            <!--
                            <form action="" method="post">
                            <script
                                src="https://checkout.razorpay.com/v1/checkout.js"
                                data-key="<?php //echo $data['key']?>"
                                data-amount="<?php //echo $data['amount']?>"
                                data-currency="INR"
                                data-name="<?php //echo $data['name']?>"
                                data-image="<?php //echo $data['image']?>"
                                data-buttontext="Pay with Razorpay"
                                data-description="<?php //echo $data['description']?>"                                
                                data-notes.shopping_order_id=<?php //echo $_SESSION['$applicantid']; ?>
                                data-order_id="<?php //echo $data['order_id']?>"
                                <?php //if ($displayCurrency !== 'INR') { ?> data-display_amount="<?php //echo $data['display_amount']?>" <?php //} ?>
                                <?php //if ($displayCurrency !== 'INR') { ?> data-display_currency="<?php //echo $data['display_currency']?>" <?php //} ?>
                            >
                            </script>
                            -->
                            <!-- Any extra fields to be submitted with the form but not sent to Razorpay -->
                            <!-- 
                            <input type="hidden" name="shopping_order_id" value="<?php //echo $_SESSION['$universityreg']; ?>">
                            <input type="hidden" custom="Hidden Element" name="hidden">
                            <input type="hidden" name="action" value="postpayment">  
                            <input type="hidden" name="feeamount" value="<?php //echo $_POST['feeamount']; ?>"> 
                            <input type="hidden" name="semester" value="<?php //echo $_POST['semester']; ?>"> 
                            <input type="hidden" name="program" value="<?php //echo $_POST['program']; ?>">  
                            <input type="hidden" name="fullname" value="<?php //echo $_POST['fullname']; ?>">                                              
                            </form>
                            -->
                        </td>
                        </tr> 
                        <tr>
                            <td>&nbsp;</td><td>&nbsp;</td><td align="center"><img src="dist/img/gccpay.PNG" width="300"></td><td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td><td>Instructions:</td><td>Payment hi Gpay emaw PayTM emaw, UPI application dang emaw hmang in a pek theih a, payment in pek in note ah in Application ID leh in hming in ziak tel dawn nia. Payment in pek zawh in <a href="https://wa.me/919862215033" target="_blank">+91 98622 15033</a> hnen ah whatsapp in payment successful confirmation share tur a ni.</td><td>&nbsp;</td>
                        </tr>
                        
                  </tbody>
                </table>
                
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->           
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->       
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->  