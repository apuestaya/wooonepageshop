<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package onepageshop
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header page-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'onepageshop' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->
	<?php edit_post_link( __( 'Edit', 'onepageshop' ), '<footer class="entry-meta"><i class="fa fa-pencil-square-o"></i><span class="edit-link">', '</span></footer>' ); ?>
</article><!-- #post-## -->
