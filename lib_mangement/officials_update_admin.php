<?php require_once('Connections/lib_ss.php'); ?>

<html>
<head>
<title>Update Official</title>
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
  $updateSQL = sprintf("UPDATE officials SET off_name=%s, off_dob=%s, off_desig=%s, off_mob=%s, off_mail=%s, off_pass=%s WHERE off_id=%s",
                       GetSQLValueString($_POST['off_name'], "text"),
                       GetSQLValueString($_POST['off_dob'], "date"),
                       GetSQLValueString($_POST['off_desig'], "text"),
                       GetSQLValueString($_POST['off_mob'], "text"),
                       GetSQLValueString($_POST['off_mail'], "text"),
                       GetSQLValueString($_POST['off_pass'], "text"),
                       GetSQLValueString($_POST['off_id'], "int"));

  mysql_select_db($database_lib_ss, $lib_ss);
  $Result1 = mysql_query($updateSQL, $lib_ss) or die(mysql_error());

  $updateGoTo = "officials_index_admin.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_rsOfficials = "-1";
if (isset($_GET['off_id'])) {
  $colname_rsOfficials = $_GET['off_id'];
}
mysql_select_db($database_lib_ss, $lib_ss);
$query_rsOfficials = sprintf("SELECT * FROM officials WHERE off_id = %s", GetSQLValueString($colname_rsOfficials, "int"));
$rsOfficials = mysql_query($query_rsOfficials, $lib_ss) or die(mysql_error());
$row_rsOfficials = mysql_fetch_assoc($rsOfficials);
$totalRows_rsOfficials = mysql_num_rows($rsOfficials);
?>



<body>
<div class="row">
    
    <center><p><h3>Update Officials Details</h3></p> </center>
	<center><h4><strong><mark>Officials ID:<?php echo $row_rsOfficials['off_id']; ?></mark></strong></h4> </div>
</center>

<div class="col-xs-12 col-md-4 col-md-offset-4">

<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1" data-toggle="validator">

<div class="form-group">
    <label for="exampleInputEmail1">Name:</label>
    <input type="text" class="form-control" id="exampleInputEmail1" name="off_name" placeholder="Officials Name" value="<?php echo htmlentities($row_rsOfficials['off_name'], ENT_COMPAT, 'utf-8'); ?>" required>
  </div>
  
<div class="form-group">
    <label for="exampleInputEmail1">Date of Birth:</label>
    <input type="text" class="form-control" id="exampleInputEmail1" name="off_dob" placeholder="Officials Name" value="<?php echo htmlentities($row_rsOfficials['off_dob'], ENT_COMPAT, 'utf-8'); ?>" required>
  </div>
  
  <div class="form-group">
    <label for="exampleInputEmail1">Designation:</label>
    <input type="text" class="form-control" id="exampleInputEmail1" name="off_desig" placeholder="Officials Name" value="<?php echo htmlentities($row_rsOfficials['off_desig'], ENT_COMPAT, 'utf-8'); ?>" required>
  </div>
  
  <div class="form-group">
    <label for="exampleInputEmail1">Mobile:</label>
    <input type="number" class="form-control" id="exampleInputEmail1" name="off_mob" placeholder="Officials Name" value="<?php echo htmlentities($row_rsOfficials['off_mob'], ENT_COMPAT, 'utf-8'); ?>" required>
  </div>
  
 <div class="form-group">
    <label for="exampleInputEmail1">E-mail:</label>
    <input type="email" class="form-control" id="exampleInputEmail1" name="off_mail" placeholder="Officials Name" value="<?php echo htmlentities($row_rsOfficials['off_mail'], ENT_COMPAT, 'utf-8'); ?>" required>
  </div>
  
<div class="form-group">
    <label for="exampleInputEmail1">Password:</label>
    <input type="text" class="form-control" id="exampleInputEmail1" name="off_pass" placeholder="Officials Name" value="<?php echo htmlentities($row_rsOfficials['off_pass'], ENT_COMPAT, 'utf-8'); ?>" required>
  </div>
  
<div class="row">
    <div class="col-md-2 col-md-offset-0">
<input class="btn btn-success" type="submit"  name="submitBtn" id="submitBtn" value="Update" />
        </div>

<div class="col-md-2 col-md-offset-6">
    <a href="officials_index_admin.php" class="btn btn-primary" role="button">Back to Index</a>
    </div>
</div>

  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="off_id" value="<?php echo $row_rsOfficials['off_id']; ?>" />
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($rsOfficials);
?>
