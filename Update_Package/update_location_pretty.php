<?php
include("../util/execute_query.php");

// php code to Update data from mysql database Table
if(isset($_POST['update']))
{
	$p_id = $_POST['p_id'];
	$location = $_POST['location'];

    $result = execute_query("SELECT * FROM package WHERE p_id='$p_id'");

    if ( mysqli_num_rows($result) > 0  ) {
        $result = execute_query("UPDATE `package` SET `location`='".$location."' WHERE `p_id` = $p_id");
        header('location: ../index.php');
    } 
    else 
        echo "Invalid ID";   
}

?>

<!DOCTYPE html>

<html>

    <head>

        <title> UPDATE LOCATION </title>
        <link rel="stylesheet" type="text/css" href="style.css">

    </head>

    <body>

        <form method="post">

        	Package ID: <input type="text" name="p_id" required><br><br>

        	Current Location: <input type="text" name="location" required><br><br>

        	<input type="submit" name="update" value="Update Data">

        </form>

    </body>


</html>


