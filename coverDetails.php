<?php
$pageTitle = 'Cover Image Details';
require_once('header.php');
?>
<main class="bg-inverse">

    <h1>Cover Image</h1>

<?php
if (!empty($_GET['coverId']))
    $coverId = $_GET['coverId'];
else
    $coverId = null;
$coverFile = null;
if(!empty($coverId))
{
    require_once('db.php');
    //require ('db.php');
    //include_once('db.php');
    //include('db.php');

    $sql = "SELECT * FROM coverfile where coverId = :coverId";
    $cmd = $conn->prepare($sql);
    $cmd->bindParam(':coverId', $coverId,PDO::PARAM_INT);
    $cmd->execute();
    $coverfiles = $cmd->fetch();
    $conn = null;

    $coverFile = $coverfiles['coverFile'];
}
?>

    <form method="post" action="saveCover.php">
<fieldset class="form-group">
    <label for="coverFile" class="col-sm-2">Cover Image</label>
    <input name="coverFile" id="coverFile" type="file" value="<?php echo $coverFile ?>"/>
</fieldset>
        <input name="coverId" id="coverId" value="<?php echo $coverId ?>" type="hidden"/>

        <button class="btn btn-success col-sm-offset-2">Change</button>
    </form>
</main>
<?php require_once('footer.php') ?>