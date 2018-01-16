/**
 * get clock
 * 
 * @param int type
 */
/*function getClock(disp) {
    var curTime = new Date(server_time * 1000);
    //var curTime = new Date();
    var nhours = curTime.getHours();
    var nmins = curTime.getMinutes();
    var nsecn = curTime.getSeconds();
    var nday = curTime.getDay();
    var nmonth = curTime.getMonth();
    var ntoday = curTime.getDate();
    var nyear = curTime.getYear();
    var AMorPM = " ";
    if (nhours >= 12)
        AMorPM = "";
    else
        AMorPM = "";
    if (nhours >= 13)
        nhours -= 12;
    if (nhours === 0)
        nhours = 12;
    if (nsecn < 10)
        nsecn = "0" + nsecn;
    if (nmins < 10)
        nmins = "0" + nmins;
    if (nday === 0)
        nday = "Chủ nhật";
    if (nday === 1)
        nday = "Thứ hai";
    if (nday === 2)
        nday = "Thứ ba";
    if (nday === 3)
        nday = "Thứ tư";
    if (nday === 4)
        nday = "Thứ năm";
    if (nday === 5)
        nday = "Thứ sáu";
    if (nday === 6)
        nday = "Thứ bảy";
    nmonth += 1;
    if (nyear <= 99)
        nyear = "19" + nyear;
    if ((nyear > 99) && (nyear < 2000))
        nyear += 1900;
    var d;
    var Str0 = "";
    if (nhours > 9)
        Str0 = "";
    else
        Str0 = "0";

    d = document.getElementById("theClock");
    var ouput = "";
    if (disp === 0) {
        ouput = nday + ", " + ntoday + "/" + nmonth + "/" + nyear + ", " + Str0 + nhours + ":" + nmins + ":" + nsecn;
    } else {
        ouput = " <span>" + Str0 + nhours + " giờ " + nmins + " phút " + nsecn + " giây - " + AMorPM + "</span>" + nday + " - Ngày " + ntoday + " tháng " + nmonth + " năm " + nyear;
    }

    d.innerHTML = ouput;
    setTimeout('getClock(0)', 1000);
}
function get_server_time(){
    $.get(siteurl + "/welcome/server_time", function( data ) {
        server_time = data;
    });
}
setInterval("get_server_time()", 1000);
*/
function addFavorite(href, name) {
    if (!$.browser.msie) {
        window.sidebar.addPanel(name, href, "");
    } else {
        window.external.AddFavorite(href, name);
    }
}
function addFavoriteLink(link_id){
    $.ajax({
        url: siteurl + "/welcome/add_favorite_link", type: "POST", dataType: "json", cache: false,
        data: {
            link_id:link_id
        },
        success: function(response, textStatus, XMLHttpRequest) {
            if (response && response.status == 'success') {
                alert(response.message);
                $("#user_links").html(response.favorites);
                $(".inline").colorbox({
                    inline: true, 
                    width: "700px"
                });
            } else if (response && response.status == 'error') {
                alert(response.message);
            }
        },
        error: function(MLHttpRequest, textStatus, errorThrown) {
            alert(errorThrown);
        },
        complete: function() {
        }
    });
}
function removeFavoriteLink(link_id){
    $.ajax({
        url: siteurl + "/welcome/remove_favorite_link", type: "POST", dataType: "json", cache: false,
        data: {
            link_id:link_id
        },
        success: function(response, textStatus, XMLHttpRequest) {
            if (response && response.status == 'success') {
//                alert(response.message); 
                $("#user_links").html(response.favorites);
                $(".inline").colorbox({
                    inline: true, 
                    width: "700px"
                });
                $(".inline").colorbox.close();
            } else if (response && response.status == 'error') {
                alert(response.message);
            }
        },
        error: function(MLHttpRequest, textStatus, errorThrown) {
            alert(errorThrown);
        },
        complete: function() {
        }
    });
}
/* =========================================================
 Tabs
 ============================================================ */
/*jQuery(document).ready(function() {
 //Web list tab
 jQuery(".web-tab-content").hide(); //Hide all content
 jQuery("ul.web-tabs li:first").addClass("active").show(); //Activate first tab
 jQuery(".web-tab-content:first").show(); //Show first tab content
 //On Click Event Product Tab
 jQuery("ul.web-tabs li").click(function() {
 jQuery("ul.web-tabs li").removeClass("active"); //Remove any "active" class
 jQuery(this).addClass("active"); //Add "active" class to selected tab
 jQuery(".web-tab-content").hide(); //Hide all tab content
 var activeTab = jQuery(this).find("a").attr("href"); //Find the rel attribute value to identify the active tab + content
 jQuery(activeTab).fadeIn(); //Fade in the active content
 return false;
 
 });
 })*/
jQuery(document).ready(function() {
    // Headline news text rotator
//    $(".head-line .text-rotator").show().ticker({ rate: 50, delay: 5000 }).trigger("play");
        
    //Auto News tab
    kopa2_element_tabs_INIT();
});

function nextPrevLoad(elm, href){
    jQuery(elm).load(href).html(jQuery(elm).html());
}

