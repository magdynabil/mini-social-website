
<?PHP
include_once("inc/header.php");
include_once("inc/sidebar.php");
$msg='';

if (isset($_POST['sette'])){
    $sel_setting=mysqli_query($connect,"select *from `setting`");
    if (mysqli_num_rows($sel_setting) != 1 ){
        $picture=$_FILES['img'];
        $picture_name=$picture['name'];
        $picture_tmp_name=$picture['tmp_name'];
        $picture_error=$picture['error'];
        $picture_size=$picture['size'];
        if ( $picture_name !=''){
            $picture_type_u=explode('.',$picture_name);
            $picture_type=strtolower(end($picture_type_u));
            $allow=array('png','jpg','gif','jpeg');
            if(in_array($picture_type,$allow)){
                if( $picture_error==0){
                    if($picture_size<=30000000){
                        $picture_new_name=uniqid('logo',false).".".$picture_type;
                        $picture_dir='../img/'.$picture_new_name;
                        $picture_DB_dir='img/'.$picture_new_name;
                        if(move_uploaded_file($picture_tmp_name,$picture_dir)){
                            $insert=mysqli_query($connect,"INSERT INTO `setting`( `site_name`, `logo`, `slide`, `slide_value`, `section_a`, `section_a_value`, `section_b`, `section_b_value`, `tab_a`, `tab_a_value`, `tab_b`, `tab_b_value`, `tab_c`, `tab_c_value`, `Facebook`, `Twitter`, `Instagram`) VALUES ('$_POST[site_name]','$picture_DB_dir','$_POST[slide]','$_POST[slide_value]','$_POST[section_a]','$_POST[section_a_value]','$_POST[section_b]','$_POST[section_b_value]','$_POST[Tab_a]','$_POST[tab_a_value]','$_POST[tab_b]','$_POST[tab_b_value]','$_POST[tab_c]','$_POST[tab_c_value]','$_POST[Facebook]','$_POST[Twitter]','$_POST[Instagram]')");
                            if (isset($insert)){
                                $msg= '<div class="alert alert-success" role="alert"> Settings updated successfully </div>';
                            }
                        }else{$msg= '<div class="alert alert-danger" role="alert">An error occurred while transferring the image! </div>';}
                    }else{$msg= '<div class="alert alert-danger" role="alert">The image is larger than the allowable size! </div>';}
                }else{$msg= '<div class="alert alert-danger" role="alert">An unexpected error occurred! </div>';}


            }else{$msg= '<div class="alert alert-danger" role="alert">This file is not an image! </div>';}

        }

        else{
            $insert=mysqli_query($connect,"INSERT INTO `setting`( `site_name`, `slide`, `slide_value`, `section_a`, `section_a_value`, `section_b`, `section_b_value`, `tab_a`, `tab_a_value`, `tab_b`, `tab_b_value`, `tab_c`, `tab_c_value`, `Facebook`, `Twitter`, `Instagram`) VALUES ('$_POST[site_name]','$_POST[slide]','$_POST[slide_value]','$_POST[section_a]','$_POST[section_a_value]','$_POST[section_b]','$_POST[section_b_value]','$_POST[Tab_a]','$_POST[tab_a_value]','$_POST[tab_b]','$_POST[tab_b_value]','$_POST[tab_c]','$_POST[tab_c_value]','$_POST[Facebook]','$_POST[Twitter]','$_POST[Instagram]')");
            if (isset($insert)){
                $msg ='<div class="alert alert-success" role="alert"> Settings updated successfully </div>';
            }

        }
    }
    else{
        $picture=$_FILES['img'];
        $picture_name=$picture['name'];
        $picture_tmp_name=$picture['tmp_name'];
        $picture_error=$picture['error'];
        $picture_size=$picture['size'];
        if ( $picture_name !=''){
            $picture_type_u=explode('.',$picture_name);
            $picture_type=strtolower(end($picture_type_u));
            $allow=array('png','jpg','gif','jpeg');
            if(in_array($picture_type,$allow)){
                if( $picture_error==0){
                    if($picture_size<=30000000){
                        $picture_new_name=uniqid('logo',false).".".$picture_type;
                        $picture_dir='../img/'.$picture_new_name;
                        $picture_DB_dir='img/'.$picture_new_name;
                        if(move_uploaded_file($picture_tmp_name,$picture_dir)){
                            $insert=mysqli_query($connect,"UPDATE `setting` SET `site_name`='$_POST[site_name]', `logo`='$picture_DB_dir', `slide`='$_POST[slide]', `slide_value`='$_POST[slide_value]', `section_a`='$_POST[section_a]', `section_a_value`='$_POST[section_a_value]', `section_b`='$_POST[section_b]', `section_b_value`='$_POST[section_b_value]', `tab_a`='$_POST[Tab_a]', `tab_a_value`='$_POST[tab_a_value]', `tab_b`='$_POST[tab_b]', `tab_b_value`='$_POST[tab_b_value]', `tab_c`='$_POST[tab_c]', `tab_c_value`='$_POST[tab_c_value]', `Facebook`='$_POST[Facebook]', `Twitter`='$_POST[Twitter]', `Instagram`='$_POST[Instagram]'");
                            if (isset($insert)){
                                $msg= '<div class="alert alert-success" role="alert"> Settings updated successfully </div>';
                            }
                        }else{$msg= '<div class="alert alert-danger" role="alert">An error occurred while transferring the image! </div>';}
                    }else{$msg= '<div class="alert alert-danger" role="alert">The image is larger than the allowable size! </div>';}
                }else{$msg= '<div class="alert alert-danger" role="alert">An unexpected error occurred! </div>';}


            }else{$msg= '<div class="alert alert-danger" role="alert">This file is not an image! </div>';}

        }

        else{
            $insert=mysqli_query($connect,"UPDATE `setting` SET `site_name`='$_POST[site_name]', `slide`='$_POST[slide]', `slide_value`='$_POST[slide_value]', `section_a`='$_POST[section_a]', `section_a_value`='$_POST[section_a_value]', `section_b`='$_POST[section_b]', `section_b_value`='$_POST[section_b_value]', `tab_a`='$_POST[Tab_a]', `tab_a_value`='$_POST[tab_a_value]', `tab_b`='$_POST[tab_b]', `tab_b_value`='$_POST[tab_b_value]', `tab_c`='$_POST[tab_c]', `tab_c_value`='$_POST[tab_c_value]', `Facebook`='$_POST[Facebook]', `Twitter`='$_POST[Twitter]', `Instagram`='$_POST[Instagram]'");
            if (isset($insert)){
                $msg ='<div class="alert alert-success" role="alert"> Settings updated successfully </div>';
            }

        }
    }
}
$select_setting=mysqli_query($connect,"select * from setting ");
$setting=mysqli_fetch_assoc($select_setting);
function category($x){
    global $connect;
    $category =mysqli_query($connect,"select *from category");
    while ($cate=mysqli_fetch_assoc($category)){
        echo '<option value="'.$cate['category'].'"'.($x==$cate['category']?'selected':'').'>'.$cate['category'].'</option>';
    }


}

