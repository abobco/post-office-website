<?php

    class Report_Helper {

        // ------------ data -------------------------------------------
        public $title;  // string name of the report to be displayed
        public $rows;   // nx2 array of strings to print to the table
        public $printed;
        public $column_labels;

        // ----------- methods -----------------------------------------

        // constructor
        function __construct($_title, $_column_labels) {
            $this->title = $_title;

            $this->column_labels = $_column_labels;
            $this->rows = array();

            $this->printed = false;
        }

        // add a new row to the table
        function add_row($row) {
            array_push($this->rows, $row);
        }

        // output all rows to an html table
        function print_table(){
            // make html doc
            echo "<!DOCTYPE html>";
            echo "<html>";
            echo "<head>";
            echo "<title> $this->title </title>";
            echo "<meta charset='UTF-8'>";
            echo "<link rel='stylesheet' type='text/css' href='../style.css'>";
            echo "</head>";
            echo "<body>";

            // print header
            echo "<div class='header'>";
            echo "<h2>$this->title</h2>";
            echo "</div>";
            echo "<form method='post'>";
            // print table
            echo "<table border = '2', cellpadding='10'>";
            for ( $i = 0; $i < count($this->column_labels); $i++){
                echo "<th>" . $this->column_labels[$i] . "</th>";
            }
            for ( $i = 0; $i < count($this->rows); $i++){
                echo  "<tr>";   // make a new row
                for ( $j = 0; $j < count($this->rows[$i]); $j++){
                    echo "<td>" . $this->rows[$i][$j] . "</td>"; // add a column to the row
                }
                    
                echo  "</tr>";
            }	
            echo "</table>";
            echo "<p> <a href='../index.php' style='color: blue;'>return to home</a> </p>";
            echo "</form>";
            echo "</body>";
            echo "</html>";            
            $this->printed = true;
        }
    }

?>