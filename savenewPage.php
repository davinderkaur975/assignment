<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Saving page</title>
</head>
<body>
<?php
$pageId = $_POST['pageId'];
$title = $_POST['title'];
$content = $_POST['content'];

//Step 1 - connect to the DB
require('db.php');

//Step 2 - create the SQL command
if(!empty($pageId)){
    $sql = "UPDATE pages
                   SET title = :title,
                      content = :content,
                      WHERE pageId = :pageId";
}
else {
    $sql = "INSERT INTO pages(title, content) 
                VALUES (:title, :content)";
}

//Step 3 - prepare and execute the SQL
$cmd = $conn->prepare($sql);
    $cmd->bindParam(':title', $title, PDO::PARAM_STR, 30);
    $cmd->bindParam(':content', $content, PDO::PARAM_STR, 400);
if(!empty($pageId)) {
    $cmd->bindParam(':pageId', $pageId, PDO::PARAM_INT);
}
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

$conn = null;
//Step 5 - redirect to the login page
header('location:page.php');
?>
</body>
</html>
