<?PHP
include_once("inc/header.php");
include_once("inc/sidebar.php");
include_once("../include/connect.php");

?>
<div class="col-sm-9">
    <div class="row">
<div class="col-sm-8">
<div class="card">
  <div class="card-header bg-info text-center text-light">
  Categories
  </div>
  <div class="card-body">
  <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Category name</th>
      <th scope="col">Modify</th>
      <th scope="col">Delete</th>
    </tr>
  </thead>
  <tbody>
  <?Php
  $cat=mysqli_query($connect,"SELECT * FROM category");
  $num=1;
  while($category=mysqli_fetch_assoc($cat)){
    echo'<tr>
    <th scope="row">'.$num.'</th>
    <td>'.$category['category'].'</td>
    <td><a href="edet_category.php?cat='.$category['category_id'].'" class="btn btn-warning  btn-sm">Modify</a></td>
    <td><a href="category.php?delete='.$category['category_id'].'" class="btn btn-danger  btn-sm">Delete</a></td>
  </tr>';
  $num++;
  }
  if(isset($_GET['delete'])){
    $delete_cat=mysqli_query($connect,"DELETE FROM `category` WHERE category_id=$_GET[delete]");
    if(isset($delete_cat)){
    echo'<div class="alert alert-success text-center" role="alert">category cleared</div>';
    echo'<meta http-equiv="refresh" content=".3;\'category.php\'"/>';
    }
  }
  ?>
    
  </tbody>
</table>
  </div>
</div>
</div>

<div class="col-sm-4">
<div class="card">
  <div class="card-header bg-info text-center text-light">
  Add a new category
  </div>
  <div class="card-body">
  <form action="inc/cat.php" method="post" id="cats">
  <div class="form-group row">
    <label for="category" class="col-sm-4 col-form-label">category</label>
    <div class="col-sm-8">
      <input type="text" class="form-control"  name="category" placeholder="Add category">
    </div>
  </div>
  <hr>
  <div class="form-group row text-center">
    <div class="col-sm-12">
    <div id="cat"></div>
    <button type="submit" name="submit" class="btn btn-info">Add category</button>
    </div>
  </div>
</form>
  </div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<?PHP
include_once("inc/footer.php");
?>