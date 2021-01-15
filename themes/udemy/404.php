<?php get_header(); ?>

    <!-- Page Title ============================================= -->
    <section id="page-title">
        <div class="container clearfix">
            <h1><?php _e('Page Not Found', 'udemy'); ?></h1>
        </div>
    </section><!-- #page-title end -->

    <!-- Content ============================================= -->
    <section id="content">

        <div class="content-wrap">

            <div class="container clearfix">

                <div class="col_half nobottommargin">
                    <div class="error404 center">404<?php //_e('404', 'udemy'); ?></div>
                </div>

                <div class="col_half nobottommargin col_last">

                    <div class="heading-block nobottomborder">
                        <h4><?php _e('Ooopps! The Page you were looking for, couldn\'t be found.', 'udemy'); ?></h4>
                        <span><?php _e('Try searching for the best match or browse the links below:', 'udemy'); ?></span>
                    </div>
                    <?php get_search_form(); ?>
                    <!-- <form action="#" method="get" role="form" class="nobottommargin">
                        <div class="input-group input-group-lg">
                            <input type="text" class="form-control"
                                placeholder="<?php _e('Search for Pages...', 'udemy') ?>">
                            <span class="input-group-btn"><button class="btn btn-danger" type="button"><i class="icon-search"></i></button></span>
                        </div>
                    </form> -->

                </div>

            </div>

        </div>

    </section><!-- #content end -->

<?php get_footer(); ?>