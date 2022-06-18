<?PHP
include_once("../../include/connect.php");
if(isset($_POST['submit'])){
  if(empty($_POST['category'])){
    echo '<div class="alert alert-danger text-center" role="alert">empty category !</div>';
    echo'<meta http-equiv="refresh" content=".3;\'category.php\'"/>';
  }else{
    $insert=mysqli_query($connect,"INSERT INTO `category`( `category`) VALUES ('$_POST[category]')");
    if(isset($insert)){
      echo'<div class="alert alert-success text-center" role="alert">Add category </div>';
      echo'<meta http-equiv="refresh" content=".3;\'category.php\'"/>';
  
     }

  }
}

?>