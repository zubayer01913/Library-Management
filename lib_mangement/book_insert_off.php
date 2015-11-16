<?php require_once('Connections/lib_ss.php'); ?>

<html>
<head>
<title>Add Book</title>
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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO books (ref_number, book_name, book_writers, book_edition, book_isbn, book_avail, ebook_link, browed_to) VALUES (%s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['ref_number'], "text"),
                       GetSQLValueString($_POST['book_name'], "text"),
                       GetSQLValueString($_POST['book_writers'], "text"),
                       GetSQLValueString($_POST['book_edition'], "text"),
                       GetSQLValueString($_POST['book_isbn'], "text"),
                       GetSQLValueString($_POST['book_avail'], "int"),
                       GetSQLValueString($_POST['ebook_link'], "text"),
                       GetSQLValueString($_POST['browed_to'], "text"));

  mysql_select_db($database_lib_ss, $lib_ss);
  $Result1 = mysql_query($insertSQL, $lib_ss) or die(mysql_error());

  $insertGoTo = "book_index_off.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
?>


<body>
<div class="row">
    
    <center> <p><h3>Insert details of the book to add:</h3></p> </center>
    </div>

<script src="bootstrap.min.js"></script>
    
    
    <div class="col-xs-12 col-md-4 col-md-offset-4">
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1" data-toggle="validator">

  <div class="form-group">
    <label for="exampleInputEmail1">Referance Number:</label>
    <input pattern=".{1,8}"type="text" class="form-control" id="exampleInputEmail1" name="ref_number" placeholder="Referance Number:" required title="Book referance should contain 8 character number">
  </div>
  
  <div class="form-group">
    <label for="exampleInputEmail1">Book Name:</label>
    <input type="text" class="form-control" id="exampleInputEmail1" name="book_name" placeholder="Book Name" required>
  </div>
  
  <div class="form-group">
    <label for="exampleInputEmail1">Writers:</label>
    <input type="text" class="form-control" id="exampleInputEmail1"  name="book_writers" placeholder="Writers" required>
  </div>
  
  
  <div class="form-group">
    <label for="exampleInputEmail1">Edition:</label>
    <input pattern=".{3,5}" type="text" class="form-control" id="exampleInputEmail1"name="book_edition"  placeholder="Edition" required title="Book Edition should contain 3 to 5 characters">
  </div>
  
   <div class="form-group">
    <label for="exampleInputEmail1">ISBN:</label>
    <input type="text" pattern=".{13,13}" class="form-control" id="exampleInputEmail1" name="book_isbn" placeholder="ISBN" title="Book ISBN should contain 13 characters number">
  </div>
  
  <div class="form-group">
    <label for="exampleInputEmail1">Books Available:</label>
    <input pattern=".{1,2}" type="number" class="form-control" id="exampleInputEmail1" name="book_avail" placeholder="Books Available:" required title="Book referance should contain 1 to 2 character number">
	</div>
  
  
  <div class="form-group">
    <label for="exampleInputEmail1">E-book Link:</label>
    <input type="url" class="form-control" id="exampleInputEmail1" name="ebook_link" placeholder="E-book Link">
  </div>
  
 
  </div>
  
  
  
<div class="row">
    <div class="col-md-1 col-md-offset-4">
<input class="btn btn-success" type="submit"  name="submitBtn" id="submitBtn" value="Insert Book" />
        </div>

<div class="col-md-3 col-md-offset-1">
    <a href="official_index.php" class="btn btn-primary" role="button">Back to Home</a>
    </div>
</div>



  <input type="hidden" name="MM_insert" value="form1" />
</form>
</body>

</div>
</html>