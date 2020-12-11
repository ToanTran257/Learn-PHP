<?php
// Include constants.php file here
include('../config/constants.php');


// Get the ID of Admin to be deleted
$id = $_GET['id'];

// Create SQL Query to Delete Admin
$sql = "DELETE FROM tbl_admin WHERE id=$id";

// Execute the Query
$res = mysqli_query($conn, $sql);

// Check whether the query executed successfully or not
if ($res == true) {
 // Query executed - Admin deleted
 // echo "Admin Deleted";
 // Create Session Variable to display message
 $_SESSION['delete'] = "<div class='success'>Admin Deleted Successfully</div>";
 header('location:' . SITEURL . 'admin/manage-admin.php');


 // Redirect to Manage Admin Page
} else {
 // Failed
 // echo "Failed to Delete Admin";
 $_SESSION['delete'] = "<div class='error'>Failed to Delete Admin. Try again later</div>";
 header('location:' . SITEURL . 'admin/manage-admin.php');
}

 // Redirect to manageadmin page with message (success / error)