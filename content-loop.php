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
      <?php if ($latest && is_home()): ?>
      <div class="latest-post" title="<?php _e( 'Latest post', 'twentytwelve' ); ?>">
        <?php _e( 'Latest post', 'twentytwelve' ); ?>
      </div>
      <?php endif; ?>
      <header class="entry-header">
    <?php if( get_the_post_thumbnail( get_the_ID() ) ):?>
    <div class="entry-thumbnail"><a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'post-thumbnail', array('itemprop'=>'image') ); ?></a></div>
    <?php endif;?>

      <?php if ( is_single() && !$promos ) : ?>
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

    <?php if(!$promos):?>
    <div class="entry-summary">
      <?php the_excerpt(); ?>
    </div>
    <?php endif;?>

    <?php if ( comments_open() && get_the_post_thumbnail() && get_comments_number() ) : ?>
      <div class="comments-link">
        <?php comments_popup_link( '<span class="leave-reply">' . __( 'Leave a reply', 'twentytwelve' ) . '</span>', __( '1 Reply', 'twentytwelve' ), __( '% Replies', 'twentytwelve' ) ); ?>
      </div><!-- .comments-link -->
    <?php endif; // comments_open() ?>

    <?php if( $wp_query->current_post < 1 && !$promos ): ?>
    <footer class="entry-meta">
      <?php echo get_the_category_list( ' ' ); ?>
    </footer><!-- .entry-meta -->
    <?php endif; ?>
  </article><!-- #post -->
