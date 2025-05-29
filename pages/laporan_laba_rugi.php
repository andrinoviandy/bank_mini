<?php
// $data = mysqli_fetch_array(mysqli_query($koneksi, "select *,alat_pelatihan.id as idd,pembeli.id as id_rumkit from barang_teknisi,barang_teknisi_detail,barang_teknisi_detail_teknisi, barang_dikirim,barang_dikirim_detail, barang_dijual, barang_gudang, barang_gudang_detail,pembeli, tb_teknisi,alat_uji_detail,alat_pelatihan where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=barang_dikirim_detail.barang_gudang_detail_id and barang_dijual.id=barang_dikirim.barang_dijual_id and barang_dikirim.id=barang_dikirim_detail.barang_dikirim_id and pembeli.id=barang_dijual.pembeli_id and barang_dikirim_detail.id=barang_teknisi_detail.barang_dikirim_detail_id and barang_teknisi.id=barang_teknisi_detail.barang_teknisi_id and barang_teknisi_detail.id=barang_teknisi_detail_teknisi.barang_teknisi_detail_id and tb_teknisi.id=barang_teknisi_detail_teknisi.teknisi_id and barang_teknisi_detail.id=alat_uji_detail.barang_teknisi_detail_id and alat_uji_detail.id=alat_pelatihan.alat_uji_detail_id and alat_pelatihan.id=" . $_GET['id'] . ""));

if (isset($_POST['tambah_spk_masuk'])) {
  $Result = mysqli_query($koneksi, "update alat_pelatihan set banyak_peserta='" . $_POST['peserta'] . "', pelatih='" . $_POST['pelatih'] . "', tgl_pelatihan='" . $_POST['tgl_pelatihan'] . "', pelatihan_oleh='" . $_POST['pelatihan_oleh'] . "' where id=" . $_GET['id'] . "");

  if ($Result) {

    echo "<script type='text/javascript'>
		alert('Silakan Update Data Peserta !');
		window.location='index.php?page=tambah_peserta_pelatihan&id=$_GET[id]';
		</script>";
  }
}

if (isset($_POST['tambahteknisibaru'])) {
  $dat = mysqli_num_rows(mysqli_query($koneksi, "select * from tb_teknisi where nama_teknisi='" . $_POST['nama_teknisi'] . "'"));
  if ($dat == 0) {
    $Result = mysqli_query($koneksi, "insert into tb_teknisi values('','" . $_POST['nama_teknisi'] . "','" . $_POST['bidang'] . "','" . $_POST['no_str'] . "','" . $_POST['no_hp'] . "','" . $_POST['username'] . "','" . md5($_POST['password']) . "','" . $_POST['nama_teknisi'] . "-" . $_FILES['ijazah']['name'] . "','" . $_POST['nama_teknisi'] . "-" . $_FILES['sertifikat']['name'] . "')");
    if ($Result) {
      copy($_FILES['ijazah']['tmp_name'], "ijazah_teknisi/" . $_POST['nama_teknisi'] . "-" . $_FILES['ijazah']['name']);
      copy($_FILES['sertifikat']['tmp_name'], "ijazah_teknisi/sertifikat/" . $_POST['nama_teknisi'] . "-" . $_FILES['sertifikat']['name']);
      echo "<script type='text/javascript'>
		alert('Teknisi Berhasil Di Tambah !');
		window.location='index.php?page=tambah_spk_masuk'
		</script>";
    }
  } else {
    echo "<script type='text/javascript'>
		alert('Nama Teknisi Sudah Ada !');
		window.location='index.php?page=tambah_spk_masuk#tambahTeknisi'
		</script>";
  }
}

