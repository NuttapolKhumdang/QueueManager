<style>
    * {
        font-family: 'Courier New', Courier, monospace;
    }
</style>

<?php
// $A = new DateTime("16:00:00");
// $A->add(new DateInterval("PT120M"));

// echo $A->format("T.m.d H:i:s");

// $arr = range(1, 14);  // ? All Index Of Table
// $darr = array(1, 2, 3, 4, 5 ,6, 7, 9); // ? Using Index Of Table
// $arr = array_diff($arr, $darr); // ? Remove Using From All Index

// $result;
// print_r($arr);

// foreach ($arr as $a) { //? Find Avarable Index
//     if ($a) {
//         $result = $a;
//         break;
//     }
// }

// echo $result;


// $arr = array(1,2,3);
// array_push($arr, 4);
// print_r($arr);


// include('./configs/config.php');
// include('./configs/db.php');

// $x =set_config($conn, 'table_count', '1');
// echo $x;


$__CSV = "PNAME, NAME, EMAIL, PASSWORD
นาง, เขมิกา คัทยา, 0001@dev, 123, U
นาง, จิตตินี จิตรกัญญา, 0002@dev, 123, U";

function account_upload_CSV(string $CSV)
{
    $__EXP = explode("\n", $CSV);
    foreach ($__EXP as $v) {
        $__FIELD = explode(",", $v);

        $PNAME = $__FIELD[0];
        $NAME = $__FIELD[1];
        $EMAIL = $__FIELD[2];
        $PASSWORD = $__FIELD[3];

        echo $PNAME . ' -- ';
        echo $NAME . ' -- ';
        echo $EMAIL . ' -- ';
        echo $PASSWORD . ' -- ';
        echo '<br>';
    }
}
