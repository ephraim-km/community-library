<?php

   $title = "View Members";
   require_once "includes/header.php";
   require_once "includes/auth_check.php";
   require_once "db/conn.php";

   $results = $crud->getMembers();

?>

<form class="d-flex" method="GET" action="view.php">
    <input class="form-control me-2" style="width:fit-content;" type="search" placeholder="Member number"
        aria-label="Search" name="id">
    <button class="btn btn-outline-success" type="submit" name="submit">View</button>
</form>

<br>

<table class="table">

    <tr>
        <th>#</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Member Type</th>
        <th>Actions</th>
    </tr>

    <?php while($r = $results->fetch(PDO::FETCH_ASSOC)){ ?>
    <tr>
        <td><?php echo $r['member_id']?></td>
        <td><?php echo $r['firstname']?></td>
        <td><?php echo $r['lastname']?></td>
        <td><?php echo $r['name']?></td>
        <td>
            <a href="view.php?id=<?php echo $r['member_id']?>" class="btn btn-primary space">View</a>
            <a href="edit.php?id=<?php echo $r['member_id']?>" class="btn btn-warning space">Edit</a>
            <a onclick="return confirm('Are you sure you want to remove this member?');"
                href="delete.php?id=<?php echo $r['member_id']?>" class="btn btn-danger space">Delete</a>
        </td>
    </tr>
    <?php } ?>

</table>

<?php require_once "includes/footer.php";?>