<?php require_once('Connections/lib_ss.php'); ?>
<html>
<head>
<title>Search Officials</title>
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

$colname_rsOfficials = "-1";
if (isset($_POST['off_id'])) {
  $colname_rsOfficials = $_POST['off_id'];
}
mysql_select_db($database_lib_ss, $lib_ss);
$query_rsOfficials = sprintf("SELECT * FROM officials WHERE off_id = %s", GetSQLValueString($colname_rsOfficials, "int"));
$rsOfficials = mysql_query($query_rsOfficials, $lib_ss) or die(mysql_error());
$row_rsOfficials = mysql_fetch_assoc($rsOfficials);
$totalRows_rsOfficials = mysql_num_rows($rsOfficials);
?>


<body>
    
<div class="row">
    
    <div class="col-md-3 col-md-offset-5"> <p><h3>Search Officials</h3></p> </div>
    </div>

<script src="bootstrap.min.js"></script>
    
  
    
  <div class="col-md-4 col-md-offset-4">  
<form id="form1" name="form1" method="post" action="">
   
    <div class="form-group">
    <label for="exampleInputEmail1"></label>
    <input type="text" class="form-control" id="exampleInputEmail1" name="off_id" placeholder="Officials ID">  
  </div>
    <div class="col-md-2 col-md-offset-4">
<input class="btn btn-success" type="submit"  name="submitBtn" id="submitBtn" value="Search" />
        </div>
    </div>
       
    
</form>
<p>&nbsp;</p>
<div class="row">
    
    <div class="col-md-2 col-md-offset-5"> <p><h3>List of Officials</h3></p> </div>
    </div>

<div class="table-responsive">
<table class="table table-bordered" align="center">
  <tr class="success">
    <td>ID</td>
    <td>Name</td>
    <td>Date of Birth</td>
    <td>Designation</td>
    <td>Mobile</td>
    <td>E-mail</td>
    <td>Password</td>
    <td class="danger">Update/Delete</td>
  </tr>
  <?php do { ?>
    <tr class="info">
      <td><?php echo $row_rsOfficials['off_id']; ?></td>
      <td><?php echo $row_rsOfficials['off_name']; ?></td>
      <td><?php echo $row_rsOfficials['off_dob']; ?></td>
      <td><?php echo $row_rsOfficials['off_desig']; ?></td>
      <td><?php echo $row_rsOfficials['off_mob']; ?></td>
      <td><?php echo $row_rsOfficials['off_mail']; ?></td>
      <td><?php echo $row_rsOfficials['off_pass']; ?></td>
      <td class="warning"><a href="officials_update_admin.php?ref_number=<?php echo $row_rsOfficials['off_id']; ?>">Update</a> |  
       <a onclick="return confirm('Are you sure to delete this official from library  database?')" 
       href="officials_delete_admin.php?ref_number=<?php echo $row_rsOfficials['off_id']; ?>"> Delete</a></td>
    </tr>
    <?php } while ($row_rsOfficials = mysql_fetch_assoc($rsOfficials)); ?>
</table>
    <div class="col-md-2 col-md-offset-5">
    <a href="admin_index.php" class="btn btn-primary" role="button">Back to Home</a>
    </div>
    </div>
    </div>
</body>
</html>
<?php
mysql_free_result($rsOfficials);
?>
