<?php
$query = mysqli_query($koneksi, "select *,principle.id as id_principle, barang_pesan_inventory.id as idd from barang_pesan_inventory,principle,mata_uang where principle.id=barang_pesan_inventory.principle_id and mata_uang.id=barang_pesan_inventory.mata_uang_id and barang_pesan_inventory.id='" . $_GET['id'] . "'");
$data = mysqli_fetch_array($query);

if (isset($_POST['batal'])) {
  $up = mysqli_query($koneksi, "update barang_pesan_inventory set status_po_batal=1,deskripsi_batal='" . $_POST['deskripsi'] . "' where id=" . $_POST['id_batal'] . "");
  if ($up) {
    echo "<script>
      Swal.fire({
        customClass: {
          confirmButton: 'bg-green',
          cancelButton: 'bg-white',
        },
        title: 'PO Berhasil Dibatalkan ',
        icon: 'success',
        confirmButtonText: 'OK',
      }).then((result) => {
        window.location.href = '?page=pembelian_inventory2';
      })
      </script>";
  } else {
    echo "<script>
      Swal.fire({
        customClass: {
          confirmButton: 'bg-red',
          cancelButton: 'bg-white',
        },
        title: 'PO Gagal Dibatalkan ',
        icon: 'error',
        confirmButtonText: 'OK',
      }).then((result) => {
        window.location.href = '?page=pembelian_inventory2';
      })
      </script>";
  }
}

if (isset($_GET['id_hapus'])) {
  mysqli_query($koneksi, "delete from barang_pesan_detail where id=" . $_GET['id_hapus'] . "");
}

if (isset($_POST['simpan_perubahan'])) {
  $ppn = $_POST['ppn'] / 100;
  //$up_uang = mysqli_query($koneksi, "update utang_piutang set no_faktur_no_po='".$_POST['no_po']."' where no_faktur_no_po='".$data['no_po_pesan']."'");
  $Result = mysqli_query($koneksi, "update barang_pesan_inventory set tgl_po_pesan='" . $_POST['tgl_po'] . "',no_po_pesan='" . $_POST['no_po'] . "',ppn='" . $_POST['ppn'] . "',cara_pembayaran='" . $_POST['cara_pembayaran'] . "',mata_uang_id='" . $_POST['mata_uang'] . "',alamat_pengiriman='" . str_replace("\n", "<br>", $_POST['alamat_pengiriman']) . "',jalur_pengiriman='" . $_POST['jalur_pengiriman'] . "',estimasi_pengiriman='" . $_POST['estimasi_pengiriman'] . "', catatan='" . $_POST['catatan'] . "' where id=" . $_GET['id'] . "");
  if ($Result) {
    mysqli_query($koneksi, "update barang_pesan_inventory_detail set mata_uang_id=" . $_POST['mata_uang'] . " where barang_pesan_inventory_id=" . $_GET['id'] . "");
    echo "<script>
      Swal.fire({
        customClass: {
          confirmButton: 'bg-green',
          cancelButton: 'bg-white',
        },
        title: 'Data Berhasil Diubah',
        icon: 'success',
        confirmButtonText: 'OK',
      }).then(() => {
        window.location.href = '?page=pembelian_inventory2';
      })
      </script>";
    
  }
}


