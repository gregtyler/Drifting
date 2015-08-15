<?php
/**
 * The default template for displaying content. Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(!is_single()?'post-tile':''); ?> itemscope itemtype="http://schema.org/Article">
		<?php if ( is_sticky() && is_home() && ! is_paged() ) : ?>
		<div class="featured-post" title="<?php _e( 'Featured post', 'twentytwelve' ); ?>">
            <?php _e( 'Featured post', 'twentytwelve' ); ?>
		</div>
		<?php endif; ?>
		<header class="entry-header">
            <?php if( get_metadata('post',get_the_id(),'gregtyler_featured_banner',true) ): ?>
            <div class="entry-thumbnail"><a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'banner', array('itemprop'=>'image') ); ?></a></div>
            <?php endif; ?>
            <?php if ( comments_open() && get_the_post_thumbnail() && get_comments_number() ) : ?>
				<div class="comments-link">
					<?php comments_popup_link( '<span class="leave-reply">' . __( 'Leave a reply', 'twentytwelve' ) . '</span>', __( '1 Reply', 'twentytwelve' ), __( '% Replies', 'twentytwelve' ) ); ?>
				</div><!-- .comments-link -->
			<?php endif; // comments_open() ?>
            
			<?php if ( is_single() ) : ?>
			<h1 class="entry-title" itemprop="name"><?php the_title(); ?></h1>
			<?php else : ?>
			<h1 class="entry-title">
				<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
			</h1>
			<?php endif; // is_single() ?>
            <div class="entry-byline">
                <?php twentytwelve_entry_meta(); ?>
                <?php edit_post_link( __( 'Edit', 'twentytwelve' ), '| <span class="edit-link">', '</span>' ); ?>
            </div>
		</header><!-- .entry-header -->
        
		<?php if ( is_search() ) : // Only display Excerpts for Search ?>
		<div class="entry-summary">
			<?php the_excerpt(); ?>
		</div><!-- .entry-summary -->
        <?php elseif( is_home() ) : ?>
        <?php if( $wp_query->current_post < 2 || 1 ): ?>
        <div class="entry-summary">
			<?php the_excerpt(); ?>
		</div><!-- .entry-summary -->
        <?php endif; ?>
		<?php else : ?>
		<div class="entry-content" itemprop=articleBody>
            <?php if( get_metadata('post',$post->ID,'gregtyler_toc',true) ): ?>
                <div class=toc>
                    <strong>Contents</strong>
                    <ol></ol>
                </div>
            <?php endif; ?>
			<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'twentytwelve' ) ); ?>
			<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'twentytwelve' ), 'after' => '</div>' ) ); ?>
		</div><!-- .entry-content -->
		<?php endif; ?>
	</article><!-- #post -->
