<?php
if (isset($_POST['tambah_header'])) {
  $cek = mysqli_fetch_array(mysqli_query($koneksi, "select COUNT(*) as jml from barang_dijual_qty_hash where akun_id=" . $_SESSION['id'] . ""));
  if ($cek['jml'] != 0) {
    //$insert_pembeli=mysqli_query($koneksi, "insert into pembeli values('','".$_SESSION['pembeli']."','".$_SESSION['provinsi']."','".$_SESSION['kabupaten']."','".$_SESSION['kecamatan']."','".$_SESSION['kelurahan']."','".$_SESSION['alamat']."','".$_SESSION['kontak_rs']."')");

    $insert_pemakai = mysqli_query($koneksi, "insert into pemakai values('','" . $_SESSION['pemakai'] . "','" . $_SESSION['kontak1'] . "','" . $_SESSION['kontak2'] . "','" . $_SESSION['email'] . "')");

    //$pembeli=mysqli_fetch_array(mysqli_query($koneksi, "select max(id) as id_pembeli from pembeli"));
    $id_pembeli = $_SESSION['pembeli'];
    $pemakai = mysqli_fetch_array(mysqli_query($koneksi, "select max(id) as id_pemakai from pemakai"));
    $id_pemakai = $pemakai['id_pemakai'];
    //simpan barang dijual
    $total = mysqli_num_rows(mysqli_query($koneksi, "select * from barang_dijual_qty_hash where akun_id=" . $_SESSION['id'] . ""));

    $total1 = mysqli_fetch_array(mysqli_query($koneksi, "select sum(qty*harga_satuan) as total1 from barang_gudang,barang_dijual_qty_hash where barang_gudang.id=barang_dijual_qty_hash.barang_gudang_id and akun_id=" . $_SESSION['id'] . ""));

    $simpan1 = mysqli_query($koneksi, "insert into barang_dijual values('','" . $_SESSION['tgl_jual'] . "','" . $_SESSION['no_faktur'] . "','" . $_SESSION['no_kontrak'] . "','$id_pembeli','$id_pemakai','" . $_SESSION['marketing'] . "','" . $_SESSION['subdis'] . "','" . $_SESSION['ongkir'] . "','" . $_SESSION['diskon'] . "','" . $total1['total1'] . "','" . $_SESSION['ppn'] . "','" . $_SESSION['pph'] . "','" . $_SESSION['zakat'] . "','" . $_SESSION['biaya_bank'] . "','" . str_replace(",", ".", str_replace(".", "", $_POST['nominal'])) . "','$_GET[dpp]','1','" . $_SESSION['status_po'] . "')");

    $d1 = mysqli_fetch_array(mysqli_query($koneksi, "select max(id) as id_jual from barang_dijual"));
    $id_jual = $d1['id_jual'];
    //simpan barang pesan detail
    $q2 = mysqli_query($koneksi, "select * from barang_dijual_qty_hash where akun_id=" . $_SESSION['id'] . "");
    while ($d2 = mysqli_fetch_array($q2)) {
      $simpan2 = mysqli_query($koneksi, "insert into barang_dijual_qty values('','$id_jual','" . $d2['barang_gudang_id'] . "','" . $d2['harga_jual_saat_itu'] . "','" . $d2['qty'] . "','" . $d2['okr'] . "','0')");
      //$up=mysqli_query($koneksi, "update barang_gudang_detail set status_terjual=1 where id=".$d2['barang_gudang_detail_id']."");
      //$up2=mysqli_query($koneksi, "update barang_gudang,barang_gudang_detail set stok_total=stok_total-1 where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=".$d2['barang_gudang_detail_id']."");
      if ($simpan2) {
        $q = mysqli_query($koneksi, "select * from barang_dijual_qty_detail_hash where barang_dijual_qty_hash_id = $d2[id]");
        $max = mysqli_fetch_array(mysqli_query($koneksi, "select max(id) as idd from barang_dijual_qty"));
        while ($dd = mysqli_fetch_array($q)) {
          $hrg = mysqli_fetch_array(mysqli_query($koneksi, "select harga_satuan from barang_gudang where id = '$dd[barang_gudang_id]'"));
          mysqli_query($koneksi, "insert into barang_dijual_qty_detail values ('','$max[idd]','$dd[barang_gudang_id]','$hrg[harga_satuan]','$dd[jml_satuan]','$dd[jml_total]')");
        }
      }
    }
    if ($simpan1 and $simpan2) {
      if ($_SESSION['status_po'] == 1) {
        $Result = mysqli_query($koneksi, "insert into utang_piutang values('','Piutang','" . $_SESSION['no_faktur'] . "','" . $_POST['tgl_input'] . "','" . $_POST['jatuh_tempo'] . "','" . str_replace(",", ".", str_replace(".", "", $_POST['nominal'])) . "','" . $_POST['klien'] . "','" . $_POST['deskripsi'] . "','0')");
      } elseif ($_SESSION['status_po'] == 0) {
        $Result = mysqli_query($koneksi, "insert into utang_piutang values('','Piutang','" . $_SESSION['no_faktur'] . "','" . $_POST['tgl_input'] . "','" . $_POST['jatuh_tempo'] . "','0','" . $_POST['klien'] . "','" . $_POST['deskripsi'] . "','0')");
      }
      $q = mysqli_query($koneksi, "select * from barang_dijual_qty_hash where akun_id=" . $_SESSION['id'] . "");
      while ($d = mysqli_fetch_array($q)) {
        mysqli_query($koneksi, "delete from barang_dijual_qty_detail_hash where id=" . $d['id'] . "");
      }
      mysqli_query($koneksi, "delete from barang_dijual_qty_hash where akun_id=" . $_SESSION['id'] . "");
      echo "<script type='text/javascript'>
	          alert('Data Berhasil Di Simpan !');
	          window.location='index.php?page=jual_barang_uang'</script>";
      unset($_SESSION['tgl_jual']);
      unset($_SESSION['pembeli']);
      unset($_SESSION['provinsi']);
      unset($_SESSION['kecamatan']);
      unset($_SESSION['kabupaten']);
      unset($_SESSION['kelurahan']);
      unset($_SESSION['alamat']);
      unset($_SESSION['kontak_rs']);
      unset($_SESSION['pemakai']);
      unset($_SESSION['kontak1']);
      unset($_SESSION['kontak2']);
      unset($_SESSION['email']);
      unset($_SESSION['marketing']);
      unset($_SESSION['subdis']);
      unset($_SESSION['no_faktur']);
      unset($_SESSION['no_kontrak']);
      unset($_SESSION['diskon']);
      unset($_SESSION['ppn']);
      unset($_SESSION['ongkir']);
      unset($_SESSION['pph']);
      unset($_SESSION['status_po']);
    }
  } else {
    echo "<script type='text/javascript'>
	alert('Data tidak boleh kosong , silakan tambahkan terlebih dahulu ! !');
	window.location='index.php?page=simpan_jual_alkes2'</script>";
  }
}

