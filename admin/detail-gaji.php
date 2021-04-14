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

        <!-- Get data from v_gaji table -->
        <?php 
          $id = $_GET['id'];
          $sql = "SELECT * FROM v_gaji WHERE id_gaji='$id'";
          $data = mysqli_fetch_array(mysqli_query($koneksi, $sql));
          $bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        ?>

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
                  <h3 class="box-title">Detail Gaji Karyawan</h3>
                    <strong><p style="font-size: 35px;" class="text-center"><?= $data['nama']; ?></p></strong>
                  <div class="box-tools pull-right">
                      <a href="laporan_gaji.php?id=<?= $id ?>" class="btn btn-sm btn-warning" target="blank">Laporan Gaji <i class="fa fa-arrow-circle-left"></i></a>
                      <a href="gaji.php" class="btn btn-sm btn-warning">Kembali <i class="fa fa-arrow-circle-left"></i></a>
                  </div> 
                </div><!-- /.box-header -->

                <div class="box-body">
                  <div class="form-panel">
                    <div class="container">
                      <div class="row">
                        <div class="col-lg-4 col-md-10 col-sm-12">
                          <strong><p class="text-center font-weight-bold">No Pegawai : <?= $data['no_karyawan'] ?> </p></strong>
                        </div>
                        <div class="col-lg-4 col-md-10 col-sm-12">
                          <strong><p class="text-center font-weight-bold">Projek : <?= $data['projek'] ?> </p></strong>
                        </div>
                        <div class="col-lg-4 col-md-10 col-sm-12">
                          <strong><p class="text-center font-weight-bold">Periode : <?= $bulan[$data['bulan'] - 1] ?> - <?= $data['tahun'] ?></p></strong>
                        </div>
                      </div>
                        <hr style="height:2px;border-width:0;color:black;background-color:black">
                      <br> 
                      <div class="container">
                        <div class="row">
                          <div class="col-sm-12 col-lg-offset-3 text-center">
                            <div class="input-group">
                              <span class="input-group-addon" id="basic-addon1" style="width: 200px; text-align: left;">Gaji Pokok : </span>
                              <strong><input type="text" class="form-control" style="width: 100%;" disabled value="<?='Rp. '.strrev(implode('.',str_split(strrev(strval($data['gaji_pokok'])),3))); ?>"></strong>
                            </div>  
                            <br>
                          </div>
                          <div class="col-sm-12 col-lg-6">
                            <div class="input-group">
                              <span class="input-group-addon" id="basic-addon1" style="width: 230px; text-align: left;">Lembur Backup: </span>
                              <strong><input type="text" class="form-control" style="width: 100%;" disabled value="<?='Rp. '.strrev(implode('.',str_split(strrev(strval($data['lembur_backup'])),3))); ?>"></strong>
                            </div>  
                            <br>
                          </div>
                          <div class="col-sm-12 col-lg-6">
                            <div class="input-group">
                              <span class="input-group-addon" id="basic-addon1" style="width: 200px; text-align: left;">Potongan Sakit : </span>
                              <strong><input type="text" class="form-control" style="width: 100%;" disabled value="<?='Rp. '.strrev(implode('.',str_split(strrev(strval($data['potongan_sakit'])),3))); ?>"></strong>
                            </div>  
                            <br>
                          </div>
                          <div class="col-sm-12 col-lg-6">
                            <div class="input-group">
                              <span class="input-group-addon" id="basic-addon1" style="width: 230px; text-align: left;">Lembur Public Holiday : </span>
                              <strong><input type="text" class="form-control" style="width: 100%;" disabled value="<?='Rp. '.strrev(implode('.',str_split(strrev(strval($data['lembur_holiday'])),3))); ?>"></strong>
                            </div>  
                            <br>
                          </div>
                          <div class="col-sm-12 col-lg-6">
                            <div class="input-group">
                              <span class="input-group-addon" id="basic-addon1" style="width: 200px; text-align: left;">Potongan Izin : </span>
                              <strong><input type="text" class="form-control" style="width: 100%;" disabled value="<?='Rp. '.strrev(implode('.',str_split(strrev(strval($data['potongan_izin'])),3))); ?>"></strong>
                            </div>  
                            <br>
                          </div>
                          <div class="col-sm-12 col-lg-6">
                            <div class="input-group">
                              <span class="input-group-addon" id="basic-addon1" style="width: 230px; text-align: left;">Lembur Reguler : </span>
                              <strong><input type="text" class="form-control" style="width: 100%;" disabled value="<?='Rp. '.strrev(implode('.',str_split(strrev(strval($data['lembur_reguler'])),3))); ?>"></strong>
                            </div>  
                            <br>
                          </div>
                          <div class="col-sm-12 col-lg-6">
                            <div class="input-group">
                              <span class="input-group-addon" id="basic-addon1" style="width: 200px; text-align: left;">Potongan Cuti : </span>
                              <strong><input type="text" class="form-control" style="width: 100%;" disabled value="<?='Rp. '.strrev(implode('.',str_split(strrev(strval($data['potongan_cuti'])),3))); ?>"></strong>
                            </div>  
                            <br>
                          </div>
                          <div class="col-sm-12 col-lg-6">
                            <div class="input-group">
                              <span class="input-group-addon" id="basic-addon1" style="width: 230px; text-align: left;">Lembur lain-lain : </span>
                              <strong><input type="text" class="form-control" style="width: 100%;" disabled value="<?='Rp. '.strrev(implode('.',str_split(strrev(strval($data['lembur_lain'])),3))); ?>"></strong>
                            </div>  
                            <br>
                          </div>
                          <div class="col-sm-12 col-lg-6">
                            <div class="input-group">
                              <span class="input-group-addon" id="basic-addon1" style="width: 200px; text-align: left;">Potongan Diksar : </span>
                              <strong><input type="text" class="form-control" style="width: 100%;" disabled value="<?='Rp. '.strrev(implode('.',str_split(strrev(strval($data['potongan_diksar'])),3))); ?>"></strong>
                            </div>  
                            <br>
                          </div>
                          <div class="col-sm-12 col-lg-6">
                            <div class="input-group">
                              <span class="input-group-addon" id="basic-addon1" style="width: 230px; text-align: left;">Tunjangan BPJS Kesehatan : </span>
                              <strong><input type="text" class="form-control" style="width: 100%;" disabled value="<?='Rp. '.strrev(implode('.',str_split(strrev(strval($data['tunjangan_bpjs_ks'])),3))); ?>"></strong>
                            </div>  
                            <br>
                          </div>
                          <div class="col-sm-12 col-lg-6">
                            <div class="input-group">
                              <span class="input-group-addon" id="basic-addon1" style="width: 200px; text-align: left;">Potongan lain-lain : </span>
                              <strong><input type="text" class="form-control" style="width: 100%;" disabled value="<?='Rp. '.strrev(implode('.',str_split(strrev(strval($data['potongan_lain'])),3))); ?>"></strong>
                            </div>  
                            <br>
                          </div>
                          <div class="col-sm-12 col-lg-6">
                            <div class="input-group">
                              <span class="input-group-addon" id="basic-addon1" style="width: 230px; text-align: left;">Tunjangan BPJS Ketenagakerjaan : </span>
                              <strong><input type="text" class="form-control" style="width: 100%;" disabled value="<?='Rp. '.strrev(implode('.',str_split(strrev(strval($data['tunjangan_bpjs_kj'])),3))); ?>"></strong>
                            </div>  
                            <br>
                          </div>
                          <div class="col-sm-12 col-lg-6">
                            <div class="input-group">
                              <span class="input-group-addon" id="basic-addon1" style="width: 200px; text-align: left;">Potongan SP : </span>
                              <strong><input type="text" class="form-control" style="width: 100%;" disabled value="<?='Rp. '.strrev(implode('.',str_split(strrev(strval($data['potongan_sp'])),3))); ?>"></strong>
                            </div>  
                            <br>
                          </div>
                          <div class="col-sm-12 col-lg-6">
                            <div class="input-group">
                              <span class="input-group-addon" id="basic-addon1" style="width: 230px; text-align: left;">Tunjangan DHT : </span>
                              <strong><input type="text" class="form-control" style="width: 100%;" disabled value="<?='Rp. '.strrev(implode('.',str_split(strrev(strval($data['tunjangan_dht'])),3))); ?>"></strong>
                            </div>  
                            <br>
                          </div>
                          <div class="col-sm-12 col-lg-offset-3 col-lg-6">
                            <div class="input-group">
                              <span class="input-group-addon" id="basic-addon1" style="width: 200px; text-align: left;">Potongan BPJS Kesehatan : </span>
                              <strong><input type="text" class="form-control" style="width: 100%;" disabled value="<?='Rp. '.strrev(implode('.',str_split(strrev(strval(intval($data['tunjangan_bpjs_ks'] * 0.01))),3))); ?>"></strong>
                            </div>  
                            <br>
                          </div>
                          <div class="col-sm-12 col-lg-offset-3 col-lg-6">
                            <div class="input-group">
                              <span class="input-group-addon" id="basic-addon1" style="width: 200px; text-align: left;">Potongan BPJS Ketenagakerjaan : </span>
                              <strong><input type="text" class="form-control" style="width: 100%;" disabled value="<?='Rp. '.strrev(implode('.',str_split(strrev(strval(intval($data['tunjangan_bpjs_kj'] * 0.03))),3))); ?>"></strong>
                            </div>  
                            <br>
                          </div>
                          <div class="col-sm-12 col-lg-6">
                            <div class="input-group">
                              <span class="input-group-addon" id="basic-addon1" style="width: 200px; text-align: left;">Potongan Pph21 : </span>
                              <strong><input type="text" class="form-control" style="width: 100%;" disabled value="<?='Rp. '.strrev(implode('.',str_split(strrev(strval(intval($data['pph'] / 12))),3))); ?>"></strong>
                            </div>  
                            <br>
                          </div>
                          <div class="col-sm-10">
                            <hr style="height:2px;border-width:0;color:black;background-color:black;">
                          </div>
                          <div class="col-sm-offset-6 col-sm-6">
                            <strong><p style="font-size: 16px;">Take Home Pay (perbulan) : <?='Rp. '.strrev(implode('.',str_split(strrev(strval($data['thp'])),3))); ?> </p></strong>
                          </div>
                        </div>
                      </div>
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
