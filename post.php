<?php
   include("config.php");
   /*
1   ID  int(11)     UNSIGNED
    2   USERNAME varchar(255)
    3   I_Method    tinyint(3)
    4   StudyTime   int(11)
    5   SetTime int(11)
    6   DistractionApps varchar(255)
    7   I_Count int(11)
    8   I_FailCount int(11)
    9   I_SuccessCount  int(11)
    10  GoalCount   int(11)
    11  Timestamp
    $.post("register.php", {"username":"robert","studytime":1231, "settime":123123,"i_count":12,"i_method":123,"i_failcount":12, "i_successcount",123, "goalcount":123, "distractionapps":"Facebook"}, function(data, status){$("body").html(data);});
Object {readyState: 1}
   */

   if($_SERVER["REQUEST_METHOD"] == "POST") {

    if (!isset($_POST['username'])){
        die("Username required");
    }

    $username = mysqli_real_escape_string($db,$_POST['username']);

    $studytime = filter_input(INPUT_POST, 'studytime', FILTER_VALIDATE_INT);
    $settime = filter_input(INPUT_POST, 'settime', FILTER_VALIDATE_INT);

    $i_count = filter_input(INPUT_POST, 'i_count', FILTER_VALIDATE_INT);
    $i_method = filter_input(INPUT_POST, 'i_method', FILTER_VALIDATE_INT);
    $i_failcount = filter_input(INPUT_POST, 'i_failcount', FILTER_VALIDATE_INT);
    $i_successcount = filter_input(INPUT_POST, 'i_successcount', FILTER_VALIDATE_INT);

    $goalcount = filter_input(INPUT_POST, 'goalcount', FILTER_VALIDATE_INT);

    $distractionapps = isset($_POST['distractionapps']) ? mysqli_real_escape_string($db,$_POST['distractionapps']) : "";

    $sql = "INSERT INTO `FocusNUS`.`Focus` (`USERNAME`, `I_Method`, `StudyTime`, `SetTime`, `DistractionApps`, `I_Count`, `I_FailCount`, `I_SuccessCount`, `GoalCount`) VALUES ('$username', '$i_method', '$studytime', '$settime', '$distractionapps', '$i_count', '$i_failcount', '$i_successcount', '$goalcount');";


     $result = mysqli_query($db,$sql);

if (!$result){
	  exit( "Error: " . mysqli_error($db));
}
exit("1");


   }

?>