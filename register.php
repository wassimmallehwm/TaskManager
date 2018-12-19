
<?php
require_once 'inc/init.php';
if($user->isLoggedIn()!="")
{
    $user->redirect('home.php');
}

if(isset($_POST['signup']))
{
    $username = trim($_POST['username']);
    $fullName = trim($_POST['fullName']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);
    $hash_password=password_hash($password, PASSWORD_DEFAULT);

    if(!empty($_FILES)){
        $pic = $_FILES['pic']['name'];
        $pic_ext = strrchr($pic,".");
        $pic_des ='img/'.$pic;
        $pic_tmp= $_FILES['pic']['tmp_name'];

        $ext_allowed = array('.jpg', '.png','.JPEG', '.PNG');

        if(in_array($pic_ext,$ext_allowed)){
            if(!move_uploaded_file($pic_tmp,$pic_des))
                $error[] = "Erreur lors de l'envoi de l'image";
        }
        else
            $error[] = 'Seuls les images sont autorisés';
    }

    if($username=="") {
        $error[] = "provide username !";
    }
    else if($fullName=="") {
        $error[] = "provide full Name !";
    }
    else if($password=="") {
        $error[] = "provide password !";
    }
    else if(strlen($password) < 6){
        $error[] = "Password must be atleast 6 characters";
    }
    else if($confirm_password !== $password){
        $error[] = "confirm password must match password !";
    }
    else
    {
        try
        {

            if($user->findByUser($username)) {
                $error[] = "sorry username already taken !";
            }
            else
            {

                $user->create(array(
                    'username' => $username,
                    'password' => $hash_password,
                    'fullName' => $fullName,
                    'pic' => $pic_des,
                    'permission' => "user"

                ));



            }
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }
    }

    if($user->findByUser($username)){
        $user->login($username,$hash_password);
        if($user->isLoggedIn()){
            $user->redirect('home.php');
        }
        else echo 'nooooo';
    }
    
}








?>

<!DOCTYPE html>
<html>
  <?php
    require_once 'inc/head.php';
    ?>
  <body>
    <div class="page login-page">
      <div class="container">
        <div class="form-outer text-center d-flex align-items-center">
          <div class="form-inner">
            <div class="logo text-uppercase"><span>Project</span><strong class="text-primary">Management</strong></div>
            <form class="text-left form-validate" method="post" enctype="multipart/form-data">
              <div class="form-group-material">
                <input id="username" type="text" name="username" required data-msg="Please enter your username" class="input-material">
                <label for="username" class="label-material">Username</label>
              </div>
              
              
              <div class="form-group-material">
                <input id="fullName" type="text" name="fullName" required data-msg="Please enter your full name" class="input-material">
                <label for="fullName" class="label-material">Full Name</label>
              </div>
              
              
              <div class="form-group-material">
                <input id="password" type="password" name="password" required data-msg="Please enter your password" class="input-material">
                <label for="password" class="label-material">Password</label>
              </div>
              
              <div class="form-group-material">
                <input id="confirm_password" type="password" name="confirm_password" required data-msg="Please confirm your password" class="input-material">
                <label for="confirm_password" class="label-material">Confirm Password</label>
              </div>
              
              
              <div class="form-group-material">
                <input type="file" class="form-control-file" id="pic" name="pic">
              </div>
              
              <div class="form-group text-center">
                <button name="signup" type="submit" class="btn btn-block btn-primary">Register</button>
              </div>
              
            </form>
            <small>Already have an account? </small><a href="index.php" class="signup">Login</a>
          </div>
        </div>
      </div>
    </div>
    
  <?php
    require_once 'inc/js_links.php';
    ?>
  </body>
</html>