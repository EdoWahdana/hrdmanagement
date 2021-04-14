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
                <div class="alert alert-danger text-center" id="box-kontrak" role="alert">Masa Kontrak Akan Habis Dalam <span id="text-kontrak"></span> Hari </div>
                  <form class="form-horizontal style-form" action="insert_gaji.php" method="post" enctype="multipart/form-data" name="form1" id="form1">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Nama</label>
                            <div class="col-sm-3">
                              <select name="id_karyawan" id="id_karyawan" class="form-control select2" required>
                                <option id="header-karyawan" selected hidden value="0"> --- Pilih Pegawai --- </option>
                                <!-- Ambil data pegawai yang belum ada di tabel gaji -->
                                <?php 
                                  $sql = "SELECT id_karyawan, no_karyawan, nama, projek FROM v_karyawan";
                                  $exec = mysqli_query($koneksi, $sql);
                                    while($data = mysqli_fetch_array($exec)) { 
                                      echo "<option value='" .$data['id_karyawan']. "'>" .$data['nama']. " - " .$data['no_karyawan']. " - " .$data['projek']. "</option>"; 
                                    }
                                ?>
                              </select>
                            </div>
                            <label class="col-sm-2 control-label">Periode</label>
                            <div class="col-sm-3">
                              <select disabled name="periode" id="periode" class="form-control select2" required onchange="getDetail();">
                                <option id="header-periode" selected hidden value="0"> --- Pilih Periode --- </option>
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
                          <label class="col-sm-2 control-label">Pilihan SP</label>
                          <div class="col-sm-3">
                              <select name="sp" id="sp" class="form-control select2" required>
                                  <option selected disabled hidden> --- Pilih SP --- </option>
                                  <option value="50000">50.000</option>
                                  <option value="75000">75.000</option>
                                  <option value="100000">100.000</option>
                              </select>
                          </div>
                          <label class="col-sm-2 control-label">Pilihan Lembur Holiday</label>
                          <div class="col-sm-3">
                            <select disabled name="ph" id="ph" class="form-control select2" required onchange="getDetail();">
                                  <option value='0.5'>0.5</option>
                                  <option selected value='1'>1</option>
                            </select>
                          </div>
                        </div>                                   
                        <div class="form-group">
                          <label class="col-sm-2 control-label">Total Lembur Backup</label>
                          <div class="col-sm-3">
                            <input readonly name="lembur_backup" type="text" id="lembur_backup" class="form-control" /> 
                          </div>                                        
                          <label class="col-sm-2 control-label">Total Lembur Public Holiday</label>
                          <div class="col-sm-3">
                            <input readonly name="lembur_holiday" type="text" id="lembur_holiday" class="form-control" /> 
                          </div>                                        
                        </div>                      
                        <div class="form-group">
                          <label class="col-sm-2 control-label">Total Lembur Reguler</label>
                          <div class="col-sm-3">
                            <input readonly name="lembur_reguler" type="text" id="lembur_reguler" class="form-control" /> 
                          </div>                                        
                          <label class="col-sm-2 control-label">Total Potongan Sakit</label>
                          <div class="col-sm-3">
                            <input readonly name="potongan_sakit" type="text" id="potongan_sakit" class="form-control" /> 
                          </div>                                        
                        </div>                                            
                        <div class="form-group">
                          <label class="col-sm-2 control-label">Total Potongan Izin</label>
                          <div class="col-sm-3">
                            <input readonly name="potongan_izin" type="text" id="potongan_izin" class="form-control" /> 
                          </div>                                        
                          <label class="col-sm-2 control-label">Total Potongan Cuti</label>
                          <div class="col-sm-3">
                            <input readonly name="potongan_cuti" type="text" id="potongan_cuti" class="form-control" /> 
                          </div>                                        
                        </div>                                            
                        <div class="form-group">
                          <label class="col-sm-2 control-label">Total Potongan TK</label>
                          <div class="col-sm-3">
                            <input readonly name="potongan_tk" type="text" id="potongan_tk" class="form-control" /> 
                          </div>                                                                                
                          <label class="col-sm-2 control-label">Total Potongan BPJS Kesehatan</label>
                          <div class="col-sm-3">
                            <input readonly name="potongan_bpjs_ks" type="text" id="potongan_bpjs_ks" class="form-control" /> 
                          </div>                                                                                
                        </div>                                            
                        <div class="form-group">
                          <label class="col-sm-2 control-label">Total Potongan BPJS Ketenagakerjaan</label>
                          <div class="col-sm-3">
                            <input readonly name="potongan_bpjs_kj" type="text" id="potongan_bpjs_kj" class="form-control" /> 
                          </div>                            
                        </div>                                            
                        <div class="form-group"> 
                          <label class="col-sm-2 control-label">Potongan Lain-lain</label>
                          <div class="col-sm-3">
                            <input name="potongan_lain" type="text" id="potongan_lain" class="form-control" value=0 /> 
                          </div>     
                          <label class="col-sm-2 control-label">Potongan Diksar</label>
                          <div class="col-sm-3">
                            <input name="potongan_diksar" type="text" id="potongan_diksar" class="form-control" value=0 /> 
                          </div>    
                        </div>        
                        <div class="form-group">
                          <label class="col-sm-2 control-label">Lembur Lain-lain</label>
                          <div class="col-sm-3">
                            <input name="lembur_lain" type="text" id="lembur_lain" class="form-control" value=0 /> 
                          </div>         
                          <label class="col-sm-2 control-label">Bonus</label>
                          <div class="col-sm-3">
                            <input readonly name="bonus" type="text" id="bonus" class="form-control" value=0 /> 
                          </div>                                                                                                                                                                                                         
                        </div>              
                        <div class="form-group">
                            <label class="col-sm-2 control-label"></label>
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
    $(document).ready(function(){
      $("#id_karyawan").change(function(){
        if($("#id_karyawan").val() != '0')
          $("#periode").attr("disabled", false);
      });

      $("#periode").change(function(){
        if($("#periode").val() != '0')
          $("#ph").attr("disabled", false);
      });

      $("#box-kontrak").hide();
    });

    $(function () {
      $(".select2").select2();
    });

    var potongan_lain = document.getElementById('potongan_lain');
    var potongan_diksar = document.getElementById('potongan_diksar');
    var lembur_lain = document.getElementById('lembur_lain');

    potongan_lain.addEventListener("keyup", function(e){
      potongan_lain.value = convertToRupiah(potongan_lain.value, "");
    });
    potongan_diksar.addEventListener("keyup", function(e){
      potongan_diksar.value = convertToRupiah(potongan_diksar.value, "");
    });
    lembur_lain.addEventListener("keyup", function(e){
      lembur_lain.value = convertToRupiah(lembur_lain.value, "");
    });

      function getDetail() {
        data = {
          id_karyawan: $("#id_karyawan").val(),
          id_periode: $("#periode").val(),
          ph: $("#ph").val()
        };

        $.ajax({
          type: "GET",
          url: "get_input-gaji.php",
          data: data, 
          dataType: "JSON",
          success: function(result){
            $("#lembur_backup").val(result.lembur_backup);
            $("#lembur_holiday").val(result.lembur_holiday);
            $("#lembur_reguler").val(result.lembur_reguler);
            $("#potongan_sakit").val(result.potongan_sakit);
            $("#potongan_izin").val(result.potongan_izin);
            $("#potongan_cuti").val(result.potongan_cuti);
            $("#potongan_tk").val(result.potongan_tk);
            $("#potongan_bpjs_ks").val(result.potongan_bpjs_ks);
            $("#potongan_bpjs_kj").val(result.potongan_bpjs_kj);
            if(result.kontrak > 0 && result.kontrak < 31){
              $("#box-kontrak").show();
              $("#text-kontrak").text(result.kontrak);
              $("#bonus").removeAttr('readonly');
            } else {
              $("#box-kontrak").hide();
            }
          }
        });
      }
    </script>
  </body>
</html>
