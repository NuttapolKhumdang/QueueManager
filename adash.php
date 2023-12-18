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

    <main class="admintable--admin-mainview">
        <h2>จัดการระบบ</h2>

        <menu>
            <p>ทั้วไป</p>
            <a href="aview.php?history">
                <span class="material-icons-round">history</span>
                <p>ประวัติการใช้งาน</p>
            </a>

            <a href="aview.php?accounts">
                <span class="material-icons-round">manage_accounts</span>
                <p>บัญชีผู้ใช้ทั้งหมด</p>
            </a>

            <a href="auadd.php">
                <span class="material-icons-round">person_add</span>
                <p>เพิ่มบัญชีผู้ใช้</p>
            </a>

            <p>จัดการคอมพิวเตอร๋</p>
            <div class="field infield">
                <section>
                    <span class="material-icons-round">view_list</span>
                    <p>จำนวนคอมพิวเตอร์</p>
                </section>

                <form action="update_config.php?key=table_count" method="POST">
                    <input type="number" min=0 name="value" value="<?php echo get_config($conn, "table_count") ?>">
                    <button title="บันทึก"><span class="material-icons-round">upgrade</span></button>
                </form>
            </div>

            <p>บัญชี</p>
            <a href="auth.php?logout">
                <span class="material-icons-round">logout</span>
                <p>ออกจากระบบ</p>
            </a>

        </menu>
    </main>
</body>

</html>