<?php include '../View/header2.php'; ?>

<p> Incorrect password please try again!</p>

<form action="../System/Main.php" method="post">
  <div class="imgcontainer">
    <img src="../Pictures/login.png" alt="Avatar" class="avatar">
  </div>
  <div class="container">
<label for="EnterUsername"> Username </label>
  <input type=text name="username" placeholder="Enter Username" id="username" required> <br>
<label for="EnterPassword"> Password </label>
  <input type=password name="password" placeholder="Enter Password" id="password" required> <br>
<button type="submit">Login</button>
</div>

  <span class="psw"> <a href="../Register/index.php">Register?</a></span>

</form>


<?php include '../View/footer.php'; ?>