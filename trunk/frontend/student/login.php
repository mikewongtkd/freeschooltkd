<?php
	$prefix = '/usr/local/openstudio';
	include_once( "$prefix/lib/php/config.php" );
	include_once( "$prefix/lib/php/students.php" );
	$students = load_students( "$prefix/data/users" );

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

		<link href="../include/bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link href="../include/alertify/css/alertify.min.css" rel="stylesheet">
		<link href="../include/animate/animate.css" rel="stylesheet">
		<link href="../include/css/jumbotron.css" rel="stylesheet">
		<link href="../include/css/students.css" rel="stylesheet">

	</head>

	<body>
		<nav class="navbar navbar-inverse navbar-fixed-top">
			<div class="container">
				<div class="navbar-header">
					<a class="navbar-brand" href="../index.php"><?php $logo = doc_path( 'images', $config[ 'logo' ]); if( file_exists( $logo )) { echo '<img src="../images/' . $config[ 'logo' ] . '">'; } else { echo $config[ 'company' ]; } ?></a>
				</div>
			</div>
		</nav>

		<div class="container">
			<div id="students"></div>
			<div class="row" id="student-sign-in">
				<div class="col-lg-8">
					<div class="box" id="info">
						<h1>Name</h1>
						<p>Rank</p>
						<p>Awards</p>
						<p>Competition Record</p>
						<a class="btn btn-lg btn-danger  cancel" >Cancel</a>
						<a class="btn btn-lg btn-success confirm">Sign In</a>
					</div>
				</div>
				<div class="col-lg-4"><div id="portrait"></div></div>
			</div>
		</div>
		<footer><p>&copy; <?= date( 'Y' ) ?> <?= $config[ 'company' ] ?>, Inc.</p></footer>

		<!-- Bootstrap core JavaScript
		================================================== -->
		<!-- Placed at the end of the document so the pages load faster -->
		<script src="../include/jquery/js/jquery.min.js"></script>
		<script src="../include/bootstrap/js/bootstrap.min.js"></script>
		<script src="../include/alertify/js/alertify.min.js"></script>
		<script src="../include/string/string.js"></script>
		<script>
			$( function() {
				$( '.navbar-header img' ).animate({ width: '100px' });
			});
			S.extendPrototype();
			var students = <?= json_encode( $students ) ?>;
			$( '#student-sign-in' ).hide();

			var lineUp = function() {
				function lineUpAnimation() {
					$( '#students' ).empty().show();
					students.forEach( function( s ) {
						var entrances  = [ 'bounceInUp',  'bounceInDown',  'bounceInRight',  'bounceInLeft'  ];
						var exits      = [ 'bounceOutUp', 'bounceOutDown', 'bounceOutRight', 'bounceOutLeft' ];
						var enter      = entrances[ ( Math.floor( Math.random() * entrances.length ))];
						var leave      = exits[( Math.floor( Math.random() * exits.length ))];
						var student    = $( '<div class="student"/>' ).clone().attr({ name : s });
						var portrait   = $( '<img />' ).addClass( "head-portrait" ).attr({ src: `../users/${s}/portrait.jpg` });
						student.append( portrait );
						student.addClass( 'animated ' + enter ).attr({ 'enter' : enter, 'leave' : leave });
						$( '#students' ).append( student );

						student.click( function( ev ) {
							var clicked = $( ev.target );
							if( ! clicked.is( '.student' ) ) { clicked = clicked.parents( '.student' ); }
							$( '#students .student' ).not( clicked ).each( function( i, s ) {
								var student = $( s );
								student.removeClass( student.attr( 'enter' ));
								student.addClass( student.attr( 'leave' ));
							});

							// ===== ANIMATE THE CLICKED STUDENT TO RUN AWAY AND SHOW THE SIGN-IN DIALOG
							setTimeout( function() { clicked.removeClass( student.attr( 'enter' )).addClass( 'fadeOutUpBig' ); }, 850 );
							setTimeout( function() { $( '#students' ).hide(); signIn( clicked ); }, 1250 );
						});
					});
				}
				if( $( '#student-sign-in' ).hasClass( 'bounceInDown' )) {
					$( '#student-sign-in' ).removeClass( 'bounceInDown' ).addClass( 'bounceOutUp' );
					setTimeout( lineUpAnimation, 500 );
				} else {
					$( '#student-sign-in' ).hide();
					lineUpAnimation();
				}
			}

			var signIn = function( student ) {
				$( '#students' ).hide();
				if( $( '#student-sign-in' ).hasClass( 'bounceOutUp' )) {
					$( '#student-sign-in' ).show().removeClass( 'bounceOutUp' ).addClass( 'bounceInDown' );
				} else {
					$( '#student-sign-in' ).show().addClass( 'animated bounceInDown' );
				}
				var name = student.attr( 'name' );
				var portrait   = $( '<img />' ).attr({ src: `../users/${name}/portrait.jpg`, name: name });
				$( '#student-sign-in #portrait' ).empty().append( portrait );
				$( '#student-sign-in #info h1' ).empty().append( "Welcome " + name.humanize());
				$( '#student-sign-in #info a.confirm' ).off( 'click' ).click( function( ev ) {
					alertify.success( name.humanize() + ' has signed in.' );
					lineUp();
				});
				$( '#student-sign-in #info a.cancel' ).off( 'click' ).click( function( ev ) {
					lineUp();
				});
			};
			$( function() {
				lineUp()
			});
		</script>
	</body>
</html>

