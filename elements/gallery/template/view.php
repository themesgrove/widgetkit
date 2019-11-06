<?php
// Silence is golden.

    $galleries = $this->get_settings();
    $id = $this->get_id();
    $light_case_animation = $galleries['lightcase_animation'];
?>


	<div class="wk-gallery" wk-filter="target: .js-filter">
		<?php if ($galleries['filter_enable'] == 'yes'): ?>
		<div class="wk-container wk-margin-auto">
			<ul class="wk-flex-<?php echo $galleries['filter_layout_align'];?> wk-margin-medium-bottom" wk-tab>
			 	<li class="wk-active" wk-filter-control><a href="#"><?php echo $galleries['filter_show_title'];?></a></li>
				 	<?php 
					 	$filters = array_unique(
					 		array_filter(
						 		array_map(function($item) {
						 			return isset($item['gallery_filter'])?$item['gallery_filter']:null;
						 		},
						 		 $galleries['gallery_content']),
						 		function($item) {return !!$item; }
					 		)
					 	); ?>
					<?php foreach ($filters as $filter_tag) : ?>
					   	<li wk-filter-control="[data-tags*='<?php echo strtolower($filter_tag. '_'.$id) ;?>']">
					        <a href="#"><?php echo $filter_tag; ?></a>
					    </li>
				    <?php endforeach; ?>
			</ul> <!-- filter tags -->
			
		</div>			

		<?php endif; ?>


			<?php if ($galleries['colmun_width'] == 'auto'):?>
				<div class="js-filter wk-grid-<?php echo $galleries['column_gap'];?> wk-text-center wk-child-width-<?php echo $galleries['colmun_width'];?> wk-margin-auto" wk-grid="masonry:<?php echo $galleries['masonary_enable'] == 'yes'? 'true' : 'false';?>" <?php echo $galleries['lightcase_enable'] == 'yes'? ' wk-lightbox="animation:' . '$light_case_animation' . '"' : '';?>  wk-grid>

			<?php else: ?>
				<div class="js-filter wk-grid-<?php echo $galleries['column_gap'];?> wk-text-center wk-child-width-<?php echo $galleries['colmun_layout'];?>" wk-grid="masonry:<?php echo $galleries['masonary_enable'] == 'yes'? 'true' : 'false';?>"  <?php echo $galleries['lightcase_enable'] == 'yes'? ' wk-lightbox="animation:' .'$light_case_animation' . '"' : '';?>  wk-grid>
			<?php endif; ?>
	  		<?php foreach ($galleries['gallery_content'] as $gallery) :?>
	  			<?php $tags = explode(',', $gallery['filter_tag']);?>
		        <div class="" data-tags="<?php foreach($tags as $tag ): echo strtolower($tag.'_'.$id) .' '; endforeach;?>">
		        <!-- 	<div class=""> -->
			            <div class="wk-card wk-card-default wk-position-relative wk-overflow-hidden">
				            <?php if ($gallery['gallery_thumb_image']): ?>
								<img src="<?php echo $gallery['gallery_thumb_image']['url']?>" alt="<?php echo $gallery['gallery_title'];?>">
				            <?php endif ;?>

				            <div class="wk-card-body wk-padding-small wk-position-absolute wk-position-center">
				               <?php if ($gallery['demo_link']['url']): ?>
				           		<a href="<?php echo $gallery['demo_link']['url']; ?>" <?php echo $gallery['demo_link']['is_external'] ? 'target="_blank"' : 'nofollow="nofollow"'; ?>>
				            		<h5 class="wk-text-medium wk-margin-small wk-card-title"> <?php echo $gallery['gallery_title'];?>
				            		</h5>
								</a>
								<?php else: ?>
									<h5 class="wk-text-medium wk-margin-small  wk-card-title"> 
										<?php echo $gallery['gallery_title'];?>
									</h5>
				            	<?php endif ;?>
				            	<?php if ($gallery['gallery_desc']): ?>
				            		<p class="wk-text-desc wk-margin-remove wk-padding-small wk-padding-remove-top">
				            			<?php echo $gallery['gallery_desc'];?></p>	
				            	<?php endif; ?>
				            	<?php if ($galleries['lightcase_enable'] == 'yes' || $galleries['link_enable'] == 'yes'):?>
				            		
					            	<div class="gallery-lightbox wk-margin-top">
					            		<?php if ($galleries['link_enable'] == 'yes'):?>
							            	<a class="icon" href="<?php echo $gallery['demo_link']['url']; ?>" <?php echo $gallery['demo_link']['is_external'] ? 'target="_blank"' : 'nofollow="nofollow"'; ?>>
							            		<span class="fa fa-angle-right"></span>
							            	</a>
						            	<?php endif; ?>
						            	<?php if ($galleries['lightcase_enable'] == 'yes'):?>
											<a class="uk-button uk-button-default icon" href="<?php echo $gallery['gallery_preview_image'] ['url']?>" uk-lightbox><span class="fa fa-link"></span></a>
										<?php endif; ?>
					            	</div>
				            	<?php endif; ?>
							</div> <!-- wk-body -->
			            </div> <!-- wk-card -->
		           <!--  </div> -->
		        </div> <!-- tags -->
	        <?php endforeach; ?>
	    </div>  <!-- contents -->
	</div> <!-- target -->
