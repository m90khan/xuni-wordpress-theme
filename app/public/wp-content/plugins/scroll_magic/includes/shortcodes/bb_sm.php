<?php
if ( ! class_exists( 'BBshortcode_SM_SHORTCODE' ) ) {
	/**
	 * BBshortcode_SM_SHORTCODE Class
	 *
	 * @since	1.0
	 */
	class BBshortcode_SM_SHORTCODE {


		/**
		 * Constructor, checks for Visual Composer and defines hooks
		 *
		 * @return	void
		 * @since	1.0
		 */
		function __construct() {
			$this->init();
		}

		public function init() {
			
			add_shortcode( BESTBUG_SM_SHORTCODE, array( $this, 'shortcode' ) );
			if ( defined( 'WPB_VC_VERSION' ) && function_exists( 'vc_add_param' ) ) {
				$this->vc_shortcode();
			}

        }

		public function adminEnqueueScripts() {
		}
        
        public function vc_shortcode() {
			vc_map( array(
			    "name" => esc_html__( "Scroll Magic", 'bestbug' ),
			    "base" => BESTBUG_SM_SHORTCODE,
			    "as_parent" => array('except' => BESTBUG_SM_SHORTCODE),
			    "content_element" => true,
				"icon" => "bb_sm_icon",
			    "js_view" => 'VcColumnView',
				"description" => esc_html__( "A full-fledged scrolling animation", 'bestbug' ),
				'category' => esc_html( sprintf( esc_html__( 'by %s', 'bestbug' ), BESTBUG_SM_CATEGORY ) ),
			    "params" => array(
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Extra class name', 'bestbug' ),
						'description' => esc_html__('Style particular content element differently - add a class name and refer to it in custom CSS.', 'bestbug'),
						'param_name' => 'el_class',
					),
					array(
						'type' => 'css_editor',
						'heading' => 'CSS box',
						'param_name' => 'css',
						'group' => 'Design Options',
					),
			    ),
			) );
        }
		
		public function shortcode( $atts, $content = null ) {
			shortcode_atts( array(
				'bbsm_scene' => '',
				'css' => '',
				'el_class' => '',
			), $atts );
			$attr = $atts;
			
			if(!isset($attr['el_class'])) {
				$attr['el_class'] = '';
			}
			if(!isset($attr['css'])) {
				$attr['css'] = '';
			}

			if( !isset($attr['bbsm_scene']) || empty($attr['bbsm_scene']) ) {
				return do_shortcode( $content );
			}

			$scene = str_replace(","," ", $attr['bbsm_scene']);

			$el_id = uniqid('bbsm-');
			
			$css_class = BestBugSMHelper::vc_shortcode_custom_css_class( $attr['css']);
			$css_class .= ' ' . $attr['el_class'];
			$css_class .= ' ' . $scene;

			return "<div id='".esc_attr($el_id)."' class='".$css_class."'>" . do_shortcode( $content ) . '</div>';
		}
        
    }
}

