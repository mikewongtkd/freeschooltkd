<?php
	include_once( "$prefix/lib/php/Spyc.php" );
	if( file_exists( "$prefix/conf/conf.yml" )) { $config = spyc_load_file( "$prefix/conf/conf.yml" );         } 
	else                                        { $config = spyc_load_file( "$prefix/conf/conf.default.yml" ); }
	date_default_timezone_set( 'America/Los_Angeles' );
?>
