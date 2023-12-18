<?php

function account_upload_CSV(mysqli $conn, string $CSV)
{
    $QUERY = "";

    $__EXP = explode("\n", $CSV);
    foreach ($__EXP as $v) {
        $__FIELD = explode(",", $v);

        $PNAME = trim($__FIELD[0]);
        $NAME = trim($__FIELD[1]);
        $EMAIL = trim($__FIELD[2]);
        $PASSWORD = trim($__FIELD[3]);
        $LEVEL = trim($__FIELD[4]);

        $QUERY .= "('$PNAME', '$NAME', '$EMAIL', '$PASSWORD', '$LEVEL'),";
    }

    $QUERY = rtrim($QUERY, ',');
    $conn->query("INSERT INTO user(`pname`, `name`, `email`, `password`, `level`) VALUES $QUERY");

    if ($conn->error) {
        echo $conn->error;
        return false;
    } else return true;
}
