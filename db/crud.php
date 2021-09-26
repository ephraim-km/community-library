<?php

class crud{
   private $db;
   
   function __construct($conn){
       $this->db = $conn;
   }
   
   public function insertMember($fname, $lname, $dob, $email, $contact, $applicant_type_id, $avatar_path){
       try {
           $sql = "INSERT INTO members (firstname, lastname, dateofbirth, emailaddress, contactnumber, applicant_type_id, avatar_path) VALUES (:fname, :lname, :dob, :email, :contact, :applicant_type_id, :avatar_path)";
          
           $stmt = $this->db->prepare($sql);
           
           $stmt->bindparam(':fname', $fname);
           $stmt->bindparam(':lname', $lname);
           $stmt->bindparam(':dob', $dob);
           $stmt->bindparam(':email', $email);
           $stmt->bindparam(':contact', $contact);
           $stmt->bindparam(':applicant_type_id', $applicant_type_id);
           $stmt->bindparam(':avatar_path', $avatar_path);

           $stmt->execute();
           return true;
           
       } catch (PDOException $e) {
        echo "<h1 class='text-danger'>Unable to insert data to the database!</h1>";
          echo $e->getMessage();
          return false;
       }
   }
   public function editMember($id, $fname, $lname, $dob, $email, $contact, $applicant_type_id,){
       
        try {

            $sql = "UPDATE `members` SET `firstname`=:fname,`lastname`= :lname,
            `dateofbirth`= :dob,`emailaddress`= :email,`contactnumber`= :contact,`applicant_type_id`=
            :applicant_type_id WHERE member_id = :id";
            
            $stmt = $this->db->prepare($sql);
            $stmt->bindparam(':id', $id);
            $stmt->bindparam(':fname', $fname);
            $stmt->bindparam(':lname', $lname);
            $stmt->bindparam(':dob', $dob);
            $stmt->bindparam(':email', $email);
            $stmt->bindparam(':contact', $contact);
            $stmt->bindparam(':applicant_type_id', $applicant_type_id);

            $stmt->execute();
            return true;
            
        }
        catch (PDOException $e) {
            echo "<h1 class='text-danger'>Unable to edit data in the database!</h1>";
            echo $e->getMessage();
            return false;
        }
        
   }

   public function deleteMember($id){
       try {
           
           $sql = "delete from members where member_id = :id";
           $stmt = $this->db->prepare($sql);
           $stmt->bindparam(':id', $id);
           $stmt->execute();
           return true;
       } catch (PDOException $e) {
        echo "<h1 class='text-danger'>Unable to delete data in the database!</h1>";
        echo $e->getMessage();
        return false;
       }
   }
   
   public function getMembers(){
       try {
           
            $sql = "SELECT * FROM `members` s inner join applicant_type a on a.applicant_type_id = s.applicant_type_id";
            $result = $this->db->query($sql);
            return $result;
        
       } catch (PDOException $e) {
           
        echo "<h1 class='text-danger'>Unable to get members details from the database!</h1>";
            echo $e->getMessage();
            return false;
        
       }
       
   }
   public function getMemberDetails($id){
       try {
           
            $sql = "select * from members s inner join applicant_type a on a.applicant_type_id = s.applicant_type_id where member_id = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindparam(':id', $id);
            $stmt->execute();
            $result = $stmt->fetch();
            return $result;
           
       } catch (PDOException $e) {
           
            echo "<h1 class='text-danger'>Unable to get member details from the database!</h1>";
            echo $e->getMessage();
            return false;
    
       }
       
   }
   public function getMemberType(){
        try {
            $sql = "SELECT * FROM `applicant_type`";
            $result = $this->db->query($sql);
            return $result;
        } catch (PDOException $e) {

            echo "<h1 class='text-danger'>Unable to get members type from the database!</h1>";
            echo $e->getMessage();
            return false;

        }
    
   }
   
}

?>