<?php

//helper functions for database interaction

function queryUpdate($connection, $sql)
{
    try
    {
	echo $sql . "<br>";
	if ($connection->query($sql) === TRUE)  //execute the insert sql
	{
	    return 1;  //if successful
	}
	else
	{
	    return 0;  //if not successful
	}
    }
    //catch exception
    catch (Exception $e)
    {
	echo 'Message: ' . $e->getMessage();

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

function queryInsert($connection, $sql)
{
    try
    {
	if ($connection->query($sql) === TRUE)  //execute the insert sql
	{
	    return 1;  //if successful
	}
	else
	{
	    return 0;  //if not successful
	}
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

function deleteRecord($connection, $sql)  //identical to above so we dont really need it
{
    try
    {
	if ($connection->query($sql) === TRUE)  //execute the sql
	{
	    return 1;  //if successful
	}
	else
	{
	    return 0;  //if not successful
	}
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

function query($connection, $sql)
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

$table = "lecturer";
$LectIdColumn = "LectID";
$FirstnameColumn = "FirstName";
$LastnameColumn = "LastName";
$PasswordColumn = "password";
$PK = $LectIdColumn;

$DeleteFormButton = "delrecord";
$EditFormButton = "editrecord";

$UpdateFormButton = "UpdateFormButton";
$UpdateFormFirstname = $FirstnameColumn;
$UpdateFormLastname = $LastnameColumn;
$UpdateFormPassword = $PasswordColumn;

function PageActionIsEdit()
{
    Global $EditFormButton;

    return isset($_POST[$EditFormButton]);
}

function PageActionIsDelete()
{
    Global $DeleteFormButton;

    return isset($_POST[$DeleteFormButton]);
}

function PageActionIsUpdate()
{
    Global $UpdateFormButton;
    return isset($_POST[$UpdateFormButton]);
}

function LoadRecordToEditControl()
{
    Global $conn, $EditFormButton, $PK, $table;
    Global $LectIdColumn, $FirstnameColumn, $LastnameColumn, $PasswordColumn;

    $id = $_POST[$EditFormButton];
    $id = $conn->real_escape_string($id);

    $sql = "SELECT * FROM $table WHERE $PK='$id'";

    $rsData = getTableData($conn, $sql);
    
    echo "<h1>" . typeof($rsData) . "</h1>" ;
    
    $row = $rsData->fetch_assoc();
    //
    //  Print Control into Page
    //
    loadrecord($row);
}

function DeleteARecord()
{
    Global $conn, $DeleteFormButton, $PK, $table;

    $id = $_POST[$DeleteFormButton];
    $id = $conn->real_escape_string($id);

    $sql = "DELETE FROM $table WHERE $PK='$id'";  //create the SQL

    echo $sql . "<br>"; //SQL Debugging!
    if (deleteRecord($conn, $sql))
    {
	echo "<h3>RECORD WITH PK=$id DELETED</h3>";
    }
    else
    {
	echo "<h3 >RECORD WITH PK=$id CANNOT BE DELETED</h3>";
    }
}

function UpdateRecord()
{
    Global $conn, $table;
    Global $UpdateFormButton, $UpdateFormFirstname, $UpdateFormLastname, $UpdateFormPassword;
    Global $FirstnameColumn, $LastnameColumn, $PasswordColumn, $PK;


    $id = $_POST[$UpdateFormButton];
    $firstname = $_POST[$UpdateFormFirstname];
    $lastname = $_POST[$UpdateFormLastname];
    $password = $_POST[$UpdateFormPassword];

    $id = $conn->real_escape_string($id);
    $firstname = $conn->real_escape_string($firstname);
    $lastname = $conn->real_escape_string($lastname);
    $password = $conn->real_escape_string($password);

    $sql = "UPDATE $table SET"
	    . " " . " $FirstnameColumn = '$firstname'"
	    . "," . " $LastnameColumn = '$lastname'"
	    . "," . " $PasswordColumn = '$password'"
	    . " WHERE $PK = '$id'";
    // echo $sql . "<br>"; //SQL Debugging!

    if (deleteRecord($conn, $sql))
    {
	echo "<h3>RECORD WITH PK=$id Updated</h3>";
    }
    else
    {
	echo "<h3>RECORD WITH PK=$id not updated</h3>";
    }
}

function LoadRecords()
{
    Global $conn, $table, $PK;

    $sqlData = "SELECT * FROM $table";  //get the data from the table
    $sqlTitles = "SHOW COLUMNS FROM $table";  //get the table column descriptions
    //
    //  execute
    //
    $rsData = getTableData($conn, $sqlData);
    $rsTitles = getTableData($conn, $sqlTitles);
    //
    //  check
    //
    $arrayData = checkResultSet($rsData);
    $arrayTitles = checkResultSet($rsTitles);
    //
    //  display table
    //
    generateDeleteTable($table, $PK, $arrayTitles, $arrayData);
}

?>