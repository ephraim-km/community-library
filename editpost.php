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
  
        $isSuccess = $crud->editMember($id, $fname, $lname, $dob, $email, $contact, $applicant_type_id);
  
        if ($isSuccess) {
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