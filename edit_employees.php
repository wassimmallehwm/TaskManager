
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
    $data = $emp->findById($edit_id);

    if(isset($_POST['update'])){
        $emp->update($edit_id, array(
            'fullName' => $_POST['fullName'],
            'cin' => $_POST['cin'],
            'dateNaissance' => $_POST['dateNaissance'],
            'etatSocial' => $_POST['etatSocial'],
            'mat' => $_POST['mat'],
            'phone' => $_POST['phone'],
            'phone2' => $_POST['phone2'],
            'phone3' => $_POST['phone3'],
            'adress' => $_POST['adress'],
            'id_function' => $_POST['id_function'],
        ));

        $user->redirect('employees.php');
    }
}

?>
<!DOCTYPE html>
<html>
<?php
require_once("inc/head.php");
?>

<style>

</style>
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
                    <input id="cin" type="number" name="cin" required data-msg="Please enter your CIN" class="input-material" value="<?php
                    if(isset($data['cin']))
                        echo $data['cin'];
                    ?>">
                    <label for="cin" class="label-material">CIN</label>
                </div>

                <div class="form-group-material">
                    <input id="dateNaissance" type="date" name="dateNaissance" required data-msg="Please enter your birth date" class="input-material" value="<?php
                    if(isset($data['dateNaissance']))
                        echo $data['dateNaissance'];
                    ?>">
                    <label for="dateNaissance" class="label-material">Birth Date</label>
                </div>

                <div class="form-group-material">
                    <input id="etatSocial" type="text" name="etatSocial" required data-msg="Please enter your Social Status" class="input-material" value="<?php
                    if(isset($data['etatSocial']))
                        echo $data['etatSocial'];
                    ?>">
                    <label for="fullName" class="label-material">Social Status</label>
                </div>

                <div class="form-group-material">
                    <input id="mat" type="text" name="mat" required data-msg="Please enter your registration number" class="input-material" value="<?php
                    if(isset($data['mat']))
                        echo $data['mat'];
                    ?>">
                    <label for="mat" class="label-material">Number</label>
                </div>

                <div class="form-group-material">
                    <input id="phone" type="tel" name="phone" required data-msg="Please enter your Phone Number 1" class="input-material" value="<?php
                    if(isset($data['phone']))
                        echo $data['phone'];
                    ?>">
                    <label for="phone" class="label-material">Phone Number 1</label>
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

                <div class="form-group-material select-style">
                    <label for="id_function" class="label_select" id="label_select">Function</label>
                    <select name="id_function" id="id_function" class="select_form form-control">
                        <?php
                        $list = $fn->getAllFunctions();
                        foreach ($list as $val){
                            if($val['id'] == $data['id_function'])
                                echo "<option value='".$val['id']."' selected>". $fn->getFunction($val['id']) ."</option>";
                            else
                                echo "<option value='".$val['id']."'>". $fn->getFunction($val['id']) ."</option>";
                        }
                        ?>
                    </select>
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


