<?php
session_start();
if($_SESSION['user_type']!='admin')
{
	header("location: login.php");
}
include 'conn.php';
if(isset($_GET['msg']))
{
	if($_GET['msg']==1)
	{
		echo "<script>alert('Author was successfully added');</script>";
	}
	else if($_GET['msg']==2)
	{
		echo "<script>alert('Book was successfully added');</script>";
	}	
	else if($_GET['msg']==3)
	{
		echo "<script>alert('Publisher was successfully added');</script>";
	}	
	else if($_GET['msg']==4)
	{
		echo "<script>alert('Staff was successfully added');</script>";
	}	
	else if($_GET['msg']==5)
	{
		echo "<script>alert('Supplier was successfully added');</script>";
	}	
}

if(isset($_POST['author_submit']))
{
	$name=$_POST['author_name'];
	$address=$_POST['author_address'];
	$email=$_POST['author_email'];
	$phone=$_POST['author_phone'];
	$sql="INSERT INTO author (name,address,email,phone) VALUES ('".$name."','".$address."','".$email."','".$phone."');";
	$conn->query($sql);
	$author_id=$conn->insert_id;
	header("location: admin.php?msg=1&author_id=".$author_id);
}
if(isset($_POST['book_submit']))
{
	if(!isset($_POST['book_sup_id'])||!isset($_POST['book_author_id'])||!isset($_POST['book_pub_id']))
	{
		echo "<script>alert('Mandatory fields are missing');</script>";
	}
	else
	{
		$title=$_POST['book_title'];
		$price=$_POST['book_price'];
		$quantity=$_POST['book_quantity'];
		$genre=$_POST['book_genre'];
		$sup_id=$_POST['book_sup_id'];
		$author_id=$_POST['book_author_id'];
		$pub_id=$_POST['book_pub_id'];
		$sql="INSERT INTO book (title,price,quantity,available,genre,sup_id,author_id,pub_id) VALUES ('".$title."',".$price.",".$quantity.",".$quantity.",'".$genre."',".$sup_id.",".$author_id.",".$pub_id.");";
		$conn->query($sql);
		$book_id=$conn->insert_id;
		header("location: admin.php?msg=2&book_id=".$book_id);
	}
}
if(isset($_POST['pub_submit']))
{
	$name=$_POST['pub_name'];
	$address=$_POST['pub_address'];
	$email=$_POST['pub_email'];
	$phone=$_POST['pub_phone'];
	$sql="INSERT INTO publisher (name,address,email,phone) VALUES ('".$name."','".$address."','".$email."','".$phone."');";
	$conn->query($sql);
	$pub_id=$conn->insert_id;
	header("location: admin.php?msg=3&pub_id=".$pub_id);
}
if(isset($_POST['staff_submit']))
{
	$name=$_POST['staff_name'];
	$address=$_POST['staff_address'];
	$email=$_POST['staff_email'];
	$phone=$_POST['staff_phone'];
	$sql="INSERT INTO staff (name,address,email,phone) VALUES ('".$name."','".$address."','".$email."','".$phone."');";
	$conn->query($sql);
	$staff_id=$conn->insert_id;
	header("location: admin.php?msg=4&staff_id=".$staff_id);
}
if(isset($_POST['sup_submit']))
{
	$name=$_POST['sup_name'];
	$address=$_POST['sup_address'];
	$email=$_POST['sup_email'];
	$phone=$_POST['sup_phone'];
	$sql="INSERT INTO supplier (name,address,email,phone) VALUES ('".$name."','".$address."','".$email."','".$phone."');";
	$conn->query($sql);
	$sup_id=$conn->insert_id;
	header("location: admin.php?msg=5&staff_id=".$sup_id);
}
?>
<!DOCTYPE html>
<html lang='en'>
<head>
  <title>Library/admin</title>
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
      <li class="active"><a>Add</a></li>
      <li><a href="admin_view.php">View</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
         <li><a href="logout.php"><span style='color:red'><span class="glyphicon glyphicon-log-out"></span> Log Out</span></a></li>
    </ul>	
  </div>
