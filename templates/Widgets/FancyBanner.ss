<% if $Slides %>
	<ul id="rs-1" data-refine-opts='$dataOptions'>
        <% loop $Slides %>
			<li>
				<img src="$Image.filename" class="$DarkenImage " alt=""/>
                <% if $Caption %>
					<div class="container">
						<div class="rs-caption $CaptionLocation">
							<div class="rs-caption-title">
								<span>$CaptionTitle<% if $CustomExtTitle %><span>.<span>$CaptionExtTitle</span></span><% end_if %></span>
							</div>
							<div class="rs-caption-content xxs-hide xs-hide">
                                $CaptionContent
							</div>
                            <% if $CaptionButtonLink %>
								<button class="rs-caption-button" href="$ButtonLink" onclick="">$ButtonLinkText</button>
                            <% end_if %>
						</div>
					</div>
                <% end_if %>
			</li>
        <% end_loop %>
	</ul>
<% end_if %>
