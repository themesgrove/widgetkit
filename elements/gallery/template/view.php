<?php
// Silence is golden.

    $galleries = $this->get_settings();
    $id = $this->get_id();
?>


	<div class="wk-gallery" wk-filter="target: .js-filter">
		<?php if ($galleries['filter_enable'] == 'yes'): ?>			
			 <ul class="wk-flex-center wk-margin-medium-bottom" wk-tab>
			 	<li class="wk-active" wk-filter-control><a href="#">All</a></li>
				<?php foreach ($galleries['gallery_content'] as $filter_tag) :?>
					<?php if ($filter_tag['gallery_filter']): ?>	
				        <li wk-filter-control="[data-tags*='<?php echo strtolower($filter_tag['gallery_filter']. '_'.$id) ;?>']">
				        	<a href="#"><?php echo $filter_tag['gallery_filter'];?></a>
				        </li>
					<?php endif; ?>
			    <?php endforeach; ?>
			</ul> <!-- filter tags -->
		<?php endif; ?>



	 	<div class="js-filter wk-grid-<?php echo $galleries['column_gap'];?> wk-text-center wk-child-width-1-<?php echo ($galleries['colmun_layout']+2);?>@xl wk-child-width-1-<?php echo $galleries['colmun_layout'];?>@m wk-child-width-1-1@s " wk-grid="masonry: true">
	 		<?php $i=5; ?>
	  		<?php foreach ($galleries['gallery_content'] as $gallery) :?>
	  			<?php $tags = explode(',', $gallery['filter_tag']);?>
		        <div class="wk-flex wk-flex-center wk-flex-middle wk-flex-<?php echo $gallery['item_order'];?>" data-tags="<?php foreach($tags as $tag ): echo strtolower($tag.'_'.$id) .' '; endforeach;?>">
		        <!-- 	<div class=""> -->
			            <div class="wk-card wk-card-default">
				            <?php if ($gallery['demo_link']): ?>
				           		<a href="<?php echo $gallery['demo_link']['url']; ?>" <?php echo $gallery['demo_link'] =='external' ? 'target="_blank"' : 'rel="nofolllow"'?> >
									<img src="<?php echo $gallery['gallery_thumb_image']['url']?>" alt="<?php echo $gallery['gallery_title'];?>" />
								</a>
							<?php else: ?>
				           			<img src="<?php echo $gallery['gallery_thumb_image'] ['url']?>" alt="<?php echo $gallery['gallery_title'];?>" />
				            <?php endif ;?>

				            <div class="wk-card-body wk-padding-remove">
				               <?php if ($gallery['link']): ?>
					           		<a href="<?php echo $gallery['link'] ?>" target="<?php echo $gallery['target'] ? '_blank' : ''?>">
					            		<h5 class="wk-text-medium wk-margin-small"> <?php echo $gallery['gallery_title'];?>
					            		<?php if ($gallery['label']): ?>
						            		<span class="wk-label"><?php echo $gallery['gallery_title'];?></span> 
					            		<?php endif; ?>
					            		</h5>

									</a>
								<?php else: ?>
									<h5 class="wk-text-medium wk-margin-small"> <?php echo $gallery['gallery_title'];?>
										<?php if ($gallery['label']): ?>
						            		<span class="wk-label"><?php echo $gallery['gallery_title'];?></span> 
					            		<?php endif; ?>
									</h5>
				            	<?php endif ;?>
				            	<?php if ($gallery['description']): ?>
				            		<p class="wk-text-small wk-margin-remove wk-padding-small wk-padding-remove-top"><?php echo $gallery['description'];?></p>	
				            	<?php endif; ?>
				            </div> <!-- wk-body -->
			            </div> <!-- wk-card -->
		           <!--  </div> -->
		        </div> <!-- tags -->
	        <?php $i++; endforeach; ?>
	    </div>  <!-- contents -->
	</div> <!-- target -->
