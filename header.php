<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $pageTitle ?></title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <!-- Optional theme -->
    <link rel="stylesheet" href="css/bootstrap-theme.min.css">
</head>
<body>
<nav class="nav navbar-inverse">
    <ul class="nav navbar-nav">
        <li><a href="home.php" class="navbar-brand">Registering for camp</a></li>
        <li><a href="registration.php">Register</a></li>
        <?php
        //public(not logged in links links
        session_start();
        if(empty($_SESSION['email']))
        {
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
            foreach($pages as $page){
                echo'<li class="nav-tabs"><a href="showPage.php?pageId='.$page['pageId'].'" style="text-decoration-color: wheat">'.$page['title'].'</a></li>';
            }
            echo'<li><a href="registrationDetails.php">Registration</a></li>
            <li><a href="login.php">Login</a></li></ul>';
        }
        //private/logged in links

        else
        {
            echo'<li><a href="registrationDetails.php">New registration</a></li>
                 <li><a href="newPage.php">New Page</a></li>
                 <li><a href="coverDetails.php">Cover Image</a></li>
                 <li><a href="page.php">ADD/Delete a page</a></li>
            <li><a href="logout.php">Logout</a></li></ul>';

        }


        ?>
    </ul>
</nav>


