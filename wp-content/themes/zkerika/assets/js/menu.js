(function ($) {
    "use strict";
    $(document).ready(function(){
        $(window).on('load', function () {
            cms_menu_touched_side();
        });
        $(window).on('resize', function (event, ui) {
            cms_menu_touched_side();
        });
        function cms_menu_touched_side(){
            var $menu = $('.main-nav');
            if($(window).width() > 1200 ){
                $menu.find('li').each(function(){
                    var $submenu = $(this).find('> .sub-menu');
                    if($submenu.length > 0){
                        if($submenu.offset().left + $submenu.outerWidth() > $(window).innerWidth()){
                            $submenu.addClass('back');
                        } else if($submenu.offset().left < 0){
                            $submenu.addClass('back');
                        }
                        /* remove style from mobile to desktop menu */
                        $submenu.attr('style','');
                    }            
                });
            }
        }
        /* Menu drop down */
        $('.cms-main-navigation li.menu-item-has-children > a').after('<span class="cms-menu-toggle" onclick=""><i class="fa fa-angle-right"></i></span>');
        $('.cms-menu-toggle').live('click', function(){
            menu_click($(this));
        });
        function menu_click(target) {
            var grand =  target.parents('.cms-main-navigation');
            var ignore = [];
            ignore.push(target[0]);
            target.parents('.sub-menu').each(function () {
                if($(this).prev().hasClass('cms-menu-toggle'))
                    ignore.push($(this).prev()[0]);
            });
            grand.find('.cms-menu-toggle').each(function () {
                if(ignore.indexOf(this) !== -1)
                    return;
                deactive_menu($(this));
            });
            var icon = target.find('.fa');
            var is_downed = (icon.hasClass('fa-angle-down')) ? true : 0;
            if(!is_downed)
                active_menu(target);
            else
                deactive_menu(target);

        }
        function deactive_menu(target) {
            target.next('.sub-menu').slideUp();
            target.find('.fa').removeClass('fa-angle-right fa-angle-down').addClass('fa-angle-right');
        }
        function active_menu(target) {
            target.next('.sub-menu').slideDown();
            target.find('.fa').addClass('fa-angle-down').removeClass('fa-angle-right');
        }
    });

})(jQuery);