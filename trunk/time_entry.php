<?php 
include('auth.php');
$results = mysql_query("select * from time_data where user_id = $timeapp_id order by data_date desc limit $time_entry_display_rows;");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Time Application</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="timeapp.css" type="text/css">
</head>
<body>
<?php include "nav.php";?>
<h1>Time Entry</h1>
<h2><a href="add_entry.php">Add Entry</a></h2>
<table id="box-table-a">
	<tr>
		<td colspan="100%"></td>
	</tr>
	<tr>
		<th>Date</th>
		<th>Type</th>
		<th>Hours</th>
		<th>Notes</th>
		<th>Action</th>
	</tr>
<?php 
	if($row = mysql_fetch_array($results)){
		do{
			$data_date = $row['data_date'];
			$type_id = $row['type_id'];
			$tresult = mysql_query("select description from time_types where type_id = $type_id;");
			$trow = mysql_fetch_array($tresult);
			
?>
	<tr>
		<td><?php  echo date('m/d/Y', strtotime($data_date))?></td>
		<td><?php  echo $trow['description']?></td>
		<td><?php  echo $row['hours']?></td>
		<td><?php  echo $row['notes']?></td>
		<td><a href="edit_entry.php?time_id=<?php  echo $row['time_id']?>">Edit</a>
		&nbsp;<a href="delete_entry.php?time_id=<?php  echo $row['time_id']?>">Delete</a>
		</td>
	</tr>
<?php 
		}while($row = mysql_fetch_array($results));
	}else{
?>
	<tr>
		<td align="center" colspan="100%">Currently no time entry on file.</td>
	</tr>
<?php 
	}
?>
</table>
<?php  include('footer.php')?>
</body>
</html>