?>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Ubah Pemesanan Barang Inventory</h1>
    <ol class="breadcrumb">
      <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active"><a href="index.php?page=barang_masuk">Pemesanan</a></li>
      <li class="active">Ubah Pemesanan</li>
    </ol>
  </section>


  <!-- Main content -->
  <section class="content">
    <!-- Small boxes (Stat box) -->
    <!-- /.row -->
    <!-- Main row -->
    <div class="row">
      <!-- Left col -->


      <section class="col-lg-12 connectedSortable">
        <!-- Custom tabs (Charts with tabs)-->
        <!-- /.nav-tabs-custom -->

        <!-- Chat box -->
        <div class="box box-success">
          <!-- /.chat -->
          <div class="box-footer">
            <div class="box-header with-border">
              <h3 class="box-title">Detail Barang</h3>
            </div>
            <div class="box-body">
              <a href="index.php?page=tambah_po_inventory2&id=<?php echo $_GET['id']; ?>">
                <button class="btn btn-success"><span class="fa fa-edit"></span> &nbsp;Kelola</button>
              </a>
              <?php
              $cek_uang = mysqli_num_rows(mysqli_query($koneksi, "select * from barang_pesan_inventory,utang_piutang_inventory,utang_piutang_inventory_bayar where barang_pesan_inventory.no_po_pesan=utang_piutang_inventory.no_faktur_no_po_inven and utang_piutang_inventory.id=utang_piutang_inventory_bayar.utang_piutang_inventory_id and no_po_pesan='" . $data['no_po_pesan'] . "'"));
              $j_cek = mysqli_num_rows(mysqli_query($koneksi, "select * from barang_pesan_inventory_detail,barang_inventory where barang_inventory.id=barang_pesan_inventory_detail.barang_inventory_id and barang_pesan_inventory_detail.barang_pesan_inventory_id=" . $data['idd'] . " and status_ke_stok=1"));
              if ($cek_uang == 0 and $j_cek == 0) { ?>
                <!-- <a href="index.php?page=pembelian_inventory&id=<?php echo $json[$i]['idd']; ?>#openBatal"> -->
                <a href="#" data-toggle="modal" data-target="#modal-batalpo"><button data-toggle="" title="Batalkan PO" class="btn btn-danger"><i class="fa fa-close"></i> Batalkan PO</button></a>
              <?php } ?>
              <strong class="pull pull-right">
                <table>
                  <tr>
                    <td align="left"><strong>Total Price</strong></td>
                    <td align="center">&nbsp;&nbsp;:&nbsp;</td>
                    <td><?php echo "<font style='font-size:20px'>" . $data['simbol'] . " <span class='pull pull-right'>" . number_format($data['total_price'], 0, ',', ',') . ".00" . "</span></font>"; ?></td>
                  </tr>
                  <tr>
                    <td align="left"><strong>PPn</strong></td>
                    <td align="center">:</td>
                    <td><?php echo "<font style='font-size:20px'>" . $data['simbol'] . " <span class='pull pull-right'>" . number_format($data['total_price'] * $data['ppn'] / 100, 0, ',', ',') . ".00" . "</span></font>"; ?></td>
                  </tr>
                  <tr>
                    <td align="left"><strong>Freight Cost</strong></td>
                    <td align="center">:</td>
                    <td><?php echo "<font style='font-size:20px'>" . $data['simbol'] . " <span class='pull pull-right'>" . number_format($data['cost_byair'], 0, ',', ',') . ".00" . "</span></font>"; ?></td>
                  </tr>
                  <tr>
                    <td align="left"><strong>Total Cost</strong></td>
                    <td align="center">:</td>
                    <td><?php echo "<font style='font-size:20px'>" . $data['simbol'] . " <span class='pull pull-right'>" . number_format($data['cost_cf'], 0, ',', ',') . ".00" . "</span></font>"; ?></td>
                  </tr>
                </table>
              </strong><br /><br /><br /><br /><br /><br />
              <table width="100%" id="example1" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th><strong>Nama Barang</strong></th>
                    <th><strong>Qty</strong></th>
                    <th><strong>Harga Satuan</strong></th>
                    <th>Diskon</th>
                    <th><strong>Total</strong></th>
                    <!--<th>Aksi</th>
    <!--<th>#</th>-->
                  </tr>
                </thead>
                <?php
                $q = mysqli_query($koneksi, "select *,barang_pesan_inventory_detail.id as idd from barang_pesan_inventory_detail,barang_pesan_inventory,mata_uang,barang_inventory where barang_pesan_inventory.id=barang_pesan_inventory_detail.barang_pesan_inventory_id and mata_uang.id=barang_pesan_inventory_detail.mata_uang_id and barang_inventory.id=barang_pesan_inventory_detail.barang_inventory_id and barang_pesan_inventory.id=" . $_GET['id'] . "");
                $no = 0;
                while ($d = mysqli_fetch_array($q)) {
                  $no++;
                ?>
                  <tr>
                    <td><?php echo $d['nama_brg']; ?></td>
                    <td><?php echo $d['qty']; ?></td>
                    <td><?php echo $d['simbol'] . " " . number_format($d['harga_perunit'], 0, ',', ',') . ".00"; ?></td>
                    <td><?php echo $d['diskon'] . " %"; ?></td>
                    <td><?php echo $d['simbol'] . " " . number_format($d['harga_total'], 0, ',', ',') . ".00"; ?></td>
                    <!--<td><a href="index.php?page=ubah_pembelian_alkes&id_hapus=<?php echo $d['idd']; ?>&id=<?php echo $_GET['id']; ?>" onclick="return confirm('Anda Yakin Akan Menghapus Item Ini ?')"><span data-toggle="tooltip" title="Hapus" class="ion-android-delete"></span></a>&nbsp;&nbsp;&nbsp;<a href="index.php?page=ubah_po_alkes&id_ubah=<?php echo $d['idd']; ?>&id=<?php echo $_GET['id']; ?>"><span data-toggle="tooltip" title="Ubah" class="fa fa-edit"></span></a></td>
    <!--
    <td>
    <?php if ($d['status_ke_stok'] == 0) { ?>
    <a href="index.php?page=simpan_tambah_ke_stok&id_pesan=<?php echo $_GET['id']; ?>&id=<?php echo $d['barang_gudang_id']; ?>&id_detail=<?php echo $d['idd']; ?>&stok=<?php echo $d['qty']; ?>"><small data-toggle="tooltip" title="Tambah Ke Stok" class="label bg-green"><span class="fa fa-share"></span> Stok</small></a>
    <?php } else {
                    echo "Sudah Masuk Stok";
                  } ?>
    </td>
    -->
                  </tr>
                <?php } ?>
              </table>
            </div>
          </div>
        </div>
        <!-- /.box (chat box) -->

        <!-- TO DO List -->
        <!-- /.box -->

        <!-- quick email widget -->
      </section>
      <section class="col-lg-6 connectedSortable">
        <!-- Custom tabs (Charts with tabs)-->
        <!-- /.nav-tabs-custom -->

        <!-- Chat box -->
        <div class="box box-success">
          <!-- /.chat -->
          <div class="box-footer">
            <div class="box-header with-border">
              <h3 class="box-title">Ubah Detail Pesanan</h3>
            </div>
            <div class="box-body">
              <form method="post">
                <label>Tgl PO</label>
                <input name="tgl_po" class="form-control" placeholder="Nama Barang" type="date" value="<?php echo $data['tgl_po_pesan']; ?>"><br />
                <label>No PO </label><input name="no_po" class="form-control" placeholder="No PO" type="text" value="<?php echo $data['no_po_pesan']; ?>"><br />

                <label>PPN</label>
                <input name="ppn" class="form-control" type="text" placeholder="PPN (Example :10%)" value="<?php echo $data['ppn'] . " %"; ?>"><br />

                <label>Cara Pembayaran</label><input name="cara_pembayaran" class="form-control" type="text" placeholder="Cara Pembayaran" value="<?php echo $data['cara_pembayaran']; ?>"><br />
                <label>Mata Uang</label>
                <select class="form-control" name="mata_uang">
                  <?php
                  $q_uang = mysqli_query($koneksi, "select * from mata_uang order by id ASC");
                  while ($d_mu = mysqli_fetch_array($q_uang)) {
                  ?>
                    <option value="<?php echo $d_mu['id']; ?>" <?php if ($d_mu['id'] == $data['mata_uang_id']) {
                                                                  echo "selected";
                                                                } ?>><?php echo $d_mu['jenis_mu']; ?></option>
                  <?php } ?>
                </select><br />
                <label>Alamat Pengiriman</label>
                <textarea name="alamat_pengiriman" class="form-control" placeholder="Alamat Pengiriman" rows="8">
