<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Rekapan Penjualan Alkes - " . date("d/m/Y", strtotime($_GET['tgl1'])) . " - " . date("d/m/Y", strtotime($_GET['tgl2'])) . ".xls");
error_reporting(0);
?>
<?php require("config/koneksi.php"); ?>
<h2 align="center" style="margin-bottom:0px"><strong>PT. CIPTA VARIA KHARISMA UTAMA</strong></h2>
<center>
  Rekapan Penjualan Alkes
  <br />
  Tanggal : <?php echo date("d/m/Y", strtotime($_GET['tgl1'])) . " - " . date("d/m/Y", strtotime($_GET['tgl2'])) ?>
  <br />
  Filter :
  <?php
  if ($_GET['filter'] == '1') {
    $dt = mysqli_fetch_array(mysqli_query($koneksi, "select *,barang_dijual.id as idd from barang_dijual,barang_dijual_qty,barang_gudang,pembeli,alamat_provinsi,alamat_kabupaten,alamat_kecamatan where barang_dijual.id=barang_dijual_qty.barang_dijual_id and barang_gudang.id=barang_dijual_qty.barang_gudang_id and pembeli.id=barang_dijual.pembeli_id and barang_dijual.status_awal=1 and pembeli.provinsi_id = alamat_provinsi.id and pembeli.kabupaten_id = alamat_kabupaten.id and pembeli.kecamatan_id = alamat_kecamatan.id and pembeli.id = $_GET[pembeli] and tgl_jual between '$_GET[tgl1]' and '$_GET[tgl2]' group by no_po_jual order by tgl_jual DESC, barang_dijual.id DESC"));
    echo $dt['nama_pembeli'];
  } else if ($_GET['filter'] == '2') {
    if ($_GET['provinsi']) {
      if ($_GET['provinsi'] == 'all') {
        echo "Semua Provinsi";
      } else {
        $dt1 = mysqli_fetch_array(mysqli_query($koneksi, "select nama_provinsi from alamat_provinsi where id = $_GET[provinsi]"));
        echo "Provinsi " . ucwords(strtolower($dt1['nama_provinsi']));
        if ($_GET['kabupaten'] != 'all') {
          $dt2 = mysqli_fetch_array(mysqli_query($koneksi, "select nama_kabupaten from alamat_kabupaten where id = $_GET[kabupaten]"));
          echo " Kabupaten " . ucwords(strtolower($dt2['nama_kabupaten']));
          if ($_GET['kecamatan'] != 'all') {
            $dt3 = mysqli_fetch_array(mysqli_query($koneksi, "select nama_kecamatan from alamat_kecamatan where id = $_GET[kecamatan]"));
            echo " Kecamatan " . ucwords(strtolower($dt3['nama_kecamatan']));
          }
        }
      }
    }
  } else {
    echo "-";
  }
  ?>
