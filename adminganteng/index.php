<?php  

require_once 'core/init.php';

if(!isset($_SESSION['admin'])){
  header('Location: login.php');
}else{

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<!-- Bootstrap 3.3.6 -->
	<link rel="stylesheet" href="../assets/css/bootstrap.min.css">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="../assets/css/font-awesome.min.css">
	<!-- Ionicons -->
	<link rel="stylesheet" href="../assets/css/ionicons.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="../assets/css/AdminLTE.min.css">
	<!-- Skin Blue -->
	<link rel="stylesheet" href="../assets/css/skin-blue.min.css">
	<!-- Data Tables -->
	<link rel="stylesheet" href="../assets/css/dataTables.bootstrap.min.css">
	<!-- Sweet Alert -->
	<link rel="stylesheet" href="../assets/css/sweetalert.css">

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
	
	<!-- REQUIRED JS SCRIPTS -->
	<!-- jQuery -->
	<script src="../assets/js/jquery-3.2.1.min.js"></script>
	<!-- Bootstrap -->
	<script src="../assets/js/bootstrap.min.js"></script>
	<!-- AdminLTE App -->
	<script src="../assets/js/app.min.js"></script>
	<!-- Data Tables -->
	<script src="../assets/js/jquery.dataTables.min.js"></script>
	<script src="../assets/js/dataTables.bootstrap.min.js"></script>
</head>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

	<!-- Main Header -->
	<header class="main-header">

		<!-- Logo -->
		<a href="" class="logo">
			<!-- mini logo for sidebar mini 50x50 pixels -->
			<span class="logo-mini"><b>A</b>LT</span>
			<!-- logo for regular state and mobile devices -->
			<span class="logo-lg"><b>Admin</b>LTE</span>
		</a>

		<!-- Header Navbar -->
		<nav class="navbar navbar-static-top" role="navigation">
			<!-- Sidebar toggle button-->
			<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
				<span class="sr-only">Toggle navigation</span>
			</a>
			<!-- Navbar Right Menu -->
			<div class="navbar-custom-menu">
				<ul class="nav navbar-nav">
					<!-- User Account Menu -->
					<li class="dropdown user user-menu">
						<!-- Menu Toggle Button -->
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<!-- The user image in the navbar-->
							<img src="../assets/img/avatar.jpg" class="user-image" alt="User Image">
							<!-- hidden-xs hides the username on small devices so only the image appears. -->
							<span class="hidden-xs"><?php echo adminTampilSession($_SESSION['admin']); ?></span>
						</a>
						<ul class="dropdown-menu">
							<!-- The user image in the menu -->
							<li class="user-header">
								<img src="../assets/img/avatar.jpg" class="img-circle" alt="User Image">
								<p>
									<?php echo adminTampilSession($_SESSION['admin']); ?>
									<small><i class="fa fa-circle text-success"></i> Online</small>
								</p>
							</li>
							<!-- Menu Footer-->
							<li class="user-footer">
								<div class="pull-left">
									<a href="#" data-toggle="control-sidebar" class="btn btn-default btn-flat">Profile</a>
								</div>
								<div class="pull-right">
								<form action="" method="post">
									<input type="submit" name="out" value="Sign Out" class="btn btn-default btn-flat">
								</form>
									<?php  
										if(isset($_POST['out'])){
											unset($_SESSION['admin']);
											header("Location:".$_SERVER['PHP_SELF']);
										}
									?>
								</div>
							</li>
						</ul>
					</li>
					<!-- Control Sidebar Toggle Button -->
					<li>
						<a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
					</li>
				</ul>
			</div>
		</nav>
	</header>
	<!-- Left side column. contains the logo and sidebar -->
	<aside class="main-sidebar">

		<!-- sidebar: style can be found in sidebar.less -->
		<section class="sidebar">

			<!-- Sidebar user panel (optional) -->
			<div class="user-panel">
				<div class="pull-left image">
					<img src="../assets/img/avatar.jpg" class="img-circle" alt="User Image">
				</div>
				<div class="pull-left info">
					<p>
						<?php echo adminTampilSession($_SESSION['admin']); ?>
					</p>
					<!-- Status -->
					<a><i class="fa fa-circle text-success"></i> Online</a>
				</div>
			</div>

			<!-- Sidebar Menu -->
			<ul class="sidebar-menu">
				<li class="header">MENU</li>
				<!-- Optionally, you can add icons to the links -->
				<li id="dashboard">
					<a href="?p=dashboard"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
				</li>
				<li id="calon">
					<a href="?p=calon"><i class="fa fa-users"></i> <span>Calon</span></a>
				</li>
				<li id="data">
					<a href="?p=data_pemilih"><i class="fa fa-table"></i> <span>Data Pemilih</span></a>
				</li>
			</ul>
			<!-- /.sidebar-menu -->
		</section>
		<!-- /.sidebar -->
	</aside>

	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		
	<?php  

	$p = @$_GET['p'];

	if($p == '')include 'pages/Dashboard.php';
	else if($p == 'dashboard')include 'pages/Dashboard.php';
	else if($p == 'calon')include 'pages/Calon.php';
	else if($p == 'data_pemilih')include 'pages/Data_pemilih.php';
	else include 'pages/404.php';

	?>

	</div>
	<!-- /.content-wrapper -->

	<!-- Main Footer -->
	<footer class="main-footer">
		<!-- To the right -->
		<div class="pull-right hidden-xs">
			[ ] dengan <span>❤</span> di Cirebon
		</div>
		<!-- Default to the left -->
		<strong>Copyright &copy; 2018 <a href="https://fauzifx.github.io/">Karya Saya</a>.</strong> 
		All rights reserved.
	</footer>

	<!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li class="active"><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-users"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-user-plus"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane active" id="control-sidebar-home-tab">
        <h3 class="control-sidebar-heading">&nbsp;<b>Admin</b></h3>
        <ul class="control-sidebar-menu" id="view-admin">
          <?php include 'ajax/admin-view.php'; ?>
        </ul>
        <!-- /.control-sidebar-menu -->

      </div>
      <!-- /.tab-pane -->
      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post"  id="formtambah">
          <h3 class="control-sidebar-heading"><b>Tambah Admin</b></h3>
					<small>* wajib diisi!!</small>
          <div class="form-group">
            <label for="nama">Nama Lengkap *</label>
            <input type="text" class="form-control" name="nama" placeholder="Nama Lengkap" id="namaAdmin">
          </div>
          <div class="form-group">
            <label for="user">Username *</label>
            <input type="text" class="form-control" name="user" placeholder="Username" id="user">
          </div>
          <div class="form-group">
            <label for="pass">Password *</label>
            <input type="password" class="form-control" name="pass" placeholder="Password" id="pass">
          </div>
          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" name="email" placeholder="mail@mail.com" id="mail">
          </div>

        </form><br>
        <!-- /.form-group -->
        <button type="button" class="btn btn-primary btn-flat" id="btn-tambahAdmin" style="float: left;">Tambah</button>
        <div id="loadingTambah">&nbsp;&nbsp;&nbsp;Loading...</div>
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->

  <div class="control-sidebar-bg"></div>

</div>
<!-- ./wrapper --> 

<!-- Modal -->
<div class="modal fade" id="edit" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	        <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title">Form Ubah Data</h4>
        <img src="../assets/img/loading.gif" alt="" id="loadingUbah" style="height: 45px;">
      </div>
      <div class="modal-body">
        <form method="post" id="formubah">
        	<input type="hidden" id="idAdmin">
					<div class="form-group">
						<label for="">Nama</label>
						<input class="form-control" type="text" id="nameAdmin" placeholder="Nama">
					</div>
					<div class="form-group">
						<label for="">Username</label>
						<input class="form-control" type="text" id="username" placeholder="Username">
					</div>
					<div class="form-group">
						<label for="">Password lama</label>
						<input class="form-control" type="password" id="passwordlama" placeholder="Password lama">
					</div>
					<div class="form-group">
						<label for="">Password baru</label>
						<input class="form-control" type="password" id="passwordbaru" placeholder="Password baru">
					</div>
					<div class="form-group">
						<label for="">Password baru verifikasi</label>
						<input class="form-control" type="password" id="passwordverif" placeholder="Password baru">
						<small id="passSalah">Password Verifikasi salah!</small>
					</div>
					<div class="form-group">
						<label for="">Email</label>
						<input class="form-control" type="email" id="email" placeholder="Email">
					</div>
				</form>
      </div>
      <div class="modal-footer">
	      <button type="button" class="btn btn-primary btn-flat" id="btn-ubahAdmin">Ubah</button>
        <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="hapus">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	        <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title">Konfirmasi</h4>
      </div>
      <div class="modal-body">
        <input type="hidden" id="id-val">
        <div>Apakah anda yakin ingin menghapus data ini?</div>
        <img src="../assets/img/loading.gif" alt="" id="loadingHapus" style="height: 45px;">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger btn-flat" id="btn-hapusAdmin">Ya</button>
        <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Tidak</button>
      </div>
    </div>
  </div>
</div>
<!-- /.Modal -->

<!-- Sweet Alert -->
<script src="../assets/js/sweetalert.min.js"></script>
<!-- TinyMCE -->
<script src="../assets/tinymce/tinymce.min.js"></script>
<!-- Ajax -->
<script src="../assets/js/ajax.js"></script>
<!-- Highchart -->
<script src="../assets/js/highcharts.js"></script>
<!-- jQuery easeScroll -->
<script src="../assets/js/jquery.easeScroll.js"></script>
<!-- Script -->
<script src="../assets/js/script.js"></script>
<script>

	$(document).ready(function(){
		// easeScroll
		$("html").easeScroll();
	});

</script>

</body>
</html>
<?php 
}
?>