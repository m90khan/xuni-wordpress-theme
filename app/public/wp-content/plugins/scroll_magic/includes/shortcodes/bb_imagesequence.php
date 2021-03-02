<?php
if ( ! class_exists( 'BBshortcode_SM_IMGSEQUENCE' ) ) {
	/**
	 * BBshortcode_SM_IMGSEQUENCE Class
	 *
	 * @since	1.0
	 */
	class BBshortcode_SM_IMGSEQUENCE {


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
			
			add_shortcode( BESTBUG_SMIMAGE_SHORTCODE, array( $this, 'shortcode' ) );
			if ( defined( 'WPB_VC_VERSION' ) && function_exists( 'vc_add_param' ) ) {
				$this->vc_shortcode();
			}

        }

		public function adminEnqueueScripts() {
		}
        
        public function vc_shortcode() {
			vc_map( array(
			    "name" => esc_html__( "Image Sequence", 'bestbug' ),
			    "base" => BESTBUG_SMIMAGE_SHORTCODE,
			    "as_parent" => array('except' => BESTBUG_SMIMAGE_SHORTCODE),
			    "content_element" => true,
				"icon" => "bb_sm_imagesequence_icon",
				"description" => esc_html__( "GIF-like behaviour controlled by the scroll bar", 'bestbug' ),
				'category' => esc_html( sprintf( esc_html__( 'by %s', 'bestbug' ), BESTBUG_SM_CATEGORY ) ),
			    "params" => array(
					array(
						'type'        => 'attach_images',
						'heading'     => 'Images',
						'param_name'  => 'images',
						'save_always' => true,
						'admin_label' => true,
					),
					array(
						'type'        => 'dropdown',
						'heading'     => 'Align',
						'param_name'  => 'align',
						'value' => array(
							'Left' => 'left',
							'Center' => 'center',
							'Right' => 'right',
						),
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
			shortcode_atts( array(
				'align' => 'left',
				'images' => '',
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

			if(!isset($atts['images'])) {
				return;
			}
			if(!isset($atts['align'])) {
				$atts['align'] = 'left';
			}

			$images = $atts['images'];

			$images = explode( ',', $images );

			if(empty($images)) {
				return;
			}

			$imagesequence = array();
			foreach ( $images as $image ) {
				if ( $image > 0 ) {
					$image = wp_get_attachment_image_src( $image, 'full' );
					if(isset($image[0]) && !empty($image[0])) {
						$imagesequence[] = $image[0];
					}
				}
			}
			
			$css_class = apply_filters( BestBugSMHelper::$VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, BestBugSMHelper::vc_shortcode_custom_css_class( $attr['css'], ' ' ), BESTBUG_SMIMAGE_SHORTCODE, $atts );
			$css_class .= ' ' . $attr['el_class'] . ' bbsm-text-' . $attr['align'];

			$default = (isset($imagesequence[0]))? $imagesequence[0] : '';
			$imagesequence = json_encode($imagesequence);
			return '<div class="'.esc_attr($css_class).'"><div class="bbsm-imagesequence" data-bbsm-imagesequence="'.htmlspecialchars( $imagesequence, ENT_QUOTES, 'UTF-8' ).'"><img src="'.$default.'" /></div></div>';
		}
        
    }
}

