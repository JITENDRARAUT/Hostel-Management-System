<?php
session_start();
session_destroy();
header("Location: wardenlogin.html");
exit();
?>
