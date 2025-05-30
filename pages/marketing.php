<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Marketing

    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Pengaturan</li>
      <li class="active">Marketing</li>
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
        <div class="box box-success">
          <div class="box-footer">
            <div class="box-body">
              <div class="">
                <a href="index.php?page=tambah_marketing"><input type="submit" name="button" id="button" value="Tambah Marketing" class="btn btn-success" /></a><br /><br />
                <!--
              <form method="post">
              <div class="input-group pull pull-left col-xs-1">
                
                <select class="form-control" name="limiterr" style="margin-right:40px">
                <option <?php if ($limiter['limiter'] == 10) {
                          echo "selected";
                        } ?> value="10">10</option>
                <option <?php if ($limiter['limiter'] == 50) {
                          echo "selected";
                        } ?> value="50">50</option>
                <option <?php if ($limiter['limiter'] == 100) {
                          echo "selected";
                        } ?> value="100">100</option>
                <option <?php if ($limiter['limiter'] == 500) {
                          echo "selected";
                        } ?> value="500">500</option>
                <option <?php if ($limiter['limiter'] == 1000) {
                          echo "selected";
                        } ?> value="1000">1000</option>
                <?php
                $total = mysqli_num_rows(mysqli_query($koneksi, "select * from barang_gudang"));
                ?>
                <option <?php if ($limiter['limiter'] == $total) {
                          echo "selected";
                        } ?> <?php if ($_POST['cari'] != '') {
                                                                                        echo "selected";
                                                                                      } ?> value="<?php echo $total; ?>">All</option>
                </select>
                
                <span class="input-group-btn">
                      <button type="submit" name="button_limit" class="btn btn-default btn-flat"><i class="fa fa-check"></i></button>
                    </span>
                
              </div>
              </form>
              
              <form method="post">
              <div class="input-group pull pull-left col-xs-2">
                
                <select class="form-control" name="urutt" style="margin-right:40px">
                <option <?php if ($limiter['urut'] == 'ASC') {
                          echo "selected";
                        } ?> value="ASC">Ascending</option>
                <option <?php if ($limiter['urut'] == 'DESC') {
                          echo "selected";
                        } ?> value="DESC">Descending</option>
                
                </select>
                
                <span class="input-group-btn">
                      <button type="submit" name="button_urut" class="btn btn-default btn-flat"><i class="fa fa-check"></i></button>
                    </span>
                
              </div>
              </form>
              
              <form method="post" class="">
              <div class="input-group input-group-md col-xs-4 pull pull-right">
                <input type="text" name="cari" placeholder="Keyword....." class="form-control">
                    <span class="input-group-btn">
                      <button type="submit" name="button_cari" class="btn btn-info btn-flat"><i class="fa fa-search"></i> Cari </button>
                    </span>
              </div>
              </form>
              -->
                <br />
                <div id="data-master"></div>
              </div>
            </div>
          </div>
        </div>
        <!-- /.box (chat box) -->

        <!-- TO DO List --><!-- /.box -->

        <!-- quick email widget -->
      </section>
      <!-- /.Left col -->
      <!-- right col (We are only adding the ID to make the widgets sortable)-->
      <section class="col-lg-5 connectedSortable">

        <!-- Map box --><!-- /.box -->

        <!-- solid sales graph --><!-- /.box -->

        <!-- Calendar --><!-- /.box -->

      </section>
      <!-- right col -->
    </div>
    <!-- /.row (main row) -->

  </section>
  <!-- /.content -->
</div>

<script>
  function getData() {
    $.get("data/marketing.php",
      function(data) {
        $('#data-master').html(data);
      }
    );
  }

  function hapus(id) {
    Swal.fire({
      customClass: {
        confirmButton: 'bg-red',
        cancelButton: 'bg-white',
      },
      title: 'Anda Yakin Akan Menghapus Data Ini ?',
      text: 'Data Akan Dihapus Secara Permanen',
      icon: 'question',
      showCancelButton: true,
      confirmButtonText: 'Ya , Hapus',
      cancelButtonText: 'Batal',
    }).then((result) => {
      if (result.isConfirmed) {
        $.post("data/hapus-marketing.php", {
            id_hapus: id
          },
          function(data) {
            if (data == 'S') {
              alertHapus('S');
              getData();
            } else {
              alertHapus('F');
            }
          }
        );
      }
    })
  }

  $(document).ready(function() {
    getData()
  });
</script>