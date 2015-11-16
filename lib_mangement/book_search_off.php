<?php require_once('Connections/lib_ss.php'); ?>

<html>
<head>
<title>Search Book</title>
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

$colname_rsBooks = "-1";
if (isset($_POST['ref_number'])) {
  $colname_rsBooks = $_POST['ref_number'];
}
mysql_select_db($database_lib_ss, $lib_ss);
$query_rsBooks = sprintf("SELECT * FROM books WHERE ref_number LIKE %s", GetSQLValueString("%" . $colname_rsBooks . "%", "text"));
$rsBooks = mysql_query($query_rsBooks, $lib_ss) or die(mysql_error());
$row_rsBooks = mysql_fetch_assoc($rsBooks);
$totalRows_rsBooks = mysql_num_rows($rsBooks);
?>


<body>
<div class="container">
<div class="row">
    
    <center> <p><h3>Search Books</h3></p>  <center>
    </div>

<script src="bootstrap.min.js"></script>
    
  
    
  <div class="col-md-4 col-md-offset-4">  
<form id="form1" name="form1" method="post" action="">
   
    <div class="form-group">
    <label for="exampleInputEmail1">Referance number</label>
    <input type="text" class="form-control" id="exampleInputEmail1" name="ref_number" placeholder="Referance number">  
  </div>
    <div class="col-md-2 col-md-offset-4">
<input class="btn btn-success" type="submit"  name="submitBtn" id="submitBtn" value="Search" />
        </div>
		
    </div>
       
    </form>

<p>&nbsp;</p>



<div class="row">
    
    <div class="col-md-2 col-md-offset-5"> <p><h3>List of Books</h3></p> </div>
    </div>

<div class="table-responsive">
<table class="table table-bordered" align="center">
  <tr class="success">
    <td>Referance Number</td>
    <td>Book Name</td>
    <td>Writers</td>
    <td>Edition</td>
    <td>ISBN</td>
    <td>Books Available</td>
    <td>E-Book Link</td>
    <td>Borrowed By</td>
    <td class="danger">Update/Delete</td>
  </tr>



  <?php do { ?>
    <tr>
      <td><?php echo $row_rsBooks['ref_number']; ?></td>
      <td><?php echo $row_rsBooks['book_name']; ?></td>
      <td><?php echo $row_rsBooks['book_writers']; ?></td>
      <td><?php echo $row_rsBooks['book_edition']; ?></td>
      <td><?php echo $row_rsBooks['book_isbn']; ?></td>
      <td><?php echo $row_rsBooks['book_avail']; ?></td>
      <td><?php echo $row_rsBooks['ebook_link']; ?></td>
      <td><?php echo $row_rsBooks['browed_to']; ?></td>
      <td class="warning"><a href="book_update_err_off.php?ref_number=<?php echo $row_rsBooks['ref_number']; ?>"> Error Update</a> | 
      <a href="book_update_brw_off.php?ref_number=<?php echo $row_rsBooks['ref_number']; ?>"> Brow Update</a> | 
      <a onclick="return confirm('Are you sure to delete this book from library  database?')" href="book_delete_off.php?ref_number=<?php echo $row_rsBooks['ref_number']; ?>"> Delete</a></td>
    </tr>
    <?php } while ($row_rsBooks = mysql_fetch_assoc($rsBooks)); ?>
</table>

<center>
    <a href="official_index.php" class="btn btn-primary" role="button">Back to Home</a>
    </center>

</body>
</html>
<?php
mysql_free_result($rsBooks);
?>
