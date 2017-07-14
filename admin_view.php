<?php
session_start();
if($_SESSION['user_type']!='admin')
{
	header("location: login.php");
}
include 'conn.php';

?>
<!DOCTYPE html>
<html lang='en'>
<head>
  <title>Library/admin</title>
  <meta charset='utf-8'>
  <meta name='viewport' content='width=device-width, initial-scale=1'>
  <link rel="stylesheet" type="text/css" href="http://localhost/Library/style.css">
  <link rel="stylesheet" type="text/css" href="http://localhost/Library/jq.css">
  <script src='https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js'></script>
  <script type="text/javascript" src="http://localhost/Library/jquery.tablesorter.js"></script> 
  <script type="text/javascript" src="http://localhost/Library/jquery.metadata.js"></script> 
  <link rel='stylesheet' href='http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css'>
  <script src='http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js'></script>
</head>
<body>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand"><span style='color:lightblue'>Library Management</span></a>
    </div>
    <ul class="nav navbar-nav">
      <li><a href="admin.php">Add</a></li>
      <li class="active"><a>View</a></li>
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
			<table id="table_author" class='tablesorter'>
			<thead>
			 <tr>
			  <th>AUTHOR ID</th>
			  <th>NAME</th>
			  <th>ADDRESS</th>
			  <th>EMAIL</th>
			  <th>PHONE</th>
			 </tr>
			</thead>
			<tbody>			
				<?php 
				$sql="SELECT * from author;";
				$res=$conn->query($sql);
				while($row=mysqli_fetch_assoc($res))
				{
				?>
				<tr>
				 <td><?php echo $row['author_id']; ?></td>
				 <td><?php echo $row['name']; ?></td>
				 <td><?php echo $row['address']; ?></td>
				 <td><?php echo $row['email']; ?></td>
				 <td><?php echo $row['phone']; ?></td>
				</tr>
				<?php } ?>			
			</tbody>
			</table>
	</div>
	
	<div id='book' class='tab-pane fade'>
			<table id="table_book" class='tablesorter'>
			<thead>
			 <tr>
			  <th>BOOK ID</th>
			  <th>TITLE</th>
			  <th>PRICE</th>
			  <th>QUANTITY</th>
			  <th>AVAILABLE</th>
			  <th>GENRE</th>
			  <th>SUP ID</th>
			  <th>AUTHOR ID</th>
			  <th>PUB ID</th>
			 </tr>
			</thead>
			<tbody>			
				<?php 
				$sql="SELECT * from book;";
				$res=$conn->query($sql);
				while($row=mysqli_fetch_assoc($res))
				{
				?>
				<tr>
				 <td><?php echo $row['book_id']; ?></td>
				 <td><?php echo $row['title']; ?></td>
				 <td><?php echo $row['price']; ?></td>
				 <td><?php echo $row['quantity']; ?></td>
				 <td><?php echo $row['available']; ?></td>
				 <td><?php echo $row['genre']; ?></td>
				 <td><?php echo $row['sup_id']; ?></td>
				 <td><?php echo $row['author_id']; ?></td>
				 <td><?php echo $row['pub_id']; ?></td>
				</tr>
				<?php } ?>			
			</tbody>
			</table>
	</div>
	
	<div id='pub' class='tab-pane fade'>
			<table id="table_pub" class='tablesorter'>
			<thead>
			 <tr>
			  <th>PUB ID</th>
			  <th>NAME</th>
			  <th>ADDRESS</th>
			  <th>EMAIL</th>
			  <th>PHONE</th>
			 </tr>
			</thead>
			<tbody>			
				<?php 
				$sql="SELECT * from publisher;";
				$res=$conn->query($sql);
				while($row=mysqli_fetch_assoc($res))
				{
				?>
				<tr>
				 <td><?php echo $row['pub_id']; ?></td>
				 <td><?php echo $row['name']; ?></td>
				 <td><?php echo $row['address']; ?></td>
				 <td><?php echo $row['email']; ?></td>
				 <td><?php echo $row['phone']; ?></td>
				</tr>
				<?php } ?>			
			</tbody>
			</table>
	</div>	
	
	<div id='staff' class='tab-pane fade'>
			<table id="table_staff" class='tablesorter'>
			<thead>
			 <tr>
			  <th>STAFF ID</th>
			  <th>NAME</th>
			  <th>ADDRESS</th>
			  <th>EMAIL</th>
			  <th>PHONE</th>
			 </tr>
			</thead>
			<tbody>			
				<?php 
				$sql="SELECT * from staff;";
				$res=$conn->query($sql);
				while($row=mysqli_fetch_assoc($res))
				{
				?>
				<tr>
				 <td><?php echo $row['staff_id']; ?></td>
				 <td><?php echo $row['name']; ?></td>
				 <td><?php echo $row['address']; ?></td>
				 <td><?php echo $row['email']; ?></td>
				 <td><?php echo $row['phone']; ?></td>
				</tr>
				<?php } ?>			
			</tbody>
			</table>
	</div>	
	
	<div id='sup' class='tab-pane fade'>
			<table id="table_sup" class='tablesorter'>
			<thead>
			 <tr>
			  <th>SUP ID</th>
			  <th>NAME</th>
			  <th>ADDRESS</th>
			  <th>EMAIL</th>
			  <th>PHONE</th>
			 </tr>
			</thead>
			<tbody>			
				<?php 
				$sql="SELECT * from supplier;";
				$res=$conn->query($sql);
				while($row=mysqli_fetch_assoc($res))
				{
				?>
				<tr>
				 <td><?php echo $row['sup_id']; ?></td>
				 <td><?php echo $row['name']; ?></td>
				 <td><?php echo $row['address']; ?></td>
				 <td><?php echo $row['email']; ?></td>
				 <td><?php echo $row['phone']; ?></td>
				</tr>
				<?php } ?>			
			</tbody>
			</table>
	</div>	
	
	</div>

</div>
</body>
</html>
<script>
$(document).ready(function() 
    { 
        $("#table_author").tablesorter(); 
		$("#table_book").tablesorter(); 
		$("#table_pub").tablesorter(); 
		$("#table_staff").tablesorter(); 
		$("#table_supp").tablesorter(); 
    } 
); 
</script>