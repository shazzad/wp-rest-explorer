<div class="wpre-rest-docs">
    <?php
        foreach ( $routes as $path => $route ) {
            $base_path = str_replace( '/' . $namespace, '', $path );

            if ( empty( $base_path ) || empty( $route['methods'] ) ) {
                continue;
            }

            if ( empty( $route['endpoints'] ) ) {
                continue;
            }

            $route_key = \Shazzad\WP_Rest_Explorer\Rest_Explorer::sanitize_route_key( $base_path );

            include dirname( __FILE__ ) . '/doc.php';
        }
    ?>
</div>