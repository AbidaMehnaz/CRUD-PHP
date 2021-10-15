<!DOCTYPE HTML>
<html>
<head>
    <title>Student Information System</title>

    <!-- Latest compiled and minified Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />

</head>
<body>

    <!-- container -->
    <div class="container">

        <div class="page-header">
            <h1>Edit Student Information </h1>
        </div>

				<?php
// get passed parameter value, in this case, the record ID
// isset() is a PHP function used to verify if a value is there or not
$Matric=isset($_GET['Matric']) ? $_GET['Matric'] : die('ERROR: Record ID not found.');

//include database connection
include 'server.php';

// read current record's data
try {
    // prepare select query
    $query = "SELECT  Matric, FirstName, LastName ,DateOfBirth, Faculty , Department FROM students WHERE Matric = ? ";
    $stmt = $con->prepare( $query );

    // this is the first question mark
    $stmt->bindParam(1, $Matric);

    // execute our query
    $stmt->execute();

    // store retrieved row to a variable
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    // values to fill up our form

    $fname = $row['FirstName'];
    $lname = $row['LastName'];
		$dob = $row['DateOfBirth'];
		$faculty = $row['Faculty'];
		$department = $row['Department'];
}

// show error
catch(PDOException $exception){
    die('ERROR: ' . $exception->getMessage());
}
?>


<?php

// check if form was submitted
if($_POST){

    try{

        // write update query
        // in this case, it seemed like we have so many fields to pass and
        // it is better to label them and not use question marks
        $query = "UPDATE students
                    SET Matric=:Matric, FirstName=:fname, LastName=:lname, DateOfBirth=:dob , Faculty=:faculty , Department=:department
                    WHERE Matric = :Matric";

        // prepare query for excecution
        $stmt = $con->prepare($query);

        // posted values

				$fname=htmlspecialchars(strip_tags($_POST['fname']));
				$lname=htmlspecialchars(strip_tags($_POST['lname']));
				$dob=htmlspecialchars(strip_tags($_POST['dob']));
				$faculty=htmlspecialchars(strip_tags($_POST['faculty']));
				$department=htmlspecialchars(strip_tags($_POST['department']));

        // bind the parameters

				$stmt->bindParam(':fname', $fname);
				$stmt->bindParam(':lname', $lname);
				$stmt->bindParam(':dob', $dob);
				$stmt->bindParam(':faculty', $faculty);
				$stmt->bindParam(':department', $department);
        $stmt->bindParam(':Matric', $Matric);

        // Execute the query
        if($stmt->execute()){
            echo "<div class='alert alert-success'>Record was updated.</div>";
        }else{
            echo "<div class='alert alert-danger'>Unable to update record. Please try again.</div>";
        }

    }

    // show errors
    catch(PDOException $exception){
        die('ERROR: ' . $exception->getMessage());
    }
}
?>



<!--we have our html form here where new record information can be updated-->
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?Matric={$Matric}");?>" method="post">
    <table class='table table-hover table-responsive table-bordered'>


            <td>FirstName</td>
            <td><input type='text' name='fname' value="<?php echo htmlspecialchars($fname, ENT_QUOTES);  ?>" class='form-control' /></td>
        </tr>
        <tr>
            <td>Last Name</td>
            <td><textarea name='lname' class='form-control'><?php echo htmlspecialchars($lname, ENT_QUOTES);  ?></textarea></td>
        </tr>
        <tr>
            <td>Date Of Birth</td>
            <td><input type='text' name='dob' value="<?php echo htmlspecialchars($dob, ENT_QUOTES);  ?>" class='form-control' /></td>
        </tr>
				<tr>
						<td>Faculty</td>
						<td><input type='text' name='faculty' value="<?php echo htmlspecialchars($faculty, ENT_QUOTES);  ?>" class='form-control' /></td>
				</tr>

				<tr>
					 <td>Department</td>
					 <td><input type='text' name='department' value="<?php echo htmlspecialchars($department, ENT_QUOTES);  ?>" class='form-control' /></td>
			 </tr>

        <tr
            <td></td>
            <td>
                <input type='submit' value='Save Changes' class='btn btn-primary' />
                <a href='index.php' class='btn btn-danger'>Back to Student Record</a>
            </td>
        </tr>
    </table>
</form>




    </div> <!-- end .container -->

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

<!-- Latest compiled and minified Bootstrap JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</body>
</html>
