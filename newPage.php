<?php
$pageTitle = 'Inserting Page';
require_once('header.php');
?>
<?php
if (!empty($_GET['pageId'])) {
    $pageId = $_GET['pageId'];
}
else {
    $pageId = null;
    $title = null;
    $content = null;
}
//if the pageId exists, it is an edit situation
if(!empty($pageId))
{
    require_once('db.php');

    $sql = "SELECT * FROM pages where pageId = :pageId";
    $cmd = $conn->prepare($sql);
    $cmd->bindParam(':pageId', $pageId,PDO::PARAM_INT);
    $cmd->execute();
    $page = $cmd->fetch();
    $conn = null;

    $pageId = $page['pageId'];
    $title = $page['title'];
    $content = $page['content'];
}
?>

<main class="bg-inverse">
    <h1>Create a new Page</h1>
    <form method="post" action="savenewPage.php">
        <fieldset class="form-group form-inline">
            <label for="title" class="col-sm-1">Title: *</label>
            <input name="title" id="title" size="85" maxlength="155" type="text" value="<?php echo $title?>"  required />
        </fieldset>
        <fieldset class="form-group form-inline">
            <label for="content" class="col-sm-1">Content: *</label>
            <input name="content" id="content" size="85" maxlength="155" type="text" value="<?php echo $content?>"  required />
        </fieldset>
        <input name="pageId" id="pageId" value="<?php echo $pageId ?>" type="hidden"/>

        <button class="btn btn-success col-sm-offset-2">Submit</button>
    </form>

</main>
<?php require_once('footer.php') ?>
