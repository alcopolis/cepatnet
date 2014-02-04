<div style="margin:0 auto; width:960px;">
	
    <div id="sch-util">
    	<img src="{{theme:image_path}}tv-guide.png" style="width:180px;">
    
        <div id="sch-input">
        	<p id="today"><?php echo date('d F Y'); ?></p>
            <form id="sch-filter" class="clearfix" method="post" action="epg">                
                <div class="filter">
					<label for="cid">Channel</label>
					<div class="input clearfix">
						<?php echo form_dropdown('cid', $ch, '', 'id="cid"'); ?>
					</div>
				</div>
				
				<div class="filter">
					<label for="date">Date</label>
					<div class="input"><?php echo form_input('date', set_value('date', date("Y-m-d")), 'id="date" class="datepicker" maxlength="20"'); ?></div>
				</div>
				
				<div class="filter">
					<label for="submit">&nbsp;</label>
					<?php echo form_submit('submit', 'View'); ?>
				</div>
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