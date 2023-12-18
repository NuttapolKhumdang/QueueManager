<?php include("configs/config.php") ?>
<?php include("configs/db.php") ?>
<?php isAuth(true) ?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["CSV"])) {
    $x = account_upload_CSV($conn, $_POST["CSV"]);

    if ($x === true)
        header("Location: auadd.php?msg=เพิ่มบัญชีผู้ใช้สำเร็จ");
}
?>

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
    <main class="agtab qform">
        <form action="" method="POST">
            <header>เพิ่มบัญชีผู้ใช้</header>

            <?php if (isset($_GET["err"])) echo "<p class=err>{$_GET["err"]}</p>"; ?>
            <?php if (isset($_GET["msg"])) echo "<p class=msg>{$_GET["msg"]}</p>"; ?>

            <fieldset>
                <label for="af-csv-field">นำเข้าจาก CSV</label>
                <textarea name="CSV" id="af-csv-field" placeholder="คำนำหน้า, ชื่อ - นามสกุล, อีเมล์, รหัสผ่าน, สถานะ"></textarea>
            </fieldset>

            <button>ถัดไป</button>
            <p><a href="adash.php">ยกเลิก</a></p>
        </form>
    </main>

</body>

</html>