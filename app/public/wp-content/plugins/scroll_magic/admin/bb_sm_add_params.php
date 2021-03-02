<?php
// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

if ( ! class_exists( 'BestBugSMAddParams' ) ) {
	/**
	 * VC BestBugSMAddParams Class
	 *
	 * @since	1.0
	 */
	class BestBugSMAddParams {

		function __construct() {
			add_action( 'init', array( $this, 'init' ) );
		}

		public function init(){
			if ( ! defined( 'WPB_VC_VERSION' ) ) {
                return;
            }

			$group = BestBugSMHelper::$group_option;

			$shortcodes = BestBugSMHelper::$shortcodes_active;

			if(!$shortcodes) {
				return;
			}
			
			$shortcodes[] = BESTBUG_SMIMAGE_SHORTCODE;
			$shortcodes[] = BESTBUG_SM_SINGLE_IMAGE_SHORTCODE;
			$shortcodes[] = BESTBUG_SM_IMG_GROUP_SHORTCODE;

			$scenestmp = get_posts(array(
				'numberposts' => -1,
				'post_type'   => 'bbsm_scene',
				'orderby'     => 'title',
				'order'       => 'ASC',
			));

			$scenes = array();
			foreach ($scenestmp as $key => $scene) {
				$scenes[$scene->post_title . ' '] = $scene->post_name;
			}
			foreach ($shortcodes as $key => $shortcode) {
				$shortcode = trim($shortcode);
				vc_add_param( $shortcode, array(
					'type' => 'bb_toggle',
					'heading' => esc_html__('Magic mode', 'bestbug'),
					'param_name' => 'bb_sm_mode',
					'group' => $group,
				));
				
				vc_add_param( $shortcode, 	array(
					'type'        => 'checkbox',
					'heading'     => esc_html__( 'Scenes', 'tm-bestbug' ),
					'value'       => $scenes,
					'param_name'  => 'bbsm_scene',
					"dependency" => array('element' => "bb_sm_mode", 'value' => array('yes')),
					'group' => $group,
					'description' => esc_html__( 'You can add, edit Scene in Scene panel', 'bestbug' ),
				)); // end add param

			}
		}

	}

	new BestBugSMAddParams();
}
