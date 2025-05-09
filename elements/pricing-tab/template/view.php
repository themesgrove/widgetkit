<?php
    // Pricing tab
    $settings = $this->get_settings();
    $counter = 0;

    $pricing_count = count($settings['pricing_tabs']);

?>

    <div class="pricing-tab">
        <?php $count = 0; if ( ! empty( $settings['pricing_tabs'] ) ) : ?>
            <?php foreach( $settings['pricing_tabs'] as $item ) : $count++; ?>
                <input class="<?php echo esc_attr($count);?>" type="radio" id="<?php echo esc_attr($counter); ?>" name="tab" <?php echo (0 == $counter) ? 'checked' : ''; ?>>

                <label class="pricing-btn 
                    <?php if($pricing_count == '1'): ?>
                        <?php echo esc_attr('col-md-12'); ?>
                    <?php elseif($pricing_count == '2'): ?>
                        <?php echo esc_attr('col-md-6'); ?>
                    <?php else: ?>
                        <?php echo esc_attr('col-md-4'); ?>
                    <?php endif; ?>
                    " for="<?php echo esc_attr($counter); ?>">

                    <h4 class="price-title"><?php echo esc_html($item['tab_title']); ?></h4>

                    <span class="price-subtitle">
                        <?php echo esc_html($item['tab_subtitle']); ?>   
                    </span><!-- pricing-subtitle-->
                </label><!--  Pricing-button -->

            <div class="pricing-content row">
                <div class="pricing-content-wrapper">

                    <?php if ($item['pricing_tab_enable_1'] == 'yes'): ?>

                    <div class="

                        <?php if ($item['pricing_tab_enable_3'] == 'yes' & $item['pricing_tab_enable_2'] == 'yes' & $item['pricing_tab_enable_1'] == 'yes'): ?>
                            <?php echo esc_attr("col-xs-12 col-md-6 col-lg-4"); ?>

                        <?php elseif ($item['pricing_tab_enable_3'] == 'yes' & $item['pricing_tab_enable_2'] == 'yes' or $item['pricing_tab_enable_3'] == 'yes' & $item['pricing_tab_enable_1'] == 'yes' or $item['pricing_tab_enable_2'] == 'yes' & $item['pricing_tab_enable_1'] == 'yes'): ?>
                            <?php echo esc_attr("col-xs-12 col-md-6 col-lg-6"); ?>

                        <?php elseif ($item['pricing_tab_enable_3'] == 'yes' or $item['pricing_tab_enable_2'] == 'yes' or $item['pricing_tab_enable_1'] == 'yes'): ?>
                            <?php echo esc_attr("col-xs-12 col-md-12 col-lg-12"); ?>

                        <?php else: ?>
                    <?php endif; ?>">

                    <div class="tgx-pricing-tab-<?php echo esc_attr($counter); ?> ">
                        <div class="tgx-pricing-tab-wrapper">
                            <div class="tgx-pricing-tab-heading ">
                                <div class="cost text-center">

                                    <?php if ( ! empty( $item['currency_symbol'] ) ) : ?>
                                        <span class="curency">
                                            <?php echo esc_html($item['currency_symbol']);  ?>
                                        </span>
                                    <?php endif; ?>
               
                                    <?php if ( ! empty( $item['price'] ) ) : ?>
                                        <span class="amount"><?php echo esc_html($item['price']); ?></span>
                                    <?php endif; ?>

                                    <?php if ( ! empty( $item['period'] ) ) : ?>
                                        <span class="period">
                                            <?php echo esc_html($item['period']); ?>
                                        </span>
                                    <?php endif; ?>
                                </div>

                            <?php if ( ! empty( $item['tab_image'] ) ) : ?>
                                <div class="tgx-pricing-tab-image">
                                    <?php if (!empty($item['tab_image']['id'])) {
                                        echo wp_get_attachment_image($item['tab_image']['id'], 'full', false, ['alt' => esc_attr($item['pricing_title'])]);
                                    } elseif (!empty($item['tab_image']['url'])) {
                                        // phpcs:ignore PluginCheck.CodeAnalysis.ImageFunctions.NonEnqueuedImage
                                        echo '<img src="' . esc_url($item['tab_image']['url']) . '" alt="' . esc_attr($item['pricing_title']) . '" />';
                                    } ?>
                                </div>
                            <?php endif; ?>

                        </div> <!-- pricing-tab-headeing -->


                        <div class="tgx-pricing-tab-about">
                            <?php if ( ! empty( $item['pricing_title'] ) ) : ?>
                                <h3 class="tgx-pricing-tab-title">
                                    <?php echo esc_html($item['pricing_title']); ?> 
                                </h3>
                            <?php endif; ?>
                            <?php if ( ! empty( $item['pricing_desc_1'] ) ) : ?> 
                                <p class="tgx-pricing-tab-desc"> 
                                    <?php echo esc_html($item['pricing_desc_1']); ?> 
                                </p>
                            <?php endif; ?>
                        </div><!-- pricing-tab-about -->


                        <?php if ( ! empty( $item['pricing_details'] ) ) : ?>
                            <div class="tgx-pricing-tab-feature">
                                <?php echo wp_kses_post($item['pricing_details']); ?>
                            </div><!-- pricing-tab-features -->
                        <?php endif; ?>

                    </div><!-- pricing-tab-wrapper -->

                        <?php if ( ! empty( $item['button_text'] ) ) : ?>
                            <div class="tgx-pricing-tab-footer"> 
                                <a class="tgx-pricing-tab-btn" href="<?php echo esc_url($item['link']['url']); ?>">
                                    <?php echo esc_html($item['button_text']); ?>   
                                </a> 
                            </div><!-- pricing-tab-footer -->
                        <?php endif; ?>
                    </div><!-- pricing-tab-->
               </div><!-- col-md-3 -->
            <?php endif; ?>

            <?php if ($item['pricing_tab_enable_2'] == 'yes'): ?>
                <div class="
                     <?php if ($item['pricing_tab_enable_3'] == 'yes' & $item['pricing_tab_enable_2'] == 'yes' & $item['pricing_tab_enable_1'] == 'yes'): ?>
                        <?php echo esc_attr("col-xs-12 col-md-6 col-lg-4"); ?>

                    <?php elseif ($item['pricing_tab_enable_3'] == 'yes' & $item['pricing_tab_enable_2'] == 'yes' or $item['pricing_tab_enable_3'] == 'yes' & $item['pricing_tab_enable_1'] == 'yes' or $item['pricing_tab_enable_2'] == 'yes' & $item['pricing_tab_enable_1'] == 'yes'): ?>
                        <?php echo esc_attr("col-xs-12 col-md-6 col-lg-6"); ?>

                    <?php elseif ($item['pricing_tab_enable_3'] == 'yes' or $item['pricing_tab_enable_2'] == 'yes' or $item['pricing_tab_enable_1'] == 'yes'): ?>
                        <?php echo esc_attr("col-xs-12 col-md-12 col-lg-12"); ?>

                    <?php else: ?>
                    <?php endif; ?>">

                <div class="tgx-pricing-tab-<?php echo esc_attr($counter); ?>">
                    <div class="tgx-pricing-tab-wrapper">
                        <div class="tgx-pricing-tab-heading ">
                            <div class="cost text-center">

                                 <?php if ( ! empty( $item['currency_symbol_2'] ) ) : ?>
                                      <span class="curency">
                                            <?php echo esc_html($item['currency_symbol_2']);?>
                                      </span>
                                  <?php endif; ?>

                                  <?php if ( ! empty( $item['price_2'] ) ) : ?>
                                        <span class="amount"><?php echo esc_html($item['price_2']); ?></span>
                                  <?php endif; ?>

                                  <?php if ( ! empty( $item['period_2'] ) ) : ?>
                                        <span class="period"> 
                                            <?php echo esc_html($item['period_2']); ?>
                                        </span>
                                  <?php endif; ?>
                            </div><!-- pricing-tab-cost -->

                            <?php if ( ! empty( $item['tab_image_2'] ) ) : ?>
                                <div class="tgx-pricing-tab-image">
                                    <?php if (!empty($item['tab_image_2']['id'])) {
                                        echo wp_get_attachment_image($item['tab_image_2']['id'], 'full', false, ['alt' => esc_attr($item['pricing_title_2'])]);
                                    } elseif (!empty($item['tab_image_2']['url'])) {
                                        // phpcs:ignore PluginCheck.CodeAnalysis.ImageFunctions.NonEnqueuedImage
                                        echo '<img src="' . esc_url($item['tab_image_2']['url']) . '" alt="' . esc_attr($item['pricing_title_2']) . '" />';
                                    } ?>
                                </div>
                            <?php endif; ?>
                            </div><!-- pricing-tab-headeing -->

                            <div class="tgx-pricing-tab-about">
                                <?php if ( ! empty( $item['pricing_title_2'] ) ) : ?>
                                    <h3 class="tgx-pricing-tab-title"> 
                                        <?php echo esc_html($item['pricing_title_2']); ?> 
                                    </h3>
                                <?php endif; ?>

                                <?php if ( ! empty( $item['pricing_desc_2'] ) ) : ?>
                                    <p class="tgx-pricing-tab-desc"> 
                                        <?php echo esc_html($item['pricing_desc_2']); ?> 
                                    </p>
                                <?php endif; ?>
                            </div><!-- pricing-tab-about -->

                        <?php if ( ! empty( $item['pricing_details_2'] ) ) : ?>
                             <div class="tgx-pricing-tab-feature">
                                 <?php echo wp_kses_post($item['pricing_details_2']); ?>
                             </div><!-- pricing-tab-feature -->
                        <?php endif; ?>
                    </div><!-- pricing-tab-wrapper -->

                    <?php if ( ! empty( $item['button_text_2'] ) ) : ?>
                        <div class="tgx-pricing-tab-footer"> 
                            <a class="tgx-pricing-tab-btn" href="<?php echo esc_url($item['link_2']['url']); ?>">
                                 <?php echo esc_html($item['button_text_2']); ?>   
                            </a> 
                        </div><!-- pricing-tab-footer -->
                    <?php endif; ?>
                </div><!-- pricing-tab -->
            </div><!-- col-md-4 -->
        <?php endif; ?>

        <?php if ($item['pricing_tab_enable_3'] == 'yes'): ?>
            <div class="
                <?php if ($item['pricing_tab_enable_3'] == 'yes' & $item['pricing_tab_enable_2'] == 'yes' & $item['pricing_tab_enable_1'] == 'yes'): ?>
                    <?php echo esc_attr("col-xs-12 col-md-6 col-lg-4"); ?>

                <?php elseif ($item['pricing_tab_enable_3'] == 'yes' & $item['pricing_tab_enable_2'] == 'yes' or $item['pricing_tab_enable_3'] == 'yes' & $item['pricing_tab_enable_1'] == 'yes' or $item['pricing_tab_enable_2'] == 'yes' & $item['pricing_tab_enable_1'] == 'yes'): ?>

                    <?php echo esc_attr("col-xs-12 col-md-6 col-lg-6"); ?>

                <?php elseif ($item['pricing_tab_enable_3'] == 'yes' or $item['pricing_tab_enable_2'] == 'yes' or $item['pricing_tab_enable_1'] == 'yes'): ?>
                    <?php echo esc_attr("col-xs-12 col-md-12 col-lg-12"); ?>

                <?php else: ?>
                <?php endif; ?>">

                <div class="tgx-pricing-tab-<?php echo esc_attr($counter); ?>">
                    <div class="tgx-pricing-tab-wrapper">
                        <div class="tgx-pricing-tab-heading ">
                            <div class="cost text-center">

                                <?php if ( ! empty( $item['currency_symbol_3'] ) ) : ?>
                                    <span class="curency"><?php echo esc_html($item['currency_symbol_3']);  ?></span>
                                <?php endif; ?>

                                <?php if ( ! empty( $item['price_3'] ) ) : ?>
                                    <span class="amount"><?php echo esc_html($item['price_3']); ?></span>
                                <?php endif; ?>

                                <?php if ( ! empty( $item['period_3'] ) ) : ?>
                                    <span class="period">
                                        <?php echo esc_html($item['period_3']); ?>
                                    </span>
                                <?php endif; ?>
                            </div><!-- pricing-tab-cost -->

                            <?php if ( ! empty( $item['tab_image_3'] ) ) : ?>
                                <div class="tgx-pricing-tab-image">
                                    <?php if (!empty($item['tab_image_3']['id'])) {
                                        echo wp_get_attachment_image($item['tab_image_3']['id'], 'full', false, ['alt' => esc_attr($item['pricing_title_3'])]);
                                    } elseif (!empty($item['tab_image_3']['url'])) {
                                        // phpcs:ignore PluginCheck.CodeAnalysis.ImageFunctions.NonEnqueuedImage
                                        echo '<img src="' . esc_url($item['tab_image_3']['url']) . '" alt="' . esc_attr($item['pricing_title_3']) . '" />';
                                    } ?>
                                </div>
                            <?php endif; ?>
                        </div><!-- pricing-tab-headeing -->

                        <div class="tgx-pricing-tab-about">
                            <?php if ( ! empty( $item['pricing_title_3'] ) ) : ?>
                                <h3 class="tgx-pricing-tab-title"> 
                                    <?php echo esc_html($item['pricing_title_3']);?> 
                                </h3>
                            <?php endif; ?>
                            <?php if ( ! empty( $item['pricing_desc_3'] ) ) : ?>
                                <p class="tgx-pricing-tab-desc"> 
                                    <?php echo esc_html($item['pricing_desc_3']); ?> 
                                </p>
                            <?php endif; ?>
                        </div><!-- pricing-tab-about -->

                    <?php if ( ! empty( $item['pricing_details_3'] ) ) : ?>
                        <div class="tgx-pricing-tab-feature">
                             <?php echo wp_kses_post($item['pricing_details_3']); ?>
                        </div><!-- pricing-tab-feature -->
                    <?php endif; ?>

                    </div><!-- pricing-tab-wrapper -->
                    <?php if ( ! empty( $item['button_text_3'] ) ) : ?>
                        <div class="tgx-pricing-tab-footer"> 
                            <a class="tgx-pricing-tab-btn" href="<?php echo esc_url($item['link_3']['url']); ?>">
                                <?php echo esc_html($item['button_text_3']);?>
                            </a> 
                        </div><!-- pricing-tab-footer -->
                    <?php endif; ?>
                </div><!-- pricing-tab-wrapper -->
            </div><!-- col-md-4 -->
        <?php endif; ?>

        </div><!-- pricing-content-wrapper -->
    </div><!-- pricing-content -->
    <?php $counter++; endforeach; endif; ?>
</div> <!-- pricing-tab -->

    <script type="text/javascript">
          jQuery(function($){
              if(!$('body').hasClass('wk-pricing-tab')){
                  $('body').addClass('wk-pricing-tab');
              }
          });

    </script>