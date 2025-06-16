<?php
include("../config/koneksi.php");
include("../include/API.php");
session_start();
error_reporting(0);
?>
<?php
$start = $_GET['start'];

if (isset($_GET['cari'])) {
    if (isset($_GET['id_keuangan'])) {
        $search = str_replace(" ", "%20", $_GET['cari']);
        if (!isset($_GET['tgl1']) && !isset($_GET['tgl2'])) {
            if (isset($_GET['id'])) {
                $file = file_get_contents($API . "json/$_GET[page].php?start=$start&cari=" . $search . "&id_keuangan=$_GET[id_keuangan]&id=$_GET[id]");
                $file2 = file_get_contents($API . "json/$_GET[page].php?cari=" . $search . "&id_keuangan=$_GET[id_keuangan]&id=$_GET[id]");
            } else {
                $file = file_get_contents($API . "json/$_GET[page].php?start=$start&cari=" . $search . "&id_keuangan=$_GET[id_keuangan]");
                $file2 = file_get_contents($API . "json/$_GET[page].php?cari=" . $search . "&id_keuangan=$_GET[id_keuangan]");
            }
        } else {
            if (isset($_GET['id'])) {
                $file = file_get_contents($API . "json/$_GET[page].php?start=$start&cari=" . $search . "&tgl1=" . $_GET['tgl1'] . "&tgl2=" . $_GET['tgl2'] . "&id_keuangan=$_GET[id_keuangan]&id=$_GET[id]");
                $file2 = file_get_contents($API . "json/$_GET[page].php?cari=" . $search . "&tgl1=" . $_GET['tgl1'] . "&tgl2=" . $_GET['tgl2'] . "&id_keuangan=$_GET[id_keuangan]&id=$_GET[id]");
            } else {
                $file = file_get_contents($API . "json/$_GET[page].php?start=$start&cari=" . $search . "&tgl1=" . $_GET['tgl1'] . "&tgl2=" . $_GET['tgl2'] . "&id_keuangan=$_GET[id_keuangan]");
                $file2 = file_get_contents($API . "json/$_GET[page].php?cari=" . $search . "&tgl1=" . $_GET['tgl1'] . "&tgl2=" . $_GET['tgl2'] . "&id_keuangan=$_GET[id_keuangan]");
            }
        }
    } else {
        $search = str_replace(" ", "%20", $_GET['cari']);
        if (!isset($_GET['tgl1']) && !isset($_GET['tgl2'])) {
            if (isset($_GET['id'])) {
                $file = file_get_contents($API . "json/$_GET[page].php?start=$start&cari=" . $search . "&id=$_GET[id]");
                $file2 = file_get_contents($API . "json/$_GET[page].php?cari=" . $search . "&id=$_GET[id]");
            } else {
                $file = file_get_contents($API . "json/$_GET[page].php?start=$start&cari=" . $search . "");
                $file2 = file_get_contents($API . "json/$_GET[page].php?cari=" . $search . "");
            }
        } else {
            if (isset($_GET['id'])) {
                $file = file_get_contents($API . "json/$_GET[page].php?start=$start&cari=" . $search . "&tgl1=" . $_GET['tgl1'] . "&tgl2=" . $_GET['tgl2'] . "&id=$_GET[id]");
                $file2 = file_get_contents($API . "json/$_GET[page].php?cari=" . $search . "&tgl1=" . $_GET['tgl1'] . "&tgl2=" . $_GET['tgl2'] . "&id=$_GET[id]");
            } else {
                $file = file_get_contents($API . "json/$_GET[page].php?start=$start&cari=" . $search . "&tgl1=" . $_GET['tgl1'] . "&tgl2=" . $_GET['tgl2'] . "");
                $file2 = file_get_contents($API . "json/$_GET[page].php?cari=" . $search . "&tgl1=" . $_GET['tgl1'] . "&tgl2=" . $_GET['tgl2'] . "");
            }
        }
    }
} else {
    if (isset($_GET['id_keuangan'])) {
        if (!isset($_GET['tgl1']) && !isset($_GET['tgl2'])) {
            if (isset($_GET['id'])) {
                $file = file_get_contents($API . "json/$_GET[page].php?start=$start&id_keuangan=$_GET[id_keuangan]&id=$_GET[id]");
                $file2 = file_get_contents($API . "json/$_GET[page].php?id_keuangan=$_GET[id_keuangan]&id=$_GET[id]");
            } else {
                $file = file_get_contents($API . "json/$_GET[page].php?start=$start&id_keuangan=$_GET[id_keuangan]");
                $file2 = file_get_contents($API . "json/$_GET[page].php?id_keuangan=$_GET[id_keuangan]&id=$_GET[id]");
            }
        } else {
            if (isset($_GET['id'])) {
                $file = file_get_contents($API . "json/$_GET[page].php?start=" . $start . "&tgl1=" . $_GET['tgl1'] . "&tgl2=" . $_GET['tgl2'] . "&id_keuangan=$_GET[id_keuangan]&id=$_GET[id]");
                $file2 = file_get_contents($API . "json/$_GET[page].php?tgl1=" . $_GET['tgl1'] . "&tgl2=" . $_GET['tgl2'] . "&id_keuangan=$_GET[id_keuangan]&id=$_GET[id]");
            } else {
                $file = file_get_contents($API . "json/$_GET[page].php?start=" . $start . "&tgl1=" . $_GET['tgl1'] . "&tgl2=" . $_GET['tgl2'] . "&id_keuangan=$_GET[id_keuangan]");
                $file2 = file_get_contents($API . "json/$_GET[page].php?tgl1=" . $_GET['tgl1'] . "&tgl2=" . $_GET['tgl2'] . "&id_keuangan=$_GET[id_keuangan]");
            }
        }
    } else {
        if (!isset($_GET['tgl1']) && !isset($_GET['tgl2'])) {
            if (isset($_GET['id'])) {
                $file = file_get_contents($API . "json/$_GET[page].php?start=$start&id=$_GET[id]");
                $file2 = file_get_contents($API . "json/$_GET[page].php?id=$_GET[id]");
            } else {
                $file = file_get_contents($API . "json/$_GET[page].php?start=$start");
                $file2 = file_get_contents($API . "json/$_GET[page].php");
            }
        } else {
            if (isset($_GET['id'])) {
                $file = file_get_contents($API . "json/$_GET[page].php?start=" . $start . "&tgl1=" . $_GET['tgl1'] . "&tgl2=" . $_GET['tgl2'] . "&id=$_GET[id]");
                $file2 = file_get_contents($API . "json/$_GET[page].php?tgl1=" . $_GET['tgl1'] . "&tgl2=" . $_GET['tgl2'] . "&id=$_GET[id]");
            } else {
                $file = file_get_contents($API . "json/$_GET[page].php?start=" . $start . "&tgl1=" . $_GET['tgl1'] . "&tgl2=" . $_GET['tgl2'] . "");
                $file2 = file_get_contents($API . "json/$_GET[page].php?tgl1=" . $_GET['tgl1'] . "&tgl2=" . $_GET['tgl2'] . "");
            }
        }
    }
}
$json = json_decode($file, true);
$jml2 = $file2;

