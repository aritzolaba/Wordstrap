<?php
/**
 * The slideshow template partial.
 *
 * @package WordStrap
 * @subpackage Partials
 * @since Wordstrap 1.6
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {echo '<h1>Forbidden</h1>'; exit();}

// Slideshow frames
$frames = array (
    'Theme options page' => array (get_stylesheet_directory_uri().'/inc/slide/ws_1.png', 'active', 'Customize every element of your site, select the layout, customize your home page, etc.'),
    'In-theme auth system' => array (get_stylesheet_directory_uri().'/inc/slide/ws_2.png', '', 'You can display all auth features right in the navbar, or in the right or left sidebars if you prefer so.'),
    'Detailed post headers' => array (get_stylesheet_directory_uri().'/inc/slide/ws_3.png', '', 'Post headers display detailed info about every post in the blog. Also, social share buttons are included at the bottom of every post. Of course, you can disable this feature.'),
    'A neat comment system' => array (get_stylesheet_directory_uri().'/inc/slide/ws_4.png', '', 'The comment template is located at the functions.php file, so you can customize it at your needs.')
);
?>

<div id="slideshow" class="carousel slide">
    <div class="carousel-inner">
        <?php foreach ($frames as $frame_caption => $frame_att) : ?>

            <div class="item <?php echo $frame_att[1]; ?>">
                <img src="<?php echo $frame_att[0]; ?>" alt=""/>
                <div class="carousel-caption">
                    <h4><?php echo $frame_caption; ?></h4>
                    <p><?php echo $frame_att[2]; ?></p>
                </div>
            </div>

        <?php endforeach; ?>
    </div>
    <a class="left carousel-control" href="#slideshow" data-slide="prev">&laquo;</a>
    <a class="right carousel-control" href="#slideshow" data-slide="next">&raquo;</a>
</div>