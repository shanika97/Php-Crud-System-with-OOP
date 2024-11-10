

<?php
include('dbcon.php');
class Member {
 
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    // Method to fetch all members or search by last name
    public function getAllMembers($search = '') {
        $query = "SELECT * FROM `member`";

       // If a search string is provided, add a WHERE clause to filter by last name
        if (!empty($search)) {
            $query .= " WHERE `lastName` LIKE ?";
            
            $stmt = $this->db->getConnection()->prepare($query);
            $likeSearch = "%$search%";
            $stmt->bind_param("s", $likeSearch);
        } else {
           
            $stmt = $this->db->getConnection()->prepare($query);
        }

        
        $stmt->execute();
       
        return $stmt->get_result();
    }


    public function addMember($firstName, $lastName, $dsDivision, $dateOfBirth, $summary) {
        // Check if the summary contains 'ACCURA' (case insensitive) and append it to the last name if true
        if (strtoupper($summary) == 'ACCURA' && stripos($lastName, 'ACCURA') === false) {
            $lastName .= ' ACCURA'; 
        }
    
        $query = "INSERT INTO `member` (`firstName`, `lastName`, `dsDivision`, `dateOfBirth`, `summary`) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->db->getConnection()->prepare($query);
        $stmt->bind_param("sssss", $firstName, $lastName, $dsDivision, $dateOfBirth, $summary);
        return $stmt->execute();
    }
    

    // Method to update an existing member's details
    public function updateMember($id, $firstName, $lastName, $dsDivision, $dateOfBirth, $summary) {
        $query = "UPDATE `member` SET `firstName` = ?, `lastName` = ?, `dsDivision` = ?, `dateOfBirth` = ?, `summary` = ? WHERE `Id` = ?";
        $stmt = $this->db->getConnection()->prepare($query);
        $stmt->bind_param("sssssi", $firstName, $lastName, $dsDivision, $dateOfBirth, $summary, $id);
        return $stmt->execute();
    }

    // Method to delete a member by their ID
    public function deleteMember($id) {
      
        $query = "DELETE FROM `member` WHERE `Id` = ?";
        $stmt = $this->db->getConnection()->prepare($query);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    // Method to fetch a member's details by their ID
    public function getMemberById($id) {
    
        $query = "SELECT * FROM `member` WHERE `Id` = ?";
        $stmt = $this->db->getConnection()->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }
}



?> 
