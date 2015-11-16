<?php require_once('Connections/lib_ss.php'); ?>

<html>
<head>
<title>Update Student Details</title>
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
  $updateSQL = sprintf("UPDATE students SET std_name=%s, std_dob=%s, std_prog=%s, std_batch=%s, std_mob=%s, std_mail=%s, std_pass=%s, book_browed=%s WHERE std_id=%s",
                       GetSQLValueString($_POST['std_name'], "text"),
                       GetSQLValueString($_POST['std_dob'], "date"),
                       GetSQLValueString($_POST['std_prog'], "text"),
                       GetSQLValueString($_POST['std_batch'], "text"),
                       GetSQLValueString($_POST['std_mob'], "text"),
                       GetSQLValueString($_POST['std_mail'], "text"),
                       GetSQLValueString($_POST['std_pass'], "text"),
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

<div class="row">
    
    <center><p><h3>Update Student Details</h3></p> </center>
<center><h4><strong><mark>Student ID:<?php echo $row_rsStudent['std_id']; ?></mark></strong></h4> 
</center></div>
<p>&nbsp;</p>

<div class="col-xs-12 col-md-4 col-md-offset-4">

<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1" data-toggle="validator">
 
 
 <div class="form-group">
    <label for="exampleInputEmail1">Student Name::</label>
    <input type="text" class="form-control" id="exampleInputEmail1" name="std_name" value="<?php echo htmlentities($row_rsStudent['std_name'], ENT_COMPAT, 'utf-8'); ?>" required>
  </div>
  
<div class="form-group">
    <label for="exampleInputEmail1">Date of Birth:</label>
    <input type="date" class="form-control" id="exampleInputEmail1" name="std_dob" value="<?php echo htmlentities($row_rsStudent['std_dob'], ENT_COMPAT, 'utf-8'); ?>" required>
  </div>
  
  <div class="form-group">
    <label for="exampleInputEmail1">Program:</label>
    <input pattern=".{3,11}" type="text" class="form-control" id="exampleInputEmail1" name="std_prog" value="<?php echo htmlentities($row_rsStudent['std_prog'], ENT_COMPAT, 'utf-8'); ?>" required title="Program should contain 3 to 11 characters number">
  </div>
  
  <div class="form-group">
    <label for="exampleInputEmail1">Batch:</label>
    <input pattern=".{3,6}" type="text" class="form-control" id="exampleInputEmail1" name="std_batch" value="<?php echo htmlentities($row_rsStudent['std_batch'], ENT_COMPAT, 'utf-8'); ?>" required title="Batch should contain 3 to 6 characters number">
  </div>
  
  <div class="form-group">
    <label for="exampleInputEmail1">Mobile:</label>
    <input pattern=".{11,11}" type="number" class="form-control" id="exampleInputEmail1" name="std_mob" value="<?php echo htmlentities($row_rsStudent['std_mob'], ENT_COMPAT, 'utf-8'); ?>" required title="Mobile Number should contain 11 characters number">
  </div>
  
  <div class="form-group">
    <label for="exampleInputEmail1">E-mail:</label>
    <input type="email" class="form-control" id="exampleInputEmail1" name="std_mail" value="<?php echo htmlentities($row_rsStudent['std_mail'], ENT_COMPAT, 'utf-8'); ?>" required>
  </div>
  
  <div class="form-group">
    <label for="exampleInputEmail1">Password:</label>
    <input pattern=".{8,16}" type="text" class="form-control" id="exampleInputEmail1" name="std_pass" value="<?php echo htmlentities($row_rsStudent['std_pass'], ENT_COMPAT, 'utf-8'); ?>" required title="Password should contain 8 to 16 characters number">
  </div>
  
  <div class="form-group">
    <label for="exampleInputEmail1">Book Borrowed:</label>
    <input pattern=".{0}|.{8,8}" type="text" class="form-control" id="exampleInputEmail1" name="book_browed" value="<?php echo htmlentities($row_rsStudent['book_browed'], ENT_COMPAT, 'utf-8'); ?>" required title="Book referance should contain 8 character number">
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