<?php echo str_replace("<br>", "\n", $data['alamat_pengiriman']); ?>
              </textarea><br />
                <label>Jalur Pengiriman</label>
                <input name="jalur_pengiriman" class="form-control" placeholder="Jalur Pengiriman" type="text" value="<?php echo $data['jalur_pengiriman']; ?>"><br />
                <label>Estimasi Pengiriman</label>
                <input name="estimasi_pengiriman" class="form-control" placeholder="Estimasi Pengiriman" type="date" value="<?php echo $data['estimasi_pengiriman']; ?>"><br />
                <label>Catatan</label>
                <textarea name="catatan" class="form-control" placeholder="Note" rows="4"><?php echo $data['catatan']; ?></textarea><br />
                <?php if (isset($_SESSION['user_administrator']) or isset($_SESSION['adminpodalam'])) { ?>
                  <button name="simpan_perubahan" class="btn btn-success" type="submit"><span class="fa fa-edit"></span> Simpan Perubahan</button>
                <?php } ?>
                <br /><br />
              </form>
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
      <section class="col-lg-6 connectedSortable">
        <!-- Custom tabs (Charts with tabs)-->
        <!-- /.nav-tabs-custom -->

        <!-- Chat box -->
        <div class="box box-success">
          <!-- /.chat -->
          <div class="box-footer">
            <div class="box-header with-border">
              <h3 class="box-title">Ubah Principle</h3>
            </div>
            <div class="box-body">
              <label>Nama Principle</label><input name="" type="text" disabled="disabled" class="form-control" placeholder="Nama Principle" value="<?php echo $data['nama_principle']; ?>"><br />

              <label>Alamat Principle</label>
              <textarea name="" rows="6" disabled="disabled" class="form-control" placeholder=""><?php echo str_replace("<br>", "\n", $data['alamat_principle']); ?></textarea><br />

              <label>Telp. Principle</label>
              <input name="" type="text" disabled="disabled" class="form-control" placeholder="PPN (Example :10%)" value="<?php echo $data['telp_principle']; ?>"><br />

              Fax. Principle
              <label></label><input name="" type="text" disabled="disabled" class="form-control" placeholder="Cara Pembayaran" value="<?php echo $data['fax_principle']; ?>"><br />
              Attn
              <input name="" type="text" disabled="disabled" class="form-control" placeholder="Jalur Pengiriman" value="<?php echo $data['attn_principle']; ?>"><br />
              <?php if (isset($_SESSION['user_administrator']) or isset($_SESSION['adminpodalam'])) { ?>
                <a href="index.php?page=ubah_pembelian_inventory2&id=<?php echo $_GET['id']; ?>#openBaru"><button name="ubah_baru" class="btn btn-success" type="submit"><span class="fa fa-edit"></span> Ubah Dengan Data Yang Baru</button></a>
                <a href="index.php?page=ubah_pembelian_inventory2&id=<?php echo $_GET['id']; ?>#openSudahAda"><button name="ubah_sudah_ada" class="btn btn-success pull pull-right" type="submit"><span class="fa fa-edit"></span> Ubah Dengan Data Yang Sudah Ada</button></a>
              <?php } ?>
              <br /><br />

            </div>
          </div>
        </div>
        <!-- /.box (chat box) -->

        <!-- TO DO List -->
        <!-- /.box -->

        <!-- quick email widget -->
      </section>
      <!-- right col -->
    </div>
    <!-- /.row (main row) -->

  </section>
  <!-- /.content -->
