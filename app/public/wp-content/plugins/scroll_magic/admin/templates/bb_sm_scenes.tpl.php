<?php
if (!defined('ABSPATH')) {
    die;
}
?>
<div class="wrap bb_wrap bb_edo_settings" id="bb-edo-settings">
    <h2 class="bb-headtitle"><?php esc_html_e('ScrollMagic - All Scenes', 'bestbug') ?></h2>
    
    <a href="<?php echo admin_url( 'admin.php?page=bbsm_addnewscene' ) ?>" class="button success"><span class="dashicons dashicons-plus-alt"></span><?php esc_html_e('Add Scene', 'bestbug') ?></a>
    
    <form class="bbsm-form-scenes-order" action="" method="post">
        <select class="bbsmSceneOrderBy" name="bbsmSceneOrderBy" id="bbsmSceneOrderBy">
            <option value="">Order by..</option>
            <option value="ID" <?php echo ($this->orderby == 'ID')?'selected':'' ?>>ID</option>
            <option value="title" <?php echo ($this->orderby == 'title')?'selected':'' ?>>Title</option>
            <option value="name" <?php echo ($this->orderby == 'name')?'selected':'' ?>>CSS Class</option>
        </select>
        
        <select class="bbsmSceneOrder" name="bbsmSceneOrder" id="bbsmSceneOrder">
            <option value="">Order..</option>
            <option value="ASC" <?php echo ($this->order == 'ASC')?'selected':'' ?>>Lowest to highest</option>
            <option value="DESC" <?php echo ($this->order == 'DESC')?'selected':'' ?>>Highest to lowest</option>
        </select>
        <button type="submit" class="button primary">
            <span class="dashicons dashicons-update"></span></button>
    </form>
    
	<table class="wp-list-table widefat">
		<thead>
			<tr>
				<th width="100px"><?php esc_html_e('ID', 'bestbug') ?></th>
				<th><?php esc_html_e('Scene', 'bestbug') ?></th>
                <th><?php esc_html_e('CSS Class', 'bestbug') ?></th>
				<th width="150px"><?php esc_html_e('Action', 'bestbug') ?></th>
			</tr>
		</thead>
		<tbody>
			<?php
				foreach ($this->scenes as $id => $scene) {
			?>
				<tr>
					<td><strong><?php echo esc_html($scene->ID) ?></strong></td>
					<td><?php echo esc_html($scene->post_title) ?></td>
                    <td><?php echo esc_html($scene->post_name) ?>
                    </td>
					<td>
                        <a class="button success" title="Edit" href="<?php echo admin_url('admin.php?page=bbsm_addnewscene&idScene=' . $scene->ID) ?>">
    						<span class="dashicons dashicons-edit"></span>
                        </a>
                        <form id="bb_clone_scene_form" class="bb_delete_scene_form" action="" method="post">
							<input type="hidden" name="bbsmSceneIdClone" id="bbsmSceneIdClone" value="<?php echo esc_html($scene->ID) ?>" />
							<button title="Clone" onclick="javascript: return confirm('<?php esc_html_e('Do you want to clone this scene?', 'bestbug') ?>');" type="submit" class="button primary">
								<span class="dashicons dashicons-admin-page"></span></button>
						</form>

						<form id="bb_delete_scene_form" class="bb_delete_scene_form" action="" method="post">
							<input type="hidden" name="bbsmSceneIdDel" id="bbsmSceneIdDel" value="<?php echo esc_html($scene->ID) ?>" />
							<button onclick="javascript: return confirm('<?php esc_html_e('Are you sure delete this scene?', 'bestbug') ?>');" type="submit" class="button danger">
								<span class="dashicons dashicons-trash"></span></button>
						</form>

					</td>
				</tr>
			<?php
				}
			?>
		</tbody>
	</table>

	<a href="<?php echo admin_url( 'admin.php?page=bbsm_addnewscene' ) ?>" class="button success"><span class="dashicons dashicons-plus-alt"></span><?php esc_html_e('Add Scene', 'bestbug') ?></a>
    
    <form class="bbsm-form-scenes-order" action="" method="post">
        <select class="bbsmSceneOrderBy" name="bbsmSceneOrderBy" id="bbsmSceneOrderBy">
            <option value="">Order by..</option>
            <option value="ID" <?php echo ($this->orderby == 'ID')?'selected':'' ?>>ID</option>
            <option value="title" <?php echo ($this->orderby == 'title')?'selected':'' ?>>Title</option>
            <option value="name" <?php echo ($this->orderby == 'name')?'selected':'' ?>>CSS Class</option>
        </select>
        
        <select class="bbsmSceneOrder" name="bbsmSceneOrder" id="bbsmSceneOrder">
            <option value="">Order..</option>
            <option value="ASC" <?php echo ($this->order == 'ASC')?'selected':'' ?>>Lowest to highest</option>
            <option value="DESC" <?php echo ($this->order == 'DESC')?'selected':'' ?>>Highest to lowest</option>
        </select>
        <button type="submit" class="button primary">
            <span class="dashicons dashicons-update"></span></button>
    </form>

</div>
