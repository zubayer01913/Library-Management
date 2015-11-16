<?php require_once('Connections/lib_ss.php'); ?>

<html>
<head>
<title>Update Book Details</title>
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
  $updateSQL = sprintf("UPDATE books SET book_name=%s, book_writers=%s, book_edition=%s, book_isbn=%s, book_avail=%s, ebook_link=%s, browed_to=%s WHERE ref_number=%s",
                       GetSQLValueString($_POST['book_name'], "text"),
                       GetSQLValueString($_POST['book_writers'], "text"),
                       GetSQLValueString($_POST['book_edition'], "text"),
                       GetSQLValueString($_POST['book_isbn'], "text"),
                       GetSQLValueString($_POST['book_avail'], "int"),
                       GetSQLValueString($_POST['ebook_link'], "text"),
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


<body>

<div class="container">

<div class="row">
    
    <center><p><b><h3>Update Student Details</h3></b></p> </center>
<center><h4><strong><mark>Referance Number: <?php echo $row_rsBook['ref_number']; ?></mark></strong></h4> 
</center></div>
<p>&nbsp;</p>


<div class="col-xs-12 col-md-4 col-md-offset-4">

<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
 
 
 <div class="form-group" data-toggle="validator">
    <label for="exampleInputEmail1">Book Name:</label>
    <input type="text" class="form-control" id="exampleInputEmail1" name="book_name" value="<?php echo htmlentities($row_rsBook['book_name'], ENT_COMPAT, 'utf-8'); ?>">
  </div>
  
    <div class="form-group">
    <label for="exampleInputEmail1">Writers:</label>
    <input type="text" class="form-control" id="exampleInputEmail1" name="book_writers" value="<?php echo htmlentities($row_rsBook['book_writers'], ENT_COMPAT, 'utf-8'); ?>" required>
  </div>
  
  <div class="form-group">
    <label for="exampleInputEmail1">Edition:</label>
    <input pattern=".{3,5}" type="text" class="form-control" id="exampleInputEmail1" name="book_edition" value="<?php echo htmlentities($row_rsBook['book_edition'], ENT_COMPAT, 'utf-8'); ?>" required title="Book edition should contain 3 to 5 characters">
  </div>
  
  <div class="form-group">
    <label for="exampleInputEmail1">ISBN:</label>
    <input pattern=".{13,13}" type="text" class="form-control" id="exampleInputEmail1" name="book_isbn" value="<?php echo htmlentities($row_rsBook['book_isbn'], ENT_COMPAT, 'utf-8'); ?>" required title="Book ISBN should contain 13 character number">
  </div>
  
  <div class="form-group">
    <label for="exampleInputEmail1">Books Available:</label>
    <input pattern=".{1,2}" type="number" class="form-control" id="exampleInputEmail1" name="book_avail" value="<?php echo htmlentities($row_rsBook['book_avail'], ENT_COMPAT, 'utf-8'); ?>" required title="Book available should contain 1 to 2 character number">
  </div>
  
  
  <div class="form-group">
    <label for="exampleInputEmail1">E-book link:</label>
    <input type="url" class="form-control" id="exampleInputEmail1" name="ebook_link" value="<?php echo htmlentities($row_rsBook['ebook_link'], ENT_COMPAT, 'utf-8'); ?>" >
  </div>
  
  <div class="form-group">
    <label for="exampleInputEmail1">Borrowed to:</label>
    <input pattern=".{8,8}" type="number" class="form-control" id="exampleInputEmail1" name="browed_to" value="<?php echo htmlentities($row_rsBook['browed_to'], ENT_COMPAT, 'utf-8'); ?>" required title="Book borrowed to should contain 8 character number">
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
</html>
<?php
mysql_free_result($rsBook);
?>
