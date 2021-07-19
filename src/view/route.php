<div class="wpre-rest-route wpre-rest-route-btn" data-key="<?php echo $route_key; ?>">
    <div class="wpre-rest-route-name">
        <?php
            // Only link if route has an GET method.
            if ( ! empty( $route['_links'] ) && ! empty( $route['methods'] ) && in_array( 'GET', $route['methods'] ) ) {
                $link = $route['_links']['self'][0]['href'];
                if ( ! empty( $args['access_token'] ) ) {
                    $link = add_query_arg( 'access_token', $args['access_token'], $link );
                }

                printf(
                    '<a href="%s" target="_blank" class="wpre-rest-route-path">%s</a>',
                    $link,
                    esc_attr( $base_path )
                );
            } else {
                printf(
                    '<span class="wpre-rest-route-path">%s</span>',
                    esc_attr( $base_path )
                );
            }
        ?>
    </div>

    <div class="wpre-rest-methods">
    <?php
        foreach ( $route['methods'] as $method ) {
            printf(
                '<span class="wpre-rest-method wpre-rest-method-color-%1$s wpre-rest-doc-btn" data-method="%2$s">%2$s</span>',
                strtolower( $method ),
                $method
            );
        }
    ?>
    </div>
</div>