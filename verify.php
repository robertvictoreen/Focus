<?php
   include("config.php");

   if($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["username"])&&isset($_POST["password"])){
      // username and password sent from form

      $myusername = mysqli_real_escape_string($db,$_POST['username']);
      $mypassword = mysqli_real_escape_string($db,$_POST['password']);

	  if (strlen($myusername) >255 && strlen($mypassword) >255 ) {
		  exit("Length exceeded");
	  }

      $sql = "SELECT * FROM USERS WHERE USERNAME = '$myusername';";
      $result = mysqli_query($db,$sql);


     // $active = $row['active'];

      $count = mysqli_num_rows($result);

      // If result matched $myusername and $mypassword, table row must be 1 row

      if($count == 1) {
     //    session_register("myusername");
	 $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
	 if ($mypassword==$row["PASSWORD"] || password_verify($mypassword, $row["PASSWORD"])) {

         //$_SESSION['login_user'] = $myusername;

		 exit("1");
	 }}
    }
    exit("Your Login Name or Password is invalid");
 }
?>