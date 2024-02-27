<?php

require("config/koneksi.php");
$data = mysqli_fetch_array(mysqli_query($koneksi, "select * from barang_gudang,barang_gudang_detail,barang_gudang_detail_rusak where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=barang_gudang_detail_rusak.barang_gudang_detail_id and barang_gudang_detail.id=$_GET[id_gudang_detail]"));
?>
<html>
    <head>
        <meta http-equiv=\"Content-Type\" content=\"text/html; charset=Windows-1252\">
        <title>Cetak Progress Perbaikan Alkes</title>
        <style>
         .mytable{
                border:1px solid black; 
                border-collapse: collapse;
                width: 100%;
				border-color:#000099;
            }
			.mytable2{
                border:1px solid black; 
                border-collapse: collapse;
                border-color:#000099;
            }
            
        </style>
        <link href='logo.png' rel='icon'>
    </head>
    <body onLoad="window.print();" style="color:#000099">
    <table width="100%">
  <tr>
    <td width="47%" rowspan="2" valign="top"><img src="img/kop.png" width="340px" height="auto" /></td>
    <td width="3%">&nbsp;</td>
    <td width="50%" align="center"><font color="#000099" style="font-size:20px"><b>DETAIL PROGRESS<br>REPORT</b></font></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="center"><table width="300px" class="mytable2">
      <tr>
        <td height="30px"><strong>&nbsp;&nbsp;No :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/CR/TECH/KU/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/20</strong></td>
      </tr>
    </table></td>
  </tr>
</table>
    <br />
<strong>Equipment Data</strong>
<br />
<table class="mytable">
  <tr valign="top">
    <td width="50%" style="padding:10px"><table width="100%">
      <tr height="30px">
        <td width="41%" valign="top">Equipment Name</td>
        <td width="5%" valign="top">:</td>
        <td width="54%" valign="top"><?php echo $data['nama_brg']; ?></td>
      </tr>
      <tr height="30px">
        <td valign="top">Model / Type</td>
        <td valign="top">:</td>
        <td valign="top"><?php echo $data['tipe_brg']; ?></td>
      </tr>
    </table></td>
    <td width="50%" style="padding:10px"><table width="100%">
      <tr height="30px">
        <td width="39%" valign="top">Brand</td>
        <td width="5%" valign="top">:</td>
        <td width="56%" valign="top"><?php echo $data['merk_brg']; ?></td>
      </tr>
      <tr height="30px">
        <td valign="top">Serial Number</td>
        <td valign="top">:</td>
        <td valign="top"><?php echo $data['no_seri_brg']; ?></td>
      </tr>
    </table></td>
  </tr>
  <tr valign="top">
    <td colspan="2" style="padding-left:14px">Problem :</td>
  </tr>
  <tr valign="top">
    <td colspan="2" style="padding:14px"><table class="mytable" width="100%">
      <tr>
        <td style="padding:10px"><?php echo $data['kerusakan_alat']; ?></td>
      </tr>
    </table></td>
  </tr>
  </table>
<br />

<strong>Detail Progress</strong>
<br />
<table border="1" class="mytable">
  <tr>
    <td width="20%" align="center" style="padding:10px"><strong>Tanggal</strong></td>
    <td width="30%" align="center"><strong>Desk. Kerusakan</strong></td>
    <td width="30%" align="center"><strong>Desk. Perbaikan</strong></td>
  </tr>
 <?php
 $q = mysqli_query($koneksi, "select * from barang_gudang_detail_rusak_progress where barang_gudang_detail_rusak_id=$_GET[id_ubah] order by tgl_progress ASC"); 
 while ($d = mysqli_fetch_array($q)) {
 ?>
  <tr>
    <td align="center" style="padding:5px"><?php echo date("d M Y",strtotime($d['tgl_progress'])); ?></td>
    <td style="padding:5px"><?php echo $d['deskripsi_kerusakan']; ?></td>
    <td style="padding:5px"><?php echo $d['deskripsi_perbaikan']; ?></td>
  </tr>
<?php } ?>
</table>
<br />
<div>
<table border="1" class="mytable">
  <tr>
    <td width="30%"><strong>&nbsp;&nbsp;Date :</strong></td>
    <td width="35%"><strong>&nbsp;&nbsp;Receipt By :</strong></td>
    <td width="35%"><strong>&nbsp;&nbsp;Handle By Engineer :</strong></td>
  </tr>
  <tr>
    <td rowspan="2">&nbsp;</td>
    <td height="90">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<script type="text/javascript">
    function PrintPage() {
      window.print();
    }
    window.addEventListener('DOMContentLoaded', (event) => {
      PrintPage()
      setTimeout(function() {
        window.close()
      }, 750)
    });
  </script>
    </body>
</html>
