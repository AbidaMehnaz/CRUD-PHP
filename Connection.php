<?php
// used to connect to the database
$servername = "localhost";
      $username = "root";
      $password = "1234";
      $conn = mysql_connect ($servername , $username , $password) or die("unable to connect to host");
      $sql = mysql_select_db ('test',$conn) or die("unable to connect to database");

	// initialize variables
	$matric = "";
	$fname = "";
	$lname = "";
	$dob = "";
  $faculty = "";
  $department = "";

	if (isset($_POST['save'])) {
		$matric = $_POST['matric'];
		$fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $dob = $_POST['dob'];
    $faculty = $_POST['faculty'];
    $department = $_POST['department'];

		mysqli_query($db, "INSERT INTO students (Matric, FirstName, LastName , DateOfBirth, Faculty, Department) VALUES ('$matric', '$fname','$lname', '$dob','$faculty', '$department')");
		$_SESSION['message'] = "Input saved";
		header('location: index.php');
	}




  ?>
