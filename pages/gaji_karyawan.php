<?php
if (isset($_GET['id_hapus'])) {
  $sl = mysqli_fetch_array(mysqli_query($koneksi, "select * from gaji_karyawan where id=" . $_GET['id_hapus'] . ""));
  $del01 = mysqli_query($koneksi, "delete from keuangan_detail where keuangan_id=" . $sl['keuangan_id'] . "");
  $del02 = mysqli_query($koneksi, "delete from keuangan where id=" . $sl['keuangan_id'] . "");
  $del1 = mysqli_query($koneksi, "delete from gaji_karyawan_detail where gaji_karyawan_id=" . $_GET['id_hapus'] . "");
  $del2 = mysqli_query($koneksi, "delete from gaji_karyawan where id=" . $_GET['id_hapus'] . "");
  if ($del01 and $del02 and $del1 and $del2) {
    echo "<script>
	alert('Data Berhasil Dihapus !');
	window.location='index.php?page=gaji_karyawan'</script>";
  } else {
    echo "<script>
	alert('Data Gagal Dihapus !');
	window.location='index.php?page=gaji_karyawan'</script>";
  }
}
?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Gaji Karyawan</h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Gaji Karyawan</li>
    </ol>
  </section>


  <!-- Main content -->
  <section class="content">
    <!-- Small boxes (Stat box) --><!-- /.row -->
    <!-- Main row -->
    <div class="row">
      <!-- Left col -->
      <section class="col-lg-12 connectedSortable">
        <!-- Custom tabs (Charts with tabs)--><!-- /.nav-tabs-custom -->

        <!-- Chat box -->
        <div class="box box-success"><!-- /.chat -->
          <div class="box-footer">
            <div class="box-body">
              <div class="input-group pull pull-left col-xs-1" style="padding-right:10px">
                <a href="index.php?page=tambah_gaji_karyawan">
                  <button name="tambah_laporan" class="btn btn-success" type="submit"><span class="fa fa-plus"></span> Tambah</button></a>
              </div>
              <div class="pull pull-right">
                <?php //include "include/getFilter.php"; 
                ?>
                <?php include "include/atur_halaman.php"; ?>
              </div>
            </div>
          </div>
        </div>
        <!-- /.box (chat box) -->

        <!-- TO DO List --><!-- /.box -->

        <!-- quick email widget -->
      </section>
      <?php include "include/header_pencarian.php"; ?>
      <section class="col-lg-12 connectedSortable">
        <!-- Custom tabs (Charts with tabs)-->
        <!-- /.nav-tabs-custom -->

        <!-- Chat box -->
        <div class="box box-warning">
          <!-- /.chat -->
          <div class="box-footer">
            <div class="box-body">
              <?php include "include/getInputSearch.php"; ?>
              <div id="table" style="margin-top: 10px;"></div>
              <section class="col-lg-12">
                <center>
                  <ul class="pagination">
                    <button class="btn btn-default" id="paging-1"><a><i class="fa fa-angle-double-left"></i></a></button>
                    <button class="btn btn-default" id="paging-2"><a><i class="fa fa-angle-double-right"></i></a></button>
                  </ul>
                  <?php include "include/getInfoPagingData.php"; ?>
                </center>
              </section>
            </div>
          </div>
        </div>
        <!-- /.box (chat box) -->

        <!-- TO DO List -->
        <!-- /.box -->

        <!-- quick email widget -->
      </section>
      <!-- /.Left col -->
      <!-- right col (We are only adding the ID to make the widgets sortable)-->

      <!-- right col -->
    </div>
    <!-- /.row (main row) -->

  </section>
  <!-- /.content -->
</div>