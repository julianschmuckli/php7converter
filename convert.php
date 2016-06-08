<?php
//Fehler anzeigen
ini_set('display_errors',0);
ini_set('display_startup_errors',0);
error_reporting(-1);
	//Convert Process
	$code = trim(htmlspecialchars($_POST["code"]));
	$connection_variable = trim(htmlspecialchars($_POST["connection_variable"]));
	$code = str_replace("mysql_query(",'mysqli_query($con,',$code,$count_query_changes);
	$code = str_replace("mysql_real_escape_string(",'mysqli_real_escape_string($con,',$code,$count_mysql_real_escape);
	$code = str_replace("mysql_connect(",'$con = mysqli_connect(',$code);
	$code = str_replace("mysql_select_db(",'mysqli_select_db($con,',$code);
	$code = str_replace("mysql_error()",'mysqli_error($con)',$code);
	$code = str_replace("mysql_set_charset(",'mysqli_set_charset($con,',$code);
	$code = str_replace("mysql_","mysqli_",$code,$count_mysql_changes);
	//Verschönerungen
	$code = str_replace("{
	if",'{
		if',$code);
	$code = str_replace("}
	}",'}
}',$code);
if($connection_variable!=""){
				$code = str_replace("$connection_variable =","",$code);
				$code = str_replace("$connection_variable=","",$code);
			}
	
?>
<html>
	<head>
		<title>Result</title>
		<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.3.0/styles/default.min.css">
		<script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.3.0/highlight.min.js"></script>
		<script>hljs.initHighlightingOnLoad();</script>
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

		<!-- Optional theme -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

		<!-- Latest compiled and minified JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
	</head>
	<body>
		<pre><code class="php"><?php echo $code; ?></code></pre>
		<div style="width:300px;margin-left:auto;margin-right:auto;">
			<h2>Changes</h2>
			<table class="table table-striped">
				<tr>
					<td><?php echo $count_query_changes; ?></td>
					<td>"mysql_query" Changes</td>
				</tr>
				<tr>
					<td><?php echo $count_mysql_real_escape; ?></td>
					<td>"mysql_real_escape_string" Changes</td>				
				</tr>
				<tr>
					<td><?php echo $count_mysql_changes; ?></td>
					<td>Other "mysql" Changes</td>
				</tr>
			</table>
		</div>
		<form action="index.php" method="post" style="width:90%;margin-left:auto;margin-right:auto;">
			<input type="submit" class="btn btn-default" style="width:100%;margin-left:auto;margin-right:auto;" value="New code">
		</form><br>
		<form action="index_multi.php" method="post" style="width:90%;margin-left:auto;margin-right:auto;">
			<input type="submit" class="btn btn-default" style="width:100%;margin-left:auto;margin-right:auto;" value="New directory">
		</form>
	</body>
</html>