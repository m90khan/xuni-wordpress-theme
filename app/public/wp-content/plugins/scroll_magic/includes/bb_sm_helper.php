<?php
// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

if ( ! class_exists( 'BestBugSMHelper' ) ) {
	/**
	 * VC BestBugSMHelper Class
	 *
	 * @since	1.0
	 */
	class BestBugSMHelper {
		public static $shortcodes;

		public static $shortcodes_active;

		public static $option_by_elements;
		public static $custom_elements;
		public static $mobile_mode;
		public static $allow_class_name;

		public static $custom_elements_array;

		public static $group_option;

		public static $smoothscroll_mode;
		
		public static $VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG;

		function __construct() {
			
			self::$VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG = (defined('VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG')) ? VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG : 'VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG';

			self::$group_option = esc_html__('Scroll Magic', 'bestbug');

			self::$option_by_elements = get_option(BESTBUG_SM_OPTIONS_BY_ELEMENTS, apply_filters( 'bbvcvs_options_by_elements_default', 'custom' ) );
			self::$custom_elements = get_option(BESTBUG_SM_CUSTOM_ELEMENTS, apply_filters( 'bbvcvs_custom_elements_default', 'vc_row,vc_column' ) );

			self::$smoothscroll_mode = get_option(BESTBUG_SM_SMOOTHSCROLL_MODE, apply_filters( 'bbvcvs_smoothscroll_default', 'false' ) );
			self::$mobile_mode = get_option(BESTBUG_SM_MOBILE_MODE, apply_filters( 'bbvcvs_mobile_mode_default', 'true' ) );
			
			self::$allow_class_name = get_option(BESTBUG_SM_ALLOW_CLASS_NAME, apply_filters( 'bbvcvs_allow_class_name', 'true' ) );
			
			add_action( 'init', array( $this, 'init' ) );

		}

		public function init(){

			if(self::$option_by_elements == 'all') {
				$this->generateData();
				self::$shortcodes_active = self::$shortcodes;
			} elseif(self::$option_by_elements == 'custom') {
				self::$custom_elements_array = preg_split("/[,|\n]+/", self::$custom_elements);
				self::$shortcodes_active = self::$custom_elements_array;
			}

			if( !is_array(self::$shortcodes_active) ) {
				self::$shortcodes_active = array();
			}
			array_push(self::$shortcodes_active, BESTBUG_SM_SHORTCODE);

		}

		public static function array_unshift_assoc($arr, $key, $val) {
		    $arr = array_reverse($arr, true);
		    $arr[$key] = $val;
		    return array_reverse($arr, true);
		}

		public static function generateData() {
			if( !class_exists('WPBMap') ) {
				return;
			}

			$allShortcodes = WPBMap::getAllShortCodes();
			self::$shortcodes = array();
			foreach ( $allShortcodes as $tag => $shortcode ) {
				if( isset($shortcode['params']) && $tag != BESTBUG_SM_SHORTCODE ) {
					array_push( self::$shortcodes, $tag);
				}
			}
		}

		public static function shortcodes(){
			self::generateData();
			return self::$shortcodes;
		}

		public static function get_css($css){
			$class = '';
			if (preg_match("/( color#b#)|( color:)/i", $css)) {
				$class .= ' bbvcvs-ci';
			}
			if (preg_match("/(font-size#b#)|(font-size:)/i", $css)) {
				$class .= ' bbvcvs-fsi';
			}
			if (preg_match("/(word-spacing#b#)|(word-spacing:)/i", $css)) {
				$class .= ' bbvcvs-wsi';
			}
			if (preg_match("/(letter-spacing#b#)|(letter-spacing:)/i", $css)) {
				$class .= ' bbvcvs-lsi';
			}
			if (preg_match("/(font-weight#b#)|(font-weight:)/i", $css)) {
				$class .= ' bbvcvs-fwi';
			}
			if (preg_match("/(line-height#b#)|(line-height:)/i", $css)) {
				$class .= ' bbvcvs-lhi';
			}
			return $class;
		}
		
		public static function vc_shortcode_custom_css_class($css) {
			if( function_exists('vc_shortcode_custom_css_class') ) {
				return vc_shortcode_custom_css_class($css);
			}
			return '';
		}

	}

	new BestBugSMHelper();
}
