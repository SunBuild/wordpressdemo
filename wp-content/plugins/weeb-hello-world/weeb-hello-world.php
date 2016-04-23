<?php

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
    echo "Hello Azure !!!";
 
}

?>
