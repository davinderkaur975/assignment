<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>$Title$</title>
</head>
<body>
<?php
$coverId = $_POST['coverId'];
$coverFileName = $_FILES['coverfile']['name'];
$coverFileType = $_FILES['coverfile']['type'];
$coverFileTmpLocation = $_FILES['coverfile']['tmp_name'];


//store our cover image file
//check to ensure that the file upload is an image
$validFileTypes = ['image/jpg','image/png','image/svg','image/gif', 'image/jpeg'];
$fileType = mime_content_type($coverFileTmpLocation);
//$fileType = substr($fileType, 6, 3);
//store the file on our server
if(in_array($fileType, $validFileTypes))
{
    $fileName = "uploads/".uniqid("",true)."-".$coverFileName;
    move_uploaded_file($coverFileTmpLocation, $fileName);
}


//Step 1: Connect to the database
require_once('db.php');

//Step 2: create the SQL command to INSERT a record
if(!empty($coverId)){
    $sql = "UPDATE albums 
                    SET   coverFile = :coverFile,
                     WHERE coverId = :coverId";}
else{
    $sql = "INSERT INTO coverfile (coverFile) 
                      VALUES (:coverFile);";
}
//Step 3: Prepare the SQL command and bind the arguments to prevent SQL injection
$cmd = $conn->prepare($sql);
$cmd->bindParam(':coverFile', $fileName, PDO::PARAM_STR, 100);


if(!empty($coverID))
    $cmd->bindParam(':coverId', $coverId, PDO::PARAM_INT);
try {
//Step4 - execute
    $cmd->execute();
}
//send mail to handle exception
catch (Exception $e)
{
    $to = 'virkjashan211@gmail.com';
    $subject = 'error on registration page';
    $message = 'email: '.$email.'firstName: '.$firstName.'password: '.$password.'Exception: '.$e->getMessage();
    mail($to, $subject, $message);
    header('location: error.php');
    exit();
}

//Step 5: disconnect from the database
$conn = null;

//Step 6: redirect to the albums page
header('location:cover.php');



?>
</body>
</html>
