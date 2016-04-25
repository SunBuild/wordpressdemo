<?php
/*
Plugin Name: Hello Azure
Plugin URI: http://test.com
Description: A hello azure  to demonstrate cron 
Version: 1.0
Author: Sample
Author URI: http://test.com
License: GPL
*/

//Hooks a function to a filter action, 'the_content' being the action, 'hello_world' the function.
add_filter('the_content','hello_world');

//Callback function
function hello_world($content)
{
	//Checking if on post page.
	if ( is_single() ) {
		//Adding custom content to end of post.
		return $content . "<h2 style=\"color:#eb911d\"> Hello Azure ! </h2>";
	}
	else {
		//else on blog page / home page etc, just return content as usual.
		return $content;
	}
}

add_filter( 'cron_schedules', 'bl_add_cron_intervals' );

function bl_add_cron_intervals( $schedules ) {

   $schedules['5seconds'] = array( // Provide the programmatic name to be used in code
      'interval' => 5, // Intervals are listed in seconds
      'display' => __('Every 5 Seconds') // Easy to read display name
   );
   return $schedules; // Do not forget to give back the list of schedules!
}

add_action( 'bl_cron_hook', 'bl_cron_exec' );

if( !wp_next_scheduled( 'bl_cron_hook' ) ) {
   wp_schedule_event( time(), '5seconds', 'bl_cron_hook' );
}

function bl_cron_exec() {
   echo "This is your scheduled cron, grinding out some hardcore tasks!<br/><img src='https://wordpressdemostorage2.blob.core.windows.net/test/technology-funny-evolution-to-computer.jpg'/>";
}

?>