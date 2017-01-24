<?php
	$prefix = '/usr/local/openstudio';
	include_once( "$prefix/lib/php/config.php" );
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		<meta name="description" content="">
		<meta name="author" content="">
		<link rel="icon" href="../../favicon.ico">

	<title><?= $config[ 'company' ] ?>&mdash;<?= $config[ 'brief' ] ?></title>

		<link href="include/bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link href="include/css/index.css" rel="stylesheet">

	</head>

	<body>

		<nav class="navbar navbar-inverse navbar-fixed-top">
			<div class="container">
				<div class="navbar-header">
					<a class="navbar-brand disabled"><?php $logo = doc_path( 'images', $config[ 'logo' ]); if( file_exists( $logo )) { echo '<img src="images/' . $config[ 'logo' ] . '">'; } else { echo $config[ 'company' ]; } ?></a>
				</div>
			</div>
		</nav>

		<!-- Main jumbotron for a primary marketing message or call to action -->
		<div class="jumbotron" style="background-image: url( '<?= base_url( 'images', $config[ 'banner' ] ) ?>' )">
			<div class="container">
				<h1>Welcome</h1>
				<p>Tiger Martial Arts is proud to provide quality martial arts instruction to the Bay Area.</p>
				<p><a class="btn btn-primary btn-lg" href="student/login.php" role="button">Student Sign In &raquo;</a>
				<a class="btn btn-success btn-lg" href="instructor/login.php" role="button">Instructor Sign In &raquo;</a></p>
			</div>
		</div>

		<div class="container">
			<!-- Example row of columns -->
			<div class="row">
				<div class="col-md-4">
					<h2>Class Schedule</h2>
					<p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
					<p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
				</div>
				<div class="col-md-4">
					<h2>Progress</h2>
					<p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
					<p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
			 </div>
				<div class="col-md-4">
					<h2>Calendar</h2>
					<p>Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
					<p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
				</div>
			</div>

			<hr>

		</div> <!-- /container -->
		<footer> <p>&copy; <?= date( 'Y' ) ?> <?= $config[ 'company' ] ?>, Inc.</p> </footer>


		<!-- Bootstrap core JavaScript
		================================================== -->
		<!-- Placed at the end of the document so the pages load faster -->
		<script>
			var config = <?= json_encode( $config ) ?>;
		</script>
		<script src="include/jquery/js/jquery.min.js"></script>
		<script src="include/bootstrap/js/bootstrap.min.js"></script>
	</body>
</html>

