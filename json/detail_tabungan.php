<?php
error_reporting(0);
header("Content-type:application/json");

//koneksi ke database
require("../config/koneksi.php");
$query = mysqli_query($koneksi, "SELECT jumlah_limit FROM limiter");
list($surat_masuk) = mysqli_fetch_array($query);
//pagging
$limit = $surat_masuk;
$start = mysqli_real_escape_string($koneksi, $_GET['start']);

//menampilkan data dari database, table tb_anggota
if (isset($_GET['start'])) {
    if (isset($_GET['cari'])) {
        $sql = "select
                        d.tgl_transaksi,
                        CASE WHEN d.setor_ambil = 1 THEN d.nominal END AS nominal_setor,
                        CASE WHEN d.setor_ambil = 2 THEN d.nominal END AS nominal_ambil,
                        d.keterangan,
                        d.operator,
                        d.id as idd 
                    from
                        tabungan_setor_ambil d where d.tabungan_id = '" . $_GET['id'] . "' and (d.keterangan like ('%$_GET[cari]%') 
                        or d.operator like ('%$_GET[cari]%') or DATE_FORMAT(d.tgl_transaksi, '%d-%m-%Y') like ('%$_GET[cari]%')) 
                    order by d.tgl_transaksi desc, d.created_at desc LIMIT $start, $limit";
    } else {
        $sql = "select
                        d.tgl_transaksi,
                        CASE WHEN d.setor_ambil = 1 THEN d.nominal END AS nominal_setor,
                        CASE WHEN d.setor_ambil = 2 THEN d.nominal END AS nominal_ambil,
                        d.keterangan,
                        d.operator,
                        d.id as idd 
                    from
                        tabungan_setor_ambil d where d.tabungan_id = '" . $_GET['id'] . "' 
                    order by d.tgl_transaksi desc, d.created_at desc LIMIT $start, $limit";
    }
    $result = mysqli_query($koneksi, $sql) or die("Error " . mysqli_error($koneksi));

    while ($row = mysqli_fetch_assoc($result)) {
        $ArrAnggota[] = $row;
    }

    echo json_encode($ArrAnggota, JSON_PRETTY_PRINT);

    //tutup koneksi ke database
    mysqli_close($koneksi);
} else {
    // untuk jumlah
    if (isset($_GET['cari'])) {
        $sql = "select
                        count(d.id) as jml 
                    from
                        tabungan_setor_ambil d  
                    where (d.keterangan like ('%$_GET[cari]%') 
                        or d.operator like ('%$_GET[cari]%') or DATE_FORMAT(d.tgl_transaksi, '%d-%m-%Y') like ('%$_GET[cari]%')) and d.tabungan_id = '$_GET[id]'";
    } else {
        $sql = "select count(a.id) as jml from tabungan_setor_ambil a where a.tabungan_id = '$_GET[id]'";
    }

    $result = mysqli_fetch_array(mysqli_query($koneksi, $sql));
    echo $result['jml'];
    //tutup koneksi ke database
    mysqli_close($koneksi);
}
