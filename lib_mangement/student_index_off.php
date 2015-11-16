<?php require_once('Connections/lib_ss.php'); ?>

<html>
<head>
<title>Officials Index</title>
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

mysql_select_db($database_lib_ss, $lib_ss);
$query_rsStudents = "SELECT * FROM students";
$rsStudents = mysql_query($query_rsStudents, $lib_ss) or die(mysql_error());
$row_rsStudents = mysql_fetch_assoc($rsStudents);
$totalRows_rsStudents = mysql_num_rows($rsStudents);
?>


<body>
<div class="row">
    
    <div class="col-md-2 col-md-offset-5"> <p><h3>List of Students</h3></p> </div>
    </div>

<div class="table-responsive">
<table class="table table-bordered" align="center">
  <tr class="success">
    <td>ID</td>
    <td>Name</td>
    <td>Date of Birth</td>
    <td>Program</td>
    <td>Batch</td>
    <td>Mobile</td>
    <td>E-mail</td>
    <td>Password</td>
    <td>Book Borrowed</td>
    <td class="danger">Update/Delete</td>
  </tr>
  

  <?php do { ?>
    <tr class="info">
      <td><?php echo $row_rsStudents['std_id']; ?></td>
      <td><?php echo $row_rsStudents['std_name']; ?></td>
      <td><?php echo $row_rsStudents['std_dob']; ?></td>
      <td><?php echo $row_rsStudents['std_prog']; ?></td>
      <td><?php echo $row_rsStudents['std_batch']; ?></td>
      <td><?php echo $row_rsStudents['std_mob']; ?></td>
      <td><?php echo $row_rsStudents['std_mail']; ?></td>
      <td><?php echo $row_rsStudents['std_pass']; ?></td>
      <td><?php echo $row_rsStudents['book_browed']; ?></td>
      <td class="warning"><a href="student_update_err_off.php?std_id=<?php echo $row_rsStudents['std_id']; ?>"> Error Update</a> | 
      <!--<a href="student_update_brw_off.php?std_id=<?php echo $row_rsStudents['std_id']; ?>"> Brow Update</a> | -->
      <a onclick="return confirm('Are you sure to delete this student from library  database?')" href="student_delete_off.php?ref_number=<?php echo $row_rsStudents['std_id']; ?>"> Delete</a>
      </td>
    </tr>
    <?php } while ($row_rsStudents = mysql_fetch_assoc($rsStudents)); ?>
</table>

<div class="col-md-2 col-md-offset-5">
    <a href="official_index.php" class="btn btn-primary" role="button">Back to Home</a>
    </div>
</body> 
</div>
</html>
<?php
mysql_free_result($rsStudents);
?>
