<?php include("partials/menu.php"); ?>

<div class="main-content">
 <div class="wrapper">
  <h1>Update Category</h1>
  <br><br>

  <?php
  if (isset($_GET['id'])) {
   $id = $_GET['id'];

   $sql = "SELECT * from tbl_category WHERE id=$id";

   $res = mysqli_query($conn, $sql);

   $count = mysqli_num_rows($res);

   if ($count == 1) {
    $row = mysqli_fetch_assoc($res);

    $title = $row['title'];
    $current_image = $row['image_name'];
    $featured = $row['featured'];
    $active = $row['active'];
   } else {
    $_SESSION['no-category-found'] = "<div class='error'>Category Not Found</div>";
    header('location:' . SITEURL . 'admin/manage-category.php');
   }
  } else {
   header('location:' . SITEURL . 'admin/manage-category.php');
  }
  ?>

  <form action="" method="POST" enctype="multipart/form-data">
   <table class="tbl-30">
    <table>
     <tr>
      <td>
       Title:
      </td>
      <td>
       <input type="text" name="title" value="<?php echo $title; ?>">
      </td>
     </tr>

     <tr>
      <td>Current image: </td>
      <td>
       <?php
       if ($current_image != "") {
       ?>
       <img src="<?php echo SITEURL; ?>images/category/<?php echo $current_image;  ?>" width='150px' />
       <?php
       } else {
        // Display message
        echo "<div class='error'>Image not Added.</div>";
       }
       ?>
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
      <td><input <?php if ($featured == "Yes") {
                  echo "checked";
                 } ?> type="radio" name="featured" value="Yes"> Yes</td>
      <td><input <?php if ($featured == "No") {
                  echo "checked";
                 } ?> type="radio" name="featured" value="No"> No</td>

     </tr>
     <tr>
      <td>Active: </td>
      <td><input <?php if ($active == "Yes") {
                  echo "checked";
                 } ?> type="radio" name="active" value="Yes"> Yes</td>
      <td><input <?php if ($active == "No") {
                  echo "checked";
                 } ?> type="radio" name="active" value="No"> No</td>

     </tr>
     <tr>
      <td>
       <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
       <input type="hidden" name="id" value="<?php echo $id; ?>">
       <input type="submit" name="submit" value="Update Category" class="btn-secondary">
      </td>
     </tr>
    </table>
  </form>
  <?php
  if (isset($_POST['submit'])) {
   $title = $_POST['title'];
   $id = $_POST['id'];
   $current_image = $_POST['current_image'];
   $featured = $_POST['featured'];
   $active = $_POST['active'];

   // Updating New image is selected
   if (isset($_FILES['image']['name'])) {
    // Get the image details
    $image_name = $_FILES['image']['name'];

    if ($image_name != "") {
     // Upload the New image
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
      header('location:' . SITEURL . 'admin/manage-category.php');
      die();
     }

     // Remove the Old Image
     if ($current_image != "") {
      $remove_path =
       "../images/category/" . $current_image;
      $remove = unlink($remove_path);

      // Check whether remove success
      if ($remove == false) {
       $_SESSION['failed-remove'] = "<div class='error'>Failed to Remove current Image</div>";
       header('location:' . SITEURL . 'admin/manage-category.php');
       die();
      }
     }
    } else {
     $image_name = $current_image;
    }
   } else {
    $image_name = $current_image;
   }

   $sql2 = "UPDATE tbl_category SET
    title= '$title',
    featured='$featured',
    active = '$active',
    image_name = '$image_name'
    WHERE id=$id
   ";

   $res2 = mysqli_query($conn, $sql2);

   if ($res2 == true) {
    $_SESSION['update'] = "<div class='success'>Category Updated Successfully.</div>";
    header('location:' . SITEURL . 'admin/manage-category.php');
   } else {
    $_SESSION['update'] = "<div class='error'>Failed to Update Category.</div>";
    header('location:' . SITEURL . 'admin/manage-category.php');
   }
  }
  ?>
 </div>
</div>

<?php include("partials/footer.php"); ?>