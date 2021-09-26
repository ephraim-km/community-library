<?php
   $title = "View Member";
   require_once "includes/header.php";
   require_once "includes/auth_check.php";
   require_once "db/conn.php";

   if(!isset($_GET['id'])){

        include 'includes/errormessage.php';
        echo "<h1 class='text-danger'>Did not get the member id!</h1>";
        //header("Location: viewmembers.php");
        
   }
   else{
        $id = $_GET['id'];
        $result = $crud->getMemberDetails($id);
  
?>

<div class="card" style="width: 18rem;">
    <img src="<?php echo empty($result['avatar_path']) ? "uploads/blank.png" : $result['avatar_path']; ?>" alt="avatar">
</div>

<div class="card" style="width: 18rem;">

    <div class="card-body">
        <h5 class="card-title">
            <?php echo $result['firstname'] . ' ' . $result['lastname'];?>
        </h5>
        <h6 class="card-subtitle mb-2 text-muted">
            <?php echo $result['name'];?>
        </h6>
        <p class="card-text">
            Date of Birth: <?php echo $result['dateofbirth'];?>
        </p>
        <p class="card-text">
            Email Address: <?php echo $result['emailaddress'];?>
        </p>
        <p class="card-text">
            Contact Number: <?php echo $result['contactnumber'];?>
        </p>
    </div>

</div>

<br>
<a href="viewmembers.php" class="btn btn-info">Back to List</a>
<a href="edit.php?id=<?php echo $result['member_id']?>" class="btn btn-warning">Edit</a>
<a onclick="return confirm('Are you sure you want to remove this member?');"
    href="delete.php?id=<?php echo $result['member_id']?>" class="btn btn-danger">Delete</a>

<?php } ?>
<?php require_once "includes/footer.php";?>