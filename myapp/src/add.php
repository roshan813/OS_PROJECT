<?php
include('config/db_connect.php');
$ename=$etype=$hostname=$doe=$description="";
$errors = array('ename' => '', 'etype' => '', 'hostname' => '', 'doe' => '', 'description' => '');
if(isset($_POST['submit'])){
    echo print_r($_POST);
    if(empty($_POST['ename'])){
        $errors['ename'] = 'eventname is required';
    } else{
        $ename = $_POST['ename'];
       
        }
    
     if(empty($_POST['etype'])){
            $errors['etype'] = 'eventtype is required';
        } else{
            $etype = $_POST['etype'];
           
            }
  
            if(empty($_POST['hostname'])){
                $errors['hostname'] = 'hostname is required';
            } else{
                $hostname = $_POST['hostname'];
               
                }
              
    if(empty($_POST['doe'])){
        $errors['doe'] = 'date of event is required';
    } else{
        $doe = $_POST['doe'];
       
        }
          
    if(empty($_POST['description'])){
        $errors['description'] = 'description is required';
    } else{
        $description = $_POST['description'];
       
        }
    
    if(array_filter($errors)){
        //echo 'errors in form';
    } else {
        // escape sql chars
        $ename = mysqli_real_escape_string($conn, $_POST['ename']);
        $etype = mysqli_real_escape_string($conn, $_POST['etype']);
        $hostname = mysqli_real_escape_string($conn, $_POST['hostname']);
        $doe = mysqli_real_escape_string($conn, $_POST['doe']);
        $description = mysqli_real_escape_string($conn, $_POST['description']);


        // create sql
        $sql = "INSERT INTO EventList(Ename, Etype, Hostname, DOE, Edescription) VALUES('$ename','$etype','$hostname','$doe','$description')";

        // save to db and check
        if(mysqli_query($conn, $sql)){
            // success
            header('Location: index.php');
        } else {
            echo 'query error: '. mysqli_error($conn);
        }
        
    }
 

    
}
?>
<!DOCTYPE html>
<html>
<?php include('templates/header.php'); ?>
<section class="container">
  
<h4 class="center grey-text">Add event details</h4>
<form action="add.php" class="white" method="POST" >

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

<div class="center">
<input type="submit" name="submit" value="Submit" class="btn brand z-depth-0">
</div>

</form>
</section>

</html>