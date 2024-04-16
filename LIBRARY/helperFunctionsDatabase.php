<?php

//helper functions for database interaction

/**
 * Run a query and return the result set
 * @param MySQLi $connection
 */
function queryUpdate($connection, $sql)
{
    return executeQuery($connection, $sql);
}

function queryInsert($connection, $sql)
{
    return executeQuery($connection, $sql);
}

function executeQuery($connection, $sql)
{
    if ($connection->query($sql))
        return 1;
    else
        return 0;
}

function query($connection, $sql)
{
    return $connection->query($sql);
}


$table = "lecturer";
$LectIdColumn = "Id";
$FirstNameColumn = "FirstName";
$LastNameColumn = "LastName";
$PasswordColumn = "Password";
$PK = $LectIdColumn;

$DeleteFormButton = "delrecord";
$EditFormButton = "editrecord";

$UpdateFormButton = "UpdateFormButton";
$UpdateFormFirstName = $FirstNameColumn;
$UpdateFormLastName = $LastNameColumn;
$UpdateFormPassword = $PasswordColumn;

function pageActionIsEdit()
{
    global $EditFormButton;

    return isset($_POST[$EditFormButton]);
}

function pageActionIsDelete()
{
    global $DeleteFormButton;

    return isset($_POST[$DeleteFormButton]);
}

function pageActionIsUpdate()
{
    global $UpdateFormButton;
    return isset($_POST[$UpdateFormButton]);
}

function loadRecordToEditControl($conn)
{
    global $EditFormButton, $PK, $table;

    $id = $_POST[$EditFormButton];
    $id = $conn->real_escape_string($id);

    $sql = "SELECT * FROM $table WHERE $PK='$id'";

    $rsData = getTableData($conn, $sql);

    echo "<h1>$table</h1>";

    $row = $rsData->fetch_assoc();
    //
    //  Print Control into Page
    //
    loadRecord($row);
}

function getOneRecord($connection, $sql)
{
    $rs = $connection->query($sql);
    return  $rs->fetch_assoc();
}

function deleteARecord($conn)
{
    global $DeleteFormButton, $PK, $table;

    $id = $_POST[$DeleteFormButton];
    $id = $conn->real_escape_string($id);

    $sql = "DELETE FROM $table WHERE $PK='$id'";  //create the SQL

    echo $sql . "<br>"; //SQL Debugging!
    if (executeQuery($conn, $sql)) {
        echo "<h3>RECORD WITH PK=$id DELETED</h3>";
    } else {
        echo "<h3 >RECORD WITH PK=$id CANNOT BE DELETED</h3>";
    }
}

function getUpdateUserSql($id, $firstName, $lastName, $password)
{
    global $table;
    global $FirstNameColumn, $LastNameColumn, $PasswordColumn, $PK;
    return "UPDATE $table SET"
        . " " . " $FirstNameColumn = '$firstName'"
        . "," . " $LastNameColumn = '$lastName'"
        . "," . " $PasswordColumn = '$password'"
        . " WHERE $PK = '$id'";
}

function updateRecord($conn)
{
    global $UpdateFormButton, $UpdateFormFirstName, $UpdateFormLastName, $UpdateFormPassword;


    $id = $_POST[$UpdateFormButton];
    $firstName = $_POST[$UpdateFormFirstName];
    $lastName = $_POST[$UpdateFormLastName];
    $password = $_POST[$UpdateFormPassword];

    $id = $conn->real_escape_string($id);
    $firstName = $conn->real_escape_string($firstName);
    $lastName = $conn->real_escape_string($lastName);
    $password = $conn->real_escape_string($password);

    $sql = getUpdateUserSql($id, $firstName, $lastName, $password);
    // echo $sql . "<br>"; //SQL Debugging!

    if (executeQuery($conn, $sql)) {
        echo "<h3>RECORD WITH PK=$id Updated</h3>";
    } else {
        echo "<h3>RECORD WITH PK=$id not updated</h3>";
    }
}

function loadRecords($conn)
{
    global $table, $PK;

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
/**
 * @param $connection
 */
function getSelectInput($resultsSet, $recordText, $recordValue,  $selectName, $selectedValue)
{
    $select = "<select name='$selectName'>";
    while ($row = $resultsSet->fetch_assoc()) {
        $value = $row[$recordValue];
        $text = $row[$recordText];
        $select .= "<option value='$value'";
        if ($value == $selectedValue) {
            $select .= " selected";
        }
        $select .= ">$text</option>";
    }
    $select .= "</select>";
    return $select;
}
