<?php

add_filter('the_content','insert_mc_table');
function insert_mc_table( $content ) {
	$options = get_option('almc_options');
/*
table_insert
table_location
table_float
stat_insert
stat_location
stat_float
source_insert
source_location
source_float
*/
	if ($options['table_insert'] == 'yes') {
		if ($options['table_location'] == 'before') {
			$content = recipe_table().''.$content;
		}
		if ($options['table_location'] == 'after') {
			$content = $content.''.recipe_table();
		}
	}
	if ($options['stat_insert'] == 'yes') {
		if ($options['stat_location'] == 'before') {
			$content = mcstats_table().''.$content;
		}
		if ($options['stat_location'] == 'after') {
			$content = $content.''.mcstats_table();
		}
	}
	if ($options['source_insert'] == 'yes') {
		if ($options['source_location'] == 'before') {
			$content = mcsources_table().''.$content;
		}
		if ($options['source_location'] == 'after') {
			$content = $content.''.mcsources_table();
		}
	}
	
	return $content;
}



add_shortcode('mcitem-recipe','recipe_table');

function recipe_table() {
	global $plugin_url, $post;
	$post_id = $post->ID;
	$options = get_option('almc_options');
	$material_count = get_post_meta($post_id, 'material_count', true);
	$hasmats = 0;
	$string = '';
	if (has_term('craftable','mctype')) {
		$hasmats = 1;
	}
	if (count($material_count) > 0 && $hasmats > 0) {
		$string .= '
		<style>
		table.recipe-table {
			border-width: 4px;
			border-spacing: 3px;
			border-style: outset;
			border-color: gray;
			border-collapse: separate;
			background-color: rgb(139, 139, 139);
			empty-cells: hide;
		}
		table.recipe-table td {
			width: 50px;
			height: 50px;
			border-width: 3px;
			padding: 0px;
			border-style: inset;
			border-color: gray;
			background-color: rgb(139, 139, 139);
			text-align: center;
		}
		</style>
		';
		$string .= '<table style="float: '.$options['table_float'].'; width: auto; height: auto;" id="recipe-table">
		<tr>
		<td>
		<table>
		<tr>
		<td>';
		$format = get_post_meta( $post_id, 'recipe_format', true);
		if ($format == 1 || $format == 2) {
			$string .= '<table class="recipe-table" width="auto" height="auto">';
			$station = get_post_meta( $post_id, 'crafting_station', true );
			$i = 0;
			$total = 0;
			foreach ($material_count As $mk => $mv) {
					if ($i == 0) { $string .= '<tr>'; }
					foreach ($mv As $mmk => $mmv) {
						$l = $mmk;
					}
					$mk = $l;
					$string .= '<td style="'.(($total == 4 && $format == 2) ? 'border-style: none' : '').'">';
						if (is_numeric($mk)) {
							$string .= '<a href="'.get_permalink($mk).'">';
							$string .= get_the_post_thumbnail( $mk, 'recipe-table' );
							$string .= '</a>';
						}
						else if ($format == 2 && $total == 4) {
							if ($station != '') {
								$string .= '<a href="'.get_permalink($station).'"><img src="'.$plugin_url.'images/smelting.png" alt="Smelting" title="Smelting" /></a>';
							}
						}
						else {
							if ($format == 2) {
								$string .= '';
							}
							else {
								$string .= '&nbsp;';
							}
						}
					$string .= '</td>';
					if ($i == 2) { $string .= '</tr>'; $i = 0; }
					else {
						$i++;
					}
					$total++;
			}
			while ($total < 9) {
				if ($i == 0) { $string .= '<tr>'; }
				$string .= '<td>';
					$string .= '&nbsp;';
				$string .= '</td>';

				if ($i == 2) { $string .= '</tr>'; $i = 0; }
				else {
					$i++;
				}
				$total++;
			}
			$string .= '</table>';
		} else { 
			$station = get_post_meta( $post_id, 'crafting_station', true );
		$string .= '<table width="188px" height="188px" background="' . $plugin_url . 'images/brewing.png" style="display: inline-block; max-height: 188px; overflow: hidden;">
			<tr>
				<td style="display: inline-block; position: relative">
		';
					$mat1 = key($material_count[0]);
					$mat2 = key($material_count[6]);
					$mat3 = key($material_count[7]);
					$mat4 = key($material_count[8]);
					if (substr_count($mat1, 'empty') == 0) {
						$string .= '<div style="display: block; position: absolute; top: 22px; left: 67px;"><a href="'.get_permalink($mat1).'">'.get_the_post_thumbnail($mat1, 'recipe-table').'</a></div>';
					}
					else {
						$string .= '<div style="display: block; position: absolute; top: 22px; left: 67px;"><img src="'.$plugin_url.'images/bottle.png" /></div>';
					}
					if (substr_count($mat2, 'empty') == 0) {
						$string .= '<div style="display: block; position: absolute; top: 104px; left: 8px;"><a href="'.get_permalink($mat2).'">'.get_the_post_thumbnail($mat2, 'recipe-table').'</a></div>';
					}
					else {
						$string .= '<div style="display: block; position: absolute; top: 104px; left: 8px;"><img src="'.$plugin_url.'images/bottle.png" /></div>';
					}
					if (substr_count($mat3, 'empty') == 0) {
						$string .= '<div style="display: block; position: absolute; top: 126px; left: 67px;"><a href="'.get_permalink($mat3).'">'.get_the_post_thumbnail($mat3, 'recipe-table').'</a></div>';
					}
					else {
						$string .= '<div style="display: block; position: absolute; top: 126px; left: 67px;"><img src="'.$plugin_url.'images/bottle.png" /></div>';
					}
					if (substr_count($mat4, 'empty') == 0) {
						$string .= '<div style="display: block; position: absolute; top: 104px; left: 126px;"><a href="'.get_permalink($mat4).'">'.get_the_post_thumbnail($mat4, 'recipe-table').'</a></div>';
					}
					else {
						$string .= '<div style="display: block; position: absolute; top: 104px; left: 126px;"><img src="'.$plugin_url.'images/bottle.png" /></div>';
					}
		$string .= '
				</td>
			</tr>
		</table>';
		}
		$string .= '</td>
		<td valign="middle"><span class="craft-arrow"></span></td>
		<td valign="middle"><table class="recipe-table" width="auto" height="auto"><tr><td style="display: inline-block; width: 50px; height: 50px"><div style="position: relative">' . get_the_post_thumbnail($post_id, 'recipe-table') . ' 
		<span style="position: absolute; bottom: 5px; right: 5px; color: #FFF; font-weight: bold;">'.get_post_meta($post_id, 'num_crafted', true).'</span>
		</div></td></tr></table></td>
		</tr>
		</table>
		</td></tr>
		<tr><td>
		<span class="recipe-title">'.$options['lang_req_mats'].':</span>
		';
			$counts = array();
			if (is_array($material_count)) {
				foreach ($material_count As $mk => $mv) {
					foreach ($mv As $mmk => $mmv) {
						$l = $mmk;
					}
					$mk = $l;
					if (is_numeric($mk)) {
						if (isset($counts[$mk])) {
							$counts[$mk] = $counts[$mk] + 1;
						}
						else {
							$counts[$mk] = 1;
						}
					}
				}
				$material_count = $counts;
			}
			if (is_array($material_count)) {
				$string .= '<table>';
				foreach ($material_count As $mk => $mv) {
					$string .= '<tr><td><a href="'.get_permalink($mk).'">'.get_the_post_thumbnail($mk, 'recipe-table').'</a></td><td><a href="'.get_permalink($mk).'">' . $mv . ' x ' . get_the_title($mk) . '</a></td></tr>';
				}
				$string .= '</table>';
			}
		$string .= '
		</td></tr>
		<tr><td>
		<span class="recipe-title">'.$options['lang_crafted_with'].':</span>
		';
			if ($station != '') {
				$string .= '<table>';
				$string .= '<tr><td><a href="'.get_permalink($station).'">'.get_the_post_thumbnail($station, 'recipe-table').'</a></td><td><a href="'.get_permalink($station).'">' . get_the_title($station) . '</a></td></tr>';
				$string .= '</table>';				
			}
		$string .= '</td></tr>';

		$string .= '</table>';
	}
	return $string;
}

