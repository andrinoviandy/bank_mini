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
                <th width="" valign="top"><strong>Nama Nasabah</strong></th>
                <th width="" valign="top">TTL</th>
                <th width="" valign="top">Alamat</th>
                <th width="" valign="top">Email</th>
                <th width="" valign="top">No. HP</th>
                <th width="" valign="top">Status</th>
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
                    <td><?php echo $json[$i]['tempat_lahir'] . ", " . date("d-m-Y", strtotime($json[$i]['tanggal_lahir']));  ?></td>
                    <td><?php echo $json[$i]['alamat']; ?></td>
                    <td><?php echo $json[$i]['email'];  ?></td>
                    <td><?php echo $json[$i]['no_hp'];  ?></td>
                    <td><?php echo $json[$i]['status'] === 1 ? 'Aktif' : 'Pasif';  ?></td>
                    <td>
                        <!-- href="index.php?page=karyawan&id_hapus=<?php echo $json[$i]['idd']; ?>" onclick="return confirm('Anda Yakin Akan Menghapus Item Ini ?')" -->
                        <button class="btn btn-xs btn-danger" onclick="hapusData('<?php echo $json[$i]['idd']; ?>')"><span data-toggle="tooltip" title="Hapus" class="ion-android-delete"></span></button>
                        &nbsp;
                        <a href="index.php?page=ubah_nasabah&id_ubah=<?php echo $json[$i]['idd']; ?>" class="btn btn-xs btn-info"><span data-toggle="tooltip" title="Ubah" class="fa fa-edit"></span></a>

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