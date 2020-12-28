<?php
?>
<div class="wkfe-mailchimp-wrapper">
    <div id="mailchimp-status"></div>
    <form class="tx-newsletter-form-element" action="#" id="wkfe-mailchimp" method="POST">
        <div class="name" style="display:none;">
            <label for="name">Name</label>
            <input type="text" name="name" id="name"/>
        </div>

        <div class="email">
            <label for="email" style="display:none;">Email</label>
            <input 
            class="mailchimp_email_field"
            type="email" 
            name="email" 
            id="email" 
            required 
            />
        </div>

        <div style="display:none;">
            <label for="hp">HP</label><br/>
            <input type="text" name="hp" id="hp"/>
        </div>

        <div class="submit">
            <?php wp_nonce_field('wkfe-ajax-security-nonce'); ?>
            <input type="submit" name="submit" id="submit" value="<?php echo $form_button_text ? $form_button_text : 'Submit'; ?>"/>
        </div>
    </form>
</div>
