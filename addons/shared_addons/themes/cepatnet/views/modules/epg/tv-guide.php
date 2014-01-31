<div style="margin:0 auto; width:960px;">
	<img src="{{theme:image_path}}tv-guide.png" style="width:359px;">
    
    <div class="sch-util" style="width:100%; background:#59A; margin:20px 0;">
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
    
    <div style="width:100%; background:#59A; margin:20px 0;">
	    <?php if($shows){ ?>
	    	<?php foreach($shows as $show){ ?>
	    		<div style="margin:10px 0; background:#FFF; padding:20px;">
	    			<h3><?php echo $show->ch->name; ?></h3>
	    			<ul>
	    		<?php if(!empty($show->sh)){ foreach($show->sh as $s){ ?>
	    				<li>
	    					<?php echo $s->time . ' | '; ?>
	    					<?php echo $s->duration . '<br/>'; ?>
	    					<?php echo $s->title . '<br/>'; ?>
	    					<?php echo $s->syn_id . '<br/>'; ?>
	    					<?php echo $s->syn_en . '<br/>'; ?>
	    				</li>
	    		<?php }}else{ echo 'No EPG Data'; } ?>
	    			</ul>
	    		</div>
	    	<?php } ?>
	    <?php }else{ ?>
	    	tv guide home
	    <?php } ?>	
    </div>
    
    <img src="http://www.cepat.net.id/tv/images/tvcable2.jpg">

</div>

