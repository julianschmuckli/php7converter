<html>
	<head>
		<title>PHP 7 Converter</title>
		<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.3.0/styles/default.min.css">
		<script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.3.0/highlight.min.js"></script>
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

		<!-- Optional theme -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

		<!-- Latest compiled and minified JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
	</head>
	<body>
		<form action="multifileconvert.php" method="post" style="width:90%;margin-left:auto;margin-right:auto;">
			<h2>Multi-Files PHP 7 Converter</h2>
			<p>Put in your path and click convert.</p>
			<input type="text" class="form-control" style="width:100%;margin-left:auto;margin-right:auto;" autocomplete="on" placeholder="Directory (C:\...)*" name="dir" required>
			<br>
			<input type="text" class="form-control" style="width:100%;margin-left:auto;margin-right:auto;" autocomplete="off" placeholder="Previous Connection variable (with $)" name="connection_variable">
			<br>
			<input type="submit" class="btn btn-default" style="width:100%;margin-left:auto;margin-right:auto;" value="Convert">
			<br>
			<p>PHP 7 Converter by Julian Schmuckli<br>Version 1.1</p><br>
			<p>* Required</p>
		</form><br>
		<form action="index.php" method="post" style="width:90%;margin-left:auto;margin-right:auto;">
			<input type="submit" class="btn btn-default" style="width:100%;margin-left:auto;margin-right:auto;" value="Convert code">
		</form>
	</body>
</html>