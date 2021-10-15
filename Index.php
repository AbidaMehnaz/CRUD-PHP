<!DOCTYPE HTML>
<html>
<head>
    <title>Student Information System</title>

    <!-- Latest compiled and minified Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />

    <!-- custom css -->
    <style>
    .m-r-1em{ margin-right:1em; }
    .m-b-1em{ margin-bottom:1em; }
    .m-l-1em{ margin-left:1em; }
    .mt0{ margin-top:0; }
    </style>

</head>
<body>

    <!-- container -->
    <div class="container">

        <div class="page-header">
            <h1>View Student Information</h1>
        </div>

        <?php
// include database connection
include 'server.php';

$action = isset($_GET['action']) ? $_GET['action'] : "";

// if it was redirected from delete.php
if($action=='deleted'){
    echo "<div class='alert alert-success'>Record was deleted.</div>";
}


// select all data/

$query = "SELECT Matric, FirstName, LastName, DateOfBirth, Faculty , Department FROM students";
$stmt = $con->prepare($query);
$stmt->execute();




// this is how to get number of rows returned
$num = $stmt->rowCount();

// link to create record form
echo "<a href='create.php' class='btn btn-primary m-b-1em'>Create New Student Record</a>";

//check if more than 0 record found
if($num>0){

  echo "<table class='table table-hover table-responsive table-bordered'>";//start table

  //creating our table heading
  echo "<tr>";
      echo "<th>Matric</th>";
      echo "<th>FirstName</th>";
      echo "<th>LastName</th>";
      echo "<th>DateOfBirth</th>";
      echo "<th>Faculty</th>";
      echo "<th>Department</th>";
      echo "<th>Action</th>";
  echo "</tr>";



  // retrieve our table contents
  // fetch() is faster than fetchAll()
  // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
      // extract row
      // this will make $row['firstname'] to
      // just $firstname only
      extract($row);



      // creating new table row per record
     echo "<tr>";
          echo "<td>{$Matric}</td>";
          echo "<td>{$FirstName}</td>";
          echo "<td>{$LastName}</td>";
          echo "<td>{$DateOfBirth}</td>";
          echo "<td>{$Faculty}</td>";
          echo "<td>{$Department}</td>";
          echo "<td>";


              // we will use this links on next part of this post
              echo "<a href='update.php?Matric={$Matric}' class='btn btn-primary m-r-1em'>Edit</a>";

              // we will use this links on next part of this post
              echo "<a href='#' onclick='delete_user({$Matric});'  class='btn btn-danger'>Delete</a>";
          echo "</td>";
      echo "</tr>";
  }

// end table
echo "</table>";

}

// if no records found
else{
    echo "<div class='alert alert-danger'>No records found.</div>";
}
?>

    </div> <!-- end .container -->

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

<!-- Latest compiled and minified Bootstrap JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script type='text/javascript'>
// confirm record deletion
function delete_user(Matric){

    var answer = confirm('Are you sure?');
    if (answer){
        // if user clicked ok,
        // pass the id to delete.php and execute the delete query
        window.location = 'delete.php?Matric=' + Matric;
    }
}
</script>

</body>
</html>
