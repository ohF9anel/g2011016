<?php 
include('auth.php');
$results = mysql_query("select * from time_types order by description");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Main Menu</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="timeapp.css" type="text/css">
</head>

<body>
<?php include "nav.php";?>
<h1>Time Types</h1>
<p><a href="add_type.php">Add Type</a></p>
<table id="box-table-a">
<thead>
	<tr>
		<th>Time Id</th>
		<th>Description</th>
		<th colspan="2">Action</th>
	</tr>
</thead>	
<tbody>
<?php 
	if($row = mysql_fetch_array($results)){
		do{
?>
	<tr>
		<td><?php  echo $row['type_id']?></td>
		<td><?php  echo $row['description']?></td>
		<td><a href="edit_type.php?type_id=<?php  echo $row['type_id']?>">edit</a></td>
		<td><a href="delete_type.php?type_id=<?php  echo $row['type_id']?>">delete</a></td>
	</tr>
<?php 
		}while($row = mysql_fetch_array($results));
	}else{
?>
	<tr>
		<td colspan="100%">Currently no time types on file.</td>
	</tr>
<?php 
	}
?>
</tbody>
</table>

<?php  include('footer.php')?>
</body>
</html>
