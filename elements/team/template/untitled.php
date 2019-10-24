<?php
// Silence is golden.
    $team = $this->get_settings();

?>

<!--     <div class="wk-child-width-1-2@m" wk-grid>
        <div> -->
            <div class="wk-card wk-card-default">
                <div class="wk-card-media-top">
                    <img src="<?php echo $team['single_image']['url']; ?>" alt="">
                </div> <!-- wk-card-image -->

                 <div class="wk-card-body wk-padding-small">
                     <div class="wk-grid-small" wk-grid>
                         
                            <div class="wk-width-expand">
                                <?php if( $team['single_title']):?>
                                    <h3 class="wk-card-title wk-margin-remove"><?php echo $team['single_title']; ?></h3>
                                <?php endif; ?>
                            </div> <!-- wk-width-expand-->
                     

                        <div class="wk-width-auto social-icons">
                            <?php if ($team['single_facebook_link']): ?>
                                <a href="<?php echo $team['single_facebook_link']['url']; ?>"  <?php echo $team['single_facebook_link']['is_external']? 'target="_blank"' : '"rel="nofollow"'; ?>>
                                    <span wk-icon="facebook"></span>
                                </a>
                            <?php endif; ?>

                            <?php if ($team['single_twitter_link']): ?>
                                <a href="<?php echo $team['single_twitter_link']['url']; ?>" <?php echo $team['single_twitter_link']['is_external']? 'target="_blank"' : '"rel="nofollow"'; ?>>
                                    <span wk-icon="twitter"></span>
                                </a> 
                            <?php endif; ?>

                            <?php if ($team['single_linkedin_link']): ?>
                                <a href="<?php echo $team['single_linkedin_link']['url']; ?>" <?php echo $team['single_linkedin_link']['is_external']? 'target="_blank"' : '"rel="nofollow"'; ?>>
                                    <span wk-icon="linkedin"></span>
                                </a>
                            <?php endif; ?>
                        </div> <!-- wk-width-auto-->
                        <div>
                            <?php if( $team['single_designation']):?>
                                <span class="wk-card-designation"><?php echo $team['single_designation']; ?></span>
                            <?php endif; ?>

                            <?php if( $team['single_content']):?>
                                <p class="wk-text-normal wk-margin-remove"><?php echo $team['single_content']; ?></p>
                            <?php endif; ?>
                        </div>
                   
                    </div> <!-- wk-grid-samll-->
                </div> <!-- wk-card-body -->

            </div> <!-- wk-card-->
        <!-- </div> --><!-- end/div-->
    <!-- </div> --><!-- wk-grid-->


          <?php foreach ( $team['social_share'] as $social ) : ?>
                                    <a href="<?php echo $social['social_link']['url']; ?>"  
                                        <?php echo $social['social_link']['is_external']? 'target="_blank"' : '"rel="nofollow"'; ?>>
                                        
                                        <?php 
                                            $icon = explode(" ", $social['social_icon']);
                                            $social_name = explode('-', $icon['1']);
                                         ?>
                                        <span wk-icon="<?php echo $social_name[1]; ?>"></span>
                                    </a>
                                <?php endforeach; ?>



<div class="portfolio_classic_grid_wrapper tg_four_cols   portfolio-2 tile scale-anm course_tooltip  tooltipstered" data-tooltip-content="#tooltip_content_942"><div class="card__img" style="background-image:url(https://themegoods-cdn-pzbycso8wng.stackpathdns.com/coursector/wp-content/uploads/2019/04/overhead-shot-of-business-women-working-in-a-cafe-5TJ4HXB-700x466.jpg);">
    
</div>
<span class="card__price">$99.00</span>
<a href="https://themes.themegoods.com/coursector/courses/the-complete-financial-analyst-course/" class="card_link">
    <div class="card__img--hover" style="background-image:url(https://themegoods-cdn-pzbycso8wng.stackpathdns.com/coursector/wp-content/uploads/2019/04/overhead-shot-of-business-women-working-in-a-cafe-5TJ4HXB-700x466.jpg);">
        
    </div>
</a>



<div class="card__info">
    <div class="tooltip_templates">
        <div id="tooltip_content_942" class="course_tooltip_content">
            <h5>What you'll learn</h5>
            <div class="tooltip_templates_content">
                <ul class="quick-view-box--objectives--3GLJc">
                    <li class="fx-lt" data-purpose="quick-view-box-objective">
                        <div class="quick-view-box--objective-text--1ro4W">Work comfortably with Microsoft Excel</div>
                    </li>
                    <li class="fx-lt" data-purpose="quick-view-box-objective">
                        <div class="quick-view-box--objective-text--1ro4W">Format spreadsheets in a professional way</div>
                    </li>
                    <li class="fx-lt" data-purpose="quick-view-box-objective">
                        <div class="quick-view-box--objective-text--1ro4W">Be much faster carrying out regular tasks</div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <h3 class="card__title">
        <a href="https://themes.themegoods.com/coursector/courses/the-complete-financial-analyst-course/">The Complete Financial Analyst Course</a>
    </h3>
    <div class="card__rating">
        <div class="review-stars-rated">
            <div class="review-stars empty"></div>
            <div class="review-stars filled" style="width:80%;"></div>
        </div>
        <div class="card__rating_total"></div>
    </div>
    <div class="card__excerpt">
        <p>Polished finish elegant court shoe work duty stretchy slingback strap mid kitten heel this ladylike...</p>
    </div>


    <div class="card__meta_wrapper empty">
        <div class="card__meta">
            <span class="ti-agenda"></span>
            <span class="card__lesson">6 lessons </span>
        </div>
        <div class="card__meta">
            <span class="ti-user"></span>
            <span class="card__student">23 students</span>
        </div>
    </div>
</div>

