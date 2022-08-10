  <!-- Content Wrapper. Contains page content -->
  <div class="">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Educational Qualification</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a>Home</a></li>
              <li class="breadcrumb-item active">Educational Qualification</li>
              <li class="breadcrumb-item"><a href="logout.php"><i class="fas fa-sign-out"></i>&nbsp;Logout</a></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <script>document.getElementById("pagetitle").innerHTML = "Applicant Educational Qualification";</script>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">If you are using smart phone, kindly use Landscape mode to view this page.</h3>
              </div>
              <!-- /.card-header -->
              <form action="" id="education" method="post" enctype="multipart/form-data">
              <div class="card-body table-responsive p-0">
                   <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <center><code>Kindly avoid apostrophy (') in your input, don't place it anywhere. You can replace it with space or - sign</code></center>
                                </div>
                            </div>
                          </div>
                <table class="table table-hover text-nowrap">
                  <thead>                  
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Examination Passed</th>
                      <th>Name of the Institute from where you passed</th>
                      <th>Name of the Board</th>
                      <th>Year of Passing</th>
                      <th>Total Full Mark</th>
                      <th>Total Mark Obtained</th>
                      <th>Division Grade</th>
                      <th>Percentage</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>1.</td>
                      <td>HSLC (or equivalent)</td><code>*</code>
                      <td>
                      <input type="text" class="form-control" id="hslcinstitutename" name="hslcinstitutename" placeholder="Eg: Govt. Champhai High School" required>
                      </td>
                      <td>
                      <input type="text" class="form-control" id="hslcboardname" name="hslcboardname" placeholder="Eg: Mizoram Board of School Education" required>
                      </td>
                      <td>
                      <select class="form-control" id="hslcpassingyear" name="hslcpassingyear" placeholder="Select the year you pass"  required> <option value="">Select Year</option></select>
                      </td>
                      <td>
                      <input type="text" class="form-control" id="hslctotalmark" name="hslctotalmark" placeholder="Eg: 500" required>
                      </td>
                      <td>
                      <input type="text" class="form-control" id="hslcmarkobtained" name="hslcmarkobtained" placeholder="Eg: 325" required>
                      </td>
                      <td>
                      <input type="text" class="form-control" id="hslcdivision" name="hslcdivision" placeholder="Eg: First" readonly required>                          
                      </td>
                      <td>
                      <div class="input-group">
                        <input type="text" class="form-control" id="hslcpercentage" name="hslcpercentage" readonly placeholder="0.00" required>
                        <div class="input-group-append">
                            <div class="input-group-text"><i class="fas fa-percentage"></i></div>
                        </div>
                        </div>                      
                      </td>                      
                    </tr>
                    <tr>
                      <td>2.</td>
                      <td>HSSLC (or equivalent)</td><code>*</code>
                      <td>
                      <input type="text" class="form-control" id="hsslcinstitutename" name="hsslcinstitutename" placeholder="Eg: Govt. Champhai High School"  required>
                      </td>
                      <td>
                      <input type="text" class="form-control" id="hsslcboardname" name="hsslcboardname" placeholder="Eg: Mizoram Board of School Education"  required>
                      </td>
                      <td>
                      <select class="form-control" id="hsslcpassingyear" name="hsslcpassingyear" placeholder="Select the year you pass"  required> <option value="">Select Year</option></select>
                      </td>
                      <td>
                      <input type="text" class="form-control" id="hsslctotalmark" name="hsslctotalmark" placeholder="Eg: 500" required>
                      </td>
                      <td>
                      <input type="text" class="form-control" id="hsslcmarkobtained" name="hsslcmarkobtained" placeholder="Eg: 425" required>
                      </td>
                      <td>
                      <input type="text" class="form-control" id="hsslcdivision" name="hsslcdivision" placeholder="Eg: First" readonly required>                          
                      </td>
                      <td>
                      <div class="input-group">
                        <input type="text" class="form-control" id="hsslcpercentage" name="hsslcpercentage" readonly placeholder="0.00" required>
                        <div class="input-group-append">
                            <div class="input-group-text"><i class="fas fa-percentage"></i></div>
                        </div>
                        </div>                      
                      </td>                      
                    </tr>
                    <tr>                    
                    <td colspan="4">
                      <div class="form-group">
                        <label for="exampleInputFile">Choose HSLC (or equivalent) Scanned Marksheet</label><code>*</code> (only jpg format)
                        <div class="input-group">
                        <div class="custom-file">
                            <input type="file" name="hslcmarksheet" class="custom-file-input" id="hslcfile" accept="image/jpg, image/jpeg" required>
                            <label class="custom-file-label" for="hslcfile">Choose file</label>
                        </div>
                        </div>
                      </div>
                    </td>
                    <td colspan="3">
                      <div class="form-group">
                        <label for="exampleInputFile">Choose HSSLC (or equivalent) Scanned Marksheet</label><code>*</code></code> (only jpg format)
                        <div class="input-group">
                        <div class="custom-file">
                            <input type="file" name="hsslcmarksheet" class="custom-file-input" id="hsslcfile" accept="image/jpg, image/jpeg" required>
                            <label class="custom-file-label" for="hsslcfile">Choose file</label>
                        </div>
                        </div>
                      </div>
                    </td>
                    </tr>                    
                    <tr>
                    <input type="hidden" name="page" value="educationalqualification">
                    <td colspan="100%"><center><button type="submit" class="btn btn-success"><i class="fas fa-server"></i>&emsp;Submit</button></center></td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->    
              </form>          
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

  <script>
    $('#hslcfile').on('change', function() {
        if(this.files[0].size > 100000) {
            //alert("Try to upload file less than 100KB!");
            toastr.error('Try to upload file less than 100KB!');   
            document.getElementById("hslcfile").value = "";
        }         
    });  
    $('#hsslcfile').on('change', function() {
        if(this.files[0].size > 100000) {
            //alert("Try to upload file less than 100KB!");
            toastr.error('Try to upload file less than 100KB!');   
            document.getElementById("hsslcfile").value = "";
        }         
    });        
  </script>



  <script type="text/javascript">
    var d = new Date();
    var n = d.getFullYear();
    for(y = n-10; y <= n - 1; y++) {
        var optn = document.createElement("OPTION");
        optn.text = y;
        optn.value = y;
        
        // if year is 2018 selected
        if (y == 2018) {
            optn.selected = true;
        }
        document.getElementById('hslcpassingyear').options.add(optn);
        //document.getElementById('hsslcpassingyear').options.add(optn);
    }
    for(y = n-10; y <= n; y++) {
        var optn = document.createElement("OPTION");
        optn.text = y;
        optn.value = y;
        
        // if year is 2018 selected
        if (y == n) {
            optn.selected = true;
        }
        //document.getElementById('hslcpassingyear').options.add(optn);
        document.getElementById('hsslcpassingyear').options.add(optn);
    }

  var $hslcmarkobt = $("#hslcmarkobtained");
  var $hslcmarktot = $("#hslctotalmark");
  var $hslcper = $("#hslcpercentage");
  var $hsslcmarkobt = $("#hsslcmarkobtained");
  var $hsslcmarktot = $("#hsslctotalmark");
  var $hsslcper = $("#hsslcpercentage"); 
  var $hsslcdivision = $("hsslcdivision"); 
  var $hslcdivision = $("hslcdivision"); 

  $( "#hslctotalmark" ).keyup(function() {
  var num1 = $hslcmarkobt.val();
  var num2 = $hslcmarktot.val();
  var result = parseFloat((parseInt(num1, 10) / parseInt(num2, 10) * 100), 2);
  //var result = parseInt(num1, 10) + parseInt(num2, 10);
  if (!isNaN(result)) {
    $('#hslcpercentage').attr('value', result.toFixed(2));
    if(result >= 75){
      //Distinction
      $("input#hslcdivision").val('Distinction');
    }  
    else if(result >= 60){
      //First
      $("input#hslcdivision").val('First');
    } 
    else if(result >= 50){
      //Second
      $("input#hslcdivision").val('Second');
    } 
    else if(result >= 40){
      //Third      
      $("input#hslcdivision").val('Third');
    } 
    else{
      //Fail      
      $("input#hslcdivision").val('Fail');
    }
  } 
});
$( "#hslcmarkobtained" ).keyup(function() {
  var num1 = $hslcmarkobt.val();
  var num2 = $hslcmarktot.val();
  var result = parseFloat((parseInt(num1, 10) / parseInt(num2, 10) * 100), 2);
  //var result = parseInt(num1, 10) + parseInt(num2, 10);
  if (!isNaN(result)) {
    $('#hslcpercentage').attr('value', result.toFixed(2));    
    if(result >= 75){
      //Distinction
      $("input#hslcdivision").val('Distinction');
    }  
    else if(result >= 60){
      //First
      $("input#hslcdivision").val('First');
    } 
    else if(result >= 50){
      //Second
      $("input#hslcdivision").val('Second');
    } 
    else if(result >= 40){
      //Third      
      $("input#hslcdivision").val('Third');
    } 
    else{
      //Fail      
      $("input#hslcdivision").val('Fail');
    }
  }  
});

$( "#hsslctotalmark" ).keyup(function() {
  var num1 = $hsslcmarkobt.val();
  var num2 = $hsslcmarktot.val();
  var result = parseFloat((parseInt(num1, 10) / parseInt(num2, 10) * 100), 2);
  //var result = parseInt(num1, 10) + parseInt(num2, 10);
  if (!isNaN(result)) {
    $('#hsslcpercentage').attr('value', result.toFixed(2));
    if(result >= 75){
      //Distinction
      $("input#hsslcdivision").val('Distinction');
    }  
    else if(result >= 60){
      //First
      $("input#hsslcdivision").val('First');
    } 
    else if(result >= 50){
      //Second
      $("input#hsslcdivision").val('Second');
    } 
    else if(result >= 40){
      //Third      
      $("input#hsslcdivision").val('Third');
    } 
    else{
      //Fail      
      $("input#hsslcdivision").val('Fail');
    }
  } 
});
$( "#hsslcmarkobtained" ).keyup(function() {
  var num1 = $hsslcmarkobt.val();
  var num2 = $hsslcmarktot.val();
  var result = parseFloat((parseInt(num1, 10) / parseInt(num2, 10) * 100), 2);
  //var result = parseInt(num1, 10) + parseInt(num2, 10);
  if (!isNaN(result)) {
    $('#hsslcpercentage').attr('value', result.toFixed(2));  
    if(result >= 75){
      //Distinction
      $("input#hsslcdivision").val('Distinction');
    }  
    else if(result >= 60){
      //First
      $("input#hsslcdivision").val('First');
    } 
    else if(result >= 50){
      //Second
      $("input#hsslcdivision").val('Second');
    } 
    else if(result >= 33){
      //Third      
      $("input#hsslcdivision").val('Third');
    } 
    else{
      //Fail      
      $("input#hsslcdivision").val('Fail');
    }
  }  
});

</script>