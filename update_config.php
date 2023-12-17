<?php

include("configs/config.php");
include("configs/db.php");

isAuth(true);

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["value"])) {
    set_config($conn, $_GET["key"], $_POST["value"]);
    header("Location: adash.php");
} else {
    header("Location: adash.php");
}
