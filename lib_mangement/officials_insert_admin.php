<?php require_once('Connections/lib_ss.php'); ?>

<html>
<head>
<title>Insert Officials</title>
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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO officials (off_id, off_name, off_dob, off_desig, off_mob, off_mail, off_pass) VALUES (%s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['off_id'], "int"),
                       GetSQLValueString($_POST['off_name'], "text"),
                       GetSQLValueString($_POST['off_dob'], "date"),
                       GetSQLValueString($_POST['off_desig'], "text"),
                       GetSQLValueString($_POST['off_mob'], "text"),
                       GetSQLValueString($_POST['off_mail'], "text"),
                       GetSQLValueString($_POST['off_pass'], "text"));

  mysql_select_db($database_lib_ss, $lib_ss);
  $Result1 = mysql_query($insertSQL, $lib_ss) or die(mysql_error());

  $insertGoTo = "officials_index_admin.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
?>

    
<body>
<div class="row">
    
    <div class="col-md-3 col-md-offset-5"> <p><h3>Insert Officials Details</h3></p> </div>
    </div>

<script src="bootstrap.min.js"></script>
    
    
    <div class="col-xs-12 col-md-4 col-md-offset-4">
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1" data-toggle="validator">

  <div class="form-group">
    <label for="exampleInputEmail1">Officials ID</label>
    <input type="text" class="form-control" id="exampleInputEmail1" name="off_id" placeholder="Officials ID" required>
  </div>
  
  <div class="form-group">
    <label for="exampleInputEmail1">Name</label>
    <input type="text" class="form-control" id="exampleInputEmail1" name="off_name" placeholder="Officials Name" required>
  </div>
  
  <div class="form-group">
    <label for="exampleInputEmail1">Date of Birth</label>
    <input type="text" class="form-control" id="exampleInputEmail1"  name="off_dob" placeholder="Date of Birth" required>
  </div>
  
  
  <div class="form-group">
    <label for="exampleInputEmail1">Designation</label>
    <input type="text" class="form-control" id="exampleInputEmail1"name="off_desig"  placeholder="Designation" required>
  </div>
  
   <div class="form-group">
    <label for="exampleInputEmail1">Mobile</label>
    <input type="number"  class="form-control" id="exampleInputEmail1" name="off_mob" placeholder="Mobile" data-minlength="11" data-maxlength="11" required>
  </div>
  
  <div class="form-group">
    <label for="exampleInputEmail1">E-mail:</label>
    <input type="email" class="form-control" id="exampleInputEmail1" name="off_mail" placeholder="E-mail" required>
  </div>
  
  <div class="form-group">
    <label for="exampleInputEmail1">Password</label>
    <input type="text" class="form-control" id="exampleInputEmail1" name="off_pass" placeholder="Password" required>
  </div>
  
  
<div class="row">
    <div class="col-md-2 col-md-offset-0">
<input class="btn btn-success" type="submit"  name="submitBtn" id="submitBtn" value="Submit" />
        </div>

<div class="col-md-2 col-md-offset-6">
    <a href="admin_index.php" class="btn btn-primary" role="button">Back to Home</a>
    </div>
</div>

    <input type="hidden" name="MM_insert" value="form1" />
</form>
        
</div>

<script src="js/validation.js"> </script> 

</body>
</div>

</body>
</html>