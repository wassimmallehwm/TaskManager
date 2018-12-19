
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

    $row = $task->findById($edit_id);


    if(isset($_POST['update'])){

        if(!empty($_FILES) && $_FILES['picture']['name'] != ""){
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
        }else{
            $pic_des = $row['picture'];
        }


        $task->update($edit_id, array(
            'name' => $_POST['name'],
            'date' => $_POST['date'],
            'deadline' => $_POST['deadline'],
            'status' => $_POST['status'],
            'picture' => $pic_des,
            'employee_id' => $_POST['employee'],
            'client_id' => $_POST['client']
        ));

        $user->redirect('all_tasks.php');
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

            <form class="text-left form-validate" method="post"  enctype="multipart/form-data">

                <div class="form-group-material">
                    <input id="name" type="text" name="name" required data-msg="Please enter the task name" class="input-material"  value="<?php
                    if(isset($row['name']))
                        echo $row['name'];
                    ?>">
                    <label for="name" class="label-material">Name</label>
                </div>

                <div class="form-group-material">
                    <input id="date" type="date" name="date" required data-msg="Please enter the date" class="input-material"  value="<?php
                    if(isset($row['Date']))
                        echo $row['Date'];
                    ?>">
                    <label for="date" class="label-material">Date</label>
                </div>

                <div class="form-group-material">
                    <input id="deadline" type="date" name="deadline" required data-msg="Please enter the deadline" class="input-material"  value="<?php
                    if(isset($row['deadline']))
                        echo $row['deadline'];
                    ?>">
                    <label for="deadline" class="label-material">Deadline</label>
                </div>

                <div class="form-group-material select-style">
                    <label for="client" class="label_select" id="label_select">Client</label>
                    <select name="client" id="client" class="select_form form-control" required data-msg="Select the client !">
                        <?php
                        $list = $client->findAll();
                        foreach ($list as $val){
                            if($val['id'] == $row['client_id']){
                                echo "<option value='".$val['id']."' selected>". $val['fullName'] ."</option>";
                            }else{
                                echo "<option value='".$val['id']."'>". $val['fullName'] ."</option>";
                            }
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group-material select-style">
                    <label for="employee" class="label_select" id="label_select">Employee</label>
                    <select name="employee" id="employee" class="select_form form-control" required data-msg="Select the employee !">
                        <?php
                        $list = $emp->findAll();
                        foreach ($list as $val){
                            if($val['id'] == $row['employee_id']){
                                echo "<option value='".$val['id']."' selected>". $val['fullName'] ."</option>";
                            }else{
                                echo "<option value='".$val['id']."'>". $val['fullName'] ."</option>";
                            }
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group-material select-style">
                    <label for="status" class="label_select" id="label_select">Status</label>
                    <select name="status" id="status" class="select_form form-control" required data-msg="Select the status !">
                        <?php
                        $list = $stat->findAll();
                        foreach ($list as $val){
                            if($val['id'] == $row['status']){
                                echo "<option value='".$val['id']."' selected>". $val['designation'] ."</option>";
                            }else{
                                echo "<option value='".$val['id']."'>". $val['designation'] ."</option>";
                            }
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group-material">
                    <img src="<?php echo $row['picture']; ?>" alt="" class="task_img">
                    <input id="picture" type="file" name="picture" class="input-material">
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


