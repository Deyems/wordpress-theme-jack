<?php get_header(); ?>
    <!-- Content
    ============================================= -->
    <section id="content">

      <div class="content-wrap">

        <?php
            if(!is_single() 
            && is_home() 
            && function_exists( 'wpp_get_mostpopular' )
            && get_theme_mod( 'ju_show_header_popular_post' )
            ){
                
                $args = array(
                    'wpp_start' => '<div class="section header-stick bottommargin-lg clearfix" style="padding: 20px 0;">
                                        <div>
                                            <div class="container clearfix">
                                                <span class="badge badge-danger bnews-title">'. get_theme_mod('ju_popular_posts_widget_title') . '</span>
                                                    <div class="fslider bnews-slider nobottommargin" data-speed="800" data-pause="6000" data-arrows="false" data-pagi="false">
                                                        <div class="flexslider">
                                                            <div class="slider-wrap">',
                    'wpp_end' =>                    '</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>',
                    'post_html' => '<div class="slide"><a href="{url}"><strong>{text_title}</strong></a></div>',
                );
                
                wpp_get_mostpopular($args);

        ?>

        <?php
            }
        ?>
    
        <div class="container clearfix">

          <!-- Post Content
          ============================================= -->
          <div class="postcontent nobottommargin clearfix">

            <!-- Posts
            ============================================= -->
            <div id="posts">
                <?php
                    if(have_posts()){
                        while(have_posts()){
                            the_post();
                            get_template_part('partials/post/content', 'excerpt');
                ?>
                    <?php
                        // the_content();
                    ?>
                <?php
                        }
                    }
                ?>

            </div><!-- #posts end -->

            <!-- Pagination
            ============================================= -->
            <div class="row mb-3">
                <div class="col-12">
                    <?php next_posts_link( '&larr; Older' ); ?>
                    <?php previous_posts_link( 'Newer &rarr;' ); ?>
                </div>
            </div>
            <!-- .pager end -->

          </div><!-- .postcontent end -->

          <?php get_sidebar(); ?>

        </div>

      </div>

    </section><!-- #content end -->

<?php get_footer(); ?>