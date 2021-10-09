<?php  
  
require_once 'core/init.php';

if(isset($_SESSION['admin'])){
  header('Location: index.php');
}else{
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Login Area</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../assets/css/font-awesome.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../assets/css/AdminLTE.min.css">
  <!-- Sweet Alert -->
  <link rel="stylesheet" href="../assets/css/sweetalert.css">
  <script src="../assets/js/sweetalert.min.js"></script>

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="">
      <img src="../assets/img/logo.png" alt="" class="img-responsive">
    </a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Please sign in to continue.</p>

    <form action="" method="post" id="form-login">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Username" name="username" required>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Password" name="password" required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-4 col-xs-offset-4">
          <button type="submit" name="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

<?php  

if(isset($_POST['submit'])){
  $user = trim($_POST['username']);
  $pass = trim($_POST['password']);

  if (!empty($user) || !empty($pass)) {
    if(user_admin($user)){
      if(pass_admin($user, $pass)){
        $_SESSION['admin'] = $user;
        header("Location: index.php");
      }else{
        echo"<script>swal('Oops...', 'Password salah', 'error');</script>";
      }
    }else{
      echo"<script>swal('Oops...', 'Username salah/tidak terdaftar', 'error');</script>";
    }    
  }else{
    echo"<script>swal('Oops...', 'Form tidak boleh kosong', 'error');</script>";
  } 

}

?>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="../assets/js/jquery-3.2.1.min.js"></script>
<!-- Bootstrap -->
<script src="../assets/js/bootstrap.min.js"></script>

</body>
</html>

<?php  
}
?>
