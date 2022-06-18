<?PHP
include_once("inc/header.php");
include_once("inc/sidebar.php");
$msg='';
if (isset($_GET['status'])&&isset($_GET['post'])){
    $upd=mysqli_query($connect,"UPDATE post set status='$_GET[status]' where post_id= $_GET[post]");
}
if (isset($_GET['delete'])){
    $del=mysqli_query($connect,"DELETE FROM `post`WHERE post_id= $_GET[delete]");
    if (isset( $del)){
        $msg='<div class="container text-center"><div class="alert alert-success" role="alert">post is deleted</div></div>';
    }
}
?>
    <div class="col-sm-9">
        <div class="card">
            <div class="card-header bg-info">
                Featured
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
                    $start_page = 0;
                    $per_page = 1;

                    if(!isset($_GET['page']))
                    {
                        $page = 1;
                    } else {
                        $page = $_GET['page'];
                    }
                        $start_page = $page * $per_page - $per_page;

                    $posts=mysqli_query($connect,"SELECT * FROM post p INNER JOIN rigister_table r where p.author =r.user_id order by post_id desc LIMIT $start_page , $per_page");
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
                <?php
                $page_sql=mysqli_query($connect,"select * from post");
                $count_page=mysqli_num_rows($page_sql);
                $total_page=ceil($count_page/$per_page);
                ?>
                <div class="text-center"style="margin-left: 50% ;font-weight: bold; ">
                <nav class="text-center">
                    <ul class="pagination text-center">
                        <?php
                        for ($i=1;$i<=$total_page;$i++){
                            echo '<li   '.($page==$i ? 'class="active"':'').'><a style="color: #d93616;padding-left:10px;" href="posts.php?page='.$i.'">'.$i.'</a></li>';
                        }
                        ?>
                    </ul>
                </nav>
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