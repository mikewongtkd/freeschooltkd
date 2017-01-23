<?php
	function load_instructors( $path ) {
		$instructors = [];
		$dh = opendir( $path );
		while(( $file = readdir( $dh )) !== false ) {
			if( 
				filetype( "$path/$file" ) == 'dir' && 
				( preg_match( "/^master/i", $file ) || preg_match( "/^instructor/i", $file ) )
			) {
				array_push( $instructors, $file );
			}
		}
		closedir( $dh );
		return $instructors;
	};
?>
