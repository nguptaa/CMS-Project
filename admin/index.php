<?php include "includes/admin_header.php" ?>

<div id="wrapper">

  <?php
  if(!$connection){
    die("database not connected");
  }
  ?>

  <?php include "includes/admin_navigation.php" ?>


  <div id="page-wrapper">

    <div class="container-fluid">

      <!-- Page Heading -->
      <div class="row">
        <div class="col-lg-12">
          <h1 class="page-header">
            Welcome to admin
            <small><?php echo $_SESSION['username'] ?></small>
          </h1>


        </div>
      </div>
      <!-- /.row -->

      <?php include "admin_widgets.php"; ?>

    </div>
    <!-- /.container-fluid -->

  </div>
  <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->
<?php include "includes/admin_footer.php" ?>