function kopa2_element_tabs_INIT() {
    var tabs2 = jQuery('.auto-news-box');
    if (tabs2.length > 0) {
        jQuery.each(tabs2, function() {
            var tab2 = jQuery(this);

            var contents2 = tab2.find('.auto-news-tab-content');
            var captions2 = tab2.find('.auto-news-tabs li');
            contents2.hide();
            captions2.first().addClass("active").show();
            contents2.first().show();

            jQuery.each(captions2, function() {
                var caption2 = jQuery(this);
                caption2.click(function() {
                    if (!caption2.hasClass("active")) {
                        captions2.removeClass("active");
                        caption2.addClass("active");
                        tab2.find('.auto-news-tab-content').hide();
                        jQuery(jQuery(this).find("a").attr("href")).fadeIn();
                        var my_flex2 = jQuery(jQuery(this).find("a").attr("href")).find('.flexslider');
                        if(my_flex2.html().trim() == ''){
                            my_flex2.html("<img src='"+siteurl+"/public/libs/ajaxtabs/loading.gif' /> Đang lấy nội dung...");
                            my_flex2.load(jQuery(this).find("a").attr("data-source") + "&t=" +  (new Date()).getTime()).html(my_flex2.html());
                        }
                        /*if (my_flex2.find('.flex-viewport').length != 1) {
                            setTimeout(function(){
                                flexslide_init2(my_flex2);
                            }, 500);
                        }*/
                    }
                    return false;
                });
            });
        });
    }
}
//Hot News tab
jQuery(document).ready(function() {
    kopa_element_tabs_INIT();
});

function kopa_element_tabs_INIT() {
    var tabs = jQuery('.hot-news-box');
    if (tabs.length > 0) {
        jQuery.each(tabs, function() {
            var tab = jQuery(this);

            var contents = tab.find('.hot-news-tab-content');
            var captions = tab.find('.hot-news-tabs li');
            contents.hide();
            captions.first().addClass("active").show();
            contents.first().show();

            jQuery.each(captions, function() {
                var caption = jQuery(this);
                caption.click(function() {
                    if (!caption.hasClass("active")) {
                        captions.removeClass("active");
                        caption.addClass("active");
                        tab.find('.hot-news-tab-content').hide();
                        jQuery(jQuery(this).find("a").attr("href")).fadeIn();
                        var my_flex = jQuery(jQuery(this).find("a").attr("href")).find('.flexslider');
                        if(my_flex.html().trim() == ''){
                            my_flex.html("<img src='"+siteurl+"/public/libs/ajaxtabs/loading.gif' /> Đang lấy nội dung...");
                            my_flex.load(my_flex.attr("data-source") + "&t=" + (new Date()).getTime()).html(my_flex.html());
                        }
                        /*if (my_flex.find('.flex-viewport').length != 1) {
                            setTimeout(function(){
                                flexslide_init(my_flex);
                            }, 500);
                        }*/
                    }
                    return false;
                });
            });
        });
    }
}
/* =========================================================
 Fix css
 ============================================================ */
jQuery(document).ready(function() {
    jQuery(".latest-comments ul li:last-child").css("border-bottom", "none");
    //jQuery("#main-nav > li:last-child a").css("background","none");
    //jQuery("#headline ul li:last-child").css("margin-right",0);
    //jQuery("#sidebar-b .widget .categories li:first-child").css("border-top","none");
    //jQuery("#sidebar-b .widget .categories li:last-child").css("border-bottom","none");
    //jQuery("#comments > .comments-list > li.comment:last-child").css({'border-bottom':'none', 'padding-bottom':0});
    //jQuery("#sidebar-a .twitter-ul li:last-child").css("border-bottom","none");


});
/* =========================================================
 Slider for Hot News list
 ============================================================ */

function flexslide_init(obj) {
    obj.flexslider({
        animation: "slide",
        controlsContainer: ".flex-container",
        slideshow: false,
        mousewheel: false
    });
}

jQuery(document).ready(function() {
    var tab = jQuery('#hot-news-slider-1');
    tab.load(tab.attr("data-source") + "&t=" + (new Date()).getTime()).html(tab.html());
    /*jQuery(window).load(function() {
        flexslide_init(tab);
    });*/
});

function flexslide_init2(obj) {
    obj.flexslider({
        animation: "slide",
        controlsContainer: ".flex-container",
        slideshow: false,
        mousewheel: false
    });
}

jQuery(document).ready(function() {
    var captions2 = jQuery(".auto-news-box").find('.auto-news-tabs li').first();
    var flex = jQuery(".auto-news-tab-container").find('.auto-news-tab-content').first().find('.flexslider');
    flex.load(captions2.find("a").attr("data-source") + "&t=" + (new Date()).getTime()).html(flex.html());
    /*jQuery(window).load(function() {
        setTimeout(function(){
            flexslide_init2(flex);
        }, 1000);
    });*/
});

/* =========================================================
 Games box slider
 ============================================================ */
//jQuery(window).load(function() {
//    jQuery('.featured-news').carouFredSel({
//        responsive: true,
//        prev: '#prev-1',
//        next: '#next-1',
//        width: '100%',
//        scroll: 1,
//        auto: true,
//        items: {
//            width: 100,
//            height: 'auto',
//            visible: {
//                min: 1,
//                max: 9
//            }
//        }
//    });
//});

/* =========================================================
 PopOver
 ============================================================ */
jQuery(document).ready(function() {
//    jQuery(".inline").colorbox({
//        inline: true, 
//        width: "50%",
//        onLoad:function(){
//            FB.XFBML.parse( );
//        }
//    });
    jQuery(".inline_link").colorbox({
        inline:true, 
        width:"400px", 
        closeButton: false,
        fixed:true
    });
});


