<?php
if (!isset($_SESSION['userId'])) {
   header("Location: login.php");
}
?>