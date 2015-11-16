<?php
error_reporting(0); // Turn off all error reporting
?>
<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_lib_ss = "localhost";
$database_lib_ss = "lib_ss";
$username_lib_ss = "lib_ss";
$password_lib_ss = "shsagor";
$lib_ss = mysql_pconnect($hostname_lib_ss, $username_lib_ss, $password_lib_ss) or trigger_error(mysql_error(),E_USER_ERROR); 
?>