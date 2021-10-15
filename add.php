<?php  include('server.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Student Registration Form</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <?php if (isset($_SESSION['message'])): ?>
	<div class="msg">
		<?php
			echo $_SESSION['message'];
			unset($_SESSION['message']);
		?>
	</div>
<?php endif ?>
  <h1> Registration Form </h1>

	<form method="post" action="server.php" >
		<div class="input-group">
			<label>Matric </label>
			<input type="text" name="matric" value="">
		</div>
		<div class="input-group">
			<label>First Name  </label>
			<input type="text" name="fname" value="">
		</div>
    <div class="input-group">
			<label>Last Name  </label>
			<input type="text" name="lname" value="">
		</div>
    <div class="input-group">
			<label>DateOfBirth  </label>
			<input type="text" name="dob" value="">
		</div>
    <div class="input-group">
			<label>Faculty Name  </label>
			<input type="text" name="faculty" value="">
		</div>
    <div class="input-group">
			<label>Department Name  </label>
			<input type="text" name="department" value="">
		</div>
		<div class="input-group">
			<button class="btn" type="submit" name="save"> Save </button>
			<button class = "btn "> <a href="Index.php"> Display Registered Students</a></button>
		</div>
	</form>

</body>
</html>
