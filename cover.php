<?php
$pageTitle = 'CoverImage';
require_once('header.php');
?>
<main class="container">
    <h1>Cover Image</h1>

    <?php
    //Step 1: connect to the database
    require_once('db.php');
    //Step 2: create a SQL command
    $sql = "SELECT * FROM coverfile";

    //Step 3: prepare the SQL command
    $cmd = $conn->prepare($sql);

    //Step 4: execute and store the results
    $cmd->execute();
    $coverfile = $cmd->fetchAll();
    //Step 5: disconnect from the db
    $conn = null;

    //create a table and display the results
    echo '<table class="table table-striped table-hover">
                <tr><th>Cover Image</th>';
    if(!empty($_SESSION['email'])){
        echo '<th>Edit</th>';
    }
    echo '</tr>';
    foreach($coverfile as $coverfiles)
    {
        echo '<tr><td><img height="100" src='.$coverfiles['coverFile'].' /></td>';

        if(!empty($_SESSION['email'])){

            echo    '<td><a href="coverDetails.php?coverID='.$coverfiles['coverId'].'"
                        class="btn btn-primary">Edit</a></td>';
        }
        echo   ' </tr>';
    }
    echo '</table></main>';

    require_once ('footer.php');
    ?>

