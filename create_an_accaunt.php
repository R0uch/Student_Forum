<?php
require_once("Includes/db.php");


$mailIsUnique = true;
$passwordIsValid = true;
$mailIsEmpty = false;
$passwordIsEmpty = false;
$password2IsEmpty = false;


if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if ($_POST['mail'] == "") {
        $mailIsEmpty = true;
    }




  //  $studentID = Student_listDB::getInstance()->get_student_id_by_mail($_POST['mail']);
    if ($studentID) {
        $mailIsUnique = false;
    }


    if ($_POST['password'] == "")
        $passwordIsEmpty = true;
    if ($_POST['password2'] == "")
        $password2IsEmpty = true;
    if ($_POST['password'] != $_POST['password2']) {
        $passwordIsValid = false;
    }





    if (!$mailIsEmpty && $mailIsUnique && !$passwordIsEmpty && !$password2IsEmpty && $passwordIsValid) {
        Student_listDB::getInstance()->create_student($_POST['mail'], $_POST['password']);
        Student_listDB::getInstance()->create_student_list($_POST['mail'],$_POST['first_name'],$_POST['last_name'],$_POST['gender'],$_POST['points'],$_POST['date_of_birth'],$_POST['registration'],$_POST['studentID'],$_POST['group_number']);
        session_start();
        $_SESSION['mail'] = $_POST['mail'];
        header('Location: editStudentList.php' );
        exit;
    }
}
 ?>

<!DOCTYPE html>
<html>
    <head><meta charset="UTF-8"></head>
    <body>
        Welcome!<br>
        <form action="create_an_accaunt.php" method="POST">
            Your mail: <input type="text" name="mail"/><br/>

            <?php
            if ($mailIsEmpty) {
                echo ("Enter your mail, please!");
                echo ("<br/>");
            }
            if (!$mailIsUnique) {
                echo ("The mail already exists. Please check the spelling and try again");
                echo ("<br/>");
            }
            ?>
            Password: <input type="password" name="password"/><br/>

            <?php
            if ($passwordIsEmpty) {
                 echo ("Enter the password, please!");
                 echo ("<br/>");
            }
            ?>
            Please confirm your password: <input type="password" name="password2"/><br/>
            <?php
            if ($password2IsEmpty) {
               echo ("Confirm your password, please");
               echo ("<br/>");
            }
            if (!$password2IsEmpty && !$passwordIsValid) {
               echo  ("The passwords do not match!");
               echo ("<br/>");
            }
           ?>
           Your First Name: <input type="text" name="first_name"/><br/>
           Your Last Name: <input type="text" name="last_name"/><br/>
           Your Gender: <input type="text" name="gender"/><br/>
           Your Points: <input type="text" name="points"/><br/>
           Your Date of birth: <input type="text" name="date_of_birth"/><br/>
           Your Registration: <input type="text" name="registration"/><br/>
           Your Student Id: <input type="text" name="studentID"/><br/>
           Your Group Number: <input type="text" name="group_number"/><br/>
            <input type="submit" value="Register"/>
        </form>

    </body>
</html>
