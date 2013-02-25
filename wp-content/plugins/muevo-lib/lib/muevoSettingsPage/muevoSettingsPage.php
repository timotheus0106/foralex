<?php
/**
 * @todo add view support and allow theme base view overrides
 * @todo auto laod&resolve dependencies on asset, cdn etc.
 * @todo switch to new wp editor functions as soon as possible
 */

class muevoSettingsPage extends muevoLib {

	public static function init($args) {

	}

 	public function muevoSettingsPage($title, $fields) {
 		$this->title = $title;
		$this->fields = $fields;

		$this->standard_fields = array(

			"Google Analytics Code" => array( "ID" => array("string", "google_analytics_code", "Google Analytics ID 'UA-123xyz'")	),

			);


		$this->fields = array_merge($this->standard_fields, $fields);

 		add_action('admin_menu', array(&$this, 'page_info'));
		add_action('admin_init', array(&$this, 'register_settings'));
 	}

	public function register_settings() {
		foreach( $this->fields as $section => $settings ) {
			foreach( $settings as $setting) {
				register_setting('muevo_theme_settings', $setting[1]);
			}
		}
	}

	public function page_info() {
		add_menu_page($this->title, $this->title, 'moderate_comments', 'page-info-show', array(&$this, 'page_info_show'));
	}

	public function page_info_show() {
		?>
		<style type="text/css">
			td hr {
				background-color:#eee;
				color:#eee;
				border:none;
			}
		</style>
		<script type="text/javascript" src="../wp-includes/js/tinymce/tiny_mce.js"></script>
		<div class="wrap">
			<h2><?php echo $this->title ?></h2>
			<form method="post" action="options.php">
				<?php wp_nonce_field('update-options'); ?>
				<?php settings_fields( 'muevo_theme_settings' ); ?>
				<?php foreach( $this->fields as $header => $settings ) : ?>
				<h3><?php echo $header; ?></h3>
				<table class="form-table widefat">
					<?php foreach( $settings as $title => $setting ) : ?>
					<tr valign="top">
						<th scope="row"><?php echo $title ?></th>
						<td>
							<?php if( $setting[0] == "string" ) : ?>
							<input style="width:100%;" type="text" name="<?php echo $setting[1] ?>" value="<?php echo get_option($setting[1]) ?>" />
							<?php elseif( $setting[0] == "text" ) : ?>
							<?php wp_editor( get_option($setting[1]), $setting[1], array('textarea_rows' => 10, 'wpautop' => true, 'media_buttons' => false )); ?>
							<?php endif; ?>
							<span class="description"><?php echo $setting[2] ?></span>
						</td>
					</tr>
					<?php endforeach; ?>
				</table>
				<?php endforeach; ?>
				<input type="hidden" name="action" value="update" />
				<p class="submit">
					<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
				</p>
			</form>
		</div>

		<?php
	}
}