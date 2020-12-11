<?php include('partials/menu.php') ?>

<!-- Main Content Section Starts -->
<div class="main-content">
 <div class="wrapper">
  <h1>Manage Admin</h1>
  <br>
  <br>

  <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add']; // Display Session Message
            unset($_SESSION['add']); // Removing Session Message
        }

        if (isset($_SESSION['delete'])) {
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }

        if (isset($_SESSION['update'])) {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }

        if (isset($_SESSION['user-not-found'])) {
            echo $_SESSION['user-not-found'];
            unset($_SESSION['user-not-found']);
        }

        if (isset($_SESSION['pw-changed'])) {
            echo $_SESSION['pw-changed'];
            unset($_SESSION['pw-changed']);
        }
        ?>

  <br><br>
  <!-- Button to Add Admin -->
  <a href="add-admin.php" class="btn-primary">Add Admin</a>
  <br>
  <br>
  <table class="tbl-full">
   <tr>
    <th>S.N.</th>
    <th>Full Name</th>
    <th>Username</th>
    <th>Actions</th>
   </tr>

   <?php
            // Query to Get All Admin
            $sql = "SELECT * FROM tbl_admin";

            // Execute the Query
            $res = mysqli_query($conn, $sql);

            // Check whether the Query is executed or not
            if ($res == TRUE) {
                // Count Rows to check whether we have data in database or not
                $count = mysqli_num_rows($res); //Function to get all the rows in Db

                // Check the num of rows
                if ($count > 0) {
                    $sn = 1;
                    // We have data in db
                    while ($rows = mysqli_fetch_assoc($res)) {
                        // Using while loop to get all the data from db
                        // And while loop will run as long as we have data in db

                        // Get individual data
                        $id = $rows['id'];
                        $full_name = $rows['full_name'];
                        $username = $rows['username'];

                        // Display the values in our table
            ?>
   <tr>
    <td><?php echo $sn; ?></td>
    <td><?php echo $full_name; ?></td>
    <td><?php echo $username; ?></td>
    <td>
     <a href="<?php echo SITEURL; ?>admin/update-password.php?id=<?php echo $id; ?>" class="btn-primary">Change
      Password</a>
     <a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id; ?>" class="btn-secondary">Update Admin</a>
     <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id; ?>" class="btn-danger">Delete Admin</a>
    </td>
   </tr>
   <?php
                        $sn++;
                    }
                } else {
                    // We do not have data in DB
                }
            }

            ?>
  </table>

  <div class="clearfix"></div>
 </div>
</div>

<!-- Main Content Section Ends -->

<?php include('partials/footer.php') ?>