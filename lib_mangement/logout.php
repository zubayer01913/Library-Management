<?php
session_start();
session_unset();
session_destroy();
header("Location:index.php?err=5");
exit();
?>
