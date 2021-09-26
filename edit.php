<?php
   $title = "Edit";
   require_once "includes/header.php";
   require_once "includes/auth_check.php";
   require_once "db/conn.php";
   
   $results = $crud->getMemberType();

   if (!isset($_GET['id'])) {
    
        include 'includes/errormessage.php';
        echo "<h1 class='text-danger'>Did not get the member id!</h1>";
        //header("Location: viewmembers.php");
    
   }
   else{
       $id = $_GET['id'];
       $member = $crud->getMemberDetails($id); 
   
?>

<h1 class="text-center">Edit Record</h1>

<form method="POST" action="editpost.php">

    <input type="hidden" name="id" value="<?php echo $member['member_id']?>">

    <div class="mb-3">
        <label for="firstname" class="form-label">First Name</label>
        <input type="text" class="form-control" value="<?php echo $member['firstname'] ?>" id="firstname"
            name="firstname">
    </div>

    <div class="mb-3">
        <label for="lastname" class="form-label">Last Name</label>
        <input type="text" class="form-control" value="<?php echo $member['lastname'] ?>" id="lastname" name="lastname">
    </div>

    <div class="mb-3">
        <label for="dob" class="form-label">Date of Birth</label>
        <input type="text" class="form-control" value="<?php echo $member['dateofbirth'] ?>" id="dob" name="dob">
    </div>

    <div class="mb-3">
        <label for="applicant" class="form-label">Applicant Type</label>
        <select class="form-select" aria-label="Default select example" name="applicant">
            <?php while($r = $results->fetch(PDO::FETCH_ASSOC)){ ?>
            <option value="<?php echo $r['applicant_type_id']?>"
                <?php if ($r['applicant_type_id'] == $member['applicant_type_id']) echo 'selected'?>>
                <?php echo $r['name']?>
            </option>
            <?php } ?>
        </select>
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">Email address</label>
        <input type="email" class="form-control" value="<?php echo $member['emailaddress'] ?>" id="email"
            aria-describedby="email" name="email">
        <div id="email" class="form-text">We'll never share your email with anyone else.</div>
    </div>

    <div class="mb-3">
        <label for="contact" class="form-label">Contact Number</label>
        <input type="text" class="form-control" value="<?php echo $member['contactnumber'] ?>" id="contact"
            aria-describedby="contact" name="contact">
        <div id="contact" class="form-text">We'll never share your number with anyone else.</div>
    </div>

    <a href="viewmembers.php" class="btn btn-info">Back to List</a>
    <button type="submit" class="btn btn-success btn-block" name="submit">Save Changes</button>

</form>

<?php } ?>

<?php require_once "includes/footer.php";?>