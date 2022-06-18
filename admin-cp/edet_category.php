<?PHP
include_once("inc/header.php");
include_once("inc/sidebar.php");
include_once("../include/connect.php");
$msg='';
if(isset($_GET['cat'])){
    $sql=mysqli_query($connect,"SELECT `category_id`, `category` FROM `category` WHERE category_id='$_GET[cat]'");
    $category=mysqli_fetch_assoc($sql);
}
if(isset($_POST['edit'])){
    $sql=mysqli_query($connect,"UPDATE `category` SET `category`='$_POST[category]' WHERE category_id='$_GET[cat]'");
    if(isset($sql)){
        header("location:category.php");
    }
}

?>
<div class="col-sm-9">
<div class="row">
<div class="col-sm-12">
<div class="card">
  <div class="card-header bg-info text-center text-light">
  Edit Category : <?php echo $category['category']; ?>
  </div>
  <div class="card-body">
  <form action="" method="post" >
  <div class="form-group row">
    <label for="category" class="col-sm-4 col-form-label">category</label>
    <div class="col-sm-8">
      <input type="text" class="form-control"  name="category" value=" <?php echo $category['category']; ?>">
    </div>
  </div>
  <hr>
  <div class="form-group row text-center">
    <div class="col-sm-12">
    <button type="edit" name="edit" class="btn btn-info">Edit Category</button>
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