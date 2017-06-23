<?php
$pageTitle = 'new_page';
require_once('header.php');
?>
<main class="container">
    <h1>Add/Delete a page</h1>

    <?php
    //Step 1: connect to the database
    require_once('db.php');

    //Step 2: create a SQL command
    $sql = "SELECT * FROM pages";

    //Step 3: prepare the SQL command
    $cmd = $conn->prepare($sql);

    //Step 4: execute and store the results
    $cmd->execute();
    $pages = $cmd->fetchAll();
    //Step 5: disconnect from the db
    $conn = null;

    //create a table and display the results
    echo '<table class="table table-striped table-hover table-bordered">
                <tr><th>PageId</th>
                    <th>Title</th>';
    if(!empty($_SESSION['email'])){
        echo '<th>Edit</th>
                   <th>Delete</th>';
    }
    echo '</tr>';
    foreach($pages as $page)
    {
        echo '<tr><td>'.$page['pageId'].'</td>
                        <td>'.$page['title'].'</td>';
        if(!empty($_SESSION['email'])){

            echo    '<td><a href="newPage.php?pageId='.$page['pageId'].'"
                       class="btn btn-primary">Edit</a></td>
                       <td><a href="deletePage.php?pageId='.$page['pageId'].'"
                       class="btn btn-danger confirmation">Delete</a></td>';
        }
        echo   ' </tr>';
    }
    echo '</table></main>';
    require_once ('footer.php');
    ?>

