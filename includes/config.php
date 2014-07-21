<?php

    /**
     * config.php - adapted for rstrack.org by Rachael Serur (rachaelse@gmail.com)
     *
     * Computer Science 50
     * Problem Set 7
     *
     * Configures pages.
     */

    // display errors, warnings, and notices
    ini_set("display_errors", true);
    error_reporting(E_ALL);

    // requirements
    require("constants.php");
    require("functions.php");

    // enable sessions
    session_start();

    // require authentication for most pages
    if (!preg_match("{(?:login|logout|documentation|design|register)\.php$}", $_SERVER["PHP_SELF"]))
    {
        if (empty($_SESSION["u_id"]))
        {
            redirect("login.php");
        }
    }

?>
