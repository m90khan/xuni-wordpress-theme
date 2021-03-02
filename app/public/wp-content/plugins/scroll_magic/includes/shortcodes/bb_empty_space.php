<?php
if ( ! class_exists( 'BBshortcode_SM_Empty_Space' ) ) {
	/**
	 * BBshortcode_SM_Empty_Space Class
	 *
	 * @since	1.0
	 */
	class BBshortcode_SM_Empty_Space {


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
			
			add_shortcode( BESTBUG_SM_EMPTY_SPACE_SHORTCODE, array( $this, 'shortcode' ) );
			if ( defined( 'WPB_VC_VERSION' ) && function_exists( 'vc_add_param' ) ) {
				$this->vc_shortcode();
			}

        }

		public function adminEnqueueScripts() {
		}
        
        public function vc_shortcode() {
			vc_map( array(
			    "name" => esc_html__( "Empty Space", 'bestbug' ),
			    "base" => BESTBUG_SM_EMPTY_SPACE_SHORTCODE,
			    "as_parent" => array('except' => BESTBUG_SM_EMPTY_SPACE_SHORTCODE),
			    "content_element" => true,
				"icon" => "icon-wpb-ui-empty_space",
				"description" => esc_html__( "Blank space with custom height and width", 'bestbug' ),
				'category' => esc_html( sprintf( esc_html__( 'by %s', 'bestbug' ), BESTBUG_SM_CATEGORY ) ),
			    "params" => array(
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Height', 'bestbug' ),
						'description' => esc_html__('Enter empty space height (Note: CSS measurement units allowed).', 'bestbug'),
						'param_name' => 'height',
						'admin_label' => true,
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Width', 'bestbug' ),
						'description' => esc_html__('Enter empty space width (Note: CSS measurement units allowed).', 'bestbug'),
						'param_name' => 'width',
						'admin_label' => true,
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Extra class name', 'bestbug' ),
						'description' => esc_html__('Style particular content element differently - add a class name and refer to it in custom CSS.', 'bestbug'),
						'param_name' => 'el_class',
						'admin_label' => true,
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
		
		public function shortcode( $atts ) {
			extract( shortcode_atts( array(
				'height' => '',
				'width' => '',
				'css' => '',
				'el_class' => '',
			), $atts ) );

			$css_class = apply_filters( BestBugSMHelper::$VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, BestBugSMHelper::vc_shortcode_custom_css_class( $css, ' ' ), BESTBUG_SM_EMPTY_SPACE_SHORTCODE, $atts );
			$css_class .= ' ' . $el_class;
			
			$style = '';
			if($height != '') {
				$style .= 'height :' . $height . ';';
			}
			if($height != '') {
				$style .= 'width :' . $width . ';';
			}
			
			return '<div class="bbsm-empty-space '.esc_attr($css_class).'" style="'.$style.'" ></div>';
		}
        
    }
}

