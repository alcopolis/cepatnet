<div id="subscribe-ack" class="left">	
	<div style="text-align:center;">
		<img data-pyroimage="true" src="{{theme:image_path }}sales.png" style="width:200px; height:300px;" />
	    
	    <div style="margin-top:30px;">
	    	<img src="{{theme:image_path}}hotline.png" title="Hotline 31998600" style="margin-top:0;"/>
        	<p style="color:#999; font-size:12px;">Please Call For More Info</p>
        </div>
    </div>
</div>

<div id="subscribe-content" class="left">
	<div id="container" class="clearfix">
		
		<?php echo form_open('subscribe', 'id="subscriber-form" class="crud"'); ?>
	        <div id="form-container" class="left">
	        	<div id="subscribe-form" class="form-input clearfix">
	        		<p style="margin-left:50px; font-size:12px; color:#999;">Please complete the form so our Sales Force can contact you and give you assistance.</p>
	            
	                <ul class="form">
	                    <li class="<?php echo alternator('', 'even'); ?>">
	                        <label for="name">Name <span>*</span></label>
	                        <div class="input"><?php echo form_input('name', set_value('name', $subscriber->name), 'class="width-15"'); ?><?php echo form_error('name'); ?></div>
	                    </li>
	                    
	                    <li class="<?php echo alternator('', 'even'); ?>">
	                        <label for="email">Email <span>*</span></label>
	                        <div class="input"><?php echo form_input('email', set_value('email', $subscriber->email), 'class="width-15"'); ?><?php echo form_error('email'); ?></div>
	                    </li>
	                    
	                    <li class="<?php echo alternator('', 'even'); ?>">
	                        <label for="company">Company <span>*</span></label>
	                        <div class="input"><?php echo form_input('company', set_value('company', $subscriber->email), 'class="width-15"'); ?><?php echo form_error('company'); ?></div>
	                    </li>
	                    
	                    <li class="<?php echo alternator('', 'even'); ?>">
	                        <label for="address">Address <span>*</span></label>
	                        <div class="input">
	                            <?php
	                                $txtarea = array(
	                                    'name' => 'address',
	                                    'value' => set_value('address', $subscriber->address),
	                                    'rows' => '5',
	                                    'cols' => '50'
	                                );
	                                
	                                echo form_textarea($txtarea);
	                                echo form_error('address');
	                            ?>
	                        </div>
	                    </li>
	                    
	                     <li class="<?php echo alternator('', 'even'); ?>">
	                        <label for="services">Product / Services</label>
	                        <div class="input">
	                        	<select name="services">
	                        		<option value="no-selection">- Select -</option>
	                        		{{pages:children id="6"}}
	                        			<option value="{{title}}">{{title}}</option>
	                        		{{/pages:children}}
	                        	</select>
	                        </div>
	                    </li>
	                    
	                    <li class="<?php echo alternator('', 'even'); ?>">
	                    	<label for="phone">Phone <span>*</span></label>
	                    	<div class="input"><?php echo form_input('phone', set_value('phone', $subscriber->phone), 'class="width-15"'); ?><?php echo form_error('phone'); ?></div>
	                    </li>
	                    
	                    <li class="<?php echo alternator('', 'even'); ?>">
	                        <label for="mobile">Mobile</label>
	                        <div class="input"><?php echo form_input('mobile', set_value('mobile', $subscriber->mobile), 'class="width-15"'); ?><?php echo form_error('mobile'); ?></div>
	                    </li>
	                    
	                    <li class="<?php echo alternator('', 'even'); ?>" style="margin:30px 20px 20px 40px;"><?php echo form_submit('subscribe', 'Submit'); ?></li>
	                </ul>
	                
	                <p style="padding:10px 50px 0 50px; font-family:Arial, Verdana, Geneva, sans-serif; font-size:10px;"><span>*</span><strong> Required</strong></p>
	            </div>	
	        </div>
	    <?php echo form_close(); ?>
		
	</div>
</div>

<script type="text/javascript">
$(document).ready(function(){
	
});
</script>
