<?php
session_start();
spl_autoload_register(function($class){
    require_once('classes/'.$class.'.php');
});

//include_once 'classes/User.php';
$user = new User();
$task = new Task();
$emp = new Employee();
$client = new Clients();
$stat = new Status();
$fn = new Fonction();



?>


