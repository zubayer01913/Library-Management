<?php require_once('Connections/lib_ss.php'); ?>
<?php
session_start();
if(isset($_SESSION["access_level"]) && $_SESSION["access_level"]==0){
	echo "Hello ".$_SESSION["id"]." This is admin page.<br/><a href='logout.php'>Logout</a>";
	}
else{
	header("Location:index.php?err=2");
	}
?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

if ((isset($_GET['off_id'])) && ($_GET['off_id'] != "")) {
  $deleteSQL = sprintf("DELETE FROM officials WHERE off_id=%s",
                       GetSQLValueString($_GET['off_id'], "int"));

  mysql_select_db($database_lib_ss, $lib_ss);
  $Result1 = mysql_query($deleteSQL, $lib_ss) or die(mysql_error());

  $deleteGoTo = "officials_index_admin.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
    $deleteGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $deleteGoTo));
}
?>
