var public_vars=public_vars||{};;(function($,window,undefined){"use strict";$(document).ready(function()
{public_vars.$body=$("body");public_vars.$pageContainer=public_vars.$body.find(".page-container");public_vars.$chat=public_vars.$pageContainer.find("#chat");public_vars.$sidebarMenu=public_vars.$pageContainer.find('.sidebar-menu');public_vars.$sidebarProfile=public_vars.$sidebarMenu.find('.sidebar-user-info');public_vars.$mainMenu=public_vars.$sidebarMenu.find('.main-menu');public_vars.$horizontalNavbar=public_vars.$body.find('.navbar.horizontal-menu');public_vars.$horizontalMenu=public_vars.$horizontalNavbar.find('.navbar-nav');public_vars.$mainContent=public_vars.$pageContainer.find('.main-content');public_vars.$mainFooter=public_vars.$body.find('footer.main-footer');public_vars.$userInfoMenuHor=public_vars.$body.find('.navbar.horizontal-menu');public_vars.$userInfoMenu=public_vars.$body.find('nav.navbar.user-info-navbar');public_vars.$settingsPane=public_vars.$body.find('.settings-pane');public_vars.$settingsPaneIn=public_vars.$settingsPane.find('.settings-pane-inner');public_vars.wheelPropagation=true;public_vars.$pageLoadingOverlay=public_vars.$body.find('.page-loading-overlay');public_vars.defaultColorsPalette=['#68b828','#7c38bc','#0e62c7','#fcd036','#4fcdfc','#00b19d','#ff6264','#f7aa47'];setup_sidebar_menu();setup_horizontal_menu();if(public_vars.$mainFooter.hasClass('sticky'))
{stickFooterToBottom();$(window).on('xenon.resized',stickFooterToBottom);}
if($.isFunction($.fn.perfectScrollbar))
{if(public_vars.$sidebarMenu.hasClass('fixed'))
ps_init();$(".ps-scrollbar").each(function(i,el)
{var $el=$(el);if($el.hasClass('ps-scroll-down'))
{$el.scrollTop($el.prop('scrollHeight'));}
$el.perfectScrollbar({wheelPropagation:false});});var $chat_inner=public_vars.$pageContainer.find('#chat .chat-inner');if($chat_inner.parent().hasClass('fixed'))
$chat_inner.css({maxHeight:$(window).height()}).perfectScrollbar();$(".dropdown:has(.ps-scrollbar)").each(function(i,el)
{var $scrollbar=$(this).find('.ps-scrollbar');$(this).on('click','[data-toggle="dropdown"]',function(ev)
{ev.preventDefault();setTimeout(function()
{$scrollbar.perfectScrollbar('update');},1);});});$("div.scrollable").each(function(i,el)
{var $this=$(el),max_height=parseInt(attrDefault($this,'max-height',200),10);max_height=max_height<0?200:max_height;$this.css({maxHeight:max_height}).perfectScrollbar({wheelPropagation:true});});}
var $uim_search_form=$(".user-info-menu .search-form, .nav.navbar-right .search-form");$uim_search_form.each(function(i,el)
{var $uim_search_input=$(el).find('.form-control');$(el).on('click','.btn',function(ev)
{if($uim_search_input.val().trim().length==0)
{jQuery(el).addClass('focused');setTimeout(function(){$uim_search_input.focus();},100);return false;}});$uim_search_input.on('blur',function()
{jQuery(el).removeClass('focused');});});if(public_vars.$mainFooter.hasClass('fixed'))
{public_vars.$mainContent.css({paddingBottom:public_vars.$mainFooter.outerHeight(true)});}
$('body').on('click','a[rel="go-top"]',function(ev)
{ev.preventDefault();var obj={pos:$(window).scrollTop()};TweenLite.to(obj,.3,{pos:0,ease:Power4.easeOut,onUpdate:function()
{$(window).scrollTop(obj.pos);}});});if(public_vars.$userInfoMenu.length)
{public_vars.$userInfoMenu.find('.user-info-menu > li').css({minHeight:public_vars.$userInfoMenu.outerHeight()-1});}
if($.isFunction($.fn.autosize))
{$(".autosize, .autogrow").autosize();}
cbr_replace();$(".breadcrumb.auto-hidden").each(function(i,el)
{var $bc=$(el),$as=$bc.find('li a'),collapsed_width=$as.width(),expanded_width=0;$as.each(function(i,el)
{var $a=$(el);expanded_width=$a.outerWidth(true)+5;$a.addClass('collapsed').width(expanded_width);$a.hover(function()
{$a.removeClass('collapsed');},function()
{$a.addClass('collapsed');});});});$(window).on('keydown',function(ev)
{if(ev.keyCode==27)
{if(public_vars.$body.hasClass('modal-open'))
$(".modal-open .modal:visible").modal('hide');}});$(".input-group.input-group-minimal:has(.form-control)").each(function(i,el)
{var $this=$(el),$fc=$this.find('.form-control');$fc.on('focus',function()
{$this.addClass('focused');}).on('blur',function()
{$this.removeClass('focused');});});$(".input-group.spinner").each(function(i,el)
{var $ig=$(el),$dec=$ig.find('[data-type="decrement"]'),$inc=$ig.find('[data-type="increment"]'),$inp=$ig.find('.form-control'),step=attrDefault($ig,'step',1),min=attrDefault($ig,'min',0),max=attrDefault($ig,'max',0),umm=min<max;$dec.on('click',function(ev)
{ev.preventDefault();var num=new Number($inp.val())-step;if(umm&&num<=min)
{num=min;}
$inp.val(num);});$inc.on('click',function(ev)
{ev.preventDefault();var num=new Number($inp.val())+step;if(umm&&num>=max)
{num=max;}
$inp.val(num);});});if($.isFunction($.fn.select2))
{$(".select2").each(function(i,el)
{var $this=$(el),opts={allowClear:attrDefault($this,'allowClear',false)};$this.select2(opts);$this.addClass('visible');});if($.isFunction($.fn.niceScroll))
{$(".select2-results").niceScroll({cursorcolor:'#d4d4d4',cursorborder:'1px solid #ccc',railpadding:{right:3}});}}
if($.isFunction($.fn.selectBoxIt))
{$("select.selectboxit").each(function(i,el)
{var $this=$(el),opts={showFirstOption:attrDefault($this,'first-option',true),'native':attrDefault($this,'native',false),defaultText:attrDefault($this,'text',''),};$this.addClass('visible');$this.selectBoxIt(opts);});}
if($.isFunction($.fn.datepicker))
{$(".datepicker").each(function(i,el)
{var $this=$(el),opts={format:attrDefault($this,'format','mm/dd/yyyy'),startDate:attrDefault($this,'startDate',''),endDate:attrDefault($this,'endDate',''),daysOfWeekDisabled:attrDefault($this,'disabledDays',''),startView:attrDefault($this,'startView',0),rtl:rtl()},$n=$this.next(),$p=$this.prev();$this.datepicker(opts);if($n.is('.input-group-addon')&&$n.has('a'))
{$n.on('click',function(ev)
{ev.preventDefault();$this.datepicker('show');});}
if($p.is('.input-group-addon')&&$p.has('a'))
{$p.on('click',function(ev)
{ev.preventDefault();$this.datepicker('show');});}});}
if($.isFunction($.fn.daterangepicker))
{$(".daterange").each(function(i,el)
{var ranges={'Today':[moment(),moment()],'Yesterday':[moment().subtract('days',1),moment().subtract('days',1)],'Last 7 Days':[moment().subtract('days',6),moment()],'Last 30 Days':[moment().subtract('days',29),moment()],'This Month':[moment().startOf('month'),moment().endOf('month')],'Last Month':[moment().subtract('month',1).startOf('month'),moment().subtract('month',1).endOf('month')]};var $this=$(el),opts={format:attrDefault($this,'format','MM/DD/YYYY'),timePicker:attrDefault($this,'timePicker',false),timePickerIncrement:attrDefault($this,'timePickerIncrement',false),separator:attrDefault($this,'separator',' - '),},min_date=attrDefault($this,'minDate',''),max_date=attrDefault($this,'maxDate',''),start_date=attrDefault($this,'startDate',''),end_date=attrDefault($this,'endDate','');if($this.hasClass('add-ranges'))
{opts['ranges']=ranges;}
if(min_date.length)
{opts['minDate']=min_date;}
if(max_date.length)
{opts['maxDate']=max_date;}
if(start_date.length)
{opts['startDate']=start_date;}
if(end_date.length)
{opts['endDate']=end_date;}
$this.daterangepicker(opts,function(start,end)
{var drp=$this.data('daterangepicker');if($this.is('[data-callback]'))
{callback_test(start,end);}
if($this.hasClass('daterange-inline'))
{$this.find('span').html(start.format(drp.format)+drp.separator+end.format(drp.format));}});if(typeof opts['ranges']=='object')
{$this.data('daterangepicker').container.removeClass('show-calendar');}});}
if($.isFunction($.fn.timepicker))
{$(".timepicker").each(function(i,el)
{var $this=$(el),opts={template:attrDefault($this,'template',false),showSeconds:attrDefault($this,'showSeconds',false),defaultTime:attrDefault($this,'defaultTime','current'),showMeridian:attrDefault($this,'showMeridian',true),minuteStep:attrDefault($this,'minuteStep',15),secondStep:attrDefault($this,'secondStep',15)},$n=$this.next(),$p=$this.prev();$this.timepicker(opts);if($n.is('.input-group-addon')&&$n.has('a'))
{$n.on('click',function(ev)
{ev.preventDefault();$this.timepicker('showWidget');});}
if($p.is('.input-group-addon')&&$p.has('a'))
{$p.on('click',function(ev)
{ev.preventDefault();$this.timepicker('showWidget');});}});}
if($.isFunction($.fn.colorpicker))
{$(".colorpicker").each(function(i,el)
{var $this=$(el),opts={},$n=$this.next(),$p=$this.prev(),$preview=$this.siblings('.input-group-addon').find('.color-preview');$this.colorpicker(opts);if($n.is('.input-group-addon')&&$n.has('a'))
{$n.on('click',function(ev)
{ev.preventDefault();$this.colorpicker('show');});}
if($p.is('.input-group-addon')&&$p.has('a'))
{$p.on('click',function(ev)
{ev.preventDefault();$this.colorpicker('show');});}
if($preview.length)
{$this.on('changeColor',function(ev){$preview.css('background-color',ev.color.toHex());});if($this.val().length)
{$preview.css('background-color',$this.val());}}});}
if($.isFunction($.fn.validate))
{$("form.validate").each(function(i,el)
{var $this=$(el),opts={rules:{},messages:{},errorElement:'span',errorClass:'validate-has-error',highlight:function(element){$(element).closest('.form-group').addClass('validate-has-error');},unhighlight:function(element){$(element).closest('.form-group').removeClass('validate-has-error');},errorPlacement:function(error,element)
{if(element.closest('.has-switch').length)
{error.insertAfter(element.closest('.has-switch'));}
else
if(element.parent('.checkbox, .radio').length||element.parent('.input-group').length)
{error.insertAfter(element.parent());}
else
{error.insertAfter(element);}}},$fields=$this.find('[data-validate]');$fields.each(function(j,el2)
{var $field=$(el2),name=$field.attr('name'),validate=attrDefault($field,'validate','').toString(),_validate=validate.split(',');for(var k in _validate)
{var rule=_validate[k],params,message;if(typeof opts['rules'][name]=='undefined')
{opts['rules'][name]={};opts['messages'][name]={};}
if($.inArray(rule,['required','url','email','number','date','creditcard'])!=-1)
{opts['rules'][name][rule]=true;message=$field.data('message-'+rule);if(message)
{opts['messages'][name][rule]=message;}}
else
if(params=rule.match(/(\w+)\[(.*?)\]/i))
{if($.inArray(params[1],['min','max','minlength','maxlength','equalTo'])!=-1)
{opts['rules'][name][params[1]]=params[2];message=$field.data('message-'+params[1]);if(message)
{opts['messages'][name][params[1]]=message;}}}}});$this.validate(opts);});}
$.applyMasks=function(root)
{$("[data-mask]",root).each(function(i,el)
{var $this=$(el),mask=$this.data('mask').toString(),opts={numericInput:attrDefault($this,'numeric',false),radixPoint:attrDefault($this,'radixPoint',''),rightAlign:attrDefault($this,'numericAlign','left')=='right'},placeholder=attrDefault($this,'placeholder',''),is_regex=attrDefault($this,'isRegex','');if(placeholder.length)
{opts[placeholder]=placeholder;}
switch(mask.toLowerCase())
{case "phone":mask="(999) 999-9999";break;case "currency":case "rcurrency":var sign=attrDefault($this,'sign','$');;mask="999,999,999.99";if($this.data('mask').toLowerCase()=='rcurrency')
{mask+=' '+sign;}
else
{mask=sign+' '+mask;}
opts.numericInput=true;opts.rightAlignNumerics=false;opts.radixPoint='.';break;case "email":mask='Regex';opts.regex="[a-zA-Z0-9._%-]+@[a-zA-Z0-9-]+\\.[a-zA-Z]{2,4}";break;case "fdecimal":mask='decimal';$.extend(opts,{autoGroup:true,groupSize:3,radixPoint:attrDefault($this,'rad','.'),groupSeparator:attrDefault($this,'dec',',')});}
if(is_regex)
{opts.regex=mask;mask='Regex';}
$this.inputmask(mask,opts);});}
if($.isFunction($.fn.inputmask))
{$.applyMasks($('body'));}
if($.isFunction($.fn.bootstrapWizard))
{$(".form-wizard").each(function(i,el)
{var $this=$(el),$tabs=$this.find('> .tabs > li'),$progress=$this.find(".progress-indicator"),_index=$this.find('> ul > li.active').index();var checkFormWizardValidaion=function(tab,navigation,index)
{if($this.hasClass('validate'))
{var $valid=$this.valid();if(!$valid)
{$this.data('validator').focusInvalid();return false;}}
return true;};if(_index>0)
{$progress.css({width:_index/$tabs.length*100+'%'});$tabs.removeClass('completed').slice(0,_index).addClass('completed');}
$this.bootstrapWizard({tabClass:"",onTabShow:function($tab,$navigation,index)
{var pct=$tabs.eq(index).position().left/$tabs.parent().width()*100;$tabs.removeClass('completed').slice(0,index).addClass('completed');$progress.css({width:pct+'%'});},onNext:checkFormWizardValidaion,onTabClick:checkFormWizardValidaion});$this.data('bootstrapWizard').show(_index);$this.find('.pager a').on('click',function(ev)
{ev.preventDefault();});});}
if($.isFunction($.fn.slider))
{$(".slider").each(function(i,el)
{var $this=$(el),$label_1=$('<span class="ui-label"></span>'),$label_2=$label_1.clone(),orientation=attrDefault($this,'vertical',0)!=0?'vertical':'horizontal',prefix=attrDefault($this,'prefix',''),postfix=attrDefault($this,'postfix',''),fill=attrDefault($this,'fill',''),$fill=$(fill),step=attrDefault($this,'step',1),value=attrDefault($this,'value',5),min=attrDefault($this,'min',0),max=attrDefault($this,'max',100),min_val=attrDefault($this,'min-val',10),max_val=attrDefault($this,'max-val',90),is_range=$this.is('[data-min-val]')||$this.is('[data-max-val]'),reps=0;if(is_range)
{$this.slider({range:true,orientation:orientation,min:min,max:max,values:[min_val,max_val],step:step,slide:function(e,ui)
{var min_val=(prefix?prefix:'')+ui.values[0]+(postfix?postfix:''),max_val=(prefix?prefix:'')+ui.values[1]+(postfix?postfix:'');$label_1.html(min_val);$label_2.html(max_val);if(fill)
$fill.val(min_val+','+max_val);reps++;},change:function(ev,ui)
{if(reps==1)
{var min_val=(prefix?prefix:'')+ui.values[0]+(postfix?postfix:''),max_val=(prefix?prefix:'')+ui.values[1]+(postfix?postfix:'');$label_1.html(min_val);$label_2.html(max_val);if(fill)
$fill.val(min_val+','+max_val);}
reps=0;}});var $handles=$this.find('.ui-slider-handle');$label_1.html((prefix?prefix:'')+min_val+(postfix?postfix:''));$handles.first().append($label_1);$label_2.html((prefix?prefix:'')+max_val+(postfix?postfix:''));$handles.last().append($label_2);}
else
{$this.slider({range:attrDefault($this,'basic',0)?false:"min",orientation:orientation,min:min,max:max,value:value,step:step,slide:function(ev,ui)
{var val=(prefix?prefix:'')+ui.value+(postfix?postfix:'');$label_1.html(val);if(fill)
$fill.val(val);reps++;},change:function(ev,ui)
{if(reps==1)
{var val=(prefix?prefix:'')+ui.value+(postfix?postfix:'');$label_1.html(val);if(fill)
$fill.val(val);}
reps=0;}});var $handles=$this.find('.ui-slider-handle');$label_1.html((prefix?prefix:'')+value+(postfix?postfix:''));$handles.html($label_1);}})}
if($.isFunction($.fn.knob))
{$(".knob").knob({change:function(value){},release:function(value){},cancel:function(){},draw:function(){if(this.$.data('skin')=='tron'){var a=this.angle(this.cv),sa=this.startAngle,sat=this.startAngle,ea,eat=sat+a,r=1;this.g.lineWidth=this.lineWidth;this.o.cursor&&(sat=eat-0.3)&&(eat=eat+0.3);if(this.o.displayPrevious){ea=this.startAngle+this.angle(this.v);this.o.cursor&&(sa=ea-0.3)&&(ea=ea+0.3);this.g.beginPath();this.g.strokeStyle=this.pColor;this.g.arc(this.xy,this.xy,this.radius-this.lineWidth,sa,ea,false);this.g.stroke();}
this.g.beginPath();this.g.strokeStyle=r?this.o.fgColor:this.fgColor;this.g.arc(this.xy,this.xy,this.radius-this.lineWidth,sat,eat,false);this.g.stroke();this.g.lineWidth=2;this.g.beginPath();this.g.strokeStyle=this.o.fgColor;this.g.arc(this.xy,this.xy,this.radius-this.lineWidth+1+this.lineWidth*2/3,0,2*Math.PI,false);this.g.stroke();return false;}}});}
if($.isFunction($.fn.wysihtml5))
{$(".wysihtml5").each(function(i,el)
{var $this=$(el),stylesheets=attrDefault($this,'stylesheet-url','')
$(".wysihtml5").wysihtml5({size:'white',stylesheets:stylesheets.split(','),"html":attrDefault($this,'html',true),"color":attrDefault($this,'colors',true),});});}
if($.isFunction($.fn.ckeditor))
{if($(".ckeditor").length){$(".ckeditor").ckeditor({contentsLangDirection:rtl()?'rtl':'ltr'});}}
if(typeof Dropzone!='undefined')
{Dropzone.autoDiscover=false;$(".dropzone[action]").each(function(i,el)
{$(el).dropzone();});}
if($.isFunction($.fn.tocify)&&$("#toc").length)
{$("#toc").tocify({context:'.tocify-content',selectors:"h2,h3,h4,h5"});var $this=$(".tocify"),watcher=scrollMonitor.create($this.get(0));$this.width($this.parent().width());watcher.lock();watcher.stateChange(function()
{$($this.get(0)).toggleClass('fixed',this.isAboveViewport)});}
$(".login-form .form-group:has(label)").each(function(i,el)
{var $this=$(el),$label=$this.find('label'),$input=$this.find('.form-control');$input.on('focus',function()
{$this.addClass('is-focused');});$input.on('keydown',function()
{$this.addClass('is-focused');});$input.on('blur',function()
{$this.removeClass('is-focused');if($input.val().trim().length>0)
{$this.addClass('is-focused');}});$label.on('click',function()
{$input.focus();});if($input.val().trim().length>0)
{$this.addClass('is-focused');}});});var wid=0;$(window).resize(function(){clearTimeout(wid);wid=setTimeout(trigger_resizable,200);});})(jQuery,window);var sm_duration=.2,sm_transition_delay=150;function setup_sidebar_menu()
{if(public_vars.$sidebarMenu.length)
{var $items_with_subs=public_vars.$sidebarMenu.find('li:has(> ul)'),toggle_others=public_vars.$sidebarMenu.hasClass('toggle-others');$items_with_subs.filter('.active').addClass('expanded');if(is('largescreen')&&public_vars.$sidebarMenu.hasClass('collapsed')==false)
{$(window).on('resize',function()
{if(is('tabletscreen'))
{public_vars.$sidebarMenu.addClass('collapsed');ps_destroy();}
else
if(is('largescreen'))
{public_vars.$sidebarMenu.removeClass('collapsed');ps_init();}});}
$items_with_subs.each(function(i,el)
{var $li=jQuery(el),$a=$li.children('a'),$sub=$li.children('ul');$li.addClass('has-sub');$a.on('click',function(ev)
{ev.preventDefault();if(toggle_others)
{sidebar_menu_close_items_siblings($li);}
if($li.hasClass('expanded')||$li.hasClass('opened'))
sidebar_menu_item_collapse($li,$sub);else
sidebar_menu_item_expand($li,$sub);});});}}
function sidebar_menu_item_expand($li,$sub)
{if($li.data('is-busy')||($li.parent('.main-menu').length&&public_vars.$sidebarMenu.hasClass('collapsed')))
return;$li.addClass('expanded').data('is-busy',true);$sub.show();var $sub_items=$sub.children(),sub_height=$sub.outerHeight(),win_y=jQuery(window).height(),total_height=$li.outerHeight(),current_y=public_vars.$sidebarMenu.scrollTop(),item_max_y=$li.position().top+current_y,fit_to_viewpport=public_vars.$sidebarMenu.hasClass('fit-in-viewport');$sub_items.addClass('is-hidden');$sub.height(0);TweenMax.to($sub,sm_duration,{css:{height:sub_height},onUpdate:ps_update,onComplete:function(){$sub.height('');}});var interval_1=$li.data('sub_i_1'),interval_2=$li.data('sub_i_2');window.clearTimeout(interval_1);interval_1=setTimeout(function()
{$sub_items.each(function(i,el)
{var $sub_item=jQuery(el);$sub_item.addClass('is-shown');});var finish_on=sm_transition_delay*$sub_items.length,t_duration=parseFloat($sub_items.eq(0).css('transition-duration')),t_delay=parseFloat($sub_items.last().css('transition-delay'));if(t_duration&&t_delay)
{finish_on=(t_duration+t_delay)*1000;}
window.clearTimeout(interval_2);interval_2=setTimeout(function()
{$sub_items.removeClass('is-hidden is-shown');},finish_on);$li.data('is-busy',false);},0);$li.data('sub_i_1',interval_1),$li.data('sub_i_2',interval_2);}
function sidebar_menu_item_collapse($li,$sub)
{if($li.data('is-busy'))
return;var $sub_items=$sub.children();$li.removeClass('expanded').data('is-busy',true);$sub_items.addClass('hidden-item');TweenMax.to($sub,sm_duration,{css:{height:0},onUpdate:ps_update,onComplete:function()
{$li.data('is-busy',false).removeClass('opened');$sub.attr('style','').hide();$sub_items.removeClass('hidden-item');$li.find('li.expanded ul').attr('style','').hide().parent().removeClass('expanded');ps_update(true);}});}
function sidebar_menu_close_items_siblings($li)
{$li.siblings().not($li).filter('.expanded, .opened').each(function(i,el)
{var $_li=jQuery(el),$_sub=$_li.children('ul');sidebar_menu_item_collapse($_li,$_sub);});}
function setup_horizontal_menu()
{if(public_vars.$horizontalMenu.length)
{var $items_with_subs=public_vars.$horizontalMenu.find('li:has(> ul)'),click_to_expand=public_vars.$horizontalMenu.hasClass('click-to-expand');if(click_to_expand)
{public_vars.$mainContent.add(public_vars.$sidebarMenu).on('click',function(ev)
{$items_with_subs.removeClass('hover');});}
$items_with_subs.each(function(i,el)
{var $li=jQuery(el),$a=$li.children('a'),$sub=$li.children('ul'),is_root_element=$li.parent().is('.navbar-nav');$li.addClass('has-sub');$a.on('click',function(ev)
{if(isxs())
{ev.preventDefault();if(true)
{sidebar_menu_close_items_siblings($li);}
if($li.hasClass('expanded')||$li.hasClass('opened'))
sidebar_menu_item_collapse($li,$sub);else
sidebar_menu_item_expand($li,$sub);}});if(click_to_expand)
{$a.on('click',function(ev)
{ev.preventDefault();if(isxs())
return;if(is_root_element)
{$items_with_subs.filter(function(i,el){return jQuery(el).parent().is('.navbar-nav');}).not($li).removeClass('hover');$li.toggleClass('hover');}
else
{var sub_height;if($li.hasClass('expanded')==false)
{$li.addClass('expanded');$sub.addClass('is-visible');sub_height=$sub.outerHeight();$sub.height(0);TweenLite.to($sub,.15,{css:{height:sub_height},ease:Sine.easeInOut,onComplete:function(){$sub.attr('style','');}});$li.siblings().find('> ul.is-visible').not($sub).each(function(i,el)
{var $el=jQuery(el);sub_height=$el.outerHeight();$el.removeClass('is-visible').height(sub_height);$el.parent().removeClass('expanded');TweenLite.to($el,.15,{css:{height:0},onComplete:function(){$el.attr('style','');}});});}
else
{sub_height=$sub.outerHeight();$li.removeClass('expanded');$sub.removeClass('is-visible').height(sub_height);TweenLite.to($sub,.15,{css:{height:0},onComplete:function(){$sub.attr('style','');}});}}});}
else
{$li.hoverIntent({over:function()
{if(isxs())
return;if(is_root_element)
{$li.addClass('hover');}
else
{$sub.addClass('is-visible');sub_height=$sub.outerHeight();$sub.height(0);TweenLite.to($sub,.25,{css:{height:sub_height},ease:Sine.easeInOut,onComplete:function(){$sub.attr('style','');}});}},out:function()
{if(isxs())
return;if(is_root_element)
{$li.removeClass('hover');}
else
{sub_height=$sub.outerHeight();$li.removeClass('expanded');$sub.removeClass('is-visible').height(sub_height);TweenLite.to($sub,.25,{css:{height:0},onComplete:function(){$sub.attr('style','');}});}},timeout:200,interval:is_root_element?10:100});}});}}
function stickFooterToBottom()
{public_vars.$mainFooter.add(public_vars.$mainContent).add(public_vars.$sidebarMenu).attr('style','');if(isxs())
return false;if(public_vars.$mainFooter.hasClass('sticky'))
{var win_height=jQuery(window).height(),footer_height=public_vars.$mainFooter.outerHeight(true),main_content_height=public_vars.$mainFooter.position().top+footer_height,main_content_height_only=main_content_height-footer_height,extra_height=public_vars.$horizontalNavbar.outerHeight();if(win_height>main_content_height-parseInt(public_vars.$mainFooter.css('marginTop'),10))
{public_vars.$mainFooter.css({marginTop:win_height-main_content_height-extra_height});}}}
function ps_update(destroy_init)
{if(isxs())
return;if(jQuery.isFunction(jQuery.fn.perfectScrollbar))
{if(public_vars.$sidebarMenu.hasClass('collapsed'))
{return;}
public_vars.$sidebarMenu.find('.sidebar-menu-inner').perfectScrollbar('update');if(destroy_init)
{ps_destroy();ps_init();}}}
function ps_init()
{if(isxs())
return;if(jQuery.isFunction(jQuery.fn.perfectScrollbar))
{if(public_vars.$sidebarMenu.hasClass('collapsed')||!public_vars.$sidebarMenu.hasClass('fixed'))
{return;}
public_vars.$sidebarMenu.find('.sidebar-menu-inner').perfectScrollbar({wheelSpeed:1,wheelPropagation:public_vars.wheelPropagation});}}
function ps_destroy()
{if(jQuery.isFunction(jQuery.fn.perfectScrollbar))
{public_vars.$sidebarMenu.find('.sidebar-menu-inner').perfectScrollbar('destroy');}}
function cbr_replace()
{var $inputs=jQuery('input[type="checkbox"].cbr, input[type="radio"].cbr').filter(':not(.cbr-done)'),$wrapper='<div class="cbr-replaced"><div class="cbr-input"></div><div class="cbr-state"><span></span></div></div>';$inputs.each(function(i,el)
{var $el=jQuery(el),is_radio=$el.is(':radio'),is_checkbox=$el.is(':checkbox'),is_disabled=$el.is(':disabled'),styles=['primary','secondary','success','danger','warning','info','purple','blue','red','gray','pink','yellow','orange','turquoise'];if(!is_radio&&!is_checkbox)
return;$el.after($wrapper);$el.addClass('cbr-done');var $wrp=$el.next();$wrp.find('.cbr-input').append($el);if(is_radio)
$wrp.addClass('cbr-radio');if(is_disabled)
$wrp.addClass('cbr-disabled');if($el.is(':checked'))
{$wrp.addClass('cbr-checked');}
jQuery.each(styles,function(key,val)
{var cbr_class='cbr-'+val;if($el.hasClass(cbr_class))
{$wrp.addClass(cbr_class);$el.removeClass(cbr_class);}});$wrp.on('click',function(ev)
{if(is_radio&&$el.prop('checked')||$wrp.parent().is('label'))
return;if(jQuery(ev.target).is($el)==false)
{$el.prop('checked',!$el.is(':checked'));$el.trigger('change');}});$el.on('change',function(ev)
{$wrp.removeClass('cbr-checked');if($el.is(':checked'))
$wrp.addClass('cbr-checked');cbr_recheck();});});}
function cbr_recheck()
{var $inputs=jQuery("input.cbr-done");$inputs.each(function(i,el)
{var $el=jQuery(el),is_radio=$el.is(':radio'),is_checkbox=$el.is(':checkbox'),is_disabled=$el.is(':disabled'),$wrp=$el.closest('.cbr-replaced');if(is_disabled)
$wrp.addClass('cbr-disabled');if(is_radio&&!$el.prop('checked')&&$wrp.hasClass('cbr-checked'))
{$wrp.removeClass('cbr-checked');}});}
function attrDefault($el,data_var,default_val)
{if(typeof $el.data(data_var)!='undefined')
{return $el.data(data_var);}
return default_val;}
function callback_test()
{alert("Callback function executed! No. of arguments: "+arguments.length+"\n\nSee console log for outputed of the arguments.");console.log(arguments);}
function date(format,timestamp){var that=this;var jsdate,f;var txt_words=['Sun','Mon','Tues','Wednes','Thurs','Fri','Satur','January','February','March','April','May','June','July','August','September','October','November','December'];var formatChr=/\\?(.?)/gi;var formatChrCb=function(t,s){return f[t]?f[t]():s;};var _pad=function(n,c){n=String(n);while(n.length<c){n='0'+n;}
return n;};f={d:function(){return _pad(f.j(),2);},D:function(){return f.l().slice(0,3);},j:function(){return jsdate.getDate();},l:function(){return txt_words[f.w()]+'day';},N:function(){return f.w()||7;},S:function(){var j=f.j();var i=j%10;if(i<=3&&parseInt((j%100)/10,10)==1){i=0;}
return['st','nd','rd'][i-1]||'th';},w:function(){return jsdate.getDay();},z:function(){var a=new Date(f.Y(),f.n()-1,f.j());var b=new Date(f.Y(),0,1);return Math.round((a-b)/864e5);},W:function(){var a=new Date(f.Y(),f.n()-1,f.j()-f.N()+3);var b=new Date(a.getFullYear(),0,4);return _pad(1+Math.round((a-b)/864e5/7),2);},F:function(){return txt_words[6+f.n()];},m:function(){return _pad(f.n(),2);},M:function(){return f.F().slice(0,3);},n:function(){return jsdate.getMonth()+1;},t:function(){return(new Date(f.Y(),f.n(),0)).getDate();},L:function(){var j=f.Y();return j%4===0&j%100!==0|j%400===0;},o:function(){var n=f.n();var W=f.W();var Y=f.Y();return Y+(n===12&&W<9?1:n===1&&W>9?-1:0);},Y:function(){return jsdate.getFullYear();},y:function(){return f.Y().toString().slice(-2);},a:function(){return jsdate.getHours()>11?'pm':'am';},A:function(){return f.a().toUpperCase();},B:function(){var H=jsdate.getUTCHours()*36e2;var i=jsdate.getUTCMinutes()*60;var s=jsdate.getUTCSeconds();return _pad(Math.floor((H+i+s+36e2)/86.4)%1e3,3);},g:function(){return f.G()%12||12;},G:function(){return jsdate.getHours();},h:function(){return _pad(f.g(),2);},H:function(){return _pad(f.G(),2);},i:function(){return _pad(jsdate.getMinutes(),2);},s:function(){return _pad(jsdate.getSeconds(),2);},u:function(){return _pad(jsdate.getMilliseconds()*1000,6);},e:function(){throw 'Not supported (see source code of date() for timezone on how to add support)';},I:function(){var a=new Date(f.Y(),0);var c=Date.UTC(f.Y(),0);var b=new Date(f.Y(),6);var d=Date.UTC(f.Y(),6);return((a-c)!==(b-d))?1:0;},O:function(){var tzo=jsdate.getTimezoneOffset();var a=Math.abs(tzo);return(tzo>0?'-':'+')+_pad(Math.floor(a/60)*100+a%60,4);},P:function(){var O=f.O();return(O.substr(0,3)+':'+O.substr(3,2));},T:function(){return 'UTC';},Z:function(){return-jsdate.getTimezoneOffset()*60;},c:function(){return 'Y-m-d\\TH:i:sP'.replace(formatChr,formatChrCb);},r:function(){return 'D, d M Y H:i:s O'.replace(formatChr,formatChrCb);},U:function(){return jsdate/1000|0;}};this.date=function(format,timestamp){that=this;jsdate=(timestamp===undefined?new Date():(timestamp instanceof Date)?new Date(timestamp):new Date(timestamp*1000));return format.replace(formatChr,formatChrCb);};return this.date(format,timestamp);}