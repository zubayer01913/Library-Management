<?php require_once('Connections/lib_ss.php'); ?>

<html>
<head>
<title>Update User</title>
</head>
    
<!-- <link rel="stylesheet" href="css/bootstrap.min.css"/> -->
<link rel="stylesheet" href="css/bootstrap.css"/>

<title>Admin Home</title>
    <style>
          body { background-color: #F6f6f6; }
        
        </style>
</head>


<div class="container">
<h1 style="text-align:center; color:#2CBFF4;">City University Library Manangement System

<div class="row">
<div class="col-md-2 col-md-offset-10">
    <a href="logout.php" class="btn btn-danger" role="button">Log out</a>  </h1>
</div>
        </div>

<center><mark>
<?php
session_start();
if(isset($_SESSION["access_level"]) && $_SESSION["access_level"]==0){
	echo "Hello ".$_SESSION["id"].". You are logged in as an admin.<br/>";
	}
else{
	header("Location:index.php?err=2");
	}
    ?> </mark></center>

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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE login_details SET password=%s, access_level=%s WHERE id=%s",
                       GetSQLValueString($_POST['password'], "text"),
                       GetSQLValueString($_POST['access_level'], "int"),
                       GetSQLValueString($_POST['id'], "text"));

  mysql_select_db($database_lib_ss, $lib_ss);
  $Result1 = mysql_query($updateSQL, $lib_ss) or die(mysql_error());

  $updateGoTo = "user_list_admin.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_rsUser = "-1";
if (isset($_GET['id'])) {
  $colname_rsUser = $_GET['id'];
}
mysql_select_db($database_lib_ss, $lib_ss);
$query_rsUser = sprintf("SELECT * FROM login_details WHERE id = %s", GetSQLValueString($colname_rsUser, "text"));
$rsUser = mysql_query($query_rsUser, $lib_ss) or die(mysql_error());
$row_rsUser = mysql_fetch_assoc($rsUser);
$totalRows_rsUser = mysql_num_rows($rsUser);
?>


<body>
<div class="row">
    
    <center><p><h3>Update User Details</h3></p> </center>
<center><h4><strong><mark>Officials ID:<?php echo $row_rsUser['id']; ?></mark></strong></h4> 
</center></div>
<p>&nbsp;</p>

<div class="col-xs-12 col-md-4 col-md-offset-4">

<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1" data-toggle="validator">


<div class="form-group">
    <label for="exampleInputEmail1">Password:</label>
    <input type="text" class="form-control" id="exampleInputEmail1" name="password" value="<?php echo htmlentities($row_rsUser['password'], ENT_COMPAT, 'utf-8'); ?>" required>
  </div>
  
<div class="form-group">
    <label for="exampleInputEmail1">Access Level:</label>
    <input type="number" class="form-control" id="exampleInputEmail1" name="access_level"  value="<?php echo htmlentities($row_rsUser['access_level'], ENT_COMPAT, 'utf-8'); ?>" required>
  </div>

<div class="row">
    <div class="col-md-2 col-md-offset-0">
<input class="btn btn-success" type="submit"  name="submitBtn" id="submitBtn" value="Update" />
        </div>

<div class="col-md-2 col-md-offset-5">
    <a href="user_list_admin.php" class="btn btn-primary" role="button">Back to User List</a>
    </div>
</div>
  

  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="id" value="<?php echo $row_rsUser['id']; ?>" />
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($rsUser);
?>
