
<!-- /.row -->

<div class="row">
  <div class="col-lg-3 col-md-6">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <div class="row">
          <div class="col-xs-3">
            <i class="fa fa-file-text fa-5x"></i>
          </div>
          <div class="col-xs-9 text-right">

            <!-- counting number of posts -->
            <?php
            $query="SELECT * FROM posts";
            $select_all_posts=mysqli_query($connection,$query);
            $posts_count=mysqli_num_rows($select_all_posts);

            echo "<div class='huge'>{$posts_count}</div>";

            ?>

            <div>Posts</div>
          </div>
        </div>
      </div>
      <a href="posts.php">
        <div class="panel-footer">
          <span class="pull-left">View Details</span>
          <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
          <div class="clearfix"></div>
        </div>
      </a>
    </div>
  </div>
  <div class="col-lg-3 col-md-6">
    <div class="panel panel-green">
      <div class="panel-heading">
        <div class="row">
          <div class="col-xs-3">
            <i class="fa fa-comments fa-5x"></i>
          </div>
          <div class="col-xs-9 text-right">
            <!-- counting number of comments -->
            <?php
            $query="SELECT * FROM comments";
            $select_all_comments=mysqli_query($connection,$query);
            $comments_count=mysqli_num_rows($select_all_comments);

            echo "<div class='huge'>{$comments_count}</div>";

            ?>

            <div>Comments</div>
          </div>
        </div>
      </div>
      <a href="comments.php">
        <div class="panel-footer">
          <span class="pull-left">View Details</span>
          <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
          <div class="clearfix"></div>
        </div>
      </a>
    </div>
  </div>
  <div class="col-lg-3 col-md-6">
    <div class="panel panel-yellow">
      <div class="panel-heading">
        <div class="row">
          <div class="col-xs-3">
            <i class="fa fa-user fa-5x"></i>
          </div>
          <div class="col-xs-9 text-right">
            <!-- counting number of users -->
            <?php
            $query="SELECT * FROM users";
            $select_all_users=mysqli_query($connection,$query);
            $users_count=mysqli_num_rows($select_all_users);

            echo "<div class='huge'>{$users_count}</div>";

            ?>

            <div> Users</div>
          </div>
        </div>
      </div>
      <a href="users.php">
        <div class="panel-footer">
          <span class="pull-left">View Details</span>
          <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
          <div class="clearfix"></div>
        </div>
      </a>
    </div>
  </div>
  <div class="col-lg-3 col-md-6">
    <div class="panel panel-red">
      <div class="panel-heading">
        <div class="row">
          <div class="col-xs-3">
            <i class="fa fa-list fa-5x"></i>
          </div>
          <div class="col-xs-9 text-right">

            <!-- counting number of categories -->
            <?php
            $query="SELECT * FROM categories";
            $select_all_categories=mysqli_query($connection,$query);
            $categories_count=mysqli_num_rows($select_all_categories);

            echo "<div class='huge'>{$categories_count}</div>";

            ?>

            <div>Categories</div>
          </div>
        </div>
      </div>
      <a href="categories.php">
        <div class="panel-footer">
          <span class="pull-left">View Details</span>
          <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
          <div class="clearfix"></div>
        </div>
      </a>
    </div>
  </div>
</div>
<!-- /.row -->

<?php

$query="SELECT * FROM posts WHERE post_status= 'draft' ";
$select_all_draft_posts=mysqli_query($connection,$query);
$posts_draft_count=mysqli_num_rows($select_all_draft_posts);

$query="SELECT * FROM posts WHERE post_status= 'draft' ";
$select_all_draft_posts=mysqli_query($connection,$query);
$posts_draft_count=mysqli_num_rows($select_all_draft_posts);

$query="SELECT * FROM posts WHERE post_status= 'draft' ";
$select_all_draft_posts=mysqli_query($connection,$query);
$posts_draft_count=mysqli_num_rows($select_all_draft_posts);

?>

<!-- bar chart -->

<div class="container">

  <div class="row">

    <script type="text/javascript">

    google.charts.load('current', {'packages':['bar']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
      var data = google.visualization.arrayToDataTable([
        ['Data', 'Count'],

        <?php

        $element_text=['Active Posts', 'Draft Posts', 'Comments', 'Users', 'categories'];
        $element_count=[$posts_count, $posts_draft_count, $comments_count, $users_count, $categories_count];

        for ($i=0; $i < 5 ; $i++) {
          echo "['{$element_text[$i]}' " . "," . "{$element_count[$i]}],";
        }


        ?>

        // ['Post', 1000],

      ]);

      var options = {
        chart: {
          title: '',
          subtitle: '',
        }
      };

      var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

      chart.draw(data, google.charts.Bar.convertOptions(options));
    }

    </script>

    <div id="columnchart_material" style="width: 'auto'; height: 500px;"></div>

  </div>
</div>
