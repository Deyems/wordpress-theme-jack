<?php get_header(); ?>
    <section id="page-title">
        <div class="container clearfix">
            <h1><?php the_archive_title(); ?></h1>
            <span>
                <?php 
                    if(is_year()){
                        ?>
                        You are viewing Year archive
                        <?php
                    }else if(is_month()){
                        ?>
                        You are viewing Month Archive
                        <?php
                    }elseif (is_day()) {
                        ?>
                        You are viewing Day Archive
                        <?php
                        
                    }
                ?>
            </span>
        </div>
    </section><!-- #page-title end -->

    <!-- Content ============================================= -->
    <section id="content">

      <div class="content-wrap">

        <div class="container clearfix">

          <!-- Post Content ============================================= -->
          <div class="postcontent nobottommargin clearfix">

            <!-- Posts ============================================= -->
            <div id="posts">
                <?php
                    if(have_posts()){
                        while(have_posts()){
                            the_post();
                            get_template_part('partials/post/content', 'excerpt');
                ?>
                    <?php the_excerpt() ?>
                <?php
                        }
                    }
                ?>

            </div><!-- #posts end -->

            <!-- Pagination ============================================= -->
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