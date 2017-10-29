/**
 * @package ZookaStudio
 * @subpackage ZK Erika
 * @since 1.0.0
*/
jQuery(document).ready(function($) {
    "use strict";
    /* window */
    var window_width, window_height, scroll_top;
    var cms_responsiveRefreshRate = 200;
    /* admin bar */
    var adminbar = $('#wpadminbar'),
        adminbar_height = 0;
    /* Loading */
    var loading_page = $('#cms-loading'),
        loading_page_h = 0;
    /* rev before header */
    var rev_before_header = $('.cms-header-rev-slider'),
        rev_before_header_h = 0;
    /* header top */
    var  header_top = $('#cms-header-top'),
         header_top_height = 0;
    /* header menu */
    var header = $('#cms-header'),
        header_height;
    /* Header v2 */
    var header_inner = $('#cms-header > .container'),
        cms_logo = $('#cms-header-logo'),
        cms_navigation_left = $('#cms-navigation-left'),
        cms_navigation_right = $('#cms-navigation-right'),
        cms_navigation_attr = $('#cms-header .cms-nav-extra'),
        center_menu = $('#cms-navigation.pull-center .cms-main-navigation > ul'),
        header_inner_w,
        cms_logo_w, 
        cms_navigation_left_width, 
        cms_navigation_right_width, 
        cms_navigation_attr_width,
        center_menu_w;

    /* scroll status */
    var scroll_status = '';

    /* Call Bootstrap Popover */
    $('[data-toggle="popover"]').popover();

    /**
     * window load event.
     * 
     * Bind an event handler to the "load" JavaScript event.
     * @author Chinh Duong Manh
     */
    $(window).on('load', function() {
        /** current scroll */
        scroll_top = $(window).scrollTop();

        /** current window width */
        window_width = window.innerWidth;

        /** current window height */
        window_height = window.innerHeight;

        /* get admin bar height */
        adminbar_height = adminbar.length > 0 ? adminbar.outerHeight(true) : 0 ;
        /* get loading height */
        loading_page_h = loading_page.length > 0 ? loading_page.outerHeight(true) : 0 ;
        /* rev before header */
        rev_before_header_h = rev_before_header.length > 0 ? rev_before_header.outerHeight() : 0;
        /* Header Top */
        header_top_height = header_top.length   > 0 ?  header_top.outerHeight() : 0;
        /* Header */
        header_height = header.length   > 0 ?  header.outerHeight() : 0;
        /* Header V2 */
        header_inner_w = header_inner.length > 0 ? header_inner.innerWidth() : 0;
        cms_logo_w = cms_logo.length > 0 ? cms_logo.outerWidth() : 0;
        cms_navigation_left_width = cms_navigation_left.length > 0 ? cms_navigation_left.outerWidth() : 0;
        cms_navigation_right_width = cms_navigation_right.length > 0 ? cms_navigation_right.outerWidth() : 0;
        cms_navigation_attr_width = cms_navigation_attr.length > 0 ? cms_navigation_attr.outerWidth() : 0;
        center_menu_w = center_menu.length > 0 ? center_menu.innerWidth() : 0;
        /* Page Loading */
        cms_page_loading();

        /* Header OnTop */
        cms_header_ontop();
        cms_header_ontop_next();
        /* Header Sticky */
        cms_header_sticky();
        /* Mobile Menu */
        cms_mobile_menu();
        cms_join_mobile_menu();
        cms_header_right_width();
        /* Change PrettyPhoto gallery rel to data-rel, data-gal*/
        if(typeof $.prettyPhoto != 'undefined'){
            $("a[data-gal^='prettyPhoto']").prettyPhoto({hook: 'data-gal'});
            $("a[data-rel^='prettyPhoto']").prettyPhoto({hook: 'data-rel'});
        }
        /* width / height for iframe/video/audio */
        cms_auto_video_width();
        cms_switch_blog_grid_wide();
        cms_overlay();
        cms_link_color();

        /* WooCommerce */
        zkmetric_wc_archive_layout();
    });

    /**
     * reload event.
     * 
     * Bind an event handler to the "navigate".
     */
    window.onbeforeunload = function(){
        cms_page_loading(1);
    };
    
    /**
     * resize event.
     * 
     * Bind an event handler to the "resize" JavaScript event, or trigger that event on an element.
     * @author Chinh Duong Manh
     */
    var cms_resize_menu_event ;
    $(window).on('resize', function(event, ui) {
        clearTimeout(cms_resize_menu_event);
        cms_resize_menu_event = setTimeout(function () {
            /** current window width */
            window_width = $(event.target).width();

            /** current window height */
            window_height = $(window).height();
            /* get admin bar height */
            adminbar_height = adminbar.length > 0 ? adminbar.outerHeight(true) : 0 ;
            /* get loading height */
            loading_page_h = loading_page.length > 0 ? loading_page.outerHeight(true) : 0 ;
            /* rev before header */
            rev_before_header_h = rev_before_header.length > 0 ? rev_before_header.outerHeight() : 0;
            /* Header Top */
            header_top_height = header_top.length   > 0 ?  header_top.outerHeight() : 0;

            /* Header */
            header_height = header.length   > 0 ?  header.outerHeight() : 0;
            /* Header V2 */
            header_inner_w = header_inner.length > 0 ? header_inner.innerWidth() : 0;
            cms_logo_w = cms_logo.length > 0 ? cms_logo.outerWidth() : 0;
            cms_navigation_left_width = cms_navigation_left.length > 0 ? cms_navigation_left.outerWidth() : 0;
            cms_navigation_right_width = cms_navigation_right.length > 0 ? cms_navigation_right.outerWidth() : 0;
            cms_navigation_attr_width = cms_navigation_attr.length > 0 ? cms_navigation_attr.outerWidth() : 0;
            center_menu_w = center_menu.length > 0 ? center_menu.innerWidth() : 0;
            /** current scroll */
            scroll_top = $(window).scrollTop();
            /* Header OnTop */
            cms_header_ontop();
            /* Header Sticky */
            cms_header_sticky();
            /* Mobile Menu */
            cms_mobile_menu();
            cms_join_mobile_menu();
            cms_header_right_width();
        },cms_responsiveRefreshRate);
    });
    
    /**
     * scroll event.
     * 
     * Bind an event handler to the "scroll" JavaScript event, or trigger that event on an element.
     * @author Chinh Duong Manh
     */
    $(window).on('scroll', function() {
        /** current scroll */
        scroll_top = $(window).scrollTop();

        /* check sticky menu. */
        cms_header_sticky();

        /* Back to top */
        cms_back_to_top();
    });
    /**
     * Page Loading.
     */
    function cms_page_loading($load) {
        switch ($load) {
        case 1:
            $('#cms-loading').css('{"height":"100vh"}');
            $('#cms-page').css({"visibility":"hidden"});
            break;
        default:
            $('#cms-loading').css({"height":"0","visibility":"hidden"})
            $('#cms-page').css({"visibility":"visible"});
            break;
        }
    }
    /* Custom a tag regular/hover/active color
     * This function just applied for a tag
     * @author Chinh Duong Manh
     * @since 1.0.0
    */
    function cms_link_color(){
        "use strict";
        $('body').find('a').each(function(){
            var $this = $(this),
                $filter = $('.cms-filter-category');
            if($this.attr('data-color')){
                var regular_color   = $(this).data('color'),
                    hover_color     = $(this).data('color-hover'),
                    active_color    = hover_color;

                $(this).css('color',regular_color);
                $this.on('mouseenter',function(e){
                    e.preventDefault();
                    $(this).css('color',hover_color);
                });
                $this.on('mouseleave',function(e){
                    e.preventDefault();
                    $(this).not('.active').css('color',regular_color);
                });
                if($this.hasClass('active')){
                    $(this).css('color', active_color);
                };
                $this.on('click',function(){
                   $filter.find('a').css('color',regular_color);
                   $(this).css('color', active_color);
                });
            }
        });
    }

    /** Header On Top
     * add TOP position for header on top
     * @author Chinh Duong Manh
     * @since 1.0.0
    */
    
    function cms_header_ontop(){
        var header_ontop = $('.header-ontop'),
            header_ontop_next = $('#cms-page-title-wrapper'),
            header_ontop_next_padding_top = parseInt(header_ontop_next.css('padding-top'));
        header_ontop.css('top', adminbar_height + header_top_height); 
    }
    function cms_header_ontop_next(){
        var header_ontop = $('.header-ontop'),
            header_ontop_next = header_ontop.next('#cms-page-title-wrapper'),
            header_ontop_next_padding_top = parseInt(header_ontop_next.css('padding-top'));
        header_ontop_next.css('padding-top', adminbar_height + header_ontop_next_padding_top); /* Add padding for next section */
    }

    /** Sticky menu
     * Show or hide sticky menu.
     * @author Chinh Duong Manh
     * @since 1.0.0
     */
    function cms_header_sticky() {
        var header_sticky = $('.header-sticky'),
            header_ontop  = $('.header-ontop'), 
            header_slider = $('.cms-header-rev-slider').outerHeight();
        if (header.hasClass('sticky-on') && (header_height + header_slider  < scroll_top) && window_width > 1200) {
            header.addClass('header-sticky').removeClass('header-default');
            header_sticky.css('top',adminbar_height);
        } else {
            header.removeClass('header-sticky').addClass('header-default');
            header_sticky.removeAttr('style');
        }

        /* Both Ontop & Sticky is ENABLE */
        if (header.hasClass('header-ontop-sticky') && (header_height + header_slider  < scroll_top) && window_width > 1200) {
            header.removeClass('header-ontop');
        } else if(header.hasClass('header-ontop-sticky')){
            header.removeClass('header-sticky').addClass('header-ontop');
            header_sticky.css('top', adminbar_height + header_top_height);
        }     
    }
    /* check mobile screen. */
    function cms_mobile_menu() {
        if (window_width <= 1200) {
            /* Default Header */
            $('div.cms-main-navigation').addClass('mobile-nav').removeClass('desktop-nav');
        } else {
            /* Default Header */
            $('div.cms-main-navigation').removeClass('mobile-nav').addClass('desktop-nav').removeAttr('style');
        }
    }
    /** Menu right
     * add width for menu area when Menu right has extra attribute (search, cart, ...)
     * @author Chinh Duong Manh
     * @since 1.0.0
     */
    function cms_header_right_width() {
        if (window_width >= 1200){
            cms_navigation_right.css('width', header_inner_w - cms_navigation_left_width - cms_logo_w - cms_navigation_attr_width);
        } else{
            cms_navigation_right.css('width','');
        }
    }
    /**
     * Header 2 menu
    */
    function cms_join_mobile_menu() {
        var menu = $('#cms-navigation');

        if (window_width <= 1200) {
            /* Add mobile menu for Header V2 */
            var $mainmenu_left = $('#cms-navigation-left .cms-menu-left');
            var $mainmenu_right = $('#cms-navigation-right .cms-menu-right');
            var $mobilemenu_1 = $mainmenu_left.clone();
            var $mobilemenu_2 = $mainmenu_right.clone();
            //if ($('#cms-navigation .cms-main-navigation').length == 0) {
                $mobilemenu_1.appendTo('#cms-navigation .cms-main-navigation');
                $mobilemenu_2.appendTo('#cms-navigation .cms-main-navigation');
            //}
            $('#cms-navigation-left').addClass('d-none');
            $('#cms-navigation-right').addClass('d-none');
            $('#cms-navigation-left ul.cms-menu-left').remove();
            $('#cms-navigation-right ul.cms-menu-right').remove();
        } else {
            /* Callback Menu Left */
            var $mainmenu_left = $('#cms-navigation .cms-menu-left');
            var $mobilemenu_1 = $mainmenu_left.clone();
            $mobilemenu_1.appendTo('#cms-navigation-left div.cms-main-navigation');
            $('#cms-navigation-left').removeClass('d-none');
            /* Callback Menu Right */
            var $mainmenu_right = $('#cms-navigation .cms-menu-right');
            var $mobilemenu_2 = $mainmenu_right.clone();
            $('#cms-navigation-right').removeClass('d-none');
            $mobilemenu_2.appendTo('#cms-navigation-right div.cms-main-navigation');
            /* Remove joined Left/Right Menu */
            $('.join-menu .cms-main-navigation').empty();
        }
    }
    /**
     * Scroll page 
     * @author Chinh Duong Manh
    */
    $('body').on('click', '.cms-scroll, .woocommerce-review-link, .is-one-page', function () {
        var target = $(this.hash),
            offset = $('.header-sticky').innerHeight();
        target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
        if (target.length) {
            $('html,body').animate({scrollTop: target.offset().top}, 750);
            return false;
        }
    });
    
    /* Show or hide Back to TOP  */
    function cms_back_to_top(){
        if (scroll_top < window_height) {
            $('.cms-backtotop').removeClass('on');;
        } else {
            $('.cms-backtotop').addClass('on');
        }
    }

    /**
    * header icon popup
    * 
    * @author Chinh Duong Manh
    * @since 1.0.0
    */
    var display;
    var no_display; 
    $('body').on('click',function (e) {
        var target = $(e.target);
        if (target.parents('.cms-tools').length == 0 && !target.hasClass('cms-search')) {
            $('.cms-search,.cms-cart,.cms-tools').removeClass('open').slideUp();
            $('.sidebar-menu').removeClass('open');
            $('.cms-body').removeClass('sidebar-menu-open');
        }
    });
    
    $('.cms-search,.cms-cart,.cms-tools, .mobile-nav').on('click', function (e) {
        e.stopPropagation();
    });

    $('.cms-header-popup [data-display]').on('click', function (e) {
        var container = $(this).parents('#cms-header');
        var sidebar_menu_container = $(this).parents('.cms-body');
        $(this).parents().find('.mobile-nav').slideUp();
        e.stopPropagation();
        
        var _this = $(this);
        display = _this.attr('data-display');
        no_display = _this.attr('data-no-display');
        if ($(display, container).hasClass('open')) {
            $(display, container).removeClass('open').slideUp();
        } else {
            $(display, container).addClass('open').slideDown().css('display', 'block');
            $(no_display, container).removeClass('open').slideUp();
        }
    });
    $('.cms-header-popup [data-display=".sidebar-menu"]').on('click', function (e) {
        var container = $(this).parents('#cms-header');
        var sidebar_menu_container = $(this).parents('.cms-body');
        $(this).parents().find('.mobile-nav').slideUp();
        e.stopPropagation();
        
        var _this = $(this);
        display = _this.attr('data-display');
        no_display = _this.attr('data-no-display');

        if ($(sidebar_menu_container).hasClass('sidebar-menu-open')) {
            sidebar_menu_container.removeClass('sidebar-menu-open');
            $(display, sidebar_menu_container).removeClass('open');
        } else {
            sidebar_menu_container.addClass('sidebar-menu-open');
            sidebar_menu_container.find('> .sidebar-menu').addClass('open');
            $(no_display, container).removeClass('open').slideUp();
        }
    });
    
    $('.cms-header-popup .header-icon').on('click', function(){
        $('.popup .cms-searchform .s').focus();
    });

    /**
     * Edit the count on the categories widget
     * @author Chinh Duong Manh
     * @since 1.0.0
     * @param element parent
    */

    $.fn.extend({
        cmsReplaceCount: function(is_woo){
            this.each(function(){
                if (is_woo == true) {
                    $(this).find('span.count').each(function(){
                        var count =  $(this).text();
                        var appendTo = $(this).parent().find('> a');
                        $(this).appendTo(appendTo);
                    })  
                } else {
                    $(this).find(' > ul > li').each(function() {
                        var cms_li = $(this);
                        cms_li.removeClass('recentcomments');
                        var small = $(this).html().replace('</a>&nbsp;(','&nbsp;<span class="count">(').replace(')',')</span></a>').replace('</a> (','<span class="count">&nbsp;(');
                        cms_li.html(small);
                        $(this).find(' .children li').each(function() {
                            var sm = $(this).html().replace('</a>&nbsp;(','&nbsp;<span class="count">(').replace(')',')</span></a>').replace('</a> (','<span class="count">&nbsp;(');
                            $(this).html(sm);
                            $(this).find(' .children li').each(function() {
                             var s = $(this).html().replace('</a>&nbsp;(','&nbsp;<span class="count">(').replace(')',')</span></a>').replace('</a> (','<span class="count">&nbsp;(');
                             $(this).html(s);
                            })
                        })
                    });
                }
            })
        }
    });
    /* replace span.count to small */
    $('.widget_archive, .widget_categories').cmsReplaceCount(false);
    $('.product-categories, .widget_layered_nav ul').cmsReplaceCount(true);

    /**
     * Auto width video iframe
     * 
     * Youtube, Vimeo, Iframe, Video, Audio.
     * @author Chinh Duong Manh
     */
    function cms_auto_video_width() {
        $('.entry-media iframe , .entry-media  video, .entry-media .wp-video-shortcode').each(function(){
            var v_width = $(this).parent().width();
            var v_height = Math.floor(v_width / (16/9));
            $(this).attr('height',v_height).css('height',v_height);
            $(this).attr('width',v_width).css('width',v_width);
        });
        $('.video-item').each(function(){
            var v_width = $(this).parent().width();
            var v_height = Math.floor(v_width / (16/9));
            $(this).css('height',v_height);
            $(this).css('width',v_width);
        });
        $('.entry-content iframe , .entry-content  video, .entry-content .wp-video-shortcode').each(function(){
            var v_width = $(this).parent().width();
            var v_height = Math.floor(v_width / (16/9));
            $(this).attr('height',v_height).css('height',v_height);
            $(this).attr('width',v_width).css('width',v_width);
        });
    }
    /**
     * Blog switch Grid/ Wide
     */
    var blog_view_content = $('.cms-blog-switch-view-content');
    blog_view_content.each(function () {
        var view_plane_styles = {
            target:$(this),
            styles:[]
        };
        view_plane_styles.styles.push(['height','auto']);
        var origin_styles =[];
        var origin_styles_obj_added =[];
        origin_styles.push(view_plane_styles);
        origin_styles_obj_added.push(this);
        $(this).parent().data('origin_styles',origin_styles);
        $(this).parent().data('origin_styles_obj_added',origin_styles_obj_added);
    });
    var cms_grid_specical_position_data = [];
    function cms_switch_blog_to_grid_specical_position_assign(group_obj)
    {
        if(!group_obj)
            return;
        if(group_obj.data('is_grid_view') !== true)
            return;
        if(cms_grid_specical_position_data.indexOf(group_obj[0]) < 0)
            cms_grid_specical_position_data.push(group_obj[0]);
        var origin_styles = (group_obj.data('origin_styles')) ? group_obj.data('origin_styles') : [];
        var origin_styles_obj_added = (group_obj.data('origin_styles_obj_added')) ? group_obj.data('origin_styles_obj_added') : [];
        var view_content_plan = group_obj.find('.cms-blog-switch-view-content');
        if(view_content_plan.attr('data-masonry') !== 'true')
            return;
        var plan_width = view_content_plan.innerWidth();
        if(plan_width <= view_content_plan.children().first().outerWidth())
        {
            return;
        }
        var current_pos = {top:0,left:0};
        var next_line_pos = [];
        var data_position = [];
        var is_first_line =true;
        view_content_plan.children().each(function (index) {
            var _this = $(this);
            next_line_pos.push({
                left:current_pos.left,
                top:current_pos.top+_this.outerHeight(),
                used:false
            });
            data_position.push({
                target:_this,
                left:current_pos.left,
                top:current_pos.top
            });
            if( current_pos.left + (_this.outerWidth()-1)*2 >= plan_width)
                is_first_line = false;
            if(is_first_line)
            {
                current_pos.left+= _this.outerWidth();
            }
            else
            {
                var min_height_pos = {left:null,top:999999};
                var prev_item = null;
                next_line_pos.forEach(function (item) {
                    if(item.used || (min_height_pos.top <= item.top))
                        return;
                    min_height_pos.left = item.left;
                    min_height_pos.top = item.top;
                    item.used = true;
                    if(prev_item)
                        prev_item.used = false;
                    prev_item = item;
                });
                current_pos = min_height_pos;
            }
        });
        var max_height = 0;
        data_position.forEach(function (item) {
            if(origin_styles_obj_added.indexOf(item.target[0]) === -1)
            {
                var element_raw_styles = {
                    target: item.target
                    ,styles:[]
                };
                element_raw_styles.styles.push(['position',view_content_plan.css('position')]);
                element_raw_styles.styles.push(['top',view_content_plan.css('top')]);
                element_raw_styles.styles.push(['left',view_content_plan.css('left')]);
                origin_styles.push(element_raw_styles);
                origin_styles_obj_added.push( item.target[0]);
            }
            item.target.css('position','absolute');
            item.target.css('left',item.left);
            item.target.css('top',item.top);
            max_height = Math.max(max_height,item.top + item.target.outerHeight());
        });
        view_content_plan.css('height',max_height);
        view_content_plan.find('img').last().load(function () {
            cms_switch_blog_to_grid_specical_position_assign(group_obj);
        });
    }
    var request_resize;
    var cms_resize_grid_handle = function () {
        $.each(cms_grid_specical_position_data,function (index,group) {
            cms_switch_blog_to_grid_specical_position_assign($(group));
        });
    },cms_resize_grid_realse = function () {
        $.each(cms_grid_specical_position_data,function (index,group) {
            cms_switch_blog_to_grid_specical_position_rollback($(group));
        });
    };


    $(window).on('resize',function () {
        clearTimeout(request_resize);
        if(window.innerWidth < 992)
            cms_resize_grid_realse();
        else
            request_resize = setTimeout(cms_resize_grid_handle,cms_responsiveRefreshRate)
    });

    function cms_switch_blog_to_grid_specical_position_rollback(group_obj) {
        var origin_styles = (group_obj.data('origin_styles')) ? group_obj.data('origin_styles') : [];
        $.each(origin_styles,function (index,item) {
            item.styles.forEach(function (style) {
                item.target.css(style[0],style[1])
            });
        });
    }

    var switch_view_obj = $('.blog-switch-view');
    function cms_switch_blog_grid_wide(){
        switch_view_obj.each(function () {
            var _this = $(this);
            _this.on('click', '.wide', function () {
                _this.find('a').removeClass('active');
                $(this).addClass('active');
                _this.parent().find('.cms-blog-switch-view-content').animate({opacity:0},100,'linear',function () {
                    cms_switch_blog_to_wide($(this).parent(),true);
                    _this.parent().find('.cms-blog-switch-view-content').animate({opacity:1},200)
                });

            });
            _this.on('click', '.list', function () {
                _this.find('a').removeClass('active');
                $(this).addClass('active');
                _this.parent().find('.cms-blog-switch-view-content').animate({opacity:0},100,'linear',function () {
                    cms_switch_blog_to_grid($(this).parent(),true);
                    _this.parent().find('.cms-blog-switch-view-content').animate({opacity:1},200)
                });
            });
        });
    }
    /**
     * init state if exist
     */
    jQuery('[data-masonry="true"]').each(function () {
        var _this = $(this);
        var _current_state = _this.parent().find('.blog-switch-view >a[class*="active"]').hasClass('wide') ? 'wide' : 'list';
        if(_current_state =='list')
            cms_switch_blog_to_grid(_this.parent());
    });
    if(typeof zkmetric_view_state != 'undefined' && zkmetric_view_state[window.location.href] != null && switch_view_obj.length > 0)
    {
        var _data_state =    zkmetric_view_state[window.location.href];
        jQuery.each(_data_state,function (index,value) {
            var _this = $($('.blog-switch-view >a[class*="active"]')[index]).parent();
            var _current_state = value;
            _this.find('a').removeClass('active');
            _this.find('.'+_current_state).addClass('active');
            if(_current_state == 'wide')
                cms_switch_blog_to_wide(_this.parent());
            if(_current_state =='list')
                cms_switch_blog_to_grid(_this.parent());
        });
    }
    var switch_view_obj_data_parse = [];
    switch_view_obj.each(function () {
        var content_area = $(this).parent().find('.cms-blog-switch-view-content')
        switch_view_obj_data_parse.push({
            target: content_area,
            length:content_area.children().length
        });
    });
    if(switch_view_obj.length >0)
    {
        jQuery(document).ajaxComplete(function(event, xhr, settings){
            $.each(switch_view_obj_data_parse,function () {
               var new_length = this.target.children().length;
               if(new_length != this.length)
               {
                   if(this.target.parent().find('.blog-switch-view >a[class*="active"]').hasClass('wide'))
                       cms_switch_blog_to_wide(this.target.parent());
                   else
                       cms_switch_blog_to_grid(this.target.parent());
                   this.length = new_length;
               }
            });
        });
    }
    var cms_switch_blog_to_grid_masory_timeout;
    function cms_switch_blog_to_wide(group_obj,is_click){
        if(typeof group_obj == 'undefined')
            return;
        clearTimeout(cms_switch_blog_to_grid_masory_timeout);
        group_obj.data('is_grid_view',false);
        var _view_content = group_obj.find('.cms-blog-switch-view-content');
        cms_switch_blog_to_grid_specical_position_rollback(group_obj);
        _view_content.find('.switch-item').removeClass('col-md-12 col-md-6 col-md-4').addClass('col-md-12');
        _view_content.find('.switch-item > .entry-archive').removeClass('entry-standard').addClass('entry-list');
        _view_content.find('.entry-archive > .row > .entry-media').addClass('col-sm-4');
        _view_content.find('.entry-media + .entry-info').addClass('col-sm-8');
        if(is_click === true)
            zkmetric_save_view_state('wide');
        cms_switch_blog_to_wide_extends_handle(group_obj);
    }
    function cms_switch_blog_to_grid(group_obj,is_click){
        if(typeof group_obj == 'undefined')
            return;
        clearTimeout(cms_switch_blog_to_grid_masory_timeout);
        group_obj.data('is_grid_view',true);
        var _view_content = group_obj.find('.cms-blog-switch-view-content');
        var data_col =  _view_content.attr('data-col');
        _view_content.find('.switch-item').removeClass('col-md-12 col-md-6 col-md-4').addClass('col-md-'+((data_col+'' === '2') ? 6 : 4  ));
        _view_content.find('.switch-item > .entry-archive').removeClass('entry-list').addClass('entry-standard');
        _view_content.find('.entry-archive > .row > .entry-media').removeClass('col-sm-4').addClass('col-sm-12');
        _view_content.find('.entry-media + .entry-info').removeClass('col-sm-8').addClass('col-sm-12');
        if(is_click === true)
            zkmetric_save_view_state('list');
        cms_switch_blog_to_grid_extends_handle(group_obj);
        if(is_click === true)
            cms_switch_blog_to_grid_masory_timeout = setTimeout(function () {
                cms_switch_blog_to_grid_specical_position_assign(group_obj);
            },400);
        else
            cms_switch_blog_to_grid_specical_position_assign(group_obj);
    }

    function cms_switch_blog_to_grid_extends_handle(group_obj) {
        var _view_content = group_obj.find('.cms-blog-switch-view-content');
        _view_content.find('article').each(function () {
            var _this = $(this);
            if(_this.find('.entry-media').find('img').length < 1 || _this.find('.entry-info').find('header').length < 1 || _this.find('.entry-summary').length <1)
                return;
            _this.find('img').after(_this.find('header'));
        });
    }
    function cms_switch_blog_to_wide_extends_handle(group_obj) {
        var _view_content = group_obj.find('.cms-blog-switch-view-content');
        _view_content.find('article').each(function () {
            var _this = $(this);
            if(_this.find('.entry-media').find('img').length < 1 || _this.find('.entry-media').find('header').length < 1 || _this.find('.entry-summary').length <1)
                return;
            _this.find('.entry-summary').before(_this.find('header'));
        });
    }
    function zkmetric_save_view_state(state) {
        var data_state = {};
        jQuery('.blog-switch-view >a[class*="active"]').each(function (index) {
            data_state[index]= ($(this).hasClass('wide')) ? 'wide' : 'list';
        });
        jQuery.post(ajaxurl,
            {
                action:'zkmetric_store_view_state',
                data:{
                    url: window.location.href,
                    state:data_state
                }
            }
        );
    }
    /* Add overlay effect
     * add class animated to use animate.css
    */
    function cms_overlay(){
        "use strict";
        $(".overlay-wrap").each(function(){
            var $this = $(this);
            var animation_in = $this.find('.overlay').data('item-animation-in'),
                animation_out = $this.find('.overlay').data('item-animation-out');
            $this.find('.overlay').parent().css({'position':'relative'});
            $this.on('mouseenter',function(e){
                e.preventDefault();
                $this.find('.overlay').addClass(animation_in).removeClass(animation_out);
            });
            $this.on('mouseleave',function(e){
                e.preventDefault();
                $this.find('.overlay').removeClass(animation_in).addClass(animation_out);
            });
        });
    }
    /* Ajax Complete */
    jQuery(document).ajaxComplete(function(event, xhr, settings){
        /* width / height for iframe/video/audio */
        cms_auto_video_width();
        cms_overlay();
        /* Change PrettyPhoto gallery rel to data-rel, data-gal*/
        if(typeof $.prettyPhoto != 'undefined'){
            $("a[data-gal^='prettyPhoto']").prettyPhoto({hook: 'data-gal'});
            $("a[data-rel^='prettyPhoto']").prettyPhoto({hook: 'data-rel'});
        }
    });

    /**
     * paginate handle
     */
    /**
     * paginate for shortcode
     */
    var loadmore_shortcode_ajax_running = [];
    var loadmore_shortcode_infinite_invalid = [];
    var loadmore_shortcode_click_element = $('.zkmetric-loadmore-click-handle');
    if(loadmore_shortcode_click_element.length >0)
    {
        loadmore_shortcode_click_element.each(function () {
            var _this = $(this);
            _this.on('click',function () {
                zkmetric_loadmore_shortcode_click_event_handle(_this);
            });
            zkmetric_loadmore_shortcode_click_init_state(_this);
        });

    }
    var loadmore_shortcode_infinite_element = $('.zkmetric-loadmore-infinite-handle');
    if(loadmore_shortcode_infinite_element.length >0)
    {
        loadmore_shortcode_infinite_element.each(function () {
            var _this = $(this);
            jQuery(window).on('scroll',function () {
                zkmetric_loadmore_shortcode_infinite_event_handle(_this);
            });
            zkmetric_loadmore_shortcode_infinite_init_state(_this);
        });
    }
    function zkmetric_loadmore_shortcode_infinite_init_state(obj) {
        var _current_page = parseInt(obj.attr('data-paged'));
        var _max_page = parseInt(obj.attr('data-max-page'));
        if(isNaN(_current_page))
        {
            _current_page = parseInt(zkmetric_get_query_var(window.location.href,'paged',1));
        }
        if(_current_page >= _max_page)
        {
            zkmetric_loadmore_shortcode_state_handle(obj,'no-more');
            loadmore_shortcode_infinite_invalid.push(obj[0]);
        }
        else
        {
            zkmetric_loadmore_shortcode_state_handle(obj,'has-more');
        }
        zkmetric_loadmore_shortcode_infinite_event_handle(obj)
    }
    function zkmetric_loadmore_shortcode_infinite_event_handle(obj) {
        var _loadmore_element = $(obj);
        if(!_loadmore_element.is(':in_viewport'))
        {
            return;
        }
        var _content_area =  _loadmore_element.parent().find('.cms-blog-switch-view-content');
        if(loadmore_shortcode_infinite_invalid.indexOf(_loadmore_element[0]) != -1)
        {
            return;
        }
        if(loadmore_shortcode_ajax_running.indexOf(_loadmore_element[0]) != -1)
        {
            return;

        }
        var _current_page = parseInt(_loadmore_element.attr('data-paged'));
        var _max_page = parseInt(_loadmore_element.attr('data-max-page'));
        if(isNaN(_current_page))
        {
            _current_page = parseInt(zkmetric_get_query_var(window.location.href,'paged',1));
            _current_page++;
        }
        else
            _current_page++;
        var next_state = (_current_page >= _max_page) ? 'no-more' : 'has-more';
        _loadmore_element.attr('data-paged',_current_page);
        zkmetric_loadmore_shortcode_state_handle(_loadmore_element,'loading');
        zkmetric_loadmore_shortcode_get_more_posts({
            paged:_current_page,
            content_area:_content_area,
            loadmore_element:_loadmore_element,
            success:function () {
                zkmetric_loadmore_shortcode_state_handle(_loadmore_element,next_state);
                if(next_state == 'no-more')
                    loadmore_shortcode_infinite_invalid.push(_loadmore_element[0]);
            },
            fail:function () {
                zkmetric_loadmore_shortcode_state_handle(_loadmore_element,'no-more');
                loadmore_shortcode_infinite_invalid.push(_loadmore_element[0]);
            },
            done:function () {
                zkmetric_loadmore_shortcode_infinite_event_handle(_loadmore_element);
            }
        });
    }
    function zkmetric_loadmore_shortcode_click_init_state(obj) {
        var _current_page = parseInt(obj.attr('data-paged'));
        var _max_page = parseInt(obj.attr('data-max-page'));
        if(isNaN(_current_page))
        {
            _current_page = parseInt(zkmetric_get_query_var(window.location.href,'paged',1));
        }
        if(_current_page >= _max_page)
        {
            zkmetric_loadmore_shortcode_state_handle(obj,'no-more');
            obj.unbind('click');
        }
        else
        {
            zkmetric_loadmore_shortcode_state_handle(obj,'has-more');
        }
    }
    function zkmetric_loadmore_shortcode_state_handle(obj,state){
        $(obj).find('[data-state*="zkmetric-loadmore-state"]').each(function () {
            var this_state = $(this).attr('data-state').replace('zkmetric-loadmore-state-','');
            if(this_state == state)
                $(this).show();
            else
                $(this).hide();
        });
    }
    function zkmetric_loadmore_shortcode_click_event_handle(obj) {
        var _loadmore_button = $(obj);
        if(loadmore_shortcode_ajax_running.indexOf(_loadmore_button[0]) != -1) {
            return;
        }
        var _content_area = _loadmore_button.parent().find('.cms-blog-switch-view-content');
        var _current_page = parseInt(_loadmore_button.attr('data-paged'));
        var _max_page = parseInt(_loadmore_button.attr('data-max-page'));
        if(isNaN(_current_page))
        {
            _current_page = parseInt(zkmetric_get_query_var(window.location.href,'paged',1));
            _current_page++;
        }
        else
            _current_page++;
        var next_state = (_current_page >= _max_page) ? 'no-more' : 'has-more';
        _loadmore_button.attr('data-paged',_current_page);
        zkmetric_loadmore_shortcode_state_handle(_loadmore_button,'loading');
        zkmetric_loadmore_shortcode_get_more_posts({
            paged:_current_page,
            loadmore_element:_loadmore_button,
            content_area:_content_area,
            success:function () {
                zkmetric_loadmore_shortcode_state_handle(_loadmore_button,next_state);
                if(next_state == 'no-more')
                    _loadmore_button.unbind('click');
            },
            fail:function () {
                zkmetric_loadmore_shortcode_state_handle(_loadmore_button,'no-more');
                _loadmore_button.unbind('click');
            }
        });
    }
    function zkmetric_loadmore_shortcode_get_more_posts(args) {
        var content_area = args['content_area'];
        var loadmore_element = args['loadmore_element'];
        if(loadmore_shortcode_ajax_running.indexOf(loadmore_element[0]) != -1)
            return;
        loadmore_shortcode_ajax_running.push(loadmore_element[0]);
        var paged = args['paged'];
        var callback_success = args['success'];
        var callback_fail =  args['fail'];
        var callback_done =  args['done'];
        var content_area_index = 0;

        jQuery('.cms-blog-switch-view-content').each(function (index) {
            if(this == content_area[0])
                content_area_index = index;
        });
        var _next_url = zkmetric_add_query_var_url(window.location.href,'paged',paged);
        jQuery.get(_next_url).success(function (data) {
            var new_post = jQuery(jQuery(data).find('.cms-blog-switch-view-content')[content_area_index]).children();
            new_post.each(function () {
                $(this).appendTo(content_area);
                zkmetric_loadmore_on_add_element_event( $(this));
            });
            if(new_post.length>0 && typeof callback_success == 'function')
                callback_success();
            if(new_post.length<1 && typeof callback_fail == 'function')
                callback_fail();
        }).fail(function () {
            if(typeof callback_fail == 'function')
                callback_fail();
        }).done(function () {
            loadmore_shortcode_ajax_running.splice(loadmore_shortcode_ajax_running.indexOf(loadmore_element[0]),1);
            if(typeof callback_done == 'function')
                callback_done();
        });
    }
    function zkmetric_loadmore_on_add_element_event(obj) {
        var defaul_animate = 'fadeIn';
        var animate = obj.attr('data-animation-in');
        if(typeof animate != 'string' || animate.length < 1)
            animate = defaul_animate;
        zkmetric_clear_animation_assign(obj);
        obj.addClass('animated');
        obj.addClass(animate);
        zkmetric_callback_event_handle(obj,true);
        $(window).on('scroll',function () {
            zkmetric_callback_event_handle(obj);
        });
    }

    /**
     * callback animate
     */
    $(window).on('scroll',function () {
        zkmetric_callback_event_handle('*');
    });
    /**
     * filter handle
     */
    $('.cms-grid-filter a[data-filter]').on('click',function (e) {
        e.preventDefault();
        var _this = $(this);
        var _parent = _this.parents('.cms-grid-wraper');
        _parent.find('a[data-filter]').removeClass('active');
        _this.addClass('active');
        var target_filter= _this.attr('data-filter');
        var max_count = (_this.attr('data-max-count')) ? parseInt(_this.attr('data-max-count')) : 0 ;
        if(target_filter.length < 1)
            return;
        var type_filter_all = ['all','*'];
        if(jQuery.inArray(target_filter,type_filter_all) === -1 && _parent.find('.'+target_filter+'[class*="cms-grid-item"]').length >= max_count)
        {
            _parent.find('div[class*="zkmetric-loadmore"][class*="handle"]').hide();
        }
        else
        {
            _parent.find('div[class*="zkmetric-loadmore"][class*="handle"]').show();
        }
        zkmetric_filter_event_handle(_parent);
    });
    $('.cms-grid-wraper').each(function () {
        if($(this).find('.cms-grid-filter').length < 1)
            return;
        zkmetric_filter_event_data.push(this);
    });
    jQuery(document).ajaxComplete(function(event, xhr, settings){
        zkmetric_filter_event_data.forEach(function (item) {
            zkmetric_filter_event_handle(item,true);
        });
    });

    //Woocomere filter modify
    $(window).on('load',function () {
        $('.price_slider_wrapper ').each(function () {
            var _this = $(this);
            if(_this.find('.ui-slider-handle').length < 2)
                return;
            var from = _this.find('.price_label .from'),
                to = _this.find('.price_label .to'),
                handle_left = $(_this.find('.ui-slider-handle')[0]),
                handle_right = $(_this.find('.ui-slider-handle')[1]);
            _this.find('.price_label').hide();
            handle_left.attr('data-title',from.html());
            handle_right.attr('data-title',to.html());
            from.on('DOMSubtreeModified',function () {
                handle_left.attr('data-title',$(this).html());
            });
            to.on('DOMSubtreeModified',function () {
                handle_right.attr('data-title',$(this).html());
            });
        });
    });

});
if(typeof ajaxobj != 'undefined' && typeof ajaxurl == 'undefined')
{
    var ajaxurl= ajaxobj.ajaxurl;
}
jQuery.expr.filters.in_viewport = function(el) {
    var rect = el.getBoundingClientRect();
    return (
        (rect.top + rect.height) > 0 && rect.top < window.innerHeight
        && (rect.left + rect.width) > 0 && rect.left < window.innerWidth
    );
};

