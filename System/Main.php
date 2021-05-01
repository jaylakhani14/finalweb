<?php include '../View/header3.php'; ?>
<?php
  include_once '../Database/Database.php';

  $Username = filter_input(INPUT_POST, 'username');
  $Password = filter_input(INPUT_POST, 'password');

  $RetEmail=get_email($Username);
  $RetPass=get_pass($Username, $Password);
  $RetID=get_UserID($Username);

  $UserID=$RetID[0];

  if (empty($RetEmail)){

      include '../Error/error.php';

  }elseif (empty($RetPass)){

      include '../Error/error2.php';

  }else{

      session_start();

      $_SESSION['username'] = $Username;
      $_SESSION['passwrod'] = $Password;
      header("Location: home.php");

  }
 ?>