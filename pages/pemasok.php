<?php
if (isset($_GET['id_hapus'])) {
  $del2 = mysqli_query($koneksi, "delete from pemasok where id=" . $_GET['id_hapus'] . "");
}
?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Pemasok/Principle</h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Pemasok/Principle</li>
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


              <!--<form method="post" action="cetak_stok_alkes.php">--><!--<a href="cetak_stok_alkes.php">
              <button name="tambah_laporan" class="btn btn-warning" type="submit"><span class="fa fa-print"></span> Cetak Stok Alkes</button></a>
              <span class="pull pull-right"><font color="#FF0000">Keterangan :</font> Klik Nama Alkes Untuk Melihat Proses Penjualan</span>
              -->
              <!--
              <form method="post">
              <div class="input-group pull pull-left col-xs-1">
                
                <select class="form-control" name="limiterr" style="margin-right:40px">
                <option <?php if ($limiter['limiter'] == 10) {
                          echo "selected";
                        } ?> value="10">10</option>
                <option <?php if ($limiter['limiter'] == 50) {
                          echo "selected";
                        } ?> value="50">50</option>
                <option <?php if ($limiter['limiter'] == 100) {
                          echo "selected";
                        } ?> value="100">100</option>
                <option <?php if ($limiter['limiter'] == 500) {
                          echo "selected";
                        } ?> value="500">500</option>
                <option <?php if ($limiter['limiter'] == 1000) {
                          echo "selected";
                        } ?> value="1000">1000</option>
                <?php
                $total = mysqli_num_rows(mysqli_query($koneksi, "select * from barang_gudang"));
                ?>
                <option <?php if ($limiter['limiter'] == $total) {
                          echo "selected";
                        } ?> <?php if ($_POST['cari'] != '') {
                                                                                        echo "selected";
                                                                                      } ?> value="<?php echo $total; ?>">All</option>
                </select>
                
                <span class="input-group-btn">
                      <button type="submit" name="button_limit" class="btn btn-default btn-flat"><i class="fa fa-check"></i></button>
                    </span>
                
              </div>
              </form>
              
              <form method="post">
              <div class="input-group pull pull-left col-xs-2">
                
                <select class="form-control" name="urutt" style="margin-right:40px">
                <option <?php if ($limiter['urut'] == 'ASC') {
                          echo "selected";
                        } ?> value="ASC">Ascending</option>
                <option <?php if ($limiter['urut'] == 'DESC') {
                          echo "selected";
                        } ?> value="DESC">Descending</option>
                
                </select>
                
                <span class="input-group-btn">
                      <button type="submit" name="button_urut" class="btn btn-default btn-flat"><i class="fa fa-check"></i></button>
                    </span>
                
              </div>
              </form>
              
              <form method="post" class="">
              <div class="input-group input-group-md col-xs-4 pull pull-right">
                <input type="text" name="cari" placeholder="Keyword .. (Not ; Stok, Harga, Pengecekan)" class="form-control">
                    <span class="input-group-btn">
                      <button type="submit" name="button_cari" class="btn btn-info btn-flat"><i class="fa fa-search"></i> Cari </button>
                    </span>
              </div>
              </form>-->
              <a href="index.php?page=tambah_pemasok"><input type="submit" name="button" id="button" value="Tambah Pemasok" class="btn btn-success" /></a>
              <br /><br />
              <div class="table-responsive">
                <table width="100%" id="example1" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th align="center" valign="top">No</th>
                      <th valign="top">Nama Pemasok</th>
                      <th valign="top"><strong>Alamat</strong></th>
                      <th valign="top">Telp</th>
                      <th width="16%" align="center" valign="top">Fax</th>
                    </tr>
                  </thead>
                  <?php

                  // membuka file JSON
                  $file = file_get_contents("http://localhost/BANK/json/pemasok.php");
                  $json = json_decode($file, true);
                  $jml = count($json);
                  for ($i = 0; $i < $jml; $i++) {
                    //echo "Nama Barang ke-".$i." : " . $json[$i]['nama_brg'] . "<br />";
                    //echo 'Nama Anggota ke-3 : ' . $json['2']['nama_brg'];
                    #C33 
                  ?>

                    <tr>
                      <td align="center" valign="center"><?php echo $i + 1; ?></td>
                      <td valign="center"><?php echo $json[$i]['nama_principle']; ?></td>
                      <td><?php echo $json[$i]['alamat_principle']; ?></td>

                      <td>
                        <?php echo $json[$i]['telp_principle'];  ?></td>
                      <td><?php echo $json[$i]['fax_principle'];  ?></td>
                    </tr>
                  <?php } ?>
                </table>
              </div>
              <br />

            </div>
          </div>
        </div>
        <!-- /.box (chat box) -->

        <!-- TO DO List --><!-- /.box -->

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