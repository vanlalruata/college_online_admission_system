  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <!-- Default box -->
            <div class="card card-danger">
              <div class="card-header">
                <h3 class="card-title">Duplicate Application!</h3>                
              </div>
              <div class="card-body">
                <h4 class="message" id="message">Sorry, an application has been already submitted. Please login and complete your application. In case of any problem, please contact admission helpline or <a href="mailto:admission@champhaicollege.edu.in">admission@champhaicollege.edu.in</a></h4><br><br>
                <div class="info-box bg-danger">
                  <span class="info-box-icon"><i class="far fa-copy"></i></span>
                  <div class="info-box-content">
                    <span class="info-box-text">HSSLC Roll No: <?php echo $_POST['xiirollno']; ?></span>
                    <span class="info-box-number">is already in used!</span>
                  </div>
                </div>                
                <br><br>
                <br><br>
                <h4 class="message" id="message">
                    1 : Kindly check whether you or your friend had applied for you.<br>
                    2 : You can contact us for any further infomation.<br>
                    3 : Check the HSSLC Roll No you had entered!<br>
                </h4>
              </div>
              <!-- /.card-body -->              
            </div>
            <!-- /.card -->
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->