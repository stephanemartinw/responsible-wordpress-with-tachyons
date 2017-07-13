<?php
/**
 ***************************************************
* Google Analytics in Wistiti
*****************************************************/

/*
* GA Tracking code in footer
*/
function wistiti_ga_tracking_code() {

		$tool = get_option('wistiti_tool', array() );
		if (!empty($tool) && isset($tool['ga_code']) && !empty($tool['ga_code'])){
      $snippet = sprintf("<script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

        ga('create', '%s', 'auto');
        ga('send', 'pageview');

      </script>", $tool['ga_code']);

			echo $snippet;
    }
}
add_filter( 'wp_footer', 'wistiti_ga_tracking_code' );
?>
