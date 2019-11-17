<?php
require_once("Includes/db.php");
$logonSuccess = false;


if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $logonSuccess = (Student_listDB::getInstance()->verify_student_credentials($_POST['mail'], $_POST['mailpassword']));
    if ($logonSuccess == true) {
        session_start();
        $_SESSION['mail'] = $_POST['mail'];
        header('Location: editStudentList.php');
        exit;
    }
}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <title>Students list</title>
    </head>
    <body>
        <form action="student_list.php" method="GET" name="student_list">
            Find a student: <input type="text" name="mail" value=""/>
            <input type="submit" value="Search" /><br>
            No account? <a href="create_an_accaunt.php"> Create her!</a>

        </form>
    </body>
    <form name="logon" action="index.php" method="POST" >
    Username: <input type="text" name="mail">
    Password  <input type="password" name="mailpassword">
    <input type="submit" value="Edit My Student List">
</form>
</html>
