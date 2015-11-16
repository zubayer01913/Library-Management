<?php require_once('Connections/lib_ss.php'); ?>

<html>
<head>
<title>Add Student</title>
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
  $insertSQL = sprintf("INSERT INTO students (std_id, std_name, std_dob, std_prog, std_batch, std_mob, std_mail, std_pass, book_browed) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['std_id'], "int"),
                       GetSQLValueString($_POST['std_name'], "text"),
                       GetSQLValueString($_POST['std_dob'], "date"),
                       GetSQLValueString($_POST['std_prog'], "text"),
                       GetSQLValueString($_POST['std_batch'], "text"),
                       GetSQLValueString($_POST['std_mob'], "text"),
                       GetSQLValueString($_POST['std_mail'], "text"),
                       GetSQLValueString($_POST['std_pass'], "text"),
                       GetSQLValueString($_POST['book_browed'], "text"));

  mysql_select_db($database_lib_ss, $lib_ss);
  $Result1 = mysql_query($insertSQL, $lib_ss) or die(mysql_error());

  $insertGoTo = "student_index_off.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
?>


<body>
<div class="row">
    
    <div class="col-md-3 col-md-offset-5"> <p><h3>Insert Students Details</h3></p> </div>
    </div>

<script src="bootstrap.min.js"></script>
    
    
    <div class="col-xs-12 col-md-4 col-md-offset-4">
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">

  <div class="form-group" data-toggle="validator">
    <label for="exampleInputEmail1">ID</label>
    <input pattern=".{8,8}" type="number" class="form-control" id="exampleInputEmail1" name="std_id" placeholder="Student ID" required title="Student ID should contain 8 characters number">
  </div>
  
  <div class="form-group">
    <label for="exampleInputEmail1">Name</label>
    <input type="text" class="form-control" id="exampleInputEmail1" name="std_name" placeholder="Student Name" required>
  </div>
  
  <div class="form-group">
    <label for="exampleInputEmail1">Date of Birth</label>
    <input type="date" class="form-control" id="exampleInputEmail1"  name="std_dob" placeholder="Date of Birth" required>
  </div>
  
  
  <div class="form-group">
    <label for="exampleInputEmail1">Program</label>
    <input pattern=".{3,11}" type="text" class="form-control" id="exampleInputEmail1"name="std_prog"  placeholder="Program" required title="Program should contain 3 to 11 characters number">
  </div>
  
   <div class="form-group">
    <label for="exampleInputEmail1">Batch</label>
    <input pattern=".{3,6}type="text" class="form-control" id="exampleInputEmail1" name="std_batch" placeholder="Batch" required title="Batch should contain 3 to 6 characters number">
  </div
  
  <div class="form-group">
    <label for="exampleInputEmail1">Mobile</label>
    <input pattern=".{11,11}" type="number" class="form-control" id="exampleInputEmail1" name="std_mob" placeholder="Mobile" required title="Mobile Number should contain 11 characters number">
  
  
  <div class="form-group">
    <label for="exampleInputEmail1">E-mail:</label>
    <input type="email" class="form-control" id="exampleInputEmail1" name="std_mail" placeholder="E-mail" required>
  </div>
  
  <div class="form-group">
    <label for="exampleInputEmail1">Password</label>
    <input pattern=".{8,16}" type="text" class="form-control" id="exampleInputEmail1" name="std_pass" placeholder="Password" required title="Password should contain 8 to 16 characters number">
  </div>
  
  <div class="form-group">
    <label for="exampleInputEmail1">Book Borrowed</label>
    <input pattern=".{0}|.{8,8}" type="text" class="form-control" id="exampleInputEmail1" name="book_browed" placeholder="Book Borrowed" required title="Book referance should contain 8 character number">
  </div>
  
  
  
<div class="row">
    <div class="col-md-2 col-md-offset-0">
<input class="btn btn-success" type="submit"  name="submitBtn" id="submitBtn" value="Insert Student" />
        </div>

<div class="col-md-3 col-md-offset-6">
    <a href="official_index.php" class="btn btn-primary" role="button">Back to Home</a>
    </div>
</div>

    <input type="hidden" name="MM_insert" value="form1" />
</form>
        
</div>
</body>
</div>


</html>