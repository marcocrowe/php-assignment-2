<?php

//helper functions

/**
 * Run a query and return the result set
 * @param MySQLi $connection
 
 */
function getTableData(MySQli $connection, string $sql)
{
    return $connection->query($sql);
}

function checkResultSet($rs)
{
    if ($rs === false) {
        if (__DEBUG == 1) {
            echo 'Wrong SQL: ' . $sql . ' Error: ' . $conn->error;
            exit('<p class="warning">PHP script terminated');
        } else {
            header("Location:" . __USER_ERROR_PAGE);
        }
    } else {
        return $rs->fetch_all(MYSQLI_ASSOC);
    }
}

function generateTable($tableName, $titlesResultSet, $dataResultSet)
{
    //use resultsets to generate HTML tables

    echo "<table>";

    //first - create the table caption and headings
    echo "<caption>" . strtoupper($tableName) . " TABLE - QUERY RESULT</caption>";
    echo '<tr>';
    foreach ($titlesResultSet as $fieldName) {
        echo '<th>' . $fieldName['Field'] . '</th>';
    }
    echo '</tr>';

    //then show the data
    foreach ($dataResultSet as $row) {
        echo '<tr>';
        foreach ($titlesResultSet as $fieldName) {
            echo '<td>' . $row[$fieldName['Field']] . '</td>';
        }
        echo '</tr>';
    }
    echo "</table>";
}

function generateDeleteTable($tableName, $primaryKey, $titlesResultSet, $dataResultSet)
{
    //use resultsets to generate HTML tables
    echo "<table class='table table-striped table-hover'>";

    //first - create the table caption and headings
    echo "<caption class='table-caption'>Table</caption>";
    echo '<tr>';
    foreach ($titlesResultSet as $fieldName) {
        echo '<th>' . $fieldName['Field'] . '</th>';
    }
    echo '<th>DELETE</th>';
    echo '<th>EDIT</th>';
    echo '</tr>';

    //then show the data
    foreach ($dataResultSet as $row) {
        echo '<tr>';
        foreach ($titlesResultSet as $fieldName) {
            echo '<td>' . $row[$fieldName['Field']] . '</td>';
        }

        echoButton2Template($row[$primaryKey]);

        echo '<td>';
        //New Button Entered for editing
        $id = $row[$primaryKey];  //get the current PK value
        $buttonText2 = "Edit";
        include 'FORMS/buttonWithText3.html';
        echo '</td>';
        echo '</tr>';
    }
    echo "</table>";
}
function echoButton2Template($id)
{
    echo '<td>';
    //set the button values and display the button to the form:
    $buttonText = "Delete";
    include 'FORMS/buttonWithText2.html';
    echo '</td>';
}

function performUpdateAction($id, $firstname, $lastname, $password)
{
}

function loadRecord($row)
{
    global $LectIdColumn, $FirstNameColumn, $LastNameColumn, $PasswordColumn;
    loadRecord1($row[$LectIdColumn], $row[$FirstNameColumn], $row[$LastNameColumn], $row[$PasswordColumn]);
}

function loadRecord1($id, $firstname, $lastname, $password)
{
    global $UpdateFormButton;
    global $UpdateFormFirstName, $UpdateFormLastName, $UpdateFormPassword;

    include 'forms/Update.html';
}
