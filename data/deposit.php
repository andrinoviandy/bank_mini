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
                <th width="" align="center">No</th>
                <th width="" valign="top"><strong>Tgl Deposit</strong></th>
                <th width="" valign="top">Dari Akun</th>
                <th width="" valign="top"><strong>Ke Akun</strong></th>
                <th width="" valign="top">Nominal</th>
                <th width="" align="center" valign="top">Deskripsi</th>
                <th width="" align="center" valign="top"><strong>Aksi</strong></th>
            </tr>
        </thead>
        <?php
        if ($json != null || $json != NULL) {
            $jml = count($json);
            for ($i = 0; $i < $jml; $i++) {
        ?>
                <tr>
                    <td><?php echo $start += 1; ?></td>
                    <td>
                        <?php echo date("d M Y", strtotime($json[$i]['tgl_deposit']));  ?>
                    </td>
                    <td><?php
                        echo $json[$i]['dari_akun'];
                        ?></td>
                    <td><?php
                        echo $json[$i]['ke_akun'];
                        ?></td>
                    <td><?php echo "Rp " . number_format($json[$i]['nominal_deposit'], 2, ',', '.'); ?></td>
                    <td><?php echo $json[$i]['deskripsi'] ?></td>
                    <td>
                        <!-- href="index.php?page=deposit&id_hapus=<?php echo $json[$i]['idd']; ?>" onclick="return confirm('Anda Yakin Akan Membatalkan Proses Ini ?')" -->
                        <button onclick="batalkan('<?php echo $json[$i]['idd']; ?>');" class="btn btn-xs btn-danger"><span data-toggle="tooltip" title="Batalkan" class="fa fa-close"></span></button>
                    </td>
                </tr>
            <?php } ?>
        <?php } else { ?>
            <tr>
                <td colspan="7" align="center">Tidak Ada Data</td>
            </tr>
        <?php } ?>
    </table>
</div>