
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

if(isset($_POST['add'])){


    $pic_des = "";
    if(!empty($_FILES)){
        $pic = $_FILES['picture']['name'];
        $pic_ext = strrchr($pic,".");
        $pic_des ='img/'.$pic;
        $pic_tmp= $_FILES['picture']['tmp_name'];

        $ext_allowed = array('.jpg', '.png','.JPEG', '.PNG');

        if(in_array($pic_ext,$ext_allowed)){
            if(!move_uploaded_file($pic_tmp,$pic_des))
                $error = "Erreur lors de l'envoi de l'image";
        }
        else
            $error = 'Seuls les images sont autorisés';
    }

    try
    {
        $task->create(array(
            'name' => $_POST['name'],
            'date' => $_POST['date'],
            'deadline' => $_POST['deadline'],
            'status' => 1,
            'picture' => $pic_des,
            'employee_id' => $_POST['employee'],
            'client_id' => $_POST['client']
        ));

        $user->redirect('all_tasks.php');
    }
    catch(PDOException $e)
    {
        echo $e->getMessage();
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

            <form class="text-left form-validate" method="post" enctype="multipart/form-data">



                <div class="form-group-material">
                    <input id="name" type="text" name="name" required data-msg="Please enter the task name" class="input-material">
                    <label for="name" class="label-material">Name</label>
                </div>

                <div class="form-group-material">
                    <input id="date" type="date" name="date" required data-msg="Please enter the date" class="input-material">
                    <label for="date" class="label-material">Date</label>
                </div>

                <div class="form-group-material">
                    <input id="deadline" type="date" name="deadline" required data-msg="Please enter the deadline" class="input-material">
                    <label for="deadline" class="label-material">Deadline</label>
                </div>

                <div class="form-group-material select-style">
                    <label for="client" class="label_select" id="label_select">Client</label>
                    <select name="client" id="client" class="select_form form-control" required data-msg="Select the client !">
                        <option value="" selected disabled>Select the client</option>
                        <?php
                        $list = $client->findAll();
                        foreach ($list as $val){
                            echo "<option value='".$val['id']."'>". $val['fullName'] ."</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group-material select-style">
                    <label for="employee" class="label_select" id="label_select">Employee</label>
                    <select name="employee" id="employee" class="select_form form-control" required data-msg="Select the employee !">
                        <option value="" selected disabled>Select the employee</option>
                        <?php
                        $list = $emp->findAll();
                        foreach ($list as $val){
                            echo "<option value='".$val['id']."'>". $val['fullName'] ."</option>";
                        }
                        ?>
                    </select>
                </div>


                <div class="form-group-material">
                    <input id="picture" type="file" name="picture" required data-msg="Please load the picture" class="input-material">
                </div>

                <div class="form-group ">
                    <input id="add" type="submit" value="Add" name="add" class="btn  btn-primary">
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


