<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
      Students details <?php echo htmlentities($_GET["mail"]) . "<br/>";?>
      <?php
      require_once("Includes/db.php");

      $studentID = Student_listDB::getInstance()->get_student_id_by_mail($_GET['mail']);
      if (!$studentID) {
          exit("The person " .$_GET['mail']. " is not found. Please check the spelling and try again" );
      }
      ?>
      <table border="black">
          <tr>
              <th>First name</th>
              <th>Last name</th>
              <th>Gender</th>
              <th>Group number</th>
              <th>mail</th>
              <th>points</th>
              <th>Date of birthd</th>
              <th>Registration</th>
          </tr>
          <?php
          $result = Student_listDB::getInstance()->get_student_list_by_student_id($studentID);
          while ($row = mysqli_fetch_array($result)) {
              echo "<tr><td>" . htmlentities($row['first_name']) . "</td>";
              echo "<td>" . htmlentities($row['last_name']) . "</td>\n";
              echo "<td>" . htmlentities($row['gender']) . "</td>\n";
              echo "<td>" . htmlentities($row['group_number']) . "</td>\n";
              echo "<td>" . htmlentities($row['mail']) . "</td>\n";
              echo "<td>" . htmlentities($row['points']) . "</td>\n";
              echo "<td>" . htmlentities($row['date_of_birth']) . "</td>\n";
              echo "<td>" . htmlentities($row['registration']) . "</td></tr>\n";

          }
          mysqli_free_result($result);
          ?>
    </body>
</html>
