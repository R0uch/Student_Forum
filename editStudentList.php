<?php
session_start();
if (array_key_exists("mail", $_SESSION)) {
    echo "Hello " . $_SESSION['mail'];
}
else {
   header('Location: index.php');
   exit;
}
?>
