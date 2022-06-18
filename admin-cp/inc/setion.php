<?PHP
session_start();
include_once("../include/connect.php");
if(isset($_SESSION['user_id'])){
    $sql=mysqli_query($connect,"SELECT * FROM rigister_table WHERE user_id='$_SESSION[user_id]'and user_rank='admin'or'writer'");
    if (mysqli_num_rows($sql) != 1){
        header("location:../index.php");
}else{
}
}
else{
    header("location:../index.php");
}
?>