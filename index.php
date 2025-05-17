<?php require("config/koneksi.php"); ?>
<?php
error_reporting(0);
session_start();
if (isset($_SESSION['user_administrator']) and isset($_SESSION['pass_administrator']) or isset($_SESSION['user_customer']) and isset($_SESSION['pass_customer']) or isset($_SESSION['user_teknisi']) and isset($_SESSION['pass_teknisi']) or isset($_SESSION['user_admin_gudang']) and isset($_SESSION['pass_admin_gudang']) or isset($_SESSION['user_admin_teknisi']) and isset($_SESSION['pass_admin_teknisi']) or isset($_SESSION['user_admin_keuangan']) and isset($_SESSION['pass_admin_keuangan']) or isset($_SESSION['user_admin_po_dalam']) and isset($_SESSION['pass_admin_po_dalam']) or isset($_SESSION['user_admin_po_luar']) and isset($_SESSION['pass_admin_po_luar']) or isset($_SESSION['user_manajer_gudang']) or isset($_SESSION['user_manajer_teknisi']) or isset($_SESSION['user_manajer_keuangan']) or isset($_SESSION['user_manajer_marketing']) or isset($_SESSION['user_cs']) or isset($_SESSION['user_pjt'])) {
?>
  <?php
  function tgl_indo($tanggal)
  {
    $bulan = array(
      1 =>   'Januari',
      'Februari',
      'Maret',
      'April',
      'Mei',
      'Juni',
      'Juli',
      'Agustus',
      'September',
      'Oktober',
      'November',
      'Desember'
    );
    $pecahkan = explode('-', $tanggal);

    // variabel pecahkan 0 = tanggal
    // variabel pecahkan 1 = bulan
    // variabel pecahkan 2 = tahun

    return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
  }
  ?>
  <!DOCTYPE html>
  <html>

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Bank Mini</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- folder js -->
    <script src="js/getVars.js"></script>
    <!-- <script src="js/cekData.js"></script> -->
    <link rel="stylesheet" href="dist/sweetalert2/sweetalert2.min.css">
    <script src="dist/sweetalert2/sweetalert2.min.js"></script>
    <!-- jquery 3.6.x -->
    <script src="js/jquery-3.6.0.js"></script>
    <!-- DataTables -->
    <!-- <script type="text/javascript">
      // Set timeout variables.
      var timoutWarning = 60000; // Display warning in 1Mins.
      var timoutNow = 70000; // Timeout in 2 mins.

      var warningTimer;
      var timeoutTimer;

      // Start timers.
      function StartTimers() {
        warningTimer = setTimeout(timoutWarning);
        timeoutTimer = setTimeout("IdleTimeout()", timoutNow);
      }

      // Reset timers.
      function ResetTimers() {
        clearTimeout(warningTimer);
        clearTimeout(timeoutTimer);
        StartTimers();
        $("#timeout").dialog('close');
      }

      // Logout the user and auto reload or use this window.open('http://www.YourPageAdress.com', '_self'); to auto load a page.
      function IdleTimeout() {
        window.open(self.location, '_top');
      }
    </script> -->
    <link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
    <!-- daterange picker -->
    <link rel="stylesheet" href="bower_components/bootstrap-daterangepicker/daterangepicker.css">
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="plugins/iCheck/all.css">
    <!-- Bootstrap Color Picker -->
    <link rel="stylesheet" href="bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css">
    <!-- Bootstrap time Picker -->
    <link rel="stylesheet" href="plugins/timepicker/bootstrap-timepicker.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="bower_components/select2/dist/css/select2.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

    <!-- Google Font -->
    <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic"> -->
    <style>
      /*css3 design scrollbar*/
      ::-webkit-scrollbar {
        width: 15px;
        height: 15px;
        border-radius: 10px;
      }

      ::-webkit-scrollbar-track {
        background: #CCC;
        border-radius: 10px;
      }

      ::-webkit-scrollbar-thumb {
        background: #2596be;
        border-radius: 10px;
      }
    </style>
    <style>
      .modalDialog {
        position: absolute;
        font-family: Arial, Helvetica, sans-serif;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        background: rgba(0, 0, 0, 0.8);
        z-index: 99999;
        opacity: 0;
        transition: opacity 200ms ease-in;
        pointer-events: none;

      }

      .modalDialog:target {
        opacity: 1;
        pointer-events: auto;
      }

      .modalDialog>div {
        width: 300px;
        position: relative;

        padding: 5px 20px 13px 20px;
        border-radius: 10px;
        background: #fff;
        background: linear-gradient(#fff, #aaa);
        margin: 3% auto;
      }

      .close:hover {
        background: #00d9ff;
      }

      .close {
        background: #F00;
        color: #FFFFFF;
        line-height: 25px;
        position: absolute;
        text-align: center;
        top: -10px;
        right: -12px;
        width: 24px;
        text-decoration: none;
        font-weight: bold;
        border-radius: 12px;
        box-shadow: 1px 1px 3px #000;
      }

      .modalDialog2 {
        position: absolute;
        font-family: Arial, Helvetica, sans-serif;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        background: rgba(0, 0, 0, 0.8);
        z-index: 99999;
        opacity: 0;
        transition: opacity 200ms ease-in;
        pointer-events: none;

      }

      .modalDialog2:target {
        opacity: 1;
        pointer-events: auto;
      }

      .modalDialog2>div {
        width: 700px;
        position: relative;

        padding: 5px 20px 13px 20px;
        border-radius: 10px;
        background: #fff;
        background: linear-gradient(#fff, #aaa);
        margin: 4% auto;
      }

      .close2:hover {
        background: #00d9ff;
      }

      .close2 {
        background: #F00;
        color: #FFFFFF;
        line-height: 25px;
        position: absolute;
        text-align: center;
        top: -10px;
        right: -12px;
        width: 24px;
        text-decoration: none;
        font-weight: bold;
        border-radius: 12px;
        box-shadow: 1px 1px 3px #000;
      }

      #input {
        width: 100%;
        padding: 8px 18px;
        margin: 3px 0;
        display: inline-block;
        border: 1px solid #ccc;
        box-sizing: border-box;
      }

      #buttonn {
        background-color: #4CAF50;
        color: white;
        padding: 14px 20px;
        margin: 8px 0;
        border: none;
        cursor: pointer;
        width: 100%;
      }
    </style>
    <link href='img/logo.png' rel='icon'>

    <script>
      function tandaPemisahTitik(b) {
        var _minus = false;
        if (b < 0) _minus = true;
        b = b.toString();
        b = b.replace(".", "");
        b = b.replace("-", "");
        c = "";
        panjang = b.length;
        j = 0;
        for (i = panjang; i > 0; i--) {
          j = j + 1;
          if (((j % 3) == 1) && (j != 1)) {
            c = b.substr(i - 1, 1) + "." + c;
          } else {
            c = b.substr(i - 1, 1) + c;
          }
        }
        if (_minus) c = "-" + c;
        return c;
      }

      function numbersonly(ini, e) {
        if (e.keyCode >= 49) {
          if (e.keyCode <= 57) {
            a = ini.value.toString().replace(".", "");
            b = a.replace(/[^\d]/g, "");
            b = (b == "0") ? String.fromCharCode(e.keyCode) : b + String.fromCharCode(e.keyCode);
            ini.value = tandaPemisahTitik(b);
            return false;
          } else if (e.keyCode <= 105) {
            if (e.keyCode >= 96) {
              //e.keycode = e.keycode - 47;
              a = ini.value.toString().replace(".", "");
              b = a.replace(/[^\d]/g, "");
              b = (b == "0") ? String.fromCharCode(e.keyCode - 48) : b + String.fromCharCode(e.keyCode - 48);
              ini.value = tandaPemisahTitik(b);
              //alert(e.keycode);
              return false;
            } else {
              return false;
            }
          } else {
            return false;
          }
        } else if (e.keyCode == 48) {
          a = ini.value.replace(".", "") + String.fromCharCode(e.keyCode);
          b = a.replace(/[^\d]/g, "");
          if (parseFloat(b) != 0) {
            ini.value = tandaPemisahTitik(b);
            return false;
          } else {
            return false;
          }
        } else if (e.keyCode == 95) {
          a = ini.value.replace(".", "") + String.fromCharCode(e.keyCode - 48);
          b = a.replace(/[^\d]/g, "");
          if (parseFloat(b) != 0) {
            ini.value = tandaPemisahTitik(b);
            return false;
          } else {
            return false;
          }
        } else if (e.keyCode == 8 || e.keycode == 46) {
          a = ini.value.replace(".", "");
          b = a.replace(/[^\d]/g, "");
          b = b.substr(0, b.length - 1);
          if (tandaPemisahTitik(b) != "") {
            ini.value = tandaPemisahTitik(b);
          } else {
            ini.value = "";
          }

          return false;
        } else if (e.keyCode == 9) {
          return true;
        } else if (e.keyCode == 17) {
          return true;
        } else {
          //alert (e.keyCode);
          return false;
        }

      }
    </script>
  </head>

  <body class="hold-transition skin-blue sidebar-mini fixed">
    <div class="wrapper">

      <header class="main-header">
        <!-- Logo -->
        <a href="" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>BM</b></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>Bank Mini</b></span>
        </a>

        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <?php if (!isset($_SESSION['user_customer'])) { ?>
            <div class="navbar-custom-menu pull pull-left">
              <ul class="nav navbar-nav">
                <li class="user-footer">
                  <!--<a href="download_panduan.php">* Download Panduan Pemakaian</a>-->
                </li>
              </ul>
            </div>
          <?php } ?>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->

              <!-- Notifications: style can be found in dropdown.less -->
              <?php if (isset($_SESSION['id_b'])) { ?>
                <li class="dropdown notifications-menu bg-yellow">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-bell-o"></i>
                    <?php
                    $sdg = mysqli_num_rows(mysqli_query($koneksi, "select * from tb_maintenance,tb_teknisi where tb_teknisi.id=tb_maintenance.teknisi_id and tb_teknisi.id=" . $_SESSION['id_b'] . " and tb_maintenance.status_proses=1 order by tgl_maintenance DESC"));
                    if ($sdg != 0) {
                    ?>
                      <span class="label label-warning"><?php echo $sdg; ?></span>
                    <?php } ?>
                  </a>
                  <ul class="dropdown-menu">
                    <li class="header">Anda mempunyai <?php echo $sdg; ?> tugas yang sedang dikerjakan</li>
                    <li>
                      <!-- inner menu: contains the actual data -->
                      <ul class="menu">
                        <?php if ($sdg != 0) { ?>
                          <?php
                          $queryy = mysqli_query($koneksi, "select *,tb_maintenance.id as idd from tb_maintenance,tb_teknisi,tb_laporan_kerusakan,barang_gudang,barang_dijual,barang_dikirim where barang_gudang.id=barang_dijual.barang_gudang_id and barang_dijual.id=barang_dikirim.barang_dijual_id and barang_dikirim.id=tb_laporan_kerusakan.barang_dikirim_id and tb_laporan_kerusakan.id=tb_maintenance.laporan_kerusakan_id and tb_teknisi.id=tb_maintenance.teknisi_id and tb_teknisi.id=" . $_SESSION['id_b'] . " and tb_maintenance.status_proses=1 order by tgl_maintenance DESC");
                          while ($data8 = mysqli_fetch_assoc($queryy)) {
                          ?>
                            <li>
                              <small class="label pull-right bg-green">
                                <?php echo date("d F Y", strtotime($data8['tgl_maintenance'])); ?>
                              </small>
                              <a href="index.php?page=detail_progress&id=<?php echo $data8['idd'] ?>">
                                <i class="fa fa-cube text-warning"></i> <?php echo $data8['nama_brg'] . " / " . $data8['lokasi']; ?>
                              </a>

                            </li>

                        <?php }
                        } ?>
                      </ul>
                    </li>
                  </ul>
                </li>
                <!--Batass-->
                <li class="dropdown notifications-menu bg-red">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-bell-o"></i>
                    <?php
                    $blm = mysqli_num_rows(mysqli_query($koneksi, "select * from tb_maintenance,tb_teknisi where tb_teknisi.id=tb_maintenance.teknisi_id and tb_teknisi.id=" . $_SESSION['id_b'] . " and tb_maintenance.status_proses=0"));
                    if ($blm != 0) {
                    ?>
                      <span class="label label-danger">
                        <?php echo $blm; ?>
                      </span>
                    <?php } ?>
                  </a>
                  <ul class="dropdown-menu">
                    <li class="header">Anda mempunyai <?php echo $blm; ?> tugas belum dikerjakan</li>
                    <li>
                      <!-- inner menu: contains the actual data -->
                      <ul class="menu">
                        <?php if ($blm != 0) { ?>
                          <?php
                          $query = mysqli_query($koneksi, "select *,tb_maintenance.id as idd from tb_maintenance,tb_teknisi,tb_laporan_kerusakan,barang_gudang,barang_dijual,barang_dikirim where barang_gudang.id=barang_dijual.barang_gudang_id and barang_dijual.id=barang_dikirim.barang_dijual_id and barang_dikirim.id=tb_laporan_kerusakan.barang_dikirim_id and tb_laporan_kerusakan.id=tb_maintenance.laporan_kerusakan_id and tb_teknisi.id=tb_maintenance.teknisi_id and tb_teknisi.id=" . $_SESSION['id_b'] . " and tb_maintenance.status_proses=0");
                          while ($data7 = mysqli_fetch_assoc($query)) {
                          ?>
                            <li>
                              <small class="label pull-right bg-green">
                                <?php echo date("d F Y", strtotime($data7['tgl_maintenance'])); ?>
                              </small>
                              <a href="index.php?page=detail_progress&id=<?php echo $data7['idd'] ?>">
                                <i class="fa fa-cube text-danger"></i> <?php echo $data7['nama_brg'] . " / " . $data7['lokasi']; ?>
                              </a>
                            </li>
                        <?php }
                        } ?>
                      </ul>
                    </li>

                  </ul>
                </li>

                <?php if (isset($_SESSION['id_b'])) { ?>
                  <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                      <img src="kharisma.png" class="user-image" alt="User Image">
                      <span class="hidden-xs">Teknisi</span>
                    </a>
                    <ul class="dropdown-menu">
                      <!-- User image -->
                      <li class="user-header">
                        <img src="kharisma.png" class="img-circle" alt="User Image">

                        <p>
                          <?php
                          $d = mysqli_fetch_array(mysqli_query($koneksi, "select * from tb_teknisi where id=" . $_SESSION['id_b'] . ""));
                          echo $d['nama_teknisi'];
                          ?>
                          <small>Teknisi</small>
                        </p>
                      </li>
                    <?php } ?>
                    <!-- Menu Body -->
                    <li class="user-body">
                      <div class="row">
                        <div class="col-xs-4 pull pull-left">
                          <?php

                          echo $d['bidang']; ?>
                        </div>

                        <div class="col-xs-4 pull pull-right">
                          <?php echo $d['no_hp']; ?>
                        </div>
                      </div>
                      <!-- /.row -->
                    </li>
                    <!-- Menu Footer-->
                    <li class="user-footer">
                      <div class="pull-left">

                      </div>
                      <div class="pull-right">
                        <a href="javascript:void()" onclick="prosesLogout();" class="btn btn-default btn-flat"><i class="fa fa-power-off"></i></a>
                      </div>
                    </li>
                    </ul>
                  </li>
                <?php } ?>
                <!-- Control Sidebar Toggle Button -->
                <?php if (!isset($_SESSION['id_b'])) { ?>
                  <li>
                    <a href="javascript:void()" onclick="prosesLogout();" title="Logout"><i class="fa fa-power-off"></i></a>
                  </li>
                <?php } ?>
            </ul>
          </div>

        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <?php
      if (isset($_SESSION['user_administrator']) and isset($_SESSION['pass_administrator'])) {
        require('sidebar.php');
      } else if (isset($_SESSION['user_customer']) and isset($_SESSION['pass_customer'])) {
        require('sidebar_user.php');
      } else if (isset($_SESSION['user_teknisi']) and isset($_SESSION['pass_teknisi'])) {
        require('sidebar_teknisi.php');
      } else if (isset($_SESSION['user_admin_gudang']) and isset($_SESSION['pass_admin_gudang']) or isset($_SESSION['user_manajer_gudang']) and isset($_SESSION['pass_manajer_gudang'])) {
        require('sidebar_admin_gudang.php');
      } else if (isset($_SESSION['user_admin_teknisi']) and isset($_SESSION['pass_admin_teknisi']) or isset($_SESSION['user_manajer_teknisi']) and isset($_SESSION['pass_manajer_teknisi'])) {
        require('sidebar_admin_teknisi.php');
      } else if (isset($_SESSION['user_admin_keuangan']) and isset($_SESSION['pass_admin_keuangan']) or isset($_SESSION['user_manajer_keuangan']) and isset($_SESSION['pass_manajer_keuangan'])) {
        require('sidebar_admin_keuangan.php');
      } else if (isset($_SESSION['user_manajer_marketing']) and isset($_SESSION['pass_manajer_marketing'])) {
        require('sidebar_admin_marketing.php');
      } else if (isset($_SESSION['user_admin_po_dalam']) or isset($_SESSION['user_admin_po_luar'])) {
        require('sidebar_po2.php');
      } else if (isset($_SESSION['user_cs']) or isset($_SESSION['pass_cs'])) {
        require('sidebar_cs.php');
      } else if (isset($_SESSION['user_pjt']) or isset($_SESSION['pass_pjt'])) {
        require('sidebar_pjt.php');
      }
      ?>

      <!-- Content Wrapper. Contains page content -->
      <?php
      /*if (isset($_SESSION['user_administrator'])) {
	if (isset($_GET['page'])) {
	  include "pages/".$_GET['page'].".php";
	  }
	  
	  else {
		  echo "<script>
		  window.location='index.php?page=beranda';
		  </script>";
		  } 
	}
else if (isset($_SESSION['admingudang'])) {
	
	if (isset($_GET['page'])) {
	  include "pages/".$_GET['page'].".php";
	  }
	  
	  else {
		  echo "<script>
		  window.location='index.php?page=beranda';
		  </script>";
		  }
	
	} 
else if (isset($_SESSION['adminteknisi'])) { 
	
	if (isset($_GET['page'])) {
	  include "pages/".$_GET['page'].".php";
	  }
	  
	  else {
		  echo "<script>
		  window.location='index.php?page=beranda';
		  </script>";
		  }
	
	}
else if (isset($_SESSION['adminkeuangan'])) { 
	
	if (isset($_GET['page'])) {
	  include "pages/".$_GET['page'].".php";
	  }
	  
	  else {
		  echo "<script>
		  window.location='index.php?page=beranda';
		  </script>";
		  }
	
	}
else if (isset($_SESSION['adminpodalam']) or isset($_SESSION['adminpoluar'])) { 
	
	if (isset($_GET['page'])) {
	  include "pages/".$_GET['page'].".php";
	  }
	  
	  else {
		  echo "<script>
		  window.location='index.php?page=beranda';
		  </script>";
		  }
	
	}*/
      if (isset($_GET['page'])) {
        if (file_exists("pages/" . $_GET['page'] . ".php")) {
          include "pages/" . $_GET['page'] . ".php";
        } else {
          include "pages/blank.php";
        }
      } else {
        echo "<script>
		  window.location='index.php?page=ringkasan';
		  </script>";
      }
      ?>
      <!-- /.content-wrapper -->
      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 1
        </div>a
        <strong>Copyright &copy; 2025 <a href="#">Developed by PruTech PTPU</a>.</strong> All rights
        reserved.
      </footer>

      <!-- Control Sidebar -->

      <!-- /.control-sidebar -->
      <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>
    </div>
    <div class="modal fade" id="modal-tidak">
      <div class="modal-dialog  modal-sm">
        <div class="modal-content">
          <div class="modal-header">

            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title"><span class="fa fa-exclamation-triangle"></span> Peringatan</h4>
          </div>

          <div class="modal-body">
            Maaf, Menu Ini Belum Dapat Di Gunakan
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>

          </div>

        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- <div class="modal fade" id="modal-aaa">
      <div class="modal-dialog modal-md">
        <div class="modal-content" style="background-image: url(img/beranda.png); background-position: center; background-repeat: no-repeat; background-size: contain; ">
          <div class="modal-header">
            <h4 class="modal-title"><i class=""></i> Notifikasi</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
          </div>
          <div class="modal-body">
            <h2 align="center">
              <div id="tess"></div> Datang<br>Sistem Informasi Manajemen<br>PT Cipta Varia Kharisma Utama
            </h2>
            <br>
            <h4 align="justify">
              Saat ini sistem sudah masuk pada versi 2 dan memiliki beberapa perubahan dan
              <em>fitur</em> tambahan, diantaranya adalah sebagai berikut :
              <ol style="margin-top : 15px; margin-bottom : 15px">
                <li>Data otomatis ter-reload jika ada perubahan pada data</li>
                <li>Mesin pencarian yang berjalan saat <em>keyword</em> diketikkan</li>
                <li>Kecepatan <em>reload</em> data yang cukup cepat</li>
                <li>Dan banyak lainnya</li>
              </ol>
              Terima kasih atas perhatiannya.
            </h4>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Close</button>
          </div>
        </div>
        /.modal-content -->
    <!-- </div> -->
    <!-- /.modal-dialog -->
    <!-- </div> -->
    <!-- <script>
      function bukaModal() {
        var tess = document.getElementById("iddd").value;
        document.getElementById("tess").innerHTML = tess
        $('#modal-aaa').modal('show');
      }
    </script> -->
    <!-- ./wrapper -->
    <!-- jQuery 3 -->
    <!-- <script src="bower_components/jquery/dist/jquery.min.js"></script> -->

    <!-- <script src="bower_components/jquery/dist/jquery.min.js"></script> -->
    <!-- jQuery UI 1.11.4 -->
    <!-- <script src="bower_components/jquery-ui/jquery-ui.min.js"></script> -->
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script src="bower_components/Chart.js/Chart.js"></script>

    <!-- Bootstrap 3.3.7 -->
    <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- Morris.js charts -->
    <script src="bower_components/raphael/raphael.min.js"></script>
    <script src="bower_components/morris.js/morris.min.js"></script>
    <script src="bower_components/select2/dist/js/select2.full.min.js"></script>
    <!-- Sparkline -->
    <script src="bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
    <!-- jvectormap -->
    <script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
    <!-- daterangepicker -->
    <script src="bower_components/moment/min/moment.min.js"></script>
    <script src="bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
    <!-- datepicker -->
    <script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
    <!-- SlimScroll -->
    <script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="bower_components/fastclick/lib/fastclick.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="dist/js/pages/dashboard.js"></script>


    <!-- DataTables -->
    <script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>


    <!-- page script -->
    <script>
      $('#modal-beranda').modal('show');
    </script>
    <script>
      $(function() {
        $('#example1').DataTable()
        $('#example2').DataTable({
          'paging': false,
          'lengthChange': false,
          'searching': true,
          'ordering': false,
          'info': false,
          'autoWidth': true
        })
        $('#example3').DataTable({
          'paging': true,
          'lengthChange': false,
          'searching': false,
          'ordering': true,
          'info': false,
          'autoWidth': true
        })
        $('#example5').DataTable({
          'paging': false,
          'lengthChange': false,
          'searching': true,
          'ordering': true,
          'info': true,
          'autoWidth': true
        })
        $('#example4').DataTable()
      })
    </script>
    <script>
      $(function() {
        //Initialize Select2 Elements
        $('.select2').select2()
        // $('.select1').select1()
        //Datemask dd/mm/yyyy
        $('#datemask').inputmask('dd/mm/yyyy', {
          'placeholder': 'dd/mm/yyyy'
        })
        //Datemask2 mm/dd/yyyy
        $('#datemask2').inputmask('mm/dd/yyyy', {
          'placeholder': 'mm/dd/yyyy'
        })
        //Money Euro
        $('[data-mask]').inputmask()

        //Date range picker
        $('#reservation').daterangepicker()
        //Date range picker with time picker
        $('#reservationtime').daterangepicker({
          timePicker: true,
          timePickerIncrement: 30,
          format: 'MM/DD/YYYY h:mm A'
        })
        //Date range as a button
        $('#daterange-btn').daterangepicker({
            ranges: {
              'Today': [moment(), moment()],
              'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
              'Last 7 Days': [moment().subtract(6, 'days'), moment()],
              'Last 30 Days': [moment().subtract(29, 'days'), moment()],
              'This Month': [moment().startOf('month'), moment().endOf('month')],
              'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            },
            startDate: moment().subtract(29, 'days'),
            endDate: moment()
          },
          function(start, end) {
            $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
          }
        )

        //Date picker
        $('#datepicker').datepicker({
          autoclose: true
        })

        //iCheck for checkbox and radio inputs
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
          checkboxClass: 'icheckbox_minimal-blue',
          radioClass: 'iradio_minimal-blue'
        })
        //Red color scheme for iCheck
        $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
          checkboxClass: 'icheckbox_minimal-red',
          radioClass: 'iradio_minimal-red'
        })
        //Flat red color scheme for iCheck
        $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
          checkboxClass: 'icheckbox_flat-green',
          radioClass: 'iradio_flat-green'
        })

        //Colorpicker
        $('.my-colorpicker1').colorpicker()
        //color picker with addon
        $('.my-colorpicker2').colorpicker()

        //Timepicker
        $('.timepicker').timepicker({
          showInputs: false
        })
      })
    </script>
    <script src="js/getData/<?php echo $_GET['page'] ?>.js"></script>
    <!-- <script src="js/getData/pembelian_alkes.js"></script> -->
    <script src="js/pencarian.js"></script>
    <script src="js/paging.js"></script>
    <script src="js/loading.js"></script>
    <script src="js/loadingCustom.js"></script>
    <script src="js/showLoading.js"></script>
    <script src="js/cekPaging.js"></script>
    <script src="js/alert.js"></script>
    <!-- <script src="js/paging/<?php //echo $_GET['page'] 
                                ?>.js"></script> -->
    <script>
      let status_deposit_wali = '';
      let interval_deposit_wali;
      let status_deposit_guru = '';
      let interval_deposit_guru;
      var search = document.getElementById("keyword")
      var table = document.getElementById("table")
      var paging2 = document.getElementById("paging-2")
      var paging1 = document.getElementById("paging-1")
      var dari = document.getElementById("dari")
      var sampai = document.getElementById("sampai")
      let jumlah_limit = parseInt(document.getElementById("jumlah_limit").value)
      var tampil = parseInt(getVars("tampil"));
      var tgl1 = getVars("tgl1");
      var tgl2 = getVars("tgl2");
      let load_flag = 0;
      let jumlah_total;
      let key = '';
      let status_b = '';
      $(document).ready(function() {
        $.fn.modal.Constructor.prototype.enforceFocus = function() {};
        // hitungBaris(key)
        loading()
        // setTimeout(function () {
        loadMore(load_flag, key, status_b)
        // }, 500);
      });

      function prosesLogout() {
        Swal.fire({
          customClass: {
            confirmButton: 'bg-green',
            cancelButton: 'bg-white',
          },
          title: 'Anda Yakin Ingin Keluar Dari Sistem ?',
          text: 'Lanjutkan Dengan Pilih Ya',
          icon: 'question',
          showCancelButton: true,
          confirmButtonText: 'Ya',
          cancelButtonText: 'Batal',
        }).then((result) => {
          if (result.isConfirmed) {
            window.location.href = 'proses_logout.php';
          }
        })
      }

      function addRiwayat(aktifitas, nama_tabel, id_tabel, keterangan) {
        $.post("data/simpan_riwayat_aktifitas.php", {
            aktifitas: aktifitas,
            nama_tabel: nama_tabel,
            id_tabel: id_tabel,
            page: '<?php echo $_GET['page'] ?>',
            keterangan: keterangan
          },
          function(data, textStatus, jqXHR) {
            console.log('simpan riwayat - ', data);
          }
        );
      }
    </script>
  </body>

  </html>
<?php

} else {
  echo "<script type='text/javascript'>
	window.location='login.php';
	</script>";
} ?>