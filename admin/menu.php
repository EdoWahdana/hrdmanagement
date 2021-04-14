<?php 
  $base = 'http://' . $_SERVER['SERVER_NAME'] . '/' .  explode('/', $_SERVER['REQUEST_URI'])[1];
 ?>

<aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="<?= $base . '/admin/' . $_SESSION['gambar']; ?>" height="200" width="200" style="border: 2px solid white;" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p><?php echo $_SESSION['nama']; ?></p>
              <a href="index.php"><i class="fa fa-circle text-success"></i> <?php echo $_SESSION['departemen']; ?></a>
            </div>
          </div><br />
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">HRD Management System ALTER</li>
            <li class="active treeview">
              <a href="<?= $base . '/admin/'?>index.php">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
              </a>
            </li>
            
            <li>
              <a href="#">
                <i class="fa fa-user"></i> <span>Karyawan</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?= $base . '/admin/'?>karyawan.php"><i class="fa fa-circle-o"></i> Karyawan</a></li>
                <li><a href="<?= $base . '/admin/'?>input-karyawan.php"><i class="fa fa-circle-o"></i> Input Karyawan</a></li>
              </ul>
            </li>
            
            <li>
              <a href="#">
                <i class="fa fa-building"></i> <span>Departemen</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?= $base . '/admin/'?>departemen.php"><i class="fa fa-circle-o"></i> Data Departemen</a></li>
                <li><a href="<?= $base . '/admin/'?>input-departemen.php"><i class="fa fa-circle-o"></i> Input Departemen</a></li>
              </ul>
            </li>
            
            <li class="treeview">
              <a href="#">
                <i class="fa fa-building"></i> <span>Jabatan</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?= $base . '/admin/'?>jabatan.php"><i class="fa fa-circle-o"></i> Data Jabatan</a></li>
                <li><a href="<?= $base . '/admin/'?>input-jabatan.php"><i class="fa fa-circle-o"></i> Input Jabatan</a></li>
              </ul>
            </li>

            <li>
              <a href="#">
                <i class="fa fa-user"></i> <span>Gaji Karyawan</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?= $base . '/admin/'?>gaji.php"><i class="fa fa-circle-o"></i>Gaji Karyawan</a></li>
                <li><a href="<?= $base . '/admin/'?>rule-gaji.php"><i class="fa fa-circle-o"></i> Rule Gaji Karyawan</a></li>
              </ul>
            </li>

            <li class="treeview">
              <a href="#">
                <i class="fa fa-building"></i> <span>Recruitment</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?= $base . '/admin/'?>recruitment.php"><i class="fa fa-circle-o"></i> Data Pelamar</a></li>
                <li><a href="<?= $base . '/admin/'?>input-recruitment.php"><i class="fa fa-circle-o"></i> Input Data Pelamar</a></li>
              </ul>
            </li>

            <li class="treeview">
              <a href="#">
                <i class="fa fa-building"></i> <span>Absensi</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?= $base . '/admin/absensi/'?>absensi.php"><i class="fa fa-circle-o"></i> Data Absensi</a></li>
                <li><a href="<?= $base . '/admin/absensi/'?>input-absensi.php"><i class="fa fa-circle-o"></i> Input Data Absensi Karyawan</a></li>
              </ul>
            </li>

            <li class="treeview">
              <a href="#">
                <i class="fa fa-building"></i> <span>Penghargaan</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?= $base . '/admin/'?>jabatan.php"><i class="fa fa-circle-o"></i> Data Penghargaan</a></li>
                <li><a href="<?= $base . '/admin/'?>input-jabatan.php"><i class="fa fa-circle-o"></i> Input Data Penghargaan</a></li>
              </ul>
            </li>
            
            <li class="treeview">
              <a href="#">
                <i class="fa fa-dollar"></i> <span>Variabel Cuti</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?= $base . '/admin/'?>jenis.php"><i class="fa fa-circle-o"></i> Data Variabel </a></li>
                <li><a href="<?= $base . '/admin/'?>input-jenis.php"><i class="fa fa-circle-o"></i> Input Variabel </a></li>
              </ul>
            </li>
            
            
            <?php 
            $tampil=mysqli_query($koneksi, "select * from cuti order by kode desc");
                        $total=mysqli_num_rows($tampil);
                    ?>
            <li>
              <a href="#">
                <i class="fa fa-lock"></i> <span>Cuti</span>
                <small class="label pull-right bg-yellow"><?php echo $total; ?></small>
              </a>
               <ul class="treeview-menu">
               <li><a href="<?= $base . '/admin/'?>cuti.php"><i class="fa fa-circle-o"></i> Data Cuti</a></li>
                <li><a href="<?= $base . '/admin/'?>input-cuti.php"><i class="fa fa-circle-o"></i> Input Cuti </a></li>
              </ul>
            </li>
            
            <li>
              <a href="#">
                <i class="fa fa-file"></i> <span>Laporan</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?= $base . '/admin/laporan/'?>laporan-gaji.php"><i class="fa fa-circle-o"></i> Laporan Gaji</a></li>
                <li><a href="<?= $base . '/admin/laporan/'?>laporan-bank.php"><i class="fa fa-circle-o"></i> Laporan Convert Bank</a></li>
              </ul>
            </li>
        </section>
        <!-- /.sidebar -->
      </aside>