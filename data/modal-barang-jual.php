<?php
include("../config/koneksi.php");
include("../include/API.php");
session_start();
error_reporting(0);
?>
<div class="table-responsive no-padding">
    <table width="100%" id="example1" class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Kategori</th>
                <th>Nama Barang</th>
                <th>Nomor Izin Edar</th>
                <th>Tipe Barang</th>
                <th>Kuantitas</th>
                <?php if ($d1['flag_detail'] > 0) { ?>
                    <th>
                        Rincian
                    </th>
                <?php } ?>
            </tr>
        </thead>
        <?php
        $jml_deal = mysqli_fetch_array(mysqli_query($koneksi, "select count(*) as jml from barang_dijual where status_deal=1 and no_po_jual='" . $_GET['no_po_jual'] . "'"));
        if ($jml_deal['jml'] == 0) {
            $d2 = mysqli_fetch_array(mysqli_query($koneksi, "select *,barang_dijual.id as idd from barang_dijual_qty,barang_dijual,barang_gudang where barang_dijual.id=barang_dijual_qty.barang_dijual_id and barang_gudang.id=barang_dijual_qty.barang_gudang_id and barang_dijual.no_po_jual='" . $_GET['no_po_jual'] . "' order by barang_dijual.id DESC LIMIT 1"));
            $q2 = mysqli_query($koneksi, "select *,barang_dijual_qty.id as id_det_jual, (select count(*) from barang_dijual_qty_detail where barang_dijual_qty_id = barang_dijual_qty.id) as flag_detail from barang_dijual_qty,barang_dijual,barang_gudang where barang_dijual.id=barang_dijual_qty.barang_dijual_id and barang_gudang.id=barang_dijual_qty.barang_gudang_id and barang_dijual.id=" . $d2['idd'] . "");
            echo "<center><em>Riwayat Terakhir</em></center>";
        } else {
            $q2 = mysqli_query($koneksi, "select *,barang_dijual_qty.id as id_det_jual, (select count(*) from barang_dijual_qty_detail where barang_dijual_qty_id = barang_dijual_qty.id) as flag_detail from barang_dijual_qty,barang_dijual,barang_gudang where barang_dijual.id=barang_dijual_qty.barang_dijual_id and barang_gudang.id=barang_dijual_qty.barang_gudang_id and barang_dijual.no_po_jual='" . $_GET['no_po_jual'] . "' and status_deal=1");
        }

        $nn = 0;
        while ($d1 = mysqli_fetch_array($q2)) {
            $nn++;
            $q4 = mysqli_fetch_array(mysqli_query($koneksi, "select count(*) as jml from barang_dikirim_detail where barang_dijual_qty_id=" . $d1['id_det_jual'] . ""));
        ?>
            <tr>
                <td><?php echo $nn; ?></td>
                <td><?php echo $d1['kategori_brg']; ?></td>
                <td>
                    <?php echo $d1['nama_brg']; ?>
                    <?php if ($d1['status_kembali_ke_gudang'] == 1) { ?>
                        <br>
                        <font class="pull pull-right" size="+1">Kembali Ke Gudang</font>
                    <?php } ?>
                </td>
                <td><?php echo $d1['nie_brg']; ?></td>
                <td><?php echo $d1['tipe_brg']; ?></td>
                <td><?php echo $d1['qty_jual']; ?></td>
                <?php if ($d1['flag_detail'] > 0) { ?>
                    <td>
                        <a href="javascript:void()" title="Detail Barang" class="btn btn-xs bg-primary" onclick="modalDetailBarang('<?php echo $d1['id_det_jual']; ?>')"><span class="fa fa-folder-open"></span></a>
                    </td>
                <?php } ?>
            </tr>
        <?php } ?>
    </table>
</div>

<div class="modal fade" id="modal-detail-barang">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" onclick="closeModalRincian();">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" align="center">Rincian Detail Barang</h4>
            </div>
            <form method="post">
                <div class="modal-body">
                    <div id="modal-data-detail-barang"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" onclick="closeModalRincian();">Close</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<script>
    function closeModalRincian() {
        $('#modal-detail-barang').modal('hide');
    }

    function modalDetailBarang(id_qty) {
        // $('#modal-barang').modal('hide');
        $('#modal-data-detail-barang').html('<center><div class="overlay"><i class="fa fa-refresh fa-spin"></i></div></center>');
        $('#modal-detail-barang').modal('show');
        $.get("data/modal-detail-barang-jual.php", {
                id_qty: id_qty
            },
            function(data) {
                $('#modal-data-detail-barang').html(data)
            }
        );
    }
</script>
<script>
    $(function() {
        $('#example1').DataTable()
        $('#example2').DataTable({
            'paging': false,
            'lengthChange': false,
            'searching': true,
            'ordering': false,
            'info': false,
            'autoWidth': true
        })
        $('#example3').DataTable({
            'paging': true,
            'lengthChange': false,
            'searching': false,
            'ordering': true,
            'info': false,
            'autoWidth': true
        })
        $('#example5').DataTable({
            'paging': false,
            'lengthChange': false,
            'searching': true,
            'ordering': true,
            'info': true,
            'autoWidth': true
        })
        $('#example4').DataTable()
    })
</script>