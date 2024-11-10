<?php 

include('header.php');
include('dbcon.php'); 
include('Member.php'); 

// Instantiate the dbcon class to create a $db object
$db = new dbcon();
$db->db_connect();  


if (isset($_GET['Id'])) {
    $id = $_GET['Id'];

    // Instantiate the Member class by passing the $db object
    $member = new Member($db);

    // Fetch the member details by ID
    $memberData = $member->getMemberById($id);
    
    if (!$memberData) {
        die("Member not found.");
    }

    // Handle form submission for updating the member
    if (isset($_POST['update_member'])) {
        $f_name = $_POST['firstName'];
        $l_name = $_POST['lastName'];
        $ds = $_POST['dsDivision'];
        $dob = $_POST['dateOfBirth'];
        $summary = $_POST['summary'];

        // Update  information
        if ($member->updateMember($id, $f_name, $l_name, $ds, $dob, $summary)) {
            
            header("Location: Home.php?update_success=true");
            exit();
        } else {
           
            die("Update failed: " . mysqli_error($db->getConnection()));
        }
    }
}
?>

<div class="container mt-5">
    <div class="card">
        <div class="card-header text-center bg-primary text-white">
            <h2>Update Member Information</h2>
        </div>
        <div class="card-body">
            <form id="memberForm" action="update.php?Id=<?php echo $id; ?>" method="post">
                <div class="mb-3">
                    <label for="firstName" class="form-label">First Name</label>
                    <input type="text" class="form-control" id="firstName" name="firstName" value="<?php echo htmlspecialchars($memberData['firstName']); ?>" placeholder="Enter first name" required>
                </div>

                <div class="mb-3">
                    <label for="lastName" class="form-label">Last Name</label>
                    <input type="text" class="form-control" id="lastName" name="lastName" value="<?php echo htmlspecialchars($memberData['lastName']); ?>" placeholder="Enter last name" required>
                </div>

                <div class="mb-3">
                    <label for="dsDivision" class="form-label">DS Division</label>
                    <select class="form-select" id="dsDivision" name="dsDivision" required>
                        <option disabled value="">Choose DS Division</option>
                        <option value="Colombo 1" <?php echo ($memberData['dsDivision'] == 'Colombo 1') ? 'selected' : ''; ?>>Colombo 1</option>
                        <option value="Colombo 2" <?php echo ($memberData['dsDivision'] == 'Colombo 2') ? 'selected' : ''; ?>>Colombo 2</option>
                        <option value="Colombo 3" <?php echo ($memberData['dsDivision'] == 'Colombo 3') ? 'selected' : ''; ?>>Colombo 3</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="dateOfBirth" class="form-label">Date of Birth</label>
                    <input type="date" class="form-control" id="dateOfBirth" name="dateOfBirth" value="<?php echo $memberData['dateOfBirth']; ?>" required>
                </div>

                <div class="mb-3">
                    <label for="summary" class="form-label">Summary</label>
                    <textarea class="form-control" id="summary" rows="3" name="summary" placeholder="Enter summary"><?php echo htmlspecialchars($memberData['summary']); ?></textarea>
                </div>

                <div class="d-flex justify-content-end">
                    <button type="button" class="btn btn-secondary" onclick="window.history.back()">Cancel</button>
                    <input type="submit" class="btn btn-success ms-2" name="update_member" value="Update Member">
                </div>
            </form>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>
