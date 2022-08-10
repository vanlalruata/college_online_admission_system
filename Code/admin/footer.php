<footer class="main-footer">
    <?php
        require_once '../config/dbconfig.php';
        $mysqli = new mysqli(DBHOST, DBUSER, DBPWD, DBNAME);
        $query = "select copyright_text from tbl_general_settings where college_id = 1";
        $result = $mysqli->query($query);
        $row = $result->fetch_row();
        echo '<strong>' . $row[0] . '</strong>';        
    ?>
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 2.1.2 | <span><strong>Developed by:</strong> Vanlalruata Hnamte</span>
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-light">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->


<!-- jQuery UI 1.11.4 -->
<script src="../plugins/jquery-ui/jquery-ui.min.js"></script>



<!-- daterangepicker -->
<script src="../plugins/moment/moment.min.js"></script>
<script src="../plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="../plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- overlayScrollbars -->
<script src="../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- Input Mask -->
<script src="../plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>
<!-- Summernote -->
<script src="../plugins/summernote/summernote-bs4.min.js"></script>
<!-- bs-custom-file-input -->
<script src="../plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<!-- DataTables -->
<script src="../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script> 
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>

<script>
  $(function () {
    // Summernote
    $('.textarea').summernote()
  })
</script>

<!-- page script -->
<script>
  $(function () {
    $("#applicant").DataTable({
      "responsive": true,
      "autoWidth": false,
	  dom: 'Bfrtip',
    lengthMenu: [[10, 25, 50,100,200,300,400, 1000], [10, 25, 50,100,200,300,400, 1000]],
		buttons: [{
                extend:    'copyHtml5',
                text:      '<i class="fa fa-copy"></i>&nbsp;Copy',
                titleAttr: 'Copy'
            },
            {
                extend:    'excelHtml5',
                text:      '<i class="fa fa-file-excel"></i>&nbsp;Excel',
                titleAttr: 'Excel'
            },
            {
                extend:    'csvHtml5',
                text:      '<i class="fa fa-file-csv"></i>&nbsp;CSV',
                titleAttr: 'CSV'
            },
            {
                extend:    'pdfHtml5',
                text:      '<i class="fa fa-file-pdf"></i>&nbsp;PDF',
                titleAttr: 'PDF'
            },
			{
                extend:    'print',
                text:      '<i class="fa fa-print"></i>&nbsp;Print',
                titleAttr: 'Print'
            }
        ]
    });
  
  });
  
</script>


<script type="text/javascript">
$(document).ready(function () {
  bsCustomFileInput.init();
});
</script>
<script>
$(document).ready(function () {
    $('.nav-side').click(function(e) {
        $('.nav-side.active').removeClass('active');        
        $(this).addClass("active");        
    });
    $('.has-treeview').click(function(e) {
        //$('.has-treeview.active').removeClass('menu-open');        
        //$(this).addClass("menu-open");
    });    
});

</script>

<!-- Page script -->
<script>
  $(function () {
    
    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd-mm-yyyy' })
    
    $('[data-mask]').inputmask()

    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({
      timePicker: true,
      timePickerIncrement: 30,
      locale: {
        format: 'MM/DD/YYYY hh:mm A'
      }
    });  
  });      
</script>

</body>
</html>