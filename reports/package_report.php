<?php
    include("report_helper.php");

    // helper fn to do sql queries
    function execute_query($query) {
        // connect to db
        $db = mysqli_connect('34.69.96.56', 'root', '1234', 'post_office_db');	
        // Check connection
        if (!$db) 
            die("Connection failed: " . mysqli_connect_error());

        // do the darn query
        $result = mysqli_query($db, $query);
        // check & print errors
        if (!$result) {
            echo "Error: ". mysqli_error($db) . "<br>";		
            echo "Query: ". $query . "<br>";		
            exit();
        } else 
            return $result;
    }

    // get the # of packages at a loation
    function get_package_count($location) {
        $result = execute_query("SELECT * FROM package WHERE location='$location'");
        if ($result) {
            $packages_at_location = 0;
            if ( mysqli_num_rows($result) > 0  ) {
                while($row = mysqli_fetch_assoc($result)) {
                    $packages_at_location++;
                }
            }
        }
        return array($location, $packages_at_location);
    }    
    
    // helps print the report to a table
    $package_report = new Report_Helper("Package Report", array("Location", "Packages"));

    // get an array of unique package locations
    $result = execute_query("SELECT DISTINCT location FROM package");
    $unique_locations = array();
    if ( mysqli_num_rows($result) > 0  ) {
        while($row = mysqli_fetch_assoc($result)) {
            array_push( $unique_locations, $row["location"] );
        }
    }

    // fill the table
    for ( $i = 0; $i < count($unique_locations); $i++){
        $package_report->add_row(get_package_count($unique_locations[$i]));
    }

    // print the table
    $package_report->print_table();
?>

