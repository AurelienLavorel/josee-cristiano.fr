jQuery(document).ready(function() {
    jQuery('div.inner.content').css('margin-top', jQuery('div.masthead.clearfix').height()+9);
    jQuery('div.inner.content').css('margin-bottom', jQuery('div.mastfoot').height()+9);
    jQuery(".fancybox").fancybox();
})