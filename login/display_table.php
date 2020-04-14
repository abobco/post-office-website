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
?>