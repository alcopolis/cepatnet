{{ post }}

<article class="post view">

	<h3 class="title">{{ title }}</h3>
	
	<div style="margin:10px 0;">
		<span class="meta date" title="Posted on">{{ helper:date timestamp=created_on }}</span><span class="meta author" title="author">{{ created_by:display_name }}</span>
	</div>

	<div class="body">
		{{ body }}
	</div>
		
	{{ if keywords }}
		<div class="meta keywords" title="keywords" style="border-top:1px dotted #CCC; padding-top:10px;">
			{{ keywords }}
				<span><a href="{{ url:site }}news/tagged/{{ keyword }}">{{ keyword }}</a></span>&nbsp;&nbsp;
			{{ /keywords }}
		</div>
	{{ endif }}
</article>

{{ /post }}

<?php if (Settings::get('enable_comments')): ?>

<div id="comments">

	<div id="existing-comments">
		<h4><?php //echo lang('comments:title') ?></h4>
		<?php //echo $this->comments->display() ?>
	</div>

	<?php if ($form_display): ?>
		<?php echo $this->comments->form() ?>
	<?php //else: ?>
	<?php //echo sprintf(lang('blog:disabled_after'), strtolower(lang('global:duration:'.str_replace(' ', '-', $post[0]['comments_enabled'])))) ?>
	<?php endif ?>
</div>

<?php endif ?>
