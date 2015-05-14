<?php 
if ( get_query_var('paged') ) {
   $paged = get_query_var('paged');
} else if ( get_query_var('page') ) {
   $paged = get_query_var('page');
} else {
   $paged = 1;
}
$blog_args = array(
  'post_type' => 'post',
  'paged' => $paged
);
$blog_query = new WP_Query( $blog_args ); ?>
<?php if ( $blog_query->have_posts() ) : ?>
   
<?php while ( $blog_query->have_posts() ) : $blog_query->the_post(); ?>

    <div class="post">
    <h4 class="media-heading"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
    <?php if (has_post_thumbnail()) : ?>
    <p><a href="<?php the_permalink(); ?>"><?php echo get_the_post_thumbnail( $post_id, 'full', array( 'class' => 'img-responsive img-blog' ) ); ?></a></p>
    <?php else : ?>
    <p><a href="<?php the_permalink(); ?>"><img src="<?php bloginfo('template_url'); ?>/inc/img/logo.png" class="img-responsive img-blog"></a></p>
    <?php endif; ?>

    <p><span class="small"><i class="fa fa-file-o"></i> <?php the_category( ', ' ); ?> <i class="fa fa-clock-o"></i> <?php the_time('F jS, Y'); ?> <i class="fa fa-eye"></i> <?php echo do_shortcode('[post_view]'); ?></span></p>
    </div>

<?php endwhile; ?>

<?php
if ( function_exists('opstshirts_pagination') ) {
  opstshirts_pagination($blog_query);
}
?>

<?php else : ?>

  
  <p><?php _e('Sorry, no posts matched your criteria.'); ?></p>  
<?php wp_reset_postdata(); ?>
<?php endif; ?>
