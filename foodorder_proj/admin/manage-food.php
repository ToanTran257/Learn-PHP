<?php include('partials/menu.php') ?>

<div class="main-content">
 <div class="wrapper">
  <h1>Manange Food</h1>
  <br>
  <a href="<?php echo SITEURL ?>admin/add-food.php" class="btn-primary">Add Food</a>
  <br>
  <br>

  <?php
  if (isset($_SESSION['add'])) {
   echo $_SESSION['add']; // Display Session Message
   unset($_SESSION['add']); // Removing Session Message
  }
  ?>

  <table class="tbl-full">
   <tr>
    <th>S.N.</th>
    <th>Title</th>
    <th>Price</th>
    <th>Image</th>
    <th>Featured</th>
    <th>Active</th>
    <th>Actions</th>
   </tr>

   <?php
   $sql = "SELECT * FROM tbl_food";

   $res = mysqli_query($conn, $sql);

   $count = mysqli_num_rows($res);

   $sn = 1;

   if ($count > 0) {
    while ($row = mysqli_fetch_assoc(($res))) {
     $id = $row['id'];
     $title = $row['title'];
     $price = $row['price'];
     $image_name = $row['image_name'];
     $featured = $row['featured'];
     $active = $row['active'];

   ?>

   <tr>
    <td><?php echo $sn++; ?></td>
    <td><?php echo $title; ?></td>
    <td>$<?php echo $price; ?></td>
    <td><?php
          if ($image_name == "") {
           echo "<div class='error'>Image not Added.</div>";
          } else {
          ?>
     <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Food" width="100px">
     <?php
          }

       ?>
    </td>
    <td><?php echo $featured; ?></td>
    <td><?php echo $active; ?></td>
    <td>
     <a href="#" class="btn-secondary">Update Admin</a>
     <a href="#" class="btn-danger">Delete Admin</a>
    </td>
   </tr>

   <?php


    }
   } else {
    echo "<tr> <td colspan='7' class='error'>Food not Added Yet. </td> </tr>";
   }
   ?>

  </table>
 </div>
</div>


<?php include('partials/footer.php') ?>