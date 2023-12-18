<header class="masterhead">
    <h3 onclick="window.location.href = '/wings'">หน้าหลัก</h3>

    <menu>
        <?php if (isAuth(redirect: false)) { ?>
            <?php if (isAuth(true, redirect: false)) { // TODO: IF ADMIN
            ?>
                <a class="btn" href="auth.php?admin"><?php echo $_SESSION["name"] ?></a>
            <?php  } else {  // TODO: IF NOT ADMIN 
            ?>
                <a class="btn" href="auth.php?logout"><?php echo $_SESSION["name"] ?></a>
            <?php } ?>
        <?php  } else { // TODO: IF NOT AUTHED
        ?>
            <a class="btn" href="auth.php?login">เข้าสู่ระบบ</a>
        <?php } ?>
    </menu>
</header>