<?php
// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

// add_filter( 'vc_shortcode_output', 'bb_sm_filter', 10, 3 );
// 
// function bb_sm_filter( $output, $obj, $attr ) {
// 
// 	if(!BestBugSMHelper::$shortcodes_active) {
// 		return $output;
// 	}
// 	echo 'shanks' ; var_dump($obj->settings( 'base' ));
// 	
// 
// 	if ( in_array($obj->settings( 'base' ), BestBugSMHelper::$shortcodes_active ) || BestBugSMHelper::$option_by_elements == 'all' ) {
// 
// 		if( empty($attr['bb_sm_mode']) || $attr['bb_sm_mode'] != 'yes' || empty($attr['bbsm_scene']) ) {
// 			return $output;
// 		}
// 
// 		$html = str_get_html( $output );
// 		$scene = str_replace(","," ", $attr['bbsm_scene']);
// 
// 		$html->firstChild()->class .= ' ' . $scene;
// 
// 		$output = $html;
// 
// 	}
// 
// 	return $output;
// }

add_filter( 'vc_shortcodes_css_class', 'bb_sm_filter', 10, 3 );

function bb_sm_filter( $class_string, $tag, $atts = null ) {

	if(!BestBugSMHelper::$shortcodes_active) {
		return $class_string;
	}
	
	if(!isset($atts['bbsm_scene'])) {
		return $class_string;
	}
	$scene = str_replace(","," ", $atts['bbsm_scene']);
	$class_string .= ' ' . $scene;
	return $class_string;
}

