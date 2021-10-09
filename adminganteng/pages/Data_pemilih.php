<title>Data Pemilih || E-Pilketos</title>
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Data Pemilih
  </h1>
  <ol class="breadcrumb">
    <li><a href="?p=dashboard"><i class="fa fa-users"></i> Home</a></li>
    <li>Data Pemilih</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">

  <div class="box box-primary">
    <div class="box-header with-border">
      <button class="btn btn-primary btn-flat"  data-toggle="modal" data-target="#modal-tambah">
        <i class="fa fa-plus"></i> 
        Tambah Data
      </button>
      <button class="btn btn-danger btn-flat" data-toggle="modal" data-target="#modal-hapus">
        <i class="fa fa-trash"></i> 
        Hapus Semua
      </button>
    </div>
    <div class="box-body table-responsive" id="view-data">
      <?php include 'ajax/data-view.php'; ?>
    </div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="modal-tambah">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Tambah Data</h4>
        </div>
        <div class="modal-body">
        <div class="alert alert-info alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          <i class="fa fa-info-circle"></i> 
          File <strong>.XLS/.XLSX</strong> yang diizinkan!!
        </div>
        <a href="../contoh/contoh-format-data.xlsx" target="_blank" class="btn btn-success btn-flat">
          <i class="fa fa-download"></i>
           Download Template
        </a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="../assets/img/loading.gif" alt="" id="loading" style="height: 45px;"><br><br>
        <form action="" enctype="multipart/form-data" id="form">
          <input type="file" name="file" id="file" class="form-control pull-left" style="width: 50%;">
        </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary btn-flat" id="btn-upload">Upload</button>
          <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Tutup</button>
        </div>
      </div>
    </div>
  </div>
  
  <div class="modal fade" id="modal-hapus">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Konfirmasi</h4>
        </div>
        <div class="modal-body">
          <div id="konfirmasi">Apakah anda yakin ingin menghapus semua data ini?</div>
          <img src="../assets/img/loading.gif" alt="" id="load" style="height: 45px;">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger btn-flat" id="btn-hapusData">Ya</button>
          <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Tidak</button>
        </div>
      </div>
    </div>
  </div>
  <!-- /.Modal -->

</section>
<!-- /.content -->