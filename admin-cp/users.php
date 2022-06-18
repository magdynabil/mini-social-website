<?PHP
include_once("inc/header.php");
include_once("inc/sidebar.php");
$msg='';
if (isset($_GET['delete_user'])){
    $del=mysqli_query($connect,"DELETE FROM `rigister_table`WHERE user_id= $_GET[delete_user]");
    if (isset( $del)){
        $msg='<div class="container text-center"><div class="alert alert-success" role="alert">user is deleted</div></div>';
    }
}
?>
    <div class="col-sm-9">
        <div class="card">
            <div class="card-header bg-info">
                members
            </div>
            <div class="card-body">
                <?php echo $msg;?>

                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">personal picture </th>
                        <th scope="col">member name</th>
                        <th scope="col">E-mail</th>
                        <th scope="col">Gender</th>
                        <th scope="col">personal page</th>
                        <th scope="col">Modify</th>
                        <th scope="col">Delete</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?Php
                    $users=mysqli_query($connect,"SELECT * FROM rigister_table  order by `user_id` desc ");
                    $num=1;
                    while($user=mysqli_fetch_assoc($users)){
                        echo'<tr>
                        <th scope="row">'.$num.'</th>
                 
                        <td scope="row"><img src="../'.$user['avatar'].' "class="rounded" width="70px"/></td>
                        <td scope="row">'.$user['user_name'].'</td>
                         <td scope="row">'.$user['email'].'</td>
                          <td scope="row">'.($user['gender']=='male'?'<img src="../img/male.png"width="30px" >':'<img src="../img/female.png" width="30px">').'</td>
                          <td><a href="profile.php?user='.$user['user_id'].'"class="btn btn-info btn-sm" target="_blank">personal page</a></td>    
                            <td><a href="edite-user.php?modify_user='.$user['user_id'].'" class="btn btn-warning  btn-sm">Modify</a></td>
                        <td><a href="users.php?delete_user='.$user['user_id'].'" class="btn btn-danger  btn-sm">Delete</a></td>
                      </tr>';
                        $num++;
                    }
                    ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>
    </div>
    <!--end panal-->
<?PHP
include_once("inc/footer.php");
?>