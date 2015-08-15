<?php
/**
 * Posts as displayed on the front page of the site
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

// Add the thumbnail if there is one
$class = 'post-panel-post';
if (has_post_thumbnail()) {
  $thumbnail_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large' );
  $thumbnail_url = $thumbnail_url[0];
  $class .= ' post-panel-post--thumbnail';
}

// Always stop after 5 posts
if ($wp_query->current_post >= 5) {
  wp_reset_query();
}
?>

  <article id="post-<?php the_ID(); ?>" <?php post_class($class); ?> itemscope itemtype="http://schema.org/Article">
    <?php if($thumbnail_url):?>
      <div class="entry-thumbnail" style="background-image:url('<?php echo $thumbnail_url;?>');"></div>
    <?php endif;?>

    <header class="entry-header">
      <h1 class="entry-title"><?php the_title(); ?></h1>
    </header>
    <div class="entry-byline">
      <?php twentytwelve_entry_meta(); ?>
      <?php edit_post_link( __( 'Edit', 'twentytwelve' ), '| <span class="edit-link">', '</span>' ); ?>
    </div>
    <div class="entry-categories">
      <?php echo get_the_category_list( ' ' ); ?>
    </div>

    <?php if ( comments_open() && get_the_post_thumbnail() && get_comments_number() ) : ?>
    <div class="comments-link">
      <?php comments_popup_link( '<span class="leave-reply">' . __( 'Leave a reply', 'twentytwelve' ) . '</span>', __( '1 Reply', 'twentytwelve' ), __( '% Replies', 'twentytwelve' ) ); ?>
    </div>
    <?php endif; ?>
    <a href="<?php the_permalink(); ?>" class="post-panel-post-link"></a>
  </article>
