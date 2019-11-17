<?php


class Student_listDB extends mysqli {

    private static $instance = null;

    private $user = "root";
    private $pass = "";
    private $dbName = "studentsdb";
    private $dbHost = "localhost";



    public static function getInstance() {
      if (!self::$instance instanceof self) {
        self::$instance = new self;
      }
      return self::$instance;
    }



    public function __clone() {
      trigger_error('Clone is not allowed.', E_USER_ERROR);
    }
    public function __wakeup() {
      trigger_error('Deserializing is not allowed.', E_USER_ERROR);
    }



private function __construct() {
    parent::__construct($this->dbHost, $this->user, $this->pass, $this->dbName);
    if (mysqli_connect_error()) {
        exit('Connect Error (' . mysqli_connect_errno() . ') '
                . mysqli_connect_error());
    }
    parent::set_charset('utf-8');
    }

        public function get_student_id_by_mail($mail) {
            $mail = $this->real_escape_string($mail);
            $student = $this->query("SELECT id FROM students WHERE mail = '"
                            . $mail . "'");
            if ($student->num_rows > 0){
                $row = $student->fetch_row();
                return $row[0];
            } else
                return null;
        }

    public function get_student_list_by_student_id($studentID) {
        return $this->query("SELECT first_name, last_name, gender, group_number, last_name, mail, points, date_of_birth, registration FROM student_list WHERE student_id=" . $studentID);
    }

    public function verify_student_credentials ($mail, $password){
    $mail = $this->real_escape_string($mail);

    $password = $this->real_escape_string($password);
    $result = $this->query("SELECT 1 FROM students
 	           WHERE mail = '" . $mail . "' AND password = '" . $password . "'");
    return $result->data_seek(0);
    }


        public function create_student($mail, $password) {
            $mail = $this->real_escape_string($mail);
            $password = $this->real_escape_string($password);
            $this->query("INSERT INTO students (mail, password) VALUES ('" . $mail
                        . "', '" . $password . "')");
        }
        public function create_student_list($mail, $first_name, $last_name, $gender, $points, $date_of_birth, $registration, $studentID, $group_number) {
            $mail = $this->real_escape_string($mail);
            $first_name = $this->real_escape_string($first_name);
            $last_name = $this->real_escape_string($last_name);
            $gender = $this->real_escape_string($gender);
            $points = $this->real_escape_string($points);
            $date_of_birth = $this->real_escape_string($date_of_birth);
            $registration = $this->real_escape_string($registration);
            $studentID = $this->real_escape_string($studentID);
            $group_number = $this->real_escape_string($group_number);
            $this->query("INSERT INTO student_list (studentID, mail, first_name, last_name, gender, points, date_of_birth, registration, group_number)"." VALUES
(".$studentID.", '".$mail."', '".$first_name."', '".$last_name."', '".$gender."', '".$points."', '".$date_of_birth."', '".$registration."', '".$group_number."')");
        }

    }

 ?>
