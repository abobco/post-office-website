<?php

// php code to Update data from mysql database Table

if(isset($_POST['update']))
{
	$db = mysqli_connect('34.69.96.56', 'root', '1234', 'post_office_db');


	$p_id = $_POST['p_id'];
	$location = $_POST['location'];

	$query = "UPDATE `package` SET `location`='".$location."' WHERE `p_id` = $p_id";


   $result = mysqli_query($db, $query);
   
   if($result)
   {
       echo 'Data Updated';
   }else{
       echo 'Data Not Updated';
   }
   mysqli_close($connect);
}

?>

<!DOCTYPE html>

<html>

    <head>

        <title> UPDATE LOCATION </title>

        <meta charset="UTF-8">

        <meta name="viewport" content="width=device-width, initial-scale=1.0">

    </head>

    <body>

        <form action="update_location_two.php" method="post">

        	Package ID: <input type="text" name="p_id" required><br><br>

        	Current Location: <input type="text" name="location" required><br><br>

        	<input type="submit" name="update" value="Update Data">

        </form>

    </body>


</html>


