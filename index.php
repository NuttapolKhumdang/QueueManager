<?php include("configs/config.php") ?>
<?php include("configs/db.php") ?>

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

    <?php if (!isAuth(false, false)) { ?>
        <main class="wset--main-banner">
            <img src="imgs/ic-img-0.png" alt="a blue computer with mouse on screen">
            <h1>เข้าสู่ระบบก่อนดำเนินการต่อ</h1>
            <p><a class="btn static-normal" href="auth.php?login">เข้าสู่ระบบ</a></p>
        </main>

    <?php } else { ?>
        <main class="wset--main-banner">
            <img src="imgs/ic-img-0.png" alt="a blue computer with mouse on screen">
            <h1>ประวัติการใช้งาน</h1>
            <p><a class="btn static-normal" href="markq.php">ขอใช้งาน</a></p>
        </main>

        <main class="wset--main-table-list">
            <table>
                <tr>
                    <th class="center">หมายเลขโต๊ะ</th>
                    <th class="center">วันที่ - เวลา</th>
                    <th class="center">ระยะเวลา</th>
                </tr>

                <?php $result = $conn->query("SELECT * FROM history WHERE `user` = '{$_SESSION["ID"]}' ORDER BY `ID` DESC"); ?>

                <?php while ($r = $result->fetch_assoc()) { ?>
                    <?php
                    $rdate = new DateTime($r["date"]);
                    $rdate = $rdate->format("d/m/Y");

                    $rtime = new DateTime($r["start"]);
                    $rtime = $rtime->format("H:i");

                    $rnumber = $r["number"];

                    $rduration;
                    if ($r["duration"] == '30') $rduration = '30 นาที';
                    else if ($r["duration"] == '60') $rduration = '1 ชั้วโมง';
                    else if ($r["duration"] == '120') $rduration = '2 ชั้วโมง';
                    ?>

                    <tr>
                        <td style="width: 20%;" class="center"><?php echo $rnumber ?></td>
                        <td style="width: 40%;" class="center"><?php echo $rdate . ' ' . $rtime ?></td>
                        <td style="width: 40%;" class="center"><?php echo $rduration ?></td>
                    </tr>
                <?php } ?>
            </table>
        </main>

        <?php if ($result->num_rows == 0) { ?>
            <main class="wset--main-banner">
                <h4>ยังไม่มีการใช้งาน</h4>
            </main>
        <?php } ?>
    <?php } ?>
</body>

</html>