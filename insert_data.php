
<?php
include('dbcon.php');
include('member.php');

// Instantiate the dbcon class to create a $db object
$db = new dbcon();
$db->db_connect(); 

// Check if form is submitted
if (isset($_POST['add_member'])) {
    
    $f_name = $_POST['firstName'];
    $l_name = $_POST['lastName'];
    $ds = $_POST['dsDivision'];
    $dob = $_POST['dateOfBirth'];
    $summery = $_POST['summary'];

    // Validate the fields
    if (empty($f_name)) {
       
        header('location:Home.php?message=You need to fill First name!');
        exit();
    }

   
    // Instantiate the Member class
    $member = new Member($db);

    // Call the addMember method to insert the new member into the database
    if ($member->addMember($f_name, $l_name, $ds, $dob, $summery)) {
        
        header('location:Home.php?success=true');
    } else {
        
        header('location:Home.php?error=true');
    }
    exit();
}
?>
