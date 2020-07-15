<?php
    $settings = $this->get_settings();
?>

    <div class="wkfe-search">
        <div id="wkfe-search-<?php echo $this->get_id(); ?>" class="wkfe-search-wrapper wkfe-search-<?php echo $this->get_id(); ?>">
            <span class="click-handler"> <i class="fa fa-search"></i> </span>
            <div class="wkfe-search-form-wrapper">
                <form action="<?php echo home_url( '/' ); ?>" method="get">
                    <label class="screen-reader-text" for="search">Search in <?php echo home_url( '/' ); ?></label>
                    <input type="text" name="s" id="search" value="<?php the_search_query(); ?>" />
                    <input type="submit" id="searchsubmit" value="<?php echo esc_attr__( 'Search' ) ?>" />
                </form>
            </div>
        </div>
    </div><!-- animation-text -->

    <script type="text/javascript">
        jQuery(function($){
            if(!$('body').hasClass('wkfe-search')){
                $('body').addClass('wkfe-search');
            }
        });

    </script>