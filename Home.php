<?php
include('header.php');
require_once('dbcon.php'); 
require_once('Member.php');  

// Create an instance of the dbcon class and connect to the database
$db = new dbcon();
$db->db_connect(); 

// Create an instance of the Member class
$member = new Member($db);

// Get search parameter (if exists)
$search = isset($_GET['search']) ? $_GET['search'] : '';
$members = $member->getAllMembers($search);
?>

<div class="header2">
    <h2>Member List</h2>
</div>
  <div class="container">
  <div class="row">
    <!-- Search Form Section -->
    <div class="col-12 col-md-8 mb-3">
      <div class="input-group">
        <form method="GET" action="Home.php" class="d-flex">
          <input type="search" name="search" class="form-control rounded" placeholder="Search by Last Name" aria-label="Search" aria-describedby="search-addon" />
          <button type="submit" class="btn btn-outline-primary" data-mdb-ripple-init>Search</button>
        </form>
      </div>
    </div>
  
    
    <!-- Add New Member Button Section -->
<div class="col-12 col-md-4 mb-3">
  <button type="button" class="btn btn-info w-auto left-align-button" data-bs-toggle="modal" data-bs-target="#exampleModal">Add New Member</button>
</div>

  </div>

  <!-- table -->

  <div class="table-responsive">
  <table class="table table-hover table-striped">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">First Name</th>
        <th scope="col">Last Name</th>
        <th scope="col">Date of Birth</th>
        <th scope="col">DS Division</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
    <?php
        if ($members->num_rows > 0) {
            while($row = $members->fetch_assoc()) {
        
          $lastNameDisplay = $row['lastName'];
          if (strtoupper($row['summary']) == 'ACCURA' && stripos($row['lastName'], 'ACCURA') === false) {
          $lastNameDisplay .= ' ACCURA';
        }

        ?>

        
              <tr>
                  <td> <?php echo $row['Id']; ?> </td>
                  <td> <?php echo $row['firstName']; ?> </td>
                  <td> <?php echo $lastNameDisplay; ?> </td>
                  <td> <?php echo $row['dateOfBirth']; ?> </td>
                  <td> <?php echo $row['dsDivision']; ?> </td>
                 

                 
                    <td>
                    <div class="d-flex flex-wrap justify-content-start">
        <a href="update.php?Id=<?php echo $row['Id']; ?>" class="btn btn-primary btn-sm me-2 mb-2">Edit</a>
        <button onclick="confirmDelete(<?php echo $row['Id']; ?>)" class="btn btn-danger btn-sm mb-2">Delete</button>
    </div>
                    </td>
                    
              </tr>
              <?php
          }
      } else {
          echo "<tr><td colspan='6'>No members found.</td></tr>";
      }
      ?>
    </tbody>
  </table>
    </div>

  <!-- modal for creating a new member -->
  <form id="memberForm" action="insert_data.php" method="post">
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Add Member</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <!-- Member form fields -->
            <div class="form-group">
              <label for="firstName" class="form-label">First Name</label>
              <input type="text" class="form-control" id="firstName" name="firstName" placeholder="Enter first name" required>
            </div>
            <div class="form-group">
              <label for="lastName" class="form-label">Last Name</label>
              <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Enter last name" required>
            </div>
            <div class="form-group">
              <label for="dsDivision" class="form-label">DS Division</label>
              <select class="form-select" id="dsDivision" name="dsDivision" required>
                <option selected disabled value="">Choose DS Division</option>
                <option value="Colombo 1">Colombo 1</option>
                <option value="Colombo 2">Colombo 2</option>
                <option value="Colombo 3">Colombo 3</option>
              </select>
            </div>
            <div class="form-group">
              <label for="dateOfBirth" class="form-label">Date of Birth</label>
              <input type="date" class="form-control" id="dateOfBirth" name="dateOfBirth" required>
            </div>
            <div class="form-group">
              <label for="summary" class="form-label">Summary</label>
              <textarea class="form-control" id="summary" rows="3" name="summary" placeholder="Enter summary"></textarea>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <input type="submit" class="btn btn-success" name="add_member" value="Add Member">
            <button type="Reset" class="btn btn-danger" form="memberForm">Reset</button>
          </div>
        </div>
      </div>
    </div>
  </form>

  <!-- Success notifications -->
  <?php if (isset($_GET['success']) && $_GET['success'] == 'true'): ?>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var myModal = new bootstrap.Modal(document.getElementById('exampleModal'));
            myModal.hide();
            setTimeout(function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: 'Member added successfully.',
                    showConfirmButton: false,
                    timer: 2000
                });
            }, 500);
        });
    </script>
  <?php endif; ?>

  <!-- Update success notification -->
  <?php if (isset($_GET['update_success']) && $_GET['update_success'] == 'true'): ?>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            Swal.fire({
                icon: 'success',
                title: 'Update Successful!',
                text: 'Member details updated successfully.',
                showConfirmButton: false,
                timer: 2000
            });
        });
    </script>
  <?php endif; ?>

  <!-- Delete success notification -->
  <?php if (isset($_GET['delete_success']) && $_GET['delete_success'] == 'true'): ?>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            Swal.fire({
                icon: 'success',
                title: 'Deleted!',
                text: 'The member has been deleted successfully.',
                showConfirmButton: false,
                timer: 2000
            });
        });
    </script>
  <?php endif; ?>

  <!-- Delete member confirmation -->
  <script>
    function confirmDelete(id) {
        Swal.fire({
            title: "Are you sure?",
            text: "Do you really want to delete this member? This action cannot be undone!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "Cancel"
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "delete.php?Id=" + id + "&confirm=true";
            }
        });
    }
  </script>

</div>

<!-- adding back button -->
<div class="d-grid gap-2 d-md-flex justify-content-md-end p-3">
  <button onclick="window.location.href='home.php';" class="btn btn-dark">Back</button>
</div>
<?php include('footer.php'); ?>
