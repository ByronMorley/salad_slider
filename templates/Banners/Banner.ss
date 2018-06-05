<% with $Banner %>
    <% if $Slides %>
		<ul id="rs-$ID" class="rslide-init <% if $Kenburns %>kenburns-effect<% end_if %>" data-refine-opts='$dataOptions'>
            <% control $Slides.Sort('SortOrder', 'ASC')  %>
                $Me
            <% end_control %>
		</ul>
    <% end_if %>
<% end_with %>
