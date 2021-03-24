<?php include "../session.php"; ?>
<!DOCTYPE html>
<html>
  <?php include "../head.php"; ?>
  <body class="hold-transition skin-purple sidebar-mini">
    <div class="wrapper">

      <?php include "../header.php"; ?>
      <!-- Left side column. contains the logo and sidebar -->
      <?php include "../menu.php"; ?>

<?php include "../waktu.php"; ?>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Update Absensi
            <small>Human Resource Mangement System</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="../index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
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
                        <div class="form-horizontal style-form">

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
                              <label class="col-sm-2 control-label">Jumlah Sakit</label>
                              <div class="col-sm-2">
                                <input name="jumlah_sakit" type="text" id="jumlah_sakit" disabled class="form-control " value="<?php echo $row['jumlah_sakit']; ?>" /> 
                              </div>
                              <div class="col-sm-2">
                                <button type="button" id="buttonSakit" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-plus"></i></button>
                              </div>
                              <div class="col-sm-4" id="form-sakit" style="display:none">
                                <div class="col-sm-4 col-md-6">
                                  <input type="date" name="tanggal_sakit" id="tanggal_sakit">
                                </div>
                                <div class="col-sm-4 col-md-6">
                                  <button name="update_sakit" id="update_sakit" class="btn btn-sm btn-primary" onclick="updateAbsensi('id_absensi', 'jumlah_sakit', 'tanggal_sakit');"><i class="glyphicon glyphicon-plus"></i> Submit Tanggal Sakit</button>
                                </div>
                              </div>
                          </div>

                          <div class="form-group">
                              <label class="col-sm-2 control-label">Jumlah Izin</label>
                              <div class="col-sm-2">
                                <input name="jumlah_izin" type="text" id="jumlah_izin" disabled class="form-control" value="<?php echo $row['jumlah_izin']; ?>" /> 
                              </div>
                              <div class="col-sm-2">
                                <button type="button" id="buttonIzin" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-plus"></i></button>
                              </div>
                              <div class="col-sm-4" id="form-izin" style="display:none">
                                <div class="col-sm-4 col-md-6">
                                  <input type="date" name="tanggal_izin" id="tanggal_izin">
                                </div>
                                <div class="col-sm-4 col-md-6">
                                  <button name="update_izin" id="update_izin" class="btn btn-sm btn-primary" onclick="updateAbsensi('id_absensi', 'jumlah_izin', 'tanggal_izin');"><i class="glyphicon glyphicon-plus"></i> Submit Tanggal Izin</button>
                                </div>
                              </div>
                          </div>

                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Jumlah Cuti</label>
                              <div class="col-sm-2">
                                <input name="jumlah_cuti" type="text" id="jumlah_cuti" disabled class="form-control" value="<?php echo $row['jumlah_cuti']; ?>" /> 
                              </div>
                              <div class="col-sm-2">
                                <button type="button" id="buttonCuti" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-plus"></i></button>
                              </div>
                              <div class="col-sm-4" id="form-cuti" style="display:none">
                                <div class="col-sm-4 col-md-6">
                                  <input type="date" name="tanggal_cuti" id="tanggal_cuti">
                                </div>
                                <div class="col-sm-4 col-md-6">
                                  <button name="update_cuti" id="update_cuti" class="btn btn-sm btn-primary" onclick="updateAbsensi('id_absensi', 'jumlah_cuti', 'tanggal_cuti');"><i class="glyphicon glyphicon-plus"></i> Submit Tanggal Cuti</button>
                                </div>
                              </div>
                          </div>

                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Jumlah Tanpa Keterangan</label>
                              <div class="col-sm-2">
                                <input name="jumlah_tk" type="text" id="jumlah_tk" disabled class="form-control" value="<?php echo $row['jumlah_tk']; ?>" /> 
                              </div>
                              <div class="col-sm-2">
                                <button type="button" id="buttonTk" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-plus"></i></button>
                              </div>
                              <div class="col-sm-4" id="form-tk" style="display:none">
                                <div class="col-sm-4 col-md-6">
                                  <input type="date" name="tanggal_tk" id="tanggal_tk">
                                </div>
                                <div class="col-sm-4 col-md-6">
                                  <button name="update_tk" id="update_tk" class="btn btn-sm btn-primary" onclick="updateAbsensi('id_absensi', 'jumlah_tk', 'tanggal_tk');"><i class="glyphicon glyphicon-plus"></i> Submit Tanggal Tanpa Keterangan</button>
                                </div>
                              </div>
                          </div>

                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Jumlah Backup Kekosongan</label>
                              <div class="col-sm-2">
                                <input name="jumlah_backup" type="text" id="jumlah_backup" disabled class="form-control" value="<?php echo $row['jumlah_backup']; ?>" /> 
                              </div>
                              <div class="col-sm-2">
                                <button type="button" id="buttonBackup" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-plus"></i></button>
                              </div>
                              <div class="col-sm-4" id="form-backup" style="display:none">
                                <div class="col-sm-4 col-md-6">
                                  <input type="date" name="tanggal_backup" id="tanggal_backup">
                                </div>
                                <div class="col-sm-4 col-md-6">
                                  <button name="update_backup" id="update_backup" class="btn btn-sm btn-primary" onclick="updateAbsensi('id_absensi', 'jumlah_backup', 'tanggal_backup');"><i class="glyphicon glyphicon-plus"></i> Submit Tanggal Bakcup</button>
                                </div>
                              </div>
                          </div>

                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Jumlah Lembur Holiday</label>
                              <div class="col-sm-2">
                                <input name="jumlah_lembur_holiday" type="text" id="jumlah_lembur_holiday" disabled class="form-control" value="<?php echo $row['jumlah_lembur_holiday']; ?>" /> 
                              </div>
                              <div class="col-sm-2">
                                <button type="button" id="buttonLemburHoliday" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-plus"></i></button>
                              </div>
                              <div class="col-sm-4" id="form-lembur-holiday" style="display:none">
                                <div class="col-sm-4 col-md-6">
                                  <input type="date" name="tanggal_lembur_holiday" id="tanggal_lembur_holiday">
                                </div>
                                <div class="col-sm-4 col-md-6">
                                  <button name="update_lembur_holiday" id="update_lembur_holiday" class="btn btn-sm btn-primary" onclick="updateAbsensi('id_absensi', 'jumlah_lembur_holiday', 'tanggal_lembur_holiday');"><i class="glyphicon glyphicon-plus"></i> Submit Tanggal Lembur Holiday</button>
                                </div>
                              </div>
                          </div>

                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Jumlah Lembur Reguler</label>
                              <div class="col-sm-2">
                                <input name="jumlah_lembur_reguler" type="text" id="jumlah_lembur_reguler" disabled class="form-control" value="<?php echo $row['jumlah_lembur_reguler']; ?>" /> 
                              </div>
                              <div class="col-sm-2">
                                <button type="button" id="buttonLemburReguler" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-plus"></i></button>
                              </div>
                              <div class="col-sm-4" id="form-lembur-reguler" style="display:none">
                                <div class="col-sm-4 col-md-6">
                                  <input type="date" name="tanggal_lembur_reguler" id="tanggal_lembur_reguler">
                                </div>
                                <div class="col-sm-4 col-md-6">
                                  <button name="update_lembur_reguler" id="update_lembur_reguler" class="btn btn-sm btn-primary" onclick="updateAbsensi('id_absensi', 'jumlah_lembur_reguler', 'tanggal_lembur_reguler');"><i class="glyphicon glyphicon-plus"></i> Submit Tanggal Lembur Reguler</button>
                                </div>
                              </div>
                          </div>

                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label"></label>
                              <div class="col-sm-10">
	                              <a href="absensi.php" class="btn btn-sm btn-danger">Kembali </a>
                              </div> 
                          </div>
                      </div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->

            </section><!-- /.Left col -->
          </div><!-- /.row (main row) -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <?php include "../footer.php"; ?>

      <?php include "../sidecontrol.php"; ?>
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->

   
   <script src="../../plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="../../bootstrap/js/bootstrap.min.js"></script>
    <!-- DataTables -->
    <script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../../plugins/datatables/dataTables.bootstrap.min.js"></script>
    <!-- SlimScroll -->
    <script src="../../plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="../../plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../../dist/js/app.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../../dist/js/demo.js"></script>

    <script src="../../plugins/datepicker/bootstrap-datepicker.js"></script>

    <script src="../../plugins/select2/select2.full.min.js"></script>

    <script>
      $(function () {
        $(".select2").select2();
      });

      function updateAbsensi(id, jumlah, tanggal) {
        var data =  {
          'id' : $("#" + id).val(),
          'jumlah' : $("#" + jumlah).val(),
          'tanggal' : $("#" + tanggal).val(),
          'field' : jumlah,
          'tabel' : tanggal
        }; 
        
        $.ajax({
          url: 'update_absensi.php',
          type: 'POST',
          data: data,
          success: function(data) {
            location.reload();
            alert("Data absensi berhasil diupdate");
          }
        });
      };

      function toggleForm(form, jumlah) {
        $(form).toggle();
        if( $(form).is(":visible") )
          $(jumlah).val(parseInt($(jumlah).val()) + 1);
        else if( $(form).is(":hidden") )
          $(jumlah).val(parseInt($(jumlah).val()) - 1);
      }

      $(document).ready(function() {
        // Toggle untuk input date Jumlah Sakit
        $("#buttonSakit").click(function(){
          toggleForm("#form-sakit", "#jumlah_sakit");
        })

        // Toggle untuk input date Jumlah Izin
        $("#buttonIzin").click(function(){
          toggleForm("#form-izin", "#jumlah_izin");
        })

        // Toggle untuk input date Jumlah Cuti
        $("#buttonCuti").click(function(){
          toggleForm("#form-cuti", "#jumlah_cuti");
        })

        // Toggle untuk input date Jumlah Tanpa Keterangan
        $("#buttonTk").click(function(){
          toggleForm("#form-tk", "#jumlah_tk");
        })

        // Toggle untuk input date Jumlah Backup
        $("#buttonBackup").click(function(){
          toggleForm("#form-backup", "#jumlah_backup");
        })

        // Toggle untuk input date Jumlah Lembur Holiday 
        $("#buttonLemburHoliday").click(function(){
          toggleForm("#form-lembur-holiday", "#jumlah_lembur_holiday");
        })

        // Toggle untuk input date Jumlah Lembur Reguler 
        $("#buttonLemburReguler").click(function(){
          toggleForm("#form-lembur-reguler", "#jumlah_lembur_reguler");
        })

      });

    </script>
  </body>
</html>
