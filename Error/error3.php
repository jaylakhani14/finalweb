<?php
include '../View/header3.php';
include_once '../Database/Database.php';

session_start();

$Username = $_SESSION['username'];
$Password = $_SESSION['passwrod'];


?>

<p> Incorrect old password please try again!</p>

<form action="../System/route.php" method="post">
  <div class="container">
    <label for="oldp"> Old Password</label>
      <input type=password name="oldp" placeholder="Enter your old Password" id="oldp" required> <br><br>
    <label for="newp"> New Password </label>
        <input type=password name="newp" id="newp" required/> <br><br>
    <button type="submit">Change</button>
  </div>
</form>


<?php include '../View/footer.php'; ?>