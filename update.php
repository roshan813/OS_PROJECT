<?php
include('config/db_connect.php');

$ename=$etype=$hostname=$doe=$description="";
$id_to_update;
$errors = array('ename' => '', 'etype' => '', 'hostname' => '', 'doe' => '', 'description' => '');

if(isset($_GET['update'])){
    $id_to_update = mysqli_real_escape_string($conn, $_GET['id_to_update']);
}

if(isset($_POST['submit'])){
    
  echo print_r($_POST);
        // escape sql chars
        $ename = mysqli_real_escape_string($conn, $_POST['ename']);
        $etype = mysqli_real_escape_string($conn, $_POST['etype']);
        $hostname = mysqli_real_escape_string($conn, $_POST['hostname']);
        $doe = mysqli_real_escape_string($conn, $_POST['doe']);
        $description = mysqli_real_escape_string($conn, $_POST['description']);
        $id_to_update= mysqli_real_escape_string($conn, $_POST['id_to_update']);
    
       
        // create sql
        $sql = "UPDATE EventList SET Ename='$ename',Etype='$etype',DOE='$doe',Hostname='$hostname',Edescription='$description' WHERE Eid= $id_to_update ";
        //$sql = "INSERT INTO EventList(Ename, Etype, Hostname, DOE, Edescription) VALUES('$ename','$etype','$hostname','$doe','$description')";

        // save to db and check
        if(mysqli_query($conn, $sql)){
            // success
            header('Location: index.php');
        } else {
            echo 'query error: '. mysqli_error($conn);
        }
        
    
 

    
}
?>
<!DOCTYPE html>
<html>
<?php include('templates/header.php'); ?>
<section class="container">
  
<h4 class="center grey-text">Update event details</h4>
<form action="update.php" class="white" method="POST" >

<label>Event name</label>
<input type="text" name="ename" value="">
<div class="red-text"><?php echo $errors['ename']; ?></div>

<label>Event type</label>
<input type="text" name="etype" value="">
<div class="red-text"><?php echo $errors['etype']; ?></div>

<label>Event Host name</label>
<input type="text" name="hostname" value="">
<div class="red-text"><?php echo $errors['hostname']; ?></div>

<label>Date</label>
<input type="date" name="doe" value="">
<div class="red-text"><?php echo $errors['doe']; ?></div>

<label>Event Description</label>
<input type="text" name="description" value="">
<div class="red-text"><?php echo $errors['description']; ?></div>

<input type="hidden" name="id_to_update" value="<?php echo $id_to_update; ?>">

<div class="center">
<input type="submit" name="submit" value="Submit" class="btn brand z-depth-0">
</div>

</form>
</section>

</html>