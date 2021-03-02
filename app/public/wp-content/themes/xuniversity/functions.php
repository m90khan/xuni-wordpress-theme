<?php 
function uni_files() {
	wp_enqueue_script('mainuni_js', get_theme_file_uri('/js/scripts-bundled.js'), NULL, microtime(), true); // NULL: dependency. version, load before or after body tag  
	 wp_enqueue_style('custom-google-fonts', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
	wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
	// load javascript and css files
	wp_enqueue_style('uni_main_styles', get_stylesheet_uri(), NULL, microtime());   
	//first: name for stylesheet_second: localtion to point towards file
}
add_action('wp_enqueue_scripts','uni_files');


function uni_title(){
	register_nav_menu('headerMenuLocation', 'Header Menu Location');
	add_theme_support('title-tag');
}
add_action('after_setup_theme', 'uni_title');