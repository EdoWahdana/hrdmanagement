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
            Laporan
            <small></small>
          </h1> 
          <ol class="breadcrumb">
            <li><a href="../index.php"><i class="fa fa-dashboard"></i> Laporan</a></li>
            <li class="active">Laporan Gaji</li>
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
                        <h3 class="box-title">Laporan Gaji Karyawan</h3>
                        <div class="box-tools pull-right">
                        </div> 
                    </div><!-- /.box-header -->
                    
                    <!-- Ambil data periode yang ada di tabel gaji -->
                    <?php 
                        // Membuat variabel array untuk menyimpan nama bulan
                        $bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                        $sql = "SELECT id_periode, bulan, tahun FROM v_gaji";
                        $exec = mysqli_query($koneksi, $sql);
                    ?>

                    <div class="box-body">
                        <div class="row">
                            <h4 class="text-center">Export Laporan Gaji Karyawan</h4>
                            <br>
                            <div class="col-lg-offset-1 col-lg-6 text-center">
                                <select class="form-control select2" name="periode" id="periode">
                                    <option selected disabled hidden> --- Pilih Periode --- </option>
                                    <option value="semua"> Semua Periode </option>
                                    <?php while ($data = mysqli_fetch_array($exec)) {
                                        echo "<option value=".$data['id_periode'].">". $bulan[$data['bulan'] - 1] ." - ". $data['tahun'];
                                    } ?>
                                </select>
                            </div>
                            <div class="col-lg-3 text-center">
                                <a class="btn btn-sm btn-success" id="btnExport"><i class="fa fa-file"></i> Export Data Gaji</a><br /><br />
                            </div>
                        </div>
                    </div><!-- /.box-body --><br/>
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

    $("#periode").change(function() {
        var id = $(this).val();
        $("#btnExport").attr('href', 'gaji_exportxlsx.php?id='+id);
        $("#btnExport").text('Export data ' + $('#periode option:selected').text());
    });
    </script>
  </body>
</html>
