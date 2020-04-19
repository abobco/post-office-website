<?php 
	session_start();

	// variable declaration
	$customer_fname = "";
	$customer_lname = "";
	$street_address = "";
	$city = "";
	$state = "";
	$zipcode = "";
	$phone = "";
	$email = "";
	$customer_type = "";
	$age = "";
	$errors = array(); 
	$_SESSION['success'] = "";

	// connect to database
	$db = mysqli_connect('34.69.96.56', 'root', '1234', 'post_office_db');

	if (isset($_POST['submit'])) {
		// receive all input values from the form
		$customer_fname = mysqli_real_escape_string($db, $_POST['customer_fname']);
		$customer_lname = mysqli_real_escape_string($db, $_POST['customer_lname']);
		$street_address = mysqli_real_escape_string($db, $_POST['street_address']);
		$city = mysqli_real_escape_string($db, $_POST['city']);
		$state = mysqli_real_escape_string($db, $_POST['state']);
		$zipcode = mysqli_real_escape_string($db, $_POST['zipcode']);
		$phone = mysqli_real_escape_string($db, $_POST['phone']);
		$email = mysqli_real_escape_string($db, $_POST['email']);
		$customer_type = mysqli_real_escape_string($db, $_POST['customer_type']);
		$age = mysqli_real_escape_string($db, $_POST['age']);

		if (empty($customer_fname)) { array_push($errors, "First Name is required"); }
		if (empty($customer_lname)) { array_push($errors, "Last Name is required"); }
		if (empty($street_address)) { array_push($errors, "Street Address is required"); }
		if (empty($city)) { array_push($errors, "City is required"); }
		if (empty($state)) { array_push($errors, "state is required"); }
		if (empty($zipcode)) { array_push($errors, "zipcode is required"); }
		if (empty($phone)) { array_push($errors, "Phone is required"); }
		if (empty($email)) { array_push($errors, "Email is required"); }
		if (empty($customer_type)) { array_push($errors, "Customer Type is required"); }
		if (empty($age)) { array_push($errors, "Age is required"); }
		

		if (count($errors) == 0) {
			$query = "INSERT INTO customer (customer_fname, customer_lname, street_address, city, state, zipcode, phone, email, customer_type, age)
						VALUES('$customer_fname', '$customer_lname', '$street_address','$city', '$state', '$zipcode','$phone', '$email','$customer_type', '$age') ";
			$result = mysqli_query($db, $query);

			// check & print errors
			if (!$result) {
				echo "Error: ". mysqli_error($db) . "<br>";		
				echo "Query: ". $query . "<br>";		
				exit();
			}
			else
				header('location: ../index.php');
		}
	}


?>