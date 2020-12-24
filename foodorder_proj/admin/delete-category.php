<?php

include('../config/constants.php');

if (isset($_GET['id']) && isset($_GET['image_name'])) {
 $id = $_GET['id'];
 $image_name = $_GET['image_name'];

 // Remove the physical image file is available
 if ($image_name != "") {
  $path = "../images/category/" . $image_name;

  // Remove image
  $remove = unlink($path);

  if ($remove == false) {
   $_SESSION['remove'] = "<div ckass='error'>Failed to Remove Category Image.</div>";
   header('location:' . SITEURL . 'admin/manage-category.php');
   die();
  }
 }

 $sql = "DELETE FROM tbl_category WHERE id=$id";
 $res = mysqli_query($conn, $sql);

 // Redirect to Manage with message
 if ($res) {
  $_SESSION['delete'] = "<div class='success'>Category Deleted Successfully</div>";
  header('location:' . SITEURL . 'admin/manage-category.php');
 } else {
  $_SESSION['delete'] = "<div class='error'>Category Failed to Delete Successfully</div>";
  header('location:' . SITEURL . 'admin/manage-category.php');
 }
} else {
 header('location:' . SITEURL . 'admin/manage-category.php');
}



echo $id;