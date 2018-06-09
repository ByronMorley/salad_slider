<% with $Banner %>
    <% if $Slides %>
        <% require css('salad-slider/css/style.min.css') %>
        <% require javascript('components/jquery/jquery.min.js') %>
        <% require javascript('salad-slider/js/main.js') %>
		<ul id="rs-$ID" class="rslide-init <% if $Kenburns %>kenburns-effect<% end_if %>" data-refine-opts='$dataOptions'>
            <% control $Slides.Sort('SortOrder', 'ASC')  %>
                $Me
            <% end_control %>
		</ul>
    <% end_if %>
<% end_with %>
