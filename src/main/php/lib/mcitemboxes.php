<?php
function mc_item_boxes() {
	add_meta_box(
		'minecraft-item-stats',
		'Minecraft Stats',		// Title
		'mcstat_options',		// Callback function
		'minecraft-item',					// Admin page (or post type)
		'advanced',					// Context
		'high'					// Priority
	);
	add_meta_box(
		'minecraft-item-source',
		'Source Options',		// Title
		'source_options',		// Callback function
		'minecraft-item',					// Admin page (or post type)
		'advanced',					// Context
		'high'					// Priority
	);
	add_meta_box(
		'minecraft-item-recipe',
		'Craftable Options',		// Title
		'craftable_options',		// Callback function
		'minecraft-item',					// Admin page (or post type)
		'advanced',					// Context
		'high'					// Priority
	);
}

function source_options() {
	global $post;
	$sources = get_post_meta($post->ID, 'sources', true);
	?>
	<div class="craft-box">
		<table id="mcsourcebox">
			<?php
				if (is_array($sources) && count($sources) > 0) {
					foreach ($sources As $k => $v) {
						if (is_numeric($v)) {
							echo '<tr><td><label>Source: <a class="amctool"><span>This item can be obtained from this source?</span>(?)</a></label></td><td>'.get_source_select($v).'</td></tr>';
						}
					}
				}
				echo '<tr><td><label>Source: <a class="amctool"><span>This item can be obtained from this source?</span>(?)</a></label></td><td>'.get_source_select().'</td></tr>';
			?>
		</table>
		<a href="javascript: void(0);" id="addsource">Add Another Source</a>
		<script type="text/javascript">
			jQuery("#addsource").click( function() {
				jQuery("#mcsourcebox").append('<tr><td><label>Source: <a class="amctool"><span>This item can be obtained from this source?</span>(?)</a></label></td><td><?php echo get_source_select(); ?></td></tr>');
			});
		</script>
	</div>
	<?php
}

function mcstat_options() {
	global $post, $plugin_url;
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

	
	<div class="craft-box">
	<table class="">
		<tr>
			<td>
				<label for="durability">Block/Item ID: <a class="amctool"><span>Minecraft Item or Block ID</span>(?)</a></label>
			</td>
			<td>
				<input type="text" name="mc[blockitemid]" value="<?php echo get_post_meta( $post->ID, 'blockitemid', true); ?>" />
			</td>
		</tr>
		<tr>
			<td>
				<label for="stackable">Stack Count: <a class="amctool"><span>If stackable, how many per stack?</span>(?)</a></label>
			</td>
			<td>
				<input type="text" name="mc[stackable]" value="<?php echo get_post_meta( $post->ID, 'stackable', true); ?>" />
			</td>
		</tr>
		<tr>
			<td>
				<label for="health">Health: <a class="amctool"><span>How much health does the monster or critter have?</span>(?)</a></label>
			</td>
			<td>
				<input type="text" name="mc[health]" value="<?php echo get_post_meta( $post->ID, 'health', true); ?>" />
				<img src="<?php echo $plugin_url; ?>images/heart.png" />
			</td>
		</tr>
		<tr>
			<td>
				<label for="heals_for">Heals For: <a class="amctool"><span>How much health is returned when used?</span>(?)</a></label>
			</td>
			<td>
				<input type="text" name="mc[heals_for]" value="<?php echo get_post_meta( $post->ID, 'heals_for', true); ?>" />
				<img src="<?php echo $plugin_url; ?>images/heart.png" />
			</td>
		</tr>
		<tr>
			<td>
				<label for="damages_for">Damages For: <a class="amctool"><span>How much damage is done when used?</span>(?)</a></label>
			</td>
			<td>
				<input type="text" name="mc[damages_for]" value="<?php echo get_post_meta( $post->ID, 'damages_for', true); ?>" />
				<img src="<?php echo $plugin_url; ?>images/heart-g.png" />
			</td>
		</tr>
		<tr>
			<td>
				<label for="points_of_protection">Points of Protection: <a class="amctool"><span>How many points of protection does the item give? (Max 10)</span>(?)</a></label>
			</td>
			<td>
				<input type="text" name="mc[points_of_protection]" value="<?php echo get_post_meta( $post->ID, 'points_of_protection', true); ?>" />
				<img src="<?php echo $plugin_url; ?>images/pop1.png" />
			</td>
		</tr>
		<tr>
			<td>
				<label for="points_of_protection">Attack Strength: <a class="amctool"><span>How much is the attack strength?</span>(?)</a></label>
			</td>
			<td>
				<input type="text" name="mc[attack_strength]" value="<?php echo get_post_meta( $post->ID, 'attack_strength', true); ?>" />
			</td>
		</tr>
		<tr>
			<td>
				<label for="durability">Durability: <a class="amctool"><span>How much durability does the item have?</span>(?)</a></label>
			</td>
			<td>
				<input type="text" name="mc[durability]" value="<?php echo get_post_meta( $post->ID, 'durability', true); ?>" />
			</td>
		</tr>
		<tr>
			<td>
				<label for="hunger_restoration">Hunger Restoration: <a class="amctool"><span>How much hunger is restored? (Usually a max of 6)</span>(?)</a></label>
			</td>
			<td>
				<input type="text" name="mc[hunger_restoration]" value="<?php echo get_post_meta( $post->ID, 'hunger_restoration', true); ?>" />
				<img src="<?php echo $plugin_url; ?>images/hung1.png" />
			</td>
		</tr>
	</table>
	</div>
	<?php
}

