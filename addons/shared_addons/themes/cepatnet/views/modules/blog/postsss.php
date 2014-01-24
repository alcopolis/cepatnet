{{ if posts }}
    
	{{ posts }}
    
		<article class="post">

			<h3><a href="{{ url }}">{{ title }}</a></h3>

			<div class="meta">

                <div class="date">
                    {{ helper:lang line="blog:posted_label" }}
                    <span>{{ helper:date timestamp=created_on }}</span>
                </div>
    
                {{ if category }}
                <div class="category">
                    {{ helper:lang line="blog:category_label" }}
                    <span><a href="{{ url:site }}news/category/{{ category:slug }}">{{ category:title }}</a></span>
                </div>
                {{ endif }}
    
                {{ if keywords }}
                <div class="keywords">
                    {{ keywords }}
                        <span><a href="{{ url:site }}news/tagged/{{ keyword }}">{{ keyword }}</a></span>
                    {{ /keywords }}
                </div>
                {{ endif }}

			</div>

			<div class="preview clearfix">
            {{ if cover }}
    			<img class="left" data-pyroimage="true" src="uploads/default/files/{{ cover:filename }}" style="width:180px; height:auto; margin:0 10px 10px 0;" />
            {{ endif }}
            <p>{{ preview }}</p>
			</div>

			<p><a href="{{ url }}">{{ helper:lang line="blog:read_more_label" }}</a></p>

		</article>

	{{ /posts }}
	
	<div style="background:#000;">{{ pagination }}</div>
{{ else }}
	
	{{ helper:lang line="blog:currently_no_posts" }}

{{ endif }}