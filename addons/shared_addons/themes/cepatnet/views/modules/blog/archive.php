<h2 id="page_title" style="color:#0C223F; border-bottom:3px solid #CCC; padding:10px 10px 0 10px; text-shadow:0 -1px 1px #CCC; text-align:right;">{{ helper:lang line="blog:archive_title" }} - {{ month_year }}</h2>

{{ if posts }}

	{{ posts }}	    
		
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
	
	            <p class="more"><a href="{{ url }}">{{ helper:lang line="blog:read_more_label" }}</a></p>
        	</article>	           
        
	{{ /posts }}

	{{ pagination }}

{{ else }}
	
	{{ helper:lang line="blog:currently_no_posts" }}

{{ endif }}