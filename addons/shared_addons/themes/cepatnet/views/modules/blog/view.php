{{ post }}

<article class="post">

	<h3>{{ title }}</h3>
		
	{{ if category:slug == "news" }}
		<div class="meta">
			<div class="date">
				{{ helper:lang line="blog:posted_label" }}
				<span>{{ helper:date timestamp=created_on }}</span>
			</div>
	
			<div class="author">
				{{ helper:lang line="blog:written_by_label" }}
				<span><a href="{{ url:site }}user/{{ created_by:user_id }}">{{ created_by:display_name }}</a></span>
			</div>
	
<!-- 			<div class="category"> -->
<!-- 				{{ helper:lang line="blog:category_label" }} -->
<!-- 				<span><a href="{{ url:site }}blog/category/{{ category:slug }}">{{ category:title }}</a></span> -->
<!-- 			</div> -->
	
			{{ if keywords }}
				<div class="keywords">
					Tags &raquo; &nbsp;&nbsp; 
					{{ keywords }}
						<span><a href="{{ url:site }}news/tagged/{{ keyword }}">{{ keyword }}</a></span>&nbsp;|&nbsp;
					{{ /keywords }}
				</div>
			{{ endif }}
		</div>
	{{ endif }}

	<div class="body">
		{{ body }}
	</div>

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
