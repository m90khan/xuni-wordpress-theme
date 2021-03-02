<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * @package Core
 */
class BBSM_Posttypes {

	/**
	 * The constructor.
	 */
	public function __construct() {
		add_action( 'init', array( $this, 'init' ) );
	}

	public function init() {
		$this->bestbug_posttypes();
		$this->bestbug_taxonomy();
	}

	public function bestbug_posttypes() {

		$labels = array(
			'name'               => _x( 'Scenes', 'Scenes', 'bestbug' ),
			'singular_name'      => _x( 'Scene', 'Scene', 'bestbug' ),
			'menu_name'          => _x( 'Scenes', 'Scenes', 'bestbug' ),
			'name_admin_bar'     => _x( 'Scene', 'Scene', 'bestbug' ),
			'add_new'            => _x( 'Add New', 'Scene', 'bestbug' ),
			'add_new_item'       => __( 'Add New Scene', 'bestbug' ),
			'new_item'           => __( 'New Scene', 'bestbug' ),
			'edit_item'          => __( 'Edit Scene', 'bestbug' ),
			'view_item'          => __( 'View Scene', 'bestbug' ),
			'all_items'          => __( 'All Scenes', 'bestbug' ),
			'search_items'       => __( 'Search Scenes', 'bestbug' ),
			'parent_item_colon'  => __( 'Parent Scenes:', 'bestbug' ),
			'not_found'          => __( 'No Scenes found.', 'bestbug' ),
			'not_found_in_trash' => __( 'No Scenes found in Trash.', 'bestbug' )
		);

		$args = array(
			'labels'             => $labels,
            'description'        => __( 'Scenes settings.', 'bestbug' ),
			'public'             => false,
			'publicly_queryable' => true,
			'show_ui'            => false,
			'show_in_menu'       => false,
			'query_var'          => true,
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => null,
		);

		register_post_type( 'bbsm_scene', $args );

	}

	public function bestbug_taxonomy() {

	}

}

new BBSM_Posttypes;
