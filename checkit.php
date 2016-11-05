<!DOCTYPE html>
<?php
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
// CHECKS LOGIN INFORMATION

$date = date("format", $timestamp);
session_start();

$myusername = $_POST["myusername"];
$mypassword = $_POST["mypassword"];

require_once 'omitted';

$mysqli = new mysqli($db_hostname, $db_username, $db_password, $db_database, $db_port);

if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

$myusername = stripslashes($myusername);
$mypassword = stripslashes($mypassword);
$mypassword = hash('Sha512',$mypassword);

$sql = mysqli_query($mysqli, "SELECT * FROM x WHERE Username='$myusername' AND Password='$mypassword'");

$count = mysqli_num_rows($sql);
            
            if($count==1)
{
    $_SESSION["Username"] = $myusername;
    $_SESSION["Password"] = $mypassword;
    print("Welcome " . $myusername . "!");
    
    header('Location: catalogue.php');
    ?>
<?php
}
else
{
    print("Incorrect username or password. Please ");
    
    ?>
 <a href='login.php'>try again</a>.
 
 <?php
}
?>
        