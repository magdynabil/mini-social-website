<?PHP
include_once("inc/header.php");
include_once("inc/sidebar.php");
$id=intval($_GET['modify_user']);
$user_data=mysqli_query($connect,"SELECT * FROM rigister_table WHERE user_id='$id'");
$info=mysqli_fetch_assoc($user_data);

?>
    <div class="col-sm-9">


        <div class="card  ">

            <div class="card-header bg-info ">
                <b>edit user :<?php echo $info['user_name']?></b>
            </div>




            <div class="card-body row ">


                <form class="col-md-9" action="modfi-user.php"method="post" id="mod" enctype="multipart/form-data">
                    <div class="form-group row">
                        <label for="input1" class="col-sm-2 col-form-label" >user name <i class="fas fa-user"></i></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="user_name"name="user_name"placeholder="user name"value="<?php echo $info['user_name']?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="input2" class="col-sm-2 col-form-label">email <i class="fas fa-envelope"></i></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="email"name="email" placeholder="email" value="<?php echo $info['email']?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="input3" class="col-sm-2 col-form-label">Password <i class="fas fa-unlock-alt"></i></label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control"  id="Password"name="Password" placeholder="Password">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="input4" class="col-sm-2 col-form-label">confirm password<i class="fas fa-unlock-alt"></i></label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" id="config_password"name="config_password" placeholder="Password">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="input5" class="col-sm-2 col-form-label">gender <i class="fas fa-venus-mars"></i></label>
                        <div class="col-sm-5">
                            <select class="form-control" id="gender"name="gender">
                                <option value="male"<?php echo ($info['gender']=='male'?'selected':'')?> >male</option>
                                <option value="female"<?php echo ($info['gender']=='female'?'selected':'')?>>femail</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="input6"  class="col-sm-2 col-form-label">picture <i class="fas fa-portrait"></i></label>
                        <div class="col-sm-10">
                            <input type="file" class="form-control-file" id="picture"name="picture" <?php echo $info['avatar']?> >
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="input7"  class="col-sm-2 col-form-label">about <i class="fas fa-user-edit"></i></label>
                        <div class="col-sm-10">
                            <textarea class="form-control" id="about"name="about" rows="4"><?php echo $info['about_user']?></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="input7" class="col-sm-2 col-form-label">facebook <i class="fab fa-facebook-square"></i></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="facebook"name="facebook" placeholder="facebook"value="<?php echo $info['facebook']?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="input8" class="col-sm-2 col-form-label">instgeram <i class="fab fa-instagram"></i></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="instgeram"name="instgeram" placeholder="instgram" value="<?php echo $info['instgram']?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="input9" class="col-sm-2 col-form-label">twitter <i class="fab fa-twitter-square"></i></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="twitter"name="twitter" placeholder="twitter"value="<?php echo $info['twitter']?>">
                        </div>
                    </div>
                    <div class="form-group row">

                        <label for="input5" class="col-sm-2 col-form-label">gender <i class="fas fa-venus-mars"></i></label>
                        <div class="col-sm-5">
                            <select class="form-control" id="user_rank"name="user_rank">
                                <option value="user"<?php echo ($info['user_rank']=='user'?'selected':'')?> >user</option>
                                <option value="admin"<?php echo ($info['user_rank']=='admin'?'selected':'')?>>admin</option>
                                <option value="writer"<?php echo ($info['user_rank']=='female'?'selected':'')?>>writer</option>
                            </select>
                            </select>
                        </div>
                        </div>




                    <div class="form-group row text-center ">
                        <div class="col-sm-12 text-center" id="modify"></div>
                        <div class="col-sm-4 "></div>
                        <div class="col-sm-4 ">
                            <button type="submit"name="submit" class="btn btn-danger btn-block">Modify user data</button>
                        </div>
                    </div>
                </form>
                <div class="col-md-3 text-center" >

                        <img src="../<?php echo $info['avatar']?>"width="230px" style=" border-radius: 115px;"/>
                    <div style="padding-top:10px;"> <b ><?php echo $info['user_name']?></b></div>


                </div>


    </div>

    </div>
    <!--end panal-->
<?PHP

include_once("inc/footer.php");
?>