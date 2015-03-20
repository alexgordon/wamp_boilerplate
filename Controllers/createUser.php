<?php
/**
 * Created by PhpStorm.
 * User: alexgordon
 * Date: 3/20/2015
 * Time: 1:33 AM
 */

$servername = "xxxxx";
$username = "xxxx";
$password = "xxxx";
$dbname = "xxxx";

$firstName = $_POST["fName"];
$lastName = $_POST["lName"];
$email = $_POST["email"];
$newUserPass = $_POST["pass"];
$newUserConfPass = $_POST["confPass"];

if($newUserPass != $newUserConfPass){
    echo "Password does not match";
}

else {
    header('Location: ../Views/createAccount_page.html');

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
?>