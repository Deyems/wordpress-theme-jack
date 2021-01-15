<?php get_header(); ?>
    <?php while(have_posts()){ 
        the_post();    
    ?>
        <!-- Page Title ============================================= -->
        <section id="page-title">
            <div class="container clearfix">
                <h1><?php the_title(); ?></h1>
                <span>
                    <?php 
                        if(function_exists('the_subtitle')){
                            the_subtitle();
                        }
                    ?>
                </span>
            </div>
        </section><!-- #page-title end -->
    <?php
        }
        rewind_posts();
    ?>
    <!-- Content ============================================= -->
    <section id="content">

        <div class="content-wrap">

            <div class="container clearfix">

                <!-- Post Content ============================================= -->
                <div class="postcontent nobottommargin clearfix">
                    <?php //if(have_posts()){
                            while(have_posts()){
                                the_post();
                                global $post;
                                $author_ID = $post->post_author;
                                $author_URL = get_author_posts_url($author_ID);
                            ?>
                            <div class="single-post nobottommargin">
        
                                <!-- Single Post ============================================= -->
                                <div class="entry clearfix">
        
                                   
        
                                    <!-- Entry Image ============================================= -->
                                    <div class="entry-image">
                                        <?php if(has_post_thumbnail()){ ?>
                                                <a href="<?php the_permalink(); ?>">
                                                    <?php 
                                                        the_post_thumbnail( 'full' );
                                                    ?>
                                                </a>
                                        <?php } ?>
                                    </div><!-- .entry-image end -->
        
                                    <!-- Entry Content ============================================= -->
                                    <div class="entry-content notopmargin">
        
                                        <!-- Post Single - Content End -->
                                        <?php the_excerpt();

                                            $defaults = array(
                                                'before' => '<p class="text-center">' . __( 'Pages:', 'udemy' ),
                                                'after' => '</p>',
                                            );

                                            wp_link_pages( $defaults );
                                        ?>
        
                                        <div class="clear"></div>
        
                                    </div>
                                </div><!-- .entry end -->
        
                                    <?php
                                        if(comments_open() || get_comments_number()) {
                                            comments_template();
                                        }
                                    ?>
        
                            </div>
                    <?php
                            }
                        // }
                    ?>

                </div><!-- .postcontent end -->

                <?php get_sidebar(); ?>

            </div>

        </div>

    </section><!-- #content end -->

<?php get_footer(); ?>