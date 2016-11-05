<!DOCTYPE html>
<?php
session_start();

require_once 'omitted';

$mysqli = new mysqli($db_hostname, $db_username, $db_password, $db_database, $db_port);

if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

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
                if (isset($_SESSION["Username"])) {
                    ?>

                <div style="float:right; text-align:right">Welcome <?php print($_SESSION["Username"] . "!<br>" . $_SESSION["total"]) ?> items in cart.<br><a href="cart.php">View Cart</a> | <a href="logout.php">Log Out</a></div>
                Please pick an item:<br>

                <form id="pick" name="pick" method="post" action="catalogue.php">
                    <select id="picker" name="picker">
                        <option id="0" name="0" value=""></option>
    <?php
    $items = mysqli_query($mysqli, "SELECT * FROM x");

    while ($row = mysqli_fetch_array($items)) {
        ?>

                            <option id="<?php print($row["idProduct"]) ?>" name="<?php print($row["idProduct"]) ?>"><?php print($row["Name"]) ?></option>
                            <?php
                        }
                        ?>

                    </select>
                    <br><input type="submit" id="submitMe" value="Select"></input></form>

    <?php
    $prod = $_POST["picker"];

    $grabMe = mysqli_query($mysqli, "SELECT * FROM x WHERE Name='$prod'");

    while ($row = mysqli_fetch_array($grabMe)) {
        ?>
                    <hr>
                    <h2><?php print($row["Name"]) ?></h2>
                    <div class="row">
                        <div class="col-sm-3">
                            <img class="img-responsive" src="/compsci/ecommerce/pics/<?php print($row["idProduct"] - 1) ?>.jpg">
                        </div>
                        <div class="col-sm-6">
                            <b>Price:</b> $<?php print($row["Price"]) ?><br>
                            <b>Weight:</b> <?php print($row["Weight"]) ?> lbs.<br>
        <?php print($row["Description"]) ?>
                        </div>
                        <div class="col-sm-3">
                            <form id="addToCart" name="addToCart" method="post" action="cart.php">
                                Qty: <select id="qty" name="qty">
                            <?php
                            $counter = 20;
                            for ($x = 1; $x <= $counter; $x++) {
                                ?>
                                        <option name="<?php print($x) ?>"><?php print($x) ?></option>
                                        <?php
                                    }
                                    ?>
                                </select><br>
                                <select id="decide" name="decide">
                                    <option id="add" name="add">Add to Cart</option>
                                    <option id="remove" name="remove">Remove from Cart</option>
                                </select>
                                <input type="hidden" value="<?php print($row["Name"]) ?>" name="datProduct"></input>
                                <input type="hidden" name="datCost" value="<?php print($row["Price"]) ?>"></input>
                                <input type="hidden" name="datWeight" value="<?php print($row["Weight"]) ?>"></input>
                                <br>
                                <input id="bam" name="bam" type="submit" value="Submit"></input>
                            </form>
                        </div>
                    </div>
                    <hr>
        <?php
    }
    ?>

                </form>
                <?php
            } else {
                ?>

                Please <a href="login.php">log in</a> to access this page.

                <?php
            }
            ?>
        </div>
</body>
</html>