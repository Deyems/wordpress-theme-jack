<?php get_header(); ?>
    <!-- Post Content ============================================= -->
    <?php 
        while(have_posts()){
            the_post();
            the_content();
        }
    ?>
<?php get_footer(); ?>