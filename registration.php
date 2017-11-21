<?php  include "includes/db.php"; ?>
<?php  include "includes/header.php"; ?>
<link rel="stylesheet" href="css/content.css">



<?php

if(isset($_POST['submit'])){
  $username = $_POST['username'];
  $email = $_POST['email'];
  $password = $_POST['password'];

  if(!empty($username) && !empty($email) && !empty($password)){

    $username = mysqli_real_escape_string($connection,$username);
    $email = mysqli_real_escape_string($connection,$email);
    $password = mysqli_real_escape_string($connection,$password);

    // security - password encryption
    $query="SELECT randSalt FROM users";
    $select_randSalt_query=mysqli_query($connection,$query);
    if(!$select_randSalt_query){
      die("Query Failed" . mysqli_error($connection));
    }

    $row=mysqli_fetch_array($select_randSalt_query);
    $salt = $row['randSalt'];
    $password = crypt($password,$salt);

    $query="INSERT INTO users(username, user_email, user_password, user_role) ";
    $query .="VALUES('{$username}', '{$email}', '{$password}', 'subscriber' )";
    $register_user_query = mysqli_query($connection,$query);
    if(!$register_user_query){
      die("Query Failed" . mysqli_error($connection) . ' ' . mysqli_errno($connection));
    }
    $message='Your form has been submitted';

  }


  else {
    $message="The field can not be left empty";
  }

}
else{
  $message="";
}

?>

<!-- navigation -->
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

      <a class="navbar-brand" href="./index.php" style="color: white;">
        <span><img src="../Images/nitlogo1.png" width="25" height="25" style="float:left;margin-top:-4px;margin-right:3px;"/></span>NITRvoice<i class="fa fa-bullhorn"></i></a>
      </div>
      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-tags" style="margin-right:3px;"></i>Categories<i class="fa fa-fw fa-caret-down"></i></a>
            <ul class="dropdown-menu">
              <?php
              $query="SELECT * FROM categories";
              $select_all_categories_query=mysqli_query($connection,$query);
              while($row=mysqli_fetch_assoc($select_all_categories_query)){
                $cat_title=$row['cat_title'];
                $cat_id=$row['cat_id'];

                echo "<li><a href='./category_page.php?category=$cat_id'>$cat_title</a></li>";
              }?>
            </ul>
          </li>
        </ul>

        <ul class="nav navbar-nav navbar-right">
          <li>
            <a href="loginpage.php"><i class="fa fa-user" style="margin-right:4px;"></i>Log In</a>
          </li>
        </ul>
      </div>
      <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
  </nav>

  <!-- Page Content -->
  <section id="login">
    <div id="content" class="container">
      <div class="row">
        <div class="col-xs-6 col-xs-offset-3">
          <div class="form-wrap">
            <div class="jumbotron" style="margin-top:40px;">
              <h1>Register</h1><hr>
              <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                <h6 class="text-center text-success"><?php echo $message; ?></h6>

                <div class="form-group">
                  <label for="username">Username</label>
                  <input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username" required>
                </div>
                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com" required>
                </div>
                <div class="form-group">
                  <label for="password">Password</label>
                  <input type="password" name="password" id="key" class="form-control" placeholder="Password" required>
                </div>
                <div class="form-group">
                  <input type="submit" name="submit" id="btn-login" class="btn btn-lg btn-success" value="Register">
                </div>
              </form>
            </div>
          </div>
        </div> <!-- /.col-xs-12 -->
      </div> <!-- /.row -->
    </div> <!-- /.container -->
  </section>


  <!-- jQuery -->
  <script src="js/jquery.js"></script>

  <!-- Bootstrap Core JavaScript -->
  <script src="js/bootstrap.min.js"></script>

</body>

</html>
