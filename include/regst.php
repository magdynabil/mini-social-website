<?php
include_once('connect.php');
session_start();
if(isset($_POST['submit'])){
    $user_name=$_POST['user_name'];
    $email=$_POST['email'];
    $gender=$_POST['gender'];
    $about=$_POST['about'];
    $facebook=$_POST['facebook'];
    $instgram=$_POST['instgeram'];
    $twitter=$_POST['twitter'];
    $date=date("y-m-d");
    if(empty($user_name)){
        echo'<div class="alert alert-danger" role="alert"> empty user name! </div>';
              }
    elseif(empty($email)){
         echo'<div class="alert alert-danger" role="alert"> empty email! </div>';
              }
    elseif (!filter_var($email,FILTER_VALIDATE_EMAIL)){
         echo'<div class="alert alert-danger" role="alert">please enter validate email! </div>';
              }
    elseif(empty($_POST['Password'])){
         echo'<div class="alert alert-danger" role="alert">empty password! </div>';
              }
    elseif(empty($_POST['config_password'])){
        echo'<div class="alert alert-danger" role="alert">Please confirm password!! </div>';
              }
    elseif($_POST['Password']!=$_POST['config_password']){
        echo'<div class="alert alert-danger" role="alert">Please confirm password!! </div>';
              } 
    else{
        $user_name_check=mysqli_query($connect,"SELECT user_name FROM rigister_table WHERE user_name='$user_name'");
        $email_check=mysqli_query($connect,"SELECT email FROM rigister_table WHERE email='$email'");
        if (mysqli_num_rows($user_name_check) > 0){
            echo'<div class="alert alert-danger" role="alert">user name already exists! </div>';
        }
        elseif (mysqli_num_rows($email_check) > 0){
            echo'<div class="alert alert-danger" role="alert">email already exists! </div>';
        }
        else{
            if (isset($_FILES['picture'])){
                $picture=$_FILES['picture'];
                $picture_name=$picture['name'];
                $picture_tmp_name=$picture['tmp_name'];
                $picture_error=$picture['error'];
                $picture_size=$picture['size'];
                $picture_type_u=explode('.',$picture_name);
                $picture_type=strtolower(end($picture_type_u));
                $allow=array('png','jpg','gif','jpeg');
                if(in_array($picture_type,$allow)){
                if( $picture_error==0){
                    if($picture_size<=30000000){
                        $picture_new_name=uniqid('user',false).".".$picture_type;
                        $picture_dir='../img/picture/'.$picture_new_name;
                        $picture_DB_dir='img/picture/'.$picture_new_name;
                        if(move_uploaded_file($picture_tmp_name,$picture_dir)){
                            $password=md5($_POST['Password']);
                            $insert="INSERT INTO rigister_table (user_name,email,password,gender,avatar,about_user,facebook,instgram,twitter,date,user_rank)
                            VALUES('$user_name','$email','$password','$gender','$picture_DB_dir','$about','$facebook','$instgram','$twitter','$date','user')";
                            $insert_mysqli=mysqli_query($connect,$insert);
                            if(isset($insert_mysqli)){
                                $user_info=mysqli_query($connect,"SELECT* FROM rigister_table WHERE user_name='$user_name'");
                                $user=mysqli_fetch_assoc($user_info);
                                $_SESSION['user_id']=$user['user_id'];
                                $_SESSION['user_name']=$user['user_name'];
                                $_SESSION['email']=$user['email'];
                                $_SESSION['gender']=$user['gender'];
                                $_SESSION['avatar']=$user['avatar'];
                                $_SESSION['about']=$user['about_user'];
                                $_SESSION['facebook']=$user['facebook'];
                                $_SESSION['instgram']=$user['instgram'];
                                $_SESSION['twitter']=$user['twitter'];
                                $_SESSION['date']=$user['date'];
                                $_SESSION['user_rank']=$user['user_rank'];
                                echo'<div class="alert alert-success" role="alert"> connected </div>';
                                echo'<meta http-equiv="refresh" content="2;\'index.php\'"/>';
                        }
                    }else{echo'<div class="alert alert-danger" role="alert">An error occurred while transferring the image! </div>';}
                }else{echo'<div class="alert alert-danger" role="alert">The image is larger than the allowable size! </div>';}
                }else{echo'<div class="alert alert-danger" role="alert">An unexpected error occurred! </div>';}

 
            }else{echo'<div class="alert alert-danger" role="alert">This file is not an image! </div>';}
            
        }else{ $password=md5($_POST['Password']);
            $insert="INSERT INTO rigister_table (user_name,email,password,gender,avatar,about_user,facebook,instgram,twitter,date,user_rank)
            VALUES('$user_name','$email','$password','$gender','../img/picture/defult','$about','$facebook','$instgram','$twitter','$date','user')";
            $insert_mysqli=mysqli_query($connect,$insert);
            if(isset($insert_mysqli)){
                
                $user_info=mysqli_query($connect,"SELECT* FROM rigister_table WHERE user_name='$user_name'");
                $user=mysqli_fetch_assoc($user_info);
                $_SESSION['user_id']=$user['user_id'];
                $_SESSION['user_name']=$user['user_name'];
                $_SESSION['email']=$user['email'];
                $_SESSION['gender']=$user['gender'];
                $_SESSION['avatar']=$user['avatar'];
                $_SESSION['about']=$user['about_user'];
                $_SESSION['facebook']=$user['facebook'];
                $_SESSION['instgram']=$user['instgram'];
                $_SESSION['twitter']=$user['twitter'];
                $_SESSION['date']=$user['date'];
                $_SESSION['user_rank']=$user['user_rank'];
                echo'<div class="alert alert-success" role="alert"> connected </div>';
                echo'<meta http-equiv="refresh" content="2;\'index.php\'"/>';


        }
    }
}
    }
}