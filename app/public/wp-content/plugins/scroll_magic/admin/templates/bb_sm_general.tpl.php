<?php
if (!defined('ABSPATH')) {
    die;
}
?>
<div class="wrap bb_wrap bb_sm_settings" id="bb-vcvs-settings">
    <h2 class="bb-headtitle"><?php esc_html_e('ScrollMagic - General Settings', 'bestbug') ?></h2>

	<form id="bb-form" method="post" action="">
		<div class="bb-form">
			<h3><?php esc_html_e('Visual composer support', 'bestbug') ?></h3>
			<div class="bb-field-row">
				<div class="bb-label">
					<label><?php esc_html_e('Mode Elements Option by themselves', 'bestbug') ?></label>
				</div>
				<div class="bb-field">
					<select name="option_by_elements" id="bb_sm_option_by_themselves">
						<option value="none" <?php echo ($this->option_by_elements == 'none')?'selected="selected"' : ''; ?>><?php esc_html_e('Disable', 'bestbug') ?></option>
						<option value="all" <?php echo ($this->option_by_elements == 'all')?'selected="selected"' : ''; ?>><?php esc_html_e('All of Elements', 'bestbug') ?></option>
						<option value="custom" <?php echo ($this->option_by_elements == 'custom')?'selected="selected"' : ''; ?>><?php esc_html_e('Custom Elements', 'bestbug') ?></option>
					</select>

					<p id="bb_sm_option_by_themselves_custom" class="bb_sm_icon_depend">
						<textarea name="custom_elements"><?php echo esc_textarea( $this->custom_elements ) ?></textarea>
					</p>
				</div>
				<div class="bb-desc">
					<?php //esc_html_e("'All of Elements' only apply to elements have available 'Design Options'", 'bestbug') ?>
				</div>
			</div>
			<div class="bb-field-row">
				<div class="bb-label">
					<label><?php esc_html_e('Mobile mode', 'bestbug') ?></label>
				</div>
				<div class="bb-field">
					<select id="mobile_mode" name="mobile_mode">
						<option <?php if($this->mobile_mode == 'false') {echo 'selected="selected"';} ?> value="false"><?php esc_html_e('Disable', 'bestbug') ?></option>
						<option <?php if($this->mobile_mode == 'true') {echo 'selected="selected"';} ?> value="true"><?php esc_html_e('Enable', 'bestbug') ?></option>
					</select>
				</div>
				<div class="bb-desc">
				</div>
			</div>

			<div class="bb-field-row">
				<div class="bb-label">
					<label><?php esc_html_e('SmoothScroll mode', 'bestbug') ?></label>
				</div>
				<div class="bb-field">
					<select id="smoothscroll_mode" name="smoothscroll_mode">
						<option <?php if($this->smoothscroll_mode == 'false') {echo 'selected="selected"';} ?> value="false"><?php esc_html_e('Disable', 'bestbug') ?></option>
						<option <?php if($this->smoothscroll_mode == 'true') {echo 'selected="selected"';} ?> value="true"><?php esc_html_e('Enable', 'bestbug') ?></option>
					</select>
				</div>
				<div class="bb-desc">
				</div>
			</div>
            
            <div class="bb-field-row">
				<div class="bb-label">
					<label><?php esc_html_e('Allow class name', 'bestbug') ?></label>
				</div>
				<div class="bb-field">
					<select id="allow_class_name" name="allow_class_name">
						<option <?php if($this->allow_class_name == 'false') {echo 'selected="selected"';} ?> value="false"><?php esc_html_e('Disable', 'bestbug') ?></option>
						<option <?php if($this->allow_class_name == 'true') {echo 'selected="selected"';} ?> value="true"><?php esc_html_e('Enable', 'bestbug') ?></option>
					</select>
				</div>
				<div class="bb-desc">
				</div>
			</div>
		</div>

		<input type="hidden" name="bb_sm_update_general" value="1">
		<button type="submit" name="submit" class="button success">
			<span class="dashicons dashicons-admin-generic"></span>
			<?php esc_html_e('Save Changes', 'bestbug') ?>
		</button>
	</form>

</div>
