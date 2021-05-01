<?php
include '../View/header3.php';
include_once '../Database/Database.php';

session_start();

$Username = $_SESSION['username'];
$Password = $_SESSION['passwrod'];
$RetID=get_UserID($Username);
$UserID=$RetID[0];

$oldp = filter_input(INPUT_POST, 'oldp');
$newp = filter_input(INPUT_POST, 'newp');

if ("$oldp" == "$Password"){
      change_pass($newp, $UserID);
      header('Location: congrats.php');
} else {
    header('Location: ../Error/error3.php');
}



?>






<?php include '../View/footer.php'; ?>