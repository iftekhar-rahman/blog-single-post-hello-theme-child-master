<?php
/**
 * The template for displaying singular post-types: posts, pages and user-defined custom post types.
 *
 * @package HelloElementor
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

while ( have_posts() ) :
	the_post();
	?>

<style>



</style>

<main id="content" <?php post_class( 'site-main' ); ?> role="main">
	<div class="posts-wrapper">
		<div class="posts-left-content">


			<div class="category">
				<span>
				<?php
				$categories = get_the_category();
				if ( ! empty( $categories ) ) {
					echo esc_html( $categories[0]->name );	
				}
				?>
				</span>
			</div>

			<h1 class="post-title"><?php the_title(  ); ?></h1>

			<div class="blog-meta">
				<p><strong><?php echo get_the_author(); ?></strong> | <?php echo get_the_date(); ?></p>
			</div>

			<?php if (has_post_thumbnail( ) ): ?>
			<div class="post-thumb">
				<?php the_post_thumbnail('full'); ?>
			</div>
			<?php endif; ?>

			<div class="page-content">
				<?php the_content(); ?>
			</div>

			<?php print elementor_child_get_tags();?>

			<?php comments_template(); ?>

			
			<div class="post-next-prev">
				<?php if(get_previous_post_link(  )): ?>
				<div class="post-prev">
					<?php print esc_html__( 'Prev Post', 'hello-elementor-child' ); ?>
					<h4><?php print get_previous_post_link( '%link', '%title' ); ?></h4>
				</div>
				<?php endif; ?>

				<?php if(get_next_post_link(  )): ?>
				<div class="post-next">
					<?php print esc_html__( 'Next Post', 'hello-elementor-child' ); ?>
					<h4><?php print get_next_post_link( '%link', '%title' ); ?></h4>
				</div>
				<?php endif; ?>
			</div>
		</div>
		<div class="posts-sidebar">
		
			<?php if ( is_active_sidebar( 'blog-sidebar' ) ) : ?>
				<?php dynamic_sidebar( 'blog-sidebar' ); ?>
			<?php endif; ?>

			<div class="recent-posts">
				<h2><?php echo esc_html__('Recent Posts', 'hello-elementor-child'); ?></h2>
				<div class="recent-posts-wrap">
					<?php
						// The Query
						$args = array(
							'post_type' => 'post',
							'posts_per_page'      => 6,
							'orderby' => 'DESC',
							'order'   =>  'date',
						);
						$the_query = new \WP_Query( $args );
						// The Loop
						if ( $the_query->have_posts() ) {
							while ( $the_query->have_posts() ) {
								$the_query->the_post();
								
								?>
								<article id="post-<?php the_ID();?>" <?php post_class( 'post-item' );?>>
									<?php if( has_post_thumbnail(  ) ): ?>
									<a href="<?php the_permalink(  ); ?>" class="blog-thumb-wrap">
										<?php the_post_thumbnail('thumbnail'); ?>
									</a>
									<?php endif; ?>

									<h3>
									<a href="<?php the_permalink(  ); ?>">
										<?php echo wp_trim_words( get_the_title(), 8, '' ); ?>
									</a>
								</h3>
								</article>
								<?php
							}
						}
						wp_reset_postdata();
					?>
				</div>
			</div>
		</div>
	</div>
</main>

	<?php
endwhile;
