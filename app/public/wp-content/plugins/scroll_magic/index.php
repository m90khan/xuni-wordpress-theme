<?php
/*
Plugin Name: Scroll Magic
Description: Scroll Magic - Scrolling animation builder.
Author: BestBug
Version: 3.1
Author URI: http://lamblue.com/scroll-magic
Text Domain: bestbug
Domain Path: /languages
*/

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

defined( 'BESTBUG_SM_URL' ) or define('BESTBUG_SM_URL', plugins_url( '/', __FILE__ )) ;
defined( 'BESTBUG_SM_PATH' ) or define('BESTBUG_SM_PATH', basename( dirname( __FILE__ ))) ;
defined( 'BESTBUG_SM_TEXTDOMAIN' ) or define('BESTBUG_SM_TEXTDOMAIN', plugins_url( '/', __FILE__ )) ;

defined( 'BESTBUG_SM_SHORTCODE' ) or define('BESTBUG_SM_SHORTCODE', 'bb_sm') ;
defined( 'BESTBUG_SMIMAGE_SHORTCODE' ) or define('BESTBUG_SMIMAGE_SHORTCODE', 'bb_sm_imagesequence') ;
defined( 'BESTBUG_SM_IMG_GROUP_SHORTCODE' ) or define('BESTBUG_SM_IMG_GROUP_SHORTCODE', 'bb_sm_image_group') ;
defined( 'BESTBUG_SM_SINGLE_IMAGE_SHORTCODE' ) or define('BESTBUG_SM_SINGLE_IMAGE_SHORTCODE', 'bb_sm_single_image') ;
defined( 'BESTBUG_SM_EMPTY_SPACE_SHORTCODE' ) or define('BESTBUG_SM_EMPTY_SPACE_SHORTCODE', 'bb_sm_empty_space') ;


defined( 'BESTBUG_SM_CATEGORY' ) or define('BESTBUG_SM_CATEGORY', 'Scroll Magic') ;

// Option field
defined( 'BESTBUG_SM_OPTIONS_BY_ELEMENTS' ) or define('BESTBUG_SM_OPTIONS_BY_ELEMENTS', 'bb_sm_option_by_elements') ;
defined( 'BESTBUG_SM_CUSTOM_ELEMENTS' ) or define('BESTBUG_SM_CUSTOM_ELEMENTS', 'bb_sm_custom_elements') ;
defined( 'BESTBUG_SM_MOBILE_MODE' ) or define('BESTBUG_SM_MOBILE_MODE', 'bb_sm_mobile_mode') ;
defined( 'BESTBUG_SM_ALLOW_CLASS_NAME' ) or define('BESTBUG_SM_ALLOW_CLASS_NAME', 'bbvcvs_allow_class_name') ;

defined( 'BESTBUG_SM_SMOOTHSCROLL_MODE' ) or define('BESTBUG_SM_SMOOTHSCROLL_MODE', 'bb_sm_smoothscroll_mode');

defined( 'BESTBUG_SM_SCENE_ORDERBY' ) or define('BESTBUG_SM_SCENE_ORDERBY', 'bb_sm_scene_orderby');
defined( 'BESTBUG_SM_SCENE_ORDER' ) or define('BESTBUG_SM_SCENE_ORDER', 'bb_sm_scene_order');

// load shortcode
include_once( 'includes/shortcodes/index.php' );