</center>
<br />
<table width="100%" id="" border="1">
  <thead>
    <tr>
      <td colspan="16" align="right">Total Keseluruhan : </td>
      <td align="right">
        <?php
        if ($_GET['filter'] == '1') {
          $query2 = mysqli_query($koneksi, "select sum(qty_jual*harga_jual_saat_itu) as totall from barang_dijual,barang_dijual_qty where barang_dijual.id=barang_dijual_qty.barang_dijual_id and status_awal = 1 and pembeli_id = " . $_GET['pembeli'] . " and barang_dijual.tgl_jual between '" . $_GET['tgl1'] . "' and '" . $_GET['tgl2'] . "'");
          $data2 = mysqli_fetch_array($query2);
        } else if ($_GET['filter'] == '2') {
          if ($_GET['provinsi'] == 'all') {
            $query2 = mysqli_query($koneksi, "select sum(qty_jual*harga_jual_saat_itu) as totall from barang_dijual,barang_dijual_qty,pembeli where barang_dijual.id=barang_dijual_qty.barang_dijual_id and status_awal = 1 and pembeli.id=barang_dijual.pembeli_id and barang_dijual.tgl_jual between '" . $_GET['tgl1'] . "' and '" . $_GET['tgl2'] . "'");
            $data2 = mysqli_fetch_array($query2);
          } else {
            if ($_GET['kabupaten'] == 'all') {
              $query2 = mysqli_query($koneksi, "select sum(qty_jual*harga_jual_saat_itu) as totall from barang_dijual,barang_dijual_qty,pembeli where barang_dijual.id=barang_dijual_qty.barang_dijual_id and pembeli.id=barang_dijual.pembeli_id and status_awal = 1 and pembeli.provinsi_id = " . $_GET['provinsi'] . " and barang_dijual.tgl_jual between '" . $_GET['tgl1'] . "' and '" . $_GET['tgl2'] . "'");
              $data2 = mysqli_fetch_array($query2);
            } else {
              if ($_GET['kecamatan'] == 'all') {
                $query2 = mysqli_query($koneksi, "select sum(qty_jual*harga_jual_saat_itu) as totall from barang_dijual,barang_dijual_qty,pembeli where barang_dijual.id=barang_dijual_qty.barang_dijual_id and pembeli.id=barang_dijual.pembeli_id and status_awal = 1 and pembeli.kabupaten_id = " . $_GET['kabupaten'] . " and barang_dijual.tgl_jual between '" . $_GET['tgl1'] . "' and '" . $_GET['tgl2'] . "'");
                $data2 = mysqli_fetch_array($query2);
              } else {
                $query2 = mysqli_query($koneksi, "select sum(qty_jual*harga_jual_saat_itu) as totall from barang_dijual,barang_dijual_qty,pembeli where barang_dijual.id=barang_dijual_qty.barang_dijual_id and pembeli.id=barang_dijual.pembeli_id and status_awal = 1 and pembeli.provinsi_id = " . $_GET['provinsi'] . " and pembeli.kabupaten_id = " . $_GET['kabupaten'] . " and pembeli.kecamatan_id = " . $_GET['kecamatan'] . " and barang_dijual.tgl_jual between '" . $_GET['tgl1'] . "' and '" . $_GET['tgl2'] . "'");
                $data2 = mysqli_fetch_array($query2);
              }
            }
          }
        } else {
          $query2 = mysqli_query($koneksi, "select sum(qty_jual*harga_jual_saat_itu) as totall from barang_dijual,barang_dijual_qty where barang_dijual.id=barang_dijual_qty.barang_dijual_id and status_awal = 1 and barang_dijual.tgl_jual between '" . $_GET['tgl1'] . "' and '" . $_GET['tgl2'] . "'");
          $data2 = mysqli_fetch_array($query2);
        }

        echo number_format($data2['totall'], 2, ',', '.');
        ?>
      </td>
      <!-- <td colspan="7" align="right">Neto Keseluruhan : </td>
      <td>
      <?php
      if ($_GET['filter'] == '1') {
        $query22 = mysqli_query($koneksi, "select sum(neto) as totall from barang_dijual,barang_dijual_qty where barang_dijual.id=barang_dijual_qty.barang_dijual_id and status_awal = 1 and pembeli_id = " . $_GET['pembeli'] . " and barang_dijual.tgl_jual between '" . $_GET['tgl1'] . "' and '" . $_GET['tgl2'] . "'");
        $data22 = mysqli_fetch_array($query22);
      } else if ($_GET['filter'] == '2') {
        if ($_GET['provinsi'] == 'all') {
          $query22 = mysqli_query($koneksi, "select sum(neto) as totall from barang_dijual,barang_dijual_qty,pembeli where barang_dijual.id=barang_dijual_qty.barang_dijual_id and status_awal = 1 and pembeli.id=barang_dijual.pembeli_id and barang_dijual.tgl_jual between '" . $_GET['tgl1'] . "' and '" . $_GET['tgl2'] . "'");
          $data22 = mysqli_fetch_array($query22);
        } else {
          if ($_GET['kabupaten'] == 'all') {
            $query22 = mysqli_query($koneksi, "select sum(neto) as totall from barang_dijual,barang_dijual_qty,pembeli where barang_dijual.id=barang_dijual_qty.barang_dijual_id and pembeli.id=barang_dijual.pembeli_id and status_awal = 1 and pembeli.provinsi_id = " . $_GET['provinsi'] . " and barang_dijual.tgl_jual between '" . $_GET['tgl1'] . "' and '" . $_GET['tgl2'] . "'");
            $data22 = mysqli_fetch_array($query22);
          } else {
            if ($_GET['kecamatan'] == 'all') {
              $query22 = mysqli_query($koneksi, "select sum(neto) as totall from barang_dijual,barang_dijual_qty,pembeli where barang_dijual.id=barang_dijual_qty.barang_dijual_id and pembeli.id=barang_dijual.pembeli_id and status_awal = 1 and pembeli.kabupaten_id = " . $_GET['kabupaten'] . " and barang_dijual.tgl_jual between '" . $_GET['tgl1'] . "' and '" . $_GET['tgl2'] . "'");
              $data22 = mysqli_fetch_array($query22);
            } else {
              $query22 = mysqli_query($koneksi, "select sum(neto) as totall from barang_dijual,barang_dijual_qty,pembeli where barang_dijual.id=barang_dijual_qty.barang_dijual_id and pembeli.id=barang_dijual.pembeli_id and status_awal = 1 and pembeli.provinsi_id = " . $_GET['provinsi'] . " and pembeli.kabupaten_id = " . $_GET['kabupaten'] . " and pembeli.kecamatan_id = " . $_GET['kecamatan'] . " and barang_dijual.tgl_jual between '" . $_GET['tgl1'] . "' and '" . $_GET['tgl2'] . "'");
              $data22 = mysqli_fetch_array($query22);
            }
          }
        }
      } else {
        $query22 = mysqli_query($koneksi, "select sum(neto) as totall from barang_dijual,barang_dijual_qty where barang_dijual.id=barang_dijual_qty.barang_dijual_id and status_awal = 1 and barang_dijual.tgl_jual between '" . $_GET['tgl1'] . "' and '" . $_GET['tgl2'] . "'");
        $data22 = mysqli_fetch_array($query22);
      }

      echo number_format($data22['totall'], 2, ',', '.');
      ?>
      </td> -->
      <td colspan="10"></td>
    </tr>
    <tr>
      <td colspan="27" style="height: 5px; background-color:cadetblue"></td>
    </tr>
    <tr>
      <th align="center">No</th>
      <th align="center" width="5%"><strong>Status PO</strong></th>
      <th align="center"><strong>Tanggal_Jual</strong></th>
      <th align="center">No PO</th>
      <th align="center">No_Kontrak</th>
      <!--<th align="center">No_PO</th>-->
      <th align="center">Nama Barang</th>
      <th align="center">Tipe</th>
      <th align="center">Qty</th>
      <th align="center">No Seri</th>
      <th align="center"><strong>Dinas/RS/Puskemas/Klinik</strong></th>
      <th align="center">Provinsi</th>
      <th align="center">Kabupaten</th>
      <th align="center">Kecamatan</th>
      <th align="center">Nama Pemakai</th>
      <th align="center">Marketing</th>
      <th align="center">Subdis</th>
      <th align="center">Total Harga</th>
      <th align="center">Ongkir</th>
      <th align="center">DPP</th>
      <th align="center">Diskon</th>
      <th align="center">PPN</th>
      <th align="center">PPh</th>
      <th align="center">Zakat</th>
      <th align="center">Biaya Bank</th>
      <th align="center">Neto</th>
      <th align="center">Fee Subdis</th>
      <th align="center">Status Pengiriman</th>
    </tr>
  </thead>
  <?php

  // membuka file JSON
  if ($_GET['filter'] == '1') {
    $file = file_get_contents("http://localhost/BANK/json/rekapan_penjualan.php?filter=1&pembeli=" . $_GET['pembeli'] . "&tgl1=" . $_GET['tgl1'] . "&tgl2=" . $_GET['tgl2'] . "");
  } else if ($_GET['filter'] == '2') {
    if ($_GET['provinsi'] == 'all') {
      $file = file_get_contents("http://localhost/BANK/json/rekapan_penjualan.php?tgl1=" . $_GET['tgl1'] . "&tgl2=" . $_GET['tgl2'] . "");
    } else {
      if ($_GET['kabupaten'] == 'all') {
        $file = file_get_contents("http://localhost/BANK/json/rekapan_penjualan.php?filter=2&provinsi=" . $_GET['provinsi'] . "&tgl1=" . $_GET['tgl1'] . "&tgl2=" . $_GET['tgl2'] . "");
      } else {
        if ($_GET['kecamatan'] == 'all') {
          $file = file_get_contents("http://localhost/BANK/json/rekapan_penjualan.php?filter=2&provinsi=" . $_GET['provinsi'] . "&kabupaten=" . $_GET['kabupaten'] . "&tgl1=" . $_GET['tgl1'] . "&tgl2=" . $_GET['tgl2'] . "");
        } else {
          $file = file_get_contents("http://localhost/BANK/json/rekapan_penjualan.php?filter=2&provinsi=" . $_GET['provinsi'] . "&kabupaten=" . $_GET['kabupaten'] . "&kecamatan=" . $_GET['kecamatan'] . "&tgl1=" . $_GET['tgl1'] . "&tgl2=" . $_GET['tgl2'] . "");
        }
      }
    }
  } else {
    $file = file_get_contents("http://localhost/BANK/json/rekapan_penjualan.php?tgl1=" . $_GET['tgl1'] . "&tgl2=" . $_GET['tgl2'] . "");
  }
  $json = json_decode($file, true);
  $jml = count($json);
  for ($i = 0; $i < $jml; $i++) {
    //echo "Nama Barang ke-".$i." : " . $json[$i]['nama_brg'] . "<br />";
    //echo 'Nama Anggota ke-3 : ' . $json['2']['nama_brg'];
  ?>
    <tr>
      <td align="center" valign="top"><?php echo $i + 1; ?></td>
      <td valign="top">
        <?php $jm_deal = mysqli_num_rows(mysqli_query($koneksi, "select * from barang_dijual where no_po_jual='" . $json[$i]['no_po_jual'] . "' and status_deal=1"));
        if ($jm_deal != 0) {
          echo "Sudah Deal";
        } else {
          echo "Belum Deal";
        } ?>
      </td>
      <td valign="top">
        <?php if ($json[$i]['tgl_jual'] != '0000-00-00') {
          echo date("d F Y", strtotime($json[$i]['tgl_jual']));
        }
        ?>
      </td>
      <td valign="top"><?php echo $json[$i]['no_po_jual'];
                        ?></td>
      <td valign="top"><?php echo $json[$i]['no_kontrak'];
                        ?></td>
      <td colspan="4" valign="top">
        <table border="1">
          <?php
          if ($jm_deal === 0) {
            $d2 = mysqli_fetch_array(mysqli_query($koneksi, "select *,barang_dijual.id as idd from barang_dijual_qty,barang_dijual,barang_gudang where barang_dijual.id=barang_dijual_qty.barang_dijual_id and barang_gudang.id=barang_dijual_qty.barang_gudang_id and barang_dijual.no_po_jual='" . $json[$i]['no_po_jual'] . "' order by barang_dijual.id DESC LIMIT 1"));
            $q23 = mysqli_query($koneksi, "select *,barang_dijual_qty.id as id_det_jual from barang_dijual_qty,barang_dijual,barang_gudang where barang_dijual.id=barang_dijual_qty.barang_dijual_id and barang_gudang.id=barang_dijual_qty.barang_gudang_id and barang_dijual.id=" . $d2['idd'] . "");
            // echo "<center><em>Riwayat Terakhir</em></center>";
          } else {
            $q23 = mysqli_query($koneksi, "select *,barang_dijual_qty.id as id_det_jual from barang_dijual_qty,barang_dijual,barang_gudang where barang_dijual.id=barang_dijual_qty.barang_dijual_id and barang_gudang.id=barang_dijual_qty.barang_gudang_id and barang_dijual.no_po_jual='" . $json[$i]['no_po_jual'] . "' and status_deal=1");
          }
          $n2 = 0;
          while ($d1 = mysqli_fetch_array($q23)) {
            $n2++;
          ?>
            <tr>
              <td valign="top"><?php echo $d1['nama_brg'] ?></td>
              <td valign="top"><?php echo $d1['tipe_brg'] ?></td>
              <td valign="top" align="center"><?php echo $d1['qty_jual'] ?>
              </td>
              <td>
                <table border="1">
                  <?php
                  $q_serial = mysqli_query($koneksi, "select * from barang_dikirim_detail b inner join barang_dikirim a on a.id = b.barang_dikirim_id inner join barang_gudang_detail c on c.id = b.barang_gudang_detail_id where a.barang_dijual_id = " . $d1['barang_dijual_id'] . "");
                  while ($dd = mysqli_fetch_array($q_serial)) {
                  ?>
                    <tr>
                      <td><?php echo $dd['no_seri_brg'] ?></td>
                    </tr>
                  <?php } ?>
                </table>
              </td>
            </tr>
          <?php } ?>
        </table>
      </td>
      <td valign="top"><?php
                        $data_pem = mysqli_fetch_array(mysqli_query($koneksi, "select * from barang_dijual,pembeli,pemakai,alamat_provinsi,alamat_kabupaten,alamat_kecamatan where pembeli.id=barang_dijual.pembeli_id and pemakai.id=barang_dijual.pemakai_id and alamat_provinsi.id = pembeli.provinsi_id and alamat_kabupaten.id = pembeli.kabupaten_id and alamat_kecamatan.id = pembeli.kecamatan_id and barang_dijual.id=" . $json[$i]['idd'] . ""));
                        echo $data_pem['nama_pembeli']; ?></td>
      <td valign="top"><?php echo $data_pem['nama_provinsi']; ?></td>
      <td valign="top"><?php echo $data_pem['nama_kabupaten']; ?></td>
      <td valign="top"><?php echo $data_pem['nama_kecamatan']; ?></td>
      <td valign="top"><?php echo $data_pem['nama_pemakai']; ?></td>
      <td align="center" valign="top"><?php echo $json[$i]['marketing']; ?></td>
      <td align="center" valign="top"><?php echo $json[$i]['subdis']; ?></td>
      <td valign="top"><?php
                        if ($jm_deal === 0) {
                          $data_deal = mysqli_fetch_array(mysqli_query($koneksi, "select *,barang_dijual.id as idd,barang_dijual_qty.id as id_det_jual from barang_dijual_qty,barang_dijual,barang_gudang where barang_dijual.id=barang_dijual_qty.barang_dijual_id and barang_gudang.id=barang_dijual_qty.barang_gudang_id and barang_dijual.no_po_jual='" . $json[$i]['no_po_jual'] . "' order by barang_dijual.id DESC LIMIT 1"));
                        } else {
                          $data_deal = mysqli_fetch_array(mysqli_query($koneksi, "select *,barang_dijual.id as idd,barang_dijual_qty.id as id_det_jual from barang_dijual_qty,barang_dijual,barang_gudang where barang_dijual.id=barang_dijual_qty.barang_dijual_id and barang_gudang.id=barang_dijual_qty.barang_gudang_id and barang_dijual.no_po_jual='" . $json[$i]['no_po_jual'] . "' and status_deal=1"));
                        }
                        echo $data_deal['total_harga'];
                        //echo number_format($data_deal['total_harga'],0,',','.'); 
                        ?></td>
      <td valign="top"><?php
                        echo $data_deal['ongkir'];
                        //echo number_format($data_deal['ongkir'],0,',','.'); 
                        ?></td>
      <td valign="top"><?php
                        $dpp = $json[$i]['include_dpp'] == 1 ? ($data_deal['total_harga'] + $data_deal['ongkir']) / 1.1 : 0;
                        $total_dpp = $json[$i]['include_dpp'] == 1 ? $dpp : $data_deal['total_harga'];
                        echo $dpp;
                        //echo number_format($dpp,2,',','.'); 
                        ?></td>
      <td valign="top"><?php echo $data_deal['diskon_jual'] . " %"; ?>
      </td>
      <td valign="top"><?php echo $data_deal['ppn_jual'] . " %"; ?>
        <?php echo
        " (" . ($data_deal['ppn_jual'] / 100) * ($total_dpp) . ")";  //"(".number_format(($data_deal['ppn_jual']/100)*($dpp),2,',','.').")"; 
        ?>
      </td>
      <td valign="top"><?php echo $data_deal['pph'] . " %"; ?>
        <?php echo
        " (" . $data_deal['pph'] / 100 * $dpp . ")";  //"(".number_format($data_deal['pph']/100*$dpp,2,',','.').")"; 
        ?>
      </td>
      <td valign="top">
        <?php echo $data_deal['zakat'] . " %"; ?>
        <?php echo
        " (" . $data_deal['zakat'] / 100 * $dpp . ")";  //"(".number_format($data_deal['zakat']/100*$dpp,2,',','.').")"; 
        ?></td>
      <td valign="top"><?php echo
                        $data_deal['biaya_bank'];
                        //number_format($data_deal['biaya_bank'],0,',','.'); 
                        ?></td>
      <td valign="top"><strong><?php echo
                                $data_deal['neto'];
                                //number_format($data_deal['neto'],0,',','.'); 
                                ?></strong></td>
      <td valign="top"><?php
                        $dpp_m = $data_deal['total_harga'] / 1.1;
                        //$ppn_m = $dpp_m * $json[$i]['ppn_jual']/100;
                        $pph_m = $dpp_m * $data_deal['pph'] / 100;
                        $zakat_m = $dpp_m * $data_deal['zakat'] / 100;
                        $biaya_bank_m = $data_deal['biaya_bank'];
                        $fee = ($dpp_m - ($pph_m + $zakat_m + $biaya_bank_m)) * $data_deal['diskon_jual'] / 100;
                        echo number_format($fee, 0, ',', '.'); ?></td>

      <td align="center" valign="top"><?php
                                      $ttl = mysqli_num_rows(mysqli_query($koneksi, "select * from barang_dikirim where barang_dijual_id=" . $data_deal['idd'] . ""));
                                      $brg_sm = mysqli_fetch_array(mysqli_query($koneksi, "select tgl_sampai from barang_dikirim where barang_dijual_id=" . $data_deal['idd'] . ""));
                                      $jml_deal = mysqli_num_rows(mysqli_query($koneksi, "select * from barang_dijual where status_deal=1 and no_po_jual='" . $json[$i]['no_po_jual'] . "'"));
                                      if ($ttl > 0) {
                                        if ($brg_sm['tgl_sampai'] != '0000-00-00') {
                                          echo "<span class='label bg-green'>Sudah Sampai</span>";
                                          echo " (" . date("d/m/Y", strtotime($brg_sm['tgl_sampai'])) . ")";
                                        } else {
                                          echo "<span class='label bg-yellow'>Belum Sampai</span>";
                                        }
                                      } else {
                                        echo "<span class='label bg-gray'>Belum Dikirim</span>";
                                      }
                                      ?></td>
    </tr>
  <?php } ?>
  <tr>
    <td colspan="27" style="height: 5px; background-color:cadetblue"></td>
  </tr>
  <tr>
    <td colspan="16" align="right">Total Keseluruhan : </td>
    <td align="right">
      <?php
      if ($_GET['filter'] == '1') {
        $query2 = mysqli_query($koneksi, "select sum(qty_jual*harga_jual_saat_itu) as totall from barang_dijual,barang_dijual_qty where barang_dijual.id=barang_dijual_qty.barang_dijual_id and status_awal = 1 and pembeli_id = " . $_GET['pembeli'] . " and barang_dijual.tgl_jual between '" . $_GET['tgl1'] . "' and '" . $_GET['tgl2'] . "'");
        $data2 = mysqli_fetch_array($query2);
      } else if ($_GET['filter'] == '2') {
        if ($_GET['provinsi'] == 'all') {
          $query2 = mysqli_query($koneksi, "select sum(qty_jual*harga_jual_saat_itu) as totall from barang_dijual,barang_dijual_qty,pembeli where barang_dijual.id=barang_dijual_qty.barang_dijual_id and status_awal = 1 and pembeli.id=barang_dijual.pembeli_id and barang_dijual.tgl_jual between '" . $_GET['tgl1'] . "' and '" . $_GET['tgl2'] . "'");
          $data2 = mysqli_fetch_array($query2);
        } else {
          if ($_GET['kabupaten'] == 'all') {
            $query2 = mysqli_query($koneksi, "select sum(qty_jual*harga_jual_saat_itu) as totall from barang_dijual,barang_dijual_qty,pembeli where barang_dijual.id=barang_dijual_qty.barang_dijual_id and pembeli.id=barang_dijual.pembeli_id and status_awal = 1 and pembeli.provinsi_id = " . $_GET['provinsi'] . " and barang_dijual.tgl_jual between '" . $_GET['tgl1'] . "' and '" . $_GET['tgl2'] . "'");
            $data2 = mysqli_fetch_array($query2);
          } else {
            if ($_GET['kecamatan'] == 'all') {
              $query2 = mysqli_query($koneksi, "select sum(qty_jual*harga_jual_saat_itu) as totall from barang_dijual,barang_dijual_qty,pembeli where barang_dijual.id=barang_dijual_qty.barang_dijual_id and pembeli.id=barang_dijual.pembeli_id and status_awal = 1 and pembeli.kabupaten_id = " . $_GET['kabupaten'] . " and barang_dijual.tgl_jual between '" . $_GET['tgl1'] . "' and '" . $_GET['tgl2'] . "'");
              $data2 = mysqli_fetch_array($query2);
            } else {
              $query2 = mysqli_query($koneksi, "select sum(qty_jual*harga_jual_saat_itu) as totall from barang_dijual,barang_dijual_qty,pembeli where barang_dijual.id=barang_dijual_qty.barang_dijual_id and pembeli.id=barang_dijual.pembeli_id and status_awal = 1 and pembeli.provinsi_id = " . $_GET['provinsi'] . " and pembeli.kabupaten_id = " . $_GET['kabupaten'] . " and pembeli.kecamatan_id = " . $_GET['kecamatan'] . " and barang_dijual.tgl_jual between '" . $_GET['tgl1'] . "' and '" . $_GET['tgl2'] . "'");
              $data2 = mysqli_fetch_array($query2);
            }
          }
        }
      } else {
        $query2 = mysqli_query($koneksi, "select sum(qty_jual*harga_jual_saat_itu) as totall from barang_dijual,barang_dijual_qty where barang_dijual.id=barang_dijual_qty.barang_dijual_id and status_awal = 1 and barang_dijual.tgl_jual between '" . $_GET['tgl1'] . "' and '" . $_GET['tgl2'] . "'");
        $data2 = mysqli_fetch_array($query2);
      }

      echo number_format($data2['totall'], 2, ',', '.');
      ?>
    </td>
    <!-- <td colspan="7" align="right">Neto Keseluruhan : </td>
    <td>
      <?php
      if ($_GET['filter'] == '1') {
        $query22 = mysqli_query($koneksi, "select sum(neto) as totall from barang_dijual,barang_dijual_qty where barang_dijual.id=barang_dijual_qty.barang_dijual_id and status_awal = 1 and pembeli_id = " . $_GET['pembeli'] . " and barang_dijual.tgl_jual between '" . $_GET['tgl1'] . "' and '" . $_GET['tgl2'] . "'");
        $data22 = mysqli_fetch_array($query22);
      } else if ($_GET['filter'] == '2') {
        if ($_GET['provinsi'] == 'all') {
          $query22 = mysqli_query($koneksi, "select sum(neto) as totall from barang_dijual,barang_dijual_qty,pembeli where barang_dijual.id=barang_dijual_qty.barang_dijual_id and status_awal = 1 and pembeli.id=barang_dijual.pembeli_id and barang_dijual.tgl_jual between '" . $_GET['tgl1'] . "' and '" . $_GET['tgl2'] . "'");
          $data22 = mysqli_fetch_array($query22);
        } else {
          if ($_GET['kabupaten'] == 'all') {
            $query22 = mysqli_query($koneksi, "select sum(neto) as totall from barang_dijual,barang_dijual_qty,pembeli where barang_dijual.id=barang_dijual_qty.barang_dijual_id and pembeli.id=barang_dijual.pembeli_id and status_awal = 1 and pembeli.provinsi_id = " . $_GET['provinsi'] . " and barang_dijual.tgl_jual between '" . $_GET['tgl1'] . "' and '" . $_GET['tgl2'] . "'");
            $data22 = mysqli_fetch_array($query22);
          } else {
            if ($_GET['kecamatan'] == 'all') {
              $query22 = mysqli_query($koneksi, "select sum(neto) as totall from barang_dijual,barang_dijual_qty,pembeli where barang_dijual.id=barang_dijual_qty.barang_dijual_id and pembeli.id=barang_dijual.pembeli_id and status_awal = 1 and pembeli.kabupaten_id = " . $_GET['kabupaten'] . " and barang_dijual.tgl_jual between '" . $_GET['tgl1'] . "' and '" . $_GET['tgl2'] . "'");
              $data22 = mysqli_fetch_array($query22);
            } else {
              $query22 = mysqli_query($koneksi, "select sum(neto) as totall from barang_dijual,barang_dijual_qty,pembeli where barang_dijual.id=barang_dijual_qty.barang_dijual_id and pembeli.id=barang_dijual.pembeli_id and status_awal = 1 and pembeli.provinsi_id = " . $_GET['provinsi'] . " and pembeli.kabupaten_id = " . $_GET['kabupaten'] . " and pembeli.kecamatan_id = " . $_GET['kecamatan'] . " and barang_dijual.tgl_jual between '" . $_GET['tgl1'] . "' and '" . $_GET['tgl2'] . "'");
              $data22 = mysqli_fetch_array($query22);
            }
          }
        }
      } else {
        $query22 = mysqli_query($koneksi, "select sum(neto) as totall from barang_dijual,barang_dijual_qty where barang_dijual.id=barang_dijual_qty.barang_dijual_id and status_awal = 1 and barang_dijual.tgl_jual between '" . $_GET['tgl1'] . "' and '" . $_GET['tgl2'] . "'");
        $data22 = mysqli_fetch_array($query22);
      }

      echo number_format($data22['totall'], 2, ',', '.');
      ?>
    </td> -->
    <td colspan="10"></td>
  </tr>
</table>