<?php
if ( ! class_exists( 'BBshortcode_SM_Single_image' ) ) {
	/**
	 * BBshortcode_SM_Single_image Class
	 *
	 * @since	1.0
	 */
	class BBshortcode_SM_Single_image {


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
			
			add_shortcode( BESTBUG_SM_SINGLE_IMAGE_SHORTCODE, array( $this, 'shortcode' ) );
			if ( defined( 'WPB_VC_VERSION' ) && function_exists( 'vc_add_param' ) ) {
				$this->vc_shortcode();
			}

        }

		public function adminEnqueueScripts() {
		}
        
        public function vc_shortcode() {
			vc_map( array(
			    "name" => esc_html__( "Single Image", 'bestbug' ),
			    "base" => BESTBUG_SM_SINGLE_IMAGE_SHORTCODE,
			    "as_parent" => array('except' => BESTBUG_SM_SINGLE_IMAGE_SHORTCODE),
			    "content_element" => true,
				"icon" => "bb_sm_single_image_icon",
				"description" => esc_html__( "Simple image", 'bestbug' ),
				'category' => esc_html( sprintf( esc_html__( 'by %s', 'bestbug' ), BESTBUG_SM_CATEGORY ) ),
			    "params" => array(
					array(
						'type'        => 'attach_image',
						'heading'     => 'Image',
						'param_name'  => 'image',
						'save_always' => true,
						'admin_label' => true,
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
			extract( shortcode_atts( array(
				'image' => '',
				'css' => '',
				'el_class' => '',
			), $atts ) );

			$css_class = apply_filters( BestBugSMHelper::$VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, BestBugSMHelper::vc_shortcode_custom_css_class( $css, ' ' ), BESTBUG_SM_SINGLE_IMAGE_SHORTCODE, $atts );
			$css_class .= ' ' . $el_class;
			
			if ( $image > 0 ) {
				$image = wp_get_attachment_image_src( $image, 'full' );
				if(isset($image[0]) && !empty($image[0])) {
					$imagesequence[] = $image[0];
					return '<div class="bbsm-single-image '.esc_attr($css_class).'" ><img src="'.$image[0].'" /></div>';
				}
			}
			
			return '';
		}
        
    }
}

