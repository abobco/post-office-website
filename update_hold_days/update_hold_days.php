<?php

include("../util/execute_query.php");

// php code to Update data from mysql database Table
if(isset($_POST['update']))
{
	$p_id = $_POST['p_id'];
	$hold_package = $_POST['hold_package'];

    $result = execute_query("SELECT * FROM package WHERE p_id='$p_id'");

    if ( mysqli_num_rows($result) > 0  ) {

        $row = mysqli_fetch_assoc($result);
        if (strcmp($row["package_status"],"hold for delivery") && $hold_package > 0){
            echo "Invalid status for $hold_package hold days! Try setting status to 'hold for delivery'";
        } else {
            $result = execute_query("UPDATE `package` SET `hold_package`='".$hold_package."' WHERE `p_id` = $p_id");
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

        <title> UPDATE HOLD DAYS </title>
        <link rel="stylesheet" type="text/css" href="style.css">

    </head>

    <body>

        <form action="update_hold_days.php" method="post">

        	Package ID: <input type="text" name="p_id" required><br><br>

        	Number of days Package has been in storage:  <input type="text" name="hold_package" required><br><br>

        	<input type="submit" name="update" value="Update Data">

        </form>

    </body>


</html>


