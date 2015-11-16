<!DOCTYPE html>
<html lang="en">
<head>
    
<!-- <link rel="stylesheet" href="css/bootstrap.min.css"/> -->
<link rel="stylesheet" href="css/bootstrap.css"/>
    
<title>Login</title>
    <style>
          body { background-color: #F6f6f6; }
        
        </style>
</head>
    
<body>
<h1 style="text-align:center; color:#2CBFF4;">City University Library Manangement System</h1>
<div class="container"> 
<form action="check.php" method="post">
<h2><p class="text-center">Login</h2></p>
<div class="row">
<div class="col-md-4 col-md-offset-4">
    <form class="form-horizontal">
  <div class="form-group">
    <label for="user_name2">User ID</label>
    <div >
      <input type="text" class="form-control" id="inputEmail3" placeholder="User ID or User Name" name="uname">
    </div>
      
        
  </div>
  <div class="form-group">
    <label for="password">Password</label>
    <div>
      <input type="password" class="form-control" id="inputPassword3" placeholder="Password" name="pwd">
    </div>
      
    <div class="form-group">
    <div>
      <div class="checkbox">
        <label>
          <input type="checkbox"> Remember me
        </label>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-4 col-sm-4">
      <button type="submit" class="btn btn-primary  left-block" value="Login">Sign in</button>
    </div>
      </div>
    </div>
  </div>
    
    <div class="row">
<div class="col-md-4 col-md-offset-4">
     <p class="text-center">
       
    </br>
     <mark> <?php // To display Error messages
if(isset($_GET['err'])){
if ($_GET['err']==1){
echo "Invalid User ID or Password.Try again with correct User ID & Password. If forgot contact with System Administrator";}
else if($_GET['err']==5){
echo "Successfully Logged out..";}
else if ($_GET['err']==2){
echo "Your trying to access unauthorized page.Please login first";
}
}
?>  </mark> </p> 
  </div>
    </div>
    </div>
  
</form>
    
</html>
