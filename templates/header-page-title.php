<?php
$spb = false;

if ( class_exists( 'Woocommerce' ) && ( is_product() || is_woocommerce() ) ) {
	$spb = true;
}

$current_post_id = get_queried_object_id();
$page_title_tag  = ( Creativo()->settings( 'page_title_tag' ) ) ? Creativo()->settings( 'page_title_tag' ) . ' class="page-title-holder leading-normal mb-1"' : 'h2 class="page-title-holder leading-normal mb-1"';
$parallax_attr   = ( 'yes' === get_post_meta( $current_post_id, 'pyre_page_title_parallax', true ) || 'parallax' === Creativo()->settings( 'tb_bg_effect' ) ) ? 'parallax_class" data-stellar-background-ratio="0.5' : '';

if ( ( ( is_page() || ( class_exists( 'bbPress' ) && is_bbpress() ) || is_single() || is_singular( 'creativo_portfolio' ) ) ) && ! $spb ) {
	?>
	<div class="page-title-breadcrumb border-b border-gray-300 <?php echo $parallax_attr; ?>" data-ptb="<?php echo ( ( get_post_meta( $current_post_id, 'pyre_show_title', true ) == 'no' ) || ( Creativo()->settings( 'global_title_bread' ) == 1 ) ? 'off' : 'on' ); ?>" style="background-image: url('<?php echo get_the_post_thumbnail_url($current_post_id) ?>')">
		<div class="pt_mask flex items-center">
			<div class="container page-title-breadcrumb-wrap md:flex justify-between items-center mx-auto px-4 xl:px-0 py-6">
				<div class="page-title text-center md:text-left">
					<?php
					if ( get_post_meta( $current_post_id, 'pyre_page_title_custom', true ) != '' ) {
						echo '<' . $page_title_tag . '>' . get_post_meta( $current_post_id, 'pyre_page_title_custom', true ) . '</' . $page_title_tag . '>';
					} else {
						echo '<' . $page_title_tag . '>' . get_the_title() . '</' . $page_title_tag . '>';
					}

					if ( get_post_meta( $current_post_id, 'pyre_page_title_subheading', true ) ) {
						echo '<h3 class="subhead">' . get_post_meta( $current_post_id, 'pyre_page_title_subheading', true ) . '</h3>';
					}

					if ( class_exists( 'bbPress' ) && is_bbpress() ) {
						?>
						<div class="breadcrumb">
							<?php bbp_breadcrumb(); ?>
						</div>
						<?php
					} else {
						if ( function_exists( 'cr_breadcrumb' ) ) {
							?>
							<div class="breadcrumb">
								<?php cr_breadcrumb(); ?>
							</div>
							<?php
						}
					}
					?>
				</div>
				<?php
				if ( Creativo()->settings( 'header_search_form' ) ) {
					?>
					<div class="search-area w-full mt-6 md:mt-0 md:w-64">
						<div class="search-form">
							<?php creativo_searchform(); ?>
						</div>
					</div>
					<?php
				}
				?>
			</div>
		</div>
	</div>
	<?php
}

if ( is_search() && ! $spb ) {
	?>
		<div class="page-title-breadcrumb border-b border-gray-300 <?php echo $parallax_attr; ?>" data-ptb="<?php echo ( Creativo()->settings( 'global_title_bread' ) == 1 ? 'off' : 'on' ); ?>">
			<div class="pt_mask flex items-center">
				<div class="container page-title-breadcrumb-wrap md:flex justify-between items-center mx-auto px-4 xl:px-0 py-6">
					<div class="page-title text-center md:text-left">
						<?php echo '<' . $page_title_tag . '>'; ?><?php printf( __( 'Search Results for: %s', 'Creativo' ), '<span>' . get_search_query() . '</span>' ); ?><?php echo '</' . $page_title_tag . '>'; ?>
					</div>
				</div>
			</div>
		</div>
	<?php
}

