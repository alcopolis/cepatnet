{{ if posts }}
        	
    {{ posts }}
    	{{ if category:slug == "news" }}
	        <article class="post-item">
	
	            <h3 class="title"><a href="{{ url }}">{{ title }}</a></h3>
	
                <div class="meta date">
                    <span>{{ helper:date timestamp=created_on }}</span>
                </div>
    
                {{ if category and category:slug != "news" }}
	                <div class="category">
	                    {{ helper:lang line="blog:category_label" }}
	                    <span><a href="{{ url:site }}news/category/{{ category:slug }}">{{ category:title }}</a></span>
	                </div>
                {{ endif }}
	
	            <div class="preview clearfix">
		            {{ if cover:id }}
		                <img class="left" data-pyroimage="true" src="{{ url:site }}files/large/{{ cover:id }}" style="width:180px; height:auto; margin:0 10px 10px 0;" />
		            {{ endif }}
	            	<p>
	            		{{ preview }}
	            		<span class="more"><a href="{{ url }}">&nbsp;&nbsp;{{ helper:lang line="blog:read_more_label" }}</a></span>
	            	</p>
	            </div>
	        </article>
        {{ elseif category:slug == "career" }}
	        <article class="post-item view" style="margin:0; padding:0 10px;">
			
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
        {{ else }}
        	 <h3><a href="{{ url }}">{{ title }}</a></h3>
        {{ endif }}
    {{ /posts }}
    
    <!-- {{ pagination }} -->
	
{{ else }}
	
	{{ helper:lang line="blog:currently_no_posts" }}

{{ endif }}