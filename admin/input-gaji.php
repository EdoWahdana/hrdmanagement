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
            Gaji
            <small>Human Resource Management System</small>
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
                  <h3 class="box-title">Input Data Gaji Karyawan</h3>
                  <div class="box-tools pull-right">
                  </div> 
                </div><!-- /.box-header -->

                <div class="box-body">
                  <form class="form-horizontal style-form" action="insert_gaji.php" method="post" enctype="multipart/form-data" name="form1" id="form1">
                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Nama</label>
                            <div class="col-sm-4">
                              <select name="id_karyawan" id="id_karyawan" class="form-control select2" required>
                                <option selected disabled hidden> --- Pilih Pegawai --- </option>
                                <!-- Ambil data pegawai yang belum ada di tabel gaji -->
                                <?php 
                                  $sql = "SELECT id_karyawan, no_karyawan, nama FROM karyawan_new";
                                  $exec = mysqli_query($koneksi, $sql);
                                    while($data = mysqli_fetch_array($exec)) { 
                                      echo "<option value='" .$data['id_karyawan']. "'>" .$data['no_karyawan']. " - " .$data['nama']. "</option>"; 
                                    }
                                ?>
                              </select>
                            </div>
                        </div>                               
                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Periode</label>
                            <div class="col-sm-4">
                              <select name="periode" id="periode" class="form-control select2" required>
                                <option selected disabled hidden> --- Pilih Periode --- </option>
                                <!-- Ambil data periode yang belum ada di tabel gaji -->
                                <?php 
                                  // Membuat variabel array untuk menyimpan nama bulan
                                  $bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                                  $sql = "SELECT id_periode, bulan, tahun FROM periode";
                                  $exec = mysqli_query($koneksi, $sql);
                                    while($data = mysqli_fetch_array($exec)) { 
                                      echo "<option value='" .$data['id_periode']. "'>" .$bulan[$data['bulan'] - 1]. " - " .$data['tahun']. "</option>"; 
                                    }
                                ?>
                              </select>
                            </div>
                        </div>                               
                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Tanggal</label>
                            <div class="col-sm-4">
                              <input name="tanggal" type="text" id="tanggal" class="input-group date" data-date="" data-date-format="yyyy-mm-dd" placeholder="Tanggal Gajian" required='required' autocomplete="off" value="<?= isset($_POST['tanggal']) ? $_POST['tanggal'] : '' ?>" />
                            </div>
                        </div>                             
                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Tunjangan Dana Hari Tua</label>
                            <div class="col-sm-4">
                              <input name="dht" type="text" id="dht" class="form-control" placeholder="Tunjangan Dana Hari Tua" required='required' value="<?= isset($_POST['dht']) ? $_POST['dht'] : '' ?>" />
                            </div>
                        </div>                             
                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Bonus / Gratifikasi / Tantiem dll</label>
                            <div class="col-sm-4">
                              <input name="bonus" type="text" id="bonus" class="form-control" placeholder="Bonus Gaji" required='required' value="<?= isset($_POST['bonus']) ? $_POST['bonus'] : '' ?>" />
                            </div>
                        </div>                             
                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">BPJS Kesehatan</label>
                            <div class="col-sm-4">
                              <input name="bpjs_ks" type="text" id="bpjs_ks" class="form-control" placeholder="Tunjangan BPJS Kesehatan" required='required' value="<?= isset($_POST['bpjs_ks']) ? $_POST['bpjs_ks'] : '' ?>" />
                            </div>
                        </div>                             
                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">BPJS Ketenagakerjaan</label>
                            <div class="col-sm-4">
                              <input name="bpjs_kj" type="text" id="bpjs_kj" class="form-control" placeholder="Tunjangan BPJS Ketenagakerjaan" required='required' value="<?= isset($_POST['bpjs_kj']) ? $_POST['bpjs_kj'] : '' ?>" />
                            </div>
                        </div>                           
                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Pilihan Lembur Holiday</label>
                            <div class="col-sm-4">
                              <select name="ph" id="ph">
                                    <option selected disabled hidden> --- Jenis Lembur Holiday --- </option>
                                    <option value='0.5'>0.5</option>
                                    <option value='1'>1</option>
                              </select>
                            </div>
                        </div>                           
                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label"></label>
                            <div class="col-sm-10">
                                <input type="submit" name="input" value="Simpan" class="btn btn-sm btn-primary" />&nbsp;
                                <a href="gaji.php" class="btn btn-sm btn-danger">Batal </a>
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
    <!-- Custom JS file -->
    <script src="../dist/js/main.js"></script>

    <script src="../plugins/datepicker/bootstrap-datepicker.js"></script>

    <script src="../plugins/select2/select2.full.min.js"></script>

    <script>
    //options method for call datepicker
    $(".input-group.date").datepicker({ 
      autoclose: true, 
      todayHighlight: true 
    });
	
    </script>

    <script>
      $(function () {
        $(".select2").select2();
      });

      // $('id_karyawan').change(function() {
      //   var karyawan = $(this).val();
      //   var data = {id: karyawan};
      //   $.post('ajax-data-gajiperiode.php', data, function(data) {
      //     $.each(data, function(index, value) {
      //       $('periode').val(value);
      //     });
      //   });
      // });

      var dht = document.getElementById('dht');
      var bonus = document.getElementById('bonus');
      var bpjs_ks = document.getElementById('bpjs_ks');
      var bpjs_kj = document.getElementById('bpjs_kj');

      dht.addEventListener("keyup", function(e){
        dht.value = convertToRupiah(dht.value, "");
      });
      bonus.addEventListener("keyup", function(e){
        bonus.value = convertToRupiah(bonus.value, "");
      });
      bpjs_ks.addEventListener("keyup", function(e){
        bpjs_ks.value = convertToRupiah(bpjs_ks.value, "");
      });
      bpjs_kj.addEventListener("keyup", function(e){
        bpjs_kj.value = convertToRupiah(bpjs_kj.value, "");
      });
    </script>
  </body>
</html>
