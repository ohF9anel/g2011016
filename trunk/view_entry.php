<?php 
include('auth.php');

$user_id = $_GET['user_id'];
$period_id = $_GET['period_id'];

$iresults = mysql_query("select * from user_info where user_id = $user_id");
$irow = mysql_fetch_array($iresults);

$presults = mysql_query("select * from time_periods where period_id = $period_id");
$prow = mysql_fetch_array($presults);
$start_date = $prow['start_date'];
$end_date = $prow['end_date'];

$results = mysql_query("select * from time_data where user_id = $user_id and data_date >= '$start_date' and data_date <= '$end_date' order by data_date");
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
<h1>Time Entries for <?php  echo $irow['fname']?> <?php  echo $irow['lname']?></h1>
<h2><a href="view_data.php?period_id=<?php  echo $period_id?>">Back</a></h2>
<table id="box-table-a">
<thead>
	<tr>
		<th>Date</td>
		<th>Type</th>
		<th>Hours</th>
		<th>Notes</th>
	</tr>
<?php 
	if($row = mysql_fetch_array($results)){
		do{
			$data_date = $row['data_date'];
			$type_id = $row['type_id'];
			$tresult = mysql_query("select description from time_types where type_id = $type_id");
			$trow = mysql_fetch_array($tresult);
			
?>
</thead>
<tbody>
	<tr>
		<td><?php  echo date('m/d/Y', strtotime($data_date))?></td>
		<td><?php  echo $trow['description']?></td>
		<td><?php  echo $row['hours']?></td>
		<td><?php  echo $row['notes']?></td>
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
</tbody>
</table>
			
<table id="box-table-a">
<thead>
<tr><th colspan="100%">Totals Hours</th></tr>
</thead>
<?php 
	$total_hours = 0;
	$total_results = mysql_query("select * from time_types order by type_id");
	if($ttrow = mysql_fetch_array($total_results)){
		do{
			$type_id = $ttrow['type_id'];
			$description = $ttrow['description'];
			$xresults = mysql_query("select sum(hours) as sum_hours from time_data where user_id = $user_id and data_date >= '$start_date' and data_date <= '$end_date' and type_id = $type_id");
			$xrow = mysql_fetch_array($xresults);
			$total_hours += $xrow['sum_hours'];
			$sum_hours = $xrow['sum_hours'];
			if(strlen($sum_hours) < 1){
				$sum_hours = 0;
			}
?>
<tbody>
	<tr>
		<td><?php  echo $description?></td><td align="right"><?php  echo $sum_hours?></td>
	</tr>
<?php 
		}while($ttrow = mysql_fetch_array($total_results));
	}
?>
<tr><td>Total</td><td align="right"><?php  echo $total_hours?></td></tr>
</tbody>
</table>

<?php  include('footer.php')?>			
</body>
</html>
