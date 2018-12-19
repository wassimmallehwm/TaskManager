
<?php
require_once 'inc/init.php';
if($user->isLoggedIn()){
    $user->findById(Session::get('id'));
}
else{
    $user->redirect('index.php');
}
?>
<?php

if(isset($_GET['edit'])){

    $edit_id = $_GET['edit'];
    $data = $client->findById($edit_id);

    if(isset($_POST['update'])){
        $client->update($edit_id, array(
            'fullName' => $_POST['fullName'],
            'company' => $_POST['company'],
            'phone1' => $_POST['phone1'],
            'phone2' => $_POST['phone2'],
            'phone3' => $_POST['phone3'],
            'adress' => $_POST['adress'],
            'latitude' => $_POST['latitude'],
            'longtitude' => $_POST['longtitude'],
            'activity_section' => $_POST['activity_section'],
        ));

        $user->redirect('clients.php');
    }
}

?>
<!DOCTYPE html>
<html>
<?php
require_once("inc/head.php");
?>
<body>
<?php
require_once("inc/navbar.php");
?>

<div class="container main_container">
    <div class="row">
        <div class="col-lg-6 offset-lg-3">

            <form class="text-left form-validate" method="post">



                <div class="form-group-material">
                    <input id="fullName" type="text" name="fullName" required data-msg="Please enter your full name" class="input-material" value="<?php
                    if(isset($data['fullName']))
                        echo $data['fullName'];
                    ?>">
                    <label for="fullName" class="label-material">Full Name</label>
                </div>

                <div class="form-group-material">
                    <input id="company" type="text" name="company" required data-msg="Please enter your compnay" class="input-material" value="<?php
                    if(isset($data['company']))
                        echo $data['company'];
                    ?>">
                    <label for="company" class="label-material">Compnay</label>
                </div>

                <div class="form-group-material">
                    <input id="phone1" type="tel" name="phone1" required data-msg="Please enter your Phone Number 1" class="input-material" value="<?php
                    if(isset($data['phone1']))
                        echo $data['phone1'];
                    ?>">
                    <label for="phone1" class="label-material">Phone Number 1</label>
                </div>

                <div class="form-group-material">
                    <input id="phone2" type="tel" name="phone2" required data-msg="Please enter your Phone Number 2" class="input-material" value="<?php
                    if(isset($data['phone2']))
                        echo $data['phone2'];
                    ?>">
                    <label for="phone2" class="label-material">Phone Number 2</label>
                </div>

                <div class="form-group-material">
                    <input id="phone3" type="tel" name="phone3" required data-msg="Please enter your Phone Number 3" class="input-material" value="<?php
                    if(isset($data['phone3']))
                        echo $data['phone3'];
                    ?>">
                    <label for="phone3" class="label-material">Phone Number 3</label>
                </div>

                <div class="form-group-material">
                    <input id="adress" type="text" name="adress" required data-msg="Please enter your Adress" class="input-material" value="<?php
                    if(isset($data['adress']))
                        echo $data['adress'];
                    ?>">
                    <label for="adress" class="label-material">Adress</label>
                </div>

                <div class="form-group-material">
                    <input id="latitude" type="tel" name="latitude" required data-msg="Please enter the latitude" class="input-material" value="<?php
                    if(isset($data['latitude']))
                        echo $data['latitude'];
                    ?>">
                    <label for="phone3" class="label-material">Latitude</label>
                </div>

                <div class="form-group-material">
                    <input id="longtitude" type="tel" name="longtitude" required data-msg="Please enter the longtitude" class="input-material" value="<?php
                    if(isset($data['longtitude']))
                        echo $data['longtitude'];
                    ?>">
                    <label for="phone3" class="label-material">Longtitude</label>
                </div>

                <div class="form-group-material">
                    <input id="activity_section" type="text" name="activity_section" required data-msg="Please enter your activity section" class="input-material" value="<?php
                    if(isset($data['activity_section']))
                        echo $data['activity_section'];
                    ?>">
                    <label for="activity_section" class="label-material">Activity Section</label>
                </div>

                <div class="form-group ">
                    <input id="update" type="submit" value="Update" name="update" class="btn  btn-primary">
                </div>

            </form>
        </div>
    </div>
</div>
<?php
require_once 'inc/footer.php';
?>
</div>
<?php
require_once 'inc/js_links.php';
?>
</body>
</html>


