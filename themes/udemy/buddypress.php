<?php
get_header(); ?>
    <!-- Content ============================================= -->
    <section id="content">
        <div class="content-wrap">
            <div class="container clearfix">
                <!-- Post Content ============================================= -->
                    <?php 
                        while(have_posts()){
                            the_post();
                            the_content();
                        }
                    ?>
            </div>
        </div>
    </section><!-- #content end -->
<?php get_footer(); ?>