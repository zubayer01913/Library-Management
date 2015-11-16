<html>
<head>
<title>Student Home</title>
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
if(isset($_SESSION["access_level"]) && $_SESSION["access_level"]==2){
	echo "Hello ".$_SESSION["id"].". You are logged in as Student.<br/>";
	}
else{
	header("Location:index.php?err=2");
	}
    ?> </mark></center>
	
	<br>
</br>
<body>


<div class="row">
    
    <div class="col-md-1 col-md-offset-1"> <p><h5><strong>Book:</strong></h5></p> </div>
    <div class="col-md-1 col-md-offset-0">
    <a href="book_index_std.php" class="btn btn-primary" role="button">Book Index</a>
    </div>
    
     <div class="col-md-1 col-md-offset-1">
    <a href="book_search_std.php" class="btn btn-primary" role="button">Search Book</a>
    </div>
	
	<div class="col-md-1 col-md-offset-2">
    <a href="book_borrowed_std.php?std_id=<?php echo $_SESSION["id"]; ?>" class="btn btn-primary" role="button">Search Book</a>
    </div>
</div> 




</body>
</html>