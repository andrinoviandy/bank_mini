<?php
include("../config/koneksi.php");
session_start();
error_reporting(0);
$dt = mysqli_fetch_array(mysqli_query($koneksi, "select * from barang_gudang where id=" . $_POST['id_akse'] . ""));
// if ($dt['harga_satuan'] > 0) {
$cek = mysqli_fetch_array(mysqli_query($koneksi, "select count(*) as jml from barang_dijual_qty_hash where barang_gudang_id = $_POST[id_akse] and akun_id = $_SESSION[id]"));
if ($cek['jml'] > 0) {
  echo "SA";
  die();
}
//$stok = mysqli_fetch_array(mysqli_query($koneksi, "select stok_total from barang_gudang where id=".$_POST['id_akse'].""));
//$stok_po1 = mysqli_fetch_array(mysqli_query($koneksi, "select sum(qty_jual) as stok_po from barang_dijual_qty where barang_gudang_id=".$_POST['id_akse'].""));
//$stok_po2 = mysqli_num_rows(mysqli_query($koneksi, "select * from barang_dikirim_detail,barang_gudang_detail,barang_dijual_qty where barang_gudang_detail.id=barang_dikirim_detail.barang_gudang_detail_id and barang_dijual_qty.id=barang_dikirim_detail.barang_dijual_qty_id and barang_dijual_qty.barang_gudang_id=".$_POST['id_akse'].""));
//$go=$stok['stok_total']-($stok_po1['stok_po']-$stok_po2);
//if ($go>=$_POST['qty']) {
$sel_hrg_jual = mysqli_fetch_array(mysqli_query($koneksi, "select harga_satuan from barang_gudang where id=" . $_POST['id_akse'] . ""));
$simpan = mysqli_query($koneksi, "insert into barang_dijual_qty_hash values('','" . $_SESSION['id'] . "','" . $_POST['id_akse'] . "', '" . $sel_hrg_jual['harga_satuan'] . "','" . $_POST['qty'] . "','" . str_replace(".", "", $_POST['ongkirr']) . "')");
if ($simpan) {
  if ($dt['kategori_brg'] == 'Set') {
    $q = mysqli_query($koneksi, "select * from barang_gudang_detail_set where barang_gudang_set_id = $dt[id]");
    $max = mysqli_fetch_array(mysqli_query($koneksi, "select max(id) as idd from barang_dijual_qty_hash where akun_id = '$_SESSION[id]'"));
    while ($dd = mysqli_fetch_array($q)) {
      $hrg = mysqli_fetch_array(mysqli_query($koneksi, "select harga_satuan from barang_gudang where id = '$dd[barang_gudang_id]'"));
      $jml_total = $dd['qty'] * $_POST['qty'];
      mysqli_query($koneksi, "insert into barang_dijual_qty_detail_hash values ('','$max[idd]','$dd[barang_gudang_id]','$hrg[harga_satuan]','$dd[qty]', '$jml_total')");
    }
  }
  if ($dt['kategori_brg'] == 'Satuan' && $_POST['inc'] == '1') {
    $q = mysqli_query($koneksi, "select * from barang_gudang_detail_akse where barang_gudang_akse_id = $dt[id]");
    $max = mysqli_fetch_array(mysqli_query($koneksi, "select max(id) as idd from barang_dijual_qty_hash where akun_id = '$_SESSION[id]'"));
    while ($dd = mysqli_fetch_array($q)) {
      $hrg = mysqli_fetch_array(mysqli_query($koneksi, "select harga_satuan from barang_gudang where id = '$dd[barang_gudang_id]'"));
      $jml_total = $dd['qty'] * $_POST['qty'];
      mysqli_query($koneksi, "insert into barang_dijual_qty_detail_hash values ('','$max[idd]','$dd[barang_gudang_id]','$hrg[harga_satuan]','$dd[qty]', '$jml_total')");
    }
  }
  $tot = mysqli_fetch_array(mysqli_query($koneksi, "select sum(okr) as tot_okr from barang_dijual_qty_hash where akun_id=" . $_SESSION['id'] . ""));
  $_SESSION['ongkir'] = $tot['tot_okr'];
  // echo "<script>window.location='index.php?page=simpan_jual_alkes2'</script>";
  mysqli_query($koneksi, "update barang_gudang set nie_brg = '" . $_POST['nie_brg'] . "' where id = " . $_POST['id_akse'] . "");
  echo "S";
} else {
  echo "F";
}
  /*} else {
		echo "<script>alert('Maaf , Stok Tidak Mencukupi !');
		</script>";
		}*/
// } else {
//   echo "SAMA";
  // echo "<script>
  // alert('Harga jual alat tidak boleh 0 , update harga jual nya terlebih dahulu !');
  // </script>";
// }
