<?php
/**
 * WordCamp Brighton 2018 workshop plugin (wcbtn-2018-api).
 *
 * @package schlessera/wcbtn-2018-api
 * @licence MIT
 * @link    https://schlessera.github.io/wcbtn-2018
 */

namespace WordCampBrighton\API\View;

use WordCampBrighton\API\Exception\InvalidURI;

/**
 * Class TemplatedView.
 *
 * Looks within the child theme and parent theme folders first for a view,
 * before defaulting to the plugin folder.
 *
 * @package schlessera/wcbtn-2018-api
 */
final class TemplatedView extends BaseView {

	/**
	 * Validate an URI.
	 *
	 * @param string $uri URI to validate.
	 *
	 * @return string Validated URI.
	 * @throws InvalidURI If an invalid URI was passed into the View.
	 */
	protected function validate( $uri ) {
		$uri = $this->check_extension( $uri, static::VIEW_EXTENSION );

		foreach ( $this->get_locations( $uri ) as $location ) {
			if ( is_readable( $location ) ) {
				return $location;
			}
		}

		if ( ! is_readable( $uri ) ) {
			throw InvalidURI::from_uri( $uri );
		}

		return $uri;
	}

	/**
	 * Get the possible locations for the view.
	 *
	 * @param string $uri URI of the view to get the locations for.
	 *
	 * @return array Array of possible locations.
	 */
	protected function get_locations( $uri ) {
		return [
			trailingslashit( STYLESHEETPATH ) . $uri,
			trailingslashit( TEMPLATEPATH ) . $uri,
			trailingslashit( dirname( __DIR__, 2 ) ) . $uri,
		];
	}
}
