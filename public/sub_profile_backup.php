// view appointments by subject
        else if ($_POST["submit"] == "sub_profile")
        {
        	// save subject selected by user
			$sub_id = $_POST["subject"];	

        	// get subject initials
        	$initials = getSub($sub_id);

        	// create array of rows from appointments table specific to subject
			$sub_appts = query("SELECT * FROM appts WHERE sub_id = ?", $sub_id);    

			// create array for appointment table cells
			$appt_positions = [];

	    	foreach ($sub_appts as $sub_appt)
	    	{
		        $appt_positions[] = [
		            "appt_id" => $sub_appt["appt_id"],
					"initials" => getSub($sub_appt["sub_id"]),
					"comp_id" => getComp($sub_appt["comp_id"]),	
					"timepoint" => getPoint($sub_appt["comp_id"]),		
					"date" => $sub_appt["date"],
					"start_time" => $sub_appt["start_time"],
					"end_time" => $sub_appt["end_time"],
					"staff" => getResource($sub_appt["staff"]), 
					"location" => getResource($sub_appt["location"]), 
					"materials" => getResource($sub_appt["materials"]),
		        ];		
        	}

			//render subject profile
			render("sub_profile.php", ["title" => "Subject Profile", "sub_id" => $sub_id, "initials" => $initials, "appt_positions" => $appt_positions]);
        }

<button type="submit" name="sub_profile" value="<?= $appt_position['sub_id'] ?>" 
                            class="btn btn-info btn-block"><?= $appt_position['sub_id'] ?></button>