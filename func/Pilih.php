<?php  

// Login
function loginUser($nis, $nama){
	global $mysqli;

	$query = "SELECT * FROM data WHERE nis='$nis' && nama='$nama' && status='0'";
	if($result = $mysqli->query($query)){
		if(mysqli_num_rows($result) != 0) return true;
		else return false;
	}
}

// Tampil Data User
function tampilUser($session){
	global $mysqli;

	$query = "SELECT * FROM data WHERE nama='$session'";
	$result = $mysqli->query($query);

	return $result;
}

// Tampil Suara Sebelumnya
function tampilSuara($id_calon){
	global $mysqli;

	$sql = "SELECT suara FROM calon WHERE id='$id_calon'";
	$result = $mysqli->query($sql);
	$suara = mysqli_fetch_assoc($result)['suara'];
  $suaras = (int)$suara + 1;

	return $suaras;
}

// Proses pilih
function pilih($session, $id_calon){
	global $mysqli;

	$session = $mysqli->real_escape_string($session);
	$id_calon= $mysqli->real_escape_string($id_calon);

	$id_user = mysqli_fetch_assoc(tampilUser($session))['id'];

	$suara = tampilSuara($id_calon);

	$query = "UPDATE data SET status='1' WHERE id='$id_user';";
	$query .= "UPDATE calon SET suara='$suara' WHERE id='$id_calon'";
	
	$result = $mysqli->multi_query($query) or die(mysqli_error());

	return $result;
}

// Logout
function logout(){
	unset($_SESSION['user']);
}


// Sudah Login
function sudahLogin(){
?>
<div class="konten">
      
  <h3 class="text-center">
    Pemilihan Ketua OSIS Periode <?php echo date('Y'); echo "/"; echo date('Y')+1; ?>
  </h3>

	<?php 
	$no = 1;
	foreach( calonTampil() as $data ){
	?>

  <div class="col-sm-6 col-md-3">
    <div class="box box-primary">
      <div class="box-body text-center">
        <img src="assets/img/Calon/<?=$data['foto']; ?>" alt="" class="img-responsive">
      </div>
      <center>
        <b><?=$no.'. '.$data['nama']; ?></b><br>
        <?=$data['organisasi']; ?>
      </center>
      <div class="box-footer text-center">
        <button class="btn btn-info btn-flat" data-toggle="modal" data-target="#modal-detail" onclick="detail(<?=$no; ?>)">
        <i class="fa fa-info-circle"></i>&nbsp;
        Detail
      </button>
        <button class="btn btn-primary btn-flat" data-toggle="modal" data-target="#modal-pilih" onclick="pilih(<?=$no; ?>)">
          <i class="fa fa-check-circle"></i>
          Pilih
        </button>
      </div>
    </div>
    <input type="hidden" id="id-val-<?=$no; ?>" value="<?=$data['id']; ?>">
	  <input type="hidden" id="nama-val-<?=$no; ?>" value="<?=$data['nama']; ?>">
	  <input type="hidden" id="kelas-val-<?=$no; ?>" value="<?=$data['kelas']; ?>">
	  <input type="hidden" id="organisasi-val-<?=$no; ?>" value="<?=$data['organisasi']; ?>">
	  <input type="hidden" id="visi-val-<?=$no; ?>" value="<?=$data['visi']; ?>">
	  <input type="hidden" id="misi-val-<?=$no; ?>" value="<?=$data['misi']; ?>">
	  <input type="hidden" id="foto-val-<?=$no; ?>" value="<?=$data['foto']; ?>">
  </div>
  <?php 
  $no++;
	}
  ?>
	
</div>

<!-- Modal info-->
<div class="modal fade" id="modal-detail">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Visi dan Misi</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-sm-8">
            <table>
              <tr>
                <td>Nama</td>
                <td>&nbsp;</td>
                <td>:</td>
                <td>&nbsp;</td>
                <td id="nama"></td>
              </tr>
              <tr>
                <td>Kelas</td>
                <td>&nbsp;</td>
                <td>:</td>
                <td>&nbsp;</td>
                <td id="kelas"></td>
              </tr>
              <tr>
                <td>Organisasi</td>
                <td>&nbsp;</td>
                <td>:</td>
                <td>&nbsp;</td>
                <td id="organisasi"></td>
              </tr>
            </table><br>
              <b>VISI :</b>
                <div id="visi"></div>
              <b>MISI :</b>
                <div id="misi"></div>
          </div><br>
          <div class="col-sm-4">
            <img src="" alt="" class="img-responsive" id="foto" style="height: 200px; margin: 0 auto;">
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal Konfirmasi -->
<div class="modal fade" id="modal-pilih">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Konfirmasi</h4>
      </div>
      <div class="modal-body">
        <input type="hidden" id="id-calon">
        <div>Apakah Anda yakin ingin memilihnya?</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary btn-flat" id="btn-pilih">Ya</button>
        <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Tidak</button>
      </div>
    </div>
  </div>
</div>

<script>
function detail(no) {
  var nama       = $('#nama-val-'+no).val();
  var kelas      = $('#kelas-val-'+no).val();
  var organisasi = $('#organisasi-val-'+no).val();
  var visi       = $('#visi-val-'+no).val();
  var misi       = $('#misi-val-'+no).val();
  var foto       = $('#foto-val-'+no).val();

  $('#nama').html(nama);
  $('#kelas').html(kelas);
  $('#organisasi').html(organisasi);
  $('#visi').html(visi);
  $('#misi').html(misi);
  $('#foto').attr('src', 'assets/img/Calon/'+foto);
}

function pilih(no){
	var id = $('#id-val-'+no).val();

	$('#id-calon').val(id);
}
</script>

<?php
}


// Belum Login
function belumLogin(){
?>
<div class="row">
  <div class="col-sm-6 col-md-6">
    <div class="row left">
      <div class="col-md-6">
        <img src="assets/img/kpo.png" alt="" class="img-responsive">
      </div><br>
      <div class="col-md-6">
        <p>
          <b>Cara Memilih:</b><br>
          <p>
            Login dengan memasukan Nama dan NIS yang sudah ditentukan untuk melakukan pemilihan Ketua OSIS. Pilih dengan cara mengklik tombol pilih
          </p>
        </p>
      </div>
    </div><hr>
  </div>
  <div class="col-sm-6 col-md-6 right">
    <h1>Selamat Datang di E-Pilketos</h1>
    <p>Kita satukan tekad untuk Pemilu yang Luber dan Jurdil</p><br>
    <div class="login-box">
      <div class="login-box-body">
      <p class="login-box-msg">Login untuk mulai memilih</p>
        <form action="" method="post" id="form-login">
          <div class="form-group has-feedback">
            <input type="text" class="form-control" placeholder="Nama Lengkap" id="nama" autofocus>
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" placeholder="NIS" id="nis">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
        </form>
        <div class="row">
          <div class="col-xs-6 col-sm-4">
            <button type="button" class="btn btn-primary btn-block btn-flat" id="btn-login">Login</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
}
?>