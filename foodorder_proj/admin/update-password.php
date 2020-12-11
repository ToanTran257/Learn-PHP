<?php include('partials/menu.php'); ?>

<div class="main-content">
 <div class="wrapper">
  <h1>Change Password</h1>
  <br><br>


  <?php
  if (isset($_GET['id'])) {
   $id = $_GET['id'];
  }

  if (isset($_SESSION['pw-not-match'])) {
   echo $_SESSION['pw-not-match'];
   unset($_SESSION['pw-not-match']);
  }

  ?>

  <form action="" method="POST">
   <table class="tbl-30">
    <tr>
     <td>Current Password: </td>
     <td>
      <input type="password" name="current_password" placeholder="Current password">
     </td>
    </tr>

    <tr>
     <td>New Password: </td>
     <td>
      <input type="password" name="new_password" placeholder="New password">
     </td>
    </tr>

    <tr>
     <td>Confirm Password: </td>
     <td>
      <input type="password" name="confirm_password" placeholder="Confirm password">
     </td>
    </tr>

    <tr>
     <td colspan="2">
      <input type="hidden" name="id" value="<?php echo $id; ?>">
      <input type="submit" name="submit" value="Change password" class="btn-secondary">
     </td>

    </tr>
   </table>


  </form>
 </div>
</div>

<?php

if (isset($_POST['submit'])) {
 $id = $_POST['id'];
 $current_pw = md5($_POST['current_password']);
 $new_pw = md5($_POST['new_password']);
 $confirm_pw = md5($_POST['confirm_password']);

 // Check if the current pw match
 $sql = "SELECT * FROM tbl_admin WHERE id=$id AND password='$current_pw'";

 $res = mysqli_query($conn, $sql);

 if ($res == true) {
  $count = mysqli_num_rows($res);

  if ($count == 1) {
   // echo "User Found";

   if ($new_pw == $confirm_pw) {
    // Update the Pw
    // echo  "It's the same";

    $sql = "UPDATE tbl_admin SET
    password='$new_pw' WHERE id=$id;
    ";

    $res = mysqli_query($conn, $sql);

    if ($res == true) {
     $_SESSION['pw-changed'] = "<div class='success'>Password Successfully Changed</div>";
    } else {
     $_SESSION['pw-changed'] = "<div class='error'>Password Failed to Changed</div>";
    }

    header('location:' . SITEURL . 'admin/manage-admin.php');
   } else {
    $_SESSION['pw-not-match'] = "<div class='error'>Password Did not Match</div>";
    header('location:' . $_SERVER['REQUEST_URI']);
   }
  } else {
   $_SESSION['user-not-found'] = "<div class='error'>Wrong Password</div>";
   header('location:' . SITEURL . 'admin/manage-admin.php');
  }
 }
}


?>

<?php include('partials/footer.php'); ?>