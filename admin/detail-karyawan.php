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
            Karyawan
            <small>Human Resource Management System</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Karyawan</li>
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
                  <h3 class="box-title">Detail Data Karyawan</h3>
                  <div class="box-tools pull-right">
                    <a href="karyawan.php" class="btn btn-sm btn-warning">Kembali <i class="fa fa-arrow-circle-left"></i></a>
                  </div> 
                </div><!-- /.box-header -->
                <?php
                  $query = mysqli_query($koneksi, "SELECT * FROM v_karyawan WHERE id_karyawan='$_GET[id]'");
                  $data  = mysqli_fetch_array($query);
                ?>
                <div class="box-body">
                  <div class="form-panel">
                    <div class="container">
                      <div class="row text-center">
                        <div class="col">
                          <img src="foto_karyawan/<?= $data['foto']; ?>" class="img-fluid img-thumbnail mb-3" width="300" height="300" alt="Foto Karyawan">
                        </div>
                      </div>
                      <br>
                      <div class="row justify-content-center">
                        <div class="col-auto">
                          <table id="dataKaryawan" class="table table-hover table-bordered table-responsive">
                            <tr class="d-flex">
                              <td class="col-sm-3">NIK</td>
                              <td class="col-sm-9"><?= $data['nik']; ?></td>
                            </tr>
                            <tr class="d-flex">
                              <td class="col-sm-3">No. Kartu Keluarga</td>
                              <td class="col-sm-9"><?= $data['no_kk']; ?></td>
                            </tr>
                            <tr class="d-flex">
                              <td class="col-sm-3">No. Karyawan</td>
                              <td class="col-sm-9"><?= $data['no_karyawan']; ?></td>
                            </tr>
                            <tr class="d-flex">
                              <td class="col-sm-3">Nama</td>
                              <td class="col-sm-9"><?= $data['nama']; ?></td>
                            </tr>
                            <tr class="d-flex">
                              <td class="col-sm-3">Jenis Kelamin</td>
                              <td class="col-sm-9"><?= $data['jk']; ?></td>
                            </tr>
                            <tr class="d-flex">
                              <td class="col-sm-3">Status Pegawai</td>
                              <td class="col-sm-9"><?= $data['status_kerja']; ?></td>
                            </tr>
                            <tr class="d-flex">
                              <td class="col-sm-3">PTKP</td>
                              <td class="col-sm-9"><?= $data['kode']; ?></td>
                            </tr>
                            <tr class="d-flex">
                              <td class="col-sm-3">Projek</td>
                              <td class="col-sm-9"><?= $data['projek']; ?></td>
                            </tr>
                            <tr class="d-flex">
                              <td class="col-sm-3">Role</td>
                              <td class="col-sm-9"><?= $data['role']; ?></td>
                            </tr>
                            <tr class="d-flex">
                              <td class="col-sm-3">Departemen</td>
                              <td class="col-sm-9"><?= $data['departemen']; ?></td>
                            </tr>
                            <tr class="d-flex">
                              <td class="col-sm-3">Jabatan</td>
                              <td class="col-sm-9"><?= $data['jabatan']; ?></td>
                            </tr>
                            <tr class="d-flex">
                              <td class="col-sm-3">Tanggal Masuk</td>
                              <td class="col-sm-9"><?= date("d-M-Y", strtotime($data['tanggal_masuk'])); ?></td>
                            </tr>
                            <tr class="d-flex">
                              <td class="col-sm-3">Gaji Pokok</td>
                              <td class="col-sm-9">
                                <?= 'Rp. '.strrev(implode('.',str_split(strrev(strval($data['gaji_pokok'])),3))); ?>
                              </td>
                            </tr>
                            <tr class="d-flex">
                              <td class="col-sm-3">Foto KTP</td>
                              <td class="col-sm-9"><a href="foto_ktp/<?= $data['foto_ktp']; ?>" class="badge badge-info" target="blank">Lihat Foto KTP</a></td>
                            </tr>
                            <tr class="d-flex">
                              <td class="col-sm-3">Foto KK</td>
                              <td class="col-sm-9"><a href="foto_kk/<?= $data['foto_kk']; ?>" class="badge badge-info" target="blank">Lihat Foto KK</a></td>
                            </tr>
                            <tr class="d-flex">
                              <td class="col-sm-3">Foto NPWP</td>
                              <td class="col-sm-9"><a href="foto_npwp/<?= $data['foto_npwp']; ?>" class="badge badge-info" target="blank">Lihat Foto NPWP</a></td>
                            </tr>
                            <tr class="d-flex">
                              <td class="col-sm-3">Foto Buku Rekening</td>
                              <td class="col-sm-9"><a href="foto_buku_rekening/<?= $data['foto_buku_rekening']; ?>" class="badge badge-info" target="blank">Lihat Foto Buku Rekening</a></td>
                            </tr>
                            <tr class="d-flex">
                              <td class="col-sm-3">Foto BPJS Kesehatan</td>
                              <td class="col-sm-9"><a href="foto_bpjs_kesehatan/<?= $data['foto_bpjs_ks']; ?>" class="badge badge-info" target="blank">Lihat Foto BPJS Kesehatan</a></td>
                            </tr>
                            <tr class="d-flex">
                              <td class="col-sm-3">Foto BPJS Ketenagakerjaan</td>
                              <td class="col-sm-9"><a href="foto_bpjs_ketenagakerjaan/<?= $data['foto_bpjs_kj']; ?>" class="badge badge-info" target="blank">Lihat Foto BPJS Ketenagakerjaan</a></td>
                            </tr>
                          </table>
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
    <!-- Custom JS File -->

  </body>
</html>
