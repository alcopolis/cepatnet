<div style="margin:0 auto; width:960px;">
	<img src="http://www.cepat.net.id/tv/images/tvcable.jpg">
    
    <div style="width:100%; height:500px; background:#59A; margin:20px 0;">
    	<div class="sch-util">
	    	<p class="today"><?php echo date('d F Y'); ?></p>
	        <div class="sch-input">
	            <form method="get" action="/tv/index.php">
	            	<?php echo form_dropdown('ch', $ch, set_value('ch', '1')); ?>
	            	
	                <input type="text" value="29-01-2014" id="date" name="date" class="hasDatepicker"><img class="ui-datepicker-trigger" src="images/calendar.png" alt="..." title="...">
	                <input type="submit" value="view">
	            </form>
	        </div>
	        <div style="clear:both;"></div>
	    </div>
    </div>
    
    <img src="http://www.cepat.net.id/tv/images/tvcable2.jpg">

</div>

