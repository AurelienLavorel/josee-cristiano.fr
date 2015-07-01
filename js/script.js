jQuery(document).ready(function() {
    jQuery('div.inner.content').css('margin-bottom', jQuery('div.mastfoot').height()+9);

    if ($('div.gridwall img').length) {
        jQuery(".fancybox").fancybox();

        var options =
        {
            srcNode: 'img',             // grid items (class, node)
            margin: '20px',             // margin in pixel, default: 0px
            width: '250px',             // grid item width in pixel, default: 220px
            max_width: '',              // dynamic gird item width if specified, (pixel)
            resizable: true,            // re-layout if window resize
            transition: 'all 0.5s ease' // support transition for CSS3, default: all 0.5s ease
        }
        $('div.gridwall').gridify(options);
    } else {
        jQuery('div.inner.content').css('margin-top', jQuery('div.masthead.clearfix').height()+9);
    }
})