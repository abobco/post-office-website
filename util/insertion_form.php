<?php
/*
    $table_name: string, name of the table in the db schema
*/
function make_insertion_form( $table_name ) {

    session_start();
    $errors = array();

    // connect to the db
    $db = mysqli_connect('34.69.96.56', 'root', '1234', 'post_office_db');
    // Check connection
    if (!$db) 
        die("Connection failed: " . mysqli_connect_error());

    // get an array of column names
    $column_title_query = "SHOW COLUMNS FROM $table_name ";
    $result = mysqli_query($db, $column_title_query);
    if (!$result) {
        printf("Error: %s\n", mysqli_error($db));
        exit();
    }
    $cols = array();
    while ( $_row = mysqli_fetch_array($result) ) {
        array_push($cols, $_row['Field']);
    }

    // make an associative array for the row
    $row = array();
    for( $i = 0; $i < count($cols); $i++)
        $row[$cols[$i]] = "";

    // when the submit button is pressed
    if (isset($_POST['submit_form'])){

        // get & check input
        foreach ( $row as $label => $value ) {
            $value = mysqli_real_escape_string($db, $_POST[$label]);

            if ( empty($value) )
                array_push($errors, "$label is required");
        }

        // if the form is correct
        if ( count($errors) == 0 ){
            $query = "INSERT INTO $table_name (";

            // prep query
            for ( $i = 0; $i < count($cols); $i++){
                $query = $query . $cols[$i];
                if ( $i < count($cols) - 1)
                    $query = $query . ", ";
            }
            $query = $query . ") VALUES(";
            foreach( $row as $label => $value)
                $query = $query . $value . ", ";
            $query = $query . ")";
            
            // execute query
            mysqli_query($dbm, $query);

            // go back to the main page
            header('location: index.php');
        }

    }

    // make the html form
    echo "<html>";
    echo "<head>";
    echo "<title>$table_name Form</title>";
    echo "<link rel='stylesheet' type='text/css' href='style.css'>";
    echo "</head>";
    echo "<body>";
	echo "<div class='header'>";
	echo "	<h2> Add $table_name</h2>";
	echo " </div>";
    echo "<form method='post'>";
    foreach ( $row as $label => $value ){

        echo "<div class='input-group'>";
        echo "<label>$label</label>";
        echo "<input type='text' name='$label' value='$value'>";
        echo "</div>";
    }
    echo "<div class='input-group'>";
    echo "<button type='submit' class='btn' name='submit_form'>Submit</button>";
    echo "</div>";
    echo "</form>";
    echo "</body>";
    echo "</html>";
}

?>