if ( ! class_exists( 'BestBugVCScrollMagic' ) ) {
	/**
	 * BestBugVCScrollMagic Class
	 *
	 * @since	1.0
	 */
	class BestBugVCScrollMagic {

		/**
		 * Constructor, checks for Visual Composer and defines hooks
		 *
		 * @return	void
		 * @since	1.0
		 */
		function __construct() {
			if ( defined( 'WPB_VC_VERSION' ) ) {
				add_action( 'vc_before_init', array( $this, 'init' ) );
            } else {
				add_action( 'init', array( $this, 'init' ), 9 );
			}
			add_action( 'plugins_loaded', array( $this, 'loadTextDomain' ) );

			add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), array($this, 'add_action_links') );
		}

		public function init() {

			include_once( 'includes/bb_sm_helper.php' );
			include_once( 'includes/bb_sm_posttypes.php' );

			$this->createShortcode();

			if(is_admin()) {
				add_action( 'admin_enqueue_scripts', array( $this, 'adminEnqueueScripts' ) );
				include_once( 'admin/bb_sm_options.php' );
				include_once( 'admin/bb_sm_ajax.php' );
			}
			
			// Check on mobile
			if(BestBugSMHelper::$mobile_mode == 'false' && wp_is_mobile()) {
				return;
			}
			
			add_action( 'wp_enqueue_scripts', array( $this, 'enqueueScripts' ) );

			if ( defined( 'WPB_VC_VERSION' ) ) {
				if(!function_exists('str_get_html')) {
					include_once( 'includes/simple_html_dom.php' );
				}
				include_once( 'includes/bb_sm_filter.php' );
            }

        }

		public function add_action_links ( $links ) {
			$mylinks = array(
				'<a href="' . admin_url( 'admin.php?page=bb_sm_options' ) . '">Settings</a>',
			);
			return array_merge( $mylinks, $links );
		}

		public function global_scenes(){
			$scenestmp = get_posts(array(
				'numberposts' 	   => -1,
				'post_type' 	   => 'bbsm_scene',
				'orderby'          => 'title',
				'order'            => 'ASC',
			));

			$scenes = array();
			foreach ($scenestmp as $key => $scene) {
				$scenes[$key]['text'] = $scene->post_title;
				$scenes[$key]['value'] = $scene->ID;
			}
			wp_localize_script( 'jquery', 'BB_SCENES', $scenes );
			wp_localize_script( 'jquery', 'BB_SM', array(
				'BB_SM_ICON' => BESTBUG_SM_URL . '/assets/admin/img/bb_sm.png',
				'BB_SMIMSQ_ICON' => BESTBUG_SM_URL . '/assets/admin/img/imagesequence.png',
				'BB_SM_SINGLE_IMAGE' => BESTBUG_SM_URL . '/assets/admin/img/bb_sm_single_image_icon.png',
				'BB_SM_IMAGE_GROUP' => BESTBUG_SM_URL . '/assets/admin/img/bb_sm_imagesgroup.png',
			 ) );
		}

		public function adminEnqueueScripts() {
			$this->global_scenes();
			wp_enqueue_style( 'bb-vcvs-admin', BESTBUG_SM_URL . '/assets/admin/css/admin.css' );
		}

		public function enqueueScripts() {
			
			wp_enqueue_style( 'animate', BESTBUG_SM_URL . 'assets/libs/animate/animate.min.css' );
			wp_enqueue_script( 'TweenMax', BESTBUG_SM_URL . 'assets/libs/TweenMax/TweenMax.min.js', array( 'jquery' ), '1.15.1', true );
			wp_enqueue_script( 'scrollmagic', BESTBUG_SM_URL . 'assets/libs/scrollmagic/ScrollMagic.min.js', array( 'jquery' ), '2.0.5', true );
			wp_enqueue_script( 'animation-gsap', BESTBUG_SM_URL . 'assets/libs/scrollmagic/plugins/animation.gsap.min.js', array( 'jquery' ), '2.0.5', true );
			wp_enqueue_script( 'bb-vcvs', BESTBUG_SM_URL . '/assets/js/bb-vcvs.js', array( 'jquery' ), '1.0', true );
			
			wp_enqueue_style( 'bb-vcvs', BESTBUG_SM_URL . '/assets/css/bb-vcvs.css' );
			
			if(BestBugSMHelper::$smoothscroll_mode == 'true') {
				wp_enqueue_script( 'smoothscroll', BESTBUG_SM_URL . '/assets/js/smoothscroll.js', array( 'jquery' ), '1.2.1', true );
			}
			
			wp_localize_script( 'bb-vcvs', 'BB_ALLOW_CLASS_NAME', BestBugSMHelper::$allow_class_name );
			
			if(BestBugSMHelper::$allow_class_name == 'true') {
				$bb_scenes = array();
				$scenes = get_posts(array(
					'numberposts' => -1,
					'post_type' => 'bbsm_scene',
				));
				foreach ($scenes as $id => $scene_detail) {
					$scene = (array)json_decode(base64_decode($scene_detail->post_content));

					$tween = ( isset($scene['scroll']) ) ? $scene['scroll'] : array();
					unset($scene['scroll']);
					$init = ( isset($scene['init']) ) ? $scene['init'] : array();
					unset($scene['init']);
					$misc = ( isset($scene['misc']) ) ? $scene['misc'] : array();
					unset($scene['misc']);
					$bezier = ( isset($scene['bezier']) ) ? $scene['bezier'] : array();
					unset($scene['bezier']);

					unset($scene['general']->title);
					
					$bb_scenes[$scene_detail->post_name] = array(
														'settings' => $scene,
														'init' => $init,
														'tween' => $tween,
														'misc' => $misc,
														'bezier' => $bezier,
													);
				}
				wp_localize_script( 'bb-vcvs', 'BB_SCENES', $bb_scenes );
			}
			
			
		}

		public function loadTextDomain() {
			load_plugin_textdomain( BESTBUG_SM_TEXTDOMAIN, false, BESTBUG_SM_PATH . '/languages/' );
		}

		public function createShortcode() {

			include_once( 'admin/bb_vcparam_toggle.php' );
			include_once( 'admin/bb_vcparam_scroll.php' );

			if ( defined( 'WPB_VC_VERSION' ) && function_exists( 'vc_add_param' ) ) {
				include_once( 'includes/bb_sm.php' );
				include_once( 'includes/bb_sm_image_group.php' );
			}

			new BBshortcode_SM_SHORTCODE();
			new BBshortcode_SM_IMGSEQUENCE();
			new BBshortcode_SM_Single_image();
			new BBshortcode_SM_Image_group();
			new BBshortcode_SM_Empty_Space();
			
			if ( defined( 'WPB_VC_VERSION' ) && function_exists( 'vc_add_param' ) ) {
				include_once( 'admin/bb_sm_add_params.php' );
			}

		}

	}
	new BestBugVCScrollMagic();
}

// Button TinyMCE
function bb_sm_enqueue_plugin_scripts($plugin_array)
{
    //enqueue TinyMCE plugin script with its ID.
    $plugin_array["bb_sm"] =  BESTBUG_SM_URL . 'assets/admin/js/bb-sm-editor.js';
    return $plugin_array;
}

add_filter("mce_external_plugins", "bb_sm_enqueue_plugin_scripts");
function bb_sm_register_buttons_editor($buttons)
{
    //register buttons with their id.
    array_push($buttons, "bb_sm");
	array_push($buttons, BESTBUG_SMIMAGE_SHORTCODE);
	array_push($buttons, 'bb_sm_single_image');
	array_push($buttons, 'bb_sm_image_group');
    return $buttons;
}

add_filter("mce_buttons", "bb_sm_register_buttons_editor");
