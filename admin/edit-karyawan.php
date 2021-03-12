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
            <small>Human Resource Mangement System</small>
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
                  <h3 class="box-title">Edit Data Karyawan</h3>
                  <div class="box-tools pull-right">
                  <!-- <form action='admin.php' method="POST">
    	             <div class="input-group" style="width: 230px;">
                      <input type="text" name="qcari" class="form-control input-sm pull-right" placeholder="Cari Usename Atau Nama">
                      <div class="input-group-btn">
                        <button type="submit" class="btn btn-sm btn-default tooltips" data-placement="bottom" data-toggle="tooltip" title="Cari Data"><i class="fa fa-search"></i></button>
                        <a href="admin.php" class="btn btn-sm btn-success tooltips" data-placement="bottom" data-toggle="tooltip" title="Refresh"><i class="fa fa-refresh"></i></a>
                      </div>
                    </div>
                    </form> -->
                  </div> 
                </div><!-- /.box-header -->
                 <?php
                    $id = $_GET['id'];
                    $sql = mysqli_query($koneksi, "SELECT * FROM v_karyawan WHERE id_karyawan='$id'");
                    if(mysqli_num_rows($sql) == 0){
                      header("Location: karyawan.php");
                    }else{
                      $row = mysqli_fetch_assoc($sql);
                    }
                    
                    ?>
                      <div class="box-body">
                        <form class="form-horizontal style-form" action="update_karyawan.php" method="post" enctype="multipart/form-data" name="form1" id="form1">

                          <input type="hidden" name="id_karyawan" id="id_karyawan" value=<?= $_GET['id']; ?>>

                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">NIK</label>
                              <div class="col-sm-4">
                                  <input name="nik" type="text" id="nik" class="form-control" placeholder="NIK" value="<?php echo $row['nik']; ?>" autofocus="on" required="required" />
                              </div>
                          </div>

                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">No. Kartu Keluarga</label>
                              <div class="col-sm-4">
                                  <input name="no_kk" type="text" id="no_kk" class="form-control" placeholder="No. Kartu Keluarga" value="<?php echo $row['no_kk']; ?>" required="required" />
                              </div>
                          </div>

                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">No. Karyawan</label>
                              <div class="col-sm-4">
                                  <input name="no_karyawan" type="text" id="no_karyawan" class="form-control" placeholder="No. Karyawan" value="<?php echo $row['no_karyawan']; ?>" required="required" />
                              </div>
                          </div>

                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Nama Karyawan</label>
                              <div class="col-sm-4">
                                <input name="nama" type="text" id="nama" class="form-control" value="<?php echo $row['nama']; ?>" placeholder="Nama Karyawan" required /> 
                            </div>
                          </div>

                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Projek</label>
                              <div class="col-sm-4">
                                <select name="projek" id="projek" class="form-control" required>
                                  <?php
                                    $projek = mysqli_query($koneksi, "SELECT * FROM projek");
                                    while($p = mysqli_fetch_array($projek)) { ?>
                                      <option value="<?= $p['id_projek'] ?>" <?= $row['id_projek'] == $p['id_projek'] ? ' selected="selected"' : ''; ?> > <?= $p['projek'] ?> </option>
                                  <?php } ?>
                                </select>
                              </div>
                          </div>

                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Role</label>
                              <div class="col-sm-4">
                                <select name="role" id="role" class="form-control" required>
                                  <?php
                                    $role = mysqli_query($koneksi, "SELECT * FROM role");
                                    while($p = mysqli_fetch_array($role)) { ?>
                                      <option value="<?= $p['id_role'] ?>" <?= $row['id_role'] == $p['id_role'] ? ' selected="selected"' : ''; ?> > <?= $p['role'] ?> </option>
                                  <?php } ?>
                                </select>
                              </div>
                          </div>

                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Departemen</label>
                              <div class="col-sm-4">
                                <select name="departemen" id="departemen" class="form-control" required>
                                  <?php
                                    $departemen = mysqli_query($koneksi, "SELECT * FROM departemen");
                                    while($p = mysqli_fetch_array($departemen)) { ?>
                                      <option value="<?= $p['nama_dept'] ?>" <?= $row['departemen'] == $p['nama_dept'] ? ' selected="selected"' : ''; ?> > <?= $p['nama_dept'] ?> </option>
                                  <?php } ?>
                                </select>
                              </div>
                          </div>

                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Jabatan</label>
                              <div class="col-sm-4">
                                <select name="jabatan" id="jabatan" class="form-control" required>
                                  <?php
                                    $jabatan = mysqli_query($koneksi, "SELECT * FROM jabatan");
                                    while($p = mysqli_fetch_array($jabatan)) { ?>
                                      <option value="<?= $p['jabatan'] ?>" <?= $row['jabatan'] == $p['jabatan'] ? ' selected="selected"' : ''; ?> > <?= $p['jabatan'] ?> </option>
                                  <?php } ?>
                                </select>
                              </div>
                          </div>

                          <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Tanggal Masuk</label>
                            <div class="col-sm-4">
                              <input type='text' class="input-group date form-control" data-date="" data-date-format="yyyy-mm-dd" name='tanggal_masuk' id="tanggal_masuk" placeholder='Tanggal' required='required' value="<?= isset($row['tanggal_masuk']) ? $row['tanggal_masuk'] : '' ?>" />     
                            </div>
                          </div>

                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Gaji Pokok</label>
                              <div class="col-sm-4">
                                <input name="gaji_pokok" type="text" id="gaji_pokok" class="form-control" value="<?php echo $row['gaji_pokok']; ?>" placeholder="Gaji Pokok Karyawan" required /> 
                              </div>
                          </div>

                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">BPJS</label>
                              <div class="col-sm-4">
                                <input name="bpjs" type="text" id="bpjs" class="form-control" value="<?php echo $row['bpjs']; ?>" placeholder="BPJS Karyawan" required /> 
                              </div>
                          </div>

                          <div class="form-group">
                              <label class="col-sm-2 control-label">Foto</label>
                              <div class="col-sm-4">
                                <img src="foto_karyawan/<?= $row['foto'] ?>" class="img img-thumbnail" id="fotoPreview">
                                <input type="hidden" name="hidden_foto" value=<?= $row['foto'] ?>>
                                <input type="file" name="foto" id="foto" class="form-control" placeholder="Foto Karyawan" onchange="previewImage('foto', 'fotoPreview');" />
                              </div>
                          </div>

                          <div class="form-group">
                              <label class="col-sm-2 control-label">Foto KTP</label>
                              <div class="col-sm-4">
                                <img src="foto_ktp/<?= $row['foto_ktp'] ?>" class="img img-thumbnail" id="fotoKtpPreview">
                                <input type="hidden" name="hidden_foto_ktp" value=<?= $row['foto_ktp'] ?>>
                                <input type="file" name="foto_ktp" id="foto_ktp" class="form-control" placeholder="Foto KTP Karyawan" onchange="previewImage('foto_ktp', 'fotoKtpPreview');" />
                              </div>
                          </div>

                          <div class="form-group">
                              <label class="col-sm-2 control-label">Foto KK</label>
                              <div class="col-sm-4">
                                <img src="foto_kk/<?= $row['foto_kk'] ?>" class="img img-thumbnail" id="fotoKkPreview">
                                <input type="hidden" name="hidden_foto_kk" value=<?= $row['foto_kk'] ?>>
                                <input type="file" name="foto_kk" id="foto_kk" class="form-control" placeholder="Foto Kartu Keluarga Karyawan" onchange="previewImage('foto_kk', 'fotoKkPreview');" />
                              </div>
                          </div>

                          <div class="form-group">
                              <label class="col-sm-2 control-label">Foto NPWP</label>
                              <div class="col-sm-4">
                                <img src="foto_npwp/<?= $row['foto_npwp'] ?>" class="img img-thumbnail" id="fotoNpwpPreview">
                                <input type="hidden" name="hidden_foto_npwp" value=<?= $row['foto_npwp'] ?>>
                                <input type="file" name="foto_npwp" id="foto_npwp" class="form-control" placeholder="Foto NPWP Karyawan" onchange="previewImage('foto_npwp', 'fotoNpwpPreview');" />
                              </div>
                          </div>

                          <div class="form-group">
                              <label class="col-sm-2 control-label">Foto Buku Rekening</label>
                              <div class="col-sm-4">
                                <img src="foto_buku_rekening/<?= $row['foto_buku_rekening'] ?>" class="img img-thumbnail" id="fotoBukuPreview">
                                <input type="hidden" name="hidden_foto_buku" value=<?= $row['foto_buku_rekening'] ?>>
                                <input type="file" name="foto_buku" id="foto_buku" class="form-control" placeholder="Foto Buku Rekening Karyawan" onchange="previewImage('foto_buku', 'fotoBukuPreview');" />
                              </div>
                          </div>

                          <div class="form-group">
                              <label class="col-sm-2 control-label">Foto BPJS Kesehatan</label>
                              <div class="col-sm-4">
                                <img src="foto_bpjs_kesehatan/<?= $row['foto_bpjs_ks'] ?>" class="img img-thumbnail" id="fotoBpjs1Preview">
                                <input type="hidden" name="hidden_foto_bpjs_ks" value=<?= $row['foto_bpjs_ks'] ?>>
                                <input type="file" name="foto_bpjs_ks" id="foto_bpjs_ks" class="form-control" placeholder="Foto BPJS Kesehatan Karyawan" onchange="previewImage('foto_bpjs_ks', 'fotoBpjs1Preview');" />
                              </div>
                          </div>

                          <div class="form-group">
                              <label class="col-sm-2 control-label">Foto BPJS Ketenagakerjaan</label>
                              <div class="col-sm-4">
                                <img src="foto_bpjs_ketenagakerjaan/<?= $row['foto_bpjs_kj'] ?>" class="img img-thumbnail" id="fotoBpjs2Preview">
                                <input type="hidden" name="hidden_foto_bpjs_kj" value=<?= $row['foto_bpjs_kj'] ?>>
                                <input type="file" name="foto_bpjs_kj" id="foto_bpjs_kj" class="form-control" placeholder="Foto BPJS Ketenagakerjaan Karyawan" onchange="previewImage('foto_bpjs_kj', 'fotoBpjs2Preview');" />
                              </div>
                          </div>

                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label"></label>
                              <div class="col-sm-10">
                                  <input type="submit" name="update" value="Simpan" class="btn btn-sm btn-primary" />&nbsp;
	                              <a href="karyawan.php" class="btn btn-sm btn-danger">Batal </a>
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
