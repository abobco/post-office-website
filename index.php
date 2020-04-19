<?php 
	session_start(); 

	if (!isset($_SESSION['username'])) {
		$_SESSION['msg'] = "You must log in first";
		header('location: login.php');
	}

	if (isset($_GET['logout'])) {
		session_destroy();
		unset($_SESSION['username']);
		header("location: login.php");
	}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="header">
		<h2>Home</h2>
	</div>
	<div class="content">

		<!-- notification message -->
		<?php if (isset($_SESSION['success'])) : ?>
			<div class="error success" >
				<h3>
					<?php 
						echo $_SESSION['success']; 
						unset($_SESSION['success']);
					?>
				</h3>
			</div>
		<?php endif ?>
		
		<!-- logged in user information -->
		<?php  if (isset($_SESSION['username'])) : ?>
		<p>Welcome <strong><?php echo $_SESSION['username']; ?></strong></p>
		<p> <a href="index.php?logout='1'" style="color: red;">logout</a> </p>	
		<button class ="ins_btn" onclick="window.location.href = 'customer/add_customer.php';">Add Customer</button>
		<button class ="ins_btn" onclick="window.location.href = 'package/add package.php';">Add Package</button>
		<button class ="ins_btn" onclick="window.location.href = 'update_hold_days/update_hold_days.php';">Update package hold days</button>
		<button class ="ins_btn" onclick="window.location.href = 'Update_Package/update_location_pretty.php';">Update package location</button>
		<button class ="ins_btn" onclick="window.location.href = 'Update_Package/update_status.php';">Update package status</button>
		<p> 
			<br>
			<button class ="rep_btn" onclick="window.location.href = 'reports/package_report.php';">Package Report</button> 
			<button class ="rep_btn" onclick="window.location.href = 'reports/report_customer_2.php';">Customer Report</button> 
			<button class ="rep_btn" onclick="window.location.href = 'reports/check_status.php';">Check package status</button> 
			<br>
		</p>
		<br>
		<form method="post"> 
			<button type="submit" class="btn" name="show_employees">show employees</button>
		<?php 		
			include 'display_table.php';

			if (isset($_POST['show_employees'])) {
				// this function needs the SAME names as the db schema for the table and all column titles 
				display_table("employee", array("employee_id","username", "employee_fname", "employee_lname" ));
			}
	
		?>
		<?php endif ?>
		</form> 		
	</div>
		
</body>
</html>