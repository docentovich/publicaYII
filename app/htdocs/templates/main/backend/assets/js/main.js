!function(o){o(document).ready(function(){o("body").removeClass("pageload"),o("#city-dd").on("click",function(e){e.stopPropagation(),o("#city-dd-ul").slideToggle()}),o(".header__control").on("click",function(e){e.stopPropagation(),window.scrollTo(0,0),o(this).toggleClass("header__control--active"),o(".header__control").not(this).removeClass("header__control--active"),o("#sidebar").removeClass("sidebar--active");var a=o(this).attr("rel");""!=a&&void 0!=a?(o(".hidden-sidebar").not("#"+a).removeClass("hidden-sidebar--active"),o("#"+a).toggleClass("hidden-sidebar--active"),o("body, html").toggleClass("no-scroll")):(o(".hidden-sidebar").removeClass("hidden-sidebar--active"),o("body, html").removeClass("no-scroll"))}),o(".hidden-sidebar__close").on("click",function(e){e.stopPropagation(),o(".hidden-sidebar").removeClass("hidden-sidebar--active"),o("body, html").removeClass("no-scroll"),o(".header__control").removeClass("header__control--active")}),o("#lang-dd").on("click",function(e){e.stopPropagation(),o("#lang-dd-ul").slideToggle(),i++}),o("#hamburger").on("click",function(e){e.stopPropagation(),window.scrollTo(0,0),o("#sidebar").toggleClass("sidebar--active"),o("body, html").toggleClass("no-scroll")}),o(".sidebar__close").on("click",function(e){e.stopPropagation(),o("#sidebar").removeClass("sidebar--active"),o("body, html").removeClass("no-scroll")})})}(jQuery);