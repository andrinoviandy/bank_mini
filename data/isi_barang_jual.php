<?php
include("../config/koneksi.php");
session_start();
error_reporting(0);
?>
<div class="tab-content">
    <?php
    $que2 = mysqli_query($koneksi, "select * from barang_dijual where id='" . $_GET['id'] . "' order by id ASC");
    $no3 = 0;
    // while (
    $dt = mysqli_fetch_array($que2);
    // ) {
    // $no3++; 
    ?>
    <div class="well tab-pane active" id="tab_<?php echo $_GET['id']; ?>">
        <button name="tambah" class="btn btn-success" type="submit" data-toggle="modal" data-target="#modal-tambah" onclick="getNamaBarang();">
            <span class="fa fa-plus"></span> Tambah Barang
        </button>
        <?php
        $jm_riwayat = mysqli_fetch_array(mysqli_query($koneksi, "select count(*) as jml from barang_dijual where no_po_jual='" . $dt['no_po_jual'] . "'"));
        $jm_kirim = mysqli_fetch_array(mysqli_query($koneksi, "select COUNT(*) as jml_kirim from barang_dikirim where barang_dijual_id='" . $dt['id'] . "'"));
        if ($jm_kirim['jml_kirim'] == 0) {
            if (($jm_riwayat['jml'] > 1 and $_SESSION['user_administrator'] or $jm_riwayat['jml'] > 1 and $_SESSION['user_admin_keuangan'] or $jm_riwayat['jml'] > 1 and $_SESSION['user_manajer_keuangan']) and $dt['status_awal'] != 1) {
        ?>
                <!-- <a href="?page=ubah_jual_barang_uang&id=<?php //echo $_GET['idd'] 
                                                                ?>&hapus_riwayat=<?php //echo $_GET['id']; 
                                                                                    ?>" class="pull-right" onclick="return confirm('Anda yakin akan menghapus Riwayat Ini ?')"> -->
                <button class="pull pull-right btn btn-danger" onclick="hapusRiwayat('<?php echo $_GET['id']; ?>')"><span data-toggle="tooltip" title="Hapus Riwayat" class="fa fa-close"></span> Hapus Riwayat Ini</button>
                <!-- </a> -->
        <?php
            }
        }
        ?>
        <br /><br />
        <div class="table-responsive">
            <table width="100%" id="example1" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th valign="bottom">No</th>
                        <th valign="bottom"><strong>Kategori</strong></th>
                        <th valign="bottom"><strong>Nama Alkes</strong></th>
                        <th align="center" valign="bottom"><strong>Tipe
                            </strong></th>
                        <th align="center" valign="bottom"><strong>Satuan
                            </strong></th>
                        <th align="center" valign="bottom"><strong>Harga Jual</strong></th>
                        <th align="center" valign="bottom"><strong>Qty</strong></th>
                        <th valign="bottom" align="right"><strong>Total</strong></th>
                        <th align="right" valign="bottom"><strong>Ongkir Per Barang</strong></th>
                        <td align="center" valign="bottom"><strong>Aksi</strong></td>
                    </tr>
                </thead>
                <?php
                $no = 0;
                $q_akse = mysqli_query($koneksi, "select *, barang_dijual_qty.id as idd from barang_dijual_qty,barang_gudang where barang_gudang.id=barang_dijual_qty.barang_gudang_id and barang_dijual_id=" . $dt['id'] . "");
                $jm = mysqli_num_rows($q_akse);
                if ($jm != 0) {
                    while ($data_akse = mysqli_fetch_array($q_akse)) {
                        $no++;
                ?>
                        <tr>
                            <td><?php echo $no; ?></td>
                            <td align="left"><?php echo $data_akse['kategori_brg']; ?>
                            </td>
                            <td align="left"><?php echo $data_akse['nama_brg']; ?>
                            </td>
                            <td align="left"><?php echo $data_akse['tipe_brg']; ?></td>
                            <td align="left"><?php echo $data_akse['satuan']; ?>
                                <?php
                                if ($data_akse['satuan_header'] != '') {
                                    echo "<br>(" . $data_akse['jumlah_rincian_to_satuan'] . " " . $data_akse['satuan'] . "=1 " . $data_akse['satuan_header'] . ")";
                                }
                                ?>
                            </td>
                            <td align="left"><?php echo "Rp" . number_format($data_akse['harga_jual_saat_itu'], 2, ',', '.'); ?></td>
                            <td align="center"><?php echo $data_akse['qty_jual']; ?></td>
                            <td align="right"><?php echo "Rp" . number_format($data_akse['harga_jual_saat_itu'] * $data_akse['qty_jual'], 2, ',', '.'); ?></td>
                            <td align="right" bgcolor="#FFFF00"><?php echo "Rp" . number_format($data_akse['okr'], 2, ',', '.'); ?></td>
                            <td align="center" style="width: 7%;">
                                <div class="row">
                                    <?php
                                    $jm_kirim_detail = mysqli_fetch_array(mysqli_query($koneksi, "select COUNT(*) as jml from barang_dikirim_detail where barang_dijual_qty_id='" . $data_akse['idd'] . "'"));
                                    if ($jm_kirim_detail['jml'] == 0) {
                                        if ($jm >= 2) {
                                    ?>
                                            <!-- <a href="index.php?page=ubah_jual_barang_uang&id=<?php //echo $_GET['id']; 
                                                                                                    ?>&id_hapus=<?php //echo $data_akse['idd']; 
                                                                                                                ?>&id_barang_jual=<?php //echo $dt['id'] 
                                                                                                                                    ?>" onclick="return confirm('Yakin Akan Menghapus Item Ini ?')"> -->
                                            <a class="btn btn-xs btn-danger" onclick="hapusBarangJual('<?php echo $data_akse['idd']; ?>')">
                                                <span data-toggle="tooltip" title="Hapus" class="ion-android-delete"></span>
                                            </a>
                                    <?php }
                                    } ?>
                                    <?php
                                    // $jm_kirim2 = mysqli_fetch_array(mysqli_query($koneksi, "select COUNT(*) as jml from barang_dikirim_detail where barang_dijual_qty_id=" . $data_akse['idd'] . " and kategori_brg = '" . $data_akse['kategori_brg'] . "' and status_batal = 0"));
                                    if ($jm_kirim_detail['jml'] == 0) {
                                    ?>
                                        <a class="btn btn-xs btn-warning" onclick="openUbah('<?php echo $dt['id']; ?>', '<?php echo $data_akse['idd']; ?>', '<?php echo $data_akse['qty_jual']; ?>','<?php echo number_format($data_akse['harga_jual_saat_itu'], 0, ',', '.'); ?>')"><span data-toggle="tooltip" title="Ubah Qty" class="fa fa-edit"></span></a>
                                    <?php } ?>
                                    <?php if ($jm_kirim_detail['jml'] == 0 && $data_akse['kategori_brg'] !== 'Aksesoris') { ?>
                                        <a class="btn btn-xs btn-info" onclick="openDetail('<?php echo $data_akse['idd']; ?>','<?php echo $data_akse['kategori_brg']; ?>', '<?php echo $data_akse['qty_jual']; ?>')"><span data-toggle="tooltip" title="Detail" class="fa fa-folder-open-o"></span></a>
                                    <?php }
                                    if ($jm_kirim_detail['jml'] > 0) {
                                        echo "On Delivery";
                                    } ?>
                                </div>
                            </td>
                        </tr>
                <?php }
                } else {
                    echo "<tr><td colspan='10' align='center'>Tidak Ada Data</td></tr>";
                } ?>
                <tr bgcolor="#009900">
                    <td colspan="10"></td>
                </tr>
                <tr>
                    <td colspan="7" align="right"><strong> Total</strong></td>
                    <td align="right"><?php
                                        $total1 = mysqli_fetch_array(mysqli_query($koneksi, "select sum(qty_jual*harga_jual_saat_itu) as total1 from barang_gudang,barang_dijual_qty where barang_gudang.id=barang_dijual_qty.barang_gudang_id and barang_dijual_id=" . $dt['id'] . ""));
                                        echo number_format($total1['total1'], 2, ',', '.');
                                        ?></td>
                    <td align="center" bgcolor="#FFFF00"></td>
                    <td align="center"></td>
                </tr>
                <tr>
                    <td colspan="7" align="right">Total Ongkir
                        <!-- <button type="button" data-toggle="modal" data-target="#modal-ongkir1" class="btn btn-info btn-xs"><span class="fa fa-edit"></span></button> -->
                        <button type="button" onclick="openModalLainnya();" class="btn btn-info btn-xs"><span class="fa fa-edit"></span></button>
                    </td>
                    <td align="right" bgcolor="#FFFF00"><?php
                                                        $data3 = mysqli_fetch_array(mysqli_query($koneksi, "select * from barang_dijual where id=" . $dt['id'] . ""));
                                                        echo number_format($data3['ongkir'], 2, ',', '.'); ?></td>
                    <td align="center" bgcolor="#FFFF00"></td>
                    <td align="center"></td>
                </tr>
                <!--
                              <tr>
                                <td colspan="6" align="right"><strong>DPP</strong></td>
                                <td align="right"><?php echo number_format($data['dpp'], 2, ',', '.'); ?></td>
                                <td align="center"></td>
                              </tr>
                              -->
                <tr>
                    <td colspan="7" align="right">DPP ((Total + Ongkir) /1.1)</td>
                    <td align="right">
                        <?php

                        $dpp = ($data3['ongkir'] + $total1['total1']) / 1.1;
                        echo number_format($dpp, 2, ',', '.');

                        ?>
                    </td>
                    <td align="center"></td>
                    <td align="center"></td>
                </tr>
                <tr>
                    <td colspan="7" align="right">PPN (<?php echo $data3['ppn_jual'] . "%"; ?>)
                        <button type="button" onclick="openModalLainnya();" class="btn btn-info btn-xs"><span class="fa fa-edit"></span></button>
                    </td>
                    <td align="right">
                        <?php
                        $ppn = ($dpp) * $data3['ppn_jual'] / 100;
                        echo number_format($ppn, 2, ',', '.');
                        ?>
                    </td>
                    <td align="center"></td>
                    <td align="center"></td>
                </tr>
                <tr>
                    <td colspan="7" align="right">PPh (<?php echo $data3['pph'] . "%"; ?>) <button type="button" onclick="openModalLainnya();" class="btn btn-info btn-xs"><span class="fa fa-edit"></span></button></td>
                    <td align="right"><?php
                                        $pph = ($dpp) * $data3['pph'] / 100;
                                        echo number_format($pph, 2, ',', '.');
                                        ?></td>
                    <td align="center"></td>
                    <td align="center"></td>
                </tr>

                <tr>
                    <td colspan="7" align="right">Zakat (<?php echo $data3['zakat'] . "%"; ?>) <button type="button" onclick="openModalLainnya();" class="btn btn-info btn-xs"><span class="fa fa-edit"></span></button></td>
                    <td align="right"><?php $zakat = $dpp * $data3['zakat'] / 100;
                                        echo number_format($dpp * $data3['zakat'] / 100, 2, ',', '.'); ?></td>
                    <td align="center"></td>
                    <td align="center"></td>
                </tr>
                <tr>
                    <td colspan="7" align="right">Biaya Bank <button type="button" onclick="openModalLainnya();" class="btn btn-info btn-xs"><span class="fa fa-edit"></span></button></td>
                    <td align="right"><?php echo number_format($data3['biaya_bank'], 2, ',', '.'); ?></td>
                    <td align="center"></td>
                    <td align="center"></td>
                </tr>
                <tr>
                    <td colspan="7" align="right" valign="bottom">
                        <h4><strong>Neto (DPP(Dengan Ongkir)-(PPN dari DPP(Dengan Ongkir)+PPh dari DPP(Dengan Ongkir)+Zakat dari DPP(Dengan Ongkir)+Biaya Bank)</strong>)</h4>
                    </td>
                    <td align="right" valign="bottom">
                        <h4><strong>
                                <?php
                                $total2 = $dpp - ($ppn + $pph + $zakat + $data3['biaya_bank']);
                                echo number_format($total2, 2, ',', '.'); ?>
                            </strong></h4>
                    </td>
                    <td align="center"></td>
                    <td align="center"></td>
                </tr>
                <tr>
                    <td colspan="7" align="right">Diskon (<?php echo $data3['diskon_jual'] . "%"; ?>) <button type="button" onclick="openModalLainnya();" class="btn btn-info btn-xs"><span class="fa fa-edit"></span></button></td>
                    <td align="right"><?php
                                        $diskon = $data3['diskon_jual'];
                                        echo $diskon . "%";
                                        ?></td>
                    <td align="center"></td>
                    <td align="center"></td>
                </tr>
                <tr>
                    <td colspan="7" align="right" valign="bottom"><strong>Fee Supplier (DPP(Tanpa Ongkir)-(PPh dari DPP(Tanpa Ongkir)+Zakat dari DPP(Tanpa Ongkir)+Biaya Bank)</strong>)<strong>*Diskon</strong></td>
                    <td align="right" valign="bottom">
                        <?php
                        $dpp_m = ($total1['total1'] / 1.1);
                        //$ppn_m = $dpp_m*$data['ppn_jual']/100;
                        $pph_m = $dpp_m * $data3['pph'] / 100;
                        $zakat_m = $dpp_m * $data3['zakat'] / 100;
                        $biaya_bank_m = $data3['biaya_bank'];
                        $fee_marketing = ($dpp_m - ($pph_m + $zakat_m + $biaya_bank_m)) * ($diskon / 100);
                        echo "Rp" . number_format($fee_marketing, 2, ',', '.'); ?>
                    </td>
                    <td align="center"></td>
                    <td align="center"></td>
                </tr>
                <tr>
                    <td colspan="10" align="right">
                        <center>
                            <!--<a href="index.php?page=simpan_jual_alkes2&simpan_barang=1"><button name="simpan_barang" class="btn btn-success" type="submit"><span class="fa fa-plus"></span> Simpan</button></a><a href="index.php?page=ubah_jual_barang_uang#open_piutang"><button name="simpa" class="btn btn-success" type="submit"><span class="fa fa-plus"></span> Simpan</button></a>&nbsp;&nbsp;-->
                        </center>
                    </td>
                </tr>

            </table>
            <!-- Modal-->
        </div>
    </div>