function craftable_options() {
	global $post, $plugin_url;
	// Use nonce for verification
	wp_nonce_field( plugin_basename( __FILE__ ), 'craftable_noncename' );

	// The actual fields for data entry
	?>
	<div class="craft-box">
		<div style="float: left">
			<?php
			$station = get_post_meta( $post->ID, 'crafting_station', true);
			if ($station == '') {
				$station = 0;
			}
			?>
			<table class="">
				<tr>
					<td>
						<label for="crafting_station">Crafting Station: <a class="amctool"><span>What kind of crafting station is used?</span>(?)</a></label>
					</td>
					<td>
						<?php echo get_station_select( $station ); ?>
					</td>
				</tr>
				<tr>
					<td>
						<label for="num_crafted"># Crafted: <a class="amctool"><span>How many are created?</span>(?)</a></label>
					</td>
					<td>
						<input type="text" name="mc[num_crafted]" value="<?php echo get_post_meta( $post->ID, 'num_crafted', true); ?>" />
					</td>
				</tr>
				<?php
				$counts = get_post_meta($post->ID, 'material_count', true);
				$i = 0;
				if ($counts) {
					foreach ($counts As $k => $v) {
						foreach ($v As $vk => $vv) {
							$l = $vk;
						}
						$v = $l;
						$string = '
						<tr>
							<td>
								<label for="material_count">Slot ' . ($i+1) . ' <a class="amctool"><span>Refer to the slot numbers in the format images to the right.</span>(?)</a></label> 
								<input type="hidden" name="mc[material_count][]" value="'.($i+1).'" />
								<label for="materials">Material: <a class="amctool"><span>What material is used to craft in this slot?</span>(?)</a> </label>
							</td>
							<td>
								' . get_material_select($v) . '
							</td>
						</tr>';
						echo $string;
						$i++;
					}
				}
				for ($n = $i; $n < 9; $n++) {
					$string = '
						<tr>
							<td>
								<label for="material_count">Slot ' . ($n+1) . ' <a class="amctool"><span>Refer to the slot numbers in the format images to the right.</span>(?)</a></label> 
								<input type="hidden" name="mc[material_count][]" value="'.($n+1).'" />
								<label for="materials"> Material: <a class="amctool"><span>What material is used to craft in this slot?</span>(?)</a></label>
							</td>
							<td>
								' . get_material_select() . '
							</td>
						</tr>';
					echo $string;
				}
				?>
			</table>
		</div>
		<?php
			$recipe_format = get_post_meta( $post->ID, 'recipe_format', true);
		?>
		<div style="float: left; margin-left: 30px;">
			<label>Format 1 <a class="amctool"><span>Used for Crafting Tables</span>(?)</a></label>
			<input type="radio" name="mc[recipe_format]" value="1" <?php echo (($recipe_format == 1 || $recipe_format == '') ? 'checked="checked"' : ''); ?> />
			<br />
			<img src="<?php echo $plugin_url; ?>images/format1.jpg" />
		</div>
		<div style="float: left; margin-left: 30px;">
			<label>Format 2 <a class="amctool"><span>Used for Furnace / Smelting</span>(?)</a></label>
			<input type="radio" name="mc[recipe_format]" value="2" <?php echo ($recipe_format == 2 ? 'checked="checked"' : ''); ?> />
			<br />
			<img src="<?php echo $plugin_url; ?>images/format2.jpg" />
		</div>
		<div style="float: left; margin-left: 30px;">
			<label>Format 3 <a class="amctool"><span>Used for creating potions.</span>(?)</a></label>
			<input type="radio" name="mc[recipe_format]" value="3" <?php echo ($recipe_format == 3 ? 'checked="checked"' : ''); ?> />
			<br />
			<img src="<?php echo $plugin_url; ?>images/format3.jpg" />
		</div>
		<div style="clear:both"></div>
	</div>
<?php
}

