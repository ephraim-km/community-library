<?php

    //$host = 'localhost';//Production connection(remote database)
    $host = '127.0.0.1';//Development connection(local database)
    
    if ($host == '127.0.0.1') {
        
        $db = 'library_membership';
        $user = 'root';
        $pass = '';
        
    }
    else{

        $db = 'id17648449_library_membership';
        $user = 'id17648449_ephraim';
        $pass = 'Bhk6Pcd-gLdzW5nv';
        
    } 
       
    $charset = 'utf8mb4';
    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";

    try {
        
        $pdo = new PDO($dsn, $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //echo "Connected to Database";
        
    } catch (PDOException $e) {
        
        echo "<h1 class='text-danger'>Unable to connect to the database!</h1>";
        throw new PDOException($e->getMessage());
        
    }

    require_once "crud.php";
    require_once "user.php";

    $crud = new crud($pdo);
    $userobj = new user($pdo);

    $userobj->insertAdmin("Admin","password");

?>