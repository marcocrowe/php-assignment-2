<?php

//helper functions

function getTableData($connection, $sql)
{
    try
    {
	$rs = $connection->query($sql);
	return $rs;
    }
    //catch exception
    catch (Exception $e)
    {
	if (__DEBUG == 1)
	{
	    echo 'Message: ' . $e->getMessage();
	    exit('<p class="warning">PHP script terminated');
	}
	else
	{
	    header("Location:" . __USER_ERROR_PAGE);
	}
    }
}

function checkResultSet($rs)
{
    if ($rs === false)
    {
	if (__DEBUG == 1)
	{
	    echo 'Wrong SQL: ' . $sql . ' Error: ' . $conn->error;
	    exit('<p class="warning">PHP script terminated');
	}
	else
	{
	    header("Location:" . __USER_ERROR_PAGE);
	}
    }
    else
    {
	$arr = $rs->fetch_all(MYSQLI_ASSOC);  //put the result into an array
	return $arr;
    }
}

function generateTable($tableName, $titlesResultSet, $dataResultSet)
{
    //use resultsets to generate HTML tables

    echo "<table>";

    //first - create the table caption and headings
    echo "<caption>" . strtoupper($tableName) . " TABLE - QUERY RESULT</caption>";
    echo '<tr>';
    foreach ($titlesResultSet as $fieldName)
    {
	echo '<th>' . $fieldName['Field'] . '</th>';
    }
    echo '</tr>';

    //then show the data
    foreach ($dataResultSet as $row)
    {
	echo '<tr>';
	foreach ($titlesResultSet as $fieldName)
	{
	    echo '<td>' . $row[$fieldName['Field']] . '</td>';
	}
	echo '</tr>';
    }
    echo "</table>";
}

function generateDeleteTable($tableName, $primaryKey, $titlesResultSet, $dataResultSet)
{
    //use resultsets to generate HTML tables
    echo "<div class='table1'>";
    echo "<table>";

    //first - create the table caption and headings
    echo "<caption> Assignment 2 Edit Function for Table </caption>";
    echo '<tr>';
    foreach ($titlesResultSet as $fieldName)
    {
	echo '<th>' . $fieldName['Field'] . '</th>';
    }
    echo '<th>DELETE</th>';
    echo '<th>EDIT</th>';
    echo '</tr>';

    //then show the data
    foreach ($dataResultSet as $row)
    {
	echo '<tr>';
	foreach ($titlesResultSet as $fieldName)
	{
	    echo '<td>' . $row[$fieldName['Field']] . '</td>';
	}
	echo '<td>';
	//set the button values and display the button to the form:
	$id = $row[$primaryKey];  //get the current PK value
	$buttonText = "Delete";
	include 'FORMS/buttonWithText2.html';
	echo '</td>';

	echo '<td>';
	//New Button Entered for editing
	$id = $row[$primaryKey];  //get the current PK value
	$buttonText2 = "Edit";
	include 'FORMS/buttonWithText3.html';
	echo '</td>';
	echo '</tr>';
    }
    echo "</table>";
    echo "<div>";
}

function PerformUpdateAction($id, $firstname, $lastname, $password)
{
    
}

function loadrecord($row)
{
    Global $LectIdColumn, $FirstnameColumn, $LastnameColumn, $PasswordColumn;
    loadrecord1($row[$LectIdColumn], $row[$FirstnameColumn], $row[$LastnameColumn], $row[$PasswordColumn]);
}

function loadrecord1($id, $firstname, $lastname, $password)
{
    Global $UpdateFormButton;
    Global $UpdateFormFirstname, $UpdateFormLastname, $UpdateFormPassword;

    include 'FORMS/Update.html';
}

?>