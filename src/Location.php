<?php
/**
 * Class Location
 *
 * Represents a geocoded location with various properties.
 *
 * @package     ArrayPress/Geocoding
 * @copyright   Copyright (c) 2024, ArrayPress Limited
 * @license     GPL2+
 * @since       1.0.0
 */

declare( strict_types=1 );

namespace ArrayPress\Geocoding;

class Location {

	/**
	 * Raw location data from the API
	 *
	 * @var array
	 */
	private array $data;

	/**
	 * Initialize the Location object
	 *
	 * @param array $data Raw location data from the API
	 */
	public function __construct( array $data ) {
		$this->data = $data;
	}

	/**
	 * Get the latitude coordinate
	 *
	 * @return float|null
	 */
	public function get_latitude(): ?float {
		return isset( $this->data['lat'] ) ? (float) $this->data['lat'] : null;
	}

	/**
	 * Get the longitude coordinate
	 *
	 * @return float|null
	 */
	public function get_longitude(): ?float {
		return isset( $this->data['lon'] ) ? (float) $this->data['lon'] : null;
	}

	/**
	 * Get the formatted display name
	 *
	 * @return string|null
	 */
	public function get_display_name(): ?string {
		return $this->data['display_name'] ?? null;
	}

	/**
	 * Get the place ID from OpenStreetMap
	 *
	 * @return int|null
	 */
	public function get_place_id(): ?int {
		return isset( $this->data['place_id'] ) ? (int) $this->data['place_id'] : null;
	}

	/**
	 * Get the OSM type (node, way, relation)
	 *
	 * @return string|null
	 */
	public function get_osm_type(): ?string {
		return $this->data['osm_type'] ?? null;
	}

	/**
	 * Get the OSM ID
	 *
	 * @return int|null
	 */
	public function get_osm_id(): ?int {
		return isset( $this->data['osm_id'] ) ? (int) $this->data['osm_id'] : null;
	}

	/**
	 * Get the location class (e.g., office, building, tourism)
	 *
	 * @return string|null
	 */
	public function get_class(): ?string {
		return $this->data['class'] ?? null;
	}

	/**
	 * Get the location type (e.g., government, yes, information)
	 *
	 * @return string|null
	 */
	public function get_type(): ?string {
		return $this->data['type'] ?? null;
	}

	/**
	 * Get the location importance ranking
	 *
	 * @return float|null
	 */
	public function get_importance(): ?float {
		return isset( $this->data['importance'] ) ? (float) $this->data['importance'] : null;
	}

	/**
	 * Get the license information
	 *
	 * @return string|null
	 */
	public function get_license(): ?string {
		return $this->data['licence'] ?? null;
	}

	/**
	 * Get the bounding box coordinates
	 *
	 * @return array|null Array with min/max lat/lon values or null
	 */
	public function get_bounding_box(): ?array {
		if ( ! isset( $this->data['boundingbox'] ) || ! is_array( $this->data['boundingbox'] ) ) {
			return null;
		}

		return [
			'min_lat' => (float) $this->data['boundingbox'][0],
			'max_lat' => (float) $this->data['boundingbox'][1],
			'min_lon' => (float) $this->data['boundingbox'][2],
			'max_lon' => (float) $this->data['boundingbox'][3]
		];
	}

	/**
	 * Check if the location has a bounding box
	 *
	 * @return bool
	 */
	public function has_bounding_box(): bool {
		return isset( $this->data['boundingbox'] ) && is_array( $this->data['boundingbox'] );
	}

	/**
	 * Get all address components
	 *
	 * @return array|null
	 */
	public function get_address(): ?array {
		return $this->data['address'] ?? null;
	}

	/**
	 * Get a specific address component
	 *
	 * @param string $component Component name (e.g., 'city', 'country', 'postcode')
	 *
	 * @return string|null
	 */
	public function get_address_component( string $component ): ?string {
		return $this->data['address'][ $component ] ?? null;
	}

	/**
	 * Get the house number
	 *
	 * @return string|null
	 */
	public function get_house_number(): ?string {
		return $this->get_address_component( 'house_number' );
	}

	/**
	 * Get the street name
	 *
	 * @return string|null
	 */
	public function get_street(): ?string {
		return $this->get_address_component( 'road' );
	}

	/**
	 * Get the city/town name
	 *
	 * @return string|null
	 */
	public function get_city(): ?string {
		return $this->get_address_component( 'city' );
	}

	/**
	 * Get the state/province name
	 *
	 * @return string|null
	 */
	public function get_state(): ?string {
		return $this->get_address_component( 'state' );
	}

	/**
	 * Get the postal/zip code
	 *
	 * @return string|null
	 */
	public function get_postcode(): ?string {
		return $this->get_address_component( 'postcode' );
	}

	/**
	 * Get the country name
	 *
	 * @return string|null
	 */
	public function get_country(): ?string {
		return $this->get_address_component( 'country' );
	}

	/**
	 * Get the country code (ISO 3166-1 alpha-2)
	 *
	 * @return string|null
	 */
	public function get_country_code(): ?string {
		$code = $this->get_address_component( 'country_code' );

		return $code ? strtoupper( $code ) : null;
	}

	/**
	 * Get the borough/district name
	 *
	 * @return string|null
	 */
	public function get_borough(): ?string {
		return $this->get_address_component( 'borough' );
	}

	/**
	 * Get the raw data array
	 *
	 * @return array
	 */
	public function get_raw_data(): array {
		return $this->data;
	}

}