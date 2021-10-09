<?php  
require_once 'core/init.php';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>E-Pilketos</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="assets/css/AdminLTE.min.css">
    <!-- Styles -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- SweetAlert -->
    <link rel="stylesheet" href="assets/css/sweetalert.css">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

  </head>
  <body>

  <!-- Main Header -->
  <header class="main-header">
    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">

      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <!-- Logo -->
          <a href="http://localhost/github/pilketos" class="logo">
            <img src="assets/img/logo.png" alt="" class="img-responsive">
          </a>
        </div>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu collapse navbar-collapse" id="collapse">
          <ul class="nav navbar-nav">
            <?php if (isset($_SESSION['user'])) {?>
              <li id="user">
              <?php 
                $session = $_SESSION['user'];
                $tampil = mysqli_fetch_assoc(tampilUser($session))
              ?>
                <b style="text-transform: uppercase;"><?=$tampil['nama']; ?></b><br>
                <i style="text-transform: uppercase;"><?=$tampil['kelas']; ?></i>
              </li>
            <?php } ?>
          </ul>
        </div>
      </div>
    </nav>
  </header>
  
  <div class="container">

  <?php  
    if(!empty($_SESSION['user'])){
      sudahLogin();
    }else{
      belumLogin();
    } 
  ?>    

  </div>
    
    <footer class="footer">
      <div class="container">
        <span class="pull-left">Copyright &copy; 2018 . Karya Saya</span>
        <span class="pull-right">[ ] dengan <span>❤</span> di Cirebon</span>
      </div>
    </footer>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="assets/js/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- Sweet Alert -->
    <script src="assets/js/sweetalert.min.js"></script>
    <!-- Ajax -->
    <script src="assets/js/ajax.js"></script>

  </body>
</html>