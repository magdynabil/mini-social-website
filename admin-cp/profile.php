<?PHP
include_once("inc/header.php");
include_once("inc/sidebar.php");

$get_user=mysqli_query($connect,"select * from rigister_table WHERE user_id='$_SESSION[user_id]' ");
$user=mysqli_fetch_assoc($get_user);
$msg='';
if (isset($_GET['status'])&&isset($_GET['post'])){
    $upd=mysqli_query($connect,"UPDATE post set status='$_GET[status]' where post_id= $_GET[post]");
    if(isset($upd)){
        $msg='<div class="container text-center"><div class="alert alert-success" role="alert">Publication status changed</div></div>';
    }
}
if (isset($_GET['delete'])){
    $del=mysqli_query($connect,"DELETE FROM `post`WHERE post_id= $_GET[delete]");
    if (isset( $del)){
        $msg='<div class="container text-center"><div class="alert alert-success" role="alert">post is deleted</div></div>';
    }
}
?>
    <div class="col-sm-9">
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10" style="margin-bottom: 10px">
                    <div class="card">
                        <div class="card-header bg-info">
                        <b> wellcome  <?php echo $user['user_name'];?> </b>
                        </div>
                        <div class="card-body">
                            <div class="row">
                            <div class="col-sm-9">
                                <P><b>user name : <span style="color: #d93616"><?php echo $user['user_name'];?> </span></b></P>
                                <P><b>Email : <span style="color: #d93616"><?php echo $user['email'];?> </span></b></P>
                                <P><b>Gender : <?php if($user['gender']=='male'){ echo ' <img src="../img/male.png" width="30px"/>';} else{ echo ' <img src="../img/female.png"width="30px"/>';}?>  </b></P>
                                <P><b>date of registration : <span style="color: #d93616"><?php echo $user['date'];?> </span></b></P>
                                <P><b>Communication links : <a href="<?php echo $user['facebook'];?>"target="_blank"><i class="fab fa-facebook-square fa-lg "style="color: #040484;"></i></a> : <a href="<?php echo $user['twitter'];?>"target="_blank"><i class="fab fa-twitter-square fa-lg"></i> </a> : <a href="<?php echo $user['instgeram'];?>"target="_blank"><i class="fab fa-instagram fa-lg" style="color: #e6a44d;"></i> </a></b></P>
                            </div>
                            <div class="col-sm-3">
                                <img src="../<?php echo $user['avatar'];?>" class="img-thumbnail" width="100%"/>
                            </div>
                                <div class="col-sm-12 ">
                                    <hr>
                                    <P><B>Short description :</B></P>
                                    <P><span style="color: #d93616"><?php echo $user['about_user'];?> </P>
                                    <a href="edite-user.php?modify_user=<?php echo $user['user_id'];?> " class="btn btn-danger "style="float: right">Modify the data</a>
                      </div>
                 </div>
             </div>
         </div>
    </div>
            </div>
        <div class="row">
      <div class="col-md-1"></div>
        <div class="col-md-10"style="margin-bottom: 10px">
            <div class="card">
                <div class="card-header bg-warning">
                  <b>  The last topics written by you</b>
                </div>

                        <div class="card-body">
                            <?php echo $msg ?>
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">ِِArticle Picture </th>
                                            <th scope="col">Article title</th>
                                            <th scope="col">date of publication</th>
                                            <th scope="col">View the article</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Modify</th>
                                            <th scope="col">Delete</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?Php
                                        $posts=mysqli_query($connect,"SELECT * FROM post  where author = '$user[user_id]' ORDER by post_id desc LIMIT 5 ");

                                        $num=1;
                                        while($post=mysqli_fetch_assoc($posts)){
                                            echo'<tr>
                                <th scope="row">'.$num.'</th>
                         
                                <td scope="row"><img src="../'.($post['image'] == ''?'img/no-img.jpg':$post['image']).'"class="rounded" width="70px"/></td>
                                <td scope="row">'.substr($post['titile'],0,40).'....</td>
                                  <td scope="row">'.$post['post_date'].'</td>
                                  <td><a href="../post.php?id='.$post['post_id'].'" target="_blank" class="btn btn-primary btn-sm">View the article</a></td>
                                <td>'.
                                                ($post['status']=='publishing'?
                                                    '<a href="profile.php?status=Disable&post='.$post['post_id'].'" class="btn btn-success btn-sm">publishing</a>':
                                                    '<a href="profile.php?status=publishing&post='.$post['post_id'].'" class="btn btn-info btn-sm">Disable</a>'
                                                ).'       
                                    <td><a href="edite-post.php?post='.$post['post_id'].'" class="btn btn-warning  btn-sm">Modify</a></td>
                                <td><a href="profile.php?delete='.$post['post_id'].'" class="btn btn-danger  btn-sm">Delete</a></td>
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