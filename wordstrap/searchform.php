<?php
/**
 * The template for displaying search forms in Wordstrap
 *
 * @package WordStrap
 * @subpackage Main
 * @since Wordstrap 1.6.4
 */
?>
<div class="row-fluid">
    <div class="span12">

        <form class="form-search" method="post" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
            <input type="text" class="span2 ws-search-input" name="s" id="s" placeholder="<?php _e('Search', 'wordstrap'); ?>" />
            <button type="submit" class="btn"><i class="icon-awesome-search"></i></button>
        </form>

    </div>
</div>