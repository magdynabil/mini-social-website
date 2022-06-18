<?php 
include_once("connect.php");
include_once("function.php");
session_start();
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/cr.css">
    

    <title>Hello, world!</title>
  </head>
  <body>
    <!--start upper bar-->

<?Php
login_area();
?>

<!--end upper bar-->
<!--start navbar-->
<nav class="navbar navbar-expand-lg navbar-light ">
    <div class="container-fluid">
        <a class="navbar-brand" href="#"><p>M</p><span>MA</span><span>GDY</span></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mainnav" aria-controls="mainnav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="mainnav">
            <ul class="navbar-nav">
                <li class="nav-item active ">
                    <a class="nav-link" href="index.php">Home </a>
                </li>
               <?php
               $sql=mysqli_query($connect,"SELECT * FROM category");
               while ($cat=mysqli_fetch_assoc($sql)){
                   echo '<li class="nav-item active "> <a class="nav-link" href="post.php?cat='.$cat['category'].'">'.$cat['category'].'</a> </li>';
               }
               ?>
                </ul>
                <?php
                if(isset($_SESSION['user_id'])) {

                    ?>
                    <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown ">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        setting <i class="fas fa-cog"></i>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">personal page</a>
                        <?php 
                        if($_SESSION['user_rank']=='admin'){
                            echo' <a class="dropdown-item" href="admin-cp/index.php">control Board</a>';
                        }
                        ?>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="logout.php?id=<?php echo$_SESSION['user_id'];?>">sign out</a>
                    </div>
                </li>
                <?php
                }else{
                ?>
                <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link " href="rigister.php">Sign Up </a>
                </li>
                <?php
                }
                ?>
            </ul>
        </div>
    </div>
</nav>
<!--end nav bar-->
