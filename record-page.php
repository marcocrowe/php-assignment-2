<?php
require_once "library/config.php";
require_once "library/helperFunctionsTables.php";
require_once "library/helperFunctionsDatabase.php";

function pageBody(): void
{
    $databaseConnection = connectWithConfig();

    if (pageActionIsEdit()) {
        echo "<section class='update'>";
        loadRecordToEditControl($databaseConnection);
        echo "</section>";
    }
    if (pageActionIsUpdate()) {
        updateRecord($databaseConnection);
    }
    if (pageActionIsDelete()) {
        deleteARecord($databaseConnection);
    }
    echo "<section class='wide'>";
    loadRecords($databaseConnection);
    echo "</section>";

    $databaseConnection->close();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Data Driven Applications 2; Assignment 2</title>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <link href="css/my-style.css" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
</head>

<body>
    <header class="header">
        <h1 class="header">Assignment 2 Edit Function</h1>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Mark Crowe</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="record-page.php">Record Page</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <main>
        <?php pageBody(); ?>
    </main>
</body>

</html>
