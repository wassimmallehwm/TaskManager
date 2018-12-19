
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
    $client->delete($delete_id);
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
            <div class="logo text-uppercase text-center  h1 page_title"><span>All</span><strong class="text-primary"> Clients</strong></div>
            <table class="table">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Company</th>
                    <th>Adress</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $clients = $client->findAll();
                foreach ($clients as $client){
                    $id = $client['id'];
                    echo "<tr><td>" . $client['fullName'] . "</td>";
                    echo "<td>" . $client['company'] . "</td>";
                    echo "<td>" . $client['adress'] . "</td>";
                    ?>
                    <td>
                        <div class="dropdown">
                            <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Action
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="<?php echo "edit_clients.php?edit=$id"?>">Edit</a>
                                <a class="dropdown-item" href="<?php echo "clients.php?delete=$id"?>">Delete</a>
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