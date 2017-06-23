<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Signing customers</title>
</head>
<body>
<?php

$email = $_POST['email'];
$password = $_POST['password'];
$confirm = $_POST['confirm'];
$username = $_POST['username'];
$dateofbirth = $_POST['dateofbirth'];
$agegroup = $_POST['agegroup'];
$gender = $_POST['gender'];
$address = $_POST['address'];
$Email = $_POST['Email'];
$ok = true;

if($password != $confirm)
{
echo 'The passwords do not match <br />';
$ok = false;
}

if(strlen($password)<8)
{
echo 'The passwords is too short, must be 8 or more characters <br />';
$ok = false;
}
if(empty($email))
{
echo 'You must enter an email address <br />';
$ok = false;
}

//if the email and password are ok
if($ok)
{
//connect to the DB and setup the new user
//Step 1 - connect to the DB
    require_once('db.php');

//Step 2 - create the SQL command
    if(!empty($Email)){
       $sql = "UPDATE students
                   SET email = :email,
                       username = :username,
                      password = :password,
                      dateofbirth = :dateofbirth,
                      agegroup = :agegroup,
                      gender = :gender,
                      address = :address
                      WHERE email = :email";
    }
    else {
        $sql = "INSERT INTO students(email,username,password,dateofbirth,agegroup,gender,address) 
                VALUES (:email, :username, :password, :dateofbirth, :agegroup, :gender, :address);";
    }
    echo $sql;
        //Step 2.5 - hash the password
$password = password_hash($password, PASSWORD_DEFAULT);
//Step 3 - prepare and execute the SQL
$cmd = $conn->prepare($sql);
$cmd->bindParam(':email', $email, PDO::PARAM_STR, 120);
$cmd->bindParam(':username', $username, PDO::PARAM_STR, 100);
$cmd->bindParam(':password', $password, PDO::PARAM_STR, 255);
$cmd->bindParam(':dateofbirth', $dateofbirth, PDO::PARAM_INT, 10);
$cmd->bindParam(':agegroup', $agegroup, PDO::PARAM_INT, 3);
$cmd->bindParam(':gender', $gender, PDO::PARAM_STR, 1);
$cmd->bindParam(':address', $address, PDO::PARAM_STR, 40);

    try {
//Step4 - execute
        $cmd->execute();
    }
//send mail to handle exception
    catch (Exception $e)
    {
        $to = 'davinderkaur975@gmail.com';
        $subject = 'error on registration page';
        $message = 'email: '.$email.'userName: '.$userName.'password: '.$password.'Exception: '.$e->getMessage();
        mail($to, $subject, $message);
        header('location: error.php');
        exit();
    }
//Step 4 - disconnect from the DB
$conn = null;
//Step 5 - redirect to the login page
header('location:registration.php');
}
?>
</body>
</html>
