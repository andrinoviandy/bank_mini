<?php
include("../config/koneksi.php");
include("../include/API.php");
session_start();
error_reporting(0);

$data = mysqli_fetch_array(mysqli_query($koneksi, "select *,utang_piutang.id as idd, barang_dijual.id as id_po from utang_piutang left join barang_dijual on utang_piutang.no_faktur_no_po = barang_dijual.no_po_jual where utang_piutang.id=$_GET[id]"));
?>
<div class="table-responsive">
    <table width="100%" id="" class="table table-bordered table-hover">
        <thead>
            <tr>
                <td width="" align="center"><strong>Status</strong>
                    </th>
                <th width="" valign="top">No PO</th>
                <th width="" valign="top">No_Kontrak</th>
                <th width="" valign="top">Barang</th>
                <th width="" valign="top"><strong>Tanggal</strong></th>
                <th width="" valign="top">Klien</th>
                <th width="" valign="top"><strong>Deskripsi</strong></th>
                <th width="" valign="top">Nominal</th>
                <th width="" valign="top">Detail</th>
                <!--<th valign="top">NIE</th>
                      <th valign="top">No. Bath</th>
                      <th valign="top">No. Lot</th>-->
            </tr>
        </thead>
        <?php if ($data['status_lunas'] == 0) {
            $b = "btn-danger";
        } else {
            $b = "btn-success";
        } ?>
        <tr>
            <td align="center" class="<?php echo $b; ?>"><?php if ($data['status_lunas'] == 0) {
                                                                echo "Belum Lunas";
                                                            } else {
                                                                echo "Sudah Lunas";
                                                            } ?></td>
            <td><?php echo $data['no_faktur_no_po']; ?></td>
            <td>
                <?php
                $dd = mysqli_fetch_array(mysqli_query($koneksi, "select no_kontrak from barang_dijual where no_po_jual='" . $data['no_faktur_no_po'] . "'"));
                echo $dd['no_kontrak']; ?>
            </td>
            <td>
                <a href="#" data-toggle="modal" data-target="#modal-detailpiutang<?php echo $data['idd']; ?>"><small data-toggle="tooltip" title="Detail Barang" class="label bg-primary"><span class="fa fa-folder-open"></span></small></a>
            </td>
            <td>
                <?php echo date("d M Y", strtotime($data['tgl_input']));  ?><br />
                <font style="font-size:11px"><?php if ($data['jatuh_tempo'] != 0000 - 00 - 00) {
                                                    echo "Jatuh Tempo : " . date("d M Y", strtotime($data['jatuh_tempo']));
                                                }  ?></font>
            </td>
            <td><?php echo $data['klien']; ?></td>

            <td><?php echo $data['deskripsi']; ?></td>
            <td><?php echo "Rp" . number_format($data['nominal'], 2, ',', '.'); ?><br />
                <font style="font-size:11px"><?php
                                                $to = mysqli_fetch_array(mysqli_query($koneksi, "select sum(nominal) as jumlah from utang_piutang_bayar where utang_piutang_id=$_GET[id]"));
                                                echo "Sisa Piutang : <br>Rp" . number_format($data['nominal'] - $to['jumlah'], 2, ',', '.'); ?></font>
            </td>
            <td><a href="#" data-toggle="modal" data-target="#modal-detail<?php echo $data['idd']; ?>" onclick="getDataUmum('<?php echo $data['id_po']; ?>'); getDataDetail('<?php echo $data['id_po']; ?>','<?php echo $data['include_dpp'] ?>'); return false;"><small data-toggle="tooltip" title="Detail Hutang" class="label label-warning"><span class="fa fa-folder-open"></span></small></a></td>
            <!--<td></td>
                    <td><?php //echo $data['no_bath']; 
                        ?></td>
                    <td><?php //echo $data['no_lot']; 
                        ?></td>-->
            <?php if ($data['stok_total'] == 0) {
                $color = "red";
            } else {
                $color = "";
            } ?>
        </tr>

    </table>
</div>