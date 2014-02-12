{{ if posts }}
        	
    {{ posts }}
    	{{ if category:slug == "news" }}
	        <article class="post">
	
	            <h3><a href="{{ url }}">{{ title }}</a></h3>
	
	            <div class="meta">
	
	                <div class="date">
	                    <span>{{ helper:date timestamp=created_on }}</span>
	                </div>
	    
	                {{ if category and category:slug != "news" }}
		                <div class="category">
		                    {{ helper:lang line="blog:category_label" }}
		                    <span><a href="{{ url:site }}news/category/{{ category:slug }}">{{ category:title }}</a></span>
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
        {{ else }}
        	 <h3><a href="{{ url }}">{{ title }}</a></h3>           
        {{ endif }}
    {{ /posts }}
    
    {{ pagination }}
	
{{ else }}
	
	{{ helper:lang line="blog:currently_no_posts" }}

{{ endif }}