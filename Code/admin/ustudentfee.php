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
<?php

require_once '../config/dbconfig.php';
$mysqli = new mysqli(DBHOST, DBUSER, DBPWD, DBNAME);


$query = "SELECT * FROM `tbl_applicant_payment` WHERE applicationid = '" . $_GET['universityroll'] . "';"; 
$result = $mysqli->query($query);
$row = $result->num_rows;

if($row > 0){
    //Already Made payment
    $fullname = $program = $semester = $feeamount = $paymentid = $paymentdatetime = '';
    $row = $result->fetch_row();
    $feeamount = $row[1];
    $paymentid = $row[2];
    $paymentdatetime = $row[4] . ' - ' . $row[5];


    $query = "SELECT * FROM `tbl_university_students` WHERE universityroll = '" . $_GET['universityroll'] . "';"; 
    $result = $mysqli->query($query);
    if($row = $result->fetch_row()){
       $fullname = $row[3];
       $program = $row[0];
       $semester = $row[2];
    }

    ?>
    <div class="row">
        <div class="col-md-12">
            <!-- general form elements disabled -->
            <div id="card" class="card card-info">
                <div class="card-header">
                    <h3 id="card-title" class="card-title">Student Detail</h3>
                </div>
                <!-- <script>document.getElementById("pagetitle").innerHTML = "Admission Form";</script> -->

                <!-- /.card-header -->
                <div class="card-body">                                                      

                        <!-- First Row -->
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Full Name</label>
                                    <input type="text" name="fullname" value="<?php echo $fullname; ?>" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                <label>Program</label>
                                <input type="text" name="program" value="<?php echo $program;  ?>" class="form-control" readonly>                                    
                                </div>
                            </div>
                        </div>

                        <!-- Second Row -->
                        <div class="row">
                            <div class="col-sm-6">
                            <div class="form-group">
                                <label>Semester</label>
                                <input type="text" name="semester" value="<?php echo $semester; ?>" class="form-control" readonly>
                            </div>
                            </div>
                            <div class="col-sm-6">
                            <div class="form-group">
                                <label>Fee Amount</label>
                                <input type="text" name="feeamount" value="<?php echo $feeamount; ?>" class="form-control" readonly>                                    
                            </div>
                            </div>
                        </div>

                        <!-- Second Row -->
                        <div class="row">
                            <div class="col-sm-6">
                            <div class="form-group">
                                <label>Payment ID</label>
                                <input type="text" name="paymentid" value="<?php echo $paymentid; ?>" class="form-control" readonly>
                            </div>
                            </div>
                            <div class="col-sm-6">
                            <div class="form-group">
                                <label>Date - Time</label>
                                <input type="text" name="dateandtime" value="<?php echo $paymentdatetime; ?>" class="form-control" readonly>                                    
                            </div>
                            </div>
                        </div>


                        <!-- Third Row -->
                        <div class="row">
                            <div class="col-sm-12">                                    
                            <div class="form-group">                                                                 

                                <center>        
                                <button type="reset" class="btn btn-danger"><i class="fas fa-undo"></i>&nbsp;Reset</button>&emsp;                          

                                <?php                                                                     
                                    //Show the submit Button
                                    echo '<a href="../feereceipt.php?applicationid='.$_GET['universityroll'].'" target="_blank" class="btn btn-primary"><i class="fas fa-save"></i>&nbsp;Download Receipt</a>';                                                                                                                                   
                                ?>  
                                
                                </center>
                            </div>
                            </div>
                        </div>     
                    
                </div>
            </div>
        </div>
    </div>  

<?php
}

else{
    //Payment to be made
    if(isset($_GET['universityroll'])){
        $query = "SELECT * FROM tbl_university_students WHERE universityroll = '" . $_GET['universityroll'] . "';";                                
    }

    $fullname = $program = $semester = $feeamount = $uniroll = $unireg = 'Not Found';

    $result = $mysqli->query($query);
    while($row=$result->fetch_row()){
        $program = $row[0];
        $semester = $row[2];
        $fullname = $row[3];
        $unireg = $row[4];
        $uniroll = $row[5];
    } 
        
    if($fullname != 'Not Found'){
        $query = "SELECT totalfee FROM tbl_fee_details WHERE programme = '".$program."';";
        if($program === 'B.A.Geography'){
            $query = "SELECT totalfee FROM tbl_fee_details WHERE programme = 'B.A';";
        } 

        $result = $mysqli->query($query);
        while($row=$result->fetch_row()){
            $feeamount = (double)$row[0];
        }

        if($program === 'B.A.Geography'){
            $feeamount += 110;
        } 

        $feeamount += 500;
    }  

    ?>
            <div class="row">
                <div class="col-md-12">
                    <!-- general form elements disabled -->
                    <div id="card" class="card card-info">
                        <div class="card-header">
                            <h3 id="card-title" class="card-title">Student Detail</h3>
                        </div>
                        <!-- <script>document.getElementById("pagetitle").innerHTML = "Admission Form";</script> -->

                        <!-- /.card-header -->
                        <div class="card-body">  
                            <form action="" role="form" method="post" enctype="multipart/form-data">

                                <!-- First Row -->
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Full Name</label>
                                            <input type="text" name="fullname" value="<?php echo $fullname; ?>" class="form-control" readonly>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                        <label>Program</label>
                                        <input type="text" name="program" value="<?php echo $program; ?>" class="form-control" readonly>                                    
                                        </div>
                                    </div>
                                </div>

                                <!-- Second Row -->
                                <div class="row">
                                    <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Semester</label>
                                        <input type="text" name="semester" value="<?php echo $semester; ?>" class="form-control" readonly>
                                    </div>
                                    </div>
                                    <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Fee Amount with Late Fee</label>
                                        <input type="text" name="feeamount" value="<?php echo round($feeamount, 2); ?>" class="form-control" readonly>                                    
                                    </div>
                                    </div>
                                </div>


                                <!-- Third Row -->
                                <div class="row">
                                    <div class="col-sm-12">                                    
                                    <div class="form-group">                                          
                                        <input type="hidden" name="action" value="upayfee"/>
                                        <input type="hidden" name="applicationid" value="<?php echo $_GET['universityroll']; ?>"/>

                                        <center>        
                                        <button type="reset" class="btn btn-danger"><i class="fas fa-undo"></i>&nbsp;Reset</button>&emsp;                          

                                        <?php 
                                            if($feeamount != 'Not Found'){
                                                //Show the Payment Button    
                                                echo '<button type="submit" class="btn btn-success"><i class="fas fa-money-check-alt"></i>&nbsp;Fee Received</button>';                                                                                                                   
                                            }                                                                                                           
                                        ?>  
                                        </center>
                                    </div>
                                    </div>
                                </div>     
                            </form>
                        </div>
                    </div>
                </div>
            </div> 
<?php            
}
?>
</section>