<?php 
	session_start();

	// variable declaration
	$username = "";
	$password = "";
	$employee_fname = "";
	$employee_lname = "";
	$street_address = "";
	$city = "";
	$state = "";
	$zipcode = "";
	$dept_number = "";
	$errors = array(); 
	$_SESSION['success'] = "";

	// connect to database
	$db = mysqli_connect('34.69.96.56', 'root', '1234', 'post_office_db');

	// REGISTER USER
	if (isset($_POST['reg_user'])) {
		// receive all input values from the form
		$employee_fname = mysqli_real_escape_string($db, $_POST['employee_fname']);
		$employee_lname = mysqli_real_escape_string($db, $_POST['employee_lname']);
		$street_address = mysqli_real_escape_string($db, $_POST['street_address']);
		$city = mysqli_real_escape_string($db, $_POST['city']);
		$state = mysqli_real_escape_string($db, $_POST['state']);
		$zipcode = mysqli_real_escape_string($db, $_POST['zipcode']);	
		$dept_number = mysqli_real_escape_string($db, $_POST['dept_number']);
		$username = mysqli_real_escape_string($db, $_POST['username']);
		$password = mysqli_real_escape_string($db, $_POST['password']);

		// form validation: ensure that the form is correctly filled
		if (empty($employee_fname)) { array_push($errors, "First Name is required"); }
		if (empty($employee_lname)) { array_push($errors, "Last Name is required"); }
		if (empty($street_address)) { array_push($errors, "Street Address is required"); }
		if (empty($city)) { array_push($errors, "City is required"); }
		if (empty($state)) { array_push($errors, "State is required"); }
		if (empty($zipcode)) { array_push($errors, "Zip Code is required"); }
		if (empty($dept_number)) { array_push($errors, "Department Number is required"); }
		if (empty($username)) { array_push($errors, "Username is required"); }
		if (empty($password)) { array_push($errors, "Password is required"); }

		$user_check_query = "SELECT * FROM employee WHERE username='$username' LIMIT 1";
		$result = mysqli_query($db, $user_check_query);
		$user = mysqli_fetch_assoc($result);
		
		if ($user) { // if user exists
		  if ($user['username'] === $username) {
			array_push($errors, "Username already exists");
		  }
		}

		// register user if there are no errors in the form
		if (count($errors) == 0) {
			$password = md5($password);//encrypt the password before saving in the database
			$query = "INSERT INTO employee (employee_fname, employee_lname, 
						street_address, city, state, zipcode, d_id, username, e_password) 
						VALUES('$employee_fname','$employee_lname', '$street_address','$city','$state', 
						'$zipcode', '$dept_number', '$username', '$password')";
			mysqli_query($db, $query);

			$_SESSION['username'] = $username;
			$_SESSION['success'] = "You are now logged in";
			header('location: index.php');
		}
	}

	// ... 

	// LOGIN USER
	if (isset($_POST['login_user'])) {
		$username = mysqli_real_escape_string($db, $_POST['username']);
		$password = mysqli_real_escape_string($db, $_POST['password']);

		if (empty($username)) {
			array_push($errors, "Username is required");
		}
		if (empty($password)) {
			array_push($errors, "Password is required");
		}

		if (count($errors) == 0) {
			$password = md5($password);
			$query = "SELECT * FROM employee WHERE username='$username' AND e_password='$password'";
			$results = mysqli_query($db, $query);

			if (mysqli_num_rows($results) == 1) {
				$_SESSION['username'] = $username;
				$_SESSION['success'] = "You are now logged in";
				header('location: index.php');
			}else {
				array_push($errors, "Wrong username/password combination");
			}
		}
	}

?>