<?php
$pageTitle = 'registration';
require_once('header.php');
?>
<main class="container">
    <h1>Register</h1>

    <?php
    //Step 1: connect to the database
    require_once('db.php');

    //Step 2: create a SQL command
    $sql = "SELECT * FROM students";

    //Step 3: prepare the SQL command
    $cmd = $conn->prepare($sql);

    //Step 4: execute and store the results
    $cmd->execute();
    $students = $cmd->fetchAll();
    //Step 5: disconnect from the db
    $conn = null;

    //create a table and display the results
    echo '<table class="table table-striped table-hover table-bordered">
                <tr><th>Username</th>
                    <th>Email</th>';
    if(!empty($_SESSION['email'])){
       echo '<th>Edit</th>
                   <th>Delete</th>';
    }
    echo '</tr>';
    foreach($students as $student)
    {
        echo '<tr><td>'.$student['username'].'</td>
                        <td>'.$student['email'].'</td>';

        if(!empty($_SESSION['email'])){

           echo    '<td><a href="registrationDetails.php?email='.$student['email'].'"
                       class="btn btn-primary">Edit</a></td>
                       <td><a href="deleteStudent.php?email='.$student['email'].'"
                       class="btn btn-danger confirmation">Delete</a></td>';
        }
        echo   ' </tr>';
    }
    echo '</table></main>';
    require_once ('footer.php');
    ?>
