<?php
session_start();
session_unset();
session_destroy();
header("Location: ../index.php"); // 👈 change to login.php only if always used from /admin
exit;

