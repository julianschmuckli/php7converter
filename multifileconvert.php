<?php
//Fehler anzeigen
ini_set('display_errors',0);
ini_set('display_startup_errors',0);
error_reporting(-1);
	//Convert Process
	$dir = str_replace("/","\\",trim(htmlspecialchars($_POST["dir"])));
	$connection_variable = trim(htmlspecialchars($_POST["connection_variable"]));
	if($dir==""){
		header("Location:index_multi.php");
		exit;
	}
	if(!is_dir($dir)){
		header("Location:index_multi.php");
		exit;
	}
	$directorys = scandir($dir);
	for($i=2;$i<count($directorys);$i++){
		$pathinfo = pathinfo(("$dir".'\\'.$directorys[$i]));
		if($pathinfo['extension']=="php"){
			$code = file_get_contents("$dir".'\\'.$directorys[$i]);
			$code = str_replace("mysql_query(",'mysqli_query($con,',$code,$count_query_changes);
			$code = str_replace("mysql_real_escape_string(",'mysqli_real_escape_string($con,',$code,$count_mysql_real_escape);
			$code = str_replace("mysql_connect(",'$con = mysqli_connect(',$code,$count_mysql_connect);
			$code = str_replace("mysql_select_db(",'mysqli_select_db($con,',$code,$count_mysql_select_db);
			$code = str_replace("mysql_error()",'mysqli_error($con)',$code,$count_mysql_error);
			$code = str_replace("mysql_set_charset(",'mysqli_set_charset($con,',$code,$count_mysql_charset);
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
			file_put_contents("$dir".'\\'.$directorys[$i],$code);
			//Totale Berechnungen
			$total_count_query_changes+=$count_query_changes;
			$total_count_mysql_real_escape+=$count_mysql_real_escape;
			$total_count_mysql_changes+=$count_mysql_changes;
			$total_count_mysql_charset+=$count_mysql_charset;
			$total_count_mysql_error+=$count_mysql_error;
			$total_count_mysql_connect+=$count_mysql_connect;
			$total_count_mysql_select_db+=$count_mysql_select_db;			
			
			$total_changes=$count_mysql_changes+$count_mysql_charset+$count_mysql_connect+$count_mysql_error+$count_mysql_real_escape+$count_mysql_select_db+$count_query_changes;
			
			echo "<span style='color:green;'>Log.Success</span> ".date("H:i:s")." "."$dir".'\\'.$directorys[$i]." <b>converted</b><br>
			<i>$total_changes</i> Total Changes";
		}else{
			echo "<span style='color:blue;'>Log.Hint</span> ".date("H:i:s")." "."$dir".'\\'.$directorys[$i]." is not a PHP-File and can't be converted.";
		}
		echo "<br>";
	}
?>
<html>
	<head>
		<title>PHP 7 Converter</title>
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
	<body style="width:90%;margin-left:auto;margin-right:auto;">
		<h2>Done!</h2>
		<p>The files in <b><?php echo $dir; ?></b> had been converted.</p>
		<div style="width:300px;margin-left:auto;margin-right:auto;">
			<h2>Changes</h2>
			<table class="table table-striped">
				<tr>
					<td><?php echo $total_count_query_changes; ?></td>
					<td>"mysql_query" Changes</td>
				</tr>
				<tr>
					<td><?php echo $total_count_mysql_connect; ?></td>
					<td>"mysql_connect" Changes</td>				
				</tr>
				<tr>
					<td><?php echo $total_count_mysql_charset; ?></td>
					<td>"mysql_charset" Changes</td>				
				</tr>
				<tr>
					<td><?php echo $total_count_mysql_error; ?></td>
					<td>"mysql_error" Changes</td>				
				</tr>
				<tr>
					<td><?php echo $total_count_mysql_select_db; ?></td>
					<td>"mysql_select_db" Changes</td>				
				</tr>
				<tr>
					<td><?php echo $total_count_mysql_real_escape; ?></td>
					<td>"mysql_real_escape_string" Changes</td>				
				</tr>
				<tr>
					<td><?php echo $total_count_mysql_changes; ?></td>
					<td>Other "mysql" Changes</td>
				</tr>
			</table>
		</div>
		<form action="index_multi.php" method="post" style="width:90%;margin-left:auto;margin-right:auto;">
			<input type="submit" class="btn btn-default" style="width:100%;margin-left:auto;margin-right:auto;" value="New directory">
		</form>
	</body>
</html>