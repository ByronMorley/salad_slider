<% with $Slide %>
	<li data-options='$dataOptions'>
		<div class="rs-quotation">
            $Quote
            <% if $Author %>
				<span class="rs-author">$Author</span>
            <% end_if %>
            <% if $Organisation %>
				<span class="rs-organisation">$Organisation</span>
            <% end_if %>
		</div>
	</li>
<% end_with %>