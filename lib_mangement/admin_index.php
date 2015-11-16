<html>
<head>
<title>Admin Home</title>
</head>
    
<!-- <link rel="stylesheet" href="css/bootstrap.min.css"/> -->
<link rel="stylesheet" href="css/bootstrap.css"/>

<title>Admin Home</title>
    <style>
          body { background-color: #F6f6f6; }
        
        </style>


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
	echo "Hello ".$_SESSION["id"].". You are logged in as admin.<br/>";
	}
else{
	header("Location:index.php?err=2");
	}
    ?> </mark></center>
	
	<br>
</br>
    
<body>
    
   
<div class="row">
    
    <div class="col-md-1 col-md-offset-1"> <p><h5><strong>Officials:</strong></h5></p> </div>
    <div class="col-md-1 col-md-offset-0">
    <a href="officials_index_admin.php" class="btn btn-primary" role="button">Officials Index</a>
    </div>
    <div class="col-md-1 col-md-offset-1">
    <a href="officials_insert_admin.php" class="btn btn-primary" role="button">Add Officials</a>
    </div>
     <div class="col-md-1 col-md-offset-1">
    <a href="officials_search_admin.php" class="btn btn-primary" role="button">Search officials</a>
    </div>
</div> 
    
    <br>
</br>
    
    <div class="row">
    
    <div class="col-md-1 col-md-offset-1"> <p><h5><strong>Users:</strong></h5></p> </div>

    <div class="col-md-1 col-md-offset-0">
    <a href="user_list_admin.php" class="btn btn-primary" role="button">List of Users</a>
    </div>

    <div class="col-md-1 col-md-offset-1">
    <a href="user_create_admin.php" class="btn btn-primary" role="button">Create a User</a>
    </div>
     
</div>

<p>&nbsp;</p>
<p>&nbsp; </p>
</body>
</div>

</html>