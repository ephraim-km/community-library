<?php

   $title = "Success";
   require_once "includes/header.php";
   require_once "db//conn.php";
   
   if (isset($_POST['submit'])) {
       
      $fname = $_POST['firstname'];
      $lname = $_POST['lastname'];
      $dob = $_POST['dob'];
      $email = $_POST['email'];
      $contact = $_POST['contact'];
      $applicant_type_id = $_POST['applicant'];
      
      $original_filename = $_FILES["avatar"]["name"];
      $ext = pathinfo($_FILES["avatar"]["name"], PATHINFO_EXTENSION);
      $tmp_filename = $_FILES["avatar"]["tmp_name"];
      
      $target_dir = 'uploads/';
      $destination = "$target_dir$contact.$ext";
      //$destination = $target_dir . basename($_FILES["imageToUpload"]["name"]);
      move_uploaded_file($tmp_filename, $destination);

      $isSuccess = $crud->insertMember($fname, $lname, $dob, $email, $contact, $applicant_type_id, $destination);

      if ($isSuccess) {
          include 'includes/successmessage.php';
                 
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
    <img src="<?php echo $destination?>" alt="avatar">
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

<?php require_once "includes/footer.php";?>