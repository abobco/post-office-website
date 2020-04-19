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

    // get the # of each type of customer
    function get_package_count($customer_type) {
        $result = execute_query("SELECT * FROM customer WHERE customer_type='$customer_type'");
        if ($result) {
            $types_of_customers = 0;
            if ( mysqli_num_rows($result) > 0  ) {
                while($row = mysqli_fetch_assoc($result)) {
                    $types_of_customers++;
                }
            }
        }
        return array($customer_type, $types_of_customers);
    }    
    
    // helps print the report to a table
    $customer_report = new Report_Helper("Customer Report", array("customer_type", "Customer"));

    // get an array of unique customer types
    $result = execute_query("SELECT DISTINCT customer_type FROM customer");
    $unique_customers = array();
    if ( mysqli_num_rows($result) > 0  ) {
        while($row = mysqli_fetch_assoc($result)) {
            array_push( $unique_customers, $row["customer_type"] );
        }
    }

    // fill the table
    for ( $i = 0; $i < count($unique_customers); $i++){
        $customer_report->add_row(get_package_count($unique_customers[$i]));
    }

    // print the table
    $customer_report->print_table();
?>