?>
<div class="col-sm-9">
    <div class="card">
        <div class="card-header bg-info">
            <b> Site Settings</b>
        </div>
        <div class="card-body">
            <form action="" method="post"  enctype="multipart/form-data" >
                <div class="form-group row">
                    <label for="site_name" class="col-sm-2 col-form-label">site name</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="site_name" name="site_name" placeholder="enter site name" value="<?php echo($setting['site_name']==''?'':$setting['site_name']) ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="img" class="col-sm-2 col-form-label">site logo</label>
                    <div class="col-sm-5">
                        <input type="file" class="form-control" id="img" name="img" >
                    </div>
                </div>
                <div class="form-group row">
                    <label for="slide" class="col-sm-2 col-form-label">slideshow</label>
                    <div class="col-sm-3">
                        <select class="custom-select" name="slide" id="slide">
                            <option value="">Select Category</option>
                            <?php category($setting['slide']); ?>

                        </select>
                    </div>
                    <label for="slide_value" class="col-sm-2 col-form-label">Number of articles :</label>
                    <div class="col-sm-2">
                        <input type="number" class="form-control" id="slide_value" name="slide_value"  value="<?php echo($setting['slide_value']==''?'3':$setting['slide_value']) ?>" min="3"max="9">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="section_a" class="col-sm-2 col-form-label">section One</label>
                    <div class="col-sm-3">
                        <select class="custom-select" name="section_a" id="section_a">
                            <option value="">Select Category</option>
                            <?php category($setting['section_a']); ?>

                        </select>
                    </div>
                    <label for="section_a_value" class="col-sm-2 col-form-label">Number of articles :</label>
                    <div class="col-sm-2">
                        <input type="number" class="form-control" id="section_a_value" name="section_a_value"value="<?php echo($setting['section_a_value']== ''?'3':$setting['section_a_value']) ?>" min="3"max="9" >
                    </div>
                </div>
                <div class="form-group row">
                    <label for="section_b" class="col-sm-2 col-form-label">section two</label>
                    <div class="col-sm-3">
                        <select class="custom-select" name="section_b" id="section_b">
                            <option value="">Select Category</option>
                            <?php category($setting['section_b']); ?>

                        </select>
                    </div>
                    <label for="section_b_value" class="col-sm-2 col-form-label">Number of articles :</label>
                    <div class="col-sm-2">
                        <input type="number" class="form-control" id="section_b_value" name="section_b_value" value="<?php echo($setting['section_b_value']== ''?'3':$setting['section_b_value']) ?>" min="3"max="9">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="Tab_a" class="col-sm-2 col-form-label">First Tab</label>
                    <div class="col-sm-3">
                        <select class="custom-select" name="Tab_a" id="Tab_a">
                            <option value="">Select Category</option>
                            <?php category($setting['Tab_a']); ?>

                        </select>
                    </div>
                    <label for="tab_a_value" class="col-sm-2 col-form-label">Number of articles :</label>
                    <div class="col-sm-2">
                        <input type="number" class="form-control" id="tab_a_value" value="<?php echo($setting['tab_a_value']== ''?'3':$setting['tab_a_value']) ?>"  name="tab_a_value" min="3"max="9">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="tab_b" class="col-sm-2 col-form-label">second tab</label>
                    <div class="col-sm-3">
                        <select class="custom-select" name="tab_b" id="tab_b">
                            <option value="">Select Category</option>
                            <?php category($setting['tab_b']); ?>

                        </select>
                    </div>
                    <label for="tab_b_value" class="col-sm-2 col-form-label">Number of articles :</label>
                    <div class="col-sm-2">
                        <input type="number" class="form-control" id="tab_b_value" value="<?php echo($setting['tab_b_value']== ''?'3':$setting['tab_b_value']) ?>"  name="tab_b_value" min="3"max="9">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="tab_c" class="col-sm-2 col-form-label">Third tab</label>
                    <div class="col-sm-3">
                        <select class="custom-select" name="tab_c" id="tab_c">
                            <option value="">Select Category</option>
                            <?php category($setting['tab_c']); ?>

                        </select>
                    </div>
                    <label for="tab_c_value" class="col-sm-2 col-form-label">Number of articles :</label>
                    <div class="col-sm-2">
                        <input type="number" class="form-control" id="tab_c_value" name="tab_c_value" value="<?php echo($setting['tab_c_value']== ''?'3':$setting['tab_c_value']) ?>" min="3"max="9">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="Facebook" class="col-sm-2 col-form-label">Facebook</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="Facebook" name="Facebook" placeholder="Facebook" value="<?php echo($setting['Facebook']== ''?'':$setting['Facebook']) ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="Twitter" class="col-sm-2 col-form-label">Twitter</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="Twitter" name="Twitter" placeholder="Twitter" value="<?php echo($setting['Twitter']== ''?'':$setting['Twitter']) ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="Instagram" class="col-sm-2 col-form-label">Instagram</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="Instagram" name="Instagram" placeholder="Instagram" value="<?php echo($setting['Instagram']== ''?'':$setting['Instagram']) ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12 text-center"> <?php echo $msg;?></div>

                    <div class="col-sm-12 text-center">
                        <button type="sette" name="sette"id="sette" class="btn btn-danger btn-block">update setting</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
</div>
<!--end panal-->
<?PHP
include_once("inc/footer.php");
?>