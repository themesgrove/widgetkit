<?php
   // Silence is golden.

    $settings = $this->get_settings();
    //$id = $this->get_id();


        $target_date = str_replace('-', '/', $settings['widgetkit_countdown_date_time'] );
        
        $formats = $settings['widgetkit_countdown_units'];
        $format = implode('', $formats );
        $time = str_replace('-', '/', current_time('mysql') );
        $serverSync = '';

        if ( $settings['widgetkit_countdown_s_u_time'] === 'wp-time' ) {
            $serverSync = "function() { return new Date('" . esc_js( $time ) . "'); }";
        }
        
        // Singular labels set up
        $y = !empty( $settings['widgetkit_countdown_year_singular'] ) ? $settings['widgetkit_countdown_year_singular'] : 'Year';
        $m = !empty( $settings['widgetkit_countdown_month_singular'] ) ? $settings['widgetkit_countdown_month_singular'] : 'Month';
        $w = !empty( $settings['widgetkit_countdown_week_singular'] ) ? $settings['widgetkit_countdown_week_singular'] : 'Week';
        $d = !empty( $settings['widgetkit_countdown_day_singular'] ) ? $settings['widgetkit_countdown_day_singular'] : 'Day';
        $h = !empty( $settings['widgetkit_countdown_hour_singular'] ) ? $settings['widgetkit_countdown_hour_singular'] : 'Hour';
        $mi = !empty( $settings['widgetkit_countdown_minute_singular'] ) ? $settings['widgetkit_countdown_minute_singular'] : 'Minute';
        $s = !empty( $settings['widgetkit_countdown_second_singular'] ) ? $settings['widgetkit_countdown_second_singular'] : 'Second';
        $label = $y."," . $m ."," . $w ."," . $d ."," . $h ."," . $mi ."," . $s;

        // Plural labels set up
        $ys = !empty( $settings['widgetkit_countdown_year_plural'] ) ? $settings['widgetkit_countdown_year_plural'] : 'Years';
        $ms = !empty( $settings['widgetkit_countdown_month_plural'] ) ? $settings['widgetkit_countdown_month_plural'] : 'Months';
        $ws = !empty( $settings['widgetkit_countdown_week_plural'] ) ? $settings['widgetkit_countdown_week_plural'] : 'Weeks';
        $ds = !empty( $settings['widgetkit_countdown_day_plural'] ) ? $settings['widgetkit_countdown_day_plural'] : 'Days';
        $hs = !empty( $settings['widgetkit_countdown_hour_plural'] ) ? $settings['widgetkit_countdown_hour_plural'] : 'Hours';
        $mis = !empty( $settings['widgetkit_countdown_minute_plural'] ) ? $settings['widgetkit_countdown_minute_plural'] : 'Minutes';
        $ss = !empty( $settings['widgetkit_countdown_second_plural'] ) ? $settings['widgetkit_countdown_second_plural'] : 'Seconds';
        $labels1 = $ys."," . $ms ."," . $ws ."," . $ds ."," . $hs ."," . $mis ."," . $ss;
        
        $expire_text = addslashes($settings['widgetkit_countdown_expiry_text_']);
        
        $pcdt_style = $settings['widgetkit_countdown_style'] == 'd-u-s' ? ' side' : ' down';
        
        ?>
            <div class="wk-countdown">
                <div class="countdown-wrapper">
                    <div id="countDownContiner">
                        <div class="widgetkit-countdown<?php echo esc_attr($pcdt_style); ?>" id="countdown-<?php echo esc_attr( $this->get_id() ); ?>"></div>
                    </div>     
                </div>
            </div>
            
    <!-- Countdown JS -->
    <script>
        (function($){
            $(document).ready(function(){
                var labels  = <?php echo wp_json_encode( array_map('sanitize_text_field', explode(',', (string) $label)) ); ?>;
                var labels1 = <?php echo wp_json_encode( array_map('sanitize_text_field', explode(',', (string) $labels1)) ); ?>;
                var id      = <?php echo wp_json_encode( (string) $this->get_id() ); ?>;
                var target  = <?php echo wp_json_encode( (string) $target_date ); ?>;
                var format  = <?php echo wp_json_encode( (string) $format ); ?>;
                var expireText = <?php echo wp_json_encode( wp_kses_post( $expire_text ) ); ?>;

                var $el = $('#countdown-' + id);

                $el.widgetkit_countdown({
                    labels: labels,
                    labels1: labels1,
                    until: new Date( target ),
                    format: format,
                    padZeroes: true,
                    <?php if ( $expire_text ): ?>
                    onExpiry: function(){
                        $(this).html( expireText );
                    },
                    <?php endif; ?>
                    <?php
                        if ( is_array( $serverSync ) ) {
                            echo 'serverSync: ' . wp_json_encode( $serverSync ) . ',';
                        } else {
                            echo 'serverSync: ' . wp_json_encode( sanitize_text_field( (string) $serverSync ) ) . ',';
                        }
                    ?>
                });

                var times = $el.widgetkit_countdown('getTimes');

                function runTimer(el){ return el === 0; }

                if ( Array.isArray(times) && times.every(runTimer) ) {
                <?php if ($expire_text): ?>
                    $el.html( expireText );
                <?php endif; ?>
                }

                if (!$('body').hasClass('wk-countdown')) {
                $('body').addClass('wk-countdown');
                }

            });
        })(jQuery);
    </script>
