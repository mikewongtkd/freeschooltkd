<?php
	include_once( "$prefix/lib/php/Spyc.php" );
	if( file_exists( "$prefix/conf/conf.yml" )) { $config = spyc_load_file( "$prefix/conf/conf.yml" );         } 
	else                                        { $config = spyc_load_file( "$prefix/conf/conf.default.yml" ); }
	date_default_timezone_set( 'America/Los_Angeles' );

	# ===== BASE URL
	if( $config[ 'webserver' ][ 'protocol' ] == 'http' || $config[ 'webeserver' ][ 'port' ] == 80 ) {
		$config[ 'webserver' ][ 'base_url' ] = 'http://' . $config[ 'webserver' ][ 'host' ];

	} else if( $config[ 'webserver' ][ 'protocol' ] == 'https' || $config[ 'webserver' ][ 'port' ] == 443 ) {
		$config[ 'webserver' ][ 'base_url' ] = 'https://' . $config[ 'webserver' ][ 'host' ];

	} else {
		$config[ 'webserver' ][ 'base_url' ] = $config[ 'webserver' ][ 'protocol' ] . '://' . $config[ 'webserver' ][ 'host' ] . ':' . $config[ 'webserver' ][ 'port' ];
	}

	function base_url( ...$paths ) {
		global $config;
		$list = [];
		foreach( $paths as $path ) { $list = array_merge( $list, explode( '/', $path )); }
		return $config[ 'webserver' ][ 'base_url' ] . preg_replace( "|/+|", "/",  '/' . $config[ 'webserver' ][ 'subdir' ] . '/' . join( '/', $list ));
	}

	# ===== DOCUMENT PATH
	if( $config[ 'webserver' ][ 'subdir' ] ) {
		$config[ 'webserver' ][ 'docpath' ] = $config[ 'webserver' ][ 'docroot' ] . '/' . $config[ 'webserver' ][ 'subdir' ];
	} else {
		$config[ 'webserver' ][ 'docpath' ] = $config[ 'webserver' ][ 'docroot' ];
	}
	$config[ 'webserver' ][ 'docpath' ] = preg_replace( "/\/\/+/", "/", $config[ 'webserver' ][ 'docpath' ] );
	$config[ 'webserver' ][ 'docpath' ] = preg_replace( "/\/$/", "", $config[ 'webserver' ][ 'docpath' ] );

	function doc_path( ...$paths ) {
		global $config;
		$list = [ $config[ 'webserver' ][ 'docpath' ] ];
		foreach( $paths as $path ) { $list = array_merge( $list, explode( '/', $path )); }
		return preg_replace( "|/+|", "/", join( '/', $list ));
	}
?>
