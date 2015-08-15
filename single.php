<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
 
$mega_style = get_metadata('post',$post->ID,'gregtyler_post_style',true);
$mega_id = get_metadata('post',$post->ID,'gregtyler_mega',true);
if( $mega_id ) {
    $mega = wp_get_attachment_image_src( $mega_id, array(9999, 9999) );
    $mega_src = $mega[0];
}

if( strpos($mega_style,'{mega}')!==FALSE ) {
    $mega_style = str_replace( '{mega}', "url('" . htmlentities($mega_src) . "')", $mega_style );
} else {
    $mega_style = $mega_style . "background-image:url('" . htmlentities($mega_src) . "');";
}

get_header(); ?>

	<div id="primary" class="primary-single site-content<?php echo $mega_id && !get_metadata('post',$post->ID,'gregtyler_feature',true)?' primary-bg'.(get_metadata('post',$post->ID,'gregtyler_mega_lame',true)?'':' primary-bg-mega'):''; ?>" style="<?php echo $mega_style;?>">
		<div id="content" class="content-single" role="main">
            
			<?php while ( have_posts() ) : the_post(); ?>
                <?php get_template_part( 'content', get_metadata('post',$post->ID,'gregtyler_feature',true)?'feature':get_post_format() ); ?>
                
				<nav class="navigation nav-single group">
					<h3 class="assistive-text"><?php _e( 'Post navigation', 'twentytwelve' ); ?></h3>
					<span class="nav-previous"><?php previous_post_link( '%link', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'twentytwelve' ) . '</span> %title' ); ?></span>
					<span class="nav-next"><?php next_post_link( '%link', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'twentytwelve' ) . '</span>' ); ?></span>
				</nav><!-- .nav-single -->
                
                <div class="post-wrap post-wrap-multi post-wrap-promos group">
                <h2>Read more...</h2>
                <?php
                /* Add some tile for other posts that might be of interest! */
                $query = array('post__not_in' => array(get_the_id()), 'posts_per_page' => 2, 'orderby' => 'rand', order => 'DESC' );
                // In Christmas mode!
                if( has_category( 17 ) )
                    $query['cat'] = 17;
                $subloop = new WP_Query( $query );
                $counter = 0;
                while ( $subloop->have_posts() && $counter < 2 ): $subloop->the_post(); $counter++;
                    $promos = true;
                    include(locate_template('content-loop.php'));
                endwhile;
                wp_reset_postdata();
                wp_reset_query();
                ?>
                </div>

                <div class="comment-wrap">
                    <?php comments_template(); ?>
                </div>
                
			<?php endwhile; // end of the loop. ?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer(); ?>