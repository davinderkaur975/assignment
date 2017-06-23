<?php ob_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Deleting Student</title>
</head>
<body>
<?php
//Step 1- connect to the DB
require_once('db.php');
//Step 2- create the SQL command
$sql = "DELETE FROM students WHERE email = :email";
//Step 3- prepare the SQL command
$cmd = $conn->prepare($sql);
$cmd->bindParam(':email', $_GET['email'], PDO::PARAM_INT);
$cmd->execute();
//Step 4- disconnect from the DB
$conn=null;
//Step 5- redirect to the Album

header('location:registration.php');
?>
</body>
<script src="js/delete.js"></script>

</html>
<?php ob_flush(); ?>
