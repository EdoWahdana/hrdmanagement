<?php include "session.php"; ?>
<!DOCTYPE html>
<html>
  <?php include "head.php"; ?>
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
            Detail Cuti
            <small>Human Resource Management System</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Cuti</li>
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
                  <h3 class="box-title">Detail Data Cuti</h3>
                  <div class="box-tools pull-right">
                
                  </div> 
                </div><!-- /.box-header -->
                <?php
            $query = mysqli_query($koneksi, "SELECT * FROM cuti WHERE kode='$_GET[id]'");
            $data  = mysqli_fetch_array($query);
            ?>
                <div class="box-body">
                  <div class="form-panel">
                  <table id="example" class="table table-hover table-bordered">
                      <tr>
                      <td>Nik</td>
                      <td><?php echo $data['nik']; ?></td>
                      <td rowspan="8"><img src="<?php echo $data['gambar'] ?>" class="img-rounded" height="300" width="225" style="border: 2px solid #666666;" /></td>
                      </tr>
                      <tr>
                      <td width="250">Nama</td>
                      <td width="700" colspan="1"><?php echo $data['nama']; ?></td>
                      </tr>
                      <tr>
                      <td>Tanggal Awal</td>
                      <td><?php echo $data['tanggal_awal']; ?></td>
                      </tr>
                      <tr>
                      <td>Tanggal Akhir/td>
                      <td><?php echo $data['tanggal_akhir']; ?></td>
                      </tr>
                      <tr>
                      <td>Jumlah Cuti</td></td>
                      <td><?php echo $data['jumlah']; ?></td>
                      </tr>
                      <tr>
                      <td>Jenis Cuti</td>
                      <td><?php echo $data['jenis_cuti']; ?></td>
                      </tr>
                      <tr>
                      <td>Keterangan</td></td>
                      <td><?php echo $data['ket']; ?></td>
                      </tr>
                      <tr>
                      <td>Status</td></td>
                      <td><?php echo $data['status']; ?></td>
                      </tr>
                      </table>
                      <div class="text-right">
                  <a href="cuti.php" class="btn btn-sm btn-warning">Kembali <i class="fa fa-arrow-circle-right"></i></a>
              
                </div>
                  </div>
                </div><!-- /.box-body -->
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

    <script src="../plugins/datepicker/bootstrap-datepicker.js"></script>

    <script src="../plugins/select2/select2.full.min.js"></script>

    <script>
	//options method for call datepicker
	$(".input-group.date").datepicker({ autoclose: true, todayHighlight: true });
	
    </script>

  <script>
     $(function () {
    $(".select2").select2();
    });
    </script>
  </body>
</html>
