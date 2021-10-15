<?php
// include database connection
include 'server.php';

try {

    // get record ID
    // isset() is a PHP function used to verify if a value is there or not
    $Matric=isset($_GET['Matric']) ? $_GET['Matric'] : die('ERROR: Record ID not found.');

    // delete query
    $query = "DELETE FROM students WHERE Matric = ?";
    $stmt = $con->prepare($query);
    $stmt->bindParam(1, $Matric);

    if($stmt->execute()){
        // redirect to read records page and
        // tell the user record was deleted
        header('Location: display.php?action=deleted');
    }else{
        die('Unable to delete record.');
    }
}

// show error
catch(PDOException $exception){
    die('ERROR: ' . $exception->getMessage());
}
?>
