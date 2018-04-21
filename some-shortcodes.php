<?php 
/*
Algunas funciones que incluimos en nuestro plugin.
Obtenemos el valor de si está la cookie de aceptación en el navegador (o no) y en función de eso servimos un tipo de contenido u otro en la web.

Some shortcodes from our plugin.
We ask first if there is accepted the cookie (with the settings) and if it's accepted, or not, we show the content between the shortcodes tags.
*/

add_shortcode('USM_OK_COOKIES', 'usm_ok_cookies');

function usm_ok_cookies($atts, $content = null) {

	$nombrecookieaceptacion = get_option('usm_nombre');

	if ( 1 == $_COOKIE[ $nombrecookieaceptacion ] ){
		return do_shortcode( $content );
	} else { 
		return ''; 
	}
}

add_shortcode('USM_NO_COOKIES', 'usm_no_cookies');


function usm_no_cookies($atts, $content = null) {

	$nombrecookieaceptacion = get_option('usm_nombre');

	if ( 1 == $_COOKIE[ $nombrecookieaceptacion ] ){
		return ''; 
	} else { 
		return do_shortcode( $content );
	}
}
add_shortcode('USM_COOKIES', 'usm_show_notice_cookies');
