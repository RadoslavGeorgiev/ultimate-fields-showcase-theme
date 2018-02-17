<?php
class Showcase_Menu_Walker extends Walker_Nav_Menu {
	public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		if( 0 === $depth && 'widgets' == get_value( 'sub_menu_type', $item->ID ) ) {
			$args->after = $this->render_sidebar( get_value( 'menu_sidebar', $item->ID ) );
			$item->classes[] = 'has-mega-menu';
		} else {
			$args->after = '';
		}

		return parent::start_el( $output, $item, $depth, $args, $id );
	}

	protected function render_sidebar( $id ) {
		ob_start();
		dynamic_sidebar( $id );
		$sidebar = ob_get_clean();

		return "<div class='section mega-menu'>
			<div class='section__center mega-menu__center'>
				$sidebar
			</div>
		</div>";
	}
}
