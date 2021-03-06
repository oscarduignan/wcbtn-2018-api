<?php
/**
 * WordCamp Brighton 2018 workshop plugin (wcbtn-2018-api).
 *
 * @package schlessera/wcbtn-2018-api
 * @licence MIT
 * @link    https://schlessera.github.io/wcbtn-2018
 */

namespace WordCampBrighton\API\CustomPostType;

use WordCampBrighton\API\CustomField\CustomField;
use WordCampBrighton\API\Service;

/**
 * Abstract class BaseCustomPostType.
 *
 * @package schlessera/wcbtn-2018-api
 */
abstract class BaseCustomPostType implements Service {

	/**
	 * Register the custom post type.
	 */
	public function register() {
		add_action( 'init', function () {
			register_post_type( $this->get_slug(), $this->get_arguments() );

			foreach ( $this->get_custom_fields() as $custom_field ) {
				$custom_field->register();
			}
		} );
	}

	/**
	 * Get the slug to use for the custom post type.
	 *
	 * @return string Custom post type slug.
	 */
	abstract protected function get_slug();

	/**
	 * Get the arguments that configure the custom post type.
	 *
	 * @return array Array of arguments.
	 */
	abstract protected function get_arguments();

	/**
	 * Get the custom fields to add to a response.
	 *
	 * @return CustomField[] Array of custom field schema.
	 */
	abstract protected function get_custom_fields();
}
