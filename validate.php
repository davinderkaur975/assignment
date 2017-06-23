<?php

$email = $_POST['email'];
$password = $_POST['password'];

//Step1- connect to the DB
require_once('db.php');

//Step2- build the sql command
$sql = "SELECT * FROM students WHERE email = :email";
//Step3- bind the parameters and execute
$cmd = $conn->prepare($sql);
$cmd->bindParam(':email',$email,PDO::PARAM_STR,120);
$cmd->execute();
$student = $cmd->fetch();


//Step4- validate the user
if (password_verify($password, $student['password'])){
    //excellent we have a valid password
    session_start();
    $_SESSION['email'] = $student['email'];
    $_SESSION['username'] = $student['username'];
    header('location:registration.php');
}
else{
    //user was not found or did not have a valid password
    header('location:login.php?invalid=true');
    exit();
}

//Step5- disconnect from the db
$conn=null;
?>
