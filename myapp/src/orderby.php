<?php
include ('config/db_connect.php');
$safe_value = mysqli_real_escape_string($conn,$_POST['search']);
//$sql='SELECT * FROM EventList';
$sql="SELECT * FROM EventList WHERE Etype LIKE '$safe_value' ";
#echo print_r($sql);
//echo $safe_value;
$result=mysqli_query($conn,$sql);
$donors=mysqli_fetch_all($result,MYSQLI_ASSOC);
mysqli_free_result($result);
mysqli_close($conn);



?>

<!DOCTYPE html>
<html>
<?php include('templates/header.php'); ?>
<h4 class="center peach-text">Events!</h4>
<div class="container">
<div class="row">



<?php foreach($donors as $donor): ?>

<div class="col s6 m4">
    <div class="card z-depth-0">
        <div class="card-content center">

            <div class="black-text"><h5><?php echo htmlspecialchars($donor['Ename']); ?></h5></div>
       
            <ul class="grey-text">
               
                <li><?php echo htmlspecialchars($donor['Etype']); ?></li>
                <li><?php echo htmlspecialchars($donor['Hostname']); ?></li>
        
            </ul>
        </div>
        <div class="card-action right-align">
            <a class="brand-text" href="details.php?id=<?php echo $donor['Eid'] ?>">more info</a>
        </div>
    </div>
</div>

<?php endforeach; ?>



</div>
</div>
<?php include('templates/footer.php'); ?>
</html>