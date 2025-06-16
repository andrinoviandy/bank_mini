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
                <th width="" valign="top">NIK</th>
                <th width="" valign="top" class="text-nowrap"><strong>Nama Nasabah</strong></th>
                <th width="" valign="top" class="text-nowrap">Tanggal Pinjaman</th>
                <th width="" valign="top" class="text-nowrap">Nominal Pinjam</th>
                <th width="" valign="top">Keterangan</th>
                <th width="" valign="top" class="text-nowrap">Asal Dana</th>
                <th width="" valign="top">Status</th>
                <th width="" valign="top">Operator</th>
                <th width="" valign="top" class="text-nowrap">Total Angsuran</th>
                <th width="" valign="top" class="text-nowrap">Total Kekurangan</th>
                <th width="" valign="top" class="text-nowrap">Total Angsuran + Bunga</th>
                <th width="" valign="top">Keuntungan</th>
                <th width="" align="center" valign="top"><strong>Aksi</strong></th>
            </tr>
        </thead>
        <?php
        if ($json != null || $json != NULL) {
            $jml = count($json);
            for ($i = 0; $i < $jml; $i++) {
        ?>
                <tr>
                    <td align="center"><?php echo $start += 1; ?></td>
                    <td><?php echo $json[$i]['nik'];  ?></td>

                    <td>
                        <?php echo $json[$i]['nama_nasabah'];  ?>
                    </td>
                    <td><?php echo date("d-m-Y", strtotime($json[$i]['tgl_pinjam']));  ?></td>
                    <td><?php echo number_format($json[$i]['nominal_pinjam'], 0, ',', '.');  ?></td>
                    <td><?php echo $json[$i]['keterangan'];  ?></td>
                    <td><?php echo $json[$i]['nama_akun'];  ?></td>
                    <td><?php echo $json[$i]['flag_lunas'] == 0 ? 'Belum Lunas' : 'Lunas';  ?></td>
                    <td><?php echo $json[$i]['operator'];  ?></td>
                    <td><?php echo "Rp" . number_format($json[$i]['total_angsuran'], 0, ',', '.');  ?></td>
                    <td><?php echo "Rp" . number_format($json[$i]['total_kekurangan'], 0, ',', '.');  ?></td>
                    <td><?php echo "Rp" . number_format($json[$i]['total_angsuran_bunga'], 0, ',', '.');  ?></td>
                    <td><?php echo "Rp" . number_format($json[$i]['total_keuntungan'], 0, ',', '.');  ?></td>
                    <td>
                        <!-- href="index.php?page=karyawan&id_hapus=<?php echo $json[$i]['idd']; ?>" onclick="return confirm('Anda Yakin Akan Menghapus Item Ini ?')" -->
                        <!-- <button class="btn btn-xs btn-danger" onclick="hapusData('<?php echo $json[$i]['idd']; ?>')"><span data-toggle="tooltip" title="Hapus" class="ion-android-delete"></span></button>
                    &nbsp;-->
                        <a href="index.php?page=detail_pinjaman&id=<?php echo $json[$i]['idd']; ?>" class="btn btn-xs btn-info" data-toggle="tooltip" data-title="Detai"><span class="fa fa-folder-open"></span></a>

                    </td>
                </tr>
            <?php } ?>
        <?php } else { ?>
            <tr>
                <td colspan="9" align="center">Tidak Ada Data</td>
            </tr>
        <?php } ?>
    </table>
</div>