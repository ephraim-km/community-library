<?php

class crud{
   private $db;
   
   function __construct($conn){
       $this->db = $conn;
   }
   
   public function insertMember($fname, $lname, $dob, $email, $contact, $applicant_type_id){
       try {
           $sql = "INSERT INTO members (firstname, lastname, dateofbirth, emailaddress, contactnumber,applicant_type_id) VALUES (:fname, :lname, :dob, :email, :contact, :applicant_type_id)";
           
           $stmt = $this->db->prepare($sql);
           
           $stmt->bindparam(':fname', $fname);
           $stmt->bindparam(':lname', $lname);
           $stmt->bindparam(':dob', $dob);
           $stmt->bindparam(':email', $email);
           $stmt->bindparam(':contact', $contact);
           $stmt->bindparam(':applicant_type_id', $applicant_type_id);

           $stmt->execute();
           return true;
           
       } catch (PDOException $e) {
          echo $e->getMessage();
          return false;
       }
   }

   public function getMembers(){
       $sql = "SELECT * FROM `members` s inner join applicant_type a on a.applicant_type_id = s.applicant_type_id";
       $result = $this->db->query($sql);
       return $result;
   }
   public function getMemberType(){
    $sql = "SELECT * FROM `applicant_type`";
    $result = $this->db->query($sql);
    return $result;
}
   
}

?>