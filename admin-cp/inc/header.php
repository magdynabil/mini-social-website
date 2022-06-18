<?php include_once("inc/setion.php"); ?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/admin-cp.css">

    <title>Hello, world!</title>
  </head>
  <body>
   <!--start navbar-->
   <nav class="navbar navbar-expand-sm navbar-light bg-light">
   <a class="navbar-brand" href="index.php"><p></p><span><i class="fas fa-tachometer-alt fa-sm "></i> control</span><span> Board</span></a>
   <a class="navbar font-weight-bold text-dark" href="../index.php"  style="font-size: x-large"><i class="fas fa-home"></i>  home</a>

    <ul class="navbar-nav ml-auto">
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Setting <i class="fas fa-cog"></i>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Personal page</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="../logout.php?id=<?php echo$_SESSION['user_id'];?>">Sign out</a>
      </li>
    </ul>
  </div>
</nav>
<!--end nav bar-->
<!--statr panal-->
<div class="container-fluid "style="margin-top:30px">
<div class="row">