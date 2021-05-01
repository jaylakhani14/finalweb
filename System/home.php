<?php
  include '../View/header3.php';
  include_once '../Database/Database.php';

  session_start();

  $Username = $_SESSION['username'];
  $Password = $_SESSION['passwrod'];

  $RetEmail=get_email($Username);
  $RetID=get_UserID($Username);
  $RetPass=get_pass($Username, $Password);
  $RetName=get_name($Username);


  $UserID=$RetID[0];

  $FName=$RetName[0];
  $LName=$RetName[1];

  $task = get_incomplete_items($UserID);
  $cTask = get_complete_items($UserID);


  $TaskID = filter_input(INPUT_POST, 'task_id');
  if (!empty($TaskID)){
    delete_task($TaskID);
    header("Refresh:0");
  }

  $TaskID2 = filter_input(INPUT_POST, 'task_id2');
  if (!empty($TaskID2)){
    complte_task($TaskID2);
    header("Refresh:0");
  }

  $TaskID3 = filter_input(INPUT_POST, 'task_id3');
  if (!empty($TaskID3)){
    incomplte_task($TaskID3);
    header("Refresh:0");
  }

  $AddItem = filter_input(INPUT_POST, 'task');
  $DueDate = filter_input(INPUT_POST, 'duedate');
  if (!empty($AddItem)){
    add_task($AddItem,$DueDate,$UserID);
    header("Refresh:0");
  }

  $TaskID2 = $_SESSION['taskID2'];
  $ModifyItem = filter_input(INPUT_POST, 'task1');
  $ModifyDate = filter_input(INPUT_POST, 'duedate1');
  if (!empty($ModifyItem)){
    modify_task($ModifyItem, $ModifyDate, $TaskID2);
    header("Refresh:0");
  }

?>

<p id='b3'> Welcome back <?php echo $Username ?>! |
<span id='b4'> <a href='../index.php'>logout</a></span> | <span id='b4'> <a href='changepass.php'>Change Password</a></span></p>

<p id="b7"> <?php echo "$FName $LName"; ?>

<form action="add.php" method="post" id="addform">
  <h1> To-Do Items  <input type="submit" id="addbu" class="btn btn-success btn-circle" value="+" /></h1>
</form>

          <table>
            <tr>
                <th>Task&nbsp;</th>
                <th>Date Added&nbsp;</th>
                <th>Due Date&nbsp;</th>
                <th>&nbsp;</th>
            </tr>
            <?php foreach ($task as $tasks) : ?>
              <tr>
                  <td><?php echo $tasks['Task']; ?></td>
                  <td><?php echo $tasks['Date added']; ?></td>
                  <td><?php echo $tasks['DueDate']; ?></td>
                  <form action="home.php" method="post" >
                      <input type="hidden" name="task_id" value="<?php echo $tasks['taskID']; ?>" >
                      <td><input type="submit" id="delete" name="delete" value="Delete" /></td>
                  </form>
                  <form action="edit.php" method="post" >
                        <input type="hidden" name="task_id1" value="<?php echo $tasks['taskID']; ?>" >
                        <td id="tRows"><input type="submit" id="edit" name="delete" value="Edit" /></td>
                  </form>
                  <form action="home.php" method="post" >
                      <input type="hidden" name="task_id2" value="<?php echo $tasks['taskID']; ?>" >
                      <td id="tswitch"><input type="image" name="check" value="check" src="../Pictures/check.png" /></td>
                  </form>
              </tr>
              <?php endforeach; ?>
          </table>
<h1> Items Completed</h1>
          <table>
            <tr>
                <th>Task&nbsp;</th>
                <th>Date Added&nbsp;</th>
                <th>Due Date&nbsp;</th>
                <th>&nbsp;</th>
            </tr>
            <?php foreach ($cTask as $ctasks) : ?>
              <tr>
                  <td><?php echo $ctasks['Task']; ?></td>
                  <td><?php echo $ctasks['Date added']; ?></td>
                  <td><?php echo $ctasks['DueDate']; ?></td>
                  <form action="home.php" method="post">
                      <input type="hidden" name="task_id" value="<?php echo $ctasks['taskID']; ?>" >
                      <td><input type="submit" id="delete" name="delete" value="Delete" /></td>
                  </form>
                  <form action="home.php" method="post" >
                      <input type="hidden" name="task_id3" value="<?php echo $ctasks['taskID']; ?>" >
                      <td id="tRows"><input type="image" id="b11" name="icheck" value="icheck" src="../Pictures/close.png" /></td>
                  </form>
              </tr>
              <?php endforeach; ?>
          </table>
</form>
<?php include '../View/footer.php'; ?>