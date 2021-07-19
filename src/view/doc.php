<?php
    foreach ( $route['endpoints'] as $endpoint ) {
        $is_post_request = in_array( 'POST', $endpoint['methods'] ) || in_array( 'PUT', $endpoint['methods'] );
        $total_methods = count( $endpoint['methods'] );

        printf( 
            '<div class="wpre-rest-doc %s" data-route_key="%s">', 
            'wpre-rest-doc-' . implode( ' wpre-rest-doc-', $endpoint['methods'] ),
            $route_key
        );

        ?>
        <div class="wpre-rest-route">
            <div class="wpre-rest-route-name">
                <?php
                    printf(
                        '<span class="wpre-rest-route-path">%s</span>',
                        $base_path
                    );
                ?>
            </div>

            <div class="wpre-rest-methods">
                <?php
                foreach ( $endpoint['methods'] as $method ) {
                    printf(
                        '<span class="wpre-rest-method wpre-rest-method-color-%1$s">%2$s</span>',
                        strtolower( $method ),
                        $method
                    );
                }
            ?>
            </div>
        </div>

        <?php
        echo '<div class="wpre-desc">';
            if ( empty( $endpoint['args'] ) ) {
                echo _n( 'No parameter is accepted for this method.', 'No parameter is accepted for these methods.', $total_methods );
            } elseif ( $is_post_request ) {
                _e( 'JSON body (payload)' );
            } else {
                _e( 'Query parameters' );
            }
        echo '</div>';

        if ( ! empty( $endpoint['args'] ) ) {
            echo '<table class="widefat wpre-rest-args-table">';
                echo '<thead>';
                    echo '<tr>';
                        echo '<th class="col-param">Param</th>';
                        echo '<th class="col-type">Type</th>';
                        echo '<th class="col-required">Required</th>';
                        echo '<th class="col-enum">Enum</th>';
                        echo '<th class="col-default">Default</th>';
                    echo '</tr>';
                echo '</thead>';
                echo '<tbody>';
                    foreach ( $endpoint['args'] as $param => $attrs ) {
                        $attrs = wp_parse_args( 
                            $attrs,
                            array(
                                'type'        => 'string',
                                'required'    => false,
                                'enum'        => array(),
                                'default'     => '',
                                'description' => ''
                            )
                        );

                        $classes = array(
                            'wpre-route-param'
                        );

                        $required = false;
                        if ( array_key_exists( 'required', $attrs ) && $attrs['required'] ) {
                            $required = true;
                            $classes[] = 'wpre-route-param-required';
                        }

                        printf( 
                            '<tr class="%s">', 
                            implode( ' ', $classes )
                        );

                            printf( 
                                '<td class="col-param"><code>%s</code></td>',
                                $param
                            );

                            echo '<td class="col-type">';
                            if ( array_key_exists( 'type', $attrs ) ) {
                                self::print_multitype_value( $attrs['type'], ' | ' );
                            }
                            echo '</td>';

                            echo '<td class="col-required">';
                            if ( $required ) {
                                _e( 'Yes' );
                            } else {
                                _e( 'No' );
                            }
                            echo '</td>';

                            echo '<td class="col-enum">';
                            if ( array_key_exists( 'enum', $attrs ) ) {
                                self::print_multitype_value( $attrs['enum'], ' | ' );
                            }
                            echo '</td>';

                            echo '<td class="col-default">';
                            if ( array_key_exists( 'default', $attrs ) ) {
                                self::print_multitype_value( $attrs['default'] );
                            }
                            echo '</td>';

                        echo '</tr>';

                        echo '<tr>';
                            echo '<td colspan="5" class="col-description">';
                            if ( array_key_exists( 'description', $attrs ) ) {
                                echo '<strong>Description:</strong> ' . $attrs['description'];
                            }
                            echo '</td>';
                        echo '</tr>';
                    }
                echo '</tbody>';
            echo '</table>';
        }
        echo '</div>';
    }
?>