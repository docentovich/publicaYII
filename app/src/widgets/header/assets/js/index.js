!function(o){function e(e){n(e),o("#drop-down-"+e).toggleClass("is-open")}function n(e){o(".action-panel:not(#drop-down-"+e+")").removeClass("is-open")}function s(e){n(e),t(e),o("#"+e+"-overlay").toggleClass("is-open"),a()}function a(){o(".overlay").hasClass("is-open")?o("body").addClass("is-open-overlay"):o("body").removeClass("is-open-overlay")}function l(e){n(e),o("#"+e+"-overlay").addClass("is-open"),a()}function i(){o(".overlay").removeClass("is-open")}function t(e){o(".overlay:not(#"+e+"-overlay)").removeClass("is-open")}o(".toggle-drop-down-action-panel").on("click",function(){e(o(this).attr("rel")),i(),a()}),o("#search-input").on("keyup",function(){""!==this.value?o("#search-placeholder").hide():o("#search-placeholder").show(),l(o(this).attr("rel"))}),o(".toggle-overlay").on("click",function(){s(o(this).attr("rel"))})}(jQuery);