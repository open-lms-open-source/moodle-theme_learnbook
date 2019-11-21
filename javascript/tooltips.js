$( document ).ready(function() {

    //set title/tooltip for all menu items
    $(".list-group-item-action").each(function(i, v) {
        var iconEl = $(this).children().find('.menu-title');
        if(iconEl.length >= 1)
        {
            var title = iconEl.attr('title');
            if(title)
                $(this).attr('title', title);
        }
    });

    $('button[aria-controls="nav-drawer"]').attr('title','Menu');

});