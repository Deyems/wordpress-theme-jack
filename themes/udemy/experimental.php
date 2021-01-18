<?php 
/* 
 * Template Name: Experimental Page
*/

get_header(); ?>
    <!-- Page Title ============================================= -->
    <section id="page-title">
        <div class="container clearfix">
            <h1>Expermintal Code</h1>
        </div>
    </section><!-- #page-title end -->
    
    <!-- Content ============================================= -->
    <section id="content">

        <div class="content-wrap">

            <div class="container clearfix">
                <?php
                    // echo wp_login_url();
                    // wp_loginout();
                    // echo "<br />";
                    // wp_login_form();
                    // echo "<br />";
                    // wp_register_form();
                    // single_term_title();
                    // echo get_archives_link(get_post_title());
                    single_cat_title();
                ?>
            </div>

        </div>

    </section><!-- #content end -->

<?php get_footer(); ?>