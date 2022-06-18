<?php
function register(){
    if(isset($_SESSION['user_id'])){
        echo'<div class="container text-center"><div class="alert alert-danger" role="alert">you are already connected! s' .$_SESSION["user_name"].'</div></div>';

    }
    else{
        
   echo'<div class="container rstyle">
    <form action="include/regst.php"method="post"id="registor" enctype="multipart/form-data">
  <div class="form-group row">
    <label for="input1" class="col-sm-2 col-form-label">user name <i class="fas fa-user"></i></label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="user_name"name="user_name"placeholder="user name">
    </div>
  </div>
  <div class="form-group row">
    <label for="input2" class="col-sm-2 col-form-label">email <i class="fas fa-envelope"></i></label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="email"name="email" placeholder="email">
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
    <div class="col-sm-10">
      <select class="form-control" id="gender"name="gender">
        <option value="male" >male</option>
        <option value="female">femail</option>
   </select>
    </div>
  </div>
  <div class="form-group row">
  <label for="input6"  class="col-sm-2 col-form-label">picture <i class="fas fa-portrait"></i></label>
    <div class="col-sm-10">
    <input type="file" class="form-control-file" id="picture"name="picture">
    </div>
  </div>
  <div class="form-group row">
  <label for="input7"  class="col-sm-2 col-form-label">about <i class="fas fa-user-edit"></i></label>
    <div class="col-sm-10">
    <textarea class="form-control" id="about"name="about" rows="4"></textarea>
    </div>
    </div>
  <div class="form-group row">
    <label for="input7" class="col-sm-2 col-form-label">facebook <i class="fab fa-facebook-square"></i></label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="facebook"name="facebook" placeholder="facebook">
    </div>
    </div>
    <div class="form-group row">
    <label for="input8" class="col-sm-2 col-form-label">instgeram <i class="fab fa-instagram"></i></label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="instgeram"name="instgeram" placeholder="instgram">
    </div>
    </div>
    <div class="form-group row">
    <label for="input9" class="col-sm-2 col-form-label">twitter <i class="fab fa-twitter-square"></i></label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="twitter"name="twitter" placeholder="twitter">
    </div>
    </div>
    <div class="form-group row ">
    <div class="col-sm-12 text-center" id="regist"></div>
    <div class="col-sm-12 ">
      <button type="submit"name="submit" class="btn btn-danger btn-block">Sign in</button>
    </div>
  </div>
</form>
</div>';
    }
}
function login_area(){
  if(isset($_SESSION['user_id'])){
   echo'
   <section class="upperbar text-center">
   <div class="container">
   <div class="row">
   
       <img src="'.$_SESSION['avatar'].'">
       
       <h3>
      
       '.ucfirst( $_SESSION['user_name']).'
  
       </h3>
       <p>
    
       '.substr($_SESSION['about'],0,50).' .....
  
       </p>
       
      
       <a href="'.$_SESSION['facebook'].'" style="color: #040484;">
       <i class="fab fa-facebook-square fa-2x "></i>
       </a>
       <a href="'.$_SESSION['instgram'].'"style="color: #e6a44d;">
       <i class="fab fa-instagram fa-2x"></i>
       </a>
       <a href="'.$_SESSION['twitter'].'"style="color: #00e5ff;">
       <i class="fab fa-twitter-square fa-2x"></i>
       </a>
       <a href="#" class="btn btn-info text-center">personal page</a>';
       if($_SESSION['user_rank']=='admin'){
      echo' <a href="admin-cp/index.php" class="btn btn-danger text-center">control Board</a>';
       }
       echo'
   </div>
</div>
</section>';

}
else{
  echo' 
  <section class="upperbar text-center"style="padding-top:15px;padding-bottom:10px">
  <div class="container-fluid">
  <div class="row">
      <div class="info col-sm-7 text-center text-sm-left">
          <form  id="log" class="form-inline"  action="include/login.php" method="post" >
              <div class="form-group mx-sm-2 mb-2"style="margin-right: 3px;">
                  <label fsor="user" class="sr-only">user name</label>
                  <input type="text" class="form-control" id="user" name="user" placeholder="user name or email">
              </div>
              <div class="form-group mx-sm-2 mb-2"style="margin-right: 3px">
                  <label for="pass" class="sr-only">Password</label>
                  <input type="password" class="form-control" id="pass" name="pass" placeholder="Password">
              </div>
              
              <button type="submit" name="login" class="btn btn-success mb-2">login</button>
              <div class="form-group mx-sm-2 mb-2"style="margin-right: 2px" id="log_r"></div>
          </form>
      </div>
      <div class="info col-sm-4 text-center text-sm-right" style="margin-right: 30px ;">
          if you donot have an account click <a href="rigister.php"style="margin-left:0px ;"><i class="fas fa-user-edit"></i>here</a> to creat one
      </div>
  </div>
</div>
</section>';

}

}
?>