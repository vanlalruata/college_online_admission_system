   <!-- Content Wrapper. Contains page content -->
   <div class="">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Core Subject</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a>Home</a></li>
              <li class="breadcrumb-item active">Core Subject</li>
              <li class="breadcrumb-item"><a href="logout.php"><i class="fas fa-sign-out"></i>&nbsp;Logout</a></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <script>document.getElementById("pagetitle").innerHTML = "Core Subject Combination";</script>
    <script type="text/javascript">
        

        window.onload = function () {
            var firstcoreselect = document.getElementById("firstchoice"),
                firstelectiveone = document.getElementById("firstelectiveone"),
                firstelectivetwo = document.getElementById("firstelectivetwo");

            //var secondcoreselect = document.getElementById("secondchoice"),
            //secondelectiveone = document.getElementById("secondelectiveone"),
            //secondelectivetwo = document.getElementById("secondelectivetwo");

            //var thirdcoreselect = document.getElementById("thirdchoice"),
            //thirdelectiveone = document.getElementById("thirdelectiveone"),
            //thirdelectivetwo = document.getElementById("thirdelectivetwo");
            
            for (var item in stateObject) {
                    firstcoreselect.options[firstcoreselect.options.length] = new Option(item, item);
                    //secondcoreselect.options[secondcoreselect.options.length] = new Option(item, item);
                    //thirdcoreselect.options[thirdcoreselect.options.length] = new Option(item, item);
            }

            //Choosing the First Choice Core Subject
            firstcoreselect.onchange = function () {
                firstelectiveone.length = 1; // remove all options bar first
                firstelectivetwo.length = 1; // remove all options bar first
                if (this.selectedIndex < 1) return; // done
                for (var state in stateObject[this.value]) {
                    firstelectiveone.options[firstelectiveone.options.length] = new Option(state, state);
                }

                //$("#secondchoice option[value='" + this.value + "']").remove();
                //$("#thirdchoice option[value='" + this.value + "']").remove();
            }

            firstcoreselect.onchange(); // reset in case page is reloaded
                firstelectiveone.onchange = function () {
                firstelectivetwo.length = 1; // remove all options bar first
                if (this.selectedIndex < 1) return; // done
                var district = stateObject[firstcoreselect.value][this.value];
                for (var i = 0; i < district.length; i++) {
                    firstelectivetwo.options[firstelectivetwo.options.length] = new Option(district[i], district[i]);
                }
            }

            //Choosing the second Choice Core Subject
            secondcoreselect.onchange = function () {
                secondelectiveone.length = 1; // remove all options bar second
                secondelectivetwo.length = 1; // remove all options bar second
                if (this.selectedIndex < 1) return; // done
                for (var state in stateObject[this.value]) {
                    secondelectiveone.options[secondelectiveone.options.length] = new Option(state, state);
                }
                $("#firstchoice option[value='" + this.value + "']").remove();
                $("#thirdchoice option[value='" + this.value + "']").remove();
            }
            
            secondcoreselect.onchange(); // reset in case page is reloaded
                secondelectiveone.onchange = function () {
                secondelectivetwo.length = 1; // remove all options bar second
                if (this.selectedIndex < 1) return; // done
                var district = stateObject[secondcoreselect.value][this.value];
                for (var i = 0; i < district.length; i++) {
                    secondelectivetwo.options[secondelectivetwo.options.length] = new Option(district[i], district[i]);
                }
            }

            //Choosing the third Choice Core Subject
            thirdcoreselect.onchange = function () {
                thirdelectiveone.length = 1; // remove all options bar third
                thirdelectivetwo.length = 1; // remove all options bar third
                if (this.selectedIndex < 1) return; // done
                for (var state in stateObject[this.value]) {
                    thirdelectiveone.options[thirdelectiveone.options.length] = new Option(state, state);
                }
            }
            
            thirdcoreselect.onchange(); // reset in case page is reloaded
                thirdelectiveone.onchange = function () {
                thirdelectivetwo.length = 1; // remove all options bar third
                if (this.selectedIndex < 1) return; // done
                var district = stateObject[thirdcoreselect.value][this.value];
                for (var i = 0; i < district.length; i++) {
                    thirdelectivetwo.options[thirdelectivetwo.options.length] = new Option(district[i], district[i]);
                }
            }
        } 

        

    </script>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <?php
                          $query = "select program from tbl_applicant where applicationid = " . $_SESSION['$applicantid'];
                          $result = $mysqli->query($query);
                          if($row = $result->fetch_row()){
                            echo '<h3 class="card-title">Programme: '.$row[0].'</h3><br><br>You must choose three core option (if applicable) as # 1 is your first choice, # 2 is your second choice and respectively!';
                          }
                ?>
                             
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
              <form action="" method="post">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Core Subject</th>
                      <th>Elective 1</th>
                      <th>Elective 2</th>
                    </tr>
                  </thead>
                  <tbody>    
                   <?php               
                      if($row[0] == "BCA"){
                          ?>
                        <tr>
                        <td>1.</td>
                        <td>
                            <select name="firstchoice" class="form-control select2" required>
                                <option value="BCA" selected>BCA</option>
                            </select>
                        </td>
                        <td>
                            <select name="firstelectiveone" class="form-control select2" required>
                                <option value="BCA" selected>BCA</option>
                            </select>
                        </td>
                        <td>
                            <select name="firstelectivetwo" class="form-control select2" required>
                                <option value="BCA" selected>BCA</option>
                            </select>
                        </td>
                        </tr>
                        <!--
                        <tr>
                        <td>2.</td>
                        <td>
                            <select name="secondchoice" class="form-control select2" required>
                                <option value="BCA" selected>BCA</option>
                            </select>
                        </td>
                        <td>
                            <select name="secondelectiveone" class="form-control select2" required>
                                <option value="BCA" selected>BCA</option>
                            </select>
                        </td>
                        <td>
                            <select name="secondelectivetwo" class="form-control select2" required>
                                <option value="BCA" selected>BCA</option>
                            </select>
                        </td>
                        </tr>
                        <tr>
                        <td>3.</td>
                        <td>
                            <select name="thirdchoice" class="form-control select2" required>
                                <option value="BCA" selected>BCA</option>
                            </select>
                        </td>
                        <td>
                            <select name="thirdelectiveone" class="form-control select2" required>
                                <option value="BCA" selected>BCA</option>
                            </select>
                        </td>
                        <td>
                            <select name="thirdelectivetwo" class="form-control select2" required>
                                <option value="BCA" selected>BCA</option>
                            </select>
                        </td>
                        </tr>
                        -->
                        <tr>
                        <input type="hidden" name="program" value="<?php echo $row[0]; ?>">
                        <input type="hidden" name="page" value="coresubjectcombination">
                        <td colspan="4"><center><button type="submit" class="btn btn-info"><i class="fas fa-database"></i>&emsp;Submit</button></center></td>
                        </tr>
                      <?php
                      }                       
                      else if($row[0] == "B.Com"){
                          ?>
                          <!-- for B.Com -->
                     <script>
                         var stateObject = {
                             "Ecommerce": { 
                                 "Ecommerce": ["Ecommerce"], 
                             },                             
                         }
                     
                     </script>
                        <tr>
                        <td>1.</td>
                        <td>
                            <select name="firstchoice" class="form-control select2" required>
                                <option value="Commerce" selected>Commerce</option>
                            </select>
                        </td>
                        <td>
                            <select name="firstelectiveone" class="form-control select2" required>
                                <option value="Commerce" selected>Commerce</option>
                            </select>
                        </td>
                        <td>
                            <select name="firstelectivetwo" class="form-control select2" required>
                                <option value="Commerce" selected>Commerce</option>
                            </select>
                        </td>
                        </tr>
                        <tr>
                        <!--
                        <td>2.</td>
                        <td>
                            <select name="secondchoice" class="form-control select2" required>
                            <option value="Commerce" selected>Commerce</option>
                            </select>
                        </td>
                        <td>
                            <select name="secondelectiveone" class="form-control select2" required>
                            <option value="Commerce" selected>Commerce</option>
                            </select>
                        </td>
                        <td>
                            <select name="secondelectivetwo" class="form-control select2" required>
                            <option value="Commerce" selected>Commerce</option>
                            </select>
                        </td>
                        </tr>
                        <tr>
                        <td>3.</td>
                        <td>
                            <select name="thirdchoice" class="form-control select2" required>
                            <option value="Commerce" selected>Commerce</option>
                            </select>
                        </td>
                        <td>
                            <select name="thirdelectiveone" class="form-control select2" required>
                            <option value="Commerce" selected>Commerce</option>
                            </select>
                        </td>
                        <td>
                            <select name="thirdelectivetwo" class="form-control select2" required>
                            <option value="Commerce" selected>Commerce</option>
                            </select>
                        </td>
                        </tr>
                        -->
                        <tr>
                        <input type="hidden" name="program" value="<?php echo $row[0]; ?>">
                        <input type="hidden" name="page" value="coresubjectcombination">
                        <td colspan="4"><center><button type="submit" class="btn btn-info"><i class="fas fa-database"></i>&emsp;Submit</button></center></td>
                        </tr>                      
                      <?php
                      }
                      else if($row[0] == "B.A"){ //If B.Sc then need to choose subject choice
                        //for BSC Subject Combination choice                           
                     ?>
                     <!-- for B.A -->
                     <script>
                         var stateObject = {
                             "English": { 
                                 "Education": ["Economics", "History", "Political Sc."], 
                                 "Geography": ["Economics", "History", "Political Sc."],
                                 "Economics": ["Education", "History", "Political Sc.", "Geography"], 
                                 "History": ["Economics", "Education", "Political Sc.", "Geography"], 
                                 "Political Sc": ["Economics", "History", "Education", "Geography"]                                 
                             },
                             "Mizo": { 
                                "Education": ["Economics", "History", "Political Sc."], 
                                 "Geography": ["Economics", "History", "Political Sc."],
                                 "Economics": ["Education", "History", "Political Sc.", "Geography"], 
                                 "History": ["Economics", "Education", "Political Sc.", "Geography"], 
                                 "Political Sc": ["Economics", "History", "Education", "Geography"] 
                             },
                             "Education": { 
                                "English": ["Economics", "History", "Political Sc."], 
                                 "Mizo": ["Economics", "History", "Political Sc."],
                                 "Economics": ["English", "Mizo", "History", "Political Sc."], 
                                 "History": ["Economics", "English", "Mizo","Political Sc."], 
                                 "Political Sc": ["Economics", "History", "English", "Mizo"] 
                             },                             
                             "History": { 
                                 "English": ["Economics", "Political Sc", "Education", "Geography"], 
                                 "Mizo": ["Economics", "Political Sc", "Education", "Geography"],
                                 "Economics": ["Education", "Political Sc.", "Geography", "English", "Mizo"], 
                                 "Education": ["Economics", "Mizo", "English", "Political Sc."], 
                                 //"Geography": ["Economics", "Mizo", "English", "Political Sc."],
                                 "Political Sc": ["Economics", "Education", "Geography", "English", "Mizo"]                              
                             },
                             "Political Sc": { 
                                "English": ["Economics", "Political Sc", "Education", "Geography"], 
                                 "Mizo": ["Economics", "English", "Education", "Geography"],
                                 "Economics": ["Education", "History", "Geography", "English", "Mizo"], 
                                 "Education": ["Economics", "Mizo", "English", "History"], 
                                 "Geography": ["Economics", "Mizo", "English", "History"],
                                 "History": ["Economics", "Education", "Geography", "English", "Mizo"]
                             },
                             "Economics": { 
                                "English": ["History", "Political Sc", "Education", "Geography"], 
                                 "Mizo": ["History", "Political Sc", "Education", "Geography"], 
                                 "Education": ["History", "Mizo", "English", "Political Sc."], 
                                 "Geography": ["History", "Mizo", "English", "Political Sc."],
                                 "History": ["Political Sc", "Education", "Geography", "English", "Mizo"]
                             },
                         }    

                         /* 
                         "Geography": { 
                                "English": ["Economics", "History", "Political Sc."], 
                                 "Mizo": ["Economics", "History", "Political Sc."],
                                 "Economics": ["History", "Political Sc.", "English", "Mizo"], 
                                 "History": ["Economics", "Political Sc.", "English", "Mizo"], 
                                 "Political Sc": ["Economics", "History", "English", "Mizo"] 
                             },
                         
                         */                 
                     </script>

                     <tr>
                     <td>1.</td>
                     <td>
                         <select name="firstchoice" id="firstchoice" class="form-control select2" required>
                             <option value="" selected="selected">Select Core</option>                             
                         </select>
                     </td>
                     <td>
                         <select name="firstelectiveone" id="firstelectiveone" class="form-control select2" required>
                             <option value="" selected>Elective Choice</option>
                         </select>
                     </td>
                     <td>
                         <select name="firstelectivetwo" id="firstelectivetwo" class="form-control select2" required>
                             <option value="" selected>Elective Choice</option>
                         </select>
                     </td>
                     </tr>
                    <!--
                     <tr>
                     <td>2.</td>
                     <td>
                         <select name="secondchoice" id="secondchoice" class="form-control select2" required>
                             <option value="" selected>Select Core</option>                                
                         </select>
                     </td>
                     <td>
                         <select name="secondelectiveone" id="secondelectiveone" class="form-control select2" required>
                         <option value ="" selected>Elective Choice</option>
                         </select>
                     </td>
                     <td>
                         <select name="secondelectivetwo" id="secondelectivetwo" class="form-control select2" required>
                         <option value ="" selected>Elective Choice</option>
                         </select>
                     </td>
                     </tr>
                     <tr>
                     <td>3.</td>
                     <td>
                         <select name="thirdchoice" id="thirdchoice" class="form-control select2" required>
                             <option value="" selected>Select Core</option>                                
                         </select>
                     </td>
                     <td>
                         <select name="thirdelectiveone" id="thirdelectiveone" class="form-control select2" required>
                         <option value ="" selected>Elective Choice</option>
                         </select>
                     </td>
                     <td>
                         <select name="thirdelectivetwo" id="thirdelectivetwo" class="form-control select2" required>
                         <option value ="" selected>Elective Choice</option>
                         </select>
                     </td>
                     </tr>
                     -->
                     <tr>
                     <input type="hidden" name="program" value="<?php echo $row[0]; ?>">
                     <input type="hidden" name="page" value="coresubjectcombination">
                     <td colspan="4"><center><button type="submit" class="btn btn-info"><i class="fas fa-database"></i>&emsp;Submit</button></center></td>
                     </tr>
                   <?php
                   }     
                      else{ //If B.Sc then need to choose subject choice
                           //for BSC Subject Combination choice                           
                        ?>
                        <!-- for B.Sc -->
                        <script>
                            var stateObject = {
                                "Botany": { 
                                    "Chemistry": ["Zoology"], 
                                },
                                "Chemistry": { 
                                    "Botany": ["Zoology"], 
                                    "Mathematics": ["Physics"] 
                                },
                                "Mathematics": { 
                                    "Physics": ["Chemistry"],
                                    "Chemistry": ["Physics"]  
                                },
                                "Physics": { 
                                    "Mathematics": ["Chemistry"], 
                                    "Chemistry": ["Mathematics"] 
                                },
                                "Zoology": { 
                                    "Chemistry": ["Botany"] 
                                },
                            }
                        
                        </script>

                        <tr>
                        <td>1.</td>
                        <td>
                            <select name="firstchoice" id="firstchoice" class="form-control select2" required>
                                <option value="" selected="selected">Select Core</option>                             
                            </select>
                        </td>
                        <td>
                            <select name="firstelectiveone" id="firstelectiveone" class="form-control select2" required>
                                <option value="" selected>Elective Choice</option>
                            </select>
                        </td>
                        <td>
                            <select name="firstelectivetwo" id="firstelectivetwo" class="form-control select2" required>
                                <option value="" selected>Elective Choice</option>
                            </select>
                        </td>
                        </tr>
                        <tr>
                        <!--
                        <td>2.</td>
                        <td>
                            <select name="secondchoice" id="secondchoice" class="form-control select2" required>
                                <option value="" selected>Select Core</option>                                
                            </select>
                        </td>
                        <td>
                            <select name="secondelectiveone" id="secondelectiveone" class="form-control select2" required>
                            <option value ="" selected>Elective Choice</option>
                            </select>
                        </td>
                        <td>
                            <select name="secondelectivetwo" id="secondelectivetwo" class="form-control select2" required>
                            <option value ="" selected>Elective Choice</option>
                            </select>
                        </td>
                        </tr>
                        <tr>
                        <td>3.</td>
                        <td>
                            <select name="thirdchoice" id="thirdchoice" class="form-control select2" required>
                                <option value="" selected>Select Core</option>                                
                            </select>
                        </td>
                        <td>
                            <select name="thirdelectiveone" id="thirdelectiveone" class="form-control select2" required>
                            <option value ="" selected>Elective Choice</option>
                            </select>
                        </td>
                        <td>
                            <select name="thirdelectivetwo" id="thirdelectivetwo" class="form-control select2" required>
                            <option value ="" selected>Elective Choice</option>
                            </select>
                        </td>
                        </tr>
                        -->
                        <tr>
                        <input type="hidden" name="program" value="<?php echo $row[0]; ?>">
                        <input type="hidden" name="page" value="coresubjectcombination">
                        <td colspan="4"><center><button type="submit" class="btn btn-info"><i class="fas fa-database"></i>&emsp;Submit</button></center></td>
                        </tr>
                      <?php
                      }
                      ?>                     
                    
                  </tbody>
                </table>
                </form>
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