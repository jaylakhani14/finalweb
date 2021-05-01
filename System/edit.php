<?php
include '../View/header3.php';
include_once '../Database/Database.php';

session_start();

$Username = $_SESSION['username'];
$Password = $_SESSION['passwrod'];

$TaskID1 = filter_input(INPUT_POST, 'task_id1');
$_SESSION['taskID2'] = $TaskID1;

$Task=get_task($TaskID1);
?>

<p id="etask"> Edit this Task! </p><br>


<table class="centerTable">
  <tr>
      <th>Task&nbsp;</th>
      <th>Date Added&nbsp;</th>
      <th>Due Date&nbsp;</th>
      <th>&nbsp;</th>
  </tr>
  <tr>
    <td><?php echo $Task[0]; ?></td>
    <td><?php echo $Task[1]; ?></td>
    <td><?php echo $Task[2]; ?></td>
  </tr>
</table>

<br>

<form action="home.php" method="post">
  <div class="container">
    <label for="task"> Modify Task </label>
      <input type=text name="task1" placeholder="Enter a description for the task" id="task" required> <br><br>
    <label for="duedate"> Modify Due Date </label>
        <input type=datetime-local name="duedate1" id="duedate" required/> <br><br>
    <button type="submit">Save</button>
  </div>
</form>



<?php include '../View/footer.php'; ?>