add_shortcode('mcitem-stats','mcstats_table');

function mcstats_table() {
	global $plugin_url, $post;
	$post_id = $post->ID;
	$options = get_option('almc_options');
	$string = '';
	$maxwidth = $options['stat_max_width'];
	if (!$maxwidth) {
		$maxwidth = '50%';
	}
	else if (substr_count($maxwidth, '%') == 0 && substr_count($maxwidth, 'px') == 0) {
		$maxwidth = $maxwidth.'px';
	}
	
	$string .= '<table style="float: '.$options['stat_float'].'; max-width: '.$maxwidth.'" id="stat-table">';
	$string .= '<tr>';
	$string .= '<td>';
	
	$imageURL = wp_get_attachment_url( get_post_thumbnail_id($post_id, 'thumbnail') );
	$string .= '<div class="item-image"><img height="125" src="'.$imageURL.'"></div>';

	$blockitemid = get_post_meta($post_id, 'blockitemid', true);
	if ($blockitemid != '') {
		$string .= '<div class="stat"><div class="stat-name">'.$options['lang_block_id'].'</div><div class="stat-value">'.$blockitemid.'</div></div>';
	}

	$atkstr = get_post_meta($post_id, 'attack_strength', true);
	if ($atkstr != '') {
		$string .= '<div class="stat"><div class="stat-name">'.$options['lang_atk_str'].'</div><div class="stat-value">'.$atkstr.'</div></div>';
	}

	$health = get_post_meta($post_id, 'health', true);
	if ($health != '') {

		$string .= '<div class="stat"><div class="stat-name">'.$options['lang_health'].'</div><div class="stat-value">';

		if ($health > 10)
		{
			$string .= $health.' <img src="'.$plugin_url.'images/heart.png" width="18" height="18" style="vertical-align: middle;">';
		}
		else if ($odd = $health % 2)
		{
			$health = (($health - 1) / 2);

			$string .= '<span style="display: inline-block; background: url('.$plugin_url.'images/heart.png) repeat-x; background-size: 9px 9px; height: 9px; width: ' . (9*$health) . 'px" title="'.($health*2+1).' '.$options['lang_health'].'" alt="'.($health*2+1).' '.$options['lang_health'].'"></span>';

			$string .= '<span style="display: inline-block; background: url('.$plugin_url.'images/heart_half.png) repeat-x; background-size: 9px 9px; height: 9px; width: 9px" title="'.($health*2+1).' '.$options['lang_health'].'" alt="'.($health*2+1).' '.$options['lang_health'].'"></span>';

		}
		else 
		{
			$string .= '<span style="display: inline-block; background: url('.$plugin_url.'images/heart.png) repeat-x; height: 9px; background-size: 9px 9px; width: ' . (9*$health) . 'px" title="'.$health.' '.$options['lang_health'].'" alt="'.$health.' '.$options['lang_health'].'"></span>';
		}

		$string .= '</div></div>';
	
	}

	$healsfor = get_post_meta($post_id, 'heals_for', true);
	if ($healsfor != '') {
		$string .= '<div class="stat"><div class="stat-name">'.$options['lang_heals_for'].'</div><div class="stat-value">';
		if ($odd = $healsfor%2) {
			$healsfor = (($healsfor - 1) / 2);
			$string .= '<span style="display: inline-block; background: url('.$plugin_url.'images/heart.png) repeat-x; background-size: 9px 9px; height: 9px; width: ' . (9*$healsfor) . 'px" title="'.($healsfor*2+1).' Health" alt="'.($healsfor*2+1).' Health"></span>';
			$string .= '<span style="display: inline-block; background: url('.$plugin_url.'images/heart_half.png) repeat-x; background-size: 9px 9px; height: 9px; width: 18px" title="'.($healsfor*2+1).' Health" alt="'.($healsfor*2+1).' Health"></span>';
		}
		else {
			$string .= '<span style="display: inline-block; background: url('.$plugin_url.'images/heart.png) repeat-x; background-size: 9px 9px; height: 9px; width: ' . (9*$healsfor/2) . 'px" title="'.$healsfor.' Health" alt="'.$healsfor.' Health"></span>';
		}
		$string .= '</div></div>';
	}

	$damages = get_post_meta($post_id, 'damages_for', true);
	if ($damages != '')
	{
		$string .= '<div class="stat"><div class="stat-name">'.$options['lang_damages_for'].'</div><div class="stat-value">';

		if ($odd = $damages%2)
		{
			$damages = (($damages - 1) / 2);
			$string .= '<span style="display: inline-block; background: url('.$plugin_url.'images/heart-g.png) repeat-x; background-size: 9px 9px; height: 9px; width: ' . (9*$damages) . 'px" title="'.$options['lang_damages_for'].' '.($damages*2+1).'" alt="'.$options['lang_damages_for'].' '.($damages*2+1).'"></span>';
			$string .= '<span style="display: inline-block; background: url('.$plugin_url.'images/heart_half-g.png) repeat-x; background-size: 9px 9px; height: 9px; width: 9px" title="'.$options['lang_damages_for'].' '.($damages*2+1).'" alt="'.$options['lang_damages_for'].' '.($damages*2+1).'"></span>';
		}
		else {
			$string .= '<span style="display: inline-block; background: url('.$plugin_url.'images/heart-g.png) repeat-x; background-size: 9px 9px; height: 9px; width: ' . (9*$damages/2) . 'px" title="'.$options['lang_damages_for'].' '.$damages.'" alt="'.$options['lang_damages_for'].' '.$damages.'"></span>';
		}

		$string .= '</div></div>';
	}

	$armor = get_post_meta($post_id, 'points_of_protection', true);
	if ($armor != '') {
		$string .= '<div class="stat"><div class="stat-name">'.$options['lang_armor'].'</div><div class="stat-value"><img src="'.$plugin_url.'/images/pop'.$armor.'.png" title="'.$armor.' '.$options['lang_armor'].'" alt="'.$armor.' '.$options['lang_armor'].'"></div></div>';
	}

	$durab = get_post_meta($post_id, 'durability', true);
	if ($durab != '') {
		$string .= '<div class="stat"><div class="stat-name">'.$options['lang_durability'].'</div><div class="stat-value">'.$durab.'</div></div>';
	}

	$hunger_restoration = get_post_meta($post_id, 'hunger_restoration', true);
	if ($hunger_restoration != '') {
		$string .= '<br /><span class="stat-name">'.$options['lang_hunger_rest'].'</div><div class="stat-value"><span style="display: inline-block; background: url('.$plugin_url.'images/hung1.png) repeat-x; height: 18px; width: ' . (18*$hunger_restoration) . 'px" title="'.$hunger_restoration.' '.$options['lang_hunger_rest'].'" alt="'.$hunger_restoration.' '.$options['lang_hunger_rest'].'"></span></div></div>';
	}

	$stackable = get_post_meta($post_id, 'stackable', true);
	if ($stackable != '') {
		if ($stackable > 1) {
			$string .= '<div class="stat"><div class="stat-name">'.$options['lang_stackable'].'</div><div class="stat-value">'.$options['lang_yes'].' <small>('.$stackable.')</small></div></div>';
		} else {
			$string .= '<div class="stat"><div class="stat-name">'.$options['lang_stackable'].'</div><div class="stat-value">'.$options['lang_no'].'</div></div>';
		}
	}
	$string .= '</td>';
	$string .= '</tr>';
	$string .= '</table>';
	return $string;
}

add_shortcode('mcitem-sources','mcsources_table');
function mcsources_table() {
	global $plugin_url, $post;
	$post_id = $post->ID;
	$options = get_option('almc_options');
	$string = '';
	$sources = get_post_meta($post_id, 'sources', true);
	if (is_array($sources) && count($sources) > 0 && $sources[0] != '') {
		$string .= '<table style="float: '.$options['source_float'].'" id="source-table"><tr><td><span class="source-title">'.$options['lang_sources'].':</span><br />';
		foreach ($sources As $v) {
			if (is_numeric($v)) {
				$string .= '<a style="margin-bottom: 5px;" class="sourcelink" href="'.get_permalink($v).'" title="'.get_the_title($v).'" alt="'.get_the_title($v).'">'.get_the_post_thumbnail($v, 'recipe-table').' '.get_the_title($v).'</a><br>';
			}
		}
		$string .= '</td></tr></table>';
	}
	return $string;
}
?>
