<?php 
	include('auth.php');
	
	$period_id = $_GET['period_id'];
	
	$result = mysql_query("select * from time_periods where period_id = $period_id");
	$row = mysql_fetch_array($result);
	
	$start_date = $row['start_date'];
	$end_date = $row['end_date'];
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
<h1>Time Data</h1>
<h2><a href="time_periods.php?period_id=<?php  echo $period_id?>">Back</a></h2>

<table id="box-table-a">
<thead>
	<tr>
		<th>Name</th>
		<th>Action</th>
	</tr>
</thead>	
<?php 
$uresults = mysql_query("select distinct user_id from time_data where data_date >= '$start_date' and data_date <= '$end_date'");
if($urow = mysql_fetch_array($uresults)){
	do{
		$user_id = $urow['user_id'];
		
		$dresult = mysql_query("select * from user_info where user_id = $user_id");
		$drow = mysql_fetch_array($dresult);	
?>
<tbody>
	<tr>
		<td><?php  echo $drow['lname']?>, <?php  echo $drow['fname']?></td>
		<td><a href="view_entry.php?period_id=<?php  echo $period_id?>&user_id=<?php  echo $drow['user_id']?>">View</a></td>
	</tr>
<?php 
		}while($urow = mysql_fetch_array($uresults));
	}else{
?>
	<tr>
		<td colspan="100%">Currently no time entry on file.</td>
	</tr>
<?php 
	}
?>
</tbody>
</table>
<?php  include('footer.php')?>
</body>
</html>
