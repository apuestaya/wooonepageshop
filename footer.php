<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package onepageshop
 */
?>
            </div><!-- row -->
	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info container">
			<div class="row">
				<nav role="navigation" class="col-md-6">
					<?php onepageshop_footer_links(); ?>
				</nav>

				<div class="copyright col-md-6">
					<?php do_action( 'onepageshop_credits' ); ?>
					<?php echo of_get_option( 'custom_footer_text', 'onepageshop' ); ?>
					<?php do_action( 'onepageshop_footer' ); ?>
				</div>
			</div>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); 
wc_enqueue_js( "
	jQuery( '.add_to_cart_inline .qty' ).on( 'change', function() {
		var qty = jQuery( this ),
			atc = jQuery( this ).next( '.add_to_cart_button' );

			atc.attr( 'data-quantity', qty.val() );
	});
" );
?>

</body>
</html>