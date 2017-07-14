<?php
include 'conn.php';
if(isset($_POST['submit']))
{
$username=$_POST['username'];
$pass=$_POST['pass'];
$pass2=$_POST['pass2'];
$user_type='member';
$name=$_POST['name'];
$address=$_POST['address'];
$email=$_POST['email'];
$phone=$_POST['phone'];
$mem_type=$_POST['mem_type'];
$datetime = new DateTime();
$start_date=$datetime->format('d-m-Y');
$datetime->add(new DateInterval('P6M'));
$end_date=$datetime->format('d-m-Y');
if($pass!=$pass2)
{
	echo "<script>alert('The passwords do not match');</script>";
}
else
{
	$sql="INSERT INTO admin (username,pass,user_type) VALUES ('".$username."','".md5($pass)."','".$user_type."')";
	$conn->query($sql);
	$user_id=$conn->insert_id;
	$sql2="INSERT INTO member (user_id,address,name,email,phone) VALUES (".$user_id.",'".$address."','".$name."','".$email."','".$phone."')";
	$conn->query($sql2);
	$mem_id=$conn->insert_id;
	$sql3="INSERT INTO membership (mem_id,mem_type,start_date,end_date) VALUES (".$mem_id.",'".$mem_type."','".$start_date."','".$end_date."')";
	$conn->query($sql3);
	header("location: login.php?msg=1");
}

$conn->close();
}
?>
<!DOCTYPE html>
<html lang='en'>
<head>
  <title>Library/signup</title>
  <meta charset='utf-8'>
  <meta name='viewport' content='width=device-width, initial-scale=1'>
  <link rel='stylesheet' href='http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css'>
  <script src='https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js'></script>
  <script src='http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js'></script>
</head>
<body>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand"><span style='color:lightblue'>Library Management</span></a>
    </div>
    <ul class="nav navbar-nav">
      <li><a href="login.php">Login</a></li>
      <li class="active"><a>Signup</a></li>
    </ul>
  </div>
</nav>
<div class='container'>
<div class='row'>
	<div class='col-sm-3'>
	</div>
	<div class='col-sm-6'>
		<form role='form' method='POST' action='signup.php'>
		  <div class='form-group'>
			<label for='username'>Username: </label>
			<input type='text' class='form-control' id='username' name='username'>
		  </div>
		  <div class='form-group'>
			<label for='pass'>Password: </label>
			<input type='password' class='form-control' id='pass' name='pass'>
		  </div>
		  <div class='form-group'>
			<label for='pass2'>Re-Type Password: </label>
			<input type='password' class='form-control' id='pass2' name='pass2'>
		  </div>
		  <div class='form-group'>
			<label for='name'>Name: </label>
			<input type='text' class='form-control' id='name' name='name'>
		  </div>
		  <div class='form-group'>
			<label for='address'>Address: </label>
			<input type='text' class='form-control' id='address' name='address'>
		  </div>
		  <div class='form-group'>
			<label for='email'>Email: </label>
			<input type='text' class='form-control' id='email' name='email'>
		  </div>
		  <div class='form-group'>
			<label for='phone'>Phone: </label>
			<input type='text' class='form-control' id='phone' name='phone'>
		  </div>
		  <div class='form-group'>
			<label for='mem_type'>Membership Type: </label>
			<select class='form-control' id='mem_type' name='mem_type'>
				<option value='regular'>Regular</option>
				<option value='premium'>Premium</option>
			</select>
          </div>
		  <div class='form-group'>
		    <input style='background:black;color:white;' type='submit' class='form-control' value='Submit' name='submit'>
		  </div>
		</form>
	</div>
	<div class='col-sm-3'>
	</div>
</div>
</div>
</body>
</html>