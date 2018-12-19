
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
    $task->delete($delete_id);
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
            <div class="logo text-uppercase text-center  h1 page_title"><span>All</span><strong class="text-primary"> Tasks</strong></div>
            <table class="table">
                <thead>
                    <tr>
                        <th>Task</th>
                        <th>Client</th>
                        <th>Employee</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Deadline</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
            <?php
                $tasks = $task->findAll();
                //var_dump($tasks);
            foreach ($tasks as $val){
                $id = $val['id'];
                $name = $val['name'];
                echo "<tr><td>" . $val['name'] . "</td>";
                echo "<td>" . $client->get_name_By_Id($val['client_id']) . "</td>";
                echo "<td>" . $emp->get_name_By_Id($val['employee_id']) . "</td>";
                echo "<td>" . $val['Date'] . "</td>";
                echo "<td>" . $stat->getStatus($val['status']) . "</td>";
                echo "<td>" . $val['deadline'] . "</td>";
                ?>
                <td>
                    <div class="dropdown">
                        <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Action
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="<?php echo "edit_tasks.php?edit=$id"?>">Edit</a>
                            <a class="dropdown-item" href="<?php echo "all_tasks.php?delete=$id"?>">Delete</a>
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
      