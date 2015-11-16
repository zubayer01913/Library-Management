<?php require_once('Connections/lib_ss.php'); ?>

<html>
<head>
<title>Users List</title>
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

mysql_select_db($database_lib_ss, $lib_ss);
$query_rsUser_list = "SELECT * FROM login_details";
$rsUser_list = mysql_query($query_rsUser_list, $lib_ss) or die(mysql_error());
$row_rsUser_list = mysql_fetch_assoc($rsUser_list);
$totalRows_rsUser_list = mysql_num_rows($rsUser_list);
?>

<!--<body>
<p>List of Registered Users:</p>
<table border="1">
  <tr>
    <td>id</td>
    <td>password</td>
    <td>access_level</td>
    <td>Update/Delete</td>
    
  </tr> -->
  
  
  
  <body>
<div class="row">
    
    <div class="col-md-2 col-md-offset-5"> <p><h3>List of Officials</h3></p> </div>
    </div>

<div class="table-responsive">
<!--<div class="panel panel-default"> -->
<table class="table table-bordered" align="center">
  <tr class="success">
    <td>ID</td>
    <td>Password</td>
    <td>Access Level</td>
    <td class="danger">Update/Delete</td>
  </tr>
  <?php do { ?>
    <tr class="info">
  
      <td><?php echo $row_rsUser_list['id']; ?></td>
      <td><?php echo $row_rsUser_list['password']; ?></td>
      <td><?php echo $row_rsUser_list['access_level']; ?>	</td>
      <td class="warning"><a href="user_update_admin.php?id=<?php echo $row_rsUser_list['id']; ?>">Update</a> |  
       <a onclick="return confirm('Are you sure to delete this official from library  database?')" 
       href="user_delete_admin.php?id=<?php echo $row_rsUser_list['id']; ?>"> Delete</a></td>

    </tr>
    <?php } while ($row_rsUser_list = mysql_fetch_assoc($rsUser_list)); ?>
</table>
</div>
<!--</div> -->
<div class="col-md-2 col-md-offset-5">
    <a href="admin_index.php" class="btn btn-primary" role="button">Back to Home</a>
    </div>
    </div>
</body>
</html>
<?php
mysql_free_result($rsUser_list);
?>
