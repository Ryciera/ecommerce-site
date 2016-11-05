<!DOCTYPE html>
<?php
session_start();
session_destroy();

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
        
        Rocked out. <a href="login.php">Come Back Soon</a>!
        
    </div>
    </body>
</html>