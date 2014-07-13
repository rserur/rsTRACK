<?php

    // configuration
    require("../includes/config.php"); 
        
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {   
        // add resources        
        if ($_POST["submit"] == "add")
    	{
    		query("INSERT INTO resources (type, name, u_id) VALUES (?, ?, ?)", $_POST["new_type"], $_POST["new_name"], $_SESSION["u_id"]);
    	}

        else if ($_POST["submit"] == "edit")
        {
             // change both resource type and name if both were entered
            if(!empty($_POST["edit_type"]) and !empty($_POST["edit_name"]))
            {
                query("UPDATE resources SET type = ?, name = ? WHERE resource_id = ?", $_POST["edit_type"], $_POST["edit_name"], $_POST["selection"]);
            }            

            // change resource type if entered alone
            else if(!empty($_POST["edit_type"]))
            {
                query("UPDATE resources SET type = ? WHERE resource_id = ?", $_POST["edit_type"], $_POST["selection"]);
            }

            // change resource name if entered alone
            else if(!empty($_POST["edit_name"]))
            {
                $result = query("UPDATE resources SET name = ? WHERE resource_id = ?", $_POST["edit_name"], $_POST["selection"]);

               // check if resource name change was successful; otherwise notify user
                if ($result === false)
                {
                    apologize("Resource name could not be changed. Do you already have a resource by that name? "); 
                }
            }

            else
            {
                apologize("Please enter new ID and/or new initials to edit the selected subject.");
            }
        }

        // if resource deletion requested
        else if ($_POST["submit"] == "delete")
        {
            // check that resource hasn't been used first
            $check = query("SELECT * FROM appts WHERE ? IN(staff, location, materials)", $_POST["selection"]);

            // allow deletion if resource not used
            if ($check == false)
            {
                // delete resource
                $result = query("DELETE FROM resources WHERE u_id = ? AND resource_id = ?", $_SESSION["u_id"], $_POST["selection"]);
            }

            // explain if it has been used
            else
            {
                apologize("You can't delete a resource if it has been used by an appointment.");
            }
        }
    }

    // create array of rows from resources table
    $rows = query("SELECT * FROM resources WHERE u_id = ? ORDER BY resource_id", $_SESSION["u_id"]);    
    
	// create array for table cells
	$positions = [];

    foreach ($rows as $row)
    {
        $positions[] = [
            "resource_id" => $row["resource_id"],
            "type" => $row["type"],
            "name" => $row["name"],
        ];
	}        

    // render subjects table
    render("resources_form.php", ["title" => "Resource View", "positions" => $positions]);

?>