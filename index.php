<?php
   $title = "Register";
   require_once "includes/header.php";
   require_once "db/conn.php";

   $results = $crud->getMemberType();
   
?>
<!-- 
     First Name
     Last Name
     Date of Birth
     Applicant type(Student,Teacher,Staff,Other)
     Email Address
     Contact Number
 -->

<h1 class="text-center">Registration for Library Membership</h1>

<form method="POST" action="success.php">

    <div class="mb-3">
        <label for="firstname" class="form-label">First Name</label>
        <input required type="text" class="form-control" id="firstname" name="firstname">
    </div>

    <div class="mb-3">
        <label for="lastname" class="form-label">Last Name</label>
        <input required type="text" class="form-control" id="lastname" name="lastname">
    </div>

    <div class="mb-3">
        <label for="dob" class="form-label">Date of Birth</label>
        <input type="text" class="form-control" id="dob" name="dob" autocomplete="off">
    </div>

    <div class="mb-3">
        <label for="applicant" class="form-label">Applicant Type</label>
        <select class="form-select" aria-label="Default select example" name="applicant">
            <?php while($r = $results->fetch(PDO::FETCH_ASSOC)){ ?>
            <option value="<?php echo $r['applicant_type_id']?>"><?php echo $r['name']?></option>
            <?php } ?>
        </select>
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">Email address</label>
        <input required type="email" class="form-control" id="email" aria-describedby="email" name="email">
        <div id="email" class="form-text">We'll never share your email with anyone else.</div>
    </div>

    <div class="mb-3">
        <label for="contact" class="form-label">Contact Number</label>
        <input type="text" class="form-control" id="contact" aria-describedby="contact" name="contact">
        <div id="contact" class="form-text">We'll never share your number with anyone else.</div>
    </div>

    <button type="submit" class="btn btn-primary btn-block" name="submit">Submit</button>

</form>

<?php require_once "includes/footer.php";?>