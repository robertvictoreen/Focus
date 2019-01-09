 <?php

 if($_SERVER["REQUEST_METHOD"] == "POST") {
if (isset($_POST["username"])&&isset($_POST["password"])){

	if (!ctype_alnum($_POST["username"])){
		exit("Username must be alphanumeric");
	}

	if (!ctype_alnum($_POST["password"])){
		exit("Password must be alphanumeric");
	}


	if ((strlen($_POST["username"]) > 30) || (strlen($_POST["password"]) > 30)){
		  exit("Length exceeded");
	  } else if ((strlen($_POST["username"]) < 6) || (strlen($_POST["password"]) < 6)){
		  exit("Username and password must be at least 6 characters.");
	  }

	include("config.php");

	$user_check = mysqli_real_escape_string($db,filter_var($_POST["username"], FILTER_SANITIZE_STRING));

   $ses_sql = mysqli_query($db,"SELECT * FROM USERS WHERE USERNAME = '$user_check';");

   if (!$ses_sql) {
    die(mysqli_error($db));
} else if (mysqli_num_rows($ses_sql) != 0) die("Username already registered");

	$password = mysqli_real_escape_string($db,filter_var($_POST["password"], FILTER_SANITIZE_STRING));

	$hash = password_hash($password, PASSWORD_DEFAULT);

$sql = "INSERT INTO USERS (USERNAME, PASSWORD) VALUES ('$user_check', '$hash');";

if (mysqli_query($db,$sql)) {
	exit("1");
} else exit(mysqli_error($db));

}
 }

?>