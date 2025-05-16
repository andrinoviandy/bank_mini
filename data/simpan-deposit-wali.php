<?php
include("../config/koneksi_kantin.php");
session_start();
// error_reporting(0);
$status = 1;
if (isset($_POST['bank']) && $_POST['bank'] == 'Manual Petugas') {
    $status = 2;
}
$s1 = mysqli_query($koneksi_kantin, "insert into deposit(id_ortu, jumlah, bank, status, created_at) values('" . $_POST['id_ortu'] . "','" . str_replace(".", "", $_POST['jumlah']) . "','" . $_POST['bank'] . "', $status, current_timestamp())");

if ($s1) {
    if ($status == 2) {
        $up = mysqli_query($koneksi_kantin, "update ortu set saldo=saldo+" . str_replace(".", "", $_POST['jumlah']) . " where id=$_POST[id_ortu]");
        if ($up) {
            $tglNow = date("Y-m-d H:i:s");
            $pesan = "Saldo kamu berhasil di tambahkan sebesar Rp. {$_POST['jumlah']} pada $tglNow";
            mysqli_query($koneksi_kantin, "insert into notifikasi(id_ortu, pesan, jenis, created_at, updated_at) values ('" . $_POST['id_ortu'] . "', '$pesan', 'in', current_timestamp(), current_timestamp())");
            die("S");
        } else {
            die("F");
        }
    } else {
        die("S");
    }
} else {
    die('GD');
}

// } else {
//     die('TC&' . number_format($cek['saldo'], 0, ',', '.'));
// }
