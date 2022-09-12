<?php

// Filesystem Approach

require_once( ABSPATH . 'wp-admin/includes/file.php' );

WP_Filesystem();

$local_file =  wp_normalize_path ( get_stylesheet_directory() . "/node_modules/web-vitals/dist/polyfill.js" );

global $wp_filesystem;

if ( $wp_filesystem->exists( $local_file ) ) {

    $polyfill_content = $wp_filesystem->get_contents( $local_file );

} 

//files_get_content approach

// $polyfill_content = file_get_contents( wp_normalize_path ( get_stylesheet_directory() . "/node_modules/web-vitals/dist/polyfill.js" ) );


?>

<script type="text/javascript">

  <?php  echo ( $polyfill_content ); // 2C  ?>

</script>