if (isset($_POST['lihat'])) {
  echo "<script type='text/javascript'>
	window.location='index.php?page=laporan_laba_rugi&tgl1=$_POST[tgl1]&tgl2=$_POST[tgl2]';
	</script>";
}
?>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Laporan Laba Rugi

    </h1>
    <ol class="breadcrumb">
      <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Laporan Laba Rugi</li>
    </ol>
  </section>


  <!-- Main content -->
  <section class="content">
    <!-- Small boxes (Stat box) --><!-- /.row -->
    <!-- Main row -->
    <form method="post" enctype="multipart/form-data">
      <div class="row">
        <!-- Left col -->

        <section class="col-lg-12 connectedSortable">
          <!-- Custom tabs (Charts with tabs)--><!-- /.nav-tabs-custom -->

          <!-- Chat box -->
          <div class="box box-success"><!-- /.chat -->
            <form method="post">
              <br />
              <table align="center">
                <tr>
                  <td>Tanggal Periode Dari &nbsp;</td>
                  <td><input type="date" name="tgl1" class="form-control" value="<?php if (isset($_GET['tgl1'])) {
                                                                                    echo $_GET['tgl1'];
                                                                                  } ?>" /></td>
                  <td>&nbsp; Sampai &nbsp;</td>
                  <td><input type="date" name="tgl2" class="form-control" value="<?php if (isset($_GET['tgl2'])) {
                                                                                    echo $_GET['tgl2'];
                                                                                  } ?>" /></td>
                  <?php if (isset($_GET['tgl1'])) { ?>
                    <td>
                      <a href="?page=laporan_laba_rugi"><button name="lihat2" type="button" class="btn btn-warning">Ulangi</button></a>
                    </td>
                  <?php } ?>
                  <?php if (!isset($_GET['tgl1'])) { ?>
                    <td><button name="lihat" type="submit" class="btn btn-success">Lihat</button></td>
                  <?php } ?>
                  <?php if (isset($_GET['tgl1'])) { ?>
                    <td>
                      <a target="_blank"><span class="">
                          <div data-toggle="tooltip" title="Cetak Excel" class="btn btn-info" name="cetak_excel"><span class="fa fa-file-excel-o"></span></div>
                        </span></a>
                    </td>
                    <td>
                      <a href="print_laporan_laba_rugi.php?tgl1=<?php echo $_GET['tgl1'] ?>&tgl2=<?php echo $_GET['tgl2'] ?>" target="_blank"><span class="">
                          <div data-toggle="tooltip" title="Print" class="btn btn-danger" name="cetak_pdf"><span class="fa fa-print"></span></div>
                        </span></a>
                    </td>
                  <?php } ?>
                </tr>
              </table>
            </form>
            <div class="box-footer">
              <div class="box-header with-border" style="background-color:#FC9">
                <h3 class="box-title"><strong>Pemasukan</strong></h3>
                <h3 class="box-title pull pull-right">
                  <strong><?php
                          $pemasukan = mysqli_fetch_array(mysqli_query($koneksi, "select sum(saldo) as total from keuangan,keuangan_detail,coa,coa_sub where keuangan.id=keuangan_detail.keuangan_id and coa.id=keuangan_detail.coa_id and coa_sub.id=keuangan_detail.coa_sub_id and coa.id=4"));
                          echo number_format($pemasukan['total'], 2, ',', '.'); ?>
                  </strong>
                </h3>
              </div>
              <div class="box-body">
                <ul class="list-group list-group-unbordered">
                  <?php
                  $q_coa4 = mysqli_query($koneksi, "select * from coa_sub where coa_id=4");
                  while ($d_coa = mysqli_fetch_array($q_coa4)) {
                  ?>
                    <li class="list-group-item">
                      <?php echo $d_coa['nama_sub_grup']; ?>
                      <font class="pull-right">
                        <a href="index.php?page=lihat_ringkasan&judul=<?php echo $d_coa['nama_sub_grup']; ?>&id=<?php echo $d_coa['id']; ?>">
                          <?php
                          $saldo4 = mysqli_fetch_array(mysqli_query($koneksi, "select sum(saldo) as total from keuangan,keuangan_detail where keuangan.id=keuangan_detail.keuangan_id and keuangan_detail.coa_sub_id=$d_coa[id]"));
                          echo number_format($saldo4['total'], 2, ',', '.');
                          ?>
                        </a>
                      </font>
                    </li>
                  <?php } ?>
                </ul>
              </div>
              <div class="box-header with-border" style="background-color:#FC9">
                <h3 class="box-title"><strong>Dikurangi Pengeluaran</strong></h3>
                <h3 class="box-title pull pull-right">
                  <strong><?php
                          $pengeluaran = mysqli_fetch_array(mysqli_query($koneksi, "select sum(saldo) as total from keuangan,keuangan_detail,coa,coa_sub where keuangan.id=keuangan_detail.keuangan_id and coa.id=keuangan_detail.coa_id and coa_sub.id=keuangan_detail.coa_sub_id and coa.id=5"));
                          echo number_format($pengeluaran['total'], 2, ',', '.'); ?>
                  </strong>
                </h3>
              </div>
              <div class="box-body">
                <ul class="list-group list-group-unbordered">
                  <?php
                  $q_coa5 = mysqli_query($koneksi, "select * from coa_sub where coa_id=5");
                  while ($d_coa = mysqli_fetch_array($q_coa5)) {
                  ?>
                    <li class="list-group-item">
                      <?php echo $d_coa['nama_sub_grup']; ?>
                      <font class="pull-right">
                        <a href="index.php?page=lihat_ringkasan&judul=<?php echo $d_coa['nama_sub_grup']; ?>&id=<?php echo $d_coa['id']; ?>">
                          <?php
                          $saldo5 = mysqli_fetch_array(mysqli_query($koneksi, "select sum(saldo) as total from keuangan,keuangan_detail where keuangan.id=keuangan_detail.keuangan_id and coa_sub_id=$d_coa[id]"));
                          echo number_format($saldo5['total'], 2, ',', '.');
                          ?>
                        </a>
                      </font>
                    </li>
                  <?php } ?>
                </ul>
              </div>
              <div class="box-header with-border" style="background-color:#FC9">
                <h3 class="box-title"><strong>
                    <?php if ($pemasukan['total'] - $pengeluaran['total'] < 0) {
                      echo "Rugi Bersih";
                    } else {
                      echo "Laba Bersih";
                    } ?></strong></h3>
                <h3 class="box-title pull pull-right">
                  <strong><?php
                          echo number_format($pemasukan['total'] - $pengeluaran['total'], 2, ',', '.'); ?>
                  </strong>
                </h3>
              </div>
            </div>
          </div>
        </section>
        <!-- right col -->
      </div>
    </form>
    <!-- /.row (main row) -->

  </section>
  <!-- /.content -->
</div>