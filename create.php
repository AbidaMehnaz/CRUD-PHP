<!DOCTYPE HTML>
<html>
<head>
    <title>Student Information System</title>

    <!-- Latest compiled and minified Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />

</head>
<body>


    <div class="container">

        <div class="page-header">
            <h1>Create student record</h1>
        </div>

				<?php
	if($_POST){

	    // include database connection
	    include 'server.php';

	    try{

	        // insert query
	        $query = "INSERT INTO students SET Matric=:Matric, FirstName=:fname, LastName=:lname, DateOfBirth=:dob , Faculty=:faculty , Department=:department ";

	        // prepare query for execution
	        $stmt = $con->prepare($query);

	        // posted values
	        $Matric=htmlspecialchars(strip_tags($_POST['Matric']));
	        $fname=htmlspecialchars(strip_tags($_POST['fname']));
	        $lname=htmlspecialchars(strip_tags($_POST['lname']));
					$dob=htmlspecialchars(strip_tags($_POST['dob']));
					$faculty=htmlspecialchars(strip_tags($_POST['faculty']));
					$department=htmlspecialchars(strip_tags($_POST['department']));



	        $stmt->bindParam(':Matric', $Matric);
	        $stmt->bindParam(':fname', $fname);
	        $stmt->bindParam(':lname', $lname);
					$stmt->bindParam(':dob', $dob);
					$stmt->bindParam(':faculty', $faculty);
					$stmt->bindParam(':department', $department);


	        $created=date('Y-m-d H:i:s');



	        if($stmt->execute()){
	            echo "<div class='alert alert-success'>Record was saved.</div>";
	        }else{
	            echo "<div class='alert alert-danger'>Unable to save record.</div>";
	        }

	    }


	    catch(PDOException $exception){
	        die('ERROR: ' . $exception->getMessage());
	    }
	}
	?>


		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
		    <table class='table table-hover table-responsive table-bordered'>
		        <tr>
		            <td>Matric</td>
		            <td><input type='text' name='Matric' class='form-control' /></td>
		        </tr>
		        <tr>
		            <td>FirstName</td>
		            <td><input type = 'text' name='fname' class='form-control'/></td>
		        </tr>
		        <tr>
		            <td>LastName</td>
		            <td><input type='text' name='lname' class='form-control' /></td>
		        </tr>
						<tr>
								<td>DateOfBirth</td>
								<td><input type='text' name='dob' class='form-control' /></td>
						</tr>
						<tr>
								<td>Faculty</td>
								<td><input type='text' name='faculty' class='form-control' /></td>
						</tr>
						<tr>
								<td>Department</td>
								<td><input type='text' name='department' class='form-control' /></td>
						</tr>
		        <tr>
		            <td></td>
		            <td>
		                <input type='submit' value='Save' class='btn btn-primary' />
		                <a href='index.php' class='btn btn-danger'>Back to Student</a>
		            </td>
		        </tr>
		    </table>
		</form>

    </div>

<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>


<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>



</body>
</html>
