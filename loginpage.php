<?php  include "includes/db.php"; ?>
<?php  include "includes/header.php"; ?>


<!-- Navigation -->

<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="./index.php">CMS Front</a>
    </div>
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <?php
        $query="SELECT * FROM categories";
        $select_all_categories_query=mysqli_query($connection,$query);
        while($row=mysqli_fetch_assoc($select_all_categories_query)){
          $cat_title=$row['cat_title'];
          echo "<li><a href='#''>
          {$cat_title}
          </a></li>";
        }

        ?>

        <li>
          <a href="admin">ADMIN</a>
        </li>

        <?php

        if(!isset($_SESSION['user_role'])){
          if(isset($_GET['p_id'])){
            $the_post_id= $_GET['p_id'];
            echo "<li><a href='admin/posts.php?source=edit_post&p_id={$the_post_id}'>Edit Post</a></li>";
          }
        }

        ?>

      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li>
          <a href="../registration.php"><i class="fa fa-user-plus" style="margin-right:4px;"></i>Sign Up</a>
        </li>
      </ul>
    </div>
    <!-- /.navbar-collapse -->
  </div>
  <!-- /.container -->
</nav>


<!-- login -->
<div class="container">

  <section id="login">
    <div class="container">
      <div class="row">
        <div class="col-xs-6 col-xs-offset-3">
          <div class="form-wrap">
            <h4>Login</h4>
            <hr>
            <form action="includes/login.php" method="post">
              <div class="form-group">
                <label for="username">Username</label>
                <input name="username" type="text" class="form-control" placeholder="Enter Username">
              </div>
              <div class="form-group">
                <label for="password">Password</label>
                <input name="password" type="password" class="form-control" placeholder="Enter Password">
                <!-- <span class="input-group-btn">
                <button name="login" class="btn btn-primary" type="submit">Submit</button> -->

                <!-- </span> -->
              </div>
              <div class="form-group">
                <input type="submit" name="login" id="btn-login" class="btn btn-lg btn-success" value="Login">

              </div>
            </form>
          </div>
        </div> <!-- /.col-xs-12 -->
      </div> <!-- /.row -->
    </div> <!-- /.container -->
  </section>




  <hr>



  <?php include "includes/footer.php";?>
