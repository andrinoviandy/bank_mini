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
                        *,
                        a.id as idd 
                    from
                        gaji_karyawan a left join 
                        karyawan b on b.id = a.karyawan_id
                    where b.nik like ('%$_GET[cari]%') 
                        or b.nama_karyawan like ('%$_GET[cari]%') 
                        or b.tempat_lahir like ('%$_GET[cari]%') 
                        or b.alamat like ('%$_GET[cari]%') 
                        or b.pendidikan_terakhir like ('%$_GET[cari]%') 
                        or b.jabatan like ('%$_GET[cari]%') 
                        or b.divisi like ('%$_GET[cari]%') 
                        or b.email like ('%$_GET[cari]%') 
                    order by a.bulan_tahun DESC, a.id DESC LIMIT $start, $limit";
    } else {
        $sql = "select
                        *,
                        a.id as idd 
                    from
                        gaji_karyawan a left join 
                        karyawan b on b.id = a.karyawan_id 
                    order by a.bulan_tahun DESC, a.id DESC LIMIT $start, $limit";
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
        $sql = "select count(DISTINCT a.id) as jml from
                        gaji_karyawan a left join 
                        karyawan b on b.id = a.karyawan_id
                    where b.nik like ('%$_GET[cari]%') 
                        or b.nama_karyawan like ('%$_GET[cari]%') 
                        or b.tempat_lahir like ('%$_GET[cari]%') 
                        or b.alamat like ('%$_GET[cari]%') 
                        or b.pendidikan_terakhir like ('%$_GET[cari]%') 
                        or b.jabatan like ('%$_GET[cari]%') 
                        or b.divisi like ('%$_GET[cari]%') 
                        or b.email like ('%$_GET[cari]%')";
    } else {
        $sql = "select count(*) as jml from gaji_karyawan";
    }

    $result = mysqli_fetch_array(mysqli_query($koneksi, $sql));
    echo $result['jml'];
    //tutup koneksi ke database
    mysqli_close($koneksi);
}
