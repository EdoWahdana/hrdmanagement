<?php include "session.php"; ?>
<!DOCTYPE html>
<html>
 <?php include "head.php" ?>
  </head>
  <body class="hold-transition skin-purple sidebar-mini">
    <div class="wrapper">

      <?php include "header.php"; ?>
      <!-- Left side column. contains the logo and sidebar -->
      <?php include "menu.php"; ?>

<?php include "waktu.php"; ?>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Gaji
            <small>HRD Management System</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Gaji</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- Main row -->
          <div class="row">
            <!-- Left col -->
            <section class="col-lg-12 connectedSortable">

              <!-- TO DO List -->
              <div class="box box-primary">
                <div class="box-header">
                  <i class="ion ion-clipboard"></i>
                  <h3 class="box-title">Gaji Karyawan</h3>
                  <div class="box-tools pull-right">
                  </div> 
                </div><!-- /.box-header -->
                
                <div class="box-body">
                <?php
                    if(isset($_GET['aksi']) == 'delete'){
                        $id = $_GET['id'];
                        $cek = mysqli_query($koneksi, "SELECT * FROM gaji WHERE nik='$id'");
                        if(mysqli_num_rows($cek) == 0){
                            echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Data tidak ditemukan.</div>';
                        }else{
                            $delete = mysqli_query($koneksi, "DELETE FROM gaji WHERE nik='$id'");
                            if($delete){
                                echo '<div class="alert alert-primary alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Data berhasil dihapus.</div>';
                            }else{
                                echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Data gagal dihapus.</div>';
                            }
                        }
                    }
                ?>
                <!-- <form action='admin.php' method="POST">
          
	       <input type='text' class="form-control" style="margin-bottom: 4px;" name='qcari' placeholder='Cari berdasarkan User ID dan Username' required /> 
           <input type='submit' value='Cari Data' class="btn btn-sm btn-primary" /> <a href='admin.php' class="btn btn-sm btn-success" >Refresh</i></a>
          	</div>
            </form>-->
            <a href="gaji_importxls.php" class="btn btn-sm btn-warning"><i class="fa fa-file"></i> Import Excel</a> <a href="gaji_exportxls.php" class="btn btn-sm btn-success"><i class="fa fa-file"></i> Export Excel</a><br /><br />
                <table id="lookup" class="table table-bordered table-hover">  
                    <thead bgcolor="eeeeee" align="center">
                    <tr>
                        <th>Projek</th>
                        <th>Role</th>
                        <th>Sakit</th>
                        <th>Izin</th>
                        <th>Cuti</th>
                        <th>Tanpa Keterangan</th>
                        <th>Backup Kekosongan</th>
                        <th>Lembur Holiday</th>
                        <td class="text-center"> Action </td> 
                    </tr>
                    </thead>
                    <tbody>              
                    </tbody>
                </table>  
                </div><!-- /.box-body -->
                <div class="box-footer clearfix no-border">
                  <a href="input-gaji.php" class="btn btn-sm btn-default pull-right"><i class="fa fa-plus"></i> Tambah Gaji Karyawan</a>
                  </div>
              </div><!-- /.box -->

            </section><!-- /.Left col -->
          </div><!-- /.row (main row) -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <?php include "footer.php"; ?>

      <?php include "sidecontrol.php"; ?>
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.4 -->
    <script src="../plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <!-- DataTables -->
    <script src="../plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../plugins/datatables/dataTables.bootstrap.min.js"></script> 
    <!-- SlimScroll -->
    <script src="../plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="../plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../dist/js/app.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../dist/js/demo.js"></script>
	  <!--<script type="text/javascript"> 

            $(function () {
                $("#lookup").dataTable({"lengthMenu":[25,50,75,100],"pageLength":25});
            });
  
   
        </script>-->
 <script>
    $(document).ready(function() {
            var dataTable = $('#lookup').DataTable( {
                "processing": true,
                "serverSide": true,
                "ajax": {
                    url :"ajax-grid-rulegaji.php", // json datasource
                    type: "post",  // method  , by default get
                    error: function(jqXHR, ajaxOptions, thrownError) {
                        alert(thrownError + "\r\n" + jqXHR.statusText + "\r\n" + jqXHR.responseText + "\r\n" + ajaxOptions.responseText);
                    }
                }
            } );
        } );
</script>
  </body>
</html>
