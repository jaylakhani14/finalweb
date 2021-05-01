<?php
include '../View/header3.php';
include_once '../Database/Database.php';

session_start();

$Username = $_SESSION['username'];
$Password = $_SESSION['passwrod'];


?>

<br><br><br><br><br><br><br><br><br><br><br><br>
<h2> Password Changed! </h2>
<br>
<ul>
  <input type="submit" value="Home" id="b2" onclick="window.location='../System/home.php';" />
</ul>





<?php include '../View/footer.php'; ?>