<?php
use Ultimate_Fields\Container;
use Ultimate_Fields\Field;

/**
 * Module name: Team
 *
 * @package Ultimate Fields: Showcase Theme
 * @see readme.md for details
 */

/**
 * Add a virtual page template.
 *
 * @param array $templates Array of page templates. Keys are filenames, values are translated names.
 * @return string[]
 */
add_filter( 'theme_page_templates', 'showcase_add_team_template', 10, 4 );
function showcase_add_team_template( $templates ) {
    $templates[ 'team' ] = __( 'Team', 'showcase' );
    return $templates;
}

/**
 * Add the necessary fields for the team.
 */
add_action( 'uf.init', 'showcase_add_team_fields' );
function showcase_add_team_fields() {
    // If the "Content Blocks" module is enabled, hide its fields for the team page.
    foreach( Container::get_registered() as $container ) {
        if( 'page-content' == $container->get_id() ) {
            foreach( $container->get_locations() as $location ) {
                $location->templates = '-team';
            }
        }
    }

    // Create the new container
    Container::create( 'team' )
        ->add_location( 'post_type', 'page', array(
            'templates' => 'team'
        ))
        ->add_fields(array(
            Field::create( 'repeater', 'team' )
                ->add_group( 'department', array(
                    'fields' => array(
                        Field::create( 'text', 'name' )
                    )
                ))
                ->add_group( 'member', array(
                    'fields' => array(
                        Field::create( 'text', 'first_name' )
                            ->required(),
                        Field::create( 'text', 'last_name' )
                            ->required(),
                        Field::create( 'textarea', 'bio' )
                            ->add_paragraphs()
                    )
                ))
        ));
}

/**
 * Display the team.
 *
 * @param bool $display Whether to ignore the default content from the theme. Return false and display content here.
 * @return bool
 */
add_filter( 'showcase.content', 'showcase_team_content', 9 );
function showcase_team_content( $display ) {
	if( is_page_template( 'team' ) && ! $display ) {
		include __DIR__ . '/template.php';
		return true;
	}

	return $display;
}
