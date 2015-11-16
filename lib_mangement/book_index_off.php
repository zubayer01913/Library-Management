<?php require_once('Connections/lib_ss.php'); ?>

<html>
<head>
<title>Book Index</title>
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
    ?> </strong> </mark></center>
	</div>


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

mysql_select_db($database_lib_ss, $lib_ss);
$query_rsBooks = "SELECT * FROM books";
$rsBooks = mysql_query($query_rsBooks, $lib_ss) or die(mysql_error());
$row_rsBooks = mysql_fetch_assoc($rsBooks);
$totalRows_rsBooks = mysql_num_rows($rsBooks);
?>

<div class="container">
<body>
<div class="row">
    
    <div class="col-md-2 col-md-offset-5"> <p><h3>List of Books</h3></p> </div>
    </div>

<div class="table-responsive">
<table class="table table-bordered" align="center">
  <tr class="success">
    <td><b>Referance Number</b></td>
    <td><b>Book Name</b></td>
    <td><b>Writers</b></td>
    <td><b>Edition</b></td>
    <td><b>ISBN</b></td>
    <td><b>Books Available</b></td>
    <td><b>E-book link</td>
    <td><b>Borrowed to</b></td>
    <td class="danger"><b>Update/Delete</b></td>
  </tr>


  <?php do { ?>
    <tr class="info">
      <td><?php echo $row_rsBooks['ref_number']; ?></td>
      <td><?php echo $row_rsBooks['book_name']; ?></td>
      <td><?php echo $row_rsBooks['book_writers']; ?></td>
      <td><?php echo $row_rsBooks['book_edition']; ?></td>
      <td><?php echo $row_rsBooks['book_isbn']; ?></td>
      <td><?php echo $row_rsBooks['book_avail']; ?></td>
      <td><?php echo $row_rsBooks['ebook_link']; ?></td>
      <td><?php echo $row_rsBooks['browed_to']; ?></td>
      <td class="warning"><a href="book_update_err_off.php?ref_number=<?php echo $row_rsBooks['ref_number']; ?>"> Error Update</a> | 
     <!-- <a href="book_update_brw_off.php?ref_number=<?php echo $row_rsBooks['ref_number']; ?>"> Borrow Update</a> | -->
      <a onclick="return confirm('Are you sure to delete this book from library  database?')" href="book_delete_off.php?ref_number=<?php echo $row_rsBooks['ref_number']; ?>"> Delete</a></td>
    </tr>
	
    <?php } while ($row_rsBooks = mysql_fetch_assoc($rsBooks)); ?>
</table>

<div class="col-md-2 col-md-offset-5">
    <a href="official_index.php" class="btn btn-primary" role="button">Back to Home</a>
    </div>
    </div>
	
</body>
</div>
</html>
<?php
mysql_free_result($rsBooks);
?>