if ( is_category() ) {
	?>
	<div class="page-title-breadcrumb border-b border-gray-300 <?php echo $parallax_attr; ?>" data-ptb="<?php echo ( Creativo()->settings( 'global_title_bread' ) == 1 ? 'off' : 'on' ); ?>">
		<div class="pt_mask flex items-center">
			<div class="container page-title-breadcrumb-wrap md:flex justify-between items-center mx-auto px-4 xl:px-0 py-6">
				<div class="page-title text-center md:text-left">
					<?php echo '<' . $page_title_tag . '>'; ?><?php esc_attr_e( 'Posts filed under: ', 'Creativo' ); ?><?php single_cat_title(); ?><?php echo '</' . $page_title_tag . '>'; ?>
					<?php
					if ( function_exists( 'cr_breadcrumb' ) ) :
						?>
						<div class="breadcrumb">
							<?php cr_breadcrumb(); ?>
						</div>
						<?php
					endif;
					?>
				</div>
				<?php
				if ( Creativo()->settings( 'header_search_form' ) ) {
					?>
					<div class="search-area w-full mt-6 md:mt-0 md:w-64">
						<div class="search-form">
							<?php creativo_searchform(); ?>
						</div>
					</div>
					<?php
				}
				?>
			</div>
		</div>
	</div>
	<?php
}

if ( is_tag() ) {
	?>
	<div class="page-title-breadcrumb border-b border-gray-300 <?php echo $parallax_attr; ?>" data-ptb="<?php echo ( Creativo()->settings( 'global_title_bread' ) == 1 ? 'off' : 'on' ); ?>">
		<div class="pt_mask flex items-center">
			<div class="container page-title-breadcrumb-wrap md:flex justify-between items-center mx-auto px-4 xl:px-0 py-6">
				<div class="page-title text-center md:text-left">
					<?php echo '<' . $page_title_tag . '>'; ?><?php esc_attr_e( 'Posts tagged with: ', 'Creativo' ); ?><?php single_cat_title(); ?><?php echo '</' . $page_title_tag . '>'; ?>
					<?php
					if ( function_exists( 'cr_breadcrumb' ) ) :
						?>
						<div class="breadcrumb">
							<?php cr_breadcrumb(); ?>
						</div>
						<?php
					endif;
					?>
				</div>
				<?php
				if ( Creativo()->settings( 'header_search_form' ) ) {
					?>
					<div class="search-area w-full mt-6 md:mt-0 md:w-64">
						<div class="search-form">
							<?php creativo_searchform(); ?>
						</div>
					</div>
					<?php
				}
				?>
			</div>
		</div>
	</div>
	<?php
}

if ( get_query_var( 'portfolio_category' ) ) {
	?>
	<div class="page-title-breadcrumb border-b border-gray-300 <?php echo $parallax_attr; ?>" data-ptb="<?php echo ( Creativo()->settings( 'global_title_bread' ) == 1 ? 'off' : 'on' ); ?>">
		<div class="pt_mask flex items-center">
			<div class="container page-title-breadcrumb-wrap md:flex justify-between items-center mx-auto px-4 xl:px-0 py-6">
				<div class="page-title text-center md:text-left">
					<?php echo '<' . $page_title_tag . '>'; ?><?php esc_attr_e( 'Projects filed under: ', 'Creativo' ); ?><?php single_cat_title(); ?><?php echo '</' . $page_title_tag . '>'; ?>
					<?php
					if ( function_exists( 'cr_breadcrumb' ) ) :
						?>
						<div class="breadcrumb">
							<?php cr_breadcrumb(); ?>
						</div>
						<?php
					endif;
					?>
				</div>
				<?php
				if ( Creativo()->settings( 'header_search_form' ) ) {
					?>
					<div class="search-area w-full mt-6 md:mt-0 md:w-64">
						<div class="search-form">
							<?php creativo_searchform(); ?>
						</div>
					</div>
					<?php
				}
				?>
			</div>
		</div>
	</div>
	<?php
}

