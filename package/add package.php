<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="header">
		<h2>ADD A NEW PACKAGE</h2>
	</div>

	<form method="post" action="add package.php">

		<?php include('errors.php'); ?>

		<div class="input-group">
			<label>Service</label>
			<input type="text" name="service" value="<?php echo $service; ?>">
		</div>
		<div class="input-group">
			<label>Package Type</label>
			<input type="text" name="pack_type" value="<?php echo $pack_type; ?>">
		</div>
		<div class="input-group">
			<label>Price</label>
			<input type="text" name="price" value="<?php echo $price; ?>">
		</div>
		<div class="input-group">
			<label>Hold Package</label>
			<input type="text" name="hold_package" value="<?php echo $hold_package; ?>">
		</div>
		<div class="input-group">
			<label>Destination</label>
			<input type="text" name="destination" value="<?php echo $destination; ?>">
		</div>
		<div class="input-group">
			<label>Location</label>
			<input type="text" name="location" value="<?php echo $location; ?>">
		</div>
		<div class="input-group">
			<label>Status</label>
			<input type="text" name="status" value="<?php echo $status; ?>">
		</div>
		<div class="input-group">
			<button type="submit" class="btn" name="add_package">Add package</button>
		</div>
	</form>
</body>
</html>
