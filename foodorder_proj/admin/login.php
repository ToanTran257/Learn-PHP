<?php include('../config/constants.php'); ?>

<html>

<head>
 <title>Login - Food Order System</title>
 <link rel="stylesheet" href="../css/admin.css">
</head>

<body>
 <div class='login'>
  <h1 class="text-center">Login</h1>
  <br><br>

  <?php
  if (isset($_SESSION['login'])) {
   echo $_SESSION['login'];
   unset($_SESSION['login']);
  }

  if (isset($_SESSION['no-login-message'])) {
   echo $_SESSION['no-login-message'];
   unset($_SESSION['no-login-message']);
  }
  ?>
  <br><br>

  <!-- Login Form Starts Here -->
  <form action="" method="POST" class="text-center">
   Username: <br>
   <input type="text" name="username" placeholder="Enter Username">
   <br><br>
   Password: <br>
   <input type="password" name="password" placeholder="Enter Password">
   <br><br>
   <input type="submit" name="submit" value="Login" class="btn-primary"><br><br>

  </form>
  <!-- Login Form End Here -->


  <p class="text-center">Created By - <a href="#">TTT</a></p>
 </div>
</body>

</html>

<?php

if (isset($_POST['submit'])) {
 $username = $_POST['username'];
 $password = md5($_POST['password']);

 $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";

 $res = mysqli_query($conn, $sql);

 $count = mysqli_num_rows($res);
 echo $count;

 if ($count == 1) {
  $_SESSION['login'] = "<div class='success'>Login successful.</div>";
  $_SESSION['user'] = $username; // To check whether the user is log in or not, and logout will unset it

  header('location:' . SITEURL . 'admin/');
 } else {
  $_SESSION['login'] = "<div class='error'>Username or Password did not match</div>";
 }
}
?>