var zkmetric_filter_event_data = [],zkmetric_filter_hide_event_data=[];
function zkmetric_filter_event_handle(target,force_hidden) {
        zkmetric_filter_hide_event_data.forEach(function (item) {
            zkmetric_clear_animation_assign(item[0]);
            clearTimeout(item[1]);
        });
    zkmetric_filter_hide_event_data = [];
        var grid = jQuery(target);
        var current_filter = grid.find('a[data-filter][class*="active"]').attr('data-filter');
        if(current_filter.length < 1)
            return;
        var type_filter_all = ['all','*'];
        if(jQuery.inArray(current_filter,type_filter_all) > -1)
        {
            grid.find('.cms-grid-item').each(function () {
                if(!jQuery(this).is(':visible'))
                    zkmetric_do_filter_animation({
                        type:'in',
                        target:this
                    });
            });
        }
        else
            grid.find('.cms-grid-item').each(function () {
                var _this = jQuery(this);
                if(_this.is(':visible'))
                {
                    if(!_this.hasClass(current_filter))
                    {
                        !(force_hidden) ? zkmetric_do_filter_animation({
                                    type:'out',
                                    target:this
                                }) : _this.hide();

                    }

                }
                else
                {
                    if(_this.hasClass(current_filter))
                        zkmetric_do_filter_animation({
                            type:'in',
                            target:this
                        });
                }
            });
}
function zkmetric_do_filter_animation(args) {
    if(typeof args !== 'object')
        return;
    var type = args.type;
    if(!(type === 'in' || type === 'out'))
        return;
    var target = jQuery(args.target);
    var default_animation_in = 'fadeIn';
    var default_animation_out = 'fadeOut';
    var animation_in = (target.attr('data-animation-in')) ? target.attr('data-animation-in') : default_animation_in;
    var animation_out = (target.attr('data-animation-out')) ? target.attr('data-animation-out') : default_animation_out;
    zkmetric_clear_animation_assign(target);
    if(type === 'in')
    {
        target.show();
        zkmetric_callback_event_handle(target);
        // target.addClass('animated');
        // target.addClass(animation_in);
        // zkmetric_callback_event_handle(target,true);
    }else
    {
        target.addClass('animated');
        target.addClass(animation_out);
        zkmetric_filter_hide_event_data.push([target,
            setTimeout(function () {
                target.hide();
                zkmetric_callback_event_handle('*');
            },500)]
        );
    }
}
var zkmetric_callback_event_data = [];
function zkmetric_callback_event_handle(target,just_add){
    if(target === '*')
    {
        jQuery('[data-animation-in]').each(function () {
            var _this = jQuery(this);
            zkmetric_callback_event_handle(_this);
        });
        return;
    }
    var obj=jQuery(target);
    if(just_add === true)
    {
        if(zkmetric_callback_event_data.indexOf(obj[0]) === -1)
            zkmetric_callback_event_data.push(obj[0]);
        return;
    }
    if(obj.is(':in_viewport')){
        if(zkmetric_callback_event_data.indexOf(obj[0]) !== -1)
            return;
        else
            zkmetric_callback_event_data.push(obj[0]);
    }
    else {
        if(zkmetric_callback_event_data.indexOf(obj[0]) != -1)
            zkmetric_callback_event_data.splice(zkmetric_callback_event_data.indexOf(obj[0]),1);
        return;
    }
    var defaul_animate='fadeIn';
    var animate = obj.attr('data-animation-in');
    if(typeof animate != 'string' || animate.length < 1)
        animate = defaul_animate;
    zkmetric_clear_animation_assign(obj);
    var old_opacity = obj.css('opacity');
    if(isNaN(old_opacity))
        old_opacity = 1;
    obj.css('opacity',0);
    obj.css('opacity',old_opacity);
    obj.addClass('animated');
    obj.addClass(animate);
}
function zkmetric_clear_animation_assign(target) {
    var class_animate = "animated none bounce flash pulse rubberBand shake swing tada wobble bounceIn bounceInDown bounceInLeft bounceInRight bounceInUp bounceOut bounceOutDown bounceOutLeft bounceOutRight bounceOutUp fadeIn fadeInDown fadeInDownBig fadeInLeft fadeInLeftBig fadeInRight fadeInRightBig fadeInUp fadeInUpBig fadeOut fadeOutDown fadeOutDownBig fadeOutLeft fadeOutLeftBig fadeOutRight fadeOutRightBig fadeOutUp fadeOutUpBig flip flipInX flipInY flipOutX flipOutY lightSpeedIn lightSpeedOut rotateIn rotateInDownLeft rotateInDownRight rotateInUpLeft rotateInUpRight rotateOut rotateOutDownLeft rotateOutDownRight rotateOutUpLeft rotateOutUpRight hinge rollIn rollOut zoomIn zoomInDown zoomInLeft zoomInRight zoomInUp zoomOut zoomOutDown zoomOutLeft zoomOutRight zoomOutUp slideInDown slideInLeft slideInRight slideInUp slideOutDown slideOutLeft slideOutRight slideOutUp";
    jQuery(target).removeClass(class_animate);
    jQuery(target).css('opacity',1);
}
function zkmetric_get_query_var(url,param_name,default_value) {
    var arr_url = url.split('?');
    if(arr_url.length == 1)
        return default_value;
    var arr_params = arr_url[1].split('&');
    for(var i=0;i<arr_params.length ; i++)
    {
        var param_args = arr_params[i].split('=');
        if(param_args.length < 2)
            continue;
        if(param_args[0] == param_name)
            return param_args[1]
    }
    return default_value;
}
function zkmetric_add_query_var_url(url,param,value) {
    var arr_url = url.split('?');
    if(arr_url.length == 1)
        return url+"?"+param+'='+value;
    var arr_params = arr_url[1].split('&');
    var raw_result = arr_url[0]+'?';
    var is_param_added = false;
    var count_params_add = 0;
    for(var i=0;i<arr_params.length ; i++)
    {
        var param_args = arr_params[i].split('=');
        if(param_args.length < 2)
            continue;
        if(i>0)
            raw_result+='&';
        count_params_add++;
        if(param_args[0] == param )
        {
            raw_result+= param+'='+value;
            is_param_added = true;
            continue;
        }
        raw_result+=param_args[0]+'='+param_args[1];
    }
    if(is_param_added)
        return raw_result;
    if(count_params_add>0)
        raw_result+='&';
    return raw_result + param+'='+value;
}
/**
 * WC Switch view 
 * add swith view grid/list layout 
*/
function zkmetric_wc_archive_layout(){
    jQuery('.wc-archive-switch-view #grid').click(function() {
        jQuery(this).addClass('active');
        jQuery('.wc-archive-switch-view #list').removeClass('active');
        jQuery.cookie('gridcookie','grid', { path: '/' });
        jQuery('ul.products').fadeOut(300, function() {
            jQuery(this).addClass('grid').removeClass('list').fadeIn(300);
            jQuery(this).find('.woocommerce-product-details__short-description').hide();
        });
        return false;
    });

    jQuery('.wc-archive-switch-view #list').click(function() {
        jQuery(this).addClass('active');
        jQuery('.wc-archive-switch-view #grid').removeClass('active');
        jQuery.cookie('gridcookie','list', { path: '/' });
        jQuery('ul.products').fadeOut(300, function() {
            jQuery(this).removeClass('grid').addClass('list').fadeIn(300);
            jQuery(this).find('.woocommerce-product-details__short-description').show();
        });
        return false;
    });

    if (jQuery.cookie('gridcookie')) {
        jQuery('ul.products, .wc-archive-switch-view').addClass(jQuery.cookie('gridcookie'));
    }

    if (jQuery.cookie('gridcookie') == 'grid') {
        jQuery('.wc-archive-switch-view  #grid').addClass('active');
        jQuery('.wc-archive-switch-view  #list').removeClass('active');
    }

    if (jQuery.cookie('gridcookie') == 'list') {
        jQuery('.wc-archive-switch-view  #list').addClass('active');
        jQuery('.wc-archive-switch-view  #grid').removeClass('active');
    }

    jQuery('.wc-archive-switch-view  a').click(function(event) {
        event.preventDefault();
    });
}
/*jshint eqnull:true */
/*!
 * jQuery Cookie Plugin v1.2
 * https://github.com/carhartl/jquery-cookie
 *
 * Copyright 2011, Klaus Hartl
 * Dual licensed under the MIT or GPL Version 2 licenses.
 * http://www.opensource.org/licenses/mit-license.php
 * http://www.opensource.org/licenses/GPL-2.0
 */
