<?php include('partials/menu.php'); ?>

<div class="main-content">
 <div class="wrapper">
  <h1>Add Category</h1>
  <br><br>

  <?php
  if (isset($_SESSION['add'])) {
   echo $_SESSION['add'];
   unset($_SESSION['add']);
  }
  if (isset($_SESSION['upload'])) {
   echo $_SESSION['upload'];
   unset($_SESSION['upload']);
  }
  ?>

  <!-- Add Category Form Starts -->
  <form action="" method="POST" enctype="multipart/form-data">
   <table>
    <tr>
     <td>
      Title:
     </td>
     <td>
      <input type="text" name="title" placeholder="Category Title">
     </td>
    </tr>

    <tr>
     <td>Select image: </td>
     <td>
      <input type="file" name="image">
     </td>

    </tr>

    <tr>
     <td>Featured: </td>
     <td><input type="radio" name="featured" value="Yes"> Yes</td>
     <td><input type="radio" name="featured" value="No"> No</td>

    </tr>
    <tr>
     <td>Active: </td>
     <td><input type="radio" name="active" value="Yes"> Yes</td>
     <td><input type="radio" name="active" value="No"> No</td>

    </tr>
    <tr colspan="2">
     <td>
      <input type="submit" name="submit" value="Add Category" class="btn-secondary">
     </td>
    </tr>
   </table>
  </form>
  <!-- Add Category Form Ends -->

  <?php
  if (isset($_POST['submit'])) {
   $title = $_POST['title'];

   if (isset($_POST['featured'])) {
    $featured = $_POST['featured'];
   } else {
    $featured = "No";
   }

   if (isset($_POST['active'])) {
    $active = $_POST['active'];
   } else {
    $active = "No";
   }

   // Check whether the image is selected
   // print_r($_FILES['image']);

   // die();

   if (isset($_FILES['image']['name'])) {
    // Upload image
    $image_name = $_FILES['image']['name'];

    if ($image_name != "") {
     // Auto rename our imager
     // Get the extension of our image
     $ext = end(explode('.', $image_name));
     $image_name = "Food_Category_" . rand(000, 999) . '.' . $ext;


     $source_path = $_FILES['image']['tmp_name'];
     $destination_path = "../images/category/" . $image_name;

     // Upload image
     $upload = move_uploaded_file($source_path, $destination_path);

     if ($upload == false) {
      $_SESSION['upload'] = "<div class='error'>Failed to Upload Image. </div>";
      header('location:' . SITEURL . 'admin/add-category.php');
      die();
     }
    }
   } else {
    $image_name = "";
   }

   $sql = "INSERT INTO tbl_category SET
   title='$title',
   image_name='$image_name',
   featured='$featured',
   active='$active'
   ";

   $res = mysqli_query($conn, $sql);

   if ($res == true) {
    $_SESSION['add'] = "<div class='success'>Category Added Successfully.</div>";
    header('location:' . SITEURL . 'admin/manage-category.php');
   } else {
    $_SESSION['add'] = "<div class='error'>Failed to add category.</div>";
    header('location:' . SITEURL . 'admin/add-category.php');
   }
  }
  ?>

 </div>
</div>

<?php include('partials/footer.php'); ?>