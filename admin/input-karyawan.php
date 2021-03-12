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
                  <h3 class="box-title">Input Data Karyawan</h3>
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
    //             if(isset($_POST['input'])){
		// 	$namafolder="gambar_admin/"; //tempat menyimpan file
      
    //   if (!empty($_FILES["nama_file"]["tmp_name"]))
    //   {
    //           $jenis_gambar=$_FILES['nama_file']['type'];
    //           $nik           = $_POST['nik'];
    //           $nama          = $_POST['nama'];
    //           $tanggal_masuk = $_POST['tanggal_masuk'];
    //           $departemen    = $_POST['departemen'];
    //           $jabatan       = $_POST['jabatan'];
    //           $status       = $_POST['status'];
    //           $jumlah_cuti   = $_POST['jumlah_cuti'];
    //           $username      = $_POST['username'];
    //           $password1      = $_POST['password'];
    //           $password      = sha1("$password1");
    //           $level         = $_POST['level'];
          
    //     if($jenis_gambar=="image/jpeg" || $jenis_gambar=="image/jpg" || $jenis_gambar=="image/gif" || $jenis_gambar=="image/x-png")
    //     {			
    //       $gambar = $namafolder . basename($_FILES['nama_file']['name']);		
    //       if (move_uploaded_file($_FILES['nama_file']['tmp_name'], $gambar)) {
    //         $sql="INSERT INTO karyawan (nik,nama,tanggal_masuk,departemen,jabatan,status,jumlah_cuti,username,password,level,gambar) VALUES
    //               ('$nik','$nama','$tanggal_masuk','$departemen','$jabatan','$status','$jumlah_cuti','$username','$password','$level','$gambar')";
    //         $res=mysqli_query($koneksi, $sql) or die (mysqli_error());
    //         //echo "Gambar berhasil dikirim ke direktori".$gambar;
    //               echo "<script>alert('Data berhasil dimasukan!'); window.location = 'karyawan.php'</script>";	   
    //       } else {
    //         echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><p>Gambar gagal dikirim</p></div>';
    //      }
    //     } else {
    //      echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Jenis gambar yang anda kirim salah. Harus .jpg .gif .png</div>';
    //     }
    //  } else {
    //    echo '<div class="alert alert-warning alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Anda Belum Memilih Gambar</div>';
    //  }
    // }
			?>
                <div class="box-body">
                <form class="form-horizontal style-form" action="insert_karyawan.php" method="post" enctype="multipart/form-data" name="form1" id="form1">
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">NIK</label>
                              <div class="col-sm-4">
                                  <input name="nik" type="text" id="nik" class="form-control" placeholder="NIK" autocomplete="off" autofocus="on" required="required" value="<?= isset($_POST['nik']) ? $_POST['nik'] : '' ?>"/>
                              </div>
                          </div>

                          <div class="form-group">
                            <label class="col-sm-2 control-label">No. Kartu Keluarga</label>
                            <div class="col-sm-4">
                              <input type="text" name="nokk" id="nokk" class="form-control" placeholder="No. KK" require="required" value="<?= isset($_POST['nokk']) ? $_POST['nokk'] : '' ?>">
                            </div>
                          </div>
                          
                          <div class="form-group">
                            <label class="col-sm-2 control-label">No. Karyawan</label>
                            <div class="col-sm-4">
                              <input type="text" name="nok" id="nok" class="form-control" placeholder="No. Karyawan" require="required" value="<?= isset($_POST['nok']) ? $_POST['nok'] : '' ?>">
                            </div>
                          </div>
                          
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Nama Karyawan</label>
                              <div class="col-sm-4">
                                <input name="nama" type="text" id="nama" class="form-control" placeholder="Nama Karyawan" autocomplete="off" required value="<?= isset($_POST['nama']) ? $_POST['nama'] : '' ?>"/>                              
                              </div>
                          </div>
                          
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Projek</label>
                              <div class="col-sm-4">
                                <select name="projek" id="projek" class="form-control select2" required>
                                  <?php 
                                    $projek = mysqli_query($koneksi, "SELECT * FROM projek");
                                    while($p = mysqli_fetch_array($projek)) {
                                      echo '<option value='.$p[id_projek].'>' .$p[projek]. '</option>';
                                    }
                                  ?>
                                </select>
                              </div>
                          </div>
                          
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Role</label>
                              <div class="col-sm-4">
                                <select name="role" id="role" class="form-control select2" required>
                                  <?php 
                                    $role = mysqli_query($koneksi, "SELECT * FROM role");
                                    while($r = mysqli_fetch_array($role)) {
                                      echo '<option value='.$r[id_role].'>' .$r[role]. '</option>';
                                    }
                                  ?>
                                </select>
                              </div>
                          </div>
                          
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Departemen</label>
                              <div class="col-sm-4">
                              <select name="departemen" id="departemen" class="form-control select2" required>
                              <option value=""> --- Pilih Departemen --- </option>
                                <?php 
                                  $query2="select * from departemen order by id_dept";
                                  $tampil=mysqli_query($koneksi, $query2) or die(mysqli_error());
                                  while($data1=mysqli_fetch_array($tampil))
                                  {
                                ?>							
							                <option value="<?php echo $data1['nama_dept'];?>"><?php echo $data1['id_dept'];?> - <?php echo $data1['nama_dept'];?></option>
						                    <?php } ?>
                              </select> 
                            </div>
                          </div>

                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Jabatan</label>
                              <div class="col-sm-4">
                              <select name="jabatan" id="jabatan" class="form-control select2" required>
                              <option value=""> --- Pilih Jabatan --- </option>
                                <?php 
                                  $query2="select * from jabatan order by id_jabatan";
                                  $tampil=mysqli_query($koneksi, $query2) or die(mysqli_error());
                                  while($data1=mysqli_fetch_array($tampil))
                                  {
                                ?>
                              <option value="<?php echo $data1['jabatan'];?>"><?php echo $data1['id_jabatan'];?> - <?php echo $data1['jabatan'];?></option>
                                <?php } ?>
                              </select>   
                            </div>
                          </div>

                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Tanggal Masuk</label>
                              <div class="col-sm-4">
                                <input type='text' class="input-group date" data-date="" data-date-format="yyyy-mm-dd" name='tanggal' id="tanggal" placeholder='Tanggal' required='required' width=50 />
                              </div>
                          </div>

                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Gaji Pokok</label>
                              <div class="col-sm-4">
                                <input type="text" name="gapok" id="gapok" class="form-control" required="required" placeholder="Gaji Pokok Karyawan" value="<?= isset($_POST['gapok']) ? $_POST['gapok'] : '' ?>">
                              </div>
                          </div>

                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">BPJS</label>
                              <div class="col-sm-4">
                                <input type="text" name="bpjs" id="bpjs" class="form-control" required="required" placeholder="BPJS Karyawan" value="<?= isset($_POST['bpjs']) ? $_POST['bpjs'] : '' ?>">
                              </div>
                          </div>
                          
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Username</label>
                              <div class="col-sm-4">
                                <input name="username" type="text" id="username" class="form-control" placeholder="Username" autocomplete="off" required />
                            </div>
                          </div>

                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Password</label>
                              <div class="col-sm-4">
                                <input name="password" type="password" id="password" class="form-control" placeholder="Password" autocomplete="off" required /> 
                            </div>
                          </div>

                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Level</label>
                              <div class="col-sm-4">
                                <select name="level" id="level" class="form-control" required="required">
                                <option value="">----- Pilih Status -----</option>
                                <option value="Admin">Admin</option>
                                <!--<option value="Superuser">Superuser</option>-->
                                <option value="User">User</option>
                                </select>
                              </div>
                          </div>

                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Foto</label>
                              <div class="col-sm-4">
                                <input name="foto" type="file" id="foto" class="form-control" placeholder="Foto Karyawan" autocomplete="off" required />
                              </div>
                          </div>
                          
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Foto KTP</label>
                              <div class="col-sm-4">
                                <input name="foto_ktp" type="file" id="foto_ktp" class="form-control" placeholder="Foto KTP" autocomplete="off" required />
                              </div>
                          </div>

                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Foto KK</label>
                              <div class="col-sm-4">
                                <input name="foto_kk" type="file" id="foto_kk" class="form-control" placeholder="Foto Kartu Keluarga" autocomplete="off" required />
                              </div>
                          </div>

                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Foto NPWP</label>
                              <div class="col-sm-4">
                                <input name="foto_npwp" type="file" id="foto_npwp" class="form-control" placeholder="Foto NPWP" autocomplete="off" required />
                              </div>
                          </div>

                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Foto Buku Rekening</label>
                              <div class="col-sm-4">
                                <input name="foto_buku" type="file" id="foto_buku" class="form-control" placeholder="Foto Buku Rekening" autocomplete="off" required />
                              </div>
                          </div>

                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Foto BPJS Kesehatan</label>
                              <div class="col-sm-4">
                                <input name="foto_bpjs_ks" type="file" id="foto_bpjs_ks" class="form-control" placeholder="Foto BPJS Kesehatan" autocomplete="off" required />
                              </div>
                          </div>

                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Foto BPJS Ketenagakerjaan</label>
                              <div class="col-sm-4">
                                <input name="foto_bpjs_kj" type="file" id="foto_bpjs_kj" class="form-control" placeholder="Foto BPJS Ketenagakerjaan" autocomplete="off" required />
                              </div>
                          </div>

                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label"></label>
                              <div class="col-sm-10">
                                  <input type="submit" name="input" value="Simpan" class="btn btn-sm btn-primary" />&nbsp;
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
    </script>
  </body>
</html>
