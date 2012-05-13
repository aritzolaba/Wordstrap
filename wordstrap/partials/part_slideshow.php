<?php
/**
 * The slideshow template partial.
 *
 * @package WordStrap
 * @subpackage Partials
 * @since Wordstrap 1.5
 */
?>

<?php
$frames = array (
    '&quot;The Shell&quot; by Garry' => array (get_stylesheet_directory_uri().'/inc/slide/01.jpg', 'active', 'This is the content for frame 1'),
    '&quot;Skyline&quot; by Wolfgang Staudt' => array (get_stylesheet_directory_uri().'/inc/slide/02.jpg', '', 'This is the content for frame 2'),
    '&quot;Where Troubles Melt Like Lemondrops&quot; by Thomas Hawk' => array (get_stylesheet_directory_uri().'/inc/slide/03.jpg', '', 'This is the content for frame 3')
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