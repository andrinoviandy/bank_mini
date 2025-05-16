<?php
include("../config/koneksi_kantin.php");
session_start();
// error_reporting(0);
$sel = mysqli_fetch_array(mysqli_query($koneksi_kantin, "select * from deposit where id = $_POST[id]"));
$s1 = mysqli_query($koneksi_kantin, "update deposit set status = 2, updated_at = current_timestamp() where id = $_POST[id]");
if ($s1) {
    $up = mysqli_query($koneksi_kantin, "update ortu set saldo=saldo+$sel[jumlah] where id=$sel[id_ortu]");
    if ($up) {
        $tglNow = date("Y-m-d H:i:s");
        $pesan = "Saldo kamu berhasil di tambahkan sebesar Rp. {$sel['jumlah']} pada $tglNow";
        mysqli_query($koneksi_kantin, "insert into notifikasi(id_ortu, pesan, jenis, created_at, updated_at) values ('" . $sel['id_ortu'] . "', '$pesan', 'in', current_timestamp(), current_timestamp())");
        die("S");
    } else {
        die("F");
    }
} else {
    die('F');
}

// } else {
//     die('TC&' . number_format($cek['saldo'], 0, ',', '.'));
// }
