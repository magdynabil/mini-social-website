<?php
$host='localhost';
$root='root';
$password='';
$db_name='my_firist_pro';
$connect=mysqli_connect($host,$root,$password,$db_name);
function close_DB(){
    global $connect;
    mysqli_close($connect);
}

?>