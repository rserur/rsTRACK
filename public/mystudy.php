<?php

    // configuration
    require("../includes/config.php");    


    // process any form submissions
   if ($_SERVER["REQUEST_METHOD"] == "POST")
    {           
        // rename study
        if ($_POST["submit"] == "rename")
        {
            query("UPDATE users SET study = ? WHERE u_id = ?", $_POST["new_name"], $_SESSION["u_id"]);
        }

        // add timepoint
        else if ($_POST["submit"] == "add_point")
        {          
            query("INSERT INTO timepoints (point_num, point_name, u_id) VALUES (?, ?, ?)", $_POST["new_num"], $_POST["new_timepoint"], $_SESSION["u_id"]);
        }

        // rename timepoint
        else if ($_POST["submit"] == "re_point")
        {
            query("UPDATE timepoints SET point_name = ? WHERE point_num = ? AND u_id = ?", $_POST["repoint_name"], $_POST["repoint_num"], $_SESSION["u_id"]);
        }

        // add component
        else if ($_POST["submit"] == "add_comp")
        {
            query("INSERT INTO components ( point_num, component, u_id) VALUES (?, ?, ?)", $_POST["new_comp_point"], $_POST["new_comp"], $_SESSION["u_id"]);
        }

        // rename component
        else if ($_POST["submit"] == "rename_comp")
        {
            query("UPDATE components SET component = ? WHERE comp_id = ?", $_POST["edit_comp"],  $_POST["component"]);
        }

        // when component deletion requested
        else if ($_POST["submit"] == "del_comp")
        {
            // check that component hasn't been booked in an appt first
            $check = query("SELECT * FROM appts WHERE comp_id = ?", $_POST["component"]);

            // allow deletion if component not booked
            if ($check == false)
            {
                // delete component
                $result = query("DELETE FROM components WHERE comp_id = ?", $_POST["component"]);
            }

            // explain if it has been booked
            else
            {
                apologize("You can't delete a component if it has been booked in an appointment.");
            }
        }
    }

    // create array of rows from timepoints table
    $point_rows = query("SELECT * FROM timepoints WHERE u_id = ? ORDER BY point_num", $_SESSION["u_id"]); 

	// create array for timepoint table cells
	$point_positions = [];

    foreach ($point_rows as $point_row)
    {
        $point_positions[] = [
            "point_num" => $point_row["point_num"],
            "point_name" => $point_row["point_name"],
        ];
	}

    // count timepoints
    $point_count = count($point_positions);        

    // create array of rows from components table
    $comp_rows = query("SELECT * FROM components WHERE u_id = ? ORDER BY point_num", $_SESSION["u_id"]);    

    // create array for timepoint table cells
    $comp_positions = [];

    foreach ($comp_rows as $comp_row)
    {
        $comp_positions[] = [
            "comp_id" => $comp_row["comp_id"],
            "point_num" => $comp_row["point_num"],
            "component" => $comp_row["component"],
        ];
    }   

    // render subjects table
    render("study_form.php", ["title" => "My Study", "point_positions" => $point_positions, "comp_positions" => $comp_positions, "point_count" => $point_count]);

?>
