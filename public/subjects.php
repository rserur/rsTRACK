<?php

    // configuration
    require("../includes/config.php"); 

    // process form
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {           
        if ($_POST["submit"] == "add")
    	{
    		// add subject
    		$result =query("INSERT INTO subjects (sub_id, u_id, initials) VALUES (?, ?, ?)", $_POST["new_sub_id"], $_SESSION["u_id"], $_POST["new_initials"]);

            // check if subject successfully added; otherwise notify user
            if ($result === false)
            {
                apologize("Subject could not be added. Subject IDs must be unique and in numerical form only. "); 
        	}
        }

        else if($_POST["submit"] == "edit")
        {
            // change both initials and ID if both were entered
            if(!empty($_POST["initials"]) and !empty($_POST["sub_id"]))
            {
                query("UPDATE subjects SET sub_id = ?, initials = ? WHERE u_id = ? AND sub_id = ?", $_POST["sub_id"], $_POST["initials"], $_SESSION["u_id"], $_POST["selection"]);
            }            

            // change subject ID if entered alone
            else if(!empty($_POST["sub_id"]))
            {
                $result = query("UPDATE subjects SET sub_id = ? WHERE u_id = ? AND sub_id = ?", $_POST["sub_id"], $_SESSION["u_id"], $_POST["selection"]);

                   // check if ID change was successful; otherwise notify user
                if ($result === false)
                {
                    apologize("Subject ID could not be changed. Make sure the ID is unique. "); 
                }
            }

            // change initials if entered alone
            else if(!empty($_POST["initials"]))
            {
                query("UPDATE subjects SET initials = ? WHERE u_id = ? AND sub_id = ?", $_POST["initials"], $_SESSION["u_id"], $_POST["selection"]);
            }

            else
            {
                apologize("Please enter new ID and/or new initials to edit the selected subject.");
            }
        }

        // delete subject
        else if ($_POST["submit"] == "delete")
        {

            // check that subject hasn't had appts
            $check = query("SELECT * FROM appts WHERE ? IN(sub_id)", $_POST["selection"]);

            // allow deletion if subject never booked
            if ($check == false)
            {
                // delete subject
                $result =query("DELETE FROM subjects WHERE u_id = ? AND sub_id = ?", $_SESSION["u_id"], $_POST["selection"]);
            }

            else
            {
                apologize("You can't delete a subject if any appointments have been booked for them. Cancel their appointments first, then try again.");
            }        

        }
    }

    // create array of rows from subjects table
    $rows = query("SELECT * FROM subjects WHERE u_id = ? ORDER BY sub_id", $_SESSION["u_id"]);
    
	// create array for table cells
	$positions = [];

    foreach ($rows as $row)
    {
        $positions[] = [
            "sub_id" => $row["sub_id"],
            "initials" => $row["initials"],

        ];
	}        

    //render subjects table
    render("subjects_form.php", ["title" => "Subject View", "positions" => $positions]);

?>
