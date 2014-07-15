<?php

add_action('admin_menu' , 'mc_options_menu');
function mc_options_menu() {
    add_submenu_page('edit.php?post_type=minecraft-item', 'Minecraft Item Settings', 'MC Settings', 'edit_posts', basename(__FILE__), 'mc_options_page');
	add_action( 'admin_init', 'register_mcsettings' );
}

function register_mcsettings() {
	register_setting( 'almc_options', 'almc_options' );
}

function mc_options_page() {
	?>
	<style>
		.amctool {
			position: relative;
			text-decoration: none;
		}
		.amctool span {
			position: absolute;
			margin-left: -999em;
		}
		.amctool:hover span {
			margin-left: 0;
			top: 0;
			left: 2em;
			width: 250px;
			background: #1dcac8;
			border: 1px outset #064e4d;
			color: #000;
			padding: 5px;
			z-index: 1000;
		}
	</style>
	<div class="wrap">
	<h2>Minecraft Items Options</h2>

	<form method="post" action="options.php">
		<?php settings_fields('almc_options'); ?>

<?php
	$options = get_option('almc_options');
	echo '<p><a href="javascript: void(0);" class="almc-nav-link" rel="main-options">Main Options</a> | <a href="javascript: void(0);" class="almc-nav-link" rel="almc-lang-options">Language Options</a></p>';
	echo '<div id="main-options" class="almc-option-div">';
	echo '<table>';
	echo '<tr><td colspan="2"><h3>Crafting Recipe Table Options</h3></td></tr>';
	echo '<tr><td>Auto Insert Recipe Table?</td><td><input type="checkbox" name="almc_options[table_insert]" value="yes" '.($options['table_insert'] == 'yes' ? 'checked="checked"' : '').' /></td></tr>';

	echo '<tr><td>Insert Where?</td><td><select id="almc_table_location" name="almc_options[table_location]">';
	echo '<option value="before" '.($options['table_location'] == 'before' ? 'selected="selected"' : '').'>Before Content</option>';
	echo '<option value="after"'.($options['table_location'] == 'after' ? 'selected="selected"' : '').'>After Content</option>';
	echo '</select></td></tr>';

	echo '<tr><td>Float?</td><td><select id="almc_table_float" name="almc_options[table_float]">';
	echo '<option value="right" '.($options['table_float'] == 'right' ? 'selected="selected"' : '').'>Right</option>';
	echo '<option value="left"'.($options['table_float'] == 'left' ? 'selected="selected"' : '').'>Left</option>';
	echo '<option value="none"'.($options['table_float'] == 'none' ? 'selected="selected"' : '').'>None</option>';
	echo '</select></td></tr>';

	echo '<tr><td colspan="2"><h3>Item Stats Table Options</h3></td></tr>';
	echo '<tr><td>Auto Insert Item Stats?</td><td><input type="checkbox" name="almc_options[stat_insert]" value="yes" '.($options['stat_insert'] == 'yes' ? 'checked="checked"' : '').' /></td></tr>';

	echo '<tr><td>Insert Where?</td><td><select id="almc_stat_location" name="almc_options[stat_location]">';
	echo '<option value="before" '.($options['stat_location'] == 'before' ? 'selected="selected"' : '').'>Before Content</option>';
	echo '<option value="after"'.($options['stat_location'] == 'after' ? 'selected="selected"' : '').'>After Content</option>';
	echo '</select></td></tr>';

	echo '<tr><td>Float?</td><td><select id="almc_stat_float" name="almc_options[stat_float]">';
	echo '<option value="right" '.($options['stat_float'] == 'right' ? 'selected="selected"' : '').'>Right</option>';
	echo '<option value="left"'.($options['stat_float'] == 'left' ? 'selected="selected"' : '').'>Left</option>';
	echo '<option value="none"'.($options['stat_float'] == 'none' ? 'selected="selected"' : '').'>None</option>';
	echo '</select></td></tr>';

	echo '<tr><td>Max Width of Table?</td><td><input type="text" id="almc_stat_max_width" name="almc_options[stat_max_width]" value="'.$options['stat_max_width'].'" /> <small>enter in % or px, just a number will default to px</small></td></tr>';

	echo '<tr><td colspan="2"><h3>Item Sources Table Options</h3></td></tr>';
	echo '<tr><td>Auto Insert Sources Table?</td><td><input type="checkbox" name="almc_options[source_insert]" value="yes" '.($options['source_insert'] == 'yes' ? 'checked="checked"' : '').' /></td></tr>';

	echo '<tr><td>Insert Where?</td><td><select id="almc_source_location" name="almc_options[source_location]">';
	echo '<option value="before" '.($options['source_location'] == 'before' ? 'selected="selected"' : '').'>Before Content</option>';
	echo '<option value="after"'.($options['source_location'] == 'after' ? 'selected="selected"' : '').'>After Content</option>';
	echo '</select></td></tr>';

	echo '<tr><td>Float?</td><td><select id="almc_source_float" name="almc_options[source_float]">';
	echo '<option value="right" '.($options['source_float'] == 'right' ? 'selected="selected"' : '').'>Right</option>';
	echo '<option value="left"'.($options['source_float'] == 'left' ? 'selected="selected"' : '').'>Left</option>';
	echo '<option value="none"'.($options['source_float'] == 'none' ? 'selected="selected"' : '').'>None</option>';
	echo '</select></td></tr>';
	echo '</table>';
	echo '</div>';

	echo '<div id="almc-lang-options" class="almc-option-div">';
	echo '<table>';
	echo '<tr><th>Original</th><th>Translated</th></tr>';
	echo '<tr><td>Crafted With</td><td><input name="almc_options[lang_crafted_with]" type="" value="'.$options['lang_crafted_with'].'" /></td></tr>';
	echo '<tr><td>Required Materials</td><td><input name="almc_options[lang_req_mats]" type="" value="'.$options['lang_req_mats'].'" /></td></tr>';
	echo '<tr><td>Block/Item ID</td><td><input name="almc_options[lang_block_id]" type="" value="'.$options['lang_block_id'].'" /></td></tr>';
	echo '<tr><td>Attack Str</td><td><input name="almc_options[lang_atk_str]" type="" value="'.$options['lang_atk_str'].'" /></td></tr>';
	echo '<tr><td>Health</td><td><input name="almc_options[lang_health]" type="" value="'.$options['lang_health'].'" /></td></tr>';
	echo '<tr><td>Heals For</td><td><input name="almc_options[lang_heals_for]" type="" value="'.$options['lang_heals_for'].'" /></td></tr>';
	echo '<tr><td>Damages For</td><td><input name="almc_options[lang_damages_for]" type="" value="'.$options['lang_damages_for'].'" /></td></tr>';
	echo '<tr><td>Armor</td><td><input name="almc_options[lang_armor]" type="" value="'.$options['lang_armor'].'" /></td></tr>';
	echo '<tr><td>Hunger Restoration</td><td><input name="almc_options[lang_hunger_rest]" type="" value="'.$options['lang_hunger_rest'].'" /></td></tr>';
	echo '<tr><td>Durability</td><td><input name="almc_options[lang_durability]" type="" value="'.$options['lang_durability'].'" /></td></tr>';
	echo '<tr><td>Stackable</td><td><input name="almc_options[lang_stackable]" type="" value="'.$options['lang_stackable'].'" /></td></tr>';
	echo '<tr><td>Yes</td><td><input name="almc_options[lang_yes]" type="" value="'.$options['lang_yes'].'" /></td></tr>';
	echo '<tr><td>No</td><td><input name="almc_options[lang_no]" type="" value="'.$options['lang_no'].'" /></td></tr>';
	echo '<tr><td>Sources</td><td><input name="almc_options[lang_sources]" type="" value="'.$options['lang_sources'].'" /></td></tr>';
	echo '</table>';
	echo '</div>';
	echo '
	<script type="text/javascript">
	jQuery("#almc-lang-options").toggle();
	jQuery(".almc-nav-link").click( function() {
		var related = jQuery(this).attr("rel");
		jQuery(".almc-option-div").hide();
		jQuery("#"+related).show();
	});
	</script>';
	
?>

		<?php submit_button(); ?>
	</form>
	</div>
	<?php
}
?>