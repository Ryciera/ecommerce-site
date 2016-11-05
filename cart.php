<!DOCTYPE html>
<?php
// MY CART.
session_start();

// Connect to database.
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
        // If user is logged in...
        if (isset($_SESSION["Username"])) {
            
            // Display the shit.
            ?>

            <div style="float:right; text-align:right">Welcome <?php print($_SESSION["Username"] . "!<br>" . $_SESSION["total"]) ?> items in cart.<br><a href="cart.php">View Cart</a> | <a href="logout.php">Log Out</a></div>

            Click <a href="catalogue.php">here</a> to return to the catalogue.
            <?php
            $decide = $_POST["decide"];
            $qty = $_POST["qty"];
            $productID = $_POST["datProduct"];
            $addWeight = $_POST["datWeight"];
            $addCost = $_POST["datCost"];
            
            // Determine if user added or removed an item from cart.
            switch ($decide) {
                case "Add to Cart":
                    for ($x = 1; $x <= $qty; $x++) {
                        $_SESSION['cart'][$productID] ++; //Add
                        $_SESSION['weight'] = $_SESSION['weight'] + $addWeight;
                        $_SESSION['cost'] = $_SESSION['cost'] + $addCost;
                    }
                    break;
                case "Remove from Cart":
                    for ($x = 1; $x <= $qty; $x++) {
                        $_SESSION['cart'][$productID] --; //Remove
                        $_SESSION['weight'] = $_SESSION['weight'] - $addWeight;
                        $_SESSION['cost'] = $_SESSION['cost'] - $addCost;
                    }
                    break;
            }

            // Tally the total items.
            $tallying = mysqli_query($mysqli, "SELECT * FROM x");
            $total = 0;

            while ($row = mysqli_fetch_array($tallying)) {
                $total = $_SESSION['cart'][$row["Name"]] + $total;
            }

            $_SESSION['total'] = $total;
            
            
            
            ?>
            <h2>My Cart</h2>
                <div class="row">
                    <div class="col-sm-4"><h3>Itemized Receipt</h3>
    <?php
    
    // Print out all the tallied items.
    $thisQuery = mysqli_query($mysqli, "SELECT * FROM x");

    while ($rows = mysqli_fetch_array($thisQuery)) {
        if (isset($_SESSION['cart'][$rows["Name"]])) {
            if ($_SESSION['cart'][$rows["Name"]] > 0) {
                print("<b>" . $rows["Name"] . ":</b> " . $_SESSION['cart'][$productID] . "<br>");
            }
        }
    }
    ?>
                    </div>
                    <div class="col-sm-4">

<h3>Totals</h3>
                        <?php
                        
                        // Display totals.
                        print("<b>Total Items:</b> " . $total);
                        print("<br><b>Total Cost:</b> $" . $_SESSION['cost']);
                        print("<br><b>Total Weight:</b> " . $_SESSION['weight'] . " lbs.");
                        ?>
                    </div>
                    <div class="col-sm-4">
                    <h3>Other Options</h3>
                        <form id="clear" name="clear" action="cart.php" method="post">
                            <!--CLEAR CART-->
                            <input type="submit" id="clearMe" name="clearMe" value="Clear Cart"></input>
                            <?php
                            $clearMe = $_POST["clearMe"];
                            
                            if ($clearMe === "Clear Cart")
                            {
                                $s = mysqli_query($mysqli, "SELECT * FROM x");
                                while ($row = mysqli_fetch_array($s))
                                {
                                    $_SESSION['cart'][$row["Name"]] = null;
                                    $total = 0;
                                    $_SESSION['weight'] = 0;
                                    $_SESSION['cost'] = 0;
                                        header('Location: cart.php');
                                }
                            }
                            ?>
                    
                        </form>
            </div>
                </div>
            <hr>

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
<!--
TO DO:
- Fix quantities.
-->