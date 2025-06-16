<?php
include("../config/koneksi.php");
include("../include/API.php");
session_start();
// error_reporting(0);
?>
<?php
$start = $_GET['start'];

if (isset($_GET['cari'])) {
    $search = str_replace(" ", "%20", $_GET['cari']);
    if (!isset($_GET['tgl1']) && !isset($_GET['tgl2'])) {
        $file = file_get_contents($API . "json/$_GET[page].php?start=$start&cari=" . $search . "&status=$_GET[status]");
        $file2 = file_get_contents($API . "json/$_GET[page].php?cari=" . $search . "&status=$_GET[status]");
    } else {
        $file = file_get_contents($API . "json/$_GET[page].php?start=$start&cari=" . $search . "&tgl1=" . $_GET['tgl1'] . "&tgl2=" . $_GET['tgl2'] . "&status=$_GET[status]");
        $file2 = file_get_contents($API . "json/$_GET[page].php?cari=" . $search . "&tgl1=" . $_GET['tgl1'] . "&tgl2=" . $_GET['tgl2'] . "&status=$_GET[status]");
    }
} else {
    if (!isset($_GET['tgl1']) && !isset($_GET['tgl2'])) {
        $file = file_get_contents($API . "json/$_GET[page].php?start=$start&status=$_GET[status]");
        $file2 = file_get_contents($API . "json/$_GET[page].php?status=$_GET[status]");
    } else {
        $file = file_get_contents($API . "json/$_GET[page].php?start=" . $start . "&tgl1=" . $_GET['tgl1'] . "&tgl2=" . $_GET['tgl2'] . "&status=$_GET[status]");
        $file2 = file_get_contents($API . "json/$_GET[page].php?tgl1=" . $_GET['tgl1'] . "&tgl2=" . $_GET['tgl2'] . "&status=$_GET[status]");
    }
}
$json = json_decode($file, true);
// var_dump($json); die();
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
                <th width="" valign="top" class="text-nowrap">Tanggal Deposit</th>
                <th width="" valign="top" class="text-nowrap">Nama Orang Tua</th>
                <th width="" valign="top" class="text-nowrap">Jumlah Deposit</th>
                <th width="" valign="top" class="text-nowrap">Bank Tujuan</th>
                <th width="" valign="top">Status</th>
                <?php if (isset($_GET['status']) && $_GET['status'] == '0,1') { ?>
                    <th width="" align="center" valign="top"><strong>Aksi</strong></th>
                <?php } ?>
            </tr>
        </thead>
        <?php
        $jml = count($json);
        if ($jml !== 0) {
            for ($i = 0; $i < $jml; $i++) {
        ?>
                <tr>
                    <td align="center"><?php echo $start += 1; ?></td>
                    <td><?php echo date("d-m-Y", strtotime($json[$i]['created_at']));  ?></td>
                    <td><?php echo $json[$i]['nama'];  ?></td>
                    <td><?php echo "Rp" . number_format($json[$i]['jumlah'], 0, ',', '.');  ?></td>
                    <td><?php echo $json[$i]['bank'];  ?></td>
                    <td>
                        <?php if ($json[$i]['status'] == 0) { ?>
                            <badge class="badge btn-info">Baru, Belum Konfirmasi</badge>
                        <?php } ?>
                        <?php if ($json[$i]['status'] == 1) { ?>
                            <badge class="badge btn-primary">Sudah Konfirmasi</badge>
                            <br>
                            <badge class="badge btn-info" style="cursor: pointer;" onclick="lihatBukti('<?php echo $json[$i]['bukti_transfer']; ?>')">Lihat Bukti Transfer</badge>
                        <?php } ?>
                        <?php if ($json[$i]['status'] == 2) { ?>
                            <badge class="badge btn-primary">Selesai</badge>
                            <br>
                            <?php if ($json[$i]['bank'] == 'Manual') { ?>
                                <badge class="badge btn-success">Manual, Tidak Ada Bukti Transfer</badge>
                            <?php } else { ?>
                                <badge class="badge btn-info" style="cursor: pointer;" onclick="lihatBukti('<?php echo $json[$i]['bukti_transfer']; ?>')">Lihat Bukti Transfer</badge>
                            <?php } ?>
                        <?php } ?>
                    </td>
                    <?php if (isset($_GET['status']) && $_GET['status'] == '0,1') { ?>
                        <td>
                            <!-- href="index.php?page=karyawan&id_hapus=<?php echo $json[$i]['idd']; ?>" onclick="return confirm('Anda Yakin Akan Menghapus Item Ini ?')" -->
                            <button class="btn btn-sm btn-success" onclick="konfirmasi('<?php echo $json[$i]['idd']; ?>', '<?php echo number_format($json[$i]['jumlah'], 0, ',', '.'); ?>')"><span data-toggle="tooltip" title="Hapus" class="fa fa-check"></span> Konfirmasi</button>
                            &nbsp;
                            <!-- <a href="index.php?page=detail_pinjaman&id=<?php echo $json[$i]['idd']; ?>" class="btn btn-xs btn-info" data-toggle="tooltip" data-title="Detai"><span class="fa fa-folder-open"></span></a> -->
                        </td>
                    <?php } ?>
                </tr>
            <?php } ?>
        <?php } else { ?>
            <tr>
                <td colspan="7">Tidak Ada Data</td>
            </tr>
        <?php } ?>
    </table>
</div>