<?php
// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

if ( ! class_exists( 'BestBugSMOptions' ) ) {
	/**
	 * VC BestBugSMOptions Class
	 *
	 * @since	1.0
	 */
	class BestBugSMOptions {

		public $scenes;

		public $option_by_elements;
		public $custom_elements;
		public $mobile_mode;
		public $allow_class_name;
		public $smoothscroll_mode;

		public $imported;

		public $notice;

		function __construct($option_by_elements, $custom_elements, $mobile_mode, $allow_class_name, $smoothscroll_mode) {

			$this->option_by_elements = $option_by_elements;
			$this->custom_elements = $custom_elements;
			$this->mobile_mode = $mobile_mode;
			$this->allow_class_name = $allow_class_name;
			$this->smoothscroll_mode = $smoothscroll_mode;

			add_action( 'admin_menu', array( &$this, 'init' ) );

		}

		public function init(){

			add_menu_page(
		        esc_html('Scroll Magic', 'bestbug'),
		        esc_html('Scroll Magic', 'bestbug'),
		        'manage_options',
		        'bb_sm_options',
		        array( &$this, 'generalSettings') ,
		        BESTBUG_SM_URL . 'assets/admin/img/visual_composer.png',
		        76
		    );

			add_submenu_page(
				'bb_sm_options',
				esc_html('General Settings', 'bestbug'),
				esc_html('General Settings', 'bestbug'),
				'manage_options',
				'bb_sm_options',
				array(&$this, 'generalSettings' )
			);

			add_submenu_page(
				'bb_sm_options',
				esc_html('All Scenes', 'bestbug'),
				esc_html('All Scenes', 'bestbug'),
				'manage_options',
				'bb_sm_scenes',
				array(&$this, 'scenes' )
			);
			add_submenu_page(
				'bb_sm_options',
				esc_html('Add Scene', 'bestbug'),
				esc_html('Add Scene', 'bestbug'),
				'manage_options',
				'bbsm_addnewscene',
				array(&$this, 'add_scenes' )
			);

			add_submenu_page(
				'bb_sm_options',
				esc_html('About', 'bestbug'),
				esc_html('About', 'bestbug'),
				'manage_options',
				'bb_sm_preset',
				array(&$this, 'preset' )
			);

			if( isset( $_POST['bb_sm_update_general'] ) && ( '1' === $_POST['bb_sm_update_general'] || 'true' === $_POST['bb_sm_update_general'] ) ) {
				$this->update_general();
			}

			if( isset( $_POST['bb_sm_import_preset'] ) && ( '1' === $_POST['bb_sm_import_preset'] || 'true' === $_POST['bb_sm_import_preset'] ) ) {
				$this->import_preset();
			}

			if( isset( $_POST['bbsmSceneIdDel'] ) && '' != $_POST['bbsmSceneIdDel'] ) {
				$this->delete_scene();
			}
			
			if( isset( $_POST['bbsmSceneIdClone'] ) && '' != $_POST['bbsmSceneIdClone'] ) {
				$this->clone_scene();
			}

		}

		public function enqueueScript(){
			wp_enqueue_script( 'bb-vcvs', BESTBUG_SM_URL . '/assets/admin/js/admin.js', array( 'jquery' ), '1.0', true );
			wp_enqueue_style( 'bb-vcvs-admin', BESTBUG_SM_URL . '/assets/admin/css/admin.css' );
		}

		public function enqueueScriptScenes(){
			wp_enqueue_style( 'wp-color-picker');
			wp_enqueue_script( 'wp-color-picker');
			$this->enqueueScript();

			wp_enqueue_script( 'notify', BESTBUG_SM_URL . 'assets/libs/notify.min.js', array( 'jquery' ), '1.0', true );

			wp_enqueue_style( 'animate', BESTBUG_SM_URL . 'assets/libs/animate/animate.min.css' );

			wp_enqueue_script( 'TweenMax', BESTBUG_SM_URL . 'assets/libs/TweenMax/TweenMax.min.js', array( 'jquery' ), '1.15.1', true );
			wp_enqueue_script( 'scrollmagic', BESTBUG_SM_URL . 'assets/libs/scrollmagic/ScrollMagic.min.js', array( 'jquery' ), '2.0.5', true );
			wp_enqueue_script( 'animation-gsap', BESTBUG_SM_URL . 'assets/libs/scrollmagic/plugins/animation.gsap.min.js', array( 'jquery' ), '2.0.5', true );
			wp_enqueue_script( 'addIndicators', BESTBUG_SM_URL . 'assets/libs/scrollmagic/plugins/debug.addIndicators.min.js', array( 'jquery' ), '2.0.5', true );

			wp_enqueue_script( 'react', BESTBUG_SM_URL . 'assets/libs/reactjs/react.min.js', array( 'jquery' ), '15.4.2', true );
			wp_enqueue_script( 'react-dom', BESTBUG_SM_URL . 'assets/libs/reactjs/react-dom.min.js', array( 'react' ), '15.4.2', true );

			wp_enqueue_script( 'babel', BESTBUG_SM_URL . 'assets/libs/reactjs/babel.min.js', array( 'react' ), '6.15.0', true );

			wp_enqueue_script( 'bb-scene-editor', BESTBUG_SM_URL . '/assets/admin/js/bb-scene-editor.jsx', array( 'react' ), null, true );
			// Localize the script
			$translation = array(
				'livePreview' => esc_html__( 'Live Preview', 'bestbug' ),
				'sceneSettings' => esc_html__('General Settings', 'bestbug'),
				'properties' => esc_html__('After', 'bestbug'),
				'ease' => esc_html__('Ease', 'bestbug'),
				'bezier' => esc_html__('Bezier', 'bestbug'),
				'classes' => esc_html__('Class', 'bestbug'),
				'general' => esc_html__('General', 'bestbug'),
				'init' => esc_html__('Init', 'bestbug'),
			);
			wp_localize_script( 'bb-scene-editor', 'BB_TRANSLATION', $translation );

			$props = array(
				
				'width' => '',
				'height' => '',
				
				'zIndex' => '',
				
				'position' => '',
				'left' => '',
				'top' => '',
				'right' => '',
				'bottom' => '',

				'x' => '',
				'y' => '',
				'z' => '',

				'scaleX' => '',
				'scaleY' => '',
				'scaleZ' => '',

				'rotation' => '',
				'rotationX' => '',
				'rotationY' => '',
				'rotationZ' => '',

				'skewX' => '',
				'skewY' => '',

				'backgroundColor' => '',
				'color' => '',
				
				'backgroundAttachment' => '',
				
				'overflow' => '',
			);

			$settings = array(
				'init' => $props,
				'scroll' => $props,
				// General
				'general' => array(
					'title' => '',
					'name' => '',
					'duration' => '',
					'offset' => '',
					'pin' => 'off',
					'pushFollowers' => true,
					'triggerHook' => '0.5',
					'vertical' => 'on',
				),
				// Ease
				'ease' => array(
					'delay' => '',
					'duration' => '0.5',
					'ease' => '',
				),
				// Class
				'class' => array(
					'classToggleEnable' => 'off',
					'classCSS' => 'bounce',
				),

				// Misc
				'misc' => array(
					'drawSVG' => 'off',
					'selector' => '',
					'container' => '',
				),

				// bezier
				'bezier' => array(
					// array(
					// 	'x' => 510,
					// 	'y' => 60,
					// ),
					// array(
					// 	'x' => 620,
					// 	'y' => -60,
					// ),
					// array(
					// 	'x' => 500,
					// 	'y' => -100,
					// ),
					// array(
					// 	'x' => 380,
					// 	'y' => 20,
					// ),
					// array(
					// 	'x' => 500,
					// 	'y' => 60,
					// ),
					// array(
					// 	'x' => 580,
					// 	'y' => 20,
					// ),
					// array(
					// 	'x' => 620,
					// 	'y' => 15,
					// ),
				),

			);

			wp_localize_script( 'bb-scene-editor', 'BB_SCENE_SETTINGS', $settings );


			$settings_edit = '';
			if(isset($_GET['idScene']) && !empty($_GET['idScene']) && is_numeric($_GET['idScene'])) {
				$scene_settings = get_post($_GET['idScene']);
				$settings_edit = (array)json_decode(base64_decode($scene_settings->post_content));
				$settings_edit['scene_id'] = $scene_settings->ID;
			}
			wp_localize_script( 'bb-scene-editor', 'BB_SCENE_EDIT_SETTINGS', $settings_edit );

		}

		public function generalSettings(){
			$this->enqueueScript();
			include_once ('templates/bb_sm_general.tpl.php');
		}

		public function preset(){
			include_once ('templates/bb_sm_preset.tpl.php');
		}

		public function add_scenes(){
			$this->enqueueScriptScenes();
			include_once ('templates/bb_sm_add_scenes.tpl.php');
		}

		public function delete_scene(){
			$bbsmSceneIdDel = $_POST['bbsmSceneIdDel'];
			$del = wp_delete_post( $bbsmSceneIdDel, true );
			if($del) {
				$this->notice = esc_html__( 'Deleted scene!', 'bestbug' );
				add_action( 'admin_notices', array( $this, 'update_notice' ) );
			} else {
				$this->notice = esc_html__( 'Irks! An error has occurred.', 'bestbug' );
				add_action( 'admin_notices', array( $this, 'error_notice' ) );
			}
		}
		
		public function clone_scene(){
			$bbsmSceneIdClone = $_POST['bbsmSceneIdClone'];
			$post = get_post($bbsmSceneIdClone);

			if($post) {
				
				$scene = array(
					'post_title' => esc_html($post->post_title),
					'post_content' => $post->post_content,
					'post_type' => 'bbsm_scene',
					'post_status' => 'publish',
				);
				
				$scene_ID = wp_insert_post( $scene );
				
				if( !$scene_ID ) {
					$this->notice = esc_html__( 'Irks! An error has occurred.', 'bestbug' );
					add_action( 'admin_notices', array( $this, 'error_notice' ) );
				} else {
					
					$post = get_post($scene_ID);
					if($post) {
						$settings = (array)json_decode(base64_decode($post->post_content));
						$settings["general"]->name = $post->post_name;
						$scene = array(
							'ID'           => $scene_ID,
							'post_content' => base64_encode(json_encode($settings)),
						);
					  	wp_update_post( $scene );
					}
					
					$this->notice = esc_html__( 'Cloned scene!', 'bestbug' );
					add_action( 'admin_notices', array( $this, 'update_notice' ) );
				}
				
			} else {
				$this->notice = esc_html__( 'Irks! An error has occurred.', 'bestbug' );
				add_action( 'admin_notices', array( $this, 'error_notice' ) );
			}
		}

		public function scenes(){

			if( isset( $_POST['bbsmSceneOrderBy'] ) && isset( $_POST['bbsmSceneOrder'] ) ) {
				if( !empty( $_POST['bbsmSceneOrderBy'] ) ) {
					self::update_option(BESTBUG_SM_SCENE_ORDERBY, $_POST['bbsmSceneOrderBy']);
				} else {
					self::update_option(BESTBUG_SM_SCENE_ORDERBY, '');
				}
				if( !empty( $_POST['bbsmSceneOrder'] ) ) {
					self::update_option(BESTBUG_SM_SCENE_ORDER, $_POST['bbsmSceneOrder']);
				} else {
					self::update_option(BESTBUG_SM_SCENE_ORDER, '');
				}
			}
			
			$this->orderby = get_option( BESTBUG_SM_SCENE_ORDERBY, 'modified');
			$this->order = get_option( BESTBUG_SM_SCENE_ORDER, 'DESC');
			
			$this->scenes = get_posts(array(
				'numberposts' => -1,
				'post_type' => 'bbsm_scene',
				'orderby' => $this->orderby,
				'order'   => $this->order,
			));

			include_once ('templates/bb_sm_scenes.tpl.php');
		}

		public function import_preset(  ){
			foreach ($_POST as $key => $value) {
				$this->$key = esc_attr($value);
			}

			if(empty($this->source)) {
				$this->notice = esc_html__( 'Not found source!', 'bestbug' );
				add_action( 'admin_notices', array( $this, 'error_notice' ) );
				return;
			}

			global $wpdb;
			$preset = file_get_contents( $this->source );
			if(!empty($preset)) {
			$wpdb->query( str_replace( array(
				                           'wp_',
			                           ), array(
				                           $wpdb->prefix,
			                           ), $preset ), false );
		   }

		   $this->notice = esc_html__( 'Imported!', 'bestbug' );
		   add_action( 'admin_notices', array( $this, 'update_notice' ) );
		   $this->imported = true;
		}

		public function update_general(){
			foreach ($_POST as $key => $value) {
				$this->$key = esc_attr($value);
			}
			if( self::update_option(BESTBUG_SM_OPTIONS_BY_ELEMENTS, $this->option_by_elements) ||
			self::update_option(BESTBUG_SM_CUSTOM_ELEMENTS, $this->custom_elements) ||
			self::update_option(BESTBUG_SM_MOBILE_MODE, $this->mobile_mode) ||
			self::update_option(BESTBUG_SM_ALLOW_CLASS_NAME, $this->allow_class_name) ||
			self::update_option(BESTBUG_SM_SMOOTHSCROLL_MODE, $this->smoothscroll_mode)
			) {
				$this->notice = esc_html__( 'Updated', 'bestbug' );
				add_action( 'admin_notices', array( $this, 'update_notice' ) );
			} else {
				$this->notice = esc_html__( 'Irks! An error has occurred.', 'bestbug' );
				add_action( 'admin_notices', array( $this, 'error_notice' ) );
			}
		}

		public function update_option( $option_name, $option_value ){
			$option_exists = (get_option( $option_name, null) !== null);
			if($option_exists != null) {
				return update_option($option_name, $option_value);
			} else {
				return add_option($option_name, $option_value);
			}
		}

		public function error_notice() {
			$class = 'notice notice-error';
			printf( '<div class="%1$s"><p>%2$s</p></div>', $class, $this->notice );
		}
		public function update_notice() {
			$class = 'notice notice-updated updated';
			printf( '<div class="%1$s"><p>%2$s</p></div>', $class,  $this->notice );
		}

	}
	new BestBugSMOptions(
		BestBugSMHelper::$option_by_elements,
		BestBugSMHelper::$custom_elements,
		BestBugSMHelper::$mobile_mode,
		BestBugSMHelper::$allow_class_name,
		BestBugSMHelper::$smoothscroll_mode
	);
}

function bbsm_modify_jsx_tag( $tag, $handle, $src ) {
  // Check that this is output of JSX file
  if ( 'bb-scene-editor' == $handle ) {
    $tag = str_replace( "<script type='text/javascript'", "<script type='text/babel'", $tag );
  }

  return $tag;
}
add_filter( 'script_loader_tag', 'bbsm_modify_jsx_tag', 10, 3 );
