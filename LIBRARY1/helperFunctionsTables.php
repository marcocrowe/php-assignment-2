<?php

//helper functions

/**
 * Run a query and return the result set
 * @param MySQLi $connection The connection to the database
 * @param string $sql The SQL query to run
 * @return mysqli_result|bool The result set or false if the query failed
 */
function getTableData(MySQli $connection, string $sql): mysqli_result|bool
{
    return $connection->query($sql);
}

function checkResultSet($rs)
{
    return $rs->fetch_all(MYSQLI_ASSOC);
}

function generateTable($tableName, $titlesResultSet, $dataResultSet)
{
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
        include 'FORMS/buttonWithText3.php';
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
    include 'FORMS/buttonWithText2.php';
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

    include 'forms/Update.php';
}