</div>
<?php
$d_1 = mysqli_fetch_array(mysqli_query($koneksi, "select * from barang_gudang_detail,barang_gudang_po where barang_gudang_po.id=barang_gudang_detail.barang_gudang_po_id and barang_gudang_detail.id=" . $_GET['detail'] . ""));

if (isset($_POST['ubah_detail'])) {
  $u = mysqli_query($koneksi, "update barang_gudang_detail set no_bath='" . $_POST['no_bath'] . "', no_lot='" . $_POST['no_lot'] . "', no_seri_brg='" . $_POST['no_seri'] . "' where id=" . $_GET['detail'] . "");
  if ($u) {
    echo "<script type='text/javascript'>
		  window.location='index.php?page=ubah_barang_masuk&id=$_GET[id]'
		</script>";
  }
}
?>
<div id="open_detail" class="modalDialog">
  <div>
    <a href="#" title="Close" class="close">X</a>
    <br />
    <form method="post">
      <label>No. Bath</label>
      <input name="no_bath" class="form-control" type="text" placeholder="" value="<?php echo $d_1['no_bath']; ?>"><br />
      <label>No. Lot</label>
      <input name="no_lot" class="form-control" type="text" placeholder="" value="<?php echo $d_1['no_lot']; ?>"><br />
      <label>No. Seri</label>
      <input name="no_seri" class="form-control" type="text" placeholder="" value="<?php echo $d_1['no_seri_brg']; ?>"><br />
      <input id="buttonn" name="ubah_detail" type="submit" value="Ubah" />
    </form>
  </div>
