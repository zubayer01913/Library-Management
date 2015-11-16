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
  $updateSQL = sprintf("UPDATE books SET book_avail=%s, browed_to=%s WHERE ref_number=%s",
                       GetSQLValueString($_POST['book_avail'], "int"),
                       GetSQLValueString($_POST['browed_to'], "text"),
                       GetSQLValueString($_POST['ref_number'], "text"));

  mysql_select_db($database_lib_ss, $lib_ss);
  $Result1 = mysql_query($updateSQL, $lib_ss) or die(mysql_error());

  $updateGoTo = "book_index_off.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_rsBook = "-1";
if (isset($_GET['ref_number'])) {
  $colname_rsBook = $_GET['ref_number'];
}
mysql_select_db($database_lib_ss, $lib_ss);
$query_rsBook = sprintf("SELECT * FROM books WHERE ref_number = %s", GetSQLValueString($colname_rsBook, "text"));
$rsBook = mysql_query($query_rsBook, $lib_ss) or die(mysql_error());
$row_rsBook = mysql_fetch_assoc($rsBook);
$totalRows_rsBook = mysql_num_rows($rsBook);
?>


<div class="container">
<body>

 <center><p><strong><h3>Update Book's brrowing details</h3></strong></p> </center>
  <div class="row">
	<div class="col-xs-12 col-md-4 col-md-offset-4">
	
<h4><strong><mark>Referance Number:<?php echo $row_rsBook['ref_number']; ?></mark></strong></h4>
<h4>Book Name:<?php echo $row_rsBook['book_name']; ?></h4>
<h4>Writers:<?php echo $row_rsBook['book_writers']; ?></h4>
<h4>Edition:<?php echo $row_rsBook['book_edition']; ?></h4>
<h4>ISBN:<?php echo $row_rsBook['book_isbn']; ?></h4>
<h4>E-book link:<?php echo $row_rsBook['ebook_link']; ?></h4>
</div>
</div>
<p>&nbsp;</p>

<div class="col-xs-12 col-md-4 col-md-offset-4">

<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
 
 <div class="form-group" data-toggle="validator">
    <label for="exampleInputEmail1">Books Available:</label>
    <input type="number" class="form-control" id="exampleInputEmail1" name="book_avail" value="<?php echo htmlentities($row_rsBook['book_avail'], ENT_COMPAT, 'utf-8'); ?>" required>
  </div>
  
  <div class="form-group">
    <label for="exampleInputEmail1">Borrowed by:</label>
    <input type="number" class="form-control" id="exampleInputEmail1" name="browed_to" value="<?php echo htmlentities($row_rsBook['browed_to'], ENT_COMPAT, 'utf-8'); ?>" required>
  </div>
 
  <div class="row">
    <div class="col-md-2 col-md-offset-0">
<input class="btn btn-success" type="submit"  name="submitBtn" id="submitBtn" value="Update" />
        </div>

<div class="col-md-2 col-md-offset-5">
    <a href="book_index_off.php" class="btn btn-primary" role="button">Back to Book List</a>
    </div>
</div>
 
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="ref_number" value="<?php echo $row_rsBook['ref_number']; ?>" />
</form>
<p>&nbsp;</p>
</body>
</div>
</div>
</html>
<?php
mysql_free_result($rsBook);
?>
