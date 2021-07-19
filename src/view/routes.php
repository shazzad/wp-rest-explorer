<div class="wpre-rest-routes">
    <?php
        foreach ( $routes as $path => $route ) {
            $base_path = str_replace( '/' . $namespace, '', $path );

            if ( empty( $base_path ) || empty( $route['methods'] ) ) {
                continue;
            }

            $route_key = \WP_Rest_Explorer\Rest_Explorer::sanitize_route_key( $base_path );

            include dirname( __FILE__ ) . '/route.php';
        }
    ?>
</div>