!function (e, o, t) {
    function n(e) {
        return e
    }

    function i(e) {
        return decodeURIComponent(e.replace(r, " "))
    }

    var r = /\+/g;
    e.cookie = function (t, r, c) {
        if (void 0 !== r && !/Object/.test(Object.prototype.toString.call(r))) {
            if (c = e.extend({}, e.cookie.defaults, c), null === r && (c.expires = -1), "number" == typeof c.expires) {
                var u = c.expires, a = c.expires = new Date;
                a.setDate(a.getDate() + u)
            }
            return r = String(r), o.cookie = [encodeURIComponent(t), "=", c.raw ? r : encodeURIComponent(r), c.expires ? "; expires=" + c.expires.toUTCString() : "", c.path ? "; path=" + c.path : "", c.domain ? "; domain=" + c.domain : "", c.secure ? "; secure" : ""].join("")
        }
        for (var p, s = (c = r || e.cookie.defaults || {}).raw ? n : i, l = o.cookie.split("; "), f = 0; p = l[f] && l[f].split("="); f++)if (s(p.shift()) === t)return s(p.join("="));
        return null
    }, e.cookie.defaults = {}, e.removeCookie = function (o, t) {
        return null !== e.cookie(o, t) && (e.cookie(o, null, t), !0)
    }
}(jQuery, document);