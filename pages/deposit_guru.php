<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Deposit Guru</h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Deposit Guru</li>
        </ol>
    </section>


    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) --><!-- /.row -->
        <!-- Main row -->
        <div class="row">
            <!-- Left col -->
            <section class="col-lg-12 connectedSortable">
                <!-- Custom tabs (Charts with tabs)--><!-- /.nav-tabs-custom -->

                <!-- Chat box -->
                <div class="box box-success"><!-- /.chat -->
                    <div class="box-footer">
                        <div class="box-body">
                            <div class="input-group pull pull-left">
                                <button name="tambah_laporan" class="btn btn-success" style="margin-right: 10px;" type="button" onclick="modalDeposit(); return false"><span class="fa fa-plus"></span>&nbsp; Tambah Deposit</button>
                            </div>
                            <div class="pull pull-right">
                                <?php //include "include/getFilter.php"; 
                                ?>
                                <?php include "include/atur_halaman.php"; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.box (chat box) -->

                <!-- TO DO List --><!-- /.box -->

                <!-- quick email widget -->
            </section>
            <?php include "include/header_pencarian.php"; ?>
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs">
                                <li class="active" onclick="getDataTab1(); return false;"><a href="#fa-icons" data-toggle="tab">Perlu Konfirmasi</a></li>
                                <li onclick="getDataTab2(); return false;"><a href="#fa-icons" data-toggle="tab">Riwayat Deposit</a></li>
                            </ul>
                            <div class="tab-content">
                                <!-- Font Awesome Icons -->
                                <div class="tab-pane active" id="fa-icons">
                                    <?php include "include/getInputSearch.php"; ?>
                                    <div id="table" style="margin-top: 10px;"></div>
                                    <div>
                                        <center>
                                            <!-- <ul class="pagination"> -->
                                                <button class="btn btn-default" id="paging-1">
                                                    <i class="fa fa-angle-double-left"></i>
                                                </button>
                                                <button class="btn btn-default" id="paging-2">
                                                    <i class="fa fa-angle-double-right"></i>
                                                </button>
                                            <!-- </ul> -->
                                            <?php include "include/getInfoPagingData.php"; ?>
                                        </center>
                                    </div>
                                </div>
                                <!-- /#fa-icons -->
                            </div>
                            <!-- /.tab-content -->
                        </div>
                        <!-- /.nav-tabs-custom -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </section>
            <!-- /.Left col -->
            <!-- right col (We are only adding the ID to make the widgets sortable)-->

            <!-- right col -->
        </div>
        <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
</div>

<div class="modal fade" id="modal-pinjam" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Deposit Guru</h4>
            </div>
            <form method="post" onsubmit="simpanDeposit(); return false;" id="formPinjam">
                <div class="modal-body">
                    <div id="data-pinjam"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success" name="simpan">Simpan</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="modal-bayar">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Bukti Transfer</h4>
            </div>
            <form method="post">
                <div class="modal-body">
                    <div id="data-modal-bayar"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <!-- <button type="submit" class="btn btn-success" name="simpan_setor">Simpan</button> -->
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<script>
    // async function hapusData(id) {
    //     const confirm = await alertConfirm('Apakah Anda Yakin Menghapus Data Ini ?', 'Data Tidak Dapat Dikembalikan')
    //     if (confirm) {
    //         $.post("data/hapus-nasabah.php", {
    //                 id: id
    //             },
    //             function(data, textStatus, jqXHR) {
    //                 if (data == 'S') {
    //                     alertHapus('S')
    //                     loadMore(load_flag, key, status_b);
    //                 } else {
    //                     alertHapus('F')
    //                 }
    //             }
    //         );
    //     }
    // }

    async function modalDeposit() {
        await $.get("data/modal-deposit-guru.php",
            function(data, textStatus, jqXHR) {
                $('#data-pinjam').html(data);
            }
        );
        $('#modal-pinjam').modal('show');
    }

    function simpanDeposit() {
        var dataform = $('#formPinjam')[0];
        var data = new FormData(dataform);
        $.ajax({
            type: "post",
            url: "data/simpan-deposit-guru.php",
            data: data,
            enctype: "multipart/form-data",
            contentType: false,
            processData: false,
            success: function(response) {
                if (response === 'S') {
                    $('#modal-pinjam').modal('hide');
                    dataform.reset();
                    alertSimpan('S')
                    loadMore(load_flag, key, status_b)
                } else if (response === 'GD') {
                    alertCustom('F', 'Gagal Deposit !', 'Data gagal deposit ke akun wali / murid')
                } else {
                    alertSimpan('F')
                }
            }
        });
    }

    async function lihatBukti(gambar) {
        await $('#data-modal-bayar').html(`<img src="../kantin/assets/client/uploads/${gambar}" alt="Gambar" style="width: 100%; height: auto;">`);
        $('#modal-bayar').modal('show');
    }

    async function konfirmasi(id, jumlah) {
        const confirm = await alertConfirm(`Saldo Sebesar ${jumlah} Akan Masuk ke Akun Guru ?`, 'Pilih Ya Untuk Melanjutkan', "bg-green")
        if (confirm) {
            $.post("data/update-deposit-guru.php", {
                    id: id
                },
                function(data) {
                    if (data == 'S') {
                        alertCustom('S', 'Berhasil Disimpan !', 'Saldo Berhasil Masuk Ke Akun Orang Tua')
                        loadMore(load_flag, key, status_b);
                    } else {
                        alertSimpan('F')
                    }
                }
            );
        }
    }

    async function getDataTab1() {
        loading2('#table')
        status_deposit_guru = '0,1'
        await loadMore(load_flag, key, status_b)
        interval_deposit_guru = setInterval(() => {
            loadMore(load_flag, key, status_b)
        }, 5000);
    }

    async function getDataTab2() {
        clearInterval(interval_deposit_guru)
        loading2('#table')
        status_deposit_guru = '2'
        await loadMore(load_flag, key, status_b)
    }

    $(document).ready(function() {
        status_deposit_guru = '0,1';
        if (status_deposit_guru == '0,1') {
            interval_deposit_guru = setInterval(() => {
                loadMore(load_flag, key, status_b)
            }, 5000);
        }
    });
</script>