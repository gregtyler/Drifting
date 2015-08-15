<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * For example, it puts together the home page when no home.php file exists.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */


$post_count = get_option('posts_per_page');
get_header(); ?>

  <div id="primary" class="site-content">
    <div id="content" role="main">
    <?php if ( have_posts() ) : $i = 0; ?>
      <div class="post-wrap post-featured">
        <?php the_post(); set_query_var( 'latest', true )?>
        <?php get_template_part( 'content', 'loop' ); ?>
      </div>

      <div class="group post-panel-wrapper">
        <?php $categories = get_categories(array('type' => 'post'));
        array_unshift($categories, '');
        foreach ($categories as $category):
          $term_meta = get_option( 'taxonomy_' . $category->cat_ID );
          // Only show the index and featured categories
          if ($category === '') {
            // A dummy for the index
            $panel_loop = new WP_Query(array('showposts' => $post_count, 'offset' => 1));
            $panel_title = 'Latest posts';
          } elseif (isset($term_meta) && $term_meta['featured']) {
            // Create a loop for the category
            $panel_loop = new WP_Query(array('cat' => $category->cat_ID, 'showposts' => $post_count));
            $panel_title = '<a href="' . get_category_link($category->term_id) . '">' . $category->name . '</a>';
          } else {
            continue;
          }
        ?>

        <section class="post-panel">
          <header class="post-panel-title"><?php echo $panel_title;?></header>
          <ol class="post-panel-list">
            <?php /* Start the Loop */ ?>
            <?php while ($panel_loop->have_posts()): $panel_loop->the_post(); ?>
              <li class="post-panel-item">
                <?php get_template_part( 'content', 'mini' ); ?>
              </li>
            <?php endwhile; ?>
          </ol>
        </section>

        <?php
        endforeach;?>
      </div>

    <?php else : ?>

      <article id="post-0" class="post no-results not-found">
        <header class="entry-header">
          <h1 class="entry-title"><?php _e( 'Nothing Found', 'twentytwelve' ); ?></h1>
        </header>

        <div class="entry-content">
          <p><?php _e( 'Apologies, but no results were found. Perhaps searching will help find a related post.', 'twentytwelve' ); ?></p>
          <?php get_search_form(); ?>
        </div><!-- .entry-content -->

      </article><!-- #post-0 -->

    <?php endif; // end have_posts() check ?>

    </div><!-- #content -->
  </div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>