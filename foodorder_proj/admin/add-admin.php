<?php include('partials/menu.php'); ?>

<div class="main-content">
 <div class="wrapper">
  <h1>Add Admin</h1>
  <br><br>

  <?php
  if (isset($_SESSION['add'])) // Checking whether the session is Set or not
  {
   echo $_SESSION['add']; // Display Session Message
   unset($_SESSION['add']); // Removing Session Message
  }
  ?>


  <form action="" method="POST">
   <table class="tbl-30">
    <tr>
     <td>Full Name: </td>
     <td><input type="text" name="full_name" placeholder="Enter Your Name"></td>
    </tr>

    <tr>
     <td>Username: </td>
     <td><input type="text" name="username" placeholder="Enter Your Username"></td>
    </tr>

    <tr>
     <td>Password: </td>
     <td><input type="password" name="password" placeholder="Enter Your Password"></td>
    </tr>

    <tr>
     <td colspan="2">
      <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
     </td>
    </tr>
   </table>

  </form>
 </div>
</div>


<?php include('partials/footer.php'); ?>

<?php
// Process the value from Form and Save it in Database
// Check whether the submit button is clicked or not

if (isset($_POST['submit'])) {
 // Button Clicked

 // Get the Data from Form
 $full_name = $_POST['full_name'];
 $username = $_POST['username'];
 $password = md5($_POST['password']); // Pw Encryption with MD5

 // SQL Query
 $sql = "INSERT INTO tbl_admin SET
  full_name='$full_name',
  username='$username',
  password='$password'
  ";

 // Executing Query and Saving Data into DB
 $res = mysqli_query($conn, $sql) or die(mysqli_error());

 // Check whether the data is inserted (Query executed) or not and display appropriate msg
 if ($res == TRUE) {
  // Data Inserted
  // Create a session Variable to Display message
  $_SESSION['add'] = 'Admin Added Successfully';
  // Redirect Page To Manage Admin
  header("location:" . SITEURL . 'admin/manage-admin.php');
 } else {
  echo "Data not Inteserted";
  $_SESSION['add'] = 'Failed to Add Admin';
  // Redirect Page To Add Admin
  header("location:" . SITEURL . 'admin/add-admin.php');
 }
}
?>