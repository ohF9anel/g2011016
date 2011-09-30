<?php
// db info (You need to change these to your settings.
// $db = mysql_connect("localhost", "username goes here", "password goes here") or die(mysql_error());
//mysql_select_db("database name goes here", $db) or die(mysql_error());

/** the name of the database */
$db_name = "timeclock";

/** mysql database username */
$db_user = "timeclock";

/** mysql database password */
$db_password = "dbz@a101-ubu01:~/Downloads/timeclock-software$ man apache2";

/** mysql hostname */
$db_host = "localhost";

$db = mysql_connect($db_host, $db_user, $db_password) or die(mysql_error());
mysql_select_db($db_name, $db) or die(mysql_error());

//set how many rows are shown on the user time entry screen 
$time_entry_display_rows = "50";

?>
