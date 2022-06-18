
<?PHP
include_once("inc/header.php");
include_once("inc/sidebar.php");
$msg='';
$get_user=mysqli_query($connect,"SELECT  `user_name`, `email`,`user_rank`,`avatar` FROM `rigister_table` WHERE user_id='$_SESSION[user_id]'");
 $user=mysqli_fetch_assoc($get_user);
 $posts=mysqli_query($connect,"SELECT * from post");
$post=mysqli_num_rows($posts);
$users=mysqli_query($connect,"SELECT * from rigister_table");
$use=mysqli_num_rows($users);
?>
<div class="col-sm-9">
<div class="col-md-12">
    <div class="row">
        <div class="col-md-3">
            <div class="card border-dark mb-3" style="max-width: 18rem;">
                <div class="card-header bg-dark text-light"><b> Hi <?php echo $user['user_name']; ?> </b></div>
                <div class="card-body text-dark">
                   <div class="text-center">
                       <img class=" rounded" src="../<?php echo $user['avatar']?>"width="1500px"style="max-width: 200px"/>
                       <hr>
                   </div>
                    <div class="text-left">
                        <p class="font-weight-bold">E-mail: <span class=" text-danger"><?php echo $user['email']; ?></span></p>
                        <p class="font-weight-bold">Validity: <span class="font-weight-bold text-danger"><?php echo ($user['user_rank']=='admin'?'site manager':'writer'); ?></span></p>
                        <p class="text-right font-weight-bold"><a href="#"  class="btn btn-dark btn-sm">Modify information</a></p>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-warning mb-3" style="max-width: 18rem;">
                <div class="card-header bg-warning text-light"><b>Articles</b></div>
                <div class="card-body text-warning row">
                    <div class="col-md-8">
                        <i class="far fa-list-alt fa-5x"></i>
                    </div>
                    <div class="col-md-4">
                        <p><b> <?php echo $post;?></b></p>
                    </div>
                </div>
                <div class="card-footer text-center text-warning">
                    <i class="fas fa-eye"></i>
                    <a href="#" class="text-warning"><b> Watch</b></a>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-info mb-3" style="max-width: 18rem;">
                <div class="card-header bg-info text-light"><B>comments</B></div>
                <div class="card-body text-info row">
                    <div class="col-md-8">
                        <i class="fas fa-comments fa-5x"></i>
                    </div>
                    <div class="col-md-4">
                        <p><b> <?php echo $use;?></b></p>
                    </div>
                </div>
                <div class="card-footer text-center text-info">
                    <i class="fas fa-eye"></i>
                    <a href="#" class="text-info"><b> Watch</b></a>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card  border-danger mb-3" style="max-width: 18rem;">
                <div class="card-header bg-danger text-light"><b>Members</b></div>
                <div class="card-body text-danger row">
                    <div class="col-md-8">
                        <i class="fas fa-users fa-5x"></i>
                    </div>
                    <div class="col-md-4">
                        <p><b> <?php echo $use;?></b></p>
                    </div>
                </div>
                <div class="card-footer text-center text-danger">
                    <i class="fas fa-eye"></i>
                    <a href="#" class="text-danger"><b> Watch</b></a>
                </div>
            </div>
        </div>
        <div class="col-md-12"style="margin-top: 10px ;margin-bottom: 10px" >
            <div class="card border-success">
                <div class="card-header bg-success text-light">
                   <b> New Articles </b>
                </div>
                <div class="card-body">
                    <?Php
                    echo $msg;
                    ?>
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">ِِArticle Picture </th>
                            <th scope="col">Article title</th>
                            <th scope="col">Writer</th>
                            <th scope="col">date of publication</th>
                            <th scope="col">View the article</th>
                            <th scope="col">Status</th>
                            <th scope="col">Modify</th>
                            <th scope="col">Delete</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?Php
                        $posts=mysqli_query($connect,"SELECT * FROM post p INNER JOIN rigister_table r where p.author =r.user_id order by post_id desc limit 5");
                        $num=1;
                        while($post=mysqli_fetch_assoc($posts)){
                            echo'<tr>
                        <th scope="row">'.$num.'</th>
                 
                        <td scope="row"><img src="../'.($post['image'] == ''?'img/no-img.jpg':$post['image']).'"class="rounded" width="70px"/></td>
                        <td scope="row">'.substr($post['titile'],0,40).'....</td>
                         <td scope="row">'.$post['user_name'].'</td>
                          <td scope="row">'.$post['post_date'].'</td>
                          <td><a href="../post.php?id='.$post['post_id'].'" target="_blank" class="btn btn-primary btn-sm">View the article</a></td>
                        <td>'.
                                ($post['status']=='publishing'?
                                    '<a href="posts.php?status=Disable&post='.$post['post_id'].'" class="btn btn-success btn-sm">publishing</a>':
                                    '<a href="posts.php?status=publishing&post='.$post['post_id'].'" class="btn btn-info btn-sm">Disable</a>'
                                ).'       
                            <td><a href="edite-post.php?post='.$post['post_id'].'" class="btn btn-warning  btn-sm">Modify</a></td>
                        <td><a href="posts.php?delete='.$post['post_id'].'" class="btn btn-danger  btn-sm">Delete</a></td>
                      </tr>';
                            $num++;
                        }
                        ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-12" style="margin-top: 10px ;margin-bottom: 20px">
            <div class="card border-info">
                <div class="card-header bg-info text-light">
                   <b>New members</b>
                </div>
                <div class="card-body">
                    <?php echo $msg;?>

                    <table class="table ">
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
                        $users=mysqli_query($connect,"SELECT * FROM rigister_table  order by `user_id` desc  limit 5 ");
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
</div>
</div>
</div>
<!--end panal-->
<?PHP
include_once("inc/footer.php");
?>