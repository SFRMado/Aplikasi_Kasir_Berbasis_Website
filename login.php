<?php
	session_start();
  include 'config.php';
	if(!isset($_SESSION['log'])){
    } else {
        header('location:index.php');
    };

    if(isset($_POST['login'])){
      $user = mysqli_real_escape_string($conn,$_POST['username']);
      $pass = mysqli_real_escape_string($conn,$_POST['password']);
      $queryuser = mysqli_query($conn,"SELECT * FROM login WHERE username='$user'");
      $cariuser = mysqli_fetch_assoc($queryuser);
          
          if( password_verify($pass, $cariuser['password']) ) {
              $_SESSION['userid'] = $cariuser['userid'];
              $_SESSION['username'] = $cariuser['username'];
              $_SESSION['log'] = "login";

              if($cariuser){ 
                  echo '<script>alert("Data yang anda masukan benar");window.location="index.php"</script>';
              }else{
                  echo '<script>alert("Data yang anda masukan salah");history.go(-1);</script>';
              }
              echo '<script>alert("Anda Berhasil Login");window.location="index.php"</script>';
          } else {
              echo '<script>alert("Username atau password salah");history.go(-1);</script>';
          }	
      };
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Aplikasi Kasir | by.SFR</title>
    <link rel="icon" href="favicon.ico">
    <link rel="icon" href="favicon.ico" type="image/ico">
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <style>
        html,body {
  height: 100%;
}

body {
  display: -ms-flexbox;
  display: flex;
  -ms-flex-align: center;
  align-items: center;
  padding-top: 40px;
  padding-bottom: 40px;
  background: #4c6ef8;
}

.form-signin {
  width: 100%;
  max-width: 330px;
  padding: 15px;
  margin: auto;
}
.form-signin .checkbox {
  font-weight: 400;
}
.form-signin .form-control {
  position: relative;
  box-sizing: border-box;
  height: auto;
  padding: 10px;
  font-size: 16px;
}
.form-signin .form-control:focus {
  z-index: 2;
}
.form-signin input[type="email"] {
  margin-bottom: -1px;
  border-bottom-right-radius: 0;
  border-bottom-left-radius: 0;
}
.form-signin input[type="password"] {
  margin-bottom: 10px;
  border-top-left-radius: 0;
  border-top-right-radius: 0;
}
    </style>
</head>
<body>

    <form class="form-signin" method="POST">
      <img class="mb-4" src="assets/images/logo-kasir.png" alt="" width="72" height="72">
      <label>APLIKASI KASIR</label>
      <div class="form-group mb-2">
        <label for="inputuser" class="sr-only">Username</label>
        <input type="text" id="inputuser" name="username" class="form-control" placeholder="Username" required autofocus>
      </div>
      <div class="form-group mb-2">
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
      </div>
      <button class='btn btn-warning btn-block' name="login" id="try" style="font-weight:700;" type="submit">login</button>
      
      <p class="mt-3 mb-3 text-white">&copy; 2023 Developed by - <a target="_blank" rel="noopener noreferrer" href="https://github.com/SFRMado" class="text-white">
     SFR</a></p>
    </form>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>      
  </body>
  
</html>