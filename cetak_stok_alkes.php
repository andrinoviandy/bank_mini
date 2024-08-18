<?php 
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Stok Alkes - MERK $_POST[merk].xls");
?>
<?php require("config/koneksi.php"); ?>
<h3 align="center"><strong>PT. CIPTA VARIA KHARISMA UTAMA</strong></h3>

<p><b>Stok Alkes</b></p>
<table width="" border="1" class="table table-bordered table-hover" id="example1">
  <thead>
    <tr>
      <th rowspan="2" align="center"><strong>No</strong></th>
      <th rowspan="2" align="center"><strong>Merk/Brand</strong></th>
      <th rowspan="2" align="center">Nama Barang</th>
      <th rowspan="2" align="center"><strong>Type</strong></th>
      <th colspan="5" align="center">Tahun <?php $tahun=getdate(); echo $tahun['year']; ?></th>
      <th rowspan="2" align="center" bgcolor="#00CC00">Jumlah Stok</th>
      
    </tr>
    <tr>
      <th align="center" bgcolor="#99FF00"><strong>Stok Awal</strong></th>
      <th align="center" bgcolor="#CC9900">Masuk</th>
      <th align="center" bgcolor="#FF0000">Terjual</th>
      <th align="center" bgcolor="#FF0000">Rusak</th>
      <th align="center" bgcolor="#FF0000">Dikembalikan</th>
    </tr>
  </thead>
  <?php
 if ($_POST['merk']=='all') {
	$query = mysqli_query($koneksi, "select * from barang_gudang group by merk_brg");
 } else {
	 $query = mysqli_query($koneksi, "select * from barang_gudang where merk_brg='".$_POST['merk']."' group by merk_brg");
	 }
	$jml = mysqli_num_rows($query);
	
	if ($jml!=0) {
  $no=0;
  while ($data = mysqli_fetch_array($query)) { 
  $no++;
  ?>
  <tr>
    <td align="center" valign="top"><?php echo $no; ?></td>
    <td align="left" valign="top"><?php
	echo $data['merk_brg']; ?></td>
    <td colspan="8" valign="top">
    <table width="100%" border="1">
    <?php $sel = mysqli_query($koneksi, "select * from barang_gudang where merk_brg='".$data['merk_brg']."' order by nama_brg ASC"); 
	while ($data_sel = mysqli_fetch_array($sel)) {
	?>
      <tr>
        <td align="left"><?php echo $data_sel['nama_brg']; ?></td>
        <td align="left"><?php echo $data_sel['tipe_brg']; ?></td>
        <td align="center" bgcolor="#99FF00">
        <?php 
		$th = date('Y');
		$t3 = $th-1;
		$t4 = $th;
		$q = mysqli_num_rows(mysqli_query($koneksi, "select * from barang_gudang,barang_gudang_po,barang_gudang_detail where barang_gudang.id=barang_gudang_po.barang_gudang_id and barang_gudang_po.id=barang_gudang_detail.barang_gudang_po_id and barang_gudang.id=".$data_sel['id']." and year(tgl_po_gudang)<='$t3'"));
		echo $q;
		?>
        </td>
        <td align="center" bgcolor="#CC9900"><?php 
		$q1 = mysqli_num_rows(mysqli_query($koneksi, "select * from barang_gudang,barang_gudang_po,barang_gudang_detail where barang_gudang.id=barang_gudang_po.barang_gudang_id and barang_gudang_po.id=barang_gudang_detail.barang_gudang_po_id and barang_gudang.id=".$data_sel['id']." and year(tgl_po_gudang)='$t4'"));
		echo $q1; ?></td>
        <td align="center" bgcolor="#FF0000"><?php 
		$q1_1 = mysqli_fetch_array(mysqli_query($koneksi, "select sum(qty_jual) as total_jual from barang_dijual_qty where barang_gudang_id=".$data_sel['id'].""));
		// $q1_1_set = mysqli_fetch_array(mysqli_query($koneksi, "select sum(qty_barang_gudang*qty_set) as stok_po_set from barang_dijual_qty_set_detail,barang_dijual_qty_set where barang_dijual_qty_set.id=barang_dijual_qty_set_detail.barang_dijual_qty_set_id and barang_gudang_id=".$data_sel['id'].""));
		echo $q1_1['total_jual']; //+$q1_1_set['stok_po_set']; ?></td>
        <td align="center" bgcolor="#FF0000">
        <?php 
		$q1_2 = mysqli_num_rows(mysqli_query($koneksi, "select * from barang_gudang_detail where barang_gudang_id=".$data_sel['id']." and status_kerusakan=1"));
		echo $q1_2; ?>
        </td>
        <td align="center" bgcolor="#FF0000">
        <?php 
		$q1_3 = mysqli_num_rows(mysqli_query($koneksi, "select * from barang_gudang_detail where barang_gudang_id=".$data_sel['id']." and status_kerusakan=2"));
		echo $q1_3; ?>
        </td>
        <td bgcolor="#00CC00">
        <?php 
		$q1_4 = mysqli_fetch_array(mysqli_query($koneksi, "select stok_total from barang_gudang where id=".$data_sel['id'].""));
		echo $q+$q1-($q1_1['total_jual'])-$q1_2-$q1_3; ?>
		<!-- echo $q+$q1-($q1_1['total_jual']+$q1_1_set['stok_po_set'])-$q1_2-$q1_3; ?> -->
        </td>
      </tr>
      <?php } ?>
    </table></td>
  </tr>
  <?php }} else { ?>
	  <tr>
    <td colspan="11" align="center" valign="top">Data Tidak Ada / Kosong</td>
  </tr>
	 <?php } ?>
</table>