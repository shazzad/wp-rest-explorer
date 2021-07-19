<?php
/**
 * Registration Approval System
 *
 * @package ServedAdmin
 */
namespace Shazzad\WP_Rest_Explorer;

use WP_Error;

class Rest_Explorer {

	public static function register_scripts() {
		$min = '';
		$base_url = dirname( plugin_dir_url( __FILE__ ) );

		wp_register_script( 'wpre-wp-rest-explorer', $base_url . 'assets/js/wp-rest-explorer' . $min . '.js', array( 'jquery' ), WPSA_VERSION, true );
		wp_register_style( 'wpre-wp-rest-explorer', $base_url . 'assets/css/wp-rest-explorer' . $min . '.css', array(), WPSA_VERSION );
	}

	public static function enqueue_scripts() {
		wp_enqueue_script( 'wpre-wp-rest-explorer' );
		wp_enqueue_style( 'wpre-wp-rest-explorer' );
	}

	public static function render( $api_url, $args = array() ) {
		$rest_data = self::wp_rest_api_data( $api_url );

		if ( is_wp_error( $rest_data ) ) {
			if ( 'api_body_error' === $rest_data->get_error_code() ) {
				$notice = $rest_data->get_error_message();
				include __DIR__ . '/view/notice.php';
				return;
			} else {
				$error = $rest_data->get_error_message();
				include __DIR__ . '/view/error.php';
				return;
			}
		}

		if ( empty( $rest_data['routes'] ) ) {
			$notice = __( 'Api doesn\'t have routes.' );
			include __DIR__ . '/view/notice.php';
			return;
		}

		$namespace = $rest_data['namespace'];
		$routes = $rest_data['routes'];
		$links = $rest_data['_links'];

		unset( $rest_data );

		include __DIR__ . '/view/explorer.php';
	}

	public static function sanitize_route_key( $key ) {
		$key = sanitize_html_class( str_replace( '/', '--', trim( $key, '/' ) ) );
		$key = strtolower( $key );

		return $key;
	}

	public static function print_multitype_value( $value, $sep = ', ' ) {
		// var_dump( $value );

		if ( is_string( $value ) ) {
			echo (string) $value;
		} elseif ( is_bool( $value ) ) {
			echo $value ? 'true' : 'false';
		} elseif ( is_array( $value ) ) {
			echo implode( $sep, $value );
		} else {
			print_r( $value );
		}
	}

	public static function wp_rest_api_data( $api_url ) {
		$cache_key = 'wpre_wp_rest_explorer_' . md5( $api_url );
		$rest_data = get_transient( $cache_key );

		if ( false === $rest_data ) {
			$api_response = wp_remote_get( $api_url );

			if ( is_wp_error( $api_response ) ) {
				return new WP_Error( 'api_response_error', $api_response->get_error_message() );
			}

			$api_body = wp_remote_retrieve_body( $api_response );
			if ( empty( $api_body ) ) {
				return new WP_Error( 'api_body_error', __( 'Api returned empty results.' ) );
			}

			$rest_data = json_decode( $api_body, true );
			set_transient( $cache_key, $rest_data, 60 );
		}

		return $rest_data;
	}
}