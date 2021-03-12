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
            Update Absensi
            <small>Human Resource Mangement System</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Absensi</li>
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
                  <h3 class="box-title">Update Absensi Karyawan</h3>
                  <div class="box-tools pull-right">
                  </div> 
                </div><!-- /.box-header -->

                <?php
                    $id = $_GET['id'];
                    $sql = mysqli_query($koneksi, "SELECT * FROM v_absensi WHERE id_absensi='$id'");
                    if(mysqli_num_rows($sql) == 0) {
                      header("Location: absensi.php");
                    } else {
                      $row = mysqli_fetch_assoc($sql);

                    // Ubah angka menjadi nama bulan
                    $bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                    $namaBulan = $bulan[$row['bulan'] - 1];
                    }                   
                ?>

                      <div class="box-body">
                        <form class="form-horizontal style-form" action="update_absensi.php" method="post" enctype="multipart/form-data" name="form1" id="form1">

                          <input type="hidden" name="id_absensi" id="id_absensi" value=<?= $_GET['id']; ?>>

                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Nama Karyawan</label>
                              <div class="col-sm-4">
                                <input name="nama" type="text" id="nama" class="form-control" disabled=true value="<?php echo $row['nama']; ?>" /> 
                            </div>
                          </div>

                          <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Periode</label>
                            <div class="col-sm-4">
                            <input name="periode" type="text" id="periode" class="form-control" disabled=true value="<?=$namaBulan ?> - <?=$row['tahun']; ?>" /> 
                            </div>
                          </div>

                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Jumlah Sakit</label>
                              <div class="col-sm-4">
                                <input name="jumlah_sakit" type="text" id="jumlah_sakit" class="form-control " value="<?php echo $row['jumlah_sakit']; ?>" style="width: 100px;" required /> 
                              </div>
                          </div>

                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Jumlah Izin</label>
                              <div class="col-sm-4">
                                <input name="jumlah_izin" type="text" id="jumlah_izin" class="form-control" value="<?php echo $row['jumlah_izin']; ?>" style="width: 100px;" required /> 
                              </div>
                          </div>

                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Jumlah Cuti</label>
                              <div class="col-sm-4">
                                <input name="jumlah_cuti" type="text" id="jumlah_cuti" class="form-control" value="<?php echo $row['jumlah_cuti']; ?>" style="width: 100px;" required /> 
                              </div>
                          </div>

                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Jumlah Tanpa Keterangan</label>
                              <div class="col-sm-4">
                                <input name="jumlah_tk" type="text" id="jumlah_tk" class="form-control" value="<?php echo $row['jumlah_tk']; ?>" style="width: 100px;" required /> 
                              </div>
                          </div>

                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Jumlah Backup Kekosongan</label>
                              <div class="col-sm-4">
                                <input name="jumlah_backup" type="text" id="jumlah_backup" class="form-control" value="<?php echo $row['jumlah_backup']; ?>" style="width: 100px;" required /> 
                              </div>
                          </div>

                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Jumlah Lembur Holiday</label>
                              <div class="col-sm-4">
                                <input name="jumlah_lembur_holiday" type="text" id="jumlah_lembur_holiday" class="form-control" value="<?php echo $row['jumlah_lembur_holiday']; ?>" style="width: 100px;" required /> 
                              </div>
                          </div>

                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Jumlah Lembur Reguler</label>
                              <div class="col-sm-4">
                                <input name="jumlah_lembur_reguler" type="text" id="jumlah_lembur_reguler" class="form-control" value="<?php echo $row['jumlah_lembur_reguler']; ?>" style="width: 100px;" required /> 
                              </div>
                          </div>

                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label"></label>
                              <div class="col-sm-10">
                                  <input type="submit" name="update" value="Update" class="btn btn-sm btn-primary" />&nbsp;
	                              <a href="absensi.php" class="btn btn-sm btn-danger">Batal </a>
                              </div> 
                          </div>
                      </form>
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

      function previewImage(fileId, previewId) {
        document.getElementById(previewId).style.display = "block";
        var oFReader = new FileReader();
        oFReader.readAsDataURL(document.getElementById(fileId).files[0]);
    
        oFReader.onload = function(oFREvent) {
          document.getElementById(previewId).src = oFREvent.target.result;
        };
      };
    </script>
  </body>
</html>