if ( is_author() ) {
	if ( have_posts() ) {
		the_post();
		?>
		<div class="page-title-breadcrumb border-b border-gray-300 <?php echo $parallax_attr; ?>" data-ptb="<?php echo ( Creativo()->settings( 'global_title_bread' ) == 1 ? 'off' : 'on' ); ?>">
			<div class="pt_mask flex items-center">
				<div class="container page-title-breadcrumb-wrap md:flex justify-between items-center mx-auto px-4 xl:px-0 py-6">
					<div class="page-title text-center md:text-left">
						<?php echo '<' . $page_title_tag . '>'; ?><?php esc_attr_e( 'All posts by: ', 'Creativo' ); ?><?php echo get_the_author(); ?><?php echo '</' . $page_title_tag . '>'; ?>
					</div>
					<?php
					if ( Creativo()->settings( 'header_search_form' ) ) {
						?>
						<div class="search-area w-full mt-6 md:mt-0 md:w-64">
							<div class="search-form">
								<?php creativo_searchform(); ?>
							</div>
						</div>
						<?php
					}
					?>
				</div>
			</div>
		</div>
		<?php
		rewind_posts();
	}
	wp_reset_postdata();
}

if ( is_month() ) {
	if ( have_posts() ) {
		the_post();
		?>
		<div class="page-title-breadcrumb border-b border-gray-300 <?php echo $parallax_attr; ?>" data-ptb="<?php echo ( Creativo()->settings( 'global_title_bread' ) == 1 ? 'off' : 'on' ); ?>">
			<div class="pt_mask flex items-center">
				<div class="container page-title-breadcrumb-wrap md:flex justify-between items-center mx-auto px-4 xl:px-0 py-6">
					<div class="page-title text-center md:text-left">
						<?php echo '<' . $page_title_tag . '>'; ?><?php printf( __( 'Monthly Archives: %s', 'Creativo' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'Creativo' ) ) ); ?><?php echo '</' . $page_title_tag . '>'; ?>
					</div>
					<?php
					if ( Creativo()->settings( 'header_search_form' ) ) {
						?>
						<div class="search-area w-full mt-6 md:mt-0 md:w-64">
							<div class="search-form">
								<?php creativo_searchform(); ?>
							</div>
						</div>
						<?php
					}
					?>
				</div>
			</div>
		</div>
		<?php
		rewind_posts();
	}
	wp_reset_postdata();
}

if ( ( class_exists( 'Woocommerce' ) && is_woocommerce() ) || ( is_tax( 'product_cat' ) || is_tax( 'product_tag' ) ) ) {
	?>
	<div class="page-title-breadcrumb border-b border-gray-300 <?php echo $parallax_attr; ?>" data-ptb="<?php echo ( Creativo()->settings( 'global_title_bread' ) == 1 ? 'off' : 'on' ); ?>">
		<div class="pt_mask flex items-center">
			<div class="container page-title-breadcrumb-wrap md:flex justify-between items-center mx-auto px-4 xl:px-0 py-6">
				<div class="page-title text-center md:text-left">
					<?php echo '<' . $page_title_tag . '>'; ?>
					<?php
					if ( ! is_product() ) {
						woocommerce_page_title( true );
					} else {
						the_title();
					}
					?>
					<?php echo '</' . $page_title_tag . '>'; ?>

					<div class="breadcrumb">
						<?php
						woocommerce_breadcrumb(
							array(
								'wrap_before' => '<ul class="breadcrumbs block flex justify-center sm:justify-start flex-wrap text-xs lowercase">',
								'wrap_after'  => '</ul>',
								'before'      => '<li class="inline-block sm:block mr-2">',
								'after'       => '</li>',
								'delimiter'   => '',
								'home'        => _x( '<i class="fa fa-home"></i>', 'breadcrumb', 'woocommerce' ),
							)
						);
						?>
					</div>
				</div>
				<?php
				if ( Creativo()->settings( 'header_search_form' ) ) {
					?>
					<div class="search-area w-full mt-6 md:mt-0 md:w-64">
						<div class="search-form">
							<?php creativo_searchform(); ?>
						</div>
					</div>
					<?php
				}
				?>
			</div>
		</div>
	</div>
	<?php
}
