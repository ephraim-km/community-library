<?php
   $title = "User Home";
   require_once "includes/header.php";
   require_once "includes/auth_check.php";
   require_once "db/conn.php";

   if(!isset($_SESSION['userId'])){

        include 'includes/errormessage.php';
        echo "<h1 class='text-danger'>Did not get the member id!</h1>";
        //header("Location: viewmembers.php");
        
   }
   else{
        if($_SESSION['username'] == 'admin'){
            
            if (!$_GET['id']) {
        
                include 'includes/errormessage.php';
                echo "<h1 class='text-danger'>Did not get the member id from viewmembers!</h1>";
                
            }
            else{
                $id = $_GET['id'];
            }

        }
        else{
            $id = $_SESSION['userId'];
        }
        $result = $crud->getAllMemberDetails($id);

  
?>

<div class="card_holder">

    <canvas id="library_card_front" width="336px" height="192px"
        style="border: 2px solid #ddd;border-radius: 12px; max-width: 100%;">
    </canvas>

    <canvas id="library_card_back" id="library_card" width="336px" height="192px"
        style="border: 2px solid #ddd;border-radius: 12px; max-width: 100%;">
    </canvas>

</div>

<br>

<button type="button" class="btn btn-primary" id="downloadCardButton">Download</button>

<script type="text/javascript">
const member_id = "<?php echo $id;?>"
const fname = "<?php echo $result['firstname'];?>";
const lname = "<?php echo $result['lastname'];?>"
const member_type = "<?php echo $result['name'];?>"
const avatar_url = "<?php echo !(isset($result['avatar_path'])) ? 'uploads/blank.png' : $result['avatar_path']; ?>"
const member_since = "<?php echo $result['membership_start'];?>"
const expiry_date = "<?php echo $result['membership_end'];?>"
const dateofbirth = "<?php echo $result['dateofbirth'];?>"
const emailaddress = "<?php echo $result['emailaddress'];?>"
const contactnumber = "<?php echo $result['contactnumber'];?>"
</script>

<?php } ?>
<?php require_once "includes/footer.php";?>