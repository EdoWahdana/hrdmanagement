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
          $sql = "SELECT * FROM v_gaji WHERE id_karyawan='$id'";
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
                          <div class="col-sm-12 col-lg-6">
                            <div class="input-group">
                              <span class="input-group-addon" id="basic-addon1" style="width: 200px; text-align: left;">Tanggal : </span>
                              <strong><input type="text" class="form-control" style="width: 300px;" disabled value="<?= date("d-M-Y", strtotime($data['tanggal'])); ?>"></strong>
                            </div> 
                            <br> 
                          </div>
                          <div class="col-sm-12 col-lg-6">
                            <div class="input-group">
                              <span class="input-group-addon" id="basic-addon1" style="width: 200px; text-align: left;">Tunjangan, dll : </span>
                              <strong><input type="text" class="form-control" style="width: 300px;" disabled value="<?='Rp. '.strrev(implode('.',str_split(strrev(strval($data['tunjangan'])),3))); ?>"></strong>
                            </div>  
                            <br>
                          </div>
                          <div class="col-sm-12 col-lg-6">
                            <div class="input-group">
                              <span class="input-group-addon" id="basic-addon1" style="width: 200px; text-align: left;">Potongan : </span>
                              <strong><input type="text" class="form-control" style="width: 300px;" disabled value="<?='Rp. '.strrev(implode('.',str_split(strrev(strval($data['potongan'])),3))); ?>"></strong>
                            </div>  
                            <br>
                          </div>
                          <div class="col-sm-12 col-lg-6">
                            <div class="input-group">
                              <span class="input-group-addon" id="basic-addon1" style="width: 200px; text-align: left;">BPJS Kesehatan : </span>
                              <strong><input type="text" class="form-control" style="width: 300px;" disabled value="<?='Rp. '.strrev(implode('.',str_split(strrev(strval($data['bpjs_ks'])),3))); ?>"></strong>
                            </div>  
                            <br>
                          </div>
                          <div class="col-sm-12 col-lg-6">
                            <div class="input-group">
                              <span class="input-group-addon" id="basic-addon1" style="width: 200px; text-align: left;">BPJS Ketenagakerjaan : </span>
                              <strong><input type="text" class="form-control" style="width: 300px;" disabled value="<?='Rp. '.strrev(implode('.',str_split(strrev(strval($data['bpjs_kj'])),3))); ?>"></strong>
                            </div>  
                            <br>
                          </div>
                          <div class="col-sm-12 col-lg-6">
                            <div class="input-group">
                              <span class="input-group-addon" id="basic-addon1" style="width: 200px; text-align: left;">Gaji Sebulan : </span>
                              <strong><input type="text" class="form-control" style="width: 300px;" disabled value="<?='Rp. '.strrev(implode('.',str_split(strrev(strval($data['sebulan'])),3))); ?>"></strong>
                            </div>  
                            <br>
                          </div>
                          <div class="col-sm-12 col-lg-6">
                            <div class="input-group">
                              <span class="input-group-addon" id="basic-addon1" style="width: 200px; text-align: left;">Gaji Setahun : </span>
                              <strong><input type="text" class="form-control" style="width: 300px;" disabled value="<?='Rp. '.strrev(implode('.',str_split(strrev(strval($data['setahun'])),3))); ?>"></strong>
                            </div>  
                            <br>
                          </div>
                          <div class="col-sm-12 col-lg-6">
                            <div class="input-group">
                              <span class="input-group-addon" id="basic-addon1" style="width: 200px; text-align: left;">Bonus, dll : </span>
                              <strong><input type="text" class="form-control" style="width: 300px;" disabled value="<?='Rp. '.strrev(implode('.',str_split(strrev(strval($data['bonus'])),3))); ?>"></strong>
                            </div>  
                            <br>
                          </div>
                          <div class="col-sm-12 col-lg-6">
                            <div class="input-group">
                              <span class="input-group-addon" id="basic-addon1" style="width: 200px; text-align: left;">Gaji Setahun (bruto) : </span>
                              <strong><input type="text" class="form-control" style="width: 300px;" disabled value="<?='Rp. '.strrev(implode('.',str_split(strrev(strval($data['bruto'])),3))); ?>"></strong>
                            </div>  
                            <br>
                          </div>
                          <div class="col-sm-12 col-lg-6">
                            <div class="input-group">
                              <span class="input-group-addon" id="basic-addon1" style="width: 200px; text-align: left;">Biaya Jabatan : </span>
                              <strong><input type="text" class="form-control" style="width: 300px;" disabled value="<?='Rp. '.strrev(implode('.',str_split(strrev(strval($data['biaya_jabatan'])),3))); ?>"></strong>
                            </div>  
                            <br>
                          </div>
                          <div class="col-sm-12 col-lg-6">
                            <div class="input-group">
                              <span class="input-group-addon" id="basic-addon1" style="width: 200px; text-align: left;">Gaji Setahun (neto) : </span>
                              <strong><input type="text" class="form-control" style="width: 300px;" disabled value="<?='Rp. '.strrev(implode('.',str_split(strrev(strval($data['neto'])),3))); ?>"></strong>
                            </div>  
                            <br>
                          </div>
                          <div class="col-sm-12 col-lg-6">
                            <div class="input-group">
                              <span class="input-group-addon" id="basic-addon1" style="width: 200px; text-align: left;">Pph Setahun : </span>
                              <strong><input type="text" class="form-control" style="width: 300px;" disabled value="<?='Rp. '.strrev(implode('.',str_split(strrev(strval($data['pph'])),3))); ?>"></strong>
                            </div>  
                            <br>
                          </div>
                          <div class="col-sm-12">
                            <hr style="height:2px;border-width:0;color:black;background-color:black">
                          </div>
                          <div class="col-sm-offset-8 col-sm-4">
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
