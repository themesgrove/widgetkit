<?php
// Silence is golden.

    $galleries = $this->get_settings();
    $id = $this->get_id();
?>


	<div class="wk-gallery" wk-filter="target: .js-filter">
		<?php if ($galleries['filter_enable'] == 'yes'): ?>			
			 <ul class="wk-flex-<?php echo $galleries['filter_layout_align'];?> wk-margin-medium-bottom" wk-tab>
			 	<li class="wk-active" wk-filter-control><a href="#"><?php echo $galleries['filter_show_title'];?></a></li>
				 	<?php $filters = array_unique(
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
		<?php endif; ?>


			<?php if ($galleries['colmun_width'] == 'auto'):?>
				<div class="js-filter wk-grid-<?php echo $galleries['column_gap'];?> wk-text-center wk-child-width-<?php echo $galleries['colmun_width'];?> wk-margin-auto" wk-grid="masonry: true" wk-lightbox="animation:scale" wk-grid>

			<?php else: ?>
				<div class="js-filter wk-grid-<?php echo $galleries['column_gap'];?> wk-text-center wk-child-width-<?php echo $galleries['colmun_layout'];?> " wk-grid="masonry: true" wk-lightbox="animation:scale" wk-grid>
			<?php endif; ?>

	 		<?php $i=5; ?>
	  		<?php foreach ($galleries['gallery_content'] as $gallery) :?>
	  			<?php $tags = explode(',', $gallery['filter_tag']);?>
		        <div class="wk-flex wk-flex-center wk-flex-middle wk-flex-<?php echo $gallery['item_order'];?>" data-tags="<?php foreach($tags as $tag ): echo strtolower($tag.'_'.$id) .' '; endforeach;?>">
		        <!-- 	<div class=""> -->
			            <div class="wk-card wk-card-default wk-position-relative wk-overflow-hidden">
				            <?php if ($gallery['gallery_thumb_image']): ?>
								<img src="<?php echo $gallery['gallery_thumb_image']['url']?>" alt="<?php echo $gallery['gallery_title'];?>" />
				            <?php endif ;?>

				            <div class="wk-card-body wk-padding-small wk-position-absolute wk-position-center">
				               <?php if ($gallery['demo_link']['url']): ?>
				           		<a href="<?php echo $gallery['demo_link']['url']; ?>" target="<?php echo $gallery['target'] ? '_blank' : ''?>">
				            		<h5 class="wk-text-medium wk-margin-small wk-card-title"> <?php echo $gallery['gallery_title'];?>
				            		<?php if ($gallery['label']): ?>
					            		<span class="wk-label"><?php echo $gallery['gallery_title'];?></span> 
				            		<?php endif; ?>
				            		</h5>

								</a>
								<?php else: ?>
									<h5 class="wk-text-medium wk-margin-small  wk-card-title"> <?php echo $gallery['gallery_title'];?>
										<?php if ($gallery['label']): ?>
						            		<span class="wk-label"><?php echo $gallery['gallery_title'];?></span> 
					            		<?php endif; ?>
									</h5>
				            	<?php endif ;?>
				            	<?php if ($gallery['gallery_desc']): ?>
				            		<p class="wk-text-desc wk-margin-remove wk-padding-small wk-padding-remove-top"><?php echo $gallery['gallery_desc'];?></p>	
				            	<?php endif; ?>
				            	<div class="gallery-lightbox wk-margin-top">
					            	<a class="icon" href="<?php echo $gallery['demo_link']['url']; ?>">
					            		<span class="fa fa-angle-right"></span>
					            	</a>
									<a class="uk-button uk-button-default icon" href="<?php echo $gallery['gallery_preview_image'] ['url']?>" uk-lightbox><span class="fa fa-link"></span></a>
				            	</div>
							</div> <!-- wk-body -->
			            </div> <!-- wk-card -->
		           <!--  </div> -->
		        </div> <!-- tags -->
	        <?php $i++; endforeach; ?>
	    </div>  <!-- contents -->
	</div> <!-- target -->