?>
<div>
    <em><?php echo "Jumlah Data Yang Ditemukan : " . $jml2 ?></em>
</div>
<div class="table-responsive no-padding">
    <table width="100%" id="" class="table table-bordered">
        <thead>
            <tr>
                <th align="center" valign="top">No</th>
                <th valign="top">Jenis Transaksi</th>
                <th valign="top">Tanggal</th>
                <th valign="top">Akun Kas &amp; Bank</th>
                <th valign="top"><strong>Diterima Oleh / Diterima Dari</strong></th>
                <th valign="top">Deskripsi</th>
                <th valign="top"><strong>Harga</strong></th>
                <th width="16%" align="center" valign="top"><strong>Aksi</strong></th>
            </tr>
        </thead>
        <?php
        if ($json != null || $json != NULL) {
            $jml = count($json);
            for ($i = 0; $i < $jml; $i++) {
        ?>
                <tr>
                    <td align="center" valign="center"><?php echo $start += 1; ?></td>
                    <td valign="center"><span class="<?php if ($json[$i]['jenis_transaksi'] == 'Penerimaan') {
                                                            echo "label label-success";
                                                        } else {
                                                            echo "label label-warning";
                                                        } ?>"><?php echo $json[$i]['jenis_transaksi']; ?></span></td>
                    <td valign="center"><?php echo date("d M Y", strtotime($json[$i]['tgl'])); ?></td>
                    <td><?php echo $json[$i]['nama_akun']; ?></td>
                    <td><?php echo $json[$i]['penerima']; ?></td>
                    <td>
                        <?php echo $json[$i]['deskripsi'];  ?></td>
                    <td><?php echo "Rp" . number_format($json[$i]['harga'], 2, ',', '.'); ?></td>
                    <td>
                        <!-- <a href="index.php?page=biaya_lain&id_hapus=<?php echo $json[$i]['idd']; ?>" onclick="return confirm('Anda Yakin Akan Menghapus Item Ini ?')"> -->
                        <a href="javascript:void()" onclick="hapus('<?php echo $json[$i]['idd']; ?>')" class="btn btn-xs btn-danger">
                            <span data-toggle="tooltip" title="Hapus" class="ion-android-delete"></span></a>&nbsp;&nbsp;
                        <!-- <a href="index.php?page=ubah_biaya_lain&id_ubah=<?php echo $json[$i]['idd']; ?>"> -->
                        <a href="javascript:void()" onclick="openUbah('<?php echo $json[$i]['idd']; ?>')" class="btn btn-xs btn-info">
                            <span data-toggle="tooltip" title="Ubah" class="fa fa-edit"></span></a><br />
                    </td>
                </tr>
            <?php } ?>
        <?php } else { ?>
            <tr>
                <td colspan="8" align="center">Tidak Ada Data</td>
            </tr>
        <?php } ?>
    </table>
</div>