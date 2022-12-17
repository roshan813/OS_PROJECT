<?php 

	include('config/db_connect.php');
//handle post request
	if(isset($_POST['delete'])){

		$id_to_delete = mysqli_real_escape_string($conn, $_POST['id_to_delete']);

		$sql = "DELETE FROM EventList WHERE Eid = $id_to_delete";

		if(mysqli_query($conn, $sql)){
			header('Location: index.php');
		} else {
			echo 'query error: '. mysqli_error($conn);
		}

	}
	

	// check GET request id param
	if(isset($_GET['id'])){
		
		// escape sql chars
		$id = mysqli_real_escape_string($conn, $_GET['id']);

		// make sql
		$sql = "SELECT * FROM EventList WHERE Eid = $id";

		// get the query result
		$result = mysqli_query($conn, $sql);

		// fetch result in array format
		$event = mysqli_fetch_assoc($result);

		mysqli_free_result($result);
		mysqli_close($conn);

	}

?>

<!DOCTYPE html>
<html>

	<?php include('templates/header.php'); ?>

	<div class="container center grey-text">
		<?php if($event): ?>
			<h4><?php echo $event['Ename']; ?></h4>
			<p> Event type:<?php echo $event['Etype']; ?></p>
			<p>Host:<?php echo ($event['Hostname']); ?></p>
            <p><?php echo htmlspecialchars($event['DOE']); ?></p>
			<h5>Description:</h5>
			<p><?php echo $event['Edescription']; ?></p>

			<!-- DELETE FORM -->
			<form action="details.php" method="POST">
				<input type="hidden" name="id_to_delete" value="<?php echo $event['Eid']; ?>">
				<input type="submit" name="delete" value="Delete" class="btn brand z-depth-0">
			</form>

			<form action="update.php" method="GET">
				<input type="hidden" name="id_to_update" value="<?php echo $event['Eid']; ?>">
				<input type="submit" name="update" value="Update" class="btn brand z-depth-0">
			</form>

		<?php else: ?>
			<h5>No such event exists.</h5>
		<?php endif ?>
	</div>

	<?php include('templates/footer.php'); ?>

</html>