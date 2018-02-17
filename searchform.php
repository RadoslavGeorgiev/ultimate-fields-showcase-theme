<form action="<?php echo home_url( '/' ) ?>" method="get" class="search-form">
	<input type="text" name="s" value="<?php the_search_query(); ?>" placeholder="<?php _e( 'Search...', 'showcase' ) ?>" class="search-form__field" />
	<button class="search-form__submit">
		<span class="fa fa-search"></span>
	</button>
</form>
