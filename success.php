<?php

   $title = "Success";
   require_once "includes/header.php";
   require_once "db/conn.php";
   
   if (isset($_POST['submit'])) {
       
      $fname = $_POST['firstname'];
      $lname = $_POST['lastname'];
      $dob = $_POST['dob'];
      $email = $_POST['email'];
      $contact = $_POST['contact'];
      $applicant_type_id = $_POST['applicant'];
      
      $destination = null;
      
      $original_filename = $_FILES["avatar"]["name"];
      $ext = pathinfo($_FILES["avatar"]["name"], PATHINFO_EXTENSION);
      $tmp_filename = $_FILES["avatar"]["tmp_name"];
      
      $target_dir = 'uploads/';
      if (!empty($original_filename)) {
        $destination = "$target_dir$contact.$ext";
      }

      move_uploaded_file($tmp_filename, $destination);

      $isSuccess = $crud->insertMember($fname, $lname, $dob, $email, $contact, $applicant_type_id, $destination);

      if ($isSuccess) {
          
        if (!(isset($_SESSION['username']))) {
 
            $user_login = $userobj->getUserLoginDetails($fname, $lname, $dob, $email, $contact, $applicant_type_id);
            
            $_SESSION['userId'] = $user_login['member_id'];
            $_SESSION['username'] = $user_login['username'];

            include 'includes/successmessage.php';
            
        }
         else{
            include 'includes/successmessage.php';
         }
                 
      }
      else{
          include 'includes/errormessage.php';
      }
      
   }
   else{
       include 'includes/errormessage.php';
       //header("Location: index.php");
   }
   
?>

<div class="card" style="width: 18rem;">

    <img src="<?php echo empty($destination) ? 'uploads/blank.png' : $destination; ?>" alt="avatar">

</div>

<div class="card" style="width: 18rem;">

    <div class="card-body">
        <h5 class="card-title">
            <?php echo $_POST['firstname'] . ' ' . $_POST['lastname'];?>
        </h5>
        <h6 class="card-subtitle mb-2 text-muted">
            <?php echo $_POST['applicant'];?>
        </h6>
        <p class="card-text">
            Date of Birth: <?php echo $_POST['dob'];?>
        </p>
        <p class="card-text">
            Email Address: <?php echo $_POST['email'];?>
        </p>
        <p class="card-text">
            Contact Number: <?php echo $_POST['contact'];?>
        </p>
    </div>

</div>

<br>

<?php if (isset($_SESSION['userId']) && !($_SESSION['username'] == 'admin')) {?>
<a href="card.php?id=<?php echo $_SESSION['userId']?>" class="btn btn-primary">Download Membership Card</a>
<?php } ?>

<?php require_once "includes/footer.php";?>