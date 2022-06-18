<?PHP
include_once("inc/header.php");
include_once("inc/sidebar.php");
include_once("../include/connect.php");
$msg='';
$title='';
$post='';
$date=date("Y-M-d");
if (isset($_POST['add_post'])){
    $title=strip_tags($_POST['title']);
    $post=$_POST['post'];
    $Category=$_POST['Category'];
    $Status=$_POST['status'];
    if (empty($title)){
        $msg='<div class="alert alert-danger text-center" role="alert">empty title !</div>';

    }
    elseif (empty($post)) {
        $msg='<div class="alert alert-danger text-center" role="alert">empty post !</div>';
    }
    elseif (empty($Category)) {
        $msg='<div class="alert alert-danger text-center" role="alert">empty Category !</div>';
    }
    else{

            $picture=$_FILES['img'];
            $picture_name=$picture['name'];
            $picture_tmp_name=$picture['tmp_name'];
            $picture_error=$picture['error'];
            $picture_size=$picture['size'];
            if ( $picture_name!=''){
            $picture_type_u=explode('.',$picture_name);
            $picture_type=strtolower(end($picture_type_u));
            $allow=array('png','jpg','gif','jpeg');
            if(in_array($picture_type,$allow)){
                if( $picture_error==0){
                    if($picture_size<=30000000){
                        $picture_new_name=uniqid('post',false).".".$picture_type;
                        $picture_dir='../img/post/'.$picture_new_name;
                        $picture_DB_dir='img/post/'.$picture_new_name;
                        if(move_uploaded_file($picture_tmp_name,$picture_dir)){
                            $insert=mysqli_query($connect,"INSERT INTO POST (`titile`,`post`,`category`,`image`,`author`,`status`,`post_date`) 
                                                                           VALUES ('$title','$post','$Category','$picture_DB_dir','$_SESSION[user_id]','$Status','$date')");
                            if (isset($insert)){
                               $msg='<div class="alert alert-success" role="alert"> sucssesful added </div>';
                                echo'<meta http-equiv="refresh" content="2;\'posts.php\'"/>';
                            }
                        }else{$msg='<div class="alert alert-danger" role="alert">An error occurred while transferring the image! </div>';}
                    }else{$msg='<div class="alert alert-danger" role="alert">The image is larger than the allowable size! </div>';}
                }else{$msg='<div class="alert alert-danger" role="alert">An unexpected error occurred! </div>';}


            }else{$msg='<div class="alert alert-danger" role="alert">This file is not an image! </div>';}

        }

        else{
            $insert=mysqli_query($connect,"INSERT INTO POST (`titile`,`post`,`category`,`author`,`status`,`post_date`) 
                                                                           VALUES ('$title','$post','$Category','$_SESSION[user_id]','$Status','$date')");
            if (isset($insert)){
                $msg='<div class="alert alert-success" role="alert"> sucssesful added </div>';
                echo'<meta http-equiv="refresh" content="2;\'posts.php\'"/>';
            }

        }
    }
}

?>
    <div class="col-sm-9">
        <div class="row">
            <div class="col-sm-1"> </div>
            <div class="col-sm-10">
                <?php
                echo $msg ;
                ?>
                <div class="card">
                    <div class="card-header bg-info text-center text-light">
                        <b> Add New Article</b>
                    </div>
                    <div class="card-body">
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="form-group row">
                                <label for="title" class="col-sm-2 col-form-label">Article title</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="title" name="title" value="<?php echo $title;?>" placeholder="Article title">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="post" class="col-sm-2 col-form-label">Artical</label>
                                <div class="col-sm-10">
                                <textarea class="form-control"id="full-featured-non-premium" name="post" <?php echo $post;?> rows="8"></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="Category" class="col-sm-2 col-form-label">Select Category</label>
                                <div class="col-sm-4">
                            <select class="custom-select" name="Category" id="Category">
                                <option value="">Select Category</option>
                                <?Php
                                $cat=mysqli_query($connect,"SELECT * FROM category");
                                    while($cate=mysqli_fetch_assoc($cat)){
                                        echo '<option value="'.$cate['category'].'">'.$cate['category'].'</option>';
                                    }
                                ?>


                            </select>
                            </div>
                            </div>
                            <div class="form-group row">
                                <label for="Status" class="col-sm-2 col-form-label">Article status</label>
                                <div class="col-sm-4">

                                    <select class="custom-select" name="status" id="status">
                                        <option value="publishing">publishing</option>
                                        <option value="Disable">Disable</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="img" class="col-sm-2 col-form-label">Example file input</label>
                                <div class="col-sm-5">
                                <input type="file" class="form-control-file" id="img" name="img">
                            </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-2 "> </div>
                                <div class="col-sm-10 ">
                                    <button type="submit" name="add_post" class="btn btn-danger">Add Article</button>
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
<?PHP
include_once("inc/footer.php");
?>