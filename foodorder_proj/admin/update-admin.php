<?php include('partials/menu.php'); ?>

<div class="main-content">
 <div class="wrapper">
  <h1>Update Admin</h1>
  <br><br>

  <?php
  $id = $_GET['id'];

  $sql = "SELECT * FROM tbl_admin WHERE id=$id";

  $res = mysqli_query($conn, $sql);

  if ($res == true) {
   // Check whether the data is available or not
   $count = mysqli_num_rows($res);

   // Check whether we have admin data or not
   if ($count == 1) {
    // Get the details
    echo "Admin available";
    $row = mysqli_fetch_assoc($res);

    $full_name = $row['full_name'];
    $user_name = $row['username'];
   } else {
    // Redirect to Manage ADmin page
    header('location:' . SITEURL . 'admin/manage-admin.php');
   }
  }

  ?>

  <form action="" method="POST">
   <table class="tbl-30">
    <tr>
     <td>Full Name: </td>
     <td>
      <input type="text" name="full_name" value="<?php echo $full_name ?>">
     </td>
    </tr>

    <tr>
     <td>UserName: </td>
     <td>
      <input type="text" name="username" value="<?php echo $user_name ?>">
     </td>
    </tr>

    <tr>
     <td colspan="2">
      <input type="hidden" name="id" value="<?php echo $id; ?>">
      <input type="submit" name="submit" value="Update Admin" class="btn-secondary">
     </td>

    </tr>

   </table>
  </form>
 </div>
</div>

<?php
// Check whether the submit button is clicked or not
if (isset($_POST['submit'])) {
 $id = $_POST['id'];
 $full_name = $_POST['full_name'];
 $username = $_POST['username'];

 $sql = "UPDATE tbl_admin SET
 full_name = '$full_name',
 username = '$username' WHERE id='$id';
 ";

 $res = mysqli_query($conn, $sql);

 if ($res == true) {
  $_SESSION['update'] = "<div class='success'>Update User Successfully</div>";
 } else {
  $_SESSION['update'] = "<div class='error'>Error Updating</div>";
 }

 header('location:' . SITEURL . 'admin/manage-admin.php');
}
?>


<?php include('partials/footer.php'); ?>