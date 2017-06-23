<?php
$pageTitle = 'Registration Details';
require_once('header.php');
?>
<main class="bg-inverse">

    <h1>Customer's Registration</h1>
    <?php
    if (!empty($_GET['email'])) {
        $email = $_GET['email'];
    }
    else {
        $email = null;
        $username = null;
        $password = null;
        $dateofbirth = null;
        $agegroup = null;
        $gender = null;
        $address = null;
    }
    //if the email exists, it is an edit situation
    if(!empty($email))
    {
        require_once('db.php');

        $sql = "SELECT * FROM students where email = :email";
        $cmd = $conn->prepare($sql);
        $cmd->bindParam(':email', $email,PDO::PARAM_INT);
        $cmd->execute();
        $student = $cmd->fetch();
        $conn = null;

        $email = $student['email'];
        $username = $student['username'];
        $password = $student['password'];
        $dateofbirth = $student['dateofbirth'];
        $agegroup = $student['agegroup'];
        $gender = $student['gender'];
        $address = $student['address'];
    }
    ?>
    <?php
    if(!empty($_GET['errorMessage']))
        echo '<div class="alert alert-danger" id="message">Email address already exists</div>';
    else
        echo '<div class="alert alert-info" id="message">Please create your account</div>';


    ?>
    <form method="post" action="saveRegistration.php">
        <fieldset class="form-group form-inline">
            <label for="email" class="col-sm-2">Email: *</label>
            <input name="email" id="email" type="email" required
                   placeholder="email@email.com" value="<?php echo $email?>"/>
        </fieldset>
        <fieldset class="form-group form-inline">
            <label for="username" class="col-sm-2">User Name: </label>
            <input name="username" id="username" placeholder="your name" value="<?php echo $username?>"/>
        </fieldset>
        <fieldset class="form-group form-inline">
            <label for="password" class="col-sm-2">Password: </label>
            <input name="password" id="password" type="password" placeholder="Password" />
        </fieldset>
        <fieldset class="form-group form-inline">
            <label for="confirm" class="col-sm-2">Re-enter Password: </label>
            <input name="confirm" id="confirm" type="password" placeholder="Confirm Password" />
        </fieldset>
            <fieldset class="form-group form-inline">
                <label for="dateofbirth" class="col-sm-2">Date of birth: </label>
                <input name="dateofbirth" id="dateofbirth" placeholder="DOB" value="<?php echo $dateofbirth?>"/>
            </fieldset>
            <fieldset class="form-group form-inline">
                <label for="agegroup" class="col-sm-2">Age group: </label>
                <input name="agegroup" id="agegroup" placeholder="your age group" value="<?php echo $agegroup?>"/>
            </fieldset>
            <fieldset class="form-group form-inline">
                <label for="gender" class="col-sm-2">Gender: </label>
                <input name="gender" id="gender" placeholder="gender" value="<?php echo $gender?>"/>
            </fieldset>
            <fieldset class="form-group form-inline">
                <label for="address" class="col-sm-2">Address: </label>
                <input name="address" id="address" placeholder="address" value="<?php echo $address?>"/>
            </fieldset>
        <input name="Email" id="Email" value="<?php echo $_GET['email'] ?>" type="hidden"/>

        <button class="btn btn-success col-sm-offset-2">Register</button>
    </form>

</main>
<?php require_once('footer.php') ?>
