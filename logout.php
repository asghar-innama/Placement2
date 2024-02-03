<?php
session_start();
session_unset();
session_destroy();
header("location:/Placement2/index.php");
exit();
?>