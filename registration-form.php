<?php
/* Template Name: Registration Page */
get_header();
global $wpdb;

if($_POST['submit']) {
    $username=$wpdb->escape($_POST['Username1']);
	$email=$wpdb->escape($_POST['email1']);
	$password=$wpdb->escape($_POST['password1']);
	$confirmPassword=$wpdb->escape($_POST['confirmPassword1']);

	$error=array();
	if(strpos($username, ' ')!==FALSE){
	$error['username_space']='username has space';
	}
	if(empty($username)){
		$error['username_empty']='needed username must';
	}
	if(username_exists($username)){
		$error['username_exists']='username already exists';
	}
	if(!is_email($email)){
		$error['email_valid']='invalid email';
	}
	if(email_exists($email)){
	$error['email_exists']='Email already exists';
	}
	
	
	if(strcmp($password,$confirmPassword)!==0){
		$error['password']="password not matched";
	}
	
	if(count($error)==0){
		wp_create_user($username,$password,$email);
		echo "user created successfully";
		exit();
	}
	else{
	print_r($error);
	}
}

?>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<style>
body {
    font-family: Arial, Helvetica, sans-serif;
    background-color: black;
}

* {
    box-sizing: border-box;
}

/* Add padding to containers */
.container {
    padding: 16px;
    background-color: white;
}

/* Full-width input fields */
input[type=text], input[type=password] {
    width: 100%;
    padding: 15px;
    margin: 5px 0 22px 0;
    display: inline-block;
    border: none;
    background: #f1f1f1;
}

input[type=text]:focus, input[type=password]:focus {
    background-color: #ddd;
    outline: none;
}

/* Overwrite default styles of hr */
hr {
    border: 1px solid #f1f1f1;
    margin-bottom: 25px;
}

/* Set a style for the submit button */
.registerbtn {
    background-color: #4CAF50;
    color: white;
    padding: 16px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 100%;
    opacity: 0.9;
}

.registerbtn:hover {
    opacity: 1;
}

/* Add a blue text color to links */
a {
    color: dodgerblue;
}

/* Set a grey background color and center the text of the "sign in" section */
.signin {
    background-color: #f1f1f1;
    text-align: center;
}
</style>
</head>
<body>

<form  method="POST">
  <div class="container">
    <h1>Register</h1>
    <p>Please fill in this form to create an account.</p>
    <hr>
    <label for="email"><b>Username</b></label>
    <input type="text" placeholder="Enter Username" name="Username1" id="Username" >
	
    <label for="email"><b>Email</b></label>
    <input type="text" placeholder="Enter Email" name="email1" id="email" >

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="password1" id="password" >

    <label for="psw-repeat"><b>Confirm Password</b></label>
    <input type="password" placeholder="Confirm Password" name="confirmPassword1" id="confirmPassword" >
    <hr>
    <p>By creating an account you agree to our <a href="#">Terms & Privacy</a>.</p>

    <input type="submit" name="submit" value="submit">
  </div>
  
</form>
</body>
</html>
<?php
get_footer();
?>