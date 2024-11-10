<?php
include('dbcon.php');
include('Member.php');


// Instantiate the dbcon class to create a $db object
$db = new dbcon();
$db->db_connect();  


// Check if 'Id' is provided in the URL
if (isset($_GET['Id'])) {
    $id = $_GET['Id'];

    $member = new Member($db);

    // Call the deleteMember method of the Member class to delete the record
    if ($member->deleteMember($id)) {
       
        header("Location: Home.php?delete_success=true");
        exit();
    } else {
      
        die("Delete failed: " . mysqli_error($db->connection));
    }
}
?>
