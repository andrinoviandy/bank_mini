<?php
error_reporting(0);
header("Content-type:application/json");

//koneksi ke database
require("../config/koneksi.php");
require("../config/koneksi_kantin.php");
$query = mysqli_query($koneksi, "SELECT jumlah_limit FROM limiter");
list($surat_masuk) = mysqli_fetch_array($query);
//pagging
$limit = $surat_masuk;

//menampilkan data dari database, table tb_anggota
if (isset($_GET['start'])) {
    $start = mysqli_real_escape_string($koneksi, $_GET['start']);
    if (isset($_GET['cari'])) {
        $sql = "select
                        a.*,
                        b.nama,
                        a.id as idd 
                    from
                        deposit a inner join guru b on b.id = a.id_guru 
                    where a.status IN ($_GET[status]) and (b.nama like ('%$_GET[cari]%') 
                        or b.jabatan like ('%$_GET[cari]%') 
                        or b.whatsapp like ('%$_GET[cari]%')) 
                    order by a.created_at desc LIMIT $start, $limit";
    } else {
        $sql = "select
                        a.*,
                        b.nama,
                        a.id as idd 
                    from
                        deposit a inner join guru b on b.id = a.id_guru  
                    where a.status IN ($_GET[status]) 
                    order by a.created_at desc LIMIT $start, $limit";
    }
    $result = mysqli_query($koneksi_kantin, $sql) or die("Error " . mysqli_error($koneksi_kantin));

    while ($row = mysqli_fetch_assoc($result)) {
        $ArrAnggota[] = $row;
    }

    echo json_encode($ArrAnggota, JSON_PRETTY_PRINT);

    //tutup koneksi ke database
    mysqli_close($koneksi_kantin);
} else {
    // untuk jumlah
    if (isset($_GET['cari'])) {
        $sql = "select
                        count(a.id) as jml 
                    from
                        deposit a inner join guru b on b.id = a.id_guru 
                    where a.status IN ($_GET[status]) and (b.nama like ('%$_GET[cari]%') 
                        or b.jabatan like ('%$_GET[cari]%') 
                        or b.whatsapp like ('%$_GET[cari]%'))";
    } else {
        $sql = "select count(a.id) as jml from deposit a inner join guru b on b.id = a.id_guru where a.status IN ($_GET[status])";
    }

    $result = mysqli_fetch_array(mysqli_query($koneksi_kantin, $sql));
    echo $result['jml'];
    //tutup koneksi ke database
    mysqli_close($koneksi_kantin);
}
