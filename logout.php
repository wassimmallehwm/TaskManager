<?php
require_once 'inc/init.php';
session_destroy();
Session::delete('id');
$user->redirect('index.php');
?>