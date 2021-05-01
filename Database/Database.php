<?php
//PDO connect
$db = NULL;

// Let's connect to a database
// Order of db connection: Heroku mySQL Database --> Local mySQL Database
// Check to see if we are on a Heroku Server by checking for an environmental variable with db data
if ((getenv('JAWSDB_URL') != null)) {

	$dbparts = parse_url(getenv('JAWSDB_URL'));
	$hostname = $dbparts['host'];
	$username = $dbparts['user'];
	$password = $dbparts['pass'];
	$database = ltrim($dbparts['path'],'/');

	try {
	    $db = new PDO("mysql:host=$hostname;dbname=$database", $username, $password, array(PDO::MYSQL_ATTR_FOUND_ROWS => true));
	    // set the PDO error mode to exception
	    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	    //echo "Connected successfully";
    }
	catch(PDOException $e) {
  		http_error(500, "Internal Server Error", "We couldn't connect to a Heroku MySQL database.");
  		//echo "Connection failed: " . $e->getMessage();
    }
}
else {

	$hostname = "localhost";
	$username = "root";
	$password = "";
	$database = "Final5";

	try {
		$db = new PDO("mysql:host=$hostname;dbname=$database", $username, $password, array(PDO::MYSQL_ATTR_FOUND_ROWS => true));

	}
	catch (PDOException $e) {
		http_error(500, "Internal Server Error", "We couldn't connect to a local(host) MySQL database.");
	}

}
// Prepares and executes the given sql query with the provided parameters array.
// also removes the need for having quotes and washing via prepare
// fetchAll - if true fetches all rows, if false only fetches first row.
function prepareAndExecute($sql, $params = null, $fetchAll = false, $returnNoAffected = false) {
	global $db;
	try {
		// Clean up character if using mySQL using next line
		$sql = str_replace("\"", "", $sql);

		$q = $db->prepare($sql);
		$q->execute($params);
		if (strpos($sql, "INSERT") !== false || strpos($sql, "DELETE") !== false || strpos($sql, "UPDATE") !== false) {
			if (!$returnNoAffected) {
				return $db->lastInsertId();
			} else {
				return $q->rowCount();
			}
		} else {
			if ($fetchAll) {
				return $q->fetchAll(PDO::FETCH_ASSOC);
			} else {
				return $q->fetch(PDO::FETCH_ASSOC);
			}
		}
	} catch (PDOException $e) {
		if (true) {	// change to false when deploying
			http_error(500, "Internal Server Error", "There was a SQL error:\n\n" . $e->getMessage());
		} else {
			http_error(500, "Internal Server Error", "Something went wrong.");
		}
	}
}

// begins transaction
function beginTransaction() {
	global $db;
	$db->beginTransaction();
}

// commits changes
function commit() {
	global $db;
	$db->commit();
}

// rollbacks any changes
function rollBack() {
	global $db;
	$db->rollBack();
}
/**
 * Checks if the specified parameter exists in the $_POST array.
 * @param  String $paramName the name of the parameter
 */
function checkParameterOrDie($paramName) {
	if (!isset($_REQUEST[$paramName])) {
		header('HTTP/1.1 500 Internal Server Error');
		exit("ERROR: There was an error receiving '$paramName' from the form submitter.");
	}
}

function http_error($code, $status, $message) {
		header("HTTP/1.1 $code $status");
		header("Content-type: text/plain");
		die($message);
	}

function add_user($FName, $LName, $Email, $Password, $Phone, $Bday, $Gender) {
      global $db;
      $query = 'INSERT INTO users
                   (FName, LName, Email, Password, Phone, Bday, Gender)
                VALUES
                   (:fname, :lname, :email, :pass, :pnumber, :bday, :gender)';
      $statement = $db->prepare($query);
      $statement->bindValue(':fname', $FName);
      $statement->bindValue(':lname', $LName);
      $statement->bindValue(':email', $Email);
      $statement->bindValue(':pass', $Password);
      $statement->bindValue(':pnumber', $Phone);
      $statement->bindValue(':bday', $Bday);
      $statement->bindValue(':gender', $Gender);
      $statement->execute();
      $statement->closeCursor();
  }

function get_email($Email) {
    global $db;
    $query = 'SELECT FName FROM users
              WHERE EMail = :EMail';
    $statement = $db->prepare($query);
    $statement->bindValue(":EMail", $Email);
    $statement->execute();
    $product = $statement->fetch();
    $statement->closeCursor();
    return $product;
}