if (isset($_POST['input_diskon'])) {
  echo "<script>window.location='index.php?page=simpan_jual_alkes2'</script>";
}

if (isset($_POST['input_ppn'])) {
  echo "<script>window.location='index.php?page=simpan_jual_alkes2'</script>";
}

if (isset($_POST['input_pph'])) {
  echo "<script>window.location='index.php?page=simpan_jual_alkes2'</script>";
}
?>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Jual Alkes</h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active"> Jual Alkes</li>
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
              <div class="">
                <!--<a href="index.php?page=tambah_barang_masuk"><button name="tambah_laporan" class="btn btn-success" type="submit"><span class="fa fa-plus"></span> Tambah Barang</button></a>-->
                <div class="table-responsive no-padding">
                  <table width="100%" id="" class="table table-responsive">
                    <thead>
                      <tr>
                        <th colspan="10" align="left">
                          <table width="">
                            <tr valign="top">
                              <td><strong>Marketing </strong></td>
                              <td><strong>&nbsp;:&nbsp;</strong></td>
                              <td><strong><?php echo $_SESSION['marketing']; ?></strong></td>
                              <td><strong> &nbsp;&nbsp;,&nbsp;&nbsp; </strong></td>
                              <td><strong>Sub Distributor </strong></td>
                              <td><strong> &nbsp;:&nbsp; </strong></td>
                              <td><strong><?php echo $_SESSION['subdis']; ?></strong></td>
                              <td><strong>
                                  <!--&nbsp;&nbsp;&nbsp;&nbsp; , Diskon : <?php echo $_SESSION['diskon'] . " %"; ?>&nbsp;&nbsp;&nbsp;&nbsp; , PPN : <?php echo $_SESSION['ppn'] . " %"; ?>-->
                                </strong></td>
                            </tr>
                          </table>
                        </th>
                      </tr>
                      <tr>
                        <th colspan="4" valign="bottom">&nbsp;</th>
                        <th valign="bottom">&nbsp;</th>
                        <th valign="bottom">&nbsp;</th>
                        <th valign="bottom">&nbsp;</th>
                        <th valign="bottom">&nbsp;</th>
                        <th valign="bottom">&nbsp;</th>
                        <th valign="bottom">&nbsp;</th>
                      </tr>
                      <tr>
                        <th valign="bottom"><strong>Tgl Jual</strong></th>
                        <th valign="bottom">No PO</th>
                        <th valign="bottom">No. Kontrak</th>
                        <th valign="bottom">Nama RS/Dinas/Klinik/dll</th>
                        <th valign="bottom"><strong>Kelurahan</strong></th>
                        <th valign="bottom">Alamat</th>
                        <th valign="bottom"><strong>Kontak RS/Dinas/dll</strong></th>
                        <th valign="bottom"><strong>Nama Pemakai</strong></th>
                        <th valign="bottom">Kontak Pemakai</th>
                        <th valign="bottom">Email</th>
                      </tr>
                    </thead>
                    <tr>
                      <td><?php echo date("d-m-Y", strtotime($_SESSION['tgl_jual'])); ?>
                      </td>
                      <td><?php echo $_SESSION['no_faktur']; ?></td>
                      <td><?php echo $_SESSION['no_kontrak']; ?></td>
                      <td><?php
                          $sel = mysqli_fetch_array(mysqli_query($koneksi, "select nama_pembeli from pembeli where id=" . $_SESSION['pembeli'] . ""));
                          echo $sel['nama_pembeli']; ?></td>
                      <td><?php echo $_SESSION['kelurahan']; ?></td>
                      <td><?php echo $_SESSION['alamat']; ?></td>
                      <td><?php echo $_SESSION['kontak_rs']; ?></td>
                      <td><?php echo $_SESSION['pemakai']; ?></td>
                      <td><?php echo $_SESSION['kontak1'] . " / " . $_SESSION['kontak2']; ?></td>
                      <td><?php echo $_SESSION['email']; ?></td>
                    </tr>
                  </table>
                </div>
                <br />

                <!--<font color="#FF0000">* Jika Ingin Menambah Data Aksesoris Yang Baru ! Klik Disini <a href="index.php?page=simpan_tambah_aksesoris&id=<?php //echo $_GET['id']; 
                                                                                                                                                          ?>#openAkse"><small data-toggle="tooltip" title="Tambah Aksesoris Baru" class="label bg-blue">+ New Accessories</small></a></font>-->
                <button name="tambah" class="btn btn-success" type="submit" data-toggle="modal" data-target="#modal-tambah" onclick="getNamaBarang();"><span class="fa fa-plus"></span> Tambah</button>
                <button class="btn btn-info pull pull-right" data-toggle="modal" data-target="#modal-ubah-harga"><i class="fa fa-edit"></i> Perubahan Harga Jual</button>
                <br />
                <div class="table-responsive no-padding" style="margin-top: 15px; margin-bottom: 15px;">
                  <div id="tabel_jual"></div>
                </div>
                <center><!--<a href="index.php?page=simpan_jual_alkes2&simpan_barang=1"><button name="simpan_barang" class="btn btn-success" type="submit"><span class="fa fa-plus"></span> Simpan</button></a>--><a href="#" data-toggle="modal" data-target="#modal-piutang"><button name="simpa" class="btn btn-success" type="submit"><span class="fa fa-plus"></span> Simpan</button></a>&nbsp;&nbsp;<a href="index.php?page=jual_barang_uang"><button name="batal" class="btn btn-success" type="button"><span class="fa  fa-times-circle"></span> Batal</button></a></center>
              </div>
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
<?php
if (isset($_POST['tambah_laporan'])) {
  $Result = mysqli_query($koneksi, "insert into aksesoris values('','" . $_POST['nama_akse'] . "','" . $_POST['merk'] . "','" . $_POST['tipe'] . "','" . $_POST['no_seri'] . "','" . $_POST['stok'] . "', '" . $_POST['deskripsi'] . "','" . $_POST['harga_satuan'] . "')");
  if ($Result) {
    echo "<script type='text/javascript'>
		alert('Data Berhasil Di Tambah !');
		window.location='index.php?page=simpan_tambah_aksesoris&id=$_GET[id]';
		</script>";
  }
}
?>

