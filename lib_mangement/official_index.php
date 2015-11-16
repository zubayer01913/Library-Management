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

	
<body>
    
   <br>
</br>
   
<div class="row">
    
    <div class="col-md-1 col-md-offset-1"> <p><h5>Student:</h5></p> </div>
    <div class="col-md-1 col-md-offset-0">
    <a href="student_index_off.php" class="btn btn-primary" role="button">Student Index</a>
    </div>
    <div class="col-md-1 col-md-offset-1">
    <a href="student_insert_off.php" class="btn btn-primary" role="button">Add Student</a>
    </div>
     <div class="col-md-1 col-md-offset-1">
    <a href="student_search_off.php" class="btn btn-primary" role="button">Search Student</a>
    </div>
</div> 
    
    <br>
</br>
    
    <div class="row">
    
    <div class="col-md-1 col-md-offset-1"> <p><h5>Book:</h5></p> </div>

    <div class="col-md-1 col-md-offset-0">
    <a href="book_index_off.php" class="btn btn-primary" role="button">Book Index</a>
    </div>

    <div class="col-md-1 col-md-offset-1">
    <a href="book_insert_off.php" class="btn btn-primary" role="button">Add Book</a>
    </div>
     
	<div class="col-md-1 col-md-offset-1">
    <a href="book_search_off.php" class="btn btn-primary" role="button">Search Books</a>
    </div>
</div>

<p>&nbsp;</p>
<p>&nbsp; </p>
</body>	

</html>
