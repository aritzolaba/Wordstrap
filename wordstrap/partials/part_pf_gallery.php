<?php
/**
 * The article gallery template partial.
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {echo '<h1>Forbidden</h1>'; exit();}

$images = get_children( array(
    'post_parent' => $post->ID,
    'post_type' => 'attachment',
    'post_mime_type' => 'image',
    'numberposts' => 500,
    'orderby' => 'menu_order',
    'order' => 'ASC'
));

if ( $images ) : ?>

    <div class="clearfix"></div>

    <br />

    <div class="row-fluid">
        <div class="span12">
            <div id="slideshow" class="carousel slide">
                <div class="carousel-inner">

                <?php
                $i=0;
                foreach ($images as $image) :
                    $i++;
                    ?>

                    <div class="item <?php if ($i==1) echo 'active'; ?>" style="text-align: center;">
                        <a class="thickbox" href="<?php echo $image->guid; ?>" title="<?php echo get_the_title($image->ID); ?>">
                            <img src="<?php echo $image->guid; ?>" alt="<?php echo get_the_title($image->ID); ?>"/>
                        </a>
                        <div class="carousel-caption">
                            <h4><?php echo get_the_title($image->ID); ?></h4>
                            <br />
                        </div>
                    </div>

                <?php endforeach; ?>

                </div>
                <a class="left carousel-control ws-carousel-but-left" href="#slideshow" data-slide="prev"><i class="icon-awesome-circle-arrow-left"></i></a>
                <a class="right carousel-control ws-carousel-but-right" href="#slideshow" data-slide="next"><i class="icon-awesome-circle-arrow-right"></i></a>
            </div>
        </div>
    </div>

<?php endif; ?>