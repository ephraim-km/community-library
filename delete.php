<?php

    require_once "includes/auth_check.php";
    require_once 'db/conn.php';

    if (!$_GET['id']) {
        
        include 'includes/errormessage.php';
        echo "<h1 class='text-danger'>Did not get the member id!</h1>";
        //header("Location: viewmembers.php");
        
    }
    else{
        $id = $_GET['id'];

        $member = $crud->getMemberDetails($id);
        $old_file_path = $member['avatar_path'];

        if (file_exists($old_file_path)) {
    
            //If the file exists in the upload folder delete it...
            
            unlink($old_file_path);
            
        }

        $result = $crud->deleteMember($id);

        if ($result) {
            header("Location: viewmembers.php");
        }
        else{
            
            include 'includes/errormessage.php';
            
        }
    }

?>