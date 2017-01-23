<?php
	function load_students( $path ) {
		$students = [];
		$dh = opendir( $path );
		while(( $file = readdir( $dh )) !== false ) {
			if( 
				filetype( "$path/$file" ) == 'dir' && 
				! preg_match( "/^\./", $file ) &&
				! preg_match( "/^master/i", $file ) &&
				! preg_match( "/^instructor/i", $file )
			) {
				array_push( $students, $file );
			}
		}
		closedir( $dh );
		return $students;
	};
?>
