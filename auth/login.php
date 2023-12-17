<?php

include('../configs/config.php');
include('../configs/db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && (isset($_POST["email"]) && isset($_POST["password"]))) {
    $r = $conn->query("SELECT * FROM user WHERE `email` = '{$_POST["email"]}' AND `password` = '{$_POST["password"]}'");

    if ($r->num_rows == 1) 
    {
        $r = $r->fetch_array();

        $_SESSION["ID"] = $r["ID"];
        $_SESSION["name"] = $r["name"];
        $_SESSION["email"] = $r["email"];
        $_SESSION["level"] = $r["level"];

        header("Location: ../index.php");
    } else {
        header("Location: ../auth.php?err=อีเมล์หรือรหัสผ่านไม่ถูกต้อง");
    }
} else {   
    header("Location: ../auth.php?err=เกิดข้อผิดพลาด, โปรดลองอีกครั้งในภายหลัง");
}
