<?php
// Silence is golden.

    $galleries = $this->get_settings();
    $id = $this->get_id();
    $light_case_animation = $galleries['lightcase_animation'];
    $gallery_tag_arr = [];
?>


	<div class="wk-gallery" <?php echo esc_attr($galleries['filter_enable'] == 'yes') ? 'wk-filter="target: .js-filter"' : ''; ?> >
		<?php if ($galleries['filter_enable'] == 'yes'): ?>
		<div class="wk-container wk-margin-auto">
			<?php 
				foreach ( $galleries['gallery_content'] as $key => $value) {
					$split_data_arr = explode(',', $value['filter_tag']);
					foreach($split_data_arr as $value){
						$trimmed_value = trim($value);
						if(!in_array($trimmed_value, $gallery_tag_arr)){
							array_push($gallery_tag_arr, $trimmed_value);
						}
					}
				}
				
			?>
			<ul class="wk-flex-<?php echo esc_attr($galleries['filter_layout_align']);?>" wk-tab>
				<?php if ($galleries['filter_show_title']): ?>
					<li class="wk-active" wk-filter-control><a href="#"><?php echo esc_html($galleries['filter_show_title']);?></a></li>
				<?php endif; ?>
				
				<?php foreach($gallery_tag_arr as $tag_name): 
					$tags_sorting = str_replace([" ", "&"], ["_", ""], $tag_name);?>
					<li wk-filter-control=".<?php echo esc_attr(strtolower($tags_sorting.'_'.$id));?>">
				        <a href="#"><?php echo esc_html($tag_name); ?></a>
				    </li>
				<?php endforeach; ?>
			</ul> <!-- filter tags -->
			
		</div>			

		<?php endif; ?>


			<?php if ($galleries['colmun_width'] == 'auto'):?>
				<div class="<?php echo esc_attr($galleries['filter_enable'] == 'yes') ? 'js-filter' : ''; ?> wk-grid-<?php echo esc_attr($galleries['column_gap']);?> wk-child-width-<?php echo esc_attr($galleries['colmun_width']);?> wk-child-width-1-2@s" wk-grid="masonry:<?php echo esc_attr($galleries['masonary_enable']) == 'yes'? 'true' : 'false';?>">

			<?php else: ?>
				<div class="<?php echo esc_attr($galleries['filter_enable'] == 'yes')? 'js-filter' : ''; ?> wk-grid-<?php echo esc_attr($galleries['column_gap']);?>  wk-child-width-<?php echo esc_attr($galleries['colmun_layout']);?>@m wk-child-width-1-2@s" wk-grid="masonry:<?php echo esc_attr($galleries['masonary_enable']) == 'yes'? 'true' : 'false';?>">
			<?php endif; ?>
	  		<?php foreach ($galleries['gallery_content'] as $gallery) :?>
	  			<?php $tags = explode(',', $gallery['filter_tag']);?>
		        <div class="<?php foreach($tags as $tag ){
		        	$tags_replace = str_replace([" ", "&"], ["_", ""], $tag);
		        	echo esc_attr(strtolower($tags_replace.'_'.$id));}?>">
		        <!-- 	<div class=""> -->
			            <div class="wk-gallery-card <?php echo esc_attr($galleries['content_position']) == 'overlay' ? 'wk-position-relative' : '';?>  wk-overflow-hidden <?php echo esc_attr($galleries['hover_effect']);?> content-<?php echo esc_attr($galleries['content_position']);?>">

							<?php if ($galleries['content_position'] == 'overlay'): ?>

					            <?php if ($gallery['gallery_thumb_image']): ?>
					            	<?php if (!empty($gallery['gallery_thumb_image']['id'])) {
					            	    echo wp_get_attachment_image($gallery['gallery_thumb_image']['id'], 'full', false, ['alt' => esc_attr($gallery['gallery_title'])]);
					            	} elseif (!empty($gallery['gallery_thumb_image']['url'])) {
										// phpcs:ignore PluginCheck.CodeAnalysis.ImageFunctions.NonEnqueuedImage
					            	    echo '<img src="' . esc_url($gallery['gallery_thumb_image']['url']) . '" alt="' . esc_attr($gallery['gallery_title']) . '">';
					            	} ?>
					            <?php endif ;?>

					            <div class="wk-padding-small wk-position-absolute wk-position-center wk-text-center wk-gallery-body">
						               <?php if ($gallery['demo_link']['url']): ?>
						           		<a href="<?php echo esc_url($gallery['demo_link']['url']); ?>" <?php echo esc_attr($gallery['demo_link']['is_external']) ? 'target="_blank"' : 'nofollow="nofollow"'; ?>>
						            		<h5 class="wk-text-medium wk-margin-small wk-card-title"> <?php echo esc_html($gallery['gallery_title']);?>
						            		</h5>
										</a>
										<?php else: ?>
											<h5 class="wk-text-medium wk-margin-small  wk-card-title"> 
												<?php echo esc_html($gallery['gallery_title']);?>
											</h5>
						            	<?php endif ;?>
						            	<?php if ($gallery['gallery_desc']): ?>
						            		<p class="wk-text-desc wk-margin-remove wk-padding-small wk-padding-remove-top">
						            			<?php echo esc_html($gallery['gallery_desc']);?></p>	
						            	<?php endif; ?>

						            	<?php if ($galleries['lightcase_enable'] == 'yes' || $galleries['link_enable'] == 'yes'):?>
							            	<div class="gallery-lightbox wk-text-center">
							            		<?php if ($galleries['link_enable'] == 'yes'):?>
									            	<a class="icon" href="<?php echo esc_url($gallery['demo_link']['url']); ?>" <?php echo esc_attr($gallery['demo_link']['is_external']) ? 'target="_blank"' : 'nofollow="nofollow"'; ?>>
									            		<span class="fa fa-link"></span>
									            	</a>
								            	<?php endif; ?>
								            	<?php if ($galleries['lightcase_enable'] == 'yes'):?>
													<a class="icon" href="<?php echo esc_url($gallery['gallery_thumb_image']['url']);?>" <?php echo esc_attr($galleries['lightcase_enable']) == 'yes'? ' wk-lightbox="animation:' . esc_attr($light_case_animation) . '"' : '';?>><span class="fa fa-search"></span></a>
												<?php endif; ?>
							            	</div>
						            	<?php endif; ?>
									</div> <!-- wk-body -->


								<?php else: ?>
									<div class="caption-button wk-position-relative wk-overflow-hidden">

									    <?php if ($gallery['gallery_thumb_image']): ?>
							            	<?php if ($gallery['demo_link']['url']): ?>
								            	<a class="img-link" href="<?php echo esc_url($gallery['demo_link']['url']); ?>" <?php echo esc_attr($gallery['demo_link']['is_external']) ? 'target="_blank"' : 'nofollow="nofollow"'; ?>>
								            		<?php if (!empty($gallery['gallery_thumb_image']['id'])) {
								            		    echo wp_get_attachment_image($gallery['gallery_thumb_image']['id'], 'full', false, ['alt' => esc_attr($gallery['gallery_title'])]);
								            		} elseif (!empty($gallery['gallery_thumb_image']['url'])) {
														// phpcs:ignore PluginCheck.CodeAnalysis.ImageFunctions.NonEnqueuedImage
								            		    echo '<img src="' . esc_url($gallery['gallery_thumb_image']['url']) . '" alt="' . esc_attr($gallery['gallery_title']) . '">';
								            		} ?>
								            	</a>
							            	<?php else: ?>
							            		<?php if (!empty($gallery['gallery_thumb_image']['id'])) {
							            		    echo wp_get_attachment_image($gallery['gallery_thumb_image']['id'], 'full', false, ['class' => 'img-link', 'alt' => esc_attr($gallery['gallery_title'])]);
							            		} elseif (!empty($gallery['gallery_thumb_image']['url'])) {
													// phpcs:ignore PluginCheck.CodeAnalysis.ImageFunctions.NonEnqueuedImage
							            		    echo '<img class="img-link" src="' . esc_url($gallery['gallery_thumb_image']['url']) . '" alt="' . esc_attr($gallery['gallery_title']) . '">';
							            		} ?>
							            	<?php endif;?>
							            <?php endif ;?>

						            	<?php if ($galleries['lightcase_enable'] == 'yes' || $galleries['link_enable'] == 'yes'):?>
							            	<div class="gallery-lightbox wk-text-center wk-position-absolute wk-position-center">
							            		<?php if ($galleries['link_enable'] == 'yes'): ?>
							            			 <?php if ($galleries['button_text']): ?>
										            	<a class="button-text" href="<?php echo esc_url($gallery['demo_link']['url']); ?>" <?php echo esc_attr($gallery['demo_link']['is_external']) ? 'target="_blank"' : 'nofollow="nofollow"'; ?>>
										            	 	<?php echo esc_html($galleries['button_text']); ?>
										            	</a>
										            <?php else: ?>
										            	<a class="top-icon" href="<?php echo esc_url($gallery['demo_link']['url']); ?>" <?php echo esc_attr($gallery['demo_link']['is_external']) ? 'target="_blank"' : 'nofollow="nofollow"'; ?>>
										            	<a class="top-icon" href="<?php echo esc_attr($gallery['demo_link']['url']); ?>" <?php echo esc_attr($gallery['demo_link']['is_external']) ? 'target="_blank"' : 'nofollow="nofollow"'; ?>>
										            	 	<span class="fa fa-link"></span>
										            	</a>		
										            <?php endif; ?>
							            		<?php endif; ?>

								            	<?php if ($galleries['lightcase_enable'] == 'yes'):?>
													<a class="top-icon" href="<?php echo esc_url($gallery['gallery_thumb_image']['url']);?>" <?php echo esc_attr($galleries['lightcase_enable']) == 'yes'? ' wk-lightbox="animation:' . esc_attr($light_case_animation) . '"' : '';?>><span class="fa fa-search"></span></a>
												<?php endif; ?>
							            	</div>
						            	<?php endif; ?>
									</div>

						            <div class="wk-padding-small wk-text-<?php echo esc_attr($galleries['caption_align']);?> wk-gallery-body">
						               <?php if ($gallery['demo_link']['url']): ?>
						           		<a href="<?php echo esc_url($gallery['demo_link']['url']); ?>" <?php echo esc_attr($gallery['demo_link']['is_external']) ? 'target="_blank"' : 'nofollow="nofollow"'; ?>>
						            		<h5 class="wk-text-medium wk-margin-small wk-card-title wk-margin-remove-top"> <?php echo esc_html($gallery['gallery_title']);?>
						            		</h5>
										</a>
										<?php else: ?>
											<h5 class="wk-text-medium wk-margin-small wk-card-title wk-margin-remove-top"> 
												<?php echo esc_html($gallery['gallery_title']);?>
											</h5>
						            	<?php endif ;?>
						            	<?php if ($gallery['gallery_desc']): ?>
						            		<p class="wk-text-desc wk-margin-remove wk-padding-remove-top">
						            			<?php echo esc_html($gallery['gallery_desc']);?></p>	
						            	<?php endif; ?>
									</div> <!-- wk-body -->

					            <?php endif; ?>

			            </div> <!-- wk-card -->
		           <!--  </div> -->
		        </div> <!-- tags -->
	        <?php endforeach; ?>
	    </div>  <!-- contents -->
	</div> <!-- target -->

    <script>
        jQuery(function($){
            if(!$('body').hasClass('wk-gallery')){
                $('body').addClass('wk-gallery');
            }
        });
    </script>
