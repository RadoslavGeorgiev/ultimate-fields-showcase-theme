<?php get_header() ?>

<?php if( ! apply_filters( 'showcase.content', false ) ): ?>
<div class="main">
	<div class="center">
			<?php if ( function_exists('yoast_breadcrumb') ): ?>
			<div class="breadcrumbs">
				<?php yoast_breadcrumb( '<p id="breadcrumbs">', '</p>' ) ?>
			</div>
			<?php endif ?>

			get_template_part( 'loop' );
	</div>
</div>
<?php endif ?>

<?php get_footer() ?>