</div>
<?php
if (isset($_POST['tambah_detail'])) {
  $tmbh = mysqli_query($koneksi, "insert into barang_gudang_detail values('','" . $_GET['id'] . "','" . $_POST['no_bath_t'] . "','" . $_POST['no_lot_t'] . "','" . $_POST['no_seri_t'] . "','0')");
  if ($tmbh) {
    mysqli_query($koneksi, "update barang_gudang set stok=stok+1 where id=" . $_GET['id'] . "");
    echo "<script type='text/javascript'>
		  window.location='index.php?page=ubah_barang_masuk&id=$_GET[id]'
		</script>";
  }
}
?>
<div id="open_tambah_detail" class="modalDialog">
  <div>
    <a href="#" title="Close" class="close">X</a>
    <br />
    <form method="post">

      <label>No. Bath</label>
      <input name="no_bath_t" class="form-control" type="text" placeholder="" value=""><br />
      <label>No. Lot</label>
      <input name="no_lot_t" class="form-control" type="text" placeholder="" value=""><br />
      <label>No. Seri</label>
      <input name="no_seri_t" class="form-control" type="text" placeholder="" value=""><br />
      <input id="buttonn" name="tambah_detail" type="submit" value="Tambah" />
    </form>
  </div>
</div>

<?php
if (isset($_POST['simpan_ubah_baru'])) {
  $sel = mysqli_query($koneksi, "insert into principle values('','" . $_POST['nama_princ'] . "','" . $_POST['alamat_princ'] . "','" . $_POST['telp_princ'] . "','" . $_POST['fax_princ'] . "','" . $_POST['attn_princ'] . "')");
  $max = mysqli_fetch_array(mysqli_query($koneksi, "select max(id) as id_max from principle"));
  $nilai_m = $max['id_max'];
  if ($sel) {
    $upd_brg_pesan = mysqli_query($koneksi, "update barang_pesan_inventory set principle_id=$nilai_m where id=$_GET[id]");
    echo "<script type='text/javascript'>
		 window.location='index.php?page=ubah_pembelian_inventory2&id=$_GET[id]'
		</script>";
  }
}
?>
<div id="openBaru" class="modalDialog">
  <div>
    <a href="#" title="Close" class="close">X</a>
    <br />
    <form method="post">

      <label>Nama Principle</label><input name="nama_princ" type="text" class="form-control" placeholder="" value="">

      <label>Alamat Principle</label>
      <textarea name="alamat_princ" rows="6" class="form-control" placeholder=""></textarea>

      <label>Telp. Principle</label>
      <input name="telp_princ" type="text" class="form-control" placeholder="" value="">

      <label>Fax. Principle</label>
      <input name="fax_princ" type="text" class="form-control" placeholder="" value="">
      <label>Attn</label>
      <input name="attn_princ" type="text" class="form-control" placeholder="" value="">

      <input id="buttonn" name="simpan_ubah_baru" type="submit" value="Simpan" />
    </form>
  </div>
