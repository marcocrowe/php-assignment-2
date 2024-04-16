<?php
//includes
include("CONFIG/connection.php");  //include the database connection 
include("LIBRARY/helperFunctionsTables.php");  //include the database connection 
include("LIBRARY/helperFunctionsDatabase.php");  //include the database connection 
require_once("CONFIG/config.php");  //include the application configuration settings
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

    <head>
	<title>Data Driven Applications 2; Assignment 2</title>
	<link rel="stylesheet" type="text/css" href="<?php echo __CSS; ?>">
	    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    </head>
    <body>
	<!--===================HEADER SECTION===================-->
	<!--====================================================-->

	<header>
	    <h2>Assignment 2 Edit Function</h2>
	    <h3>Mark: K00213234</h3>
	</header>
	<?php

//----------------NAVIGATION SECTION----------------------//
//========================================================//
//include("PAGE_CONTENT/navigation.php");  
//----------------MAIN SECTION----------------------------//
//========================================================//


        ECHO "<H1>" . strtolower("LOWER") ."</H1>";
        ECHO "<H1>" . strtoUPPER("lower") ."</H1>";

	if (PageActionIsEdit())
	{
	    echo "<section class='update'>";
	    LoadRecordToEditControl();
	    echo "</section>";
	}
	if (PageActionIsUpdate())
	{
	    UpdateRecord();
	}
	if (PageActionIsDelete())
	{
	    DeleteARecord();
	}
	echo "<section class='wide'>";
	LoadRecords();
	echo "</section>";
	
	//
	//close the connection
	//
	$conn->close();




//----------------FOOTER section--------------------------//
//========================================================//
//warn DEBUG  mode is on
	if (__DEBUG == 1)
	{
	    echo '<footer class="debug">';
	    echo 'Debug mode is ON<br>';
	    echo "</footer>";
	}
	else
	{
	    echo '<footer class="copyright">';
	    echo 'Copyright 2016 Gerry Guinane';
	    echo "</footer>";
	}
	?>

    </body>
</html>