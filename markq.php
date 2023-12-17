<?php include("configs/config.php") ?>
<?php include("configs/db.php") ?>
<?php isAuth(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>wings</title>

    <?php include('./templates/head.php') ?>
</head>

<body>
    <?php include('./templates/masterhead.php') ?>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        /* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
        !DON"T NEED TO KNOW WHAT THIS CODE DO!
        !JUST PRAY TO GOD TO WON"T LET YOU TOUCH THIS!
        ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */

        if (empty($_POST["duration"])) header("Location: markq.php?err=โปรดเลือกระยะเวลา");


        // ?? make table
        $qtable = null;
        $all_table = range(1, get_config($conn, 'table_count'));
        $marked_table = array();

        // ?? process of find date and time
        $TODAY = date("Y-m-d");

        $DURATION = $_POST["duration"];
        $__START = new DateTime($_POST["time"]);
        $__END = new DateTime($_POST["time"]);
        $__END->add(new DateInterval("PT{$DURATION}M"));

        $START = $__START->format("H:i:s");
        $END = $__END->format("H:i:s");

        // ?? find record that are in the same time
        $r = $conn->query("SELECT * FROM history WHERE `date`='$TODAY' AND `start` <= '$START' AND `end` > '$START'");

        // ?? insert NUMBER of table to marked_table 
        if ($r->num_rows > 0) {
            foreach ($r as $i) array_push($marked_table, $i["number"]);
        }

        // ?? find free table number
        $all_table = array_diff($all_table, $marked_table);

        foreach ($all_table as $a) {
            if ($a) {
                $qtable = $a;
                break;
            }
        }

        if ($qtable) { // ?? save record if has free table
            $conn->query("INSERT INTO `history`(`user`, `number`, `date`, `start`,`end`, `purpose`, `duration`)
            VALUES (
                '{$_SESSION["ID"]}',
                '$qtable',

                '{$TODAY}',
                '{$START}',
                '{$END}',

                '{$_POST["purpose"]}',
                '{$_POST["duration"]}'
            )");
            // ? SHOW RESULT NUMBER 
    ?>
            <main class="wset--main-banner">
                <img src="imgs/ic-img-0.png" alt="a blue computer with mouse on screen">
                <h1><?php echo $qtable ?></h1>
                <p>เข้าใช้งานเครื่องหมายเลข <?php echo $qtable ?> ในเวลา <?php echo $_POST["time"] ?></p>
                <p><a class="btn static-normal" href="index.php">รับทราบ!</a></p>
            </main>

        <?php } else { // ? IF NOT FREE TABLE 
        ?>
            <main class="wset--main-banner">
                <img src="imgs/ic-img-0.png" alt="a blue computer with mouse on screen">
                <h1>คอมพิวเตอร์ทั้งหมดถูกใช้งานอยู่</h1>
                <p>ลองเลื่อนเวลาไปอีกนิด!</p>
                <p><a class="btn static-normal" href="index.php">รับทราบ!</a></p>
            </main>

        <?php }  ?>
    <?php } else { ?>
        <main class="agtab qform">
            <form action="" method="POST">
                <header>ส่งคำขอใช้งาน</header>

                <?php if (isset($_GET["err"])) echo "<p class=err>{$_GET["err"]}</p>"; ?>
                <?php if (isset($_GET["msg"])) echo "<p class=msg>{$_GET["msg"]}</p>"; ?>

                <fieldset>
                    <label for="af-purpose">หัวข้อการใช้งาน</label>
                    <input type="text" name="purpose" id="af-purpose" placeholder="หัวข้อการใช้งาน" required>
                </fieldset>

                <fieldset>
                    <label for="af-time">เวลา</label>
                    <input type="time" name="time" id="af-time" required>
                </fieldset>

                <fieldset>
                    <label for="af-duration">ระยะเวลาในการใช้งาน</label>
                    <select name="duration" id="af-duration" required>
                        <option disabled selected>ระยะเวลา</option>
                        <option value="30">30 นาที</option>
                        <option value="60">1 ชั่วโมง</option>
                        <option value="120">2 ชั่วโมง</option>
                    </select>
                </fieldset>

                <button>ยืนยัน</button>
            </form>
        </main>
    <?php } ?>

</body>

</html>