</nav>
<div class='container'>
	<ul class="nav nav-pills nav-justified">
		<li class="active"><a data-toggle='pill' href="#author">Author</a></li>
		<li><a data-toggle='pill' href="#book">Book</a></li>
		<li><a data-toggle='pill' href="#pub">Publisher</a></li>
		<li><a data-toggle='pill' href="#staff">Staff</a></li>
		<li><a data-toggle='pill' href="#sup">Supplier</a></li>
	</ul>
	
	<div class='tab-content'>
	
	<div id='author' class='tab-pane fade in active'>
		<div class='row'>
			<div class='col-md-3'>
			</div>
			<div class='col-md-6'>
				<form role='form' method='POST' action='admin.php'>
				  <div class='form-group'>
					<label for='author_name'>Name: </label>
					<input type='text' class='form-control' id='author_name' name='author_name'>
				  </div>
				  <div class='form-group'>
					<label for='author_address'>Address: </label>
					<input type='text' class='form-control' id='author_address' name='author_address'>
				  </div>
				  <div class='form-group'>
					<label for='author_email'>Email: </label>
					<input type='text' class='form-control' id='author_email' name='author_email'>
				  </div>
				  <div class='form-group'>
					<label for='author_phone'>Phone: </label>
					<input type='text' class='form-control' id='author_phone' name='author_phone'>
				  </div>
				  <div class='form-group'>
					<input style='background:black;color:white;' type='submit' class='form-control' value='Submit' name='author_submit'>
				  </div>
				</form>
			</div>
			<div class='col-md-3'>
			</div>
		</div>
	</div>
	
	<div id='book' class='tab-pane fade'>
		<div class='row'>
			<div class='col-md-3'>
			</div>
			<div class='col-md-6'>
				<form role='form' method='POST' action='admin.php'>
				   <div class='row'>
				   <div class='col-md-6'>
				   <div class='form-group'>
					<label for='book_title'>Title: </label>
					<input type='text' class='form-control' id='book_title' name='book_title'>
				  </div>
				   </div>
				   <div class='col-md-6'>
				  <div class='form-group'>
					<label for='book_price'>Price: </label>
					<input type='number' step='100' class='form-control' id='book_price' name='book_price'>
				  </div>
				   </div>				   
				   </div>
				   <div class='row'>
				   <div class='col-md-6'>
				  <div class='form-group'>
					<label for='book_quantity'>Quantity: </label>
					<input type='number' step='1' class='form-control' id='book_quantity' name='book_quantity'>
				  </div>
				   </div>
				   <div class='col-md-6'>
				  <div class='form-group'>
					<label for='book_genre'>Genre: </label>
					<input type='text' class='form-control' id='book_genre' name='book_genre'>
				  </div>
				   </div>				   
				   </div>
				  <div class='form-group'>
					<label for='book_sup_id'>Supplier: </label>
					<select class='form-control' id='book_sup_id' name='book_sup_id'>
						<?php 
						$sql="SELECT * from supplier;";
						$res=$conn->query($sql);
						while($item=mysqli_fetch_assoc($res)){ ?>
						<option value='<?php echo $item["sup_id"]; ?>'><?php echo $item["name"]; ?></option>
						<?php }?>
					</select>
				  </div>	
				  <div class='form-group'>
					<label for='book_author_id'>Author: </label>
					<select class='form-control' id='book_author_id' name='book_author_id'>
						<?php 
						$sql="SELECT * from author;";
						$res=$conn->query($sql);
						while($item=mysqli_fetch_assoc($res)){ ?>
						<option value='<?php echo $item["author_id"]; ?>'><?php echo $item["name"]; ?></option>
						<?php }?>
					</select>
				  </div>
				  <div class='form-group'>
					<label for='book_pub_id'>Publisher: </label>
					<select class='form-control' id='book_pub_id' name='book_pub_id'>
						<?php 
						$sql="SELECT * from publisher;";
						$res=$conn->query($sql);
						while($item=mysqli_fetch_assoc($res)){ ?>
						<option value='<?php echo $item["pub_id"]; ?>'><?php echo $item["name"]; ?></option>
						<?php }?>
					</select>
				  </div>				  
				  <div class='form-group'>
					<input style='background:black;color:white;' type='submit' class='form-control' value='Submit' name='book_submit'>
				  </div>
				</form>
			</div>
			<div class='col-md-3'>
			</div>
		</div>
	</div>
	
	<div id='pub' class='tab-pane fade'>
		<div class='row'>
			<div class='col-md-3'>
			</div>
			<div class='col-md-6'>
				<form role='form' method='POST' action='admin.php'>
				  <div class='form-group'>
					<label for='pub_name'>Name: </label>
					<input type='text' class='form-control' id='pub_name' name='pub_name'>
				  </div>
				  <div class='form-group'>
					<label for='pub_address'>Address: </label>
					<input type='text' class='form-control' id='pub_address' name='pub_address'>
				  </div>
				  <div class='form-group'>
					<label for='pub_email'>Email: </label>
					<input type='text' class='form-control' id='pub_email' name='pub_email'>
				  </div>
				  <div class='form-group'>
					<label for='pub_phone'>Phone: </label>
					<input type='text' class='form-control' id='pub_phone' name='pub_phone'>
				  </div>
				  <div class='form-group'>
					<input style='background:black;color:white;' type='submit' class='form-control' value='Submit' name='pub_submit'>
				  </div>
				</form>
			</div>
			<div class='col-md-3'>
			</div>
		</div>
	</div>	
	
	<div id='staff' class='tab-pane fade'>
		<div class='row'>
			<div class='col-md-3'>
			</div>
			<div class='col-md-6'>
				<form role='form' method='POST' action='admin.php'>
				  <div class='form-group'>
					<label for='staff_name'>Name: </label>
					<input type='text' class='form-control' id='staff_name' name='staff_name'>
				  </div>
				  <div class='form-group'>
					<label for='staff_address'>Address: </label>
					<input type='text' class='form-control' id='staff_address' name='staff_address'>
				  </div>
				  <div class='form-group'>
					<label for='staff_email'>Email: </label>
					<input type='text' class='form-control' id='staff_email' name='staff_email'>
				  </div>
				  <div class='form-group'>
					<label for='staff_phone'>Phone: </label>
					<input type='text' class='form-control' id='staff_phone' name='staff_phone'>
				  </div>
				  <div class='form-group'>
					<input style='background:black;color:white;' type='submit' class='form-control' value='Submit' name='staff_submit'>
				  </div>
				</form>
			</div>
			<div class='col-md-3'>
			</div>
		</div>
	</div>	
	
	<div id='sup' class='tab-pane fade'>
		<div class='row'>
			<div class='col-md-3'>
			</div>
			<div class='col-md-6'>
				<form role='form' method='POST' action='admin.php'>
				  <div class='form-group'>
					<label for='sup_name'>Name: </label>
					<input type='text' class='form-control' id='sup_name' name='sup_name'>
				  </div>
				  <div class='form-group'>
					<label for='sup_address'>Address: </label>
					<input type='text' class='form-control' id='sup_address' name='sup_address'>
				  </div>
				  <div class='form-group'>
					<label for='sup_email'>Email: </label>
					<input type='text' class='form-control' id='sup_email' name='sup_email'>
				  </div>
				  <div class='form-group'>
					<label for='sup_phone'>Phone: </label>
					<input type='text' class='form-control' id='sup_phone' name='sup_phone'>
				  </div>
				  <div class='form-group'>
					<input style='background:black;color:white;' type='submit' class='form-control' value='Submit' name='sup_submit'>
				  </div>
				</form>
			</div>
			<div class='col-md-3'>
			</div>
		</div>
	</div>	
	
	</div>

</div>
</body>
</html>