<?php
include("../config/koneksi.php");
include("../include/API.php");
session_start();
error_reporting(0);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>

</head>

<body>
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
    $jml = count($json);

    $jml2 = $file2;

    ?>
    <div>
        <em><?php echo "Jumlah Data Yang Ditemukan : " . $jml2 ?></em>
    </div>
    <div class="table-responsive">
        <table width="100%" id="example1" class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th valign="top">#</th>
                    <td align="center" valign="top">
                        <strong>Detail Barang</strong>
                    </td>
                    <th align="center" valign="top"><strong>Nomor Retur</strong> </th>
                    <th align="center" valign="top">Tgl Retur</th>
                    <th align="center" valign="top">Nomor PO/ID</th>
                    <th align="center" valign="top">Dinas/RS/Dll</th>
                    <th align="center" valign="top"><strong>Aksi</strong></th>
                </tr>
            </thead>
            <?php
            for ($i = 0; $i < $jml; $i++) {
                //echo "Nama Barang ke-".$i." : " . $json[$i]['nama_brg'] . "<br />";
                //echo 'Nama Anggota ke-3 : ' . $json['2']['nama_brg'];
            ?>
                <tr>

                    <td><?php echo $i + 1; ?></td>
                    <td valign="top">
                        <table width="100%" border="0">
                            <table width="100%" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Nama Alkes</th>
                                        <th>Tipe Brg</th>
                                        <th>No Seri</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $q2 = mysqli_query($koneksi, "select nama_brg,no_seri_brg,tipe_brg from barang_kembali_detail,barang_gudang,barang_gudang_detail where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=barang_kembali_detail.barang_gudang_detail_id and barang_kembali_id=" . $json[$i]['idd'] . "");
                                    $n = 0;
                                    while ($d1 = mysqli_fetch_array($q2)) {
                                        $n++;
                                        if ($n % 2 == 0) {
                                            $col = "#CCCCCC";
                                        } else {
                                            $col = "#999999";
                                        }
                                    ?>
                                        <tr>
                                            <td align="left"><?php echo $d1['nama_brg'] ?></td>
                                            <td align="left"><?php echo $d1['tipe_brg'] ?></td>
                                            <td align="right"><?php
                                                                echo $d1['no_seri_brg'];
                                                                ?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                                <tr>
                                    <td align="center" colspan="3">Total Barang : <?php
                                                                                    $jmm = mysqli_num_rows(mysqli_query($koneksi, "select nama_brg,no_seri_brg,tipe_brg from barang_kembali_detail,barang_gudang,barang_gudang_detail where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=barang_kembali_detail.barang_gudang_detail_id and barang_kembali_id=" . $json[$i]['idd'] . ""));
                                                                                    echo $jmm;
                                                                                    ?>
                                        <button class="btn btn-xs btn-info" data-toggle="modal" data-target="#modal-detail<?php echo $json[$i]['idd'] ?>">Detail</button>
                                    </td>
                                </tr>
                            </table>
                    </td>
                    <td><?php echo $json[$i]['no_retur']; ?></td>
                    <td><?php echo date("d/m/Y", strtotime($json[$i]['tgl_retur'])); ?></td>

                    <td><?php echo $json[$i]['no_po_id']; ?></td>
                    <td><?php
                        $pemb = mysqli_fetch_array(mysqli_query($koneksi, "select nama_pembeli from barang_kembali,barang_dikirim,barang_dikirim_detail,barang_dijual,pembeli where pembeli.id=barang_dijual.pembeli_id and barang_dijual.id=barang_dikirim.barang_dijual_id and barang_dikirim.id=barang_dikirim_detail.barang_dikirim_id and barang_dikirim.id=barang_kembali.barang_dikirim_id and barang_kembali.id=" . $json[$i]['idd'] . ""));
                        echo $pemb['nama_pembeli'];
                        ?></td>
                    <td align="center">
                        <?php if (isset($_SESSION['user_administrator']) && isset($_SESSION['pass_administrator'])) { ?>
                            <!-- <a href="index.php?page=barang_kembali&id_hapus=<?php echo $json[$i]['idd']; ?>" onclick="return confirm('Anda Yakin Akan Menghapus Item Ini ?')"> -->
                            <a href="#" onclick="hapus('<?php echo $json[$i]['idd']; ?>', '<?php echo $json[$i]['no_retur']; ?>')">
                                <button class="btn btn-xs btn-danger">
                                    <span data-toggle="tooltip" title="Hapus" class="ion-android-delete"></span>
                                </button>
                            </a>
                            &nbsp;
                            <!--<a href="index.php?page=ubah_barang_kembali&id=<?php echo $json[$i]['idd']; ?>"><span data-toggle="tooltip" title="Ubah" class="fa fa-edit"></span></a>&nbsp; -->
                            <a href="cetak_surat_kembali.php?id=<?php echo $json[$i]['idd']; ?>" target="_blank">
                                <button class="btn btn-xs btn-primary">
                                    <span data-toggle="tooltip" title="Cetak Retur Pengembalian" class="fa fa-print"></span>
                                </button>
                            </a>
                        <?php } ?>
                        <?php if (isset($_SESSION['user_admin_gudang']) && isset($_SESSION['pass_admin_gudang'])) { ?>
                            <!--<a href="index.php?page=ubah_barang_kembali&id=<?php echo $json[$i]['idd']; ?>"><span data-toggle="tooltip" title="Ubah" class="fa fa-edit"></span></a>&nbsp;-->
                            <a href="cetak_surat_kembali.php?id=<?php echo $json[$i]['idd']; ?>" target="_blank">
                                <button class="btn btn-xs btn-primary">
                                    <span data-toggle="tooltip" title="Cetak Retur Pengembalian" class="fa fa-print"></span>
                                </button>
                            </a>
                        <?php } ?>
                        <!-- Tombol Jual -->


                        <input type="hidden" name="id" value="<?php echo $json[$i]['idd']; ?>" />
                    </td>
                </tr>
                <div class="modal fade" id="modal-detail<?php echo $json[$i]['idd'] ?>">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">

                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Detail Jumlah Barang Retur</h4>
                            </div>
                            <div class="modal-body">
                                <?php
                                $q3 = mysqli_query($koneksi, "select tipe_brg from barang_kembali_detail,barang_gudang,barang_gudang_detail where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=barang_kembali_detail.barang_gudang_detail_id and barang_kembali_id=" . $json[$i]['idd'] . " group by tipe_brg order by tipe_brg ASC");
                                while ($d = mysqli_fetch_array($q3)) {
                                    echo $d['tipe_brg'];
                                    $jm = mysqli_num_rows(mysqli_query($koneksi, "select tipe_brg from barang_kembali_detail,barang_gudang,barang_gudang_detail where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=barang_kembali_detail.barang_gudang_detail_id and tipe_brg='" . $d['tipe_brg'] . "' and barang_kembali_id=" . $json[$i]['idd'] . ""));
                                    echo "<div class='pull pull-right'>" . $jm . "</div>";
                                    echo "<hr/>";
                                }
                                ?>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                            </div>

                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
            <?php } ?>
        </table>
    </div>

</body>

</html>