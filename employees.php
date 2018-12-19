
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
if(isset($_GET['delete'])){
    $delete_id = $_GET['delete'];
    $emp->delete($delete_id);
}


if(isset($_POST['update'])) {

    $task->update($_POST['id'], array(
        'name' => $_POST['name'],
        'deadline' => $_POST['deadline'],
        'progress' => $_POST['progress'],
        'userId' => $_POST['user'],
    ));
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
        <div class="col-lg-12">
            <div class="logo text-uppercase text-center  h1 page_title"><span>All</span><strong class="text-primary"> Employees</strong></div>
            <table class="table">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>CIN</th>
                    <th>Phone Number</th>
                    <th>Adress</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $emps = $emp->findAll();
                foreach ($emps as $empl){
                    $id = $empl['id'];
                    echo "<tr><td>" . $empl['fullName'] . "</td>";
                    echo "<td>" . $empl['cin'] . "</td>";
                    echo "<td>" . $empl['phone'] . "</td>";
                    echo "<td>" . $empl['adress'] . "</td>";
                ?>
                <td>
                    <div class="dropdown">
                        <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Action
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="<?php echo "edit_employees.php?edit=$id"?>">Edit</a>
                            <a class="dropdown-item" href="<?php echo "employees.php?delete=$id"?>">Delete</a>
                        </div>
                    </div>
                </td>
                </tr>
                <?php
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php
require_once 'inc/footer.php';
require_once 'inc/js_links.php';
?>
</div>
</body>
</html>