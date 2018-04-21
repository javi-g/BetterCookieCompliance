<?php
/**
Después de experimentación, aquí os enseño un código de inserción de Google Analytics con una idea muy loca, y totalmente pensado un requisito de la legislación española no presente en otros países.

No sé si cumple la ley pero es una vuelta muy crazy al cumplimiento legislativo, ya que en realidad el identificador del usuario, si no nos han dado aceptacin a las cookies, pasa a ser el ID de sesión de la web, y por tanto un valor técnico y generado en el propio sitio, no en un sistema de terceros.

After several experiments, we show you a very crazy code of insertion of Google Analytics, that's try to obey the Spanish specific regulation about cookies.
**/

global $wp_filter;

// Analytics want just before </head>, so get the lowest priority
$lowest_priority = max( array_keys( array( $wp_filter['wp_head'] ) ) ); 

add_action( 'wp_head', 'usm_universal_analytics_nocookie', $lowest_priority ); 
/**
 * If we have set ID for Google Analytics this function insert Universal Analytics if cookies are not yet accepted, and check PHPSESSID for random value if is not set
 */
function usm_universal_analytics_nocookie() {

	if ( isset( $_COOKIE['PHPSESSID']) ) { 
		$id_analytics = $_COOKIE['PHPSESSID']; 
	} else { 
		$id_analytics = rand( 0, 5000 ); 
	} 

	$id_UA_analytics = get_option('usm_analytics');

	if ($id_UA_analytics != '') {
	?>
	<script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

	  ga('create', '<?php echo $id_UA_analytics;?>', { 'storage': 'none',  'clientId': '<?php echo $id_analytics;?>'});
	  ga('set', 'anonymizeIp', true);
	  ga('send', 'pageview');
	</script>

	<?php
	}
}
