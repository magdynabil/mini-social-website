<?php
session_start();
include_once('connect.php');
if(isset($_POST['login'])){
    $user=stripcslashes(mysqli_real_escape_string($connect,$_POST['user']));
    $password=md5($_POST['pass']);
    if(empty($user)){
        echo'<div class="alert alert-danger" role="alert">enter your name! </div>';
    }
   elseif(empty($_POST['pass'])){
    echo'<div class="alert alert-danger" role="alert"> enter your password! </div>';

    }else{
        $sql=mysqli_query($connect,"SELECT* FROM rigister_table WHERE password='$password'and user_name='$user'or email='$user'");
        if(mysqli_num_rows($sql) !=1){
            
            echo'<div class="alert alert-danger" role="alert"> Invalid username or email! </div>';
        }
        else{
            $user=mysqli_fetch_assoc($sql);
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
            echo'<div class="alert alert-success" role="alert"> Signed in </div>';
            echo'<meta http-equiv="refresh" content="2;\'index.php\'"/>';
        }

}
}
?>