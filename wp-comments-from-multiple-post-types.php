<?php
/*
Plugin Name: WP Comments From Mulitple Post Types  
Plugin URI:  https://github.com/birgire/wp-comments-from-mulitple-post-types.git
Description: Support for multiple post types for comments with WP_Comments_Query() / get_comments()
Version:     0.1
Author:      birgire
Author URI:  http://profiles.wordpress.org/birgire
License:     GPLv2
*/

/**
 * No direct access
 */
defined( 'ABSPATH' ) or die( 'Nothing here!' );

/**
 * Include the class:
 */
if( ! class_exists( 'WP_Comments_From_Multiple_Post_Types' ) )
	require_once plugin_dir_path( __FILE__ )."inc/class.comments_from_mulitple_post_types.php";        

/**
 * Activate the class:
 */
add_action( 'plugins_loaded', array( 'WP_Comments_From_Multiple_Post_Types', 'get_instance' ) );

