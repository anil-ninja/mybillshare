 <?php
//	phpinfo();
	session_start();
	$error="";
if (isset($_SESSION['first_name'])) {
    header('Location: billing_info.php');
}	
		$database_handle = mysqli_connect("localhost","root","redhat111111","mybill");
	if (mysqli_connect_errno()) {
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}
	
	if(isset($_POST['signup'])) {
			$firstname = $_POST['firstname'];
			$lastname = $_POST['lastname'];
			$email = $_POST['email'];
			$username = $_POST['username'];
			$pas = $_POST['password'] ;
			$awe = $_POST['password2'] ;
		if ( $pas == $awe ) {
				mysqli_query($database_handle,"INSERT INTO user_info(first_name, last_name, email, username, password) VALUES ('$firstname', '$lastname', '$email', '$username', '$pas') ; ") ;
				header('Location: index.php?status=0');
			} 
				else { echo "password not match" ;
					}
		}

	if(isset($_POST['login'])) { 
		$username = $_POST['username']; 
		$password = $_POST['password'];
		$response = mysqli_query($database_handle,"select * from user_info where username = '$username' AND password = '$password';") ;
		$num_rows = mysqli_num_rows($response);
	if ( $num_rows){
			header('Location: billing_info.php');
			$responseRow = mysqli_fetch_array($response);
			$_SESSION['user_id'] = $responseRow['user_id'];
			$_SESSION['first_name'] = $responseRow['first_name'];
			$_SESSION['username'] = $responseRow['username'];
			$_SESSION['email'] = $responseRow['email'];
			exit;
		}
		else {
				header('Location: index.php?status=2');
			}
	
		}

		$response = mysqli_query($database_handle,"select * from user_info ;");
		mysqli_close($database_handle);

?>

 <!DOCTYPE html>
 <html lang="en">
  <head>
    <meta charset="utf-8">
	<title>Mybills.com</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Billing, Sharing, budget">
    <meta name="author" content="Anil">
    
    <style>
      body {
        padding-top: 50px; /* 60px to make the container go all the way to the bottom of the topbar */
      }
    </style>
    <link href="css/bootstrap-responsive.css" rel="stylesheet">
    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="css/bootstrap-theme.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="js/bootstrap.min.js"></script>

 <script src="js/jquery-1.11.1.min.js"></script>
       
  </head>

  <body>
<div class="row">
    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          
          
          <a class="brand" href="index.php">MyBills.com</a>
          
          <div class="span3 pull-right">
            <ul class="list-inline">
              <!---<li class="index.php"><a href="#">Home</a></li>
              <li><a href="about.php">About</a></li>
              <li><a href="contact.php">Contact</a></li>    --->
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>
 </div>
    <div class="container">
		<div class='row'>
			
					
					<div class="center-block" style="width:300px;"  ></br>
						<form role="form" method="POST" class="form-horizontal" >
							<br/>
								<div class="input-group">
									<span class="input-group-addon">Username</span>
									<input type="text" class="form-control" name="username" placeholder="Enter email">
								</div>
								<br>
								<div class="input-group">
									<span class="input-group-addon">Password</span>
									<input type="password" class="form-control" name="password" placeholder="Password">
								</div>
								<?php echo $error."<br>"; ?>
							<button type="submit" class="btn btn-primary" name="login">Log in</button>
							<a data-toggle="modal" data-target="#myModal" style="float: right; cursor:pointer;">
			or Sign Up
		</a><br><a data-toggle="modal" data-target="#forgetPassModel" style="float: right; cursor:pointer;">
			Forget Password
		</a>
						</form>
					</div>
		
				
					
				
				
			</div>
				
    </div> 
     
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">New User Registration</h4>
      </div>
      
      <div class="modal-body">
        
        <form role="form" method="POST" id="tablef" >
								<div class="input-group" >
									<span class="input-group-addon">First Name</span>
									<input type="text" class="form-control" name="firstname" placeholder="Enter your first name">
								</div>
								<br>
								<div class="input-group">
									<span class="input-group-addon">Last Name</span>
									<input type="text" class="form-control" name="lastname" placeholder="Enter your last name">
								</div>
								<br>
								<div class="input-group">
									<span class="input-group-addon">Email</span>
									<input type="text" class="form-control" name="email" placeholder="Enter your Email">
								</div>
								<br>
								<div class="input-group">
									<span class="input-group-addon">Username</span>
									<input type="text" class="form-control" name="username" placeholder="Enter your user name">
								</div>
								<br>
								<div class="input-group">
									<span class="input-group-addon">Password </span>
									<input type="password" class="form-control" name="password" placeholder="Enter your password">
								</div>
								<br>
								<div class="input-group">
									<span class="input-group-addon">re-enter Password</span>
									<input type="password" class="form-control" name="password2" placeholder="Enter your password">
								</div>
								<br>
							<input type="submit" class="btn btn-primary" name = "signup" value = "Signup" >
						</form>
      </div>
      <div class="modal-footer">
        <!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
        <button id="newuser" type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!--end modle-->


	<script type="text/javascript">
		function checkForm() {
			if (document.getElementById('password_1').value == document.getElementById('password_2').value) {
				return true;
			}
			else {
				alert("Passwords don't match");
				return false;
			}
		}
	</script>

	<script src="js/jquery.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>

<?php

if(isset($_GET['status'])){
//status=2
	if($_GET['status'] == 2){
			echo "<script> 
					alert('Please, put Valid Username and Password');
				</script>";
}

	if($_GET['status'] == 0){
		echo "<script>
				alert('User registered successfully');
			</script>";
}
}
?>
  </body>
</html> 
