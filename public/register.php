<?php

    // configuration
    require("../includes/config.php");

    // if form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // validate submission
        if (empty($_POST["username"]) || empty($_POST["study"]))
        {
            apologize("All fields are required. Please enter a username and study name.");
        }
            // check both password fields
        else if (empty($_POST["password"]) || empty($_POST["conf_pw"]))
        {
            apologize("You must provide a password typed twice.");
        }
            // check that passwords match
        else if ($_POST["password"] != $_POST["conf_pw"])
        {
            apologize("Passwords do not match exactly. Please try again.");        
        }

        // query database to add user
        $result = query("INSERT INTO users (username, hash, study) VALUES(?, ?, ?)", $_POST["username"], crypt($_POST["password"]), $_POST["study"]);

        // check if user successfully added to database
        if ($result === false)
        {
            apologize("That username already exists. Please try again.");            
        }
        
        // query database for user
        $rows = query("SELECT * FROM users WHERE username = ?", $_POST["username"]);

        // if we user successfully added to database, log in
        if (count($rows) == 1)
        {
            // first (and only) row
            $row = $rows[0];

            // compare hash of user's input against hash that's in database
            if (crypt($_POST["password"], $row["hash"]) == $row["hash"])
            {
                // remember that user's now logged in by storing user's ID in session
                $_SESSION["u_id"] = $row["u_id"];

                // redirect to documentation/how-to page
                redirect("/documentation.php");
            }
        }

    }
    
    else
    {
        // else render form
        render("register_form.php", ["title" => "Register"]);
    }

?>


