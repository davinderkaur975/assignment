<?php ob_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Deleting Page</title>
</head>
<body>
<?php
//Step 1- connect to the DB
require_once('db.php');
//Step 2- create the SQL command
$sql = "DELETE FROM pages WHERE pageId = :pageId";
//Step 3- prepare the SQL command
$cmd = $conn->prepare($sql);
$cmd->bindParam(':pageId', $_GET['pageId'], PDO::PARAM_INT);
$cmd->execute();
//Step 4- disconnect from the DB
$conn=null;
//Step 5- redirect to the Album

header('location:page.php');
?>
</body>
<script src="js/delete.js"></script>

</html>
<?php ob_flush(); ?>

