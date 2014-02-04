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
    
   
   <?php if($shows){ ?> 
   <table id="epg-tool" cellpadding="0" cellspacing="0" border="0" style="width:100%; margin:20px 0;">
   	   <?php foreach($shows as $show){ ?>
	   
	   		<?php if(!empty($show->sh)){ ?>
	   			<?php foreach($show->sh as $s){ ?>
	   			<tr class="show">
	   				<td><h3><?php echo $s->time; ?></h3></td>
	   				<td>
	   					<h3><?php echo $s->title; ?></h3>
	   					<span class="dur"><?php echo $s->duration; ?></span>
	   					<p class="syn_id"><?php echo $s->syn_id; ?></p>
	   					<p class="syn_en"><?php echo $s->syn_en; ?></p>
	   				</td>
	   			</tr>
	   			<?php } ?>
	   		<?php }else{ ?>		
	   			<h3>No Data</h3>
	   		<?php } ?>
	   		
	   <?php } ?>
   </table>
   <?php } ?>	 
    
    <img src="http://www.cepat.net.id/tv/images/tvcable2.jpg">

</div>

