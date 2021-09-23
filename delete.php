<?php

require_once 'db/conn.php';

if (!$_GET['id']) {
    
    include 'includes/errormessage.php';
    echo "<h1 class='text-danger'>Did not get the member id!</h1>";
    //header("Location: viewmembers.php");
    
}
else{
    $id = $_GET['id'];

    $result = $crud->deleteMember($id);

    if ($result) {
        header("Location: viewmembers.php");
    }
    else{
        
        include 'includes/errormessage.php';
        
    }
}

?>