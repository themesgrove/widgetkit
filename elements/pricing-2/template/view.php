  <?php
      $settings = $this->get_settings();
  ?>


      <div class="tgx-pricing-2">
          <div class="tgx-single-pricing">
              <div class="tgx-single-wrapper">
                  <div class="tgx-single-heading">
                      <div class="price">

                          <?php if ( ! empty( $settings['single_currency_symbol'] ) ) : ?>
                              <span class="curency">
                                  <?php echo esc_attr($settings['single_currency_symbol']); ?>
                              </span>
                          <?php endif; ?>

                          <?php if ( ! empty( $settings['pricing_2_price'] ) ) : ?>
                              <span class="amount"><?php echo esc_html($settings['pricing_2_price']); ?></span>
                          <?php endif; ?>

                          <?php if ( ! empty( $settings['pricing_2_period'] ) ) : ?>
                              <span class="period">
                                  <?php echo esc_html($settings['pricing_2_period']); ?>
                              </span>
                          <?php endif; ?>

                      </div> <!-- .price -->

                      <?php if ( ! empty( $settings['pricing_2_icon_image'] ) ) : ?>
                          <div class="tgx-single-image">
                            <?php if (!empty($settings['pricing_2_icon_image']['id'])) {
                                echo wp_get_attachment_image($settings['pricing_2_icon_image']['id'], 'full', false, ['alt' => esc_attr($settings['pricing_2_pricing_title'])]);
                            } elseif (!empty($settings['pricing_2_icon_image']['url'])) {
                                // phpcs:ignore PluginCheck.CodeAnalysis.ImageFunctions.NonEnqueuedImage
                                echo '<img src="' . esc_url($settings['pricing_2_icon_image']['url']) . '" alt="' . esc_attr($settings['pricing_2_pricing_title']) . '" />';
                            } ?>
                          </div><!-- .table-image -->
                      <?php endif; ?>
                </div> <!-- .tx-table-heading -->

                <div class="tgx-single-about">
                    <?php if ( ! empty( $settings['pricing_2_pricing_title'] ) ) : ?>
                        <h3 class="tgx-single-title"> 
                            <?php echo esc_html($settings['pricing_2_pricing_title']); ?> 
                        </h3>
                    <?php endif; ?>

                    <?php if ( ! empty( $settings['pricing_2_pricing_about'] ) ) : ?>
                       <div class="tgx-single-about">
                           <?php echo esc_html($settings['pricing_2_pricing_about']); ?>
                       </div><!-- .single-about -->
                    <?php endif; ?>

                </div><!-- .tgx-single about -->

                <?php if ( ! empty( $settings['features_list_2'] ) ) : ?>
                  <ul class="tgx-single-features-list">
                    <?php foreach ( $settings['features_list_2'] as $item ) : ?>
                        <li class="tgx-feature-item-2">
                            <div class="tgx-price-table__feature-inner_2">
                                <?php if ( ! empty( $item['item_icon_2'] ) ) : ?>
                                    <i class="<?php echo esc_attr($item['item_icon_2']); ?>"></i>
                                <?php endif; ?>
                                <?php if ( ! empty( $item['item_text_2'] ) ) :
                                    echo esc_html($item['item_text_2']);
                                else :
                                    echo '&nbsp;';
                                endif;
                                ?>
                            </div><!-- .feature-inner 2 -->
                        </li><!-- .li -->
                    <?php endforeach; ?>
                </ul><!-- ul -->
            <?php endif; ?>
        </div><!-- .tgx-single-wrapper -->

        <?php if ( ! empty( $settings['single_button_text'] ) ) : ?>
            <div class="tgx-single-footer"> 
                <a class="tgx-single-btn" href="<?php echo esc_url($settings['single_link']['url']); ?>">
                    <?php echo esc_html($settings['single_button_text']); ?>
                </a> 
            </div><!-- .tgx-single-footer -->
        <?php endif; ?>

      </div> <!-- .tgx-single-pricing -->
  </div><!-- .tgx-pricing-2 -->

    <script type="text/javascript">
          jQuery(function($){
              if(!$('body').hasClass('wk-pricing-icon')){
                  $('body').addClass('wk-pricing-icon');
              }
          });

    </script>