!function(e){e.extend(e.datepicker,{_inlineDatepicker2:e.datepicker._inlineDatepicker,_inlineDatepicker:function(n,a){this._inlineDatepicker2(n,a);var t=e.datepicker._get(a,"beforeShow");t&&t.apply(n,[n,a])}})}(jQuery),function(e){e(document).ready(function(){function n(){setTimeout(function(){var n=e("#calendar .ui-datepicker ");e("<a class='menu__calendar-close'>X</a>",{click:function(){}}).appendTo(n),e(".menu__calendar-close").click(function(n){n.stopPropagation(),e("#"+a).addClass("out"),e("body").removeClass("modal-active")})},1)}e("body").removeClass("pageload"),e("body").removeClass("no-js"),e(".sidebar-rel").on("click",function(){var n=e(this).attr("rel");e("#"+n).toggleClass("active"),e("html").toggleClass("no-y-scroll")}),$fbg=e(".image-gal__a").fancybox({closeBtn:!1,infobar:!1,buttons:!0,touch:!1,closeClickOutside:!0,loop:!0,tpl:{next:'<a title="Next" class="fancybox-nav fancybox-next" href="javascript:;"><span>NEXT</span></a>',prev:'<a title="Previous" class="fancybox-nav fancybox-prev" href="javascript:;"><span>PREVIOUS</span></a>'},type:"inline",beforeMove:function(e,n){void 0!=e.slides[e.prevIndex]&&(e.slides[e.prevIndex].$slide.css("overflow","hidden"),n.$slide.css("overflow","hidden"))},afterMove:function(e,n){void 0!=e.slides[e.prevIndex]&&(e.slides[e.prevIndex].$slide.css("overflow",""),n.$slide.css("overflow",""))}}),e(".modal__to-right").on("click",function(){e.fancybox.getInstance().next()}),e(".modal__to-left").on("click",function(){e.fancybox.getInstance().previous()});var a;e(".menu__a_calendar").on("click",function(){var n=e(this).attr("rel"),t=e(this).attr("animation");a=n,e("#"+n).removeAttr("class"),setTimeout(function(){e("#"+n).addClass(t)})}),e("#calendar").datepicker({inline:!0,firstDay:1,showOtherMonths:!0,nextText:"",prevText:"",dateFormat:"yy-mm-dd",dayNamesMin:["Суб","Пн","Вт","Ср","Чт","Пт","Вс"],monthNames:["Январь","Февраль","Март","Апрель","Май","Июнь","Июль","Август","Сентябрь","Октябрь","Ноябрь","Декабрь"],beforeShow:function(e){n()},onChangeMonthYear:function(){n()},onSelect:function(e,n){window.location="/"+e}});var t=queryDate.match(/(\d+)/g),o=new Date(t[0],t[1]-1,t[2]);e("#calendar").datepicker("setDate",o),e(".pagination-item_disabled").on("click",function(e){e.stopPropagation(),e.preventDefault()})})}(jQuery);