<% with $Slide %>
	<li data-options='$dataOptions'>
		<img src="$Image.filename" class="$DarkenImage " alt=""/>
        <% if $Caption %>
			<div class="container">
				<div class="rs-caption $CaptionLocation">
					<div class="rs-caption-title">
						<span>$CaptionTitle<% if $CustomExtTitle %>
							<span>.<span>$CaptionExtTitle</span></span><% end_if %></span>
					</div>
					<div class="rs-caption-content">
                        $CaptionContent
					</div>
                    <% if $CaptionLink %>
						<button class="rs-caption-button" onclick="window.location.href='$CaptionLink.SiteTree.Link'"
                                <% if $OpenInNewWindow %>target="_blank"<% end_if %> >$CaptionLink.Title</button>
                    <% end_if %>
				</div>
			</div>
        <% end_if %>
	</li>
<% end_with %>