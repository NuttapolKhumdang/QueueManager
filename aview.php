<?php include('configs/config.php') ?>
<?php include('configs/db.php') ?>
<?php isAuth(true); ?>

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

    <?php if (isset($_GET["history"])) { // TODO: Render using history
    ?>

        <?php
        if (isset($_GET["uid"]))
            $u = $conn->query("SELECT * FROM user WHERE ID='{$_GET["uid"]}'")->fetch_array();
        ?>

        <main class="wset--main-banner">
            <img src="imgs/ic-img-0.png" alt="a blue computer with mouse on screen">
            <h1>ประวัติการใช้งาน</h1>

            <?php if (isset($_GET["uid"])) { ?>
                <?php
                $pname = $u["pname"];
                $name = $pname . $u["name"];
                ?>

                <p><?php echo $name ?></p>
            <?php } ?>
        </main>

        <main class="wset--main-table-list">
            <table>
                <tr>
                    <th class="center">ลำดับ</th>
                    <th class="center">ผู้ใช้</th>
                    <th class="center">หมายเลข</th>
                    <th class="center">วันที่ - เวลา</th>
                    <th class="center">ระยะเวลา</th>
                </tr>

                <?php
                if (isset($_GET["uid"]))
                    $result = $conn->query("SELECT * FROM history WHERE `user`= '{$_GET["uid"]}' ORDER BY `ID` DESC");
                else
                    $result = $conn->query("SELECT * FROM history ORDER BY `ID` DESC");
                ?>

                <?php while ($r = $result->fetch_assoc()) { ?>
                    <?php
                    $rindex = $r["ID"];
                    $rnumber = $r["number"];

                    $rdate = new DateTime($r["date"]);
                    $rdate = $rdate->format("d/m/Y");

                    $rtime = new DateTime($r["start"]);
                    $rtime = $rtime->format("H:i");

                    $ruser = $conn->query("SELECT `name` FROM user WHERE `ID`={$r["user"]}")->fetch_array()["name"];

                    $rduration;
                    if ($r["duration"] == '30') $rduration = '30 นาที';
                    else if ($r["duration"] == '60') $rduration = '1 ชั้วโมง';
                    else if ($r["duration"] == '120') $rduration = '2 ชั้วโมง';
                    ?>

                    <tr>
                        <td style="width: 10%;" class="center"><?php echo $rindex ?></td>
                        <td style="width: 20%;" class="center"><?php echo $ruser ?></td>
                        <td style="width: 10%;" class="center"><?php echo $rnumber ?></td>
                        <td style="width: 30%;" class="center"><?php echo $rdate . ' ' . $rtime ?></td>
                        <td style="width: 30%;" class="center"><?php echo $rduration ?></td>
                    </tr>
                <?php } ?>
            </table>
        </main>

        <?php if ($result->num_rows == 0) { ?>
            <main class="wset--main-banner">
                <h4>ยังไม่มีการใช้งาน</h4>
            </main>
        <?php } ?>
    <?php
    }
    if (isset($_GET["accounts"])) { // TODO: Render all of accounts
    ?>
        <main class="wset--main-banner">
            <img src="imgs/ic-img-0.png" alt="a blue computer with mouse on screen">
            <h1>บัญชีผู้ใช้ทั้งหมด</h1>
        </main>

        <main class="wset--main-table-list">
            <table>
                <tr>
                    <th class="center">ลำดับ</th>
                    <th class="left">ชื่อผู้ใช้</th>
                    <th class="center">สถานะ</th>
                    <th class="center">เพิ่มเติม</th>
                </tr>

                <?php $result = $conn->query("SELECT * FROM `user` ORDER BY `ID`"); ?>

                <?php while ($r = $result->fetch_assoc()) { ?>
                    <?php
                    $rindex = $r["ID"];
                    $rname = $r["name"];

                    $rlevel = $r["level"];
                    $rstatus = null;

                    if ($rlevel == "A") $rstatus = "ผู้ดูแลระบบ";
                    else if ($rlevel == "U") $rstatus = "ผู้ใช้งาน";
                    ?>

                    <tr>
                        <td style="width: 10%;" class="center"><?php echo $rindex ?></td>
                        <td style="width: 40%;" class="left"><?php echo $rname ?></td>
                        <td style="width: 20%;" class="center"><?php echo $rstatus ?></td>
                        <td style="width: 30%;" class="center">
                            <a class="static-inline" href="?history&uid=<?php echo $rindex ?>" title="รายละเอียด">
                                <span class="material-icons-round">read_more</span>
                            </a>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </main>
    <?php } ?>
</body>

</html>