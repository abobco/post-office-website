<!DOCTYPE html>
<html>
<head>
	<title> TABLE </title>
	<link rel="stylesheet" type="text/css" href="../style.css">
</head>

<body>
	<div class="header">
		<h2>Package Status Report</h2>
	</div>
	<form method="post">
		<div class="input-group">
		<label>Package ID:</label>
			 <input type="text" name="p_id" required><br><br>
		</div>
		<div class="input-group">
			<button type="submit" class="btn" name="update">Check Status</button>
		</div>

		<?php
			include "../util/display_table.php";	
			include "../util/execute_query.php";

			if(isset($_POST['update'])) {	
				$p_id = $_POST['p_id'];	

				$id_check = execute_query("SELECT * FROM package WHERE p_id=$p_id");
				if ( mysqli_num_rows($id_check) > 0  ) {
					// print the table
					$cols = array();
					$colum_titles = execute_query("SHOW COLUMNS FROM package");
					while ( $row = mysqli_fetch_array($colum_titles) ) {
						array_push($cols, $row['Field']);
					}
					display_table("package WHERE p_id='$p_id'", $cols);
				} else {
					echo "Invalid ID";
				}
			}
			

		?>
		<p> <a href='../index.php' style='color: blue;'>return to home</a> </p>
	</form>
	

</body>
</html>
