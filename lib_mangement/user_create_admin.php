<?php require_once('Connections/lib_ss.php'); ?>

<html>
<head>
<title>Insert User</title>
</head>
    
<!-- <link rel="stylesheet" href="css/bootstrap.min.css"/> -->
<link rel="stylesheet" href="css/bootstrap.css"/>

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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form2")) {
  $insertSQL = sprintf("INSERT INTO login_details (id, password, access_level) VALUES (%s, %s, %s)",
                       GetSQLValueString($_POST['id'], "text"),
                       GetSQLValueString($_POST['password'], "text"),
                       GetSQLValueString($_POST['access_level'], "int"));

  mysql_select_db($database_lib_ss, $lib_ss);
  $Result1 = mysql_query($insertSQL, $lib_ss) or die(mysql_error());

  $insertGoTo = "user_list_admin.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

?>



<body>
<div class="row">
    
    <div class="col-md-3 col-md-offset-5"> <p><h3>Insert Users Details</h3></p> </div>
    </div>

<script src="bootstrap.min.js"></script>
    
    
    <div class="col-xs-12 col-md-4 col-md-offset-4">
<form action="<?php echo $editFormAction; ?>" method="post" name="form2" id="form2" data-toggle="validator">

  <div class="form-group">
    <label for="exampleInputEmail1">User ID</label>
    <input type="text" class="form-control" id="exampleInputEmail1" name="id" placeholder="User ID" required>
  </div>
  
  <div class="form-group">
    <label for="exampleInputEmail1">Password</label>
    <input type="text" class="form-control" id="exampleInputEmail1" name="password" placeholder="Password" required>
  </div>
  
  <div class="form-group">
    <label for="exampleInputEmail1">Access Level</label>
    <input type="number" class="form-control" id="exampleInputEmail1"  name="access_level" placeholder="For admins: 0, Officials: 1, Students: 2" required>
  </div>
  
  
<div class="row">
    <div class="col-md-2 col-md-offset-0">
<input class="btn btn-success" type="submit"  name="submitBtn" id="submitBtn" value="Submit" />
        </div>

<div class="col-md-2 col-md-offset-6">
    <a href="admin_index.php" class="btn btn-primary" role="button">Back to Home</a>
    </div>
</div>

    <input type="hidden" name="MM_insert" value="form2" />
</form>


<mark>
<p><mark><strong>Nota Bene: </strong></mark></p>
<p>For Admin: Access Level = <kbd>0</kbd></p>
<p>For Official: Access Level = <kbd>1</kbd></p>
<p>For Student: Access Level = <kbd>2</kbd></p>
</mark>
<p>&nbsp;</p>
</body>
</html>