<?php
/*
	Plugin Name: Minecraft Item Library
	Plugin URI: http://www.alieneila.net
	Description: Adds functionality for minecraft recipe and item library system
	Author: Joshua Segatto
	Author URI: http://www.alieneila.net/

	Version: 1.1

	License: GNU General Public License v2.0 (or later)
	License URI: http://www.opensource.org/licenses/gpl-license.php
*/

/*
To Do
Block/Item ID
Attack Strength
Health
Cookable
Source
*/

$plugin_path = plugin_dir_path(__FILE__);
$plugin_url = plugin_dir_url(__FILE__);

add_theme_support( 'post-thumbnails', array( 'minecraft-item' ) );
add_image_size( 'recipe-table', 50, 50, true );

add_action( 'wp_enqueue_scripts', 'almc_add_my_stylesheet' );

function almc_add_my_stylesheet() {
	wp_register_style( 'almc-style', plugins_url('css/style.css', __FILE__) );
	wp_enqueue_style( 'almc-style' );
	
	if (file_exists($plugin_path.'css/custom.css')) {
		wp_register_style( 'alt-almc-style', plugins_url('css/custom.css', __FILE__) );
		wp_enqueue_style( 'alt-almc-style' );
	}
}

include_once($plugin_path.'lib/mciteminit.php');
include_once($plugin_path.'lib/mcitemboxes.php');
include_once($plugin_path.'lib/mcitemtables.php');
include_once($plugin_path.'admin/mcitemadmin.php');

function wpse12814_posts_orderby( $orderby ) {

	global $wpdb;

    $orderby = $wpdb->prefix.'postmeta.meta_value DESC, '.$orderby.'';

    return $orderby;

}

function alien_flush_perma() {
    am_cpt_init();
    flush_rewrite_rules();
	
	$default_terms = array(
						'Craftable' 			=> false,
						'Crafting Station'		=> false,
						'Material'				=> false,
						'Source'				=> false,
						'Item Library'			=> false,
						'Raw Materials'			=> 'Item Library',
						'Food'					=> 'Item Library',
						'Potions'				=> 'Item Library',
						'Plants'				=> 'Item Library',
						'Wool Dyes'				=> 'Item Library',
						'Tools'					=> 'Item Library',
						'Weapons'				=> 'Item Library',
						'Armor'					=> 'Item Library',
						'Vehicles'				=> 'Item Library',
						'Decorations'			=> 'Item Library',
						'Natural Blocks'		=> 'Item Library',
						'Building Blocks'		=> 'Item Library',
						'Manufactured Blocks'	=> 'Item Library',
						'Utility'				=> 'Item Library',
						'Mechanisms'			=> 'Item Library',
						'Ores'					=> 'Item Library',
						'The Nether'			=> 'Item Library',
						'Crafting Station'		=> 'Item Library',
						'Fuel'					=> 'Item Library',
						'Gems'					=> 'Item Library',
						'Metals'				=> 'Item Library',
						'Switches'				=> 'Item Library',
						'Critters'				=> 'Item Library',
						'Monsters'				=> 'Item Library',
						'taxonomies'				=> array('post_tag')
					);
	
	foreach ($default_terms As $k => $v) {
		if (!term_exists($k, 'mctype')) {
			if ($v) {
				$parent_term = term_exists( $v, 'mctype' );
				if (is_object($parent_term)) {
					$parent_term_id = $parent_term->term_id;
				}
				else if (is_array($parent_term)) {
					$parent_term_id = $parent_term['term_id'];
				}
				else {
					$parent_term_id = '';
				}
			}
			else {
				$parent_term_id = '';
			}
			wp_insert_term(
				$k, // the term 
				'mctype', // the taxonomy
				array(
					'parent'=> $parent_term_id
				)
			);
		}
	}
	$almc_options = array(
					'lang_crafted_with' => 'Crafted With',
					'lang_req_mats' => 'Required Materials',
					'lang_block_id' => 'Block/Item ID',
					'lang_atk_str' => 'Attack Str',
					'lang_health' => 'Health',
					'lang_heals_for' => 'Heals For',
					'lang_damages_for' => 'Damages For',
					'lang_armor' => 'Armor',
					'lang_hunger_rest' => 'Hunger Restoration',
					'lang_durability' => 'Durability',
					'lang_stackable' => 'Stackable',
					'lang_yes' => 'Yes',
					'lang_no' => 'No',
					'lang_sources' => 'Sources'
					);
	add_option('almc_options', $almc_options, '', 'yes');
}
register_activation_hook( __FILE__, 'alien_flush_perma' );
?>