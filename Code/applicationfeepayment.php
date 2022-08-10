<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Application Fee</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a>Home</a></li>
              <li class="breadcrumb-item active">Payment</li>              
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>  
    <script>document.getElementById("pagetitle").innerHTML = "Payment for Application Fee";</script>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <?php
                          if(!isset($_SESSION['$universityreg'])){
                            $_SESSION['$universityreg'] = $_POST['xiirollno'];                            
                          }                          
                            echo '<h3 class="card-title">'.$_POST['fullname'].'</h3>';
                          
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
                            Application Fee
                        </td>
                        <td>
                            <?php                                
                               //$feeamount = 0.00;                               
                               echo '₹ ' . $feeamount . ' + 2% (+18%gst of trx) transaction charges';                               
                            ?>
                        </td>
                        <td>
                            <?php  
                                $_SESSION['$applicantid'] = $_POST["xiirollno"]; 
                                $displayCurrency = 'INR';                             
                                $orderData = [
                                    'receipt'         => $_SESSION['$applicantid'],
                                    'amount'          => (int)((((int)$feeamount * 100) + (((int)$feeamount * 100) * 0.025) + ((((int)$feeamount * 100) * 0.025) * 0.18))), 
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
                                
                
                           
								$mobileNumber = $_POST['mobile'];
								//Include father mobile if not same 
								if(($_POST['mobile'] != $_POST['fathermobile']) && $_POST['fathermobile'] != ""){
									$mobileNumber .= ",".str_replace(' ', '', $_POST['fathermobile']);
								}


                                $data = [
                                    "key"               => $apikey,
                                    "amount"            => (int)((((int)$feeamount * 100) + (((int)$feeamount * 100) * 0.02) + ((((int)$feeamount * 100) * 0.02) * 0.18))),
                                    "name"              => "GCC",
                                    "description"       => "Fee Payment",
                                    "image"             => "dist/img/Logo.png",
                                    "prefill"           => [
                                    "name"              => $fullname,
                                    "email"             => $email,
                                    "contact"           => $mobile,
                                    ],
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

                            ?>
                            <form action="" method="post">
                            <script
                                src="https://checkout.razorpay.com/v1/checkout.js"
                                data-key="<?php echo $data['key']?>"
                                data-amount="<?php echo $data['amount']?>"
                                data-currency="INR"
                                data-name="<?php echo $data['name']?>"
                                data-image="<?php echo $data['image']?>"
                                data-buttontext="Pay with Razorpay"
                                data-description="<?php echo $data['description']?>"
                                data-prefill.name="<?php echo $data['prefill']['name']?>"
                                data-prefill.email="<?php echo $data['prefill']['email']?>"
                                data-prefill.contact="<?php echo $data['prefill']['contact']?>"
                                data-notes.shopping_order_id=<?php echo $_SESSION['$applicantid']; ?>
                                data-order_id="<?php echo $data['order_id']?>"
                                <?php if ($displayCurrency !== 'INR') { ?> data-display_amount="<?php echo $data['display_amount']?>" <?php } ?>
                                <?php if ($displayCurrency !== 'INR') { ?> data-display_currency="<?php echo $data['display_currency']?>" <?php } ?>
                            >
                            </script>
                            <!-- Any extra fields to be submitted with the form but not sent to Razorpay -->
                            <input type="hidden" name="shopping_order_id" value="<?php echo $_SESSION['$universityreg']; ?>">
                            <input type="hidden" custom="Hidden Element" name="hidden">
                            <input type="hidden" name="page" value="appfeepayment"> 
							              <input type="hidden" name="query" value="<?php echo $query_statement; ?>"> 
							              <input type="hidden" name="password" value="<?php echo date('dmY', strtotime($_POST['dob'])); ?>"> 	
							              <input type="hidden" name="mobile" value="<?php echo $mobileNumber; ?>"> 	
							              <input type="hidden" name="email" value="<?php echo $email; ?>"> 	
							              <input type="hidden" name="fullname" value="<?php echo $fullname; ?>"> 	
							              <input type="hidden" name="dob" value="<?php echo $_POST['dob']; ?>"> 	
                            <input type="hidden" name="amount" value="<?php echo $feeamount; ?>"> 
                            </form>
                        </td>
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