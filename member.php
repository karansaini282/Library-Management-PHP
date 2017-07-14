<?php
session_start(); 
if($_SESSION['user_type']!='member')
{
	header("location: login.php");
}
include 'conn.php';
$mem_id=$_SESSION['mem_id'];
$sql="SELECT * from borrow WHERE mem_id=".$mem_id." AND return_date='NONE';";
$res=$conn->query($sql);
$n=mysqli_num_rows($res);
if(isset($_POST['add_submit']))
{
	$book_id=$_POST['book_id'];
	$mem_id=$_SESSION['mem_id'];
	$datetime = new DateTime();
	$issue_date=$datetime->format('d-m-Y');
	$datetime->add(new DateInterval('P1M'));
	$due_date=$datetime->format('d-m-Y');
	$sql="SELECT * from staff;";
	$res=$conn->query($sql);
	$staff_id=rand(1,mysqli_num_rows($res));
	$sql="INSERT INTO borrow (book_id,mem_id,staff_id,issue_date,due_date,return_date,fine) VALUES (".$book_id.",".$mem_id.",".$staff_id.",'".$issue_date."','".$due_date."','NONE',0)";
	$conn->query($sql);
	$sql="SELECT * FROM book where book_id=".$book_id.";";
	$res=$conn->query($sql);
	$row=mysqli_fetch_assoc($res);
	$available=$row['available'];
	$available--;
	$sql="UPDATE book SET available=".$available." WHERE book_id=".$book_id.";";
	$conn->query($sql);
	header("location: member.php?msg=1");
}
?>
<!DOCTYPE html>
<html lang='en'>
<head>
  <title>Library/member</title>
  <meta charset='utf-8'>
  <meta name='viewport' content='width=device-width, initial-scale=1'>
  <script src='https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js'></script>
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
      <li class="active"><a>Add Books</a></li>
      <li><a href="cart.php">My Cart <span class="badge"><?php echo $n; ?></span></a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
         <li><a href="logout.php"><span style='color:red'><span class="glyphicon glyphicon-log-out"></span> Log Out</span></a></li>
    </ul>
  </div>
</nav>
<div class='container'>
  <table class="table table-bordered th, .table-bordered td { border: 1px solid #ddd!important }">
    <thead>
      <tr>
        <th>Title</th>
        <th>Genre</th>
        <th>Author</th>
		<th>Supplier</th>
		<th>Publisher</th>
		<th>Price</th>
		<th>Available</th>
		<th>CART</th>
      </tr>
    </thead>
    <tbody>
<?php
$sql="SELECT book.book_id,book.title,book.price,book.available,book.genre,supplier.name as sname,author.name as aname,publisher.name as pname from book inner join supplier on book.sup_id=supplier.sup_id inner join author on book.author_id=author.author_id inner join publisher on book.pub_id=publisher.pub_id;";
$res=$conn->query($sql);
while($row=mysqli_fetch_assoc($res))
{
?>
      <tr id='book<?php echo $row["book_id"]; ?>'>
        <td><?php echo $row["title"]; ?></td>
        <td><?php echo $row["genre"]; ?></td>
        <td><?php echo $row["aname"]; ?></td>
		<td><?php echo $row["sname"]; ?></td>
		<td><?php echo $row["pname"]; ?></td>
		<td><?php echo $row["price"]; ?></td>
		<td><?php echo $row["available"]; ?></td>
		<td><button type="button" class="btn btn-primary" onclick="addCart('<?php echo $row["book_id"]; ?>')">Add</button></td>
      </tr>
<?php
}
?>
    </tbody>
  </table>
</div>
</body>
</html>
<script>
function addCart(id)
{
	tr=document.getElementById('book'+id);
	td=tr.getElementsByTagName('td');
	if(td[6].innerHTML!='0')
	{
		form=document.createElement('form');
		form.setAttribute('action','member.php');
		form.setAttribute('method','POST');
		i1=document.createElement('input');
		i1.setAttribute('name','book_id');
		i1.setAttribute('type','text');
		i1.setAttribute('value',id);
		i2=document.createElement('input');
		i2.setAttribute('name','add_submit');
		i2.setAttribute('type','submit');
		form.appendChild(i1);
		form.appendChild(i2);
		i2.click();
	}
	else
	{
		window.alert("Selected book is not available");
	}
}
</script>