function get_pass($Email, $Password) {
    global $db;
    $query = 'SELECT * FROM users
              WHERE EMail = :EMail and Password = :Password';
    $statement = $db->prepare($query);
    $statement->bindValue(":EMail", $Email);
		$statement->bindValue(":Password", $Password);
    $statement->execute();
    $product = $statement->fetch();
    $statement->closeCursor();
    return $product;
}

function get_incomplete_items($UserID){
	  global $db;
    $query = 'SELECT * FROM to_do_items
              WHERE Completed = "0" and UserID = :UserID order by `DueDate`';
    $statement = $db->prepare($query);
		$statement->bindValue(':UserID',$UserID);
		$statement->execute();
    $product = $statement->fetchALL();
    $statement->closeCursor();
    return $product;
}


function get_complete_items($UserID){
	  global $db;
    $query = 'SELECT * FROM to_do_items
              WHERE Completed = "1" and UserID = :UserID order by `DueDate`';
    $statement = $db->prepare($query);
		$statement->bindValue(':UserID',$UserID);
		$statement->execute();
    $product = $statement->fetchALL();
    $statement->closeCursor();
    return $product;
}

function get_UserID($Email){
	global $db;
	$query = 'SELECT UserID FROM users
						WHERE EMail = :Email';
	$statement = $db->prepare($query);
	$statement->bindValue(':Email',$Email);
	$statement->execute();
	$UserID= $statement->fetch();
	$statement->closeCursor();
	return $UserID;
}

function get_name($Email){
	global $db;
	$query = 'SELECT FName,LName FROM users
						WHERE EMail = :Email';
	$statement = $db->prepare($query);
	$statement->bindValue(':Email',$Email);
	$statement->execute();
	$UserID= $statement->fetch();
	$statement->closeCursor();
	return $UserID;
}
function delete_task($task_id) {
    global $db;
    $query = 'DELETE FROM to_do_items
              WHERE taskID = :taskID';
    $statement = $db->prepare($query);
    $statement->bindValue(':taskID', $task_id);
    $statement->execute();
    $statement->closeCursor();
}

function add_task($Task, $DueDate, $UserID) {
    global $db;
    $query = 'INSERT INTO to_do_items
                 (Task, DueDate, UserID)
              VALUES
                 (:task, :duedate, :userid )';
    $statement = $db->prepare($query);
    $statement->bindValue(':task', $Task);
    $statement->bindValue(':duedate', $DueDate);
    $statement->bindValue(':userid', $UserID);
    $statement->execute();
    $statement->closeCursor();
}

function get_task($TaskID){
	global $db;
	$query = 'SELECT * FROM to_do_items
						WHERE taskID = :taskID';
	$statement = $db->prepare($query);
	$statement->bindValue(':taskID',$TaskID);
	$statement->execute();
	$Task= $statement->fetch();
	$statement->closeCursor();
	return $Task;
}

function modify_task($Task, $DueDate, $TaskID){
	global $db;
	$query = 'UPDATE to_do_items
						SET task = :task, DueDate = :duedate
						WHERE taskID = :taskID';
	$statement = $db->prepare($query);
	$statement->bindValue(':task', $Task);
	$statement->bindValue(':duedate', $DueDate);
	$statement->bindValue(':taskID', $TaskID);
	$statement->execute();
	$statement->closeCursor();
}

function complte_task($TaskID){
	global $db;
	$query = 'UPDATE to_do_items
						SET Completed = "1"
						WHERE taskID = :taskID';
	$statement = $db->prepare($query);
	$statement->bindValue(':taskID', $TaskID);
	$statement->execute();
	$statement->closeCursor();
}

function incomplte_task($TaskID){
	global $db;
	$query = 'UPDATE to_do_items
						SET Completed = "0"
						WHERE taskID = :taskID';
	$statement = $db->prepare($query);
	$statement->bindValue(':taskID', $TaskID);
	$statement->execute();
	$statement->closeCursor();
}

function change_pass($Pass, $UserID){
	global $db;
	$query = 'UPDATE users
						SET Password = :password
						WHERE UserID = :userid';
	$statement = $db->prepare($query);
	$statement->bindValue(':password', $Pass);
	$statement->bindValue(':userid', $UserID);
	$statement->execute();
	$statement->closeCursor();
}



?>