<?php include '../View/header2.php'; ?>

<p> That Email address is already in use! please enter a different one! </p>

<form action="second.php" method="post">
  <div class="container">
    <label for="FirstName"> First Name </label>
      <input type=text name="FirstName" placeholder="Enter First Name" id="fname" required> <br><br>
    <label for="LastName"> Last Name </label>
      <input type=text name="LastName" placeholder="Enter Last Name" id="lname" required> <br><br>
    <label for="EMail"> E-Mail Address </label>
      <input type=text name="EMail" placeholder="Enter E-mail Address" id="email" required> <br><br>
    <label for="password"> Password </label>
      <input type=password name="Password" placeholder="Enter Password" id="pass" required> <br><br>
    <label for="PhoneNumber"> Phone Number </label>
      <input type=text name="PhoneNumber" placeholder="Enter Phone Number" id="pnumber" required> <br><br>
    <label for="Birthday"> Birthdate </label>
      <input type=date name="Birthday" id="bday" required/> <br><br>
    <label for="gender"> Gender </label>
      <select name="gender" id="gender" >
          <option value="Male">Male</option>
          <option value="Female">Female</option>
      </select><br>
    <button type="submit">Register</button>
  </div>
<span class="psw"> <a href="../index.php">login</a></span>

</form>



<?php include '../View/footer.php'; ?>