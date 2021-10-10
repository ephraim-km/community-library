<?php

class crud{
   private $db;
   
   function __construct($conn){
       $this->db = $conn;
   }
   
   public function insertMember($fname, $lname, $dob, $email, $contact, $applicant_type_id, $avatar_path){

        $userobj = new user($this->db);

        $combined_username   = $fname.$lname;
        $trim_username = strtolower(trim($combined_username));
        $new_username = $userobj->generateUsername($trim_username);

        $userinserted = $userobj->insertUser($new_username, $email);

        if ($userinserted) {
            
            //If the login details of the users have been inserted,go ahead and insert the member

            try {



                $sql = "INSERT INTO members (firstname, lastname, dateofbirth, emailaddress, contactnumber, applicant_type_id, avatar_path, username, membership_start, membership_end) VALUES (:fname, :lname, :dob, :email, :contact, :applicant_type_id, :avatar_path, :username, :membership_start, :membership_end)";

                $stmt = $this->db->prepare($sql);

                $stmt->bindparam(':fname', $fname);
                $stmt->bindparam(':lname', $lname);
                $stmt->bindparam(':dob', $dob);
                $stmt->bindparam(':email', $email);
                $stmt->bindparam(':contact', $contact);
                $stmt->bindparam(':applicant_type_id', $applicant_type_id);
                $stmt->bindparam(':avatar_path', $avatar_path);
                $stmt->bindparam(':username', $new_username);
                
                $membership_start = date("Y-m-d");
                $stmt->bindparam(':membership_start', $membership_start);
                
                $membership_end = date('Y-m-d', strtotime($membership_start. ' + 365 days'));
                $stmt->bindparam(':membership_end', $membership_end);

                $stmt->execute();

                return true;

                } catch (PDOException $e) {
                    echo "<h1 class='text-danger'>Unable to insert member to the database!</h1>";
                    echo $e->getMessage();
                    return false;
                }

        }
        else{
            echo "<h1 class='text-danger'>Could not insert member login details!</h1>";
        }

       
   }
   public function editMember($id, $fname, $lname, $dob, $email, $contact, $applicant_type_id, $avatar_path){
       
        try {

            $sql = "UPDATE `members` SET `firstname`=:fname,`lastname`= :lname,
            `dateofbirth`= :dob,`emailaddress`= :email,`contactnumber`= :contact,`applicant_type_id`=
            :applicant_type_id, `avatar_path`= :avatar_path WHERE member_id = :id";
            
            $stmt = $this->db->prepare($sql);
            $stmt->bindparam(':id', $id);
            $stmt->bindparam(':fname', $fname);
            $stmt->bindparam(':lname', $lname);
            $stmt->bindparam(':dob', $dob);
            $stmt->bindparam(':email', $email);
            $stmt->bindparam(':contact', $contact);
            $stmt->bindparam(':applicant_type_id', $applicant_type_id);
            $stmt->bindparam(':avatar_path', $avatar_path);

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
           
           $username = $this->getMemberDetails($id)['username'];
           
           $sql = "delete from members where member_id = :id";
           $stmt = $this->db->prepare($sql);
           $stmt->bindparam(':id', $id);
           $stmt->execute();
           
           $userobj = new user($this->db);
           $userobj->deleteUser($username);
           
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
   public function getAllMemberDetails($id){
       try {
           
            $sql = "select member_id, firstname, lastname, dateofbirth, emailaddress, contactnumber, 
            A.applicant_type_id, name, avatar_path, A.username, membership_start, membership_end from members A inner join applicant_type B 
            on B.applicant_type_id = A.applicant_type_id 
            inner join users C on C.username = A.username where member_id = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindparam(':id', $id);
            $stmt->execute();
            $result = $stmt->fetch();
            return $result;
           
       } catch (PDOException $e) {
           
            echo "<h1 class='text-danger'>Unable to get all member details from the database!</h1>";
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