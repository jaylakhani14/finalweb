<?php include '../View/header2.php'; ?>
<?php

include_once '../Database/Database.php';

$FName = filter_input(INPUT_POST, 'FirstName');
$LName = filter_input(INPUT_POST, 'LastName');
$Email = filter_input(INPUT_POST, 'EMail');
$Password = filter_input(INPUT_POST, 'Password');
$Phone = filter_input(INPUT_POST, 'PhoneNumber');
$Bday = filter_input(INPUT_POST, 'Birthday');
$Gender = filter_input(INPUT_POST, 'gender');

$RetEmail=get_email($Email);

if (!empty($RetEmail)){

  include 'error.php';

}else{

  add_user($FName, $LName, $Email, $Password, $Phone, $Bday, $Gender);
  include 'Congrats.php';

}




?>
<?php include '../View/footer.php'; ?>