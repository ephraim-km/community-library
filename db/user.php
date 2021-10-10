<?php

class user{

    private $db;

    function __construct($conn){

        $this->db = $conn;

    }

    public function insertAdmin($username, $password){
        try {

            $trim_username = strtolower(trim($username));
            
            $result = $this->getNumberAdminSameUsername($trim_username); 

            if ($result['num'] > 0) {
                return false;
            }
            else{
                $new_password = md5($password.$trim_username);
                
                $sql = "INSERT INTO admins (username, password) VALUES (:username, :password)";

                $stmt = $this->db->prepare($sql);

                $stmt->bindparam(':username', $trim_username);
                $stmt->bindparam(':password', $new_password);

                $stmt->execute();
                return true;
            }
            
        } catch (PDOException $e) {
            echo "<h1 class='text-danger'>Unable to insert data to the database!</h1>";
            echo $e->getMessage();
            return false;
        }
    }

    public function insertUser($username, $password){
        //The username will be a combination of firstname and lastname
        //The password will be the email address
        try {
            
            $trim_username = strtolower(trim($username));

            $new_password = md5($password.$trim_username);
                
            $sql = "INSERT INTO users (username, password) VALUES (:username, :password)";

            $stmt = $this->db->prepare($sql);

            $stmt->bindparam(':username', $trim_username);
            $stmt->bindparam(':password', $new_password);

            $stmt->execute();
            
            return true;
            
        } catch (PDOException $e) {
            echo "<h1 class='text-danger'>Unable to insert login details to the database!</h1>";
            echo $e->getMessage();
            return false;
        }
    }

    public function deleteUser($username){
       try {
           
           $sql = "delete from users where username = :username";
           $stmt = $this->db->prepare($sql);
           $stmt->bindparam(':username', $username);
           $stmt->execute();
           return true;
       } catch (PDOException $e) {
        echo "<h1 class='text-danger'>Unable to delete data in the database!</h1>";
        echo $e->getMessage();
        return false;
       }
   }

    public function getAdminId($username, $password){
        try {

            $sql = "select id from admins where username = :username AND password = :password";
            $stmt = $this->db->prepare($sql);
            $stmt->bindparam(':username', $username);
            $stmt->bindparam(':password', $password);
            $stmt->execute();
            $result = $stmt->fetch();
            
            return $result;

        } catch (PDOException $e) {

            echo "<h1 class='text-danger'>Unable to get admin from the database!</h1>";
            echo $e->getMessage();
            return false;

        }

    }
    
    public function getUserId($username, $password){
        try {

            $sql = "select member_id from members A inner join users B on B.username = 
            A.username where B.username = :username AND B.password = :password";
            $stmt = $this->db->prepare($sql);
            $stmt->bindparam(':username', $username);
            $stmt->bindparam(':password', $password);
            $stmt->execute();
            $result = $stmt->fetch();
            
            return $result;

        } catch (PDOException $e) {

            echo "<h1 class='text-danger'>Unable to get user from the database!</h1>";
            echo $e->getMessage();
            return false;

        }

    }

    // public function getUserIdFromUsername($username){
    //     try {

    //         $sql = "select member_id from members where username = :username";
    //         $stmt = $this->db->prepare($sql);
    //         $stmt->bindparam(':username', $username);
    //         $stmt->execute();
    //         $result = $stmt->fetch();
    //         return $result;

    //     } catch (PDOException $e) {

    //         echo "<h1 class='text-danger'>Unable to get user id from the database!</h1>";
    //         echo $e->getMessage();
    //         return false;

    //     }

    // }
    
    public function getNumberAdminSameUsername($username){
        try {

            $sql = "select count(*) as num from admins where username = :username";
            $stmt = $this->db->prepare($sql);
            $stmt->bindparam(':username', $username);
            $stmt->execute();
            $result = $stmt->fetch();
            return $result;

        } catch (PDOException $e) {

            echo "<h1 class='text-danger'>Unable to get user from the database!</h1>";
            echo $e->getMessage();
            return false;

        }

    }
    
    public function generateUsername($username){
        try {
            
            $sql = "SELECT COUNT(*) as user_count FROM users WHERE username like '%".$username."%'";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetch();
            $count = $result['user_count']; 

            if (!empty($count)){
                
                $new_username = $username . $count;
                
            }
            else{
    
                $new_username = $username;
                
            }
            
            return $new_username;

        } catch (PDOException $e) {

            echo "<div class='alert alert-danger' role='alert'>Could not generate username!</div>";
            echo $e->getMessage();
            return false;

        }

    }
    
    public function getUserLoginDetails($fname, $lname, $dob, $email, $contact, $applicant_type_id){
        try {
            
            $sql = "select member_id, username from members where firstname = :firstname and lastname = :lastname and 
            dateofbirth = :dateofbirth and emailaddress = :emailaddress and contactnumber = :contactnumber and applicant_type_id = :applicant_type_id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindparam(':firstname', $fname);
            $stmt->bindparam(':lastname', $lname);
            $stmt->bindparam(':dateofbirth', $dob);
            $stmt->bindparam(':emailaddress', $email);
            $stmt->bindparam(':contactnumber', $contact);
            $stmt->bindparam(':applicant_type_id', $applicant_type_id);
            $stmt->execute();
            $result = $stmt->fetch();
             
            return $result;

        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;

        }

    }

}

?>