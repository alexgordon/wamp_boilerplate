<?php
/**
 * Created by PhpStorm.
 * User: alexgordon
 * Date: 3/20/2015
 * Time: 1:33 AM
 */

$servername = "xxxx";
$username = "xxxx";
$password = "";
$dbname = "xxxxx";

$firstName = $_POST["fName"];
$lastName = $_POST["lName"];
$email = $_POST["email"];
$newUserPass = $_POST["pass"];
$newUserConfPass = $_POST["confPass"];

$error_message = "";
$string_exp = "/^[A-Za-z0-9 .'-]+$/";

if($newUserPass != $newUserConfPass){
    die("Password does not match, Please try again");
}

else {


//Create Connection
    $conn = new mysqli($servername, $username, $password, $dbname);

//Check Connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);

    }

    //Insert New User
    $sql = "INSERT INTO usertable(firstName,lastName,email)
    VALUES ('$firstName','$lastName','$email')";

    $conn->query($sql);

    //Insert password for that user
    $sql = "INSERT INTO passwordtable(user_id,passcode)
    VALUES ((SELECT U.user_id FROM usertable U WHERE U.email = '$email') ,'$newUserPass')";

    $conn->query($sql);

    $conn->close();
    }

    //Redirect
    header('Location: ../Views/createAccount_page.html');
?>