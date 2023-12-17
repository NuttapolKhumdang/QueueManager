<?php

session_start();

function isAuth(bool $onlyAdmin = false, bool $redirect = true)
{
    if ($onlyAdmin) {
        if (isset($_SESSION["ID"]) && $_SESSION["level"] == "A")
            return true;
        else if ($redirect) header("Location: index.php");
    } else {
        if (isset($_SESSION["ID"])) return true;
    }

    if ($redirect) header("Location: auth.php?login&err=ต้องเข้าสู่ระบบก่อนดำเนินการต่อ");
    return false;
}


function set_config(mysqli $conn, string $key, string $value)
{
    // ? Trying to find if key is exists

    $r = $conn->query("SELECT * FROM wconfig WHERE `key`='$key'");
    if ($r->num_rows == 1) {
        $conn->query("UPDATE wconfig SET `value`='$value' WHERE `key`='$key'");
    } else {
        $conn->query("INSERT INTO wconfig(`key`, `value`) VALUES ('$key', '$value')");
    }

    if ($conn->error) {
        return false;
    }

    return true;
}

function get_config(mysqli $conn, string $key)
{
    $r = $conn->query("SELECT `value` FROM wconfig WHERE `key` = '$key'");
    return $r->fetch_array()["value"];
}
