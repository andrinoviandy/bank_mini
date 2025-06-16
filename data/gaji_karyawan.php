<?php
include("../config/koneksi.php");
include("../include/API.php");
session_start();
error_reporting(0);
?>
<?php
$start = $_GET['start'];

if (isset($_GET['cari'])) {
    $search = str_replace(" ", "%20", $_GET['cari']);
    if (!isset($_GET['tgl1']) && !isset($_GET['tgl2'])) {
        $file = file_get_contents($API . "json/$_GET[page].php?start=$start&cari=" . $search . "");
        $file2 = file_get_contents($API . "json/$_GET[page].php?cari=" . $search . "");
    } else {
        $file = file_get_contents($API . "json/$_GET[page].php?start=$start&cari=" . $search . "&tgl1=" . $_GET['tgl1'] . "&tgl2=" . $_GET['tgl2'] . "");
        $file2 = file_get_contents($API . "json/$_GET[page].php?cari=" . $search . "&tgl1=" . $_GET['tgl1'] . "&tgl2=" . $_GET['tgl2'] . "");
    }
} else {
    if (!isset($_GET['tgl1']) && !isset($_GET['tgl2'])) {
        $file = file_get_contents($API . "json/$_GET[page].php?start=$start");
        $file2 = file_get_contents($API . "json/$_GET[page].php");
    } else {
        $file = file_get_contents($API . "json/$_GET[page].php?start=" . $start . "&tgl1=" . $_GET['tgl1'] . "&tgl2=" . $_GET['tgl2'] . "");
        $file2 = file_get_contents($API . "json/$_GET[page].php?tgl1=" . $_GET['tgl1'] . "&tgl2=" . $_GET['tgl2'] . "");
    }
}
$json = json_decode($file, true);
// $jml = count($json);

$jml2 = $file2;

?>
<div>
    <em><?php echo "Jumlah Data Yang Ditemukan : " . $jml2 ?></em>
</div>
<div class="table-responsive no-padding">
    <table width="100%" id="example1" class="table table-bordered table-hover">
        <thead>
            <tr>
                <td width="" align="center"><strong>No</strong>
                    </th>
                <th width="" valign="top">Tanggal Dikeluarkan Gaji</th>
                <th width="" valign="top">NIK</th>
                <th width="" valign="top"><strong>Nama Karyawan</strong></th>
                <th width="" valign="top">Jabatan</th>
                <th width="" valign="top">Divisi</th>
                <th width="" valign="top">Bulan &amp; Tahun</th>
                <th width="" valign="top">Jumlah Hari Kerja</th>
                <th width="" align="center" valign="top">Catatan</th>
                <th width="" align="center" valign="top">Home Pay</th>
                <th width="" align="center" valign="top">Detail Gaji</th>
                <th width="" align="center" valign="top"><strong>Aksi</strong></th>
            </tr>
        </thead>
        <?php
        if ($json != null || $json != NULL) {
            $jml = count($json);
            for ($i = 0; $i < $jml; $i++) {
        ?>
                <tr>
                    <td align="center"><?php echo $i + 1; ?></td>
                    <td><?php echo date("d/M/Y", strtotime($json[$i]['tgl_gaji']));  ?></td>
                    <td><?php echo $json[$i]['nik'];  ?></td>

                    <td>
                        <?php echo $json[$i]['nama_karyawan'];  ?>
                    </td>
                    <td><?php echo $json[$i]['jabatan'];  ?></td>
                    <td><?php echo $json[$i]['divisi']; ?></td>
                    <td><?php echo $json[$i]['bulan_tahun'];  ?></td>
                    <td><?php echo $json[$i]['jumlah_hari_kerja'] . " hari";  ?></td>
                    <td><?php echo $json[$i]['catatan'];  ?></td>
                    <td><?php $home_pay1 = mysqli_fetch_array(mysqli_query($koneksi, "select sum(total) as jumlah from gaji_karyawan_detail,gaji where gaji.id=gaji_karyawan_detail.gaji_id and gaji.kategori='Penerimaan' and gaji_karyawan_id=" . $json[$i]['idd'] . ""));
                        $home_pay2 = mysqli_fetch_array(mysqli_query($koneksi, "select sum(total) as jumlah from gaji_karyawan_detail,gaji where gaji.id=gaji_karyawan_detail.gaji_id and gaji.kategori='Pengeluaran' and gaji_karyawan_id=" . $json[$i]['idd'] . ""));
                        echo "Rp" . number_format($home_pay1['jumlah'] - $home_pay2['jumlah'], 2, ',', '.');  ?></td>
                    <td><a href="index.php?page=detail_gaji&id=<?php echo $json[$i]['idd'] ?>" data-toggle="tooltip" title="Detail Gaji"><span class="fa fa-toggle-right col-lg-1"></span></a></td>
                    <td align="center">
                        <a href="index.php?page=gaji_karyawan&id_hapus=<?php echo $json[$i]['idd']; ?>" onclick="return confirm('Anda Yakin Akan Menghapus Item Ini ?')"><span data-toggle="tooltip" title="Hapus" class="ion-android-delete"></span></a>&nbsp;&nbsp;<a href="index.php?page=ubah_gaji_karyawan&id_ubah=<?php echo $json[$i]['idd']; ?>"><span data-toggle="tooltip" title="Ubah" class="fa fa-edit"></span></a><br />
                        <a href="cetak_slip_gaji.php?id=<?php echo $json[$i]['idd'] ?>" data-toggle="tooltip" title="Cetak Slip Gaji" target="_blank"><span class="fa fa-print"></span></a>
                    </td>
                </tr>
            <?php } ?>
        <?php } else { ?>
            <tr>
                <td colspan="12" align="center">Tidak Ada Data</td>
            </tr>
        <?php } ?>
    </table>
</div>