<?php
include 'conn.php';
if(isset($_GET['msg']))
{
	if($_GET['msg']==1)
	{
		echo "<script>alert('Account was successfully created');</script>";
	}
}
if(isset($_POST['submit']))
{
$username=$_POST['username'];
$pass=md5($_POST['pass']);
$user_type=$_POST['user_type'];
$sql="SELECT * FROM admin WHERE username='".$username."' AND pass='".$pass."' AND user_type='".$user_type."'";
$res=$conn->query($sql);
$row=mysqli_fetch_assoc($res);
if(mysqli_num_rows($res)==0)
{
	echo "<script>alert('No such user was found');</script>";
}
else
{
	session_start();
	if($row['user_type']=='member')
	{
		$_SESSION['user_type']=$row['user_type'];
		$_SESSION['user_id']=$row['user_id'];
		$sql2="SELECT * FROM member WHERE user_id='".$row['user_id']."'";
		$res2=$conn->query($sql2);
		$row2=mysqli_fetch_assoc($res2);
		$_SESSION['mem_id']=$row2['mem_id'];
		header("location: member.php");
	}
	else if($row['user_type']=='admin')
	{
		$_SESSION['user_type']=$row['user_type'];
		$_SESSION['user_id']=$row['user_id'];
		header("location: admin.php");
	}
}

$conn->close();
}
?>
<!DOCTYPE html>
<html lang='en'>
<head>
  <title>Library/login</title>
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
      <li class="active"><a>Login</a></li>
      <li><a href="signup.php">Signup</a></li>
    </ul>
  </div>
</nav>
<div class='container'>
<div class='row'>
	<div class='col-sm-3'>
	</div>
	<div class='col-sm-6'>
		<form role='form' method='POST' action='login.php'>
		  <div class='form-group'>
			<label for='movie'>Username: </label>
			<input type='text' class='form-control' id='username' name='username'>
		  </div>
		  <div class='form-group'>
			<label for='genre'>Password: </label>
			<input type='password' class='form-control' id='pass' name='pass'>
		  </div>
		  <div class='form-group'>
			<label for='language'>User Type: </label>
			<select class='form-control' id='user_type' name='user_type'>
			<option value='member'>Member</option>
			<option value='admin'>Admin</option>
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