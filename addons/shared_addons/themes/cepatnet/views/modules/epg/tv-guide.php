<div style="margin:0 auto; width:960px;">
	
    <div class="sch-util" style="width:100%; margin:20px 0;">
    	<img src="{{theme:image_path}}tv-guide.png" style="width:359px;">
    
    	<p class="today"><?php echo date('d F Y'); ?></p>
        <div class="sch-input">
            <form method="post" action="epg">
            	<?php echo form_dropdown('cid', $ch, set_value('cid', '1')); ?>
            	
                <input type="text" value="05-02-2014" id="date" name="date" class="hasDatepicker"><img class="ui-datepicker-trigger" src="images/calendar.png" alt="..." title="...">
                <input type="submit" value="view">
            </form>
        </div>
        <div style="clear:both;"></div>
    </div>
    
   
   <?php if($shows != NULL){ ?> 
   		
	   <table id="epg-tool" cellpadding="0" cellspacing="10" border="0" style="width:100%; margin:20px 0;">		   
		   		<?php if(!empty($shows->sh)){ ?>
		   			<?php foreach($shows->sh as $s){ ?>
		   			<tr class="show" style="border-bottom:1px dotted #999;">
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
	   </table>
	   	
	   <?php //var_dump($shows); ?>
   <?php }else{ ?>
	   <div style="min-height:300px;">Epg Home</div>
   <?php } ?>	 
    
    <img src="http://www.cepat.net.id/tv/images/tvcable2.jpg">

</div>