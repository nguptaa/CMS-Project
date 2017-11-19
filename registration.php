<?php  include "includes/db.php"; ?>
<?php  include "includes/header.php"; ?>

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
          <a href="loginpage.php"><i class="fa fa-user" style="margin-right:4px;"></i>Log In</a>
        </li>
      </ul>
    </div>
    <!-- /.navbar-collapse -->
  </div>
  <!-- /.container -->
</nav>


<!-- Page Content -->
<div class="container">

  <section id="login">
    <div class="container">
      <div class="row">
        <div class="col-xs-6 col-xs-offset-3">
          <div class="form-wrap">
            <h1>Register</h1><hr>
            <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
              <h6 class="text-center text-danger"><?php echo $message; ?></h6>

              <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username">
              </div>
              <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">
              </div>
              <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="key" class="form-control" placeholder="Password">
              </div>
              <div class="form-group">
                <input type="submit" name="submit" id="btn-login" class="btn btn-lg btn-success" value="Register">

              </div>
            </form>

          </div>
        </div> <!-- /.col-xs-12 -->
      </div> <!-- /.row -->
    </div> <!-- /.container -->
  </section>


  <hr>



  <?php include "includes/footer.php";?>
