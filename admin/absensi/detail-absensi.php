<?php include "../session.php"; ?>
<!DOCTYPE html>
<html>
 <?php include "../head.php"; ?>
  </head>
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
            Detail Absensi
            <small>HRD Management System</small>
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

                <!-- Tampilkan jumlah absensi -->
                <?php
                    $idK = $_GET['idKaryawan'];
                    $idP = $_GET['idPeriode'];
                    $sql = "SELECT * FROM v_absensi WHERE id_karyawan='$idK' AND id_periode='$idP'";
                    $data = mysqli_fetch_array(mysqli_query($koneksi, $sql));
                    $bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                ?>

              <!-- TO DO List -->
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Jumlah Absensi Karyawan</h3>
                  <div class="box-tools pull-right">
                  </div> 
                <div class="row text-center">
                    <div class="col">
                        <strong><p style="font-size: 30px; margin: 0"><?= $data['nama'] ?></p></strong>
                        <strong><pre><?= $data['projek'] ?> - <?= $data['no_karyawan'] ?> - <?= $bulan[$data['bulan'] - 1] .'/'. $data['tahun'] ?></pre></strong>
                    </div>
                </div>
                <hr style="height:1px;border-width:0;color:black;background-color:black">
                <div class="row">
                    <div class="col-sm-12">
                        <table class="table text-center">
                            <th>Sakit</th>
                            <th>Izin</th>
                            <th>Cuti</th>
                            <th>Tanpa Keterangan</th>
                            <th>Backup Kekosongan</th>
                            <th>Lembur Holiday</th>
                            <th>Lembur Reguler</th>
                            <tr>
                                <td><?= $data['jumlah_sakit'] ?></td>
                                <td><?= $data['jumlah_izin'] ?></td>
                                <td><?= $data['jumlah_cuti'] ?></td>
                                <td><?= $data['jumlah_tk'] ?></td>
                                <td><?= $data['jumlah_backup'] ?></td>
                                <td><?= $data['jumlah_lembur_holiday'] ?></td>
                                <td><?= $data['jumlah_lembur_reguler'] ?></td>
                            </tr>
                            <tr>
                              <td>hari</td>
                              <td>hari</td>
                              <td>hari</td>
                              <td>hari</td>
                              <td>hari</td>
                              <td>jam</td>
                              <td>jam</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <hr style="height:1px;border-width:0;color:black;background-color:black">
                </div><!-- /.box-header -->


                <div class="box-body">
                    <h4>Record Absensi Karyawan</h4>
                    <input type="hidden" name="id_karyawan" id="id_karyawan" value="<?= $_GET['idKaryawan'] ?>">
                    <input type="hidden" name="id_periode" id="id_periode" value="<?= $_GET['idPeriode'] ?>">
                   <table id="lookup" class="table table-bordered table-hover">  
                    <thead bgcolor="eeeeee" align="center">
                    <tr>
                        <th>Kategori</th>
                        <th>Jumlah</th>
                        <th>Tanggal</th>                
                    </tr>
                    </thead>
                    <tbody>
                    
                                    
                    </tbody>
                </table>  
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

    <!-- jQuery 2.1.4 -->
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
	  <!--<script type="text/javascript"> 

            $(function () {
                $("#lookup").dataTable({"lengthMenu":[25,50,75,100],"pageLength":25});
            });
  
   
        </script>-->
 <script>
        $(document).ready(function() {
                // Deklarasi variabel id karyawan dan id periode
                var data = {
                    id_karyawan : $("#id_karyawan").val(),
                    id_periode : $("#id_periode").val()
                };

				var dataTable = $('#lookup').DataTable( {
					"processing": true,
                    "serverSide": true,
                    "searching": false,
					"ajax":{
                        url :"ajax-grid-datadetailabsensi.php", // json datasource
                        data: data,
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
