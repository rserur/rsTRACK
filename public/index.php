<?php

    // configuration
    require("../includes/config.php"); 

	/**
	 *  create resource arrays
	 */

	$resources = query("SELECT * FROM resources WHERE u_id = ?", $_SESSION["u_id"]);

	$staff = [];
	$locations = [];
	$materials = [];

    foreach ($resources as $resource)
    {
    	// staff
        if ($resource["type"] == "staff")
    	{
    		$staff[] = [
    			"resource_id" => $resource["resource_id"],
    			"name" => $resource["name"],
    		];
    	}

    	// locations
    	else if ($resource["type"] == "location")
    	{
    		$locations[] = [
    			"resource_id" => $resource["resource_id"],
    			"name" => $resource["name"],
    		];
    	}

    	// materials
    	else if ($resource["type"] == "materials")
    	{
    		$materials[] = [
    			"resource_id" => $resource["resource_id"],
    			"name" => $resource["name"],
    		];
    	}
	}    

 	/**
	 *  create component arrays
	 */

	$components = query("SELECT * FROM components WHERE u_id = ?", $_SESSION["u_id"]);

	$comps = [];

    foreach ($components as $component)
    {
		$comps[] = [
			"comp_id" => $component["comp_id"],
			"point_num" => $component["point_num"],
			"component" => $component["component"],
			"point_name" => getPoint($component["comp_id"]),
		];    	

	} 

	/**
	 *  create unique subject arrays
	 */
	$uni_subjects = query("SELECT DISTINCT sub_id FROM subjects WHERE u_id = ?", $_SESSION["u_id"]);

	$uni_subs = [];

    foreach ($uni_subjects as $uni_subject)
    {
		$uni_subs[] = [
			"sub_id" => $uni_subject["sub_id"],
			"initials" => getSub($uni_subject["sub_id"]),
		];    	

	}

	/**
	 *  manipulate appointments
	 */

   if ($_SERVER["REQUEST_METHOD"] == "POST")
    {   
    	// book new appointment        
 		if ($_POST["submit"] == "book")
 		{
 			// convert date to mySQL format first
 			$date = date('Y-m-d', strtotime($_POST["book_date"]));

 			// book appt
    		query("INSERT INTO appts (u_id, sub_id, comp_id, date, start_time, end_time, staff, location, materials) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)", 
    			$_SESSION["u_id"], $_POST["book_id"], $_POST["book_comp"], $date, $_POST["book_start"], $_POST["book_end"], $_POST["book_s"], 
    			$_POST["book_l"], $_POST["book_m"]);

    		redirect("index.php");
 		}	

 		// edit existing appointment
 		else if ($_POST["submit"] == "edit")
		{
 			// convert date to mySQL format first
 			$date = date('Y-m-d', strtotime($_POST["edit_date"]));

			// edit appt
			query("UPDATE appts SET sub_id = ?, comp_id = ?, date = ?, start_time = ?, end_time = ?, staff = ?, location = ?, materials = ? 
				WHERE appt_id = ?", $_POST["edit_id"], $_POST["edit_comp"], $date, $_POST["edit_start"], $_POST["edit_end"], $_POST["edit_s"], 
    			$_POST["edit_l"], $_POST["edit_m"], $_POST["appt"]);

			redirect("index.php");
		}

		// cancel existing appointment
 		else if ($_POST["submit"] == "cancel")
		{
			// delete subject
            $result =query("DELETE FROM appts WHERE appt_id = ?", $_POST["appt"]);
		
			redirect("index.php");
		}
    }

	/**
	 *  initial appointment table view & form
	 */

    else 
    {
	    // create array of rows for appointments table
		$appt_rows = query("SELECT * FROM appts WHERE u_id = ? ORDER BY sub_id, appt_id", $_SESSION["u_id"]);    

		// create array for appointment table cells
		$appt_positions = [];

	    foreach ($appt_rows as $appt_row)
	    {
	        $appt_positions[] = [
	            "appt_id" => $appt_row["appt_id"],
				"sub_id" => $appt_row["sub_id"],
				"initials" => getSub($appt_row["sub_id"]),
				"comp_id" => getComp($appt_row["comp_id"]),	
				"timepoint" => getPoint($appt_row["comp_id"]),		
				"date" => date('m/d/Y', strtotime($appt_row["date"])),
				"start_time" => $appt_row["start_time"],
				"end_time" => $appt_row["end_time"],
				"staff" => getResource($appt_row["staff"]), 
				"location" => getResource($appt_row["location"]), 
				"materials" => getResource($appt_row["materials"]),
	        ];
		}            

		//render appointment table
		render("appt_form.php", ["title" => "Appointment", "appt_positions" => $appt_positions, "staff" => $staff, "locations" => $locations, 
			"materials" => $materials, "comps" => $comps, "uni_subs" => $uni_subs]);
	}
?>
