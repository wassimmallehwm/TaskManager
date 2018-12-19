
<?php
require_once 'inc/init.php';
if($user->isLoggedIn()!="")
{
    $user->redirect('home.php');
}

if(isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($user->login($username, $password)) {
        $user->findById(Session::get('id'));
        $user->redirect('home.php');
    } else {
        $error = "Wrong Details !";
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
          <div class="form-inner col-lg-10  offset-lg-1 ">
              <div class="logo text-uppercase"><span>Task</span><strong class="text-primary"> Manager</strong></div>
            <form method="post" class="text-left form-validate">
             <?php
            if(isset($error))
            {
                ?>
                <div class="alert alert-danger">
                    <i class="glyphicon glyphicon-warning-sign"></i> &nbsp; <?php echo $error; ?> !
                </div>
                <?php
            }
            ?>
              <div class="form-group-material">
                <input id="username" type="text" name="username" required data-msg="Please enter your username" class="input-material">
                <label for="username" class="label-material">Username</label>
              </div>
              <div class="form-group-material">
                <input id="password" type="password" name="password" required data-msg="Please enter your password" class="input-material">
                <label for="password" class="label-material">Password</label>
              </div>
               
                <button type="submit" name="login" class="btn btn-block btn-primary">Login</button>
              
            </form>
          </div>
        </div>
      </div>
    </div>
    
  <?php
    require_once 'inc/js_links.php';
    ?>
  </body>
</html>