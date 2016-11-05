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

                Welcome to the ACME eCommerce site! Please sign in to continue. Don't have an account? <a href="accountcreate.php">Create One</a> today!<br>
            <form name="loginForm" method="post" action="checkit.php">
                <div class="row">
                    <div class="col-sm-6 col-md-1">
                        <b>Username: </b>
                    </div>

                    <div class="col-sm-6 col-md-4">

                        <input class="form-control" name="myusername" type="text" size="15" id="myusername"></input>
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
            </body>
            </html>