<?php require_once('Connections/lib_ss.php'); ?>

<html>
<head>
<title>Officials Index</title>
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

<center><mark><strong>
<?php
session_start();
if(isset($_SESSION["access_level"]) && $_SESSION["access_level"]==1){
	echo "Hello ".$_SESSION["id"].". You are logged in as an official person.<br/>";
	}
else{
	header("Location:index.php?err=2");
	}
    ?> </strong> </mark></center></div>


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
  $updateSQL = sprintf("UPDATE students SET book_browed=%s WHERE std_id=%s",
                       GetSQLValueString($_POST['book_browed'], "text"),
                       GetSQLValueString($_POST['std_id'], "int"));

  mysql_select_db($database_lib_ss, $lib_ss);
  $Result1 = mysql_query($updateSQL, $lib_ss) or die(mysql_error());

  $updateGoTo = "student_index_off.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_rsStudent = "-1";
if (isset($_GET['std_id'])) {
  $colname_rsStudent = $_GET['std_id'];
}
mysql_select_db($database_lib_ss, $lib_ss);
$query_rsStudent = sprintf("SELECT * FROM students WHERE std_id = %s", GetSQLValueString($colname_rsStudent, "int"));
$rsStudent = mysql_query($query_rsStudent, $lib_ss) or die(mysql_error());
$row_rsStudent = mysql_fetch_assoc($rsStudent);
$totalRows_rsStudent = mysql_num_rows($rsStudent);
?>

<div class="container">
<body>

 <center><p><strong><h3>Update Students Book Browing Details</h3></strong></p> </center>
  <div class="row">
	<div class="col-xs-12 col-md-4 col-md-offset-4">
<h4><strong><mark>Student ID:<?php echo $row_rsStudent['std_id']; ?></mark></strong></h4>
<h4>Name:<?php echo $row_rsStudent['std_name']; ?></h4>
<h4>Program:<?php echo $row_rsStudent['std_prog']; ?></h4>
<h4>Batch:<?php echo $row_rsStudent['std_batch']; ?></h4>
</div>
</div>
<p>&nbsp;</p>

<div class="col-xs-12 col-md-4 col-md-offset-4">

<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1" data-toggle="validator">
 
 

<div class="form-group">
    <label for="exampleInputEmail1">Book Borrowed:</label>
    <input type="text" class="form-control" id="exampleInputEmail1" name="book_browed" value="<?php echo htmlentities($row_rsStudent['book_browed'], ENT_COMPAT, 'utf-8'); ?>" required>
  </div>
 
 <div class="row">
    <div class="col-md-2 col-md-offset-0">
<input class="btn btn-success" type="submit"  name="submitBtn" id="submitBtn" value="Update" />
        </div>

<div class="col-md-2 col-md-offset-4">
    <a href="student_index_off.php" class="btn btn-primary" role="button">Back to Students List</a>
    </div>
</div>
 
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="std_id" value="<?php echo $row_rsStudent['std_id']; ?>" />
</form>
<p>&nbsp;</p>
</div>
</body>
</div>
</html>
<?php
mysql_free_result($rsStudent);
?>
