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



        Fill out the following to create an account. Already have an account? <a href="login.php">Sign In</a>.<br>
            
            <form name="accountCreate" method="post" action="createme.php">
                <div class="row">
                    <div class="col-sm-6 col-md-1">
                        <b>Username: </b>
                    </div>

                    <div class="col-sm-6 col-md-4">

                        <input class="form-control" name="myname" type="text" size="15" id="myname"></input>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-sm-6 col-md-1">
                        <b>Password: </b>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <input class="form-control" name="mypassword" type="password" id="mypassword" size="15"></input>
                    </div>
                    <input type="submit" value="Submit"></input>
                </div>
            </form>