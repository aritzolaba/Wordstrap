<?php
/**
 * The template for displaying search forms in Wordstrap
 */
?>
<div class="row-fluid">
    <div class="span12">

        <form class="form-search" method="post" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
            <div class="input-append">
                <input type="text" style="width: 65%;" name="s" id="s" placeholder="<?php _e('Search', 'wordstrap'); ?>" />
                <button style="margin-left: -4px;" id="searchsubmit" type="submit" class="btn btn-inverse"><i class="icon-search ws-search-icon"></i></button>
            </div>
        </form>

    </div>
</div>