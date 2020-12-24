<?php
?>
<div class="wkfe-mailchimp-wrapper">

<form class="tx-newsletter-form-element" id="wkfe-mailchimp" action="https://github.us15.list-manage.com/subscribe/post?u=c9ced03a02309f56c1e8b3962&amp;id=4f935ae4b6" method="POST" accept-charset="utf-8">
    <div class="name">
        <label for="name">Name</label>
        <input type="text" name="name" id="name"/>
    </div>
    
    <div class="email">
        <label for="email">Email</label>
        <input type="email" name="email" required id="email" placeholder="<?php echo $form_input_placeholder_text ? $form_input_placeholder_text : "Type your mail here" ?>"/>
    </div>

    <div style="display:none;">
        <label for="hp">HP</label><br/>
        <input type="text" name="hp" id="hp"/>
    </div>

    <div class="submit">
        <input type="hidden" name="list" value="JWCUezitLOD05ELxz1eCvQ"/>
        <input type="hidden" name="subform" value="yes"/>
        <input type="submit" name="submit" id="submit" value="<?php echo $form_button_text ? $form_button_text : 'Submit'; ?>"/>
    </div>
</form>
    <div id="mailchimp-status"></div>
</div>
