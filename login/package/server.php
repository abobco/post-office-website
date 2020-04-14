<?php 
	session_start();

	$service = "";
	$pack_type = "";
	$price = "";	
	$hold_package = "";
	$destination = "";
	$location = "";
	$status = "";
	$errors = array(); 

	$db = mysqli_connect('34.69.96.56', 'root', '1234', 'post_office_db');

	if(isset($_POST['add_package'])){
		$service = mysqli_real_escape_string($db, $_POST['service']);
		$pack_type = mysqli_real_escape_string($db, $_POST['pack_type']);
		$price = mysqli_real_escape_string($db, $_POST['price']);		
		$hold_package = mysqli_real_escape_string($db, $_POST['hold_package']);
		$destination = mysqli_real_escape_string($db, $_POST['destination']);
		$location = mysqli_real_escape_string($db, $_POST['location']);
		$status = mysqli_real_escape_string($db, $_POST['status']);

		if (empty($service)) { array_push($errors, "Service type is required"); }
		if (empty($pack_type)) { array_push($errors, "Package type is required"); }
		if (empty($price)) { array_push($errors, "Price is required"); }
		if (empty($hold_package)) { array_push($errors, "Hold package is required"); }
		if (empty($destination)) { array_push($errors, "Destination is required"); }
		if (empty($location)) { array_push($errors, "Location is required"); }
		if (empty($status)) { array_push($errors, "Status is required"); }
	

		if(count($errors) == 0){
			$query = "INSERT INTO package (service, pack_type, price, hold_package, destination, location, package_status)
					VALUES('$service', '$pack_type', '$price', '$hold_package', '$destination', '$location', '$status')";
			
			$result = mysqli_query($db, $query);
			if (!$result) {
				printf($query);
				printf("\nError: %s\n", mysqli_error($db));
				exit();
			}
			else
				header('location: ../index.php');
		}
	}