<?php

include('../configs/config.php');
include('../configs/db.php');

if (
    $_SERVER["REQUEST_METHOD"] == "POST"
    && (isset($_POST["email"])
        && isset($_POST["password"])
        && isset($_POST["pname"])
        && isset($_POST["name"])
    )
) {
    $r = $conn->query(
        "INSERT INTO `user`(`pname`, `name`, `email`, `password`, `level`) 
        VALUES (
            '{$_POST["pname"]}',
            '{$_POST["name"]}',
            '{$_POST["email"]}',
            '{$_POST["password"]}',
            'U'
        )"
    );

    if ($r === true) {
        header("Location: ../auth.php?msg=สมัครบัญชีสำเร็จ");
    } else {
        header("Location: ../auth.php?err=เกิดข้อผิดพลาด, โปรดลองอีกครั้งในภายหลัง");
    }
} else {
    header("Location: ../auth.php?err=เกิดข้อผิดพลาด, โปรดลองอีกครั้งในภายหลัง");
}
