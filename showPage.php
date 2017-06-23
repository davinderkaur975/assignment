<?php
$pageTitle = 'new_page';
require_once('header.php');
?>
    <main class="container">
        <h1>New Page</h1>

<?php
$pageId = $_GET['pageId'];
//Step 1: connect to the database
require('db.php');

//Step 2: create a SQL command
$sql = "SELECT * FROM pages WHERE pageId = :pageId";

//Step 3: prepare the SQL command
$cmd = $conn->prepare($sql);
$cmd->bindParam(':pageId', $pageId,PDO::PARAM_INT);

//Step 4: execute and store the results
$cmd->execute();
$page = $cmd->fetch();
//Step 5: disconnect from the db
$conn = null;

echo $page['title'].'<br />';
echo $page['content'].'<br />';



require_once ('footer.php');
?>
