<?php
/**
 * The index template file.
 *
 * @package WordStrap
 * @subpackage Partials
 * @since Wordstrap 1.6
 */
?>

<?php
// Get Theme Options
$wordstrap_theme_options = get_option('wordstrap_theme_options');
// Check the use of ws-auth
if ($wordstrap_theme_options['auth_system'] == 1) ws_auth();
?>

<?php get_header(); ?>

<?php get_template_part( 'partials/part_landing' ); ?>

<?php get_footer(); ?>
