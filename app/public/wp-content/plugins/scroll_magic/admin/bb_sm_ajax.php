<?php
// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

if(!class_exists('BBSM_Ajax'))
{
	class BBSM_Ajax
	{
		function __construct()
		{
			// Logged
			add_action( 'wp_ajax_update_scene', array( $this, 'update_scene' ) );
		}

		function update_scene(){

			if( isset( $_POST['data'] ) && !empty( $_POST['data'] ) ) {
				$settings = $_POST['data'];

				foreach ($settings['init'] as $key => $init) {
					if($init == '') {
						unset($settings['init'][$key]);
					}
				}
				foreach ($settings['scroll'] as $key => $scroll) {
					if($scroll == '') {
						unset($settings['scroll'][$key]);
					}
				}
				
				$name = sanitize_title( esc_html($settings['general']['name']) );
				if(empty($name)) {
					$name = sanitize_title( esc_html($settings['general']['title']) );
				}
				$settings['general']['name'] = $name;

				$scene = array(
					'post_title' => esc_html($settings['general']['title']),
					'post_content' => base64_encode(json_encode($settings)),
					'post_type' => 'bbsm_scene',
					'post_status' => 'publish',
					'post_name' => $name
				);

				if(isset($settings['scene_id']) && !empty($settings['scene_id'])) {
					$scene['ID'] = esc_html($settings['scene_id']);
				}
				
				$error = true;

				$scene_ID = wp_insert_post( $scene, $error );

				if( !$scene_ID ) {
					echo json_encode(array(
						'msg' => esc_html__('Failed'),
						'status' => 'error',
					));
				} else {
					$post = get_post($scene_ID);
					
					echo json_encode(array(
						'msg' => esc_html__('Saved'),
						'status' => 'ok',
						'name' => $post->post_name,
						'scene_id' => $scene_ID,
					));
					
				}
			}

			wp_die();

		}

	}

	new BBSM_Ajax();
}
