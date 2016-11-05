<!DOCTYPE html>
<?php

// CREATES ACCOUNT.

$date = date("format", $timestamp);
session_start();

$myusername = $_POST["myname"];
$mypassword = $_POST["mypassword"];

require_once 'omitted';

$mysqli = new mysqli($db_hostname, $db_username, $db_password, $db_database, $db_port);

if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

$myusername = stripslashes($myusername);
$mypassword = stripslashes($mypassword);
$mypassword = hash('Sha512',$mypassword);

$usercheck = mysqli_query($mysqli, "SELECT * FROM x WHERE Username='$myusername'");

$count = mysqli_num_rows($usercheck);

$path = $_SERVER['DOCUMENT_ROOT'];
$path .= "/styles/head.php";
require_once($path);
?>

<script>
    $(document).ready(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>
</head>
<body>

<?php
$path = $_SERVER['DOCUMENT_ROOT'];
$path .= "/styles/bodycontent.php";
require_once($path);
?>

    <div id="bottom">
        <div id="container">
            <h1>Acme eCommerce</h1>
            <p>

<?php
if ($count > 0)
{
    print("Username already taken. Please try again!");
?>
<br><a href="accountcreate.php">Go back</a>.
<?php
}
else
{
$sql = "INSERT INTO x (Username, Password, creationDate, pwResetDate) VALUES ('$myusername', '$mypassword', '$date', '$date')";

    if ($mysqli->query($sql) === TRUE) {
        $_SESSION["Username"] = $myusername;
        $_SESSION["Password"] = $mypassword;    header('Location: catalogue.php');
        ?>
<?php
    } else
        print("Error creating record: " . $mysqli->error);
}
?>
            </p>