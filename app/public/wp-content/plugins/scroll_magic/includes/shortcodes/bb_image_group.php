<?php
if ( ! class_exists( 'BBshortcode_SM_Image_group' ) ) {
	/**
	 * BBshortcode_SM_Image_group Class
	 *
	 * @since	1.0
	 */
	class BBshortcode_SM_Image_group {


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
			
			add_shortcode( BESTBUG_SM_IMG_GROUP_SHORTCODE, array( $this, 'shortcode' ) );
			if ( defined( 'WPB_VC_VERSION' ) && function_exists( 'vc_add_param' ) ) {
				$this->vc_shortcode();
			}

        }

		public function adminEnqueueScripts() {
		}
        
        public function vc_shortcode() {
			vc_map( array(
			    "name" => esc_html__( "Image group", 'bestbug' ),
			    "base" => BESTBUG_SM_IMG_GROUP_SHORTCODE,
			    "as_parent" => array('except' => BESTBUG_SM_IMG_GROUP_SHORTCODE),
			    "content_element" => true,
				"icon" => "bb_sm_imagesgroup",
			    "js_view" => 'VcColumnView',
				"description" => esc_html__( "Contain single images", 'bestbug' ),
				'category' => esc_html( sprintf( esc_html__( 'by %s', 'bestbug' ), BESTBUG_SM_CATEGORY ) ),
			    "params" => array(
					array(
						'type'        => 'dropdown',
						'heading'     => 'Align',
						'param_name'  => 'align',
						'value' => array(
							'Left' => 'left',
							'Center' => 'center',
							'Right' => 'right',
						),
					),
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

			if(!isset($atts['align'])) {
				$atts['align'] = 'left';
			}
			
			$css_class = apply_filters( BestBugSMHelper::$VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, BestBugSMHelper::vc_shortcode_custom_css_class( $attr['css'], ' ' ), BESTBUG_SMIMAGE_SHORTCODE, $atts );
			$css_class .= ' ' . $attr['el_class'] . ' bbsm-text-' . $attr['align'];

			return '<div class="'.esc_attr($css_class).'">'.do_shortcode($content).'</div>';
		}
        
    }
}