function get_material_select( $selected = 0 ) {
	if ($term = term_exists('Material','mctype')) {
		$args = array(
			'numberposts'     => -1,
			'post_type'	=> 'minecraft-item',
			'orderby' => 'title',
			'order'	=> 'ASC',
			'tax_query' => array(
				array(
					'taxonomy' => 'mctype',
					'field' => 'is',
					'terms' => array( $term['term_id'] )
				)
			)
		);
		$these = get_posts( $args );
	}
	$string = '<select name="mc[materials][]"><option></option>';
	if ($these) {
		foreach ($these As $post) {
			$string .= '<option value="'.$post->ID.'"';
				if ($post->ID == $selected) {
					$string .= ' selected="selected"';
				}
			$string .= '>'.$post->post_title.'</option>';
		}
	}
	$string .= '</select>';
	return $string;
}

function get_station_select( $selected = 0 ) {
	if ($term = term_exists('Crafting Station','mctype')) {
		$args = array(
			'numberposts'     => -1,
			'post_type'	=> 'minecraft-item',
			'orderby' => 'title',
			'order'	=> 'ASC',
			'tax_query' => array(
				array(
					'taxonomy' => 'mctype',
					'field' => 'id',
					'terms' => array( $term['term_id'] )
				)
			)
		);
		$these = get_posts( $args );
	}
	$string = '<select name="mc[crafting_station]"><option></option>';
	if ($these) {
		foreach ($these As $post) {
			$string .= '<option value="'.$post->ID.'"';
				if ($post->ID == $selected) {
					$string .= ' selected="selected"';
				}
			$string .= '>'.$post->post_title.'</option>';
		}
	}
	$string .= '</select>';
	return $string;
}

function get_source_select( $selected = 0 ) {
	if ($term = term_exists('Source','mctype')) {
		$args = array(
			'numberposts'     => -1,
			'post_type'	=> 'minecraft-item',
			'orderby' => 'title',
			'order'	=> 'ASC',
			'tax_query' => array(
				array(
					'taxonomy' => 'mctype',
					'field' => 'is',
					'terms' => array( $term['term_id'] )
				)
			)
		);
		$these = get_posts( $args );
	}
	$string = '<select name="mc[sources][]"><option></option>';
	if ($these) {
		foreach ($these As $post) {
			$string .= '<option value="'.$post->ID.'"';
				if ($post->ID == $selected) {
					$string .= ' selected="selected"';
				}
			$string .= '>'.$post->post_title.'</option>';
		}
	}
	$string .= '</select>';
	return $string;
}


add_action( 'save_post', 'craftable_save_postdata' );

function craftable_save_postdata( $post_id, $post = '' ) {
  // verify if this is an auto save routine. 
  // If it is our form has not been submitted, so we dont want to do anything
  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
      return;

  // verify this came from the our screen and with proper authorization,
  // because save_post can be triggered at other times

  if ( !wp_verify_nonce( $_POST['craftable_noncename'], plugin_basename( __FILE__ ) ) )
      return;

  if ( !current_user_can( 'edit_post', $post_id ) ) {
        return;
  }

  // OK, we're authenticated: we need to find and save the data
	if (is_array($_POST['mc'])) {
		foreach ($_POST['mc'] As $k => $v) {
			$meta_key = $k;
			$new_meta_value = ( isset( $v ) ? $v : '' );
			$meta_value = get_post_meta( $post_id, $meta_key, true );
			if (is_array($v)) {
				if ($k == 'material_count') {
					$count_value = array();
					$i = 0;
					foreach ($v As $value) {
						if ($_POST['mc']['materials'][$i] > 0) {
							$count_value[][$_POST['mc']['materials'][$i]] = $v[$i];
						}
						else {
							$count_value[]['empty-'.$i] = $v[$i];
						}
						$i++;
					}
	
					$new_meta_value = $count_value;
				}
				else if ($k == 'sources') {
					$count_value = array();
					$i = 0;
					foreach ($v As $value) {
						$count_value[] = $value;
					}
					$new_meta_value = $count_value;
				}
			}
			/* If a new meta value was added and there was no previous value, add it. */
			if ( $new_meta_value && '' == $meta_value )
				add_post_meta( $post_id, $meta_key, $new_meta_value, true );

			/* If the new meta value does not match the old value, update it. */
			elseif ( $new_meta_value && $new_meta_value != $meta_value )
				update_post_meta( $post_id, $meta_key, $new_meta_value );

			/* If there is no new meta value but an old value exists, delete it. */
			elseif ( '' == $new_meta_value && $meta_value )
				delete_post_meta( $post_id, $meta_key, $meta_value );
		}
	}
	else { return; }				
}

?>