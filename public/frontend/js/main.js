!function(e){var s=e(window),i=s.width(),t=e(".header-sticky"),a=e(".slider-bottom-header-sticky"),o=e("html"),l=e("body");s.on("scroll",(function(){var o=s.scrollTop(),l=t.height(),n=a.height()+e(".header-bottom-slider-area").height();i>=992&&(o<l?t.removeClass("is-sticky"):t.addClass("is-sticky")),i>=300&&(o<n?a.removeClass("is-sticky"):a.addClass("is-sticky")),o>=400?e(".scroll-top").fadeIn():e(".scroll-top").fadeOut()})),e(".scroll-top").on("click",(function(){e("html,body").animate({scrollTop:0},2e3)})),e("#offcanvas-about-icon").on("click",(function(){e("#about-overlay").addClass("active-about-overlay"),e(".overlay-close").addClass("active").removeClass("inactive"),e("body").addClass("active-body-search-overlay")})),e("#about-close-icon, .overlay-close").on("click",(function(){e("#about-overlay").toggleClass("active-about-overlay"),e(".overlay-close").addClass("inactive").removeClass("active"),e("body").removeClass("active-body-search-overlay")})),e("#offcanvas-wishlist-icon, #offcanvas-wishlist-icon-2").on("click",(function(){e("#wishlist-overlay").addClass("active-wishlist-overlay"),e(".wishlist-overlay-close").addClass("active").removeClass("inactive"),e("body").addClass("active-body-search-overlay")})),e("#wishlist-close-icon, .wishlist-overlay-close").on("click",(function(){e("#wishlist-overlay").removeClass("active-wishlist-overlay"),e(".wishlist-overlay-close").addClass("inactive").removeClass("active"),e("body").removeClass("active-body-search-overlay")})),e(document).keyup((function(s){27==s.keyCode&&(e(".active-search-overlay").length&&e("#search-overlay").removeClass("active-search-overlay"),e(".active-cart-overlay").length&&(e("#cart-overlay").removeClass("active-cart-overlay"),e(".cart-overlay-close").addClass("inactive").removeClass("active")),e(".active-wishlist-overlay").length&&(e("#wishlist-overlay").removeClass("active-wishlist-overlay"),e(".wishlist-overlay-close").addClass("inactive").removeClass("active")),e("body").removeClass("active-body-search-overlay"),e(".cd-quick-view.is-visible").length&&b(e("body").find(".cd-quick-view.add-content"),m,w))})),e("#offcanvas-cart-icon, #offcanvas-cart-icon-2").on("click",(function(){e("#cart-overlay").addClass("active-cart-overlay"),e(".cart-overlay-close").addClass("active").removeClass("inactive"),e("body").addClass("active-body-search-overlay")})),e(document).on("click","#cart-close-icon, .cart-overlay-close",(function(s){e("#cart-overlay").removeClass("active-cart-overlay"),e(".cart-overlay-close").addClass("inactive").removeClass("active"),e("body").removeClass("active-body-search-overlay")})),e("#search-icon, #search-icon-2").on("click",(function(){e("#search-overlay").addClass("active-search-overlay"),e("body").addClass("active-body-search-overlay")})),e("#search-close-icon").on("click",(function(){e("#search-overlay").removeClass("active-search-overlay"),e("body").removeClass("active-body-search-overlay")})),e("#dl-menu").dlmenu({animationClasses:{classin:"dl-animate-in-2",classout:"dl-animate-out-2"}});var n=e("#vertical-collapsible-menu");n.find(".sub-menu").slideUp(),n.on("click","li a",(function(s){var i=e(this);i.siblings(".sub-menu").length&&(s.preventDefault(),i.siblings("ul:visible").length?i.siblings("ul").slideUp():(i.closest("li").siblings("li").find("ul:visible").slideUp(),i.siblings("ul").slideDown()))})),e("#overlay-menu-icon").on("click",(function(){e("#overlay-navigation-menu").removeClass("overlay-navigation-inactive").addClass("overlay-navigation-active")})),e("#overlay-menu-close-icon").on("click",(function(){e("#overlay-navigation-menu").removeClass("overlay-navigation-active").addClass("overlay-navigation-inactive")})),e("#vertical-menu-icon").on("click",(function(){e(this).toggleClass("active"),e("#vertical-menu-dark").toggleClass("active")})),e("#mc-form").ajaxChimp({language:"en",callback:function(s){"success"===s.result?(e(".mailchimp-success").html(""+s.msg).fadeIn(900),e(".mailchimp-error").fadeOut(400)):"error"===s.result&&e(".mailchimp-error").html(""+s.msg).fadeIn(900)},url:"https://devitems.us11.list-manage.com/subscribe/post?u=6bbb9b6f5827bd842d9640c82&amp;id=05d85f18ef"}),e("#mc-form-2").ajaxChimp({language:"en",callback:function(s){"success"===s.result?(e(".mailchimp-success-2").html(""+s.msg).fadeIn(900),e(".mailchimp-error-2").fadeOut(400)):"error"===s.result&&e(".mailchimp-error-2").html(""+s.msg).fadeIn(900)},url:"https://devitems.us11.list-manage.com/subscribe/post?u=6bbb9b6f5827bd842d9640c82&amp;id=05d85f18ef"});var r=e(".lezada-slick-slider");"rtl"!=o.attr("dir")&&"rtl"!=l.attr("dir")||r.attr("dir","rtl"),r.each((function(){for(var s=e(this),i=s.data("slick-setting"),t=!!i.autoplay&&i.autoplay,a=parseInt(i.autoplaySpeed,10)||2e3,n=parseInt(i.speed,10)||2e3,r=i.asNavFor?i.asNavFor:null,c=i.appendArrows?i.appendArrows:s,d=i.appendDots?i.appendDots:s,p=!!i.arrows&&i.arrows,v=i.prevArrow?'<button class="'+i.prevArrow.buttonClass+'"><i class="'+i.prevArrow.iconClass+'"></i></button>':'<button class="slick-prev">previous</button>',u=i.nextArrow?'<button class="'+i.nextArrow.buttonClass+'"><i class="'+i.nextArrow.iconClass+'"></i></button>':'<button class="slick-next">next</button>',h=!!i.centerMode&&i.centerMode,g=i.centerPadding?i.centerPadding:"50px",m=!!i.dots&&i.dots,w=!!i.fade&&i.fade,f=!!i.focusOnSelect&&i.focusOnSelect,b=!i.infinite||i.infinite,y=!i.pauseOnHover||i.pauseOnHover,k=parseInt(i.rows,10)||1,C=parseInt(i.slidesToShow,10)||1,S=parseInt(i.slidesToScroll,10)||1,T=!i.swipe||i.swipe,x=!!i.swipeToSlide&&i.swipeToSlide,_=!!i.variableWidth&&i.variableWidth,q=!!i.vertical&&i.vertical,A=!!i.verticalSwiping&&i.verticalSwiping,P=!!(i.rtl||o.attr('dir="rtl"')||l.attr('dir="rtl"')),D=void 0!==s.data("slick-responsive")?s.data("slick-responsive"):"",I=D.length,O=[],F=0;F<I;F++)O[F]=D[F];s.slick({autoplay:t,autoplaySpeed:a,speed:n,asNavFor:r,appendArrows:c,appendDots:d,arrows:p,dots:m,centerMode:h,centerPadding:g,fade:w,focusOnSelect:f,infinite:b,pauseOnHover:y,rows:k,slidesToShow:C,slidesToScroll:S,swipe:T,swipeToSlide:x,variableWidth:_,vertical:q,verticalSwiping:A,rtl:P,prevArrow:v,nextArrow:u,responsive:O})}));var c=e(".masonry-category-layout"),d=e(".grid-item");d.hide(),c.imagesLoaded((function(){d.fadeIn(),c.masonry({itemSelector:".grid-item",columnWidth:".grid-item--width2",percentPosition:!0})}));var p=e(".masonry-category-layout--creativehome"),v=e(".grid-item");d.hide(),(p=e(".masonry-category-layout--creativehome")).imagesLoaded((function(){v.fadeIn(),p.masonry({itemSelector:".grid-item",columnWidth:".grid-item--width2",percentPosition:!0})}));var u=e(".blog-post-wrapper--masonry"),h=e(".grid-item");d.hide(),(u=e(".blog-post-wrapper--masonry")).imagesLoaded((function(){h.fadeIn(),u.masonry({itemSelector:".grid-item",columnWidth:".grid-item",percentPosition:!0})}));var g=".single-lookbook-section";g.length&&paraxify(g,{speed:1,boost:1}),e("[data-countdown]").each((function(){var s=e(this),i=e(this).data("countdown");s.countdown(i,(function(e){s.html(e.strftime('<div class="single-countdown"><span class="single-countdown__time">%D</span><span class="single-countdown__text">Days</span></div><div class="single-countdown"><span class="single-countdown__time">%H</span><span class="single-countdown__text">Hours</span></div><div class="single-countdown"><span class="single-countdown__time">%M</span><span class="single-countdown__text">Minutes</span></div><div class="single-countdown"><span class="single-countdown__time">%S</span><span class="single-countdown__text">Seconds</span></div>'))}))})),jQuery(window).on("load",(function(){e(".instagram-carousel").slick({slidesToShow:3,slidesToScroll:1,autoplay:!1,dots:!1,arrows:!0,prevArrow:'<button type="button" class="slick-prev"><i class="ti-angle-left"></i></button>',nextArrow:'<button type="button" class="slick-next"><i class="ti-angle-right"></i></button>',responsive:[{breakpoint:1499,settings:{slidesToShow:3}},{breakpoint:1199,settings:{slidesToShow:3}},{breakpoint:991,settings:{slidesToShow:3}},{breakpoint:767,settings:{slidesToShow:3}},{breakpoint:575,settings:{slidesToShow:2}},{breakpoint:479,settings:{slidesToShow:2}}]}),e(".instagram-carousel-type2").slick({slidesToShow:6,slidesToScroll:1,autoplay:!1,dots:!1,arrows:!0,prevArrow:'<button type="button" class="slick-prev"><i class="ti-angle-left"></i></button>',nextArrow:'<button type="button" class="slick-next"><i class="ti-angle-right"></i></button>',responsive:[{breakpoint:1500,settings:{slidesToShow:6}},{breakpoint:1200,settings:{slidesToShow:4}},{breakpoint:992,settings:{slidesToShow:3}},{breakpoint:768,settings:{slidesToShow:2}},{breakpoint:576,settings:{slidesToShow:2}},{breakpoint:479,settings:{slidesToShow:2}}]}),e(".instagram-carousel-type3").slick({slidesToShow:4,slidesToScroll:1,autoplay:!1,dots:!1,arrows:!0,prevArrow:'<button type="button" class="slick-prev"><i class="ti-angle-left"></i></button>',nextArrow:'<button type="button" class="slick-next"><i class="ti-angle-right"></i></button>',responsive:[{breakpoint:1500,settings:{slidesToShow:4}},{breakpoint:1200,settings:{slidesToShow:4}},{breakpoint:992,settings:{slidesToShow:4}},{breakpoint:768,settings:{slidesToShow:3}},{breakpoint:576,settings:{slidesToShow:2}},{breakpoint:479,settings:{slidesToShow:2}}]}),i>=767&&(e("#newsletter-popup-body").addClass("newsletter-overlay-active"),setTimeout((function(){e("#newsletter-content").addClass("show-popup")}),1e3))})),e(".cloth-tag").each((function(){var s=e(this),i=s.data("top"),t=s.data("left");s.css({top:i,left:t})})),e(".cloth-tag__content").addClass("inactive"),e(".cloth-tag__icon").on("click",(function(){e(this).siblings(".cloth-tag__content").toggleClass("active inactive")})),e(".popup-video").magnificPopup({type:"iframe",mainClass:"mfp-fade",removalDelay:160,preloader:!1,fixedContentPos:!1}),e(".instagram-feed").magnificPopup({type:"image",mainClass:"mfp-fade",removalDelay:160,preloader:!1,fixedContentPos:!1}),e("#smooth-scroll-section").on("click",(function(s){s.preventDefault(),e("html, body").animate({scrollTop:e(e.attr(this,"href")).offset().top-t.height()-50},500)})),e(document).on("click",".qty-btn",(function(s){s.preventDefault();var i=e(this),t=i.parent().find("input").val(),a=parseFloat(i.parent().find("input").attr("min")),o=parseFloat(i.parent().find("input").attr("min")),l=parseFloat(i.parent().find("input").attr("data-price")),n=parseFloat(i.parent().parent().find(".show-price").html());if(l>0&&!isNaN(l)&&(calculateOneItemPrice=l,a=1),i.hasClass("inc")){var r=parseFloat(t)+a;l>0&&!isNaN(l)&&(finalPrice=r*l,i.parent().parent().find(".show-price").html(finalPrice))}else{if(t==o)return!1;if(l>0&&!isNaN(l)&&i.parent().parent().find(".show-price").html(n-calculateOneItemPrice),t>0){if(0==(r=parseFloat(t)-a))return a}else r=a}i.parent().find("input").val(r)}));var m=400,w=900;function f(){var s=(e(window).width()-e(".cd-quick-view").width())/2,i=(e(window).height()-e(".cd-quick-view").height())/2;e(".cd-quick-view").css({top:i,left:s})}function b(s,i,t){var a=e(".cd-quick-view.is-visible .cd-close"),o=(function(e){var s=e.siblings(".cd-slider-wrapper").find(".cd-slider").children("li");s.removeClass("selected"),s.eq(0).addClass("selected")}(a),function(e){var s=e.siblings(".cd-slider-wrapper").find(".cd-slider-pagination").children("li");s.removeClass("active"),s.eq(0).addClass("active")}(a),a.siblings(".cd-slider-wrapper").find(".selected img").attr("src")),l=e(".empty-box").find("img").eq(0);!e(".cd-quick-view").hasClass("velocity-animating")&&e(".cd-quick-view").hasClass("add-content")?(l.attr("src",o),y(s,l,i,t,"close")):function(s,i,t,a){var o=i.parent(".image-wrap"),l=i.offset().top-e(window).scrollTop(),n=i.offset().left,r=i.width();e("body").removeClass("overlay-layer"),o.removeClass("empty-box"),s.velocity("stop").removeClass("add-content animate-width is-visible").css({top:l,left:n,width:r})}(s,l)}function y(s,i,t,a,o){var l=i.parent(".image-wrap"),n=i.offset().top-e(window).scrollTop(),r=i.offset().left,c=i.width(),d=i.height(),p=e(window).width(),v=(p-t)/2,u=(e(window).height()-t*d/c)/2,h=.8*p<a?.8*p:a,g=(p-h)/2;"open"==o?(l.addClass("empty-box"),e(s).css({top:n,left:r,width:c}).velocity({top:u+"px",left:v+"px",width:t+"px"},1e3,[400,20],(function(){e(s).addClass("animate-width").velocity({left:g+"px",width:h+"px"},300,"ease",(function(){e(s).addClass("add-content")}))})).addClass("is-visible")):e(s).removeClass("add-content").velocity({top:u+"px",left:v+"px",width:t+"px"},300,"ease",(function(){e("body").removeClass("overlay-layer"),e(s).removeClass("animate-width").velocity({top:n,left:r,width:c},500,"ease",(function(){e(s).removeClass("is-visible"),l.removeClass("empty-box")}))}))}e(".cd-trigger").on("click",(function(s){s.preventDefault();var i=e(this).closest(".single-product__image").find(".image-wrap").children("img").eq(0),t=e(this).attr("href");i.attr("src");e("body").addClass("overlay-layer"),y(t,i,m,w,"open")})),e("body").on("click",(function(s){(e(s.target).is(".cd-close")||e(s.target).is("body.overlay-layer"))&&(s.preventDefault(),b(e(this).find(".cd-quick-view.add-content"),m,w))})),e(".cd-quick-view").on("click",".cd-slider-navigation a",(function(s){s.preventDefault();var i,t,a,o,l=e(this);t=(i=l).parents(".cd-slider-wrapper").find(".cd-slider"),a=t.children(".selected"),(o=i.parents(".cd-slider-wrapper").children(".cd-slider-pagination")).children("li").removeClass("active"),a.removeClass("selected"),i.hasClass("cd-next")?a.is(":last-child")?(t.children("li").eq(0).addClass("selected"),o.children("li").eq(t.children("li").eq(0).index()).addClass("active")):(a.next().addClass("selected"),o.children("li").eq(a.next().index()).addClass("active")):a.is(":first-child")?(t.children("li").last().addClass("selected"),o.children("li").eq(t.children("li").last().index()).addClass("active")):(a.prev().addClass("selected"),o.children("li").eq(a.prev().index()).addClass("active"))})),e(".cd-quick-view").on("click",".cd-slider-pagination a",(function(s){s.preventDefault();var i,t,a,o=e(this);o.parents("li").addClass("active").siblings().removeClass("active"),t=(i=o).parents(".cd-slider-wrapper").find(".cd-slider").children("li"),a=i.parent("li").index(),t.removeClass("selected"),t.eq(a).addClass("selected")})),e(window).on("resize",(function(){e(".cd-quick-view").hasClass("is-visible")&&window.requestAnimationFrame(f)})),e(".ps-scroll").each((function(){if(e(".ps-scroll").length){new PerfectScrollbar(e(this)[0])}})),e(".sidebar-sticky").stickySidebar({topSpacing:90,bottomSpacing:-90,minWidth:768});var k=e(".product-filter-menu li");k.on("click",(function(){var s=e(this),i=s.data("filter");e(".product-isotope").isotope({filter:i,layoutMode:"fitRows"}),k.removeClass("active"),s.addClass("active")})),e(".nice-select").niceSelect(),e(".single-filter-widget--list--category li.has-children, .single-sidebar-widget--list--category li.has-children").append('<a href="#" class="expand-icon">+</a>'),e(".expand-icon").on("click",(function(s){s.preventDefault(),e(this).prev("ul").slideToggle();"+"==e(this).html()?e(this).html("-"):e(this).html("+")})),e("#advance-filter-active-btn").on("click",(function(){e(this).toggleClass("active"),e("#shop-advance-filter-area").slideToggle()})),e("#price-range").slider({range:!0,min:25,max:350,values:[25,350],slide:function(s,i){e("#price-amount").val("Price: $"+i.values[0]+" - $"+i.values[1])}}),e("#price-amount").val("Price: $"+e("#price-range").slider("values",0)+" - $"+e("#price-range").slider("values",1)),e(".grid-icons a").on("click",(function(s){s.preventDefault();var i=e(".shop-product-wrap"),t=e(this).data("target");i.isotope(),i.isotope("destroy"),e(".grid-icons a").removeClass("active"),e(this).addClass("active"),i.removeClass("three-column four-column five-column list").addClass(t),"three-column"==t&&i.children().addClass("col-lg-4").removeClass("col-lg-3 col-lg-is-5"),"four-column"==t&&i.children().addClass("col-lg-3").removeClass("col-lg-4 col-lg-is-5"),"five-column"==t&&i.children().addClass("col-lg-is-5").removeClass("col-lg-3 col-lg-4")})),e(".shop-product__big-image-gallery-slider").each((function(){var s=e(this),i=s.attr("data-row")?parseInt(s.attr("data-row"),10):1;s.slick({infinite:!1,arrows:!0,dots:!0,slidesToShow:1,slidesToScroll:1,rows:i,prevArrow:'<button class="slick-prev"><i class="ti-angle-left"></i></button>',nextArrow:'<button class="slick-next"><i class="ti-angle-right"></i></button>',responsive:[{breakpoint:1499,settings:{slidesToShow:1}},{breakpoint:1199,settings:{slidesToShow:1}},{breakpoint:991,settings:{slidesToShow:1}},{breakpoint:767,settings:{slidesToShow:1}},{breakpoint:575,settings:{slidesToShow:1}},{breakpoint:479,settings:{slidesToShow:1}}]})})),e(".shop-product__small-image-gallery-slider").each((function(){var s=e(this),i=s.attr("data-row")?parseInt(s.attr("data-row"),10):1;s.slick({infinite:!0,arrows:!0,dots:!1,slidesToShow:5,centerMode:!0,centerPadding:"15px",slidesToScroll:1,rows:i,prevArrow:'<button class="slick-prev"><i class="ti-angle-left"></i></button>',nextArrow:'<button class="slick-next"><i class="ti-angle-right"></i></button>',asNavFor:".shop-product__big-image-gallery-slider",focusOnSelect:!0,responsive:[{breakpoint:1499,settings:{slidesToShow:5}},{breakpoint:1199,settings:{slidesToShow:4}},{breakpoint:991,settings:{slidesToShow:6}},{breakpoint:767,settings:{slidesToShow:4}},{breakpoint:575,settings:{slidesToShow:4}},{breakpoint:479,settings:{slidesToShow:2}}]})})),e(".shop-product__small-image-gallery-slider--vertical").each((function(){var s=e(this),i=s.attr("data-row")?parseInt(s.attr("data-row"),10):1;s.slick({infinite:!0,arrows:!0,dots:!1,slidesToShow:3,slidesToScroll:1,vertical:!0,centerMode:!0,rows:i,prevArrow:'<button class="slick-prev"><i class="ti-angle-left"></i></button>',nextArrow:'<button class="slick-next"><i class="ti-angle-right"></i></button>',asNavFor:".shop-product__big-image-gallery-slider",focusOnSelect:!0,responsive:[{breakpoint:1499,settings:{slidesToShow:3}},{breakpoint:1199,settings:{slidesToShow:3}},{breakpoint:991,settings:{slidesToShow:3}},{breakpoint:767,settings:{slidesToShow:3,vertical:!1,arrows:!1,centerMode:!0,centerPadding:"15px"}},{breakpoint:575,settings:{slidesToShow:3,vertical:!1,arrows:!1,centerMode:!0,centerPadding:"15px"}},{breakpoint:479,settings:{slidesToShow:2,vertical:!1,arrows:!1,centerMode:!0,centerPadding:"15px"}}]})})),e(".shop-product__big-image-gallery-slider .single-image").zoom(),e(".shop-product__big-image-gallery-sticky .single-image").zoom();for(var C=e(".shop-product__big-image-gallery-slider .single-image img, .shop-product__big-image-gallery-sticky .single-image img"),S=C.length,T=[],x=0;x<S;x++)T[x]={src:C[x].src};e(".btn-zoom-popup").on("click",(function(){e(this).lightGallery({thumbnail:!1,dynamic:!0,autoplayControls:!1,download:!1,actualSize:!1,share:!1,hash:!1,index:0,dynamicEl:T})}));var _=e(".video-bg");_.each((function(s,i){var t=e(i).data("url");_.YTPlayer({videoURL:t,showControls:!1,showYTLogo:!1,mute:!0,quality:"highres",containment:".video-area",ratio:"auto"})})),i>=767&&e("#newsletter-popup-close-icon").on("click",(function(){e("body").removeClass("newsletter-overlay-active").addClass("newsletter-overlay-inactive"),e("#newsletter-content").removeClass("show-popup").addClass("hide-popup")})),e('[name="payment-method"]').on("click",(function(){var s=e(this).attr("value");e(".single-method p").slideUp(),e('[data-method="'+s+'"]').slideDown()})),e("[data-shipping]").on("click",(function(){e("[data-shipping]:checked").length>0?e("#shipping-form").slideDown():e("#shipping-form").slideUp()})),e(".bg-img").each((function(s,i){var t=e(i),a=t.data("bg");t.css("background-image","url("+a+")")}))}(jQuery);