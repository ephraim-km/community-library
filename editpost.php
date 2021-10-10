<?php

    require_once "db/conn.php";

    if (isset($_POST['submit'])) {
       
        $id = $_POST['id'];
        $fname = $_POST['firstname'];
        $lname = $_POST['lastname'];
        $dob = $_POST['dob'];
        $email = $_POST['email'];
        $contact = $_POST['contact'];
        $applicant_type_id = $_POST['applicant'];

        $member = $crud->getMemberDetails($id);
        $old_file_path = $member['avatar_path'];

        $destination = $old_file_path;
        $target_dir = 'uploads/';
        
        $original_filename = $_FILES["avatar"]["name"];
        $ext = pathinfo($_FILES["avatar"]["name"], PATHINFO_EXTENSION);
        $tmp_filename = $_FILES["avatar"]["tmp_name"];

        if (!empty($original_filename)) {

            //Check whether there is new upload
            //If there is a new upload, check whether the previous path exists in db

            if (is_null($old_file_path)) {
            
                //If there was no previous upload...
                //Set the new destination
                                   
                global $destination;
                $destination = "$target_dir$contact.$ext";
                
            }
            else {
                
                //If there was pervious upload...
                //Check if the old file exists in the upload folder
                
                if (file_exists($old_file_path)) {
    
                    //If the file exists in the upload folder delete it...
                    //And set new destinaion
                    
                    unlink($old_file_path);
                    
                    global $destination;
                    $destination = "$target_dir$contact.$ext";
                    
                }
                else {
                    echo "<h1 class='text-danger'>Could not find file to replace in $old_file_path</h1>";
                }
                
            }
                
        }
        
         //If no new image has been uploaded,the destinatin should remain null

         move_uploaded_file($tmp_filename, $destination);
  
        $isSuccess = $crud->editMember($id, $fname, $lname, $dob, $email, $contact, $applicant_type_id, $destination);
  
        if ($isSuccess) {
            // echo $old_file_path; 
            // echo $original_filename; 
            header("Location: viewmembers.php");        
        }
        else{
            include 'includes/errormessage.php';
        }
        
    }
    else{
        include 'includes/errormessage.php';
        echo "<h1 class='text-danger'>Page was not accessed through form submission!</h1>";
        //header("Location: viewmembers.php");
    }

?>