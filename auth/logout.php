<?php 

session_start();
session_destroy();
header("Location: ../auth.php?msg=ออกจากระบบแล้ว");