<div class="modal fade" id="modal-piutang">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <script type="text/javascript">
          function yesnoCheck() {
            if (document.getElementById('yesCheck').checked) {
              document.getElementById('ifYes').style.display = 'block';
            } else document.getElementById('ifYes').style.display = 'none';
          }
        </script>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Masukkan Piutang Baru</h4>
      </div>
      <form method="post" enctype="multipart/form-data">
        <div class="modal-body">
          <label>No PO</label>
          <input name="no_faktur" class="form-control" type="text" placeholder="" disabled="disabled" value="<?php echo $_SESSION['no_faktur']; ?>"><br />
          <label>Tanggal</label>
          <input name="tgl_input" class="form-control" type="date" placeholder="" required="required" value="<?php echo $_SESSION['tgl_jual']; ?>"><br />
          <input type="radio" onclick="javascript:yesnoCheck();" name="yesno" id="noCheck" style="height:20px; width:20px" checked="checked"><label>Tidak Ada Jatuh Tempo</label><br /><input type="radio" onclick="javascript:yesnoCheck();" name="yesno" id="yesCheck" style="height:20px; width:20px"><label>Jatuh Tempo</label>
          <br />
          <div id="ifYes" style="display:none">
            <label>Tanggal Jatuh Tempo</label>
            <input name="jatuh_tempo" type="date" class="form-control" placeholder="" value=""><br />
          </div>

          <label>Nominal <font color="#FF0000">(*Akan bernilai 0 Jika Status PO Belum Deal)</font></label>
          <!-- <input name="nominal" class="form-control" type="text" id="nominal" placeholder="" value="<?php //if ($_SESSION['status_po'] == 1) {
                                                                                                          //echo number_format($total2, 0, ',', '.');
                                                                                                          // } else {
                                                                                                          // echo "0";
                                                                                                          // }; 
                                                                                                          ?>" required="required" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);"><br /> -->
          <input name="nominal" class="form-control" type="text" id="nominall" placeholder="" required="required" readonly><br />
          <label>Klien</label>
          <input name="klien" class="form-control" type="text" placeholder="" value="<?php echo $sel['nama_pembeli'];  ?>" required="required"><br />
          <label>Deskripsi</label>
          <textarea name="deskripsi" class="form-control" rows="4"></textarea>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
          <button name="tambah_header" class="btn btn-success" type="submit"><span class="fa fa-check"></span> Simpan</button>
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="modal-detail-set">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" align="center"><strong>Detail Rincian Barang Dalam 1 Set</strong></h4>
      </div>
      <div class="modal-body">
        <div class="text-right" id="jumlah_set"></div>
        <div id="data-detail-set"></div>
      </div>

      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button> -->
        <button name="simpan_tambah_aksesoris" class="btn btn-success" data-dismiss="modal"><span class="fa fa-check"></span> OK</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="modal-detail-satuan">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" align="center"><strong>Detail Rincian Aksesoris Barang Per Satuan</strong></h4>
      </div>
      <div class="modal-body">
        <div class="text-right" id="jumlah_satuan"></div>
        <div id="data-detail-satuan"></div>
      </div>

      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button> -->
        <button name="simpan_tambah_aksesoris" class="btn btn-success" data-dismiss="modal"><span class="fa fa-check"></span> OK</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="modal-tambah">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" align="center"><strong>Tambah Data</strong></h4>
      </div>
      <form method="post" id="form-tambah" enctype="multipart/form-data" onsubmit="simpanBarang(); return false;">
        <div class="modal-body">
          <label>Nama Barang</label>
          <div id="nama_barang"></div>
          <label>Qty</label>
          <input id="qty_jual" name="qty" class="form-control" type="number" placeholder="" size="2" />
          <br />
          <label>Ongkir</label>
          <input id="ongkir_jual" name="ongkirr" class="form-control" type="text" placeholder="" size="2" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);" />
          <br />
          <label>Total</label>
          <input id="" name="total" class="form-control" type="text" placeholder="" size="" value="Auto" disabled="disabled" />
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
          <button name="simpan_tambah_aksesoris" class="btn btn-success" type="submit"><span class="fa fa-plus"></span> Tambah</button>
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="modal-ubah-harga">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Ubah Harga Barang</h4>
      </div>
      <form method="post" enctype="multipart/form-data" onsubmit="ubahHargaBarang(); return false;">
        <div class="modal-body">
          <label>Nama Barang</label>
          <select name="barang_id" id="barang_id" class="form-control select2" autofocus="autofocus" required onchange="ubahHarga(this.value)" style="width:100%">
            <option value="">...</option>
            <?php
            $qq22 = mysqli_query($koneksi, "select id, nama_brg, tipe_brg, harga_satuan from barang_gudang order by nama_brg ASC");
            $jsArray5 = "var dtBrg5 = new Array();
            ";
            while ($d = mysqli_fetch_array($qq22)) { ?>
              <option value="<?php echo $d['id']; ?>"><?php echo $d['nama_brg'] . " - " . $d['tipe_brg']; ?></option>
            <?php
              // $stok_po1 = mysqli_fetch_array(mysqli_query($koneksi, "select sum(qty_jual) as stok_po from barang_dijual_qty where barang_gudang_id=" . $d['id'] . ""));
              // $stok_po2 = mysqli_num_rows(mysqli_query($koneksi, "select COUNT(*) as jml from barang_dikirim_detail,barang_gudang_detail,barang_dijual_qty where barang_gudang_detail.id=barang_dikirim_detail.barang_gudang_detail_id and barang_dijual_qty.id=barang_dikirim_detail.barang_dijual_qty_id and barang_dijual_qty.barang_gudang_id=" . $d['id'] . ""));

              $jsArray5 .= "dtBrg5['" . $d['id'] . "'] = {harga:'" . addslashes(number_format($d['harga_satuan'], 0, ',', '.')) . "'
						};";
            } ?>
          </select>
          <br /><br />
          <label>Harga Barang</label>
          <input id="harga_brg" name="nominal" class="form-control" type="text" placeholder="" value="" required="required" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);"><br />

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
          <button name="ubah_harga" class="btn btn-info" type="submit"><span class="fa fa-check"></span> Simpan Perubahan</button>
        </div>
      </form>
      <script type="text/javascript">
        <?php
        echo $jsArray5;
        ?>

        function ubahHarga(barang_id) {
          document.getElementById('harga_brg').value = dtBrg5[barang_id].harga;
        };
      </script>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="modal-ongkir1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Nilai Ongkir, Diskon, PPN, PPh, Lain-lain</h4>
      </div>
      <form method="post" enctype="multipart/form-data" onsubmit="simpanLainnya(); return false;">
        <div class="modal-body">
          <label>Ongkir</label>
          <input id="ongkir" name="ongkir" class="form-control" type="text" placeholder="" value="<?php if (isset($_SESSION['ongkir'])) {
                                                                                                    echo number_format($_SESSION['ongkir'], 0, ',', '.');
                                                                                                  } ?>" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);">
          <br />
          <label>Diskon (%)</label>
          <input id="diskon" name="diskon" class="form-control" type="text" placeholder="Gunakan Tanda '.' Untuk Koma" value="<?php if (isset($_SESSION['diskon'])) {
                                                                                                                                echo $_SESSION['diskon'];
                                                                                                                              } ?>">
          <br />
          <label>PPN (%)</label>
          <input id="ppn" name="ppn" class="form-control" type="text" placeholder="Gunakan Tanda '.' Untuk Koma" value="<?php if (isset($_SESSION['ppn'])) {
                                                                                                                          echo $_SESSION['ppn'];
                                                                                                                        } ?>" <?php echo $focus_ppn; ?>>
          <br />
          <label>PPh (%)</label>
          <input id="pph" name="pph" class="form-control" type="text" placeholder="Gunakan Tanda '.' Untuk Koma" value="<?php if (isset($_SESSION['pph'])) {
                                                                                                                          echo $_SESSION['pph'];
                                                                                                                        } ?>" <?php echo $focus_pph; ?>>
          <br />
          <label>Zakat (%)</label>
          <input id="zakat" name="zakat" class="form-control" type="text" placeholder="Gunakan Tanda '.' Untuk Koma" value="<?php if (isset($_SESSION['zakat'])) {
                                                                                                                              echo $_SESSION['zakat'];
                                                                                                                            } ?>">
          <br />
          <label>Biaya Bank</label>
          <input id="biaya_bank" name="biaya_bank" class="form-control" type="text" placeholder="" value="<?php if (isset($_SESSION['biaya_bank'])) {
                                                                                                            echo number_format($_SESSION['biaya_bank'], 0, ',', '.');
                                                                                                          } ?>" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);" <?php echo $focus_biaya_bank; ?>>
          <br />
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
          <button name="input_ongkir" class="btn btn-info" type="submit"><span class="fa fa-check"></span>Simpan</button>
        </div>
      </form>

    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="modal-ongkir11">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Nilai Diskon, PPN</h4>
      </div>
      <form method="post" enctype="multipart/form-data" onsubmit="simpanLainnya2(); return false;">
        <div class="modal-body">
          <label>Ongkir</label>
          <input id="ongkir2" name="ongkir2" class="form-control" type="text" placeholder="" value="<?php if (isset($_SESSION['ongkir'])) {
                                                                                                      echo number_format($_SESSION['ongkir'], 0, ',', '.');
                                                                                                    } ?>" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);">
          <br />
          <label>Diskon (%)</label>
          <input id="diskon2" name="diskon2" class="form-control" type="text" placeholder="Gunakan Tanda '.' Untuk Koma" value="<?php if (isset($_SESSION['diskon'])) {
                                                                                                                                  echo $_SESSION['diskon'];
                                                                                                                                } ?>">
          <br />
          <label>PPN (%)</label>
          <input id="ppn2" name="ppn2" class="form-control" type="text" placeholder="Gunakan Tanda '.' Untuk Koma" value="<?php if (isset($_SESSION['ppn'])) {
                                                                                                                            echo $_SESSION['ppn'];
                                                                                                                          } ?>" <?php echo $focus_ppn; ?>>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
          <button name="input_ongkir" class="btn btn-info" type="submit"><span class="fa fa-check"></span>Simpan</button>
        </div>
      </form>

    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="modal-ubah">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" align="center"><strong>Ubah Kuantitas & Harga Barang Yang Dijual</strong></h4>
      </div>
      <form method="post" enctype="multipart/form-data" onsubmit="ubahBarang(); return false;">
        <div class="modal-body">
          <input id="id_ubah" type="hidden" />
          <label>Qty</label>
          <input id="qty_ubah" name="qty" class="form-control" type="number" placeholder="" size="2" />
          <br>
          <label>Harga Jual</label>
          <input id="harga_ubah" name="harga" class="form-control" type="text" placeholder="" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
          <button name="simpann" class="btn btn-success" type="submit"><span class="fa fa-check"></span> Ubah</button>
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<script>
  function openDetail(id, kategori, jml_set) {
    if (kategori == 'Set') {
      $.get("data/data_detail_set.php", {
          id: id
        },
        function(data) {
          $('#data-detail-set').html(data);
          $('#jumlah_set').html('<font style="font-size:18px;">Jumlah : ' + jml_set + ' Set</font>');
          $('#modal-detail-set').modal('show');
        }
      );
    } else {
      $.get("data/data_detail_satuan.php", {
          id: id
        },
        function(data) {
          $('#data-detail-satuan').html(data);
          $('#jumlah_satuan').html('<font style="font-size:18px;">Jumlah : ' + jml_set + '</font>');
          $('#modal-detail-satuan').modal('show');
        }
      );
    }
  }

  function ubahData(id, qty, harga) {
    $('#id_ubah').val(id);
    $('#qty_ubah').val(qty);
    $('#harga_ubah').val(harga);
    $('#modal-ubah').modal('show');
  }

  function ubahBarang() {
    $.post("data/ubah_barang_jual.php", {
        id: $('#id_ubah').val(),
        qty: $('#qty_ubah').val(),
        harga: $('#harga_ubah').val(),
        ongkir: getVars("dpp") == 1 ? $('#ongkir').val() : $('#ongkir2').val(),
        diskon: getVars("dpp") == 1 ? $('#diskon').val() : $('#diskon2').val(),
        ppn: getVars("dpp") == 1 ? $('#ppn').val() : $('#ppn2').val(),
        pph: getVars("dpp") == 1 ? $('#pph').val() : 0,
        zakat: getVars("dpp") == 1 ? $('#zakat').val() : 0,
        biaya_bank: getVars("dpp") == 1 ? $('#biaya_bank').val() : 0,
      },
      function(data) {
        // alert(data);
        if (data == 'S') {
          addRiwayat('UPDATE', 'barang_dijual_qty', $('#id_ubah').val(), 'Mengubah Rincian Barang (ID_QTY : ' + id + ')')
          $('#modal-ubah').modal('hide');
          alertSimpan('S');
          // loading_jual();
          getDataBarang();
        } else {
          alertSimpan('F');
          // loading_jual();
          getDataBarang();
        }
      }
    );
  }

  function hapus(id) {
    Swal.fire({
      customClass: {
        confirmButton: 'bg-red',
        cancelButton: 'bg-white',
      },
      title: 'Anda Yakin Akan Menghapus Item Ini ?',
      text: 'Data Akan Dihapus Secara Permanen',
      icon: 'question',
      showCancelButton: true,
      confirmButtonText: 'Ya , Hapus',
      cancelButtonText: 'Batal',
    }).then((result) => {
      if (result.isConfirmed) {
        $.post("data/hapus_barang_jual.php", {
            id_hapus: id,
            ongkir: getVars("dpp") == 1 ? $('#ongkir').val() : $('#ongkir2').val(),
            diskon: getVars("dpp") == 1 ? $('#diskon').val() : $('#diskon2').val(),
            ppn: getVars("dpp") == 1 ? $('#ppn').val() : $('#ppn2').val(),
            pph: getVars("dpp") == 1 ? $('#pph').val() : 0,
            zakat: getVars("dpp") == 1 ? $('#zakat').val() : 0,
            biaya_bank: getVars("dpp") == 1 ? $('#biaya_bank').val() : 0,
          },
          function(data) {
            if (data == 'S') {
              addRiwayat('DELETE', 'barang_dijual_qty', id, 'Menghapus Rincian Barang (ID_QTY : ' + id + ')')
              Swal.fire({
                customClass: {
                  confirmButton: 'bg-green',
                  cancelButton: 'bg-white',
                },
                title: 'Berhasil Dihapus',
                icon: 'success',
                confirmButtonText: 'OK',
              })
              // loading_jual();
              getDataBarang();
            } else {
              Swal.fire({
                customClass: {
                  confirmButton: 'bg-red',
                  cancelButton: 'bg-white',
                },
                title: 'Gagal Dihapus',
                icon: 'error',
                confirmButtonText: 'OK',
              })
            }
          }
        );
        // window.location.href = '?page=' + getVars("page").replace('#', '') + '&id_hapus=' + id;
      }
    })
  }

  function getNamaBarang() {
    $('#nama_barang').html('<center><div class="overlay"><i class="fa fa-refresh fa-spin"></i></div></center>');
    $.get("data/get_nama_barang_uang.php",
      function(data) {
        $('#nama_barang').html(data);
      }
    );
  }

  function loading_jual() {
    $('#tabel_jual').html('<center><div class="overlay"><i class="fa fa-refresh fa-spin"></i></div></center>');
  }

  function getDataBarang() {
    let dpp = getVars('dpp');
    let url = '';
    if (dpp == 1) {
      url = "data/tabel_jual.php";
    } else {
      url = "data/tabel_jual_no_dpp.php";
    }
    $.get(url, {
        ongkir: getVars("dpp") == 1 ? $('#ongkir').val() : $('#ongkir2').val(),
        diskon: getVars("dpp") == 1 ? $('#diskon').val() : $('#diskon2').val(),
        ppn: getVars("dpp") == 1 ? $('#ppn').val() : $('#ppn2').val(),
        pph: getVars("dpp") == 1 ? $('#pph').val() : 0,
        zakat: getVars("dpp") == 1 ? $('#zakat').val() : 0,
        biaya_bank: getVars("dpp") == 1 ? $('#biaya_bank').val() : 0,
      },
      function(data) {
        $('#tabel_jual').html(data);
      }
    );
  }

  function ubahHargaBarang() {
    var id_brg = $('#barang_id').val();
    var nominal = $('#harga_brg').val();

    $.post("data/ubah_harga_barang.php", {
        id_brg: id_brg,
        nominal: nominal
      },
      function(data) {
        if (data == 'S') {
          addRiwayat('UPDATE', 'barang_gudang', id_brg, 'Mengubah Harga Barang (ID_BRG : ' + id_brg + ')')
          $('#modal-ubah-harga').modal('hide');
          Swal.fire({
            customClass: {
              confirmButton: 'bg-green',
              cancelButton: 'bg-white',
            },
            title: 'Berhasil Disimpan',
            icon: 'success',
            confirmButtonText: 'OK',
          })
        } else {
          $('#modal-ubah-harga').modal('hide');
          Swal.fire({
            customClass: {
              confirmButton: 'bg-red',
              cancelButton: 'bg-white',
            },
            title: 'Gagal Disimpan',
            icon: 'error',
            confirmButtonText: 'OK',
          })
        }
      }
    );
  }

  function simpanBarang() {
    var no_include = $('#no_include').prop('checked');
    let nie_brg = $('#nie_brg').val();
    if ((nie_brg.replace(/\s+/g, '')) === '-' || nie_brg === '') {
      alertCustom('E', 'NIE Wajib Terisi', 'Mohon jangan gunakan tanda "-"');
    } else {
      $.post("data/simpan_barang_jual.php", {
          id_akse: $('#id_akse').val(),
          nie_brg: $('#nie_brg').val(),
          qty: $('#qty_jual').val(),
          ongkirr: $('#ongkir_jual').val(),
          inc: no_include == true ? '0' : '1',
          ongkir: getVars("dpp") == 1 ? $('#ongkir').val() : $('#ongkir2').val(),
          diskon: getVars("dpp") == 1 ? $('#diskon').val() : $('#diskon2').val(),
          ppn: getVars("dpp") == 1 ? $('#ppn').val() : $('#ppn2').val(),
          pph: getVars("dpp") == 1 ? $('#pph').val() : 0,
          zakat: getVars("dpp") == 1 ? $('#zakat').val() : 0,
          biaya_bank: getVars("dpp") == 1 ? $('#biaya_bank').val() : 0,
        },
        function(data) {
          // alert(data);
          if (data == 'S') {
            addRiwayat('INSERT', 'barang_dijual_qty', $('#id_akse').val(), 'Menambah Rincian Barang (ID_PO : ' + $('#id_akse').val() + ')')
            $('#form-tambah').trigger('reset');
            $('#modal-tambah').modal('hide');
            Swal.fire({
              customClass: {
                confirmButton: 'bg-green',
                cancelButton: 'bg-white',
              },
              title: 'Berhasil Disimpan',
              icon: 'success',
              confirmButtonText: 'OK',
            });
            // loading_jual();
            getDataBarang();
          } else if (data == 'SAMA') {
            $('#modal-tambah').modal('hide');
            Swal.fire({
              customClass: {
                confirmButton: 'bg-yellow',
                cancelButton: 'bg-white',
              },
              title: 'Harga Jual Alat Tidak Boleh Kosong !',
              icon: 'warning',
              confirmButtonText: 'OK',
            })
            // loading_jual();
            getDataBarang();
          } else if (data == 'SA') {
            $('#modal-tambah').modal('hide');
            Swal.fire({
              customClass: {
                confirmButton: 'bg-red',
                cancelButton: 'bg-white',
              },
              title: 'Barang Sudah Ada !',
              icon: 'error',
              confirmButtonText: 'OK',
            });
            // loading_jual();
            getDataBarang();
          } else {
            $('#modal-tambah').modal('hide');
            Swal.fire({
              customClass: {
                confirmButton: 'bg-red',
                cancelButton: 'bg-white',
              },
              title: 'Gagal Disimpan',
              icon: 'error',
              confirmButtonText: 'OK',
            })
            // loading_jual();
            getDataBarang();
          }
        }
      );
    }
  }

  function simpanLainnya() {
    $.post("data/simpan_barang_jual_lainnya.php", {
        ongkir: $('#ongkir').val(),
        diskon: $('#diskon').val(),
        ppn: $('#ppn').val(),
        pph: $('#pph').val(),
        zakat: $('#zakat').val(),
        biaya_bank: $('#biaya_bank').val(),
      },
      function() {
        $('#modal-ongkir1').modal('hide');
        // loading_jual();
        getDataBarang();
      }
    );
  }

  function simpanLainnya2() {
    $.post("data/simpan_barang_jual_lainnya.php", {
        ongkir: $('#ongkir2').val(),
        diskon: $('#diskon2').val(),
        ppn: $('#ppn2').val(),
        pph: 0,
        zakat: 0,
        biaya_bank: 0,
      },
      function() {
        $('#modal-ongkir11').modal('hide');
        // loading_jual();
        getDataBarang();
      }
    );
  }

  function cekInclude() {
    if ($('#kategori_brg').val() == 'Satuan') {
      $('#include-aksesoris').show();
    } else {
      $('#include-aksesoris').hide();
    }
  }

  $(document).ready(function() {
    // getNamaBarang();
    loading_jual();
    getDataBarang();
  });
</script>