</div>

<?php
if (isset($_POST['simpan_ubah_sudah_ada'])) {
  $upd_brg_pesan = mysqli_query($koneksi, "update barang_pesan_inventory set principle_id=" . $_POST['id_akse'] . " where id=$_GET[id]");
  if ($upd_brg_pesan) {

    echo "<script type='text/javascript'>
		 window.location='index.php?page=ubah_pembelian_inventory2&id=$_GET[id]'
		</script>";
  }
}
?>
<div id="openSudahAda" class="modalDialog">
  <div>
    <a href="#" title="Close" class="close">X</a>
    <br />
    <form method="post">

      <label>Nama Principle</label>
      <select name="id_akse" id="id_akse" class="form-control" required onchange="changeValue(this.value)">
        <option>-- Pilih Principle</option>
        <?php
        $q = mysqli_query($koneksi, "select * from principle group by nama_principle order by nama_principle ASC");
        $jsArray = "var dtBrg = new Array();
";
        while ($d = mysqli_fetch_array($q)) { ?>
          <option value="<?php echo $d['id']; ?>" <?php if ($d['id'] == $data['id_principle']) {
                                                    echo "selected";
                                                  } ?>><?php echo $d['nama_principle']; ?></option>
        <?php
          $jsArray .= "dtBrg['" . $d['id'] . "'] = {alamat_princ:'" . substr($d['alamat_principle'], 0, 40) . "..............',
						telp_princ:'" . addslashes($d['telp_principle']) . "',
						fax_princ:'" . addslashes($d['fax_principle']) . "',
						attn_princ:'" . addslashes($d['attn_principle']) . "'
						};";
        } ?>

      </select> <br />
      <label>Alamat Principle</label>
      <textarea name="alamat_princ" rows="4" disabled="disabled" class="form-control" id="alamat_princ" placeholder=""><?php echo str_replace("<br>", "\n", $data['alamat_principle']); ?></textarea><br />
      <label>Telp. Principle</label>
      <input name="telp_princ" type="text" disabled="disabled" class="form-control" id="telp_princ" placeholder="" value="<?php echo $data['telp_principle']; ?>"><br />
      <label>Fax. Principle</label>
      <input name="fax_princ" type="text" disabled="disabled" class="form-control" id="fax_princ" placeholder="" value="<?php echo $data['fax_principle']; ?>"><br />
      <label>Attn Principle</label>
      <input name="attn_princ" type="text" disabled="disabled" class="form-control" id="attn_princ" placeholder="" value="<?php echo $data['attn_principle']; ?>">
      <script type="text/javascript">
        <?php
        echo $jsArray;
        ?>

        function changeValue(id_akse) {
          document.getElementById('alamat_princ').value = dtBrg[id_akse].alamat_princ;
          document.getElementById('telp_princ').value = dtBrg[id_akse].telp_princ;
          document.getElementById('fax_princ').value = dtBrg[id_akse].fax_princ;
          document.getElementById('attn_princ').value = dtBrg[id_akse].attn_princ;
        };
      </script>

      <input id="buttonn" name="simpan_ubah_sudah_ada" type="submit" value="Simpan" />
    </form>
  </div>
</div>

<div class="modal fade" id="modal-batalpo">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Pembatalan PO Pembelian</h4>
      </div>
      <form method="post">
        <div class="modal-body">
          <input type="hidden" name="id_batal" id="id_batal" value="<?php echo $_GET['id'] ?>" />
          <textarea class="form-control" rows="4" name="deskripsi" id="deskripsi" style="width:100%"></textarea>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
          <button name="batal" type="submit" class="btn btn-success" id="batalkan">Simpan</button>
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>

  <!-- /.modal-dialog -->
</div>