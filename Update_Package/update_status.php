<?php
include("../util/execute_query.php");

// php code to Update data from mysql database Table
if(isset($_POST['update']))
{
	$p_id = $_POST['p_id'];
	$package_status = $_POST['package_status'];

    $result = execute_query("SELECT * FROM package WHERE p_id='$p_id'");

    if ( mysqli_num_rows($result) > 0  ) {
        $row = mysqli_fetch_assoc($result);
        $hold_package = $row["hold_package"];
        if ($hold_package > 0 && strcmp($package_status, "hold for delivery"))
            echo "Invalid status for $hold_package hold days! Try setting status to 'hold for delivery'";
        else {
            $result = execute_query("UPDATE `package` SET `package_status`='".$package_status."' WHERE `p_id` = $p_id");
            header('location: ../index.php');
        }
    } 
    else 
        echo "Invalid ID";   
}

?>

<!DOCTYPE html>

<html>

    <head>

        <title> UPDATE PACKAGE STATUS </title>
        <link rel="stylesheet" type="text/css" href="style.css">

    </head>

    <body>

        <form method="post">

        	Package ID: <input type="text" name="p_id" required><br><br>

        	Current Status: <input type="text" name="package_status" required><br><br>

        	<input type="submit" name="update" value="Update Data">

        </form>

    </body>


</html>