</div>
<script>
    function openModalLainnya() {
        $('#ongkir').val('<?php echo number_format($data3['ongkir'], 0, ',', '.'); ?>');
        $('#diskon').val('<?php echo $data3['diskon_jual']; ?>');
        $('#ppn').val('<?php echo $data3['ppn_jual']; ?>');
        $('#pph').val('<?php echo $data3['pph']; ?>');
        $('#zakat').val('<?php echo $data3['zakat']; ?>');
        $('#biaya_bank').val('<?php echo number_format($data3['biaya_bank'], 0, ',', '.'); ?>');
        $('#modal-lainnya').modal('show');
    }
</script>
<script src="bower_components/select2/dist/js/select2.full.min.js"></script>
<script>
    $(function() {
        //Initialize Select2 Elements
        $('.select2').select2()
        $('.select1').select1()
        //Datemask dd/mm/yyyy
        $('#datemask').inputmask('dd/mm/yyyy', {
            'placeholder': 'dd/mm/yyyy'
        })
        //Datemask2 mm/dd/yyyy
        $('#datemask2').inputmask('mm/dd/yyyy', {
            'placeholder': 'mm/dd/yyyy'
        })
        //Money Euro
        $('[data-mask]').inputmask()

        //Date range picker
        $('#reservation').daterangepicker()
        //Date range picker with time picker
        $('#reservationtime').daterangepicker({
            timePicker: true,
            timePickerIncrement: 30,
            format: 'MM/DD/YYYY h:mm A'
        })
        //Date range as a button
        $('#daterange-btn').daterangepicker({
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                },
                startDate: moment().subtract(29, 'days'),
                endDate: moment()
            },
            function(start, end) {
                $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
            }
        )

        //Date picker
        $('#datepicker').datepicker({
            autoclose: true
        })

        //iCheck for checkbox and radio inputs
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
            checkboxClass: 'icheckbox_minimal-blue',
            radioClass: 'iradio_minimal-blue'
        })
        //Red color scheme for iCheck
        $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
            checkboxClass: 'icheckbox_minimal-red',
            radioClass: 'iradio_minimal-red'
        })
        //Flat red color scheme for iCheck
        $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
            checkboxClass: 'icheckbox_flat-green',
            radioClass: 'iradio_flat-green'
        })

        //Colorpicker
        $('.my-colorpicker1').colorpicker()
        //color picker with addon
        $('.my-colorpicker2').colorpicker()

        //Timepicker
        $('.timepicker').timepicker({
            showInputs: false
        })
    })
</script>