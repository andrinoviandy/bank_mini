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
        <table width="100%" class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th align="center">No</th>

                    <th bgcolor="#99FFCC">Tanggal Kirim</th>
                    <th>Nama Paket</th>
                    <th>No_Surat_Jalan</th>
                    <th>Barang</th>
                    <th><strong>Lokasi Tujuan</strong></th>
                    <th>Kontak</th>
                    <th>Pengiriman</th>
                    <th bgcolor="#99FFCC"><strong>Tanggal Sampai</strong></th>
                    <th align="center">Keterangan</th>
                    <th align="center"><strong>Aksi</strong></th>
                </tr>
            </thead>
            <?php
            // membuka file JSON
            // if (isset($_GET['pilihan']) and isset($_GET['kunci'])) {
            //     $file = file_get_contents("http://localhost/ALKES/json/kirim_barang_pinjam.php?pilihan=$_GET[pilihan]&kunci=" . str_replace(" ", "%20", $_GET['kunci']) . "");
            // } elseif (isset($_GET['pilihan']) and isset($_GET['tgl1']) and isset($_GET['tgl2'])) {
            //     $file = file_get_contents("http://localhost/ALKES/json/kirim_barang_pinjam.php?pilihan=$_GET[pilihan]&tgl1=" . $_GET['tgl1'] . "&tgl2=" . $_GET['tgl2'] . "");
            // } else {
            //     $file = file_get_contents("http://localhost/ALKES/json/kirim_barang_pinjam.php");
            // }
            // $json = json_decode($file, true);
            // $jml = count($json);
            for ($i = 0; $i < $jml; $i++) {
                //echo "Nama Barang ke-".$i." : " . $json[$i]['nama_brg'] . "<br />";
                //echo 'Nama Anggota ke-3 : ' . $json['2']['nama_brg'];
            ?>
                <tr>
                    <td align="center"><?php echo $i + 1; ?></td>
                    <td bgcolor="#99FFCC"><?php echo date("d M Y", strtotime($json[$i]['tgl_kirim'])); ?></td>
                    <td><?php echo $json[$i]['nama_paket']; ?></td>

                    <td><?php echo $json[$i]['no_pengiriman']; ?></td>

                    <td>
                        <?php if ($_GET['tampil'] == 1) { ?>
                            <?php
                            $q23 = mysqli_query($koneksi, "select nama_brg,no_seri_brg,status_kembali,tipe_brg from barang_gudang,barang_gudang_detail,barang_pinjam_kirim_detail where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=barang_pinjam_kirim_detail.barang_gudang_detail_id and barang_pinjam_kirim_id=" . $json[$i]['idd'] . "");
                            $n2 = 0;
                            while ($d1 = mysqli_fetch_array($q23)) {
                                $n2++;
                            ?>
                                <?php if ($d1['status_batal'] == 1) { ?>
                                    <font class="pull pull-right" size="" color="#FF0000">(Batal)</font>
                                <?php } ?>
                                <?php echo $n2 . ".[" . $d1['nama_brg'] . "]-[" . $d1['tipe_brg'] . "]-[" . $d1['no_seri_brg'] . "]"; ?>
                                <hr style="margin:0px; border-top:1px double; width:100%" />
                            <?php } ?>
                        <?php } else { ?>
                            <a href="#" data-toggle="modal" data-target="#modal-detailbarang<?php echo $json[$i]['idd']; ?>"><small data-toggle="tooltip" title="Detail Barang" class="label bg-primary"><span class="fa fa-folder-open"></span></small></a>
                        <?php } ?>
                    </td>
                    <td><?php
                        $data3 = mysqli_fetch_array(mysqli_query($koneksi, "select nama_pembeli,kontak_rs from pembeli,barang_pinjam_kirim where pembeli.id=barang_pinjam_kirim.pembeli_id and barang_pinjam_kirim.id=" . $json[$i]['idd'] . ""));
                        echo $data3['nama_pembeli']; ?></td>
                    <td><?php echo $data3['kontak_rs']; ?></td>
                    <td>
                        <a href="#" data-toggle="modal" data-target="#modal-pengiriman<?php echo $json[$i]['idd']; ?>"><small data-toggle="tooltip" title="Detail Barang" class="label bg-primary"><span class="fa fa-folder-open"></span></small></a>
                    </td>
                    <?php
                    if ($json[$i]['tgl_sampai'] != 0000 - 00 - 00) {
                        $bg = "#99FFCC";
                    } else {
                        $bg = "red";
                    }
                    ?>
                    <td bgcolor=<?php echo $bg; ?>>
                        <?php
                        if ($json[$i]['tgl_sampai'] != 0000 - 00 - 00) {
                            echo date("d M Y", strtotime($json[$i]['tgl_sampai']));
                        } else {
                            echo "-";
                        } ?>
                    </td>
                    <td><?php echo $json[$i]['keterangan']; ?></td>
                    <td align="center">
                        <?php if (!isset($_SESSION['user_cs'])) { ?>
                            <?php if (isset($_SESSION['user_administrator']) && isset($_SESSION['pass_administrator']) or isset($_SESSION['user_admin_gudang'])) { ?>
                                <!-- <a href="index.php?page=kirim_pinjam_barang&id_hapus=<?php echo $json[$i]['idd']; ?>" onclick="return confirm('Anda Yakin Akan Menghapus Item Ini ?')"> -->
                                <a href="#" onclick="hapus(<?php echo $json[$i]['idd']; ?>)">
                                    <button class="btn btn-xs btn-danger">
                                        <span data-toggle="tooltip" title="Hapus" class="ion-android-delete"></span>
                                    </button>
                                </a>
                                &nbsp;
                            <?php } ?>
                            <a href="index.php?page=ubah_kirim_pinjam_barang&id=<?php echo $json[$i]['idd']; ?>">
                                <button class="btn btn-xs btn-warning">
                                    <span data-toggle="tooltip" title="Ubah" class="fa fa-edit"></span>
                                </button>
                            </a>
                            <br />
                            <a href="cetak_surat_jalan_pinjam.php?id=<?php echo $json[$i]['idd']; ?>" target="_blank">
                                <button class="btn btn-xs btn-primary">
                                    <span data-toggle="tooltip" title="Cetak Surat Jalan" class="fa fa-print"></span>
                                </button>
                            </a>
                            <br />
                            <?php if ($json[$i]['tgl_sampai'] != 0000 - 00 - 00) { ?>
                                <a href="index.php?page=pilih_barang_pinjam_kembali&id=<?php echo $json[$i]['idd']; ?>&hapus_all=1"><small data-toggle="tooltip" title="" class="label bg-green"> Buat Pengembalian</small></a>
                        <?php }
                        } ?>
                    </td>
                </tr>
                <div class="modal fade" id="modal-detailbarang<?php echo $json[$i]['idd']; ?>">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" align="center">Detail Barang</h4>
                            </div>
                            <form method="post">
                                <div class="modal-body">
                                    <p align="justify">

                                        <?php
                                        $q = mysqli_query($koneksi, "select nama_brg,no_seri_brg,status_kembali,tipe_brg from barang_gudang,barang_gudang_detail,barang_pinjam_kirim_detail where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=barang_pinjam_kirim_detail.barang_gudang_detail_id and barang_pinjam_kirim_id=" . $json[$i]['idd'] . "");
                                        $n = 0;
                                        while ($d1 = mysqli_fetch_array($q)) {
                                            $n++;
                                        ?>
                                            <?php if ($d1['status_kembali'] == 1) { ?>
                                                <font class="pull pull-right">Sudah Kembali</font>
                                            <?php } ?>
                                            <?php echo $n . ". " . $d1['nama_brg'] . "     |    "; ?></td>
                                            <?php echo $d1['tipe_brg'] . "  |  " ?></td>
                                            <?php echo $d1['no_seri_brg']; ?>
                                            <hr />
                                        <?php } ?>

                                    </p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>

                                </div>
                            </form>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>

                <div class="modal fade" id="modal-pengiriman<?php echo $json[$i]['idd']; ?>">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" align="center">Data Pengiriman</h4>
                            </div>
                            <form method="post">
                                <div class="modal-body">
                                    <p align="justify">
                                        <?php
                                        echo "<b>Ekspedisi :</b> <br/>" . $json[$i]['ekspedisi']; ?>
                                        <hr />
                                        <?php echo "<b>Pengiriman Via :</b> <br/>" . $json[$i]['via_pengiriman']; ?>
                                        <hr />
                                        <?php echo "<b>Estimasi Barang Sampai :</b> <br/>"; ?>
                                        <?php
                                        if ($json[$i]['estimasi_barang_sampai'] != 0000 - 00 - 00) {
                                            echo date("d/m/Y", strtotime($json[$i]['estimasi_barang_sampai']));
                                        } ?>
                                        <hr />
                                        <?php echo "<b>Biaya Pengiriman :</b> <br/>" . number_format($json[$i]['biaya_pengiriman'], 0, ',', '.'); ?>

                                    </p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>

                                </div>
                            </form>
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