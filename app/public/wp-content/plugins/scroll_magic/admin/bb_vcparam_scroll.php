<?php
// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	die;
}
if(!class_exists('BestBug_VcParam_Scroll'))
{
	class BestBug_VcParam_Scroll
	{
		function __construct()
		{
			if ( class_exists( 'WpbakeryShortcodeParams' ) )
			{
				// Add the color picker css file
        		wp_enqueue_style( 'wp-color-picker' );

				WpbakeryShortcodeParams::addField('bb_scroll' , array($this, 'bb_scroll'), BESTBUG_SM_URL . 'assets/admin/js/bb-vcparam-scroll.js');

				wp_enqueue_style( 'bb_vcparam_scroll', BESTBUG_SM_URL . '/assets/admin/css/vcparam/vcparam-scroll.css' );
			}
		}

		public static function easing($class = '', $label = 'Easing', $small = true){
			$label = '&nbsp;';
			$output = '';
			if($small) {
				$output .= '<div class="col-md-3 bbvcvs-scroll-easing">';
			} else {
				$output .= '<div class="col-md-3">';
			}
				$output .= '<label>'. $label .'</label>';
				$output .= '<select class="'. $class .'">
								<option value="">Easing</option>
								<option value="quadratic">quadratic</option>
								<option value="cubic">cubic</option>
								<option value="swing">swing</option>
								<option value="WTF">WTF</option>
								<option value="inverted">inverted</option>
								<option value="bounce">bounce</option>
							</select>';
			$output .= '</div>';
			return $output;
		}

		function bb_scroll($settings, $value){

			$output = $checked = '';
			$param_name = isset($settings['param_name']) ? $settings['param_name'] : '';
			if(empty($value)) {
				$value = isset($settings['value']) ? $settings['value'] : '';
			}

			$output = '<div class="bb-scroll vc_edit_form_elements bb-vcvs-layout">';

			$html_info_icon = ' <span class="dashicons dashicons-info"></span> ';

			$output .= '<div class="row input-transform">';
				$output .= self::easing( 'bb-easing-transform', '', false );
				$output .= '<div class="col-md-3">';
					$output .= '<label bbhelp-label="'.esc_attr__('unit %, px, em or rem', 'bestbug').'" class="bbhelp--right">'.$html_info_icon.esc_html__('TranslateX', 'bestbug').'</label> <input type="text" class="bb-scroll-transform translateX" />';
				$output .= '</div>';
				$output .= '<div class="col-md-3">';
					$output .= '<label bbhelp-label="'.esc_attr__('unit %, px, em or rem', 'bestbug').'" class="bbhelp--right">'.$html_info_icon.esc_html__('TranslateY', 'bestbug').'</label> <input type="text" class="bb-scroll-transform translateY" />';
				$output .= '</div>';
				$output .= '<div class="col-md-3">';
					$output .= '<label bbhelp-label="'.esc_attr__('unit %, px, em or rem', 'bestbug').'" class="bbhelp--left">'.$html_info_icon.esc_html__('TranslateZ', 'bestbug').'</label> <input type="text" class="bb-scroll-transform translateZ" />';
				$output .= '</div>';
			$output .= '</div>';

			$output .= '<div class="row input-transform">';
				$output .= '<div class="col-md-3">';
					$output .= '<label bbhelp-label="'.esc_attr__('just number', 'bestbug').'" class="bbhelp--right">'.$html_info_icon.esc_html__('ScaleX', 'bestbug').'</label> <input type="text" class="bb-scroll-transform scaleX" />';
				$output .= '</div>';
				$output .= '<div class="col-md-3">';
					$output .= '<label bbhelp-label="'.esc_attr__('just number', 'bestbug').'" class="bbhelp--right">'.$html_info_icon.esc_html__('ScaleY', 'bestbug').'</label> <input type="text" class="bb-scroll-transform scaleY" />';
				$output .= '</div>';
				$output .= '<div class="col-md-3">';
					$output .= '<label bbhelp-label="'.esc_attr__('just number', 'bestbug').'" class="bbhelp--right">'.$html_info_icon.esc_html__('ScaleZ', 'bestbug').'</label> <input type="text" class="bb-scroll-transform scaleZ" />';
				$output .= '</div>';
				$output .= '<div class="col-md-3">';
					$output .= '<label bbhelp-label="'.esc_attr__('unit %, px, em or rem', 'bestbug').'" class="bbhelp--right">'.$html_info_icon.esc_html__('Perspective', 'bestbug').'</label> <input type="text" class="bb-scroll-transform perspective" />';
				$output .= '</div>';
			$output .= '</div>';

			$output .= '<div class="row input-transform">';
				$output .= '<div class="col-md-3">';
					$output .= '<label bbhelp-label="'.esc_attr__('unit deg', 'bestbug').'" class="bbhelp--right">'.$html_info_icon.esc_html__('Rotate 2D', 'bestbug').'</label> <input type="text" class="bb-scroll-transform rotate" />';
				$output .= '</div>';
				$output .= '<div class="col-md-3">';
					$output .= '<label bbhelp-label="'.esc_attr__('unit deg', 'bestbug').'" class="bbhelp--right">'.$html_info_icon.esc_html__('RotateX', 'bestbug').'</label> <input type="text" class="bb-scroll-transform rotateX" />';
				$output .= '</div>';
				$output .= '<div class="col-md-3">';
					$output .= '<label bbhelp-label="'.esc_attr__('unit deg', 'bestbug').'" class="bbhelp--right">'.$html_info_icon.esc_html__('RotateY', 'bestbug').'</label> <input type="text" class="bb-scroll-transform rotateY" />';
				$output .= '</div>';
				$output .= '<div class="col-md-3">';
					$output .= '<label bbhelp-label="'.esc_attr__('unit deg', 'bestbug').'" class="bbhelp--right">'.$html_info_icon.esc_html__('RotateZ', 'bestbug').'</label> <input type="text" class="bb-scroll-transform rotateZ" />';
				$output .= '</div>';

			$output .= '</div>';
			$output .= '<div class="row input-transform">';

				$output .= '<div class="col-md-3">';
					$output .= '<label bbhelp-label="'.esc_attr__('unit deg', 'bestbug').'" class="bbhelp--right">'.$html_info_icon.esc_html__('SkewX', 'bestbug').'</label> <input type="text" class="bb-scroll-transform skewX" />';
				$output .= '</div>';
				$output .= '<div class="col-md-3">';
					$output .= '<label bbhelp-label="'.esc_attr__('unit deg', 'bestbug').'" class="bbhelp--right">'.$html_info_icon.esc_html__('SkewY', 'bestbug').'</label> <input type="text" class="bb-scroll-transform skewY" />';
				$output .= '</div>';

			$output .= '</div>';

			$output .= '<hr />';

			$output .= '<div class="row bb-special">';

				$output .= '<div class="col-md-3">';
					$output .= '<label>'.esc_html__('Position', 'bestbug').'</label>';
					$output .= '<select class="bb-scroll-position">
									<option value="">Default</option>
									<option value="static">static</option>
									<option value="absolute">absolute</option>
									<option value="relative">relative</option>
									<option value="fixed">fixed</option>
								</select>';
				$output .= '</div>';
				$output .= self::easing( 'bb-easing-position' );

			$output .= '</div>';

			$output .= '<div class="row bb-special">';

				$output .= '<div class="col-md-3">';
					$output .= '<label bbhelp-label="'.esc_attr__('unit %, px, em or rem', 'bestbug').'" class="bbhelp--right">'.$html_info_icon.esc_html__('Top', 'bestbug').'</label> <input type="text" class="bb-scroll-top" />';
				$output .= '</div>';
				$output .= self::easing( 'bb-easing-top' );

				$output .= '<div class="col-md-3">';
					$output .= '<label bbhelp-label="'.esc_attr__('unit %, px, em or rem', 'bestbug').'" class="bbhelp--right">'.$html_info_icon.esc_html__('Right', 'bestbug').'</label> <input type="text" class="bb-scroll-right" />';
				$output .= '</div>';
				$output .= self::easing( 'bb-easing-right' );

			$output .= '</div>';

			$output .= '<div class="row bb-special">';

				$output .= '<div class="col-md-3">';
					$output .= '<label bbhelp-label="'.esc_attr__('unit %, px, em or rem', 'bestbug').'" class="bbhelp--right">'.$html_info_icon.esc_html__('Bottom', 'bestbug').'</label> <input type="text" class="bb-scroll-bottom" />';
				$output .= '</div>';
				$output .= self::easing( 'bb-easing-bottom' );

				$output .= '<div class="col-md-3">';
					$output .= '<label bbhelp-label="'.esc_attr__('unit %, px, em or rem', 'bestbug').'" class="bbhelp--right">'.$html_info_icon.esc_html__('Left', 'bestbug').'</label> <input type="text" class="bb-scroll-left" />';
				$output .= '</div>';
				$output .= self::easing( 'bb-easing-left' );

			$output .= '</div>';

			$output .= '<hr />';

			$output .= '<div class="row bb-special">';
				$output .= '<div class="col-md-3">';
					$output .= '<label>'.esc_html__('Opacity', 'bestbug').'</label> <input type="text" class="bb-scroll-opacity" />';
				$output .= '</div>';
				$output .= self::easing( 'bb-easing-opacity' );

				$output .= '<div class="col-md-3">';
					$output .= '<label>'.esc_html__('Z-index', 'bestbug').'</label> <input type="text" class="bb-scroll-z-index" />';
				$output .= '</div>';
				$output .= self::easing( 'bb-easing-z-index' );
			$output .= '</div>';

			$output .= '<div class="row bb-special">';
				$output .= '<div class="col-md-3">';
					$output .= '<label bbhelp-label="'.esc_attr__('unit %, px, em or rem', 'bestbug').'" class="bbhelp--right">'.$html_info_icon.esc_html__('Width', 'bestbug').'</label> <input type="text" class="bb-scroll-width" />';
				$output .= '</div>';
				$output .= self::easing( 'bb-easing-width' );

				$output .= '<div class="col-md-3">';
					$output .= '<label bbhelp-label="'.esc_attr__('unit %, px, em or rem', 'bestbug').'" class="bbhelp--right">'.$html_info_icon.esc_html__('Height', 'bestbug').'</label> <input type="text" class="bb-scroll-height" />';
				$output .= '</div>';
				$output .= self::easing( 'bb-easing-height' );
			$output .= '</div>';

			$output .= '<hr />';

			$output .= '<div class="row bb-special">';
				$output .= '<div class="col-md-3">';
					$output .= '<label bbhelp-label="'.esc_attr__('unit %, px, em or rem', 'bestbug').'" class="bbhelp--right">'.$html_info_icon.esc_html__('Margin-top', 'bestbug').'</label> <input type="text" class="bb-scroll-margin-top" />';
				$output .= '</div>';
				$output .= self::easing( 'bb-easing-margin-top' );

				$output .= '<div class="col-md-3">';
					$output .= '<label bbhelp-label="'.esc_attr__('unit %, px, em or rem', 'bestbug').'" class="bbhelp--right">'.$html_info_icon.esc_html__('Margin-right', 'bestbug').'</label> <input type="text" class="bb-scroll-margin-right" />';
				$output .= '</div>';
				$output .= self::easing( 'bb-easing-margin-right' );
			$output .= '</div>';

			$output .= '<div class="row bb-special">';
				$output .= '<div class="col-md-3">';
					$output .= '<label bbhelp-label="'.esc_attr__('unit %, px, em or rem', 'bestbug').'" class="bbhelp--right">'.$html_info_icon.esc_html__('Margin-bottom', 'bestbug').'</label> <input type="text" class="bb-scroll-margin-bottom" />';
				$output .= '</div>';
				$output .= self::easing( 'bb-easing-margin-bottom' );

				$output .= '<div class="col-md-3">';
					$output .= '<label bbhelp-label="'.esc_attr__('unit %, px, em or rem', 'bestbug').'" class="bbhelp--right">'.$html_info_icon.esc_html__('Margin-left', 'bestbug').'</label> <input type="text" class="bb-scroll-margin-left" />';
				$output .= '</div>';
				$output .= self::easing( 'bb-easing-margin-left' );
			$output .= '</div>';

			$output .= '<hr />';

			$output .= '<div class="row bb-special">';
				$output .= '<div class="col-md-3">';
					$output .= '<label bbhelp-label="'.esc_attr__('unit %, px, em or rem', 'bestbug').'" class="bbhelp--right">'.$html_info_icon.esc_html__('Padding-top', 'bestbug').'</label> <input type="text" class="bb-scroll-padding-top" />';
				$output .= '</div>';
				$output .= self::easing( 'bb-easing-padding-top' );

				$output .= '<div class="col-md-3">';
					$output .= '<label bbhelp-label="'.esc_attr__('unit %, px, em or rem', 'bestbug').'" class="bbhelp--right">'.$html_info_icon.esc_html__('Padding-right', 'bestbug').'</label> <input type="text" class="bb-scroll-padding-right" />';
				$output .= '</div>';
				$output .= self::easing( 'bb-easing-padding-right' );
			$output .= '</div>';

			$output .= '<div class="row bb-special">';
				$output .= '<div class="col-md-3">';
					$output .= '<label bbhelp-label="'.esc_attr__('unit %, px, em or rem', 'bestbug').'" class="bbhelp--right">'.$html_info_icon.esc_html__('Padding-bottom', 'bestbug').'</label> <input type="text" class="bb-scroll-padding-bottom" />';
				$output .= '</div>';
				$output .= self::easing( 'bb-easing-padding-bottom' );

				$output .= '<div class="col-md-3">';
					$output .= '<label bbhelp-label="'.esc_attr__('unit %, px, em or rem', 'bestbug').'" class="bbhelp--right">'.$html_info_icon.esc_html__('Padding-left', 'bestbug').'</label> <input type="text" class="bb-scroll-padding-left" />';
				$output .= '</div>';
				$output .= self::easing( 'bb-easing-padding-left' );
			$output .= '</div>';

			$output .= '<hr />';

			// Typography
			$output .= '<div class="row bb-special">';

				$output .= '<div class="col-md-3">';
					$output .= '<label>'.esc_html__('Background Color', 'bestbug').'</label><br/> <input type="text" class="bb-color-picker bb-scroll-background-color" />';
				$output .= '</div>';
				$output .= self::easing( 'bb-easing-background-color' );

				$output .= '<div class="col-md-3">';
					$output .= '<label>'.esc_html__('Color', 'bestbug').'</label><br/> <input type="text" class="bb-color-picker bb-scroll-color" />';
				$output .= '</div>';
				$output .= self::easing( 'bb-easing-color' );

			$output .= '</div>';

			$output .= '<div class="row bb-special">';

				$output .= '<div class="col-md-3">';
					$output .= '<label bbhelp-label="'.esc_attr__('x(px) y(px)', 'bestbug').'" class="bbhelp--left">'.$html_info_icon.esc_html__('BG position', 'bestbug').'</label> <input type="text" class="bb-scroll-background-position" />';
				$output .= '</div>';
				$output .= self::easing( 'bb-easing-background-position' );

				$output .= '<div class="col-md-3">';
					$output .= '<label bbhelp-label="'.esc_attr__('unit px, em or rem', 'bestbug').'" class="bbhelp--right">'.$html_info_icon.esc_html__('Font-size', 'bestbug').'</label> <input type="text" class="bb-scroll-font-size" />';
				$output .= '</div>';
				$output .= self::easing( 'bb-easing-font-size' );

			$output .= '</div>';

			$output .= '<div class="row bb-special">';

				$output .= '<div class="col-md-3">';
					$output .= '<label bbhelp-label="'.esc_attr__('unit px, em or rem', 'bestbug').'" class="bbhelp--right">'.$html_info_icon.esc_html__('Letter-spacing', 'bestbug').'</label> <input type="text" class="bb-scroll-letter-spacing" />';
				$output .= '</div>';
				$output .= self::easing( 'bb-easing-letter-spacing' );

				$output .= '<div class="col-md-3">';
					$output .= '<label>'.esc_html__('Font-weight', 'bestbug').'</label>';
					$output .= '<select class="bb-scroll-font-weight">
									<option value="">Default</option>
									<option value="100">Thin (Hairline) - 100</option>
									<option value="200">Extra Light (Ultra Light) - 200</option>
									<option value="300">Light - 300</option>
									<option value="400">Normal - 400</option>
									<option value="500">Medium - 500</option>
									<option value="600">Semi Bold (Demi Bold) - 600</option>
									<option value="700">Bold - 700</option>
									<option value="800">Extra Bold (Ultra Bold) - 800</option>
									<option value="900">Black (Heavy) - 900</option>
								</select>';
				$output .= '</div>';
				$output .= self::easing( 'bb-easing-font-weight' );

			$output .= '</div>';

			$output .= '<div class="row bb-special">';
				$output .= '<div class="col-md-3">';
					$output .= '<label bbhelp-label="'.esc_attr__('unit px, em or rem', 'bestbug').'" class="bbhelp--right">'.$html_info_icon.esc_html__('Line-height', 'bestbug').'</label> <input type="text" class="bb-scroll-line-height" />';
				$output .= '</div>';
				$output .= self::easing( 'bb-easing-line-height' );

				$output .= '<div class="col-md-3">';
					$output .= '<label bbhelp-label="'.esc_attr__('unit px, em or rem', 'bestbug').'" class="bbhelp--left">'.$html_info_icon.esc_html__('Word-spacing', 'bestbug').'</label> <input type="text" class="bb-scroll-word-spacing" />';
				$output .= '</div>';
				$output .= self::easing( 'bb-easing-word-spacing' );

			$output .= '</div>';

			$output .= '<input class="bb-scroll-value wpb_vc_param_value '.$param_name.'" name="'.$param_name.'" type="hidden" value="'.$value.'" />';

			$output .= '</div>';

			return $output;

		}

	}

	new BestBug_VcParam_Scroll();
}
