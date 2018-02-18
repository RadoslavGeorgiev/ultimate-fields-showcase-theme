<?php
use UF3\Container;
use UF3\Field;

/**
 * Loads modules for the theme.
 *
 * This is just a helper class, if you are here to see how Ultimate Fields
 * works, don't focus on it. If you want to build a showcase module, read it.
 */
class Module_Loader {
	/**
	 * Holds the definition of every module that is loaded.
	 *
	 * @var mixed[]
	 */
	protected $modules = array();

	/**
	 * Creates and returns an instance of the loader.
	 *
	 * @return Module_Loader
	 */
	public static function get_instance() {
		static $instance;

		if( is_null( $instance ) ) {
			$instance = new self;
		}

		return $instance;
	}

	/**
	 * Loads all modules from the database.
	 */
	private function __construct() {
		// If the plugin is not loaded, there is nothing else to load
		if( ! function_exists( 'ultimate_fields' ) ) {
			return;
		}

		/**
		 * Allow additional modules to be registered.
		 *
		 * @since 3.0
		 *
		 * @param Module_Loader $loader The loader to add modules to.
		 */
		do_action( 'showcase.load_modules', $this );

		// Load enabled modules
		$option = get_option( 'showcase_modules' );
		if( $option && is_array( $option ) ) {
			foreach( $option as $id ) {
				if( ! isset( $this->modules[ $id ] ) ) {
					continue;
				}

				require_once $this->modules[ $id ]['path'] . 'module.php';
			}
		}

		// Add hooks
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts_and_styles' ), 11 );
	}

	/**
	 * Adds a module to the theme.
	 *
	 * @since 3.0
	 *
	 * @param string $id     The ID of the module.
	 * @param array  $module {
	 *     Arguments for the module.
	 *
	 *     @param bool   $pro   Whether the module requires Ultimate Fields Pro
	 *     @param string $path  The path to the module.
	 *     @param string $url   The URL of the module.
	 * }
	 * @return Module_Loader The loader
	 */
	public function add_module( $id, $module ) {
		if(
			! isset( $module['title'] )
			|| ! isset( $module['pro'] )
			|| ! isset( $module['path'] )
			|| ! isset( $module['url'] )
			|| ! isset( $module['redirect'] )
		) {
			wp_die( 'A module needs the following attributes: title, pro, path, url and redirect!' );
		}

		$module['path'] = trailingslashit( $module['path'] );
		$module['url']  = trailingslashit( $module['url'] );
		$this->modules[ $id ] = $module;

		return $this;
	}

	/**
	 * Enqueue the styles and scripts for each module.
	 */
	public function enqueue_scripts_and_styles() {
		foreach( $this->modules as $id => $module ) {
			if( file_exists( $module['path'] . 'module.js' ) ) {
				wp_enqueue_script( $id . '-js', $module['url'] . 'module.js', array( 'jquery' ) );
			}

			if( file_exists( $module['path'] . 'module.css' ) ) {
				wp_enqueue_style( $id, $module['url'] . 'module.css' );
			}
		}
	}

	/**
	 * Add settings to the theme options page.
	 *
	 * @since 3.0
	 *
	 * @param UF3\Options_Page $page The page to control modules.
	 */
	public function register_options_container( $page ) {
		$modules = array();

		foreach( $this->modules as $id => $data ) {
			$modules[ $id ] = $data['title'];
		}

		Container::create( 'Showcase Modules' )
			->add_location( 'options', $page )
			->set_description_position( 'label' )
			->add_fields(array(
				Field::create( 'multiselect', 'showcase_modules', __( 'Modules', 'showcase' ) )
					->set_description( __( 'Select the modules you want to have enabled as a showcase.', 'showcase' ) )
					->set_input_type( 'checkbox' )
					->add_options( $modules )
			));
	}

	/**
	 * Returns all registered modules.
	 *
	 * @since 3.0
	 *
	 * @return stdClass[]
	 */
	public function get_modules() {
		return $this->modules;
	}
}
