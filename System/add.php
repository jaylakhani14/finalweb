<?php
include '../View/header3.php';
include_once '../Database/Database.php';

session_start();

$Username = $_SESSION['username'];
$Password = $_SESSION['passwrod'];


?>
<form action="home.php" method="post">
  <div class="container">
    <label for="task"> Task: </label>
      <input type=text name="task" placeholder="Enter a description for the task" id="task" required> <br><br>
    <label for="duedate"> When is it due? </label>
        <input type=datetime-local name="duedate" id="duedate" required/> <br><br>
    <button type="submit">Save</button>
  </div>
</form>

<?php include '../View/footer.php'; ?>