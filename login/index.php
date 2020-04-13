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
		<h2>Home Page</h2>
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
		<?php 		
			// outputs given columns of a table to html
			function display_table($table_name, $columns) {

				// Create connection
				$conn = mysqli_connect('34.69.96.56', 'root', '1234', 'post_office_db');	
				// Check connection
				if (!$conn) 
					die("Connection failed: " . mysqli_connect_error());

				// prepare query
				$num_columns = count($columns);
				$sql = "SELECT ";
				for ($i = 0; $i < $num_columns; $i++ ){
					$sql = $sql . $columns[$i];
					if ( $i < $num_columns - 1)
						$sql = $sql . ", ";
				}
				$sql = $sql . " FROM " . $table_name;
				// execute query
				$result = mysqli_query($conn, $sql);

				// output to the table
				echo "<table border = '2', cellpadding='10'>";
				for ( $i = 0; $i < $num_columns; $i++){
					echo "<th>" . $columns[$i] . "</th>";
				}		
				if ( mysqli_num_rows($result) > 0  ) {
					while($row = mysqli_fetch_assoc($result)) {
						echo "<tr>";
						for ( $i = 0; $i < $num_columns; $i++){
							echo "<td>";
							echo $row[$columns[$i]];
							echo "</td>";			
						}
						echo "</tr>";
					}
				echo "</table>";
				} else {
					echo "0 results";
				}
			
				mysqli_close($conn);
			}

			display_table("employee", array("employee_id","username", "employee_fname", "employee_lname", ));

			// $sql = "SELECT employee_id, employee_fname, employee_lname FROM employee";
			// $result = mysqli_query($conn, $sql);

			// if (mysqli_num_rows($result) > 0) {
			// 	// output data of each row
			// 	while($row = mysqli_fetch_assoc($result)) {
			// 		echo "id: " . $row["employee_id"]. " - Name: " . $row["employee_fname"]. " " . $row["employee_lname"]. "<br>";
			// 	}
			// } else {
			// 	echo "0 results";
			// }

		
		?>
		<?php endif ?>

	</div>
		
</body>
</html>