<?php include('configs/config.php') ?>
<?php

if (isset($_GET["logout"])) {
    header("Location: auth/logout.php");
}

if (isset($_GET["admin"])) {
    header("Location: adash.php");
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

    <?php if (isset($_GET["register"])) { ?>
        <main class="agtab qform">
            <form action="auth/regis.php" method="POST">
                <header>สมัครสมาชิก</header>

                <?php if (isset($_GET["err"])) echo "<p class=err>{$_GET["err"]}</p>"; ?>
                <?php if (isset($_GET["msg"])) echo "<p class=msg>{$_GET["msg"]}</p>"; ?>

                <fieldset>
                    <label for="af-prename">คำนำหน้า</label>
                    <select name="pname" id="af-prename">
                        <option disabled selected>คำนำหน้า</option>
                        <option value="เด็กชาย">เด็กชาย</option>
                        <option value="เด็กหญิง">เด็กหญิง</option>
                        <option value="นาย">นาย</option>
                        <option value="นาง">นาง</option>
                        <option value="นางสาว">นางสาว</option>
                    </select>
                </fieldset>

                <fieldset>
                    <label for="af-aname">ชื่อ - นามสกุล</label>
                    <input type="text" name="name" id="af-aname" placeholder="ชื่อ - นามสกุล">
                </fieldset>

                <fieldset>
                    <label for="af-email">อีเมล์</label>
                    <input type="text" name="email" id="af-email" placeholder="อีเมล์">
                </fieldset>

                <fieldset>
                    <label for="af-passw">รหัสผ่าน</label>
                    <input type="password" name="password" id="af-passw" placeholder="รหัสผ่าน">
                </fieldset>

                <button>ถัดไป</button>
                <p>มีบัญชีแล้ว? <a href="?login">เข้าสู่ระบบ</a></p>
            </form>
        </main>

    <?php } else if (isset($_GET["forget"])) { ?>
        <main class="agtab qform">
            <form action="?login">
                <header>ลืมรหัสผ่านงั้นเหรอ?</header>
                <h1>ลองทำใจเย็นๆ นั่งพักซักครู่ หลับตา แล้วพยามนึกอีกครั้ง</h1>
                <p>สู้ๆ นะ!</p>
                <button>นึกออกแล้ว!</button>
            </form>
        </main>

    <?php } else { ?>
        <main class="agtab qform">
            <form action="auth/login.php" method="POST">
                <header>เข้าสู่ระบบ</header>

                <?php if (isset($_GET["err"])) echo "<p class=err>{$_GET["err"]}</p>"; ?>
                <?php if (isset($_GET["msg"])) echo "<p class=msg>{$_GET["msg"]}</p>"; ?>

                <fieldset>
                    <label for="af-email">อีเมล์</label>
                    <input type="text" name="email" id="af-email" placeholder="อีเมล์">
                </fieldset>

                <fieldset>
                    <label for="af-passw">รหัสผ่าน</label>
                    <input type="password" name="password" id="af-passw" placeholder="รหัสผ่าน">
                </fieldset>

                <button>ถัดไป</button>
                <p>ยังไม่มีบัญชี? <a href="?register">สมัครสมาชิก</a></p>
            </form>
        </main>
    <?php } ?>
</body>

</html>