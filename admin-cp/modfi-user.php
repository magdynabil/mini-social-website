<?php
include_once('../include/connect.php');
if (isset($_POST['submit'])){
    $user_name=$_POST['user_name'];
    $email=$_POST['email'];
    $sql=mysqli_query($connect,"SELECT * FROM rigister_table WHERE user_name='$user_name' or email='$email'");
    $sqli=mysqli_fetch_assoc($sql);
if (empty($user_name)){
    echo'<div class="alert alert-danger" role="alert"> empty user name! </div>';
}
elseif (empty($email)){
    echo'<div class="alert alert-danger" role="alert"> empty email! </div>';
}
elseif (!filter_var($email,FILTER_VALIDATE_EMAIL)){
    echo'<div class="alert alert-danger" role="alert"> enter right email! </div>';
}
else{
    $sql=mysqli_query($connect,"SELECT * FROM rigister_table WHERE user_name='$user_name' or email='$email'");
    if(mysqli_num_rows($sql)>0){
        if ($user_name==$sqli['user_name'] AND $email==$sqli['email']){
            if($_POST['Password']!=''or$_POST['config_password']!=''){
                if($_POST['Password']!=$_POST['config_password']){
                    echo'<div class="alert alert-danger" role="alert"> password is not equal! </div>';
                }else{
                    $Password= md5($_POST['Password']);
                    $img=$_FILES['picture'];
                    $img_name=$img['name'];
                    $img_tmp=$img['tmp_name'];
                    $img_size=$img['size'];
                    $img_error=$img['error'];
                    if ($img_name!=''){
                        $img_exe=explode('.',$img_name);
                        $img_exe=strtolower(end($img_exe));
                        $allaw=array('gif','png','jpg','jpeg');
                        if (in_array($img_exe,$allaw)){
                            if($img_error==0){
                                if ($img_size<=3000000){
                                    $new_name=uniqid('user',false).'.'.$img_exe;
                                    $img_dir='../img/picture/'.$new_name;
                                    $img_db='img/picture/'.$new_name;
                                    if (move_uploaded_file($img_tmp,$img_dir)){
                                        $update_users= "UPDATE rigister_table SET password='$Password',gender='$_POST[gender]',avatar='$img_db',about_user='$_POST[about]',facebook='$_POST[facebook]',instgram='$_POST[instgeram]',twitter='$_POST[twitter]',user_rank='$_POST[user_rank]'WHERE user_id='$sqli[user_id]'";
                                        $update=mysqli_query($connect,$update_users);
                                        if (isset($update)){
                                            echo'<div class="alert alert-success" role="alert">update user </div>';
                                            echo'<meta http-equiv="refresh" content="2;\'users.php\'"/>';
                                        }
                                    }else{echo'<div class="alert alert-danger" role="alert"> An error occurred while transferring the image! </div>';}
                                }else{echo'<div class="alert alert-danger" role="alert"> The image size is too large! </div>';}
                            }else{echo'<div class="alert alert-danger" role="alert"> An error occurred while uploading the image! </div>';}

                        }else{echo'<div class="alert alert-danger" role="alert"> Image extension is incorrect! </div>';}
                    }
                    else{
                        $update_users= "UPDATE rigister_table SET password='$Password',gender='$_POST[gender]',about_user='$_POST[about]',facebook='$_POST[facebook]',instgram='$_POST[instgeram]',twitter='$_POST[twitter]',user_rank='$_POST[user_rank]'WHERE user_id='$sqli[user_id]'";
                        $update=mysqli_query($connect,$update_users);
                        if (isset($update)){
                            echo'<div class="alert alert-success" role="alert">update user </div>';
                            echo'<meta http-equiv="refresh" content="2;\'users.php\'"/>';
                        }
                    }
                }
            }
            else{if (isset($_FILES['picture'])){
                $img=$_FILES['picture'];
                $img_name=$img['name'];
                $img_tmp=$img['tmp_name'];
                $img_size=$img['size'];
                $img_error=$img['error'];
                if ($img_name!=''){
                    $img_exe=explode('.',$img_name);
                    $img_exe=strtolower(end($img_exe));
                    $allaw=array('gif','png','jpg','jpeg');
                    if (in_array($img_exe,$allaw)){
                        if($img_error==0){
                            if ($img_size<=3000000){
                                $new_name=uniqid('user',false).'.'.$img_exe;
                                $img_dir='../img/picture/'.$new_name;
                                $img_db='img/picture/'.$new_name;
                                if (move_uploaded_file($img_tmp,$img_dir)){
                                    $update_users= "UPDATE rigister_table SET gender='$_POST[gender]',avatar='$img_db',about_user='$_POST[about]',facebook='$_POST[facebook]',instgram='$_POST[instgeram]',twitter='$_POST[twitter]',user_rank='$_POST[user_rank]'WHERE user_id='$sqli[user_id]'";
                                    $update=mysqli_query($connect,$update_users);
                                    if (isset($update)){
                                        echo'<div class="alert alert-success" role="alert">update user </div>';
                                        echo'<meta http-equiv="refresh" content="2;\'users.php\'"/>';
                                    }
                                }else{echo'<div class="alert alert-danger" role="alert"> An error occurred while transferring the image! </div>';}
                            }else{echo'<div class="alert alert-danger" role="alert"> The image size is too large! </div>';}
                        }else{echo'<div class="alert alert-danger" role="alert"> An error occurred while uploading the image! </div>';}

                    }else{echo'<div class="alert alert-danger" role="alert"> Image extension is incorrect! </div>';}
                }}
                else{
                    $update_users= "UPDATE rigister_table SET gender='$_POST[gender]',about_user='$_POST[about]',facebook='$_POST[facebook]',instgram='$_POST[instgeram]',twitter='$_POST[twitter]',user_rank='$_POST[user_rank]'WHERE user_id='$sqli[user_id]'";
                    $update=mysqli_query($connect,$update_users);
                    if (isset($update)){
                        echo'<div class="alert alert-success" role="alert">update user </div>';
                        echo'<meta http-equiv="refresh" content="2;\'users.php\'"/>';
                    }
                }
            }
        }
        elseif ($user_name!=$sqli['user_name'] AND $email==$sqli['email']){
            $edit_name=mysqli_query($connect,"SELECT user_name FROM rigister_table WHERE user_name='$user_name'");
            if (mysqli_num_rows($edit_name)>0){
                echo'<div class="alert alert-danger" role="alert">user name is already used !</div>';
            }else {
                if ($_POST['Password'] != '' or $_POST['config_password'] != '') {
                    if ($_POST['Password'] != $_POST['config_password']) {
                        echo '<div class="alert alert-danger" role="alert"> password is not equal! </div>';
                    } else {
                        $Password = md5($_POST['Password']);
                        $img = $_FILES['picture'];
                        $img_name = $img['name'];
                        $img_tmp = $img['tmp_name'];
                        $img_size = $img['size'];
                        $img_error = $img['error'];
                        if ($img_name != '') {
                            $img_exe = explode('.', $img_name);
                            $img_exe = strtolower(end($img_exe));
                            $allaw = array('gif', 'png', 'jpg', 'jpeg');
                            if (in_array($img_exe, $allaw)) {
                                if ($img_error == 0) {
                                    if ($img_size <= 3000000) {
                                        $new_name = uniqid('user', false) . '.' . $img_exe;
                                        $img_dir = '../img/picture/' . $new_name;
                                        $img_db = 'img/picture/' . $new_name;
                                        if (move_uploaded_file($img_tmp, $img_dir)) {
                                            $update_users = "UPDATE rigister_table SET user_name='$_POST[user_name]', password='$Password',gender='$_POST[gender]',avatar='$img_db',about_user='$_POST[about]',facebook='$_POST[facebook]',instgram='$_POST[instgeram]',twitter='$_POST[twitter]',user_rank='$_POST[user_rank]'WHERE user_id='$sqli[user_id]'";
                                            $update = mysqli_query($connect, $update_users);
                                            if (isset($update)) {
                                                echo '<div class="alert alert-success" role="alert">update user </div>';
                                                echo '<meta http-equiv="refresh" content="2;\'users.php\'"/>';
                                            }
                                        } else {
                                            echo '<div class="alert alert-danger" role="alert"> An error occurred while transferring the image! </div>';
                                        }
                                    } else {
                                        echo '<div class="alert alert-danger" role="alert"> The image size is too large! </div>';
                                    }
                                } else {
                                    echo '<div class="alert alert-danger" role="alert"> An error occurred while uploading the image! </div>';
                                }
                            } else {
                                echo '<div class="alert alert-danger" role="alert"> Image extension is incorrect! </div>';
                            }
                        } else {
                            $update_users = "UPDATE rigister_table SET user_name='$_POST[user_name]', password='$Password',gender='$_POST[gender]',about_user='$_POST[about]',facebook='$_POST[facebook]',instgram='$_POST[instgeram]',twitter='$_POST[twitter]',user_rank='$_POST[user_rank]'WHERE user_id='$sqli[user_id]'";
                            $update = mysqli_query($connect, $update_users);
                            if (isset($update)) {
                                echo '<div class="alert alert-success" role="alert">update user </div>';
                                echo '<meta http-equiv="refresh" content="2;\'users.php\'"/>';
                            }
                        }
                    }
                } else {
                    $img = $_FILES['picture'];
                    $img_name = $img['name'];
                    $img_tmp = $img['tmp_name'];
                    $img_size = $img['size'];
                    $img_error = $img['error'];
                    if ($img_name != '') {
                        $img_exe = explode('.', $img_name);
                        $img_exe = strtolower(end($img_exe));
                        $allaw = array('gif', 'png', 'jpg', 'jpeg');
                        if (in_array($img_exe, $allaw)) {
                            if ($img_error == 0) {
                                if ($img_size <= 3000000) {
                                    $new_name = uniqid('user', false) . '.' . $img_exe;
                                    $img_dir = '../img/picture/' . $new_name;
                                    $img_db = 'img/picture/' . $new_name;
                                    if (move_uploaded_file($img_tmp, $img_dir)) {
                                        $update_users = "UPDATE rigister_table SET user_name='$_POST[user_name]', gender='$_POST[gender]',avatar='$img_db',about_user='$_POST[about]',facebook='$_POST[facebook]',instgram='$_POST[instgeram]',twitter='$_POST[twitter]',user_rank='$_POST[user_rank]'WHERE user_id='$sqli[user_id]'";
                                        $update = mysqli_query($connect, $update_users);
                                        if (isset($update)) {
                                            echo '<div class="alert alert-success" role="alert">update user </div>';
                                            echo '<meta http-equiv="refresh" content="2;\'users.php\'"/>';
                                        }
                                    } else {
                                        echo '<div class="alert alert-danger" role="alert"> An error occurred while transferring the image! </div>';
                                    }
                                } else {
                                    echo '<div class="alert alert-danger" role="alert"> The image size is too large! </div>';
                                }
                            } else {
                                echo '<div class="alert alert-danger" role="alert"> An error occurred while uploading the image! </div>';
                            }
                        } else {
                            echo '<div class="alert alert-danger" role="alert"> Image extension is incorrect! </div>';
                        }
                    } else {
                        $update_users = "UPDATE rigister_table SET user_name='$_POST[user_name]', gender='$_POST[gender]',about_user='$_POST[about]',facebook='$_POST[facebook]',instgram='$_POST[instgeram]',twitter='$_POST[twitter]',user_rank='$_POST[user_rank]'WHERE user_id='$sqli[user_id]'";
                        $update = mysqli_query($connect, $update_users);
                        if (isset($update)) {
                            echo '<div class="alert alert-success" role="alert">update user </div>';
                            echo '<meta http-equiv="refresh" content="2;\'users.php\'"/>';
                        }
                    }
                }
            }}
        elseif ($user_name==$sqli['user_name'] AND $email!=$sqli['email']){
            $edit_name=mysqli_query($connect,"SELECT email FROM rigister_table WHERE email='$email'");
            if (mysqli_num_rows($edit_name)>0){
                echo'<div class="alert alert-danger" role="alert">user email is already used !</div>';
            }else {
                if ($_POST['Password'] != '' or $_POST['config_password'] != '') {
                    if ($_POST['Password'] != $_POST['config_password']) {
                        echo '<div class="alert alert-danger" role="alert"> password is not equal! </div>';
                    } else {
                        $Password = md5($_POST['Password']);
                        $img = $_FILES['picture'];
                        $img_name = $img['name'];
                        $img_tmp = $img['tmp_name'];
                        $img_size = $img['size'];
                        $img_error = $img['error'];
                        if ($img_name != '') {
                            $img_exe = explode('.', $img_name);
                            $img_exe = strtolower(end($img_exe));
                            $allaw = array('gif', 'png', 'jpg', 'jpeg');
                            if (in_array($img_exe, $allaw)) {
                                if ($img_error == 0) {
                                    if ($img_size <= 3000000) {
                                        $new_name = uniqid('user', false) . '.' . $img_exe;
                                        $img_dir = '../img/picture/' . $new_name;
                                        $img_db = 'img/picture/' . $new_name;
                                        if (move_uploaded_file($img_tmp, $img_dir)) {
                                            $update_users = "UPDATE rigister_table SET email='$_POST[email]', password='$Password',gender='$_POST[gender]',avatar='$img_db',about_user='$_POST[about]',facebook='$_POST[facebook]',instgram='$_POST[instgeram]',twitter='$_POST[twitter]',user_rank='$_POST[user_rank]'WHERE user_id='$sqli[user_id]'";
                                            $update = mysqli_query($connect, $update_users);
                                            if (isset($update)) {
                                                echo '<div class="alert alert-success" role="alert">update user </div>';
                                                echo '<meta http-equiv="refresh" content="2;\'users.php\'"/>';
                                            }
                                        } else {
                                            echo '<div class="alert alert-danger" role="alert"> An error occurred while transferring the image! </div>';
                                        }
                                    } else {
                                        echo '<div class="alert alert-danger" role="alert"> The image size is too large! </div>';
                                    }
                                } else {
                                    echo '<div class="alert alert-danger" role="alert"> An error occurred while uploading the image! </div>';
                                }
                            } else {
                                echo '<div class="alert alert-danger" role="alert"> Image extension is incorrect! </div>';
                            }
                        } else {
                            $update_users = "UPDATE rigister_table SET email='$_POST[email]', password='$Password',gender='$_POST[gender]',about_user='$_POST[about]',facebook='$_POST[facebook]',instgram='$_POST[instgeram]',twitter='$_POST[twitter]',user_rank='$_POST[user_rank]'WHERE user_id='$sqli[user_id]'";
                            $update = mysqli_query($connect, $update_users);
                            if (isset($update)) {
                                echo '<div class="alert alert-success" role="alert">update user </div>';
                                echo '<meta http-equiv="refresh" content="2;\'users.php\'"/>';
                            }
                        }
                    }
                } else {
                    $img = $_FILES['picture'];
                    $img_name = $img['name'];
                    $img_tmp = $img['tmp_name'];
                    $img_size = $img['size'];
                    $img_error = $img['error'];
                    if ($img_name != '') {
                        $img_exe = explode('.', $img_name);
                        $img_exe = strtolower(end($img_exe));
                        $allaw = array('gif', 'png', 'jpg', 'jpeg');
                        if (in_array($img_exe, $allaw)) {
                            if ($img_error == 0) {
                                if ($img_size <= 3000000) {
                                    $new_name = uniqid('user', false) . '.' . $img_exe;
                                    $img_dir = '../img/picture/' . $new_name;
                                    $img_db = 'img/picture/' . $new_name;
                                    if (move_uploaded_file($img_tmp, $img_dir)) {
                                        $update_users = "UPDATE rigister_table SET email='$_POST[email]', gender='$_POST[gender]',avatar='$img_db',about_user='$_POST[about]',facebook='$_POST[facebook]',instgram='$_POST[instgeram]',twitter='$_POST[twitter]',user_rank='$_POST[user_rank]'WHERE user_id='$sqli[user_id]'";
                                        $update = mysqli_query($connect, $update_users);
                                        if (isset($update)) {
                                            echo '<div class="alert alert-success" role="alert">update user </div>';
                                            echo '<meta http-equiv="refresh" content="2;\'users.php\'"/>';
                                        }
                                    } else {
                                        echo '<div class="alert alert-danger" role="alert"> An error occurred while transferring the image! </div>';
                                    }
                                } else {
                                    echo '<div class="alert alert-danger" role="alert"> The image size is too large! </div>';
                                }
                            } else {
                                echo '<div class="alert alert-danger" role="alert"> An error occurred while uploading the image! </div>';
                            }
                        } else {
                            echo '<div class="alert alert-danger" role="alert"> Image extension is incorrect! </div>';
                        }
                    } else {
                        $update_users = "UPDATE rigister_table SET  email='$_POST[email]', gender='$_POST[gender]',about_user='$_POST[about]',facebook='$_POST[facebook]',instgram='$_POST[instgeram]',twitter='$_POST[twitter]',user_rank='$_POST[user_rank]'WHERE user_id='$sqli[user_id]'";
                        $update = mysqli_query($connect, $update_users);
                        if (isset($update)) {
                            echo '<div class="alert alert-success" role="alert">update user </div>';
                            echo '<meta http-equiv="refresh" content="2;\'users.php\'"/>';
                        }
                    }
                }
            }
        }else{ echo'<div class="alert alert-danger" role="alert"> user name or email is aready used ! </div>';}
    }
    else{
        if ($_POST['Password'] != '' or $_POST['config_password'] != '') {
            if ($_POST['Password'] != $_POST['config_password']) {
                echo '<div class="alert alert-danger" role="alert"> password is not equal! </div>';
            } else {
                $Password = md5($_POST['Password']);
                $img = $_FILES['picture'];
                $img_name = $img['name'];
                $img_tmp = $img['tmp_name'];
                $img_size = $img['size'];
                $img_error = $img['error'];
                if ($img_name != '') {
                    $img_exe = explode('.', $img_name);
                    $img_exe = strtolower(end($img_exe));
                    $allaw = array('gif', 'png', 'jpg', 'jpeg');
                    if (in_array($img_exe, $allaw)) {
                        if ($img_error == 0) {
                            if ($img_size <= 3000000) {
                                $new_name = uniqid('user', false) . '.' . $img_exe;
                                $img_dir = '../img/picture/' . $new_name;
                                $img_db = 'img/picture/' . $new_name;
                                if (move_uploaded_file($img_tmp, $img_dir)) {
                                    $update_users = "UPDATE rigister_table SET user_name='$_POST[user_name]', email='$_POST[email]', password='$Password',gender='$_POST[gender]',avatar='$img_db',about_user='$_POST[about]',facebook='$_POST[facebook]',instgram='$_POST[instgeram]',twitter='$_POST[twitter]',user_rank='$_POST[user_rank]'WHERE user_id='$sqli[user_id]'";
                                    $update = mysqli_query($connect, $update_users);
                                    if (isset($update)) {
                                        echo '<div class="alert alert-success" role="alert">update user </div>';
                                        echo '<meta http-equiv="refresh" content="2;\'users.php\'"/>';

                                    }
                                } else {
                                    echo '<div class="alert alert-danger" role="alert"> An error occurred while transferring the image! </div>';
                                }
                            } else {
                                echo '<div class="alert alert-danger" role="alert"> The image size is too large! </div>';
                            }
                        } else {
                            echo '<div class="alert alert-danger" role="alert"> An error occurred while uploading the image! </div>';
                        }
                    } else {
                        echo '<div class="alert alert-danger" role="alert"> Image extension is incorrect! </div>';
                    }
                } else {
                    $update_users = "UPDATE rigister_table SET user_name='$_POST[user_name]', email='$_POST[email]', password='$Password',gender='$_POST[gender]',about_user='$_POST[about]',facebook='$_POST[facebook]',instgram='$_POST[instgeram]',twitter='$_POST[twitter]',user_rank='$_POST[user_rank]'WHERE user_id='$sqli[user_id]'";
                    $update = mysqli_query($connect, $update_users);
                    if (isset($update)) {
                        echo '<div class="alert alert-success" role="alert">update user </div>';
                        echo '<meta http-equiv="refresh" content="2;\'users.php\'"/>';
                    }
                }
            }
        } else {
            $img = $_FILES['picture'];
            $img_name = $img['name'];
            $img_tmp = $img['tmp_name'];
            $img_size = $img['size'];
            $img_error = $img['error'];
            if ($img_name != '') {
                $img_exe = explode('.', $img_name);
                $img_exe = strtolower(end($img_exe));
                $allaw = array('gif', 'png', 'jpg', 'jpeg');
                if (in_array($img_exe, $allaw)) {
                    if ($img_error == 0) {
                        if ($img_size <= 3000000) {
                            $new_name = uniqid('user', false) . '.' . $img_exe;
                            $img_dir = '../img/picture/' . $new_name;
                            $img_db = 'img/picture/' . $new_name;
                            if (move_uploaded_file($img_tmp, $img_dir)) {
                                $update_users = "UPDATE rigister_table SET user_name='$_POST[user_name]', email='$_POST[email]', gender='$_POST[gender]',avatar='$img_db',about_user='$_POST[about]',facebook='$_POST[facebook]',instgram='$_POST[instgeram]',twitter='$_POST[twitter]',user_rank='$_POST[user_rank]'WHERE user_id='$sqli[user_id]'";
                                $update = mysqli_query($connect, $update_users);
                                if (isset($update)) {
                                    echo '<div class="alert alert-success" role="alert">update user </div>';
                                    echo '<meta http-equiv="refresh" content="2;\'users.php\'"/>';
                                }
                            } else {
                                echo '<div class="alert alert-danger" role="alert"> An error occurred while transferring the image! </div>';
                            }
                        } else {
                            echo '<div class="alert alert-danger" role="alert"> The image size is too large! </div>';
                        }
                    } else {
                        echo '<div class="alert alert-danger" role="alert"> An error occurred while uploading the image! </div>';
                    }
                } else {
                    echo '<div class="alert alert-danger" role="alert"> Image extension is incorrect! </div>';
                }
            } else {
                $update_users = "UPDATE rigister_table SET user_name='$_POST[user_name]', email='$_POST[email]', gender='$_POST[gender]',about_user='$_POST[about]',facebook='$_POST[facebook]',instgram='$_POST[instgeram]',twitter='$_POST[twitter]',user_rank='$_POST[user_rank]'WHERE user_id='$sqli[user_id]'";
                $update = mysqli_query($connect, $update_users);
                if (isset($update)) {
                    echo '<div class="alert alert-success" role="alert">update user </div>';
                    echo '<meta http-equiv="refresh" content="2;\'users.php\'"/>';
                }
            }
        }
    }
}
}



?>