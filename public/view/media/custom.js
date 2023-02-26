(function($){$(document).ready(function(){'use strict';moment.locale(window.Laravel.locale);var body=$('body');var main_menu=$('#main-menu');var medias_modal=$('#medias-modal');var notes_modal=$('#notes-modal');var sidebar_activate_item=$('a[href="'+app_url+url_path+'"]',main_menu);$.notification_audio=new Audio(window.Laravel.app_url+'/sounds/oringz-w438.mp3');if(sidebar_activate_item.length>0){sidebar_activate_item.parents('li').addClass('active opened');}else{var active_route=main_menu.attr('data-active-route');if(active_route!==''){$('li[data-route="'+active_route+'"]').addClass('active opened').parents('li').addClass('active opened');}}
if($(window).width()>767){$('.sidebar-menu').addClass('collapsed');}
if(typeof window.Laravel.alert.message!==typeof undefined){var message=window.Laravel.alert.message,status='info',title=null;if(window.Laravel.alert.status==='success'||window.Laravel.alert.status==='warning'||window.Laravel.alert.status==='error'){status=window.Laravel.alert.status;}
if(typeof window.Laravel.alert.title!==typeof undefined){title=window.Laravel.alert.title;}
toastr[status](message,title);}
$('.jobs-input').tagsInput({'autocomplete_url':app_url+'/jobs/autocomplete','autocomplete':{selectFirst:true,width:'100px',autoFill:true},'defaultText':'ekle'});$('.country-input').tagsInput({'autocomplete_url':app_url+'/countries/autocomplete','autocomplete':{selectFirst:true,width:'100px',autoFill:true},'defaultText':'ekle'});$('.autocomplete-input').each(function(){var source=$(this).attr('data-autocomplete-source');$(this).autocomplete({source:source,minLength:2});});$.applySelect2=function(main_root,class_name)
{if(typeof main_root===typeof undefined){main_root=body;}
if(typeof class_name===typeof undefined){class_name='select2';}
$('.'+class_name,main_root).select2({dropdownAutoWidth:true});$('.general-'+class_name,main_root).each(function(){var select2=$(this);var url=select2.attr('data-url');if(url===''){return;}
var minimum=select2.attr('data-minimum');var maximum=select2.attr('data-maximum');var multiple=select2.attr('multiple');var allow_clear=select2.attr('data-allow-clear');var placeholder=select2.attr('data-placeholder');var value_field=select2.attr('data-field-value');var text_field=select2.attr('data-field-text');minimum=typeof minimum===typeof undefined?2:minimum;maximum=typeof maximum===typeof undefined||maximum===''?1000:maximum;placeholder=typeof placeholder===typeof undefined?'Seçin':placeholder;multiple=typeof multiple!==typeof undefined&&(multiple==='true'||multiple==='multiple');allow_clear=typeof allow_clear!==typeof undefined;value_field=typeof value_field===typeof undefined||value_field===''?'id':value_field;text_field=typeof text_field===typeof undefined||text_field===''?'name':text_field;select2.select2({ajax:{url:url,dataType:'json',delay:250,data:function(params){return{term:params.term,page:params.page};},processResults:function(data,params){params.page=params.page||1;return{results:data.items.map(function(item){item.id=item[value_field];item.text=item[text_field];return item;}),pagination:{more:(params.page*30)<data.total_count}};},cache:true},minimumInputLength:minimum,maximumInputLength:maximum,placeholder:placeholder,allowClear:allow_clear,width:'100%',multiple:multiple,escapeMarkup:function(markup){return markup;},templateResult:function(data){if(data.id===''){return 'Custom styled placeholder text';}
return typeof data.name===typeof undefined?data.text:data.name;},templateSelection:function template(data,container){return typeof data.name===typeof undefined?data.text:data.name;}});});};$.applySelect2();$(".general-select2").each(function(){var select2=$(this);var url=select2.attr('data-url');var minimum=select2.attr('data-minimum');var multiple=select2.attr('multiple');var allow_clear=select2.attr('data-allow-clear');minimum=typeof minimum==typeof undefined?2:minimum;var placeholder=select2.attr('data-placeholder');placeholder=typeof placeholder==typeof undefined?2:placeholder;multiple=typeof multiple!=typeof undefined&&(multiple=='true'||multiple=='multiple')?true:false;allow_clear=typeof allow_clear==typeof undefined?false:true;select2.select2({ajax:{url:url,dataType:'json',delay:250,data:function(params){return{term:params.term,page:params.page};},processResults:function(data,params){params.page=params.page||1;return{results:data.items,pagination:{more:(params.page*30)<data.total_count}};},cache:true},minimumInputLength:minimum,placeholder:'Ara & Seç',allowClear:allow_clear,width:'100%',multiple:multiple,escapeMarkup:function(markup){return markup;},templateResult:function(data){if(data.id===''){return 'Custom styled placeholder text';}
return typeof data.name==typeof undefined?data.text:data.name;},templateSelection:function template(data,container){return typeof data.name==typeof undefined?data.text:data.name;}});});$(".person-select-pivot").each(function(){var selector=$(this);var data_input=$(selector.attr('data-input'));var pivot_list=$(selector.attr('data-result-selector'));selector.autocomplete({source:function(request,response){jQuery.get(app_url+'/persons/select',{term:request.term},function(data){var items=data.items;var list=[];for(var i=0;i<data.total_count;i++){list.push({value:items[i].name,id:items[i].id});}
response(list);});},select:function(event,ui){selectPivotAdd(pivot_list,ui.item.id,ui.item.value,'',function(){pivot_list.trigger('change');});$(event.target).val('');return false;},minLength:2});pivot_list.change(function(){selectPivotDataUpdate(data_input,pivot_list);});selectPivotBuild(data_input,pivot_list);});function selectPivotAdd(root,id,name,pivot,callback)
{var selected='<li data-id="'+id+'"><div class="input-group"><input type="text" name="p_name" readonly class="form-control" value="'+name+'" /><span class="input-group-addon">Rol Adı:</span><input type="text" name="p_pivot" class="form-control" value="'+pivot+'" /></div></li>';root.append(selected);if(typeof callback!=typeof undefined){callback();}}
function selectPivotDataUpdate(data_input,pivot_list)
{var list=[];$('li',pivot_list).each(function(event,ui){var li=$(this);list.push({id:li.attr('data-id'),name:$('input[name="p_name"]',li).val(),pivot:$('input[name="p_pivot"]',li).val()});});data_input.val(JSON.stringify(list));}
function selectPivotBuild(data_input,pivot_list)
{var data=data_input.val();if(data!=''){var list=$.parseJSON(data);for(var i=0;i<list.length;i++){selectPivotAdd(pivot_list,list[i].id,list[i].name,list[i].pivot);}}}
$('.image-poppover').popover({trigger:'hover',placement:'top',html:true});$('select.select-load').each(function(){var select=$(this);var selected=select.attr('data-selected');var source_select_selector=select.attr('data-select');var source_ajax=select.attr('data-source');var source_select=select.parents('form:eq(0)').find(source_select_selector);if(typeof source_select!=typeof undefined&&source_select.length>0){source_select.change(function(){var source_select=$(this);var source_selected=$('option:selected',source_select).val();select.html('');$.ajax({url:source_ajax,type:'get',data:{country_id:source_selected},dataType:'json',success:function(data){if(typeof data=='object'&&data.length>0){$.each(data,function(i,city){select.append('<option value="'+city.id+'">'+city.name+'</option>');});}else{select.append('<option value="">Şehir bulunamadı!</option>');}
$('option[value="'+selected+'"]',select).prop('selected',true);},error:function(data){alert('Bir ahata oluştu! Şehirler getrilemedi.')}});}).trigger('change');}});$('.language-tabs').each(function(){var root=$(this);$('.tab-pane',this).each(function(){var id=$(this).attr('id');var count=$('.form-group.has-error',this).length;if(count>0){$('a[href="#'+id+'"]',root).parents('li:eq(0)').append('<span class="error-count">'+count+'</span>');}});});$('.filter-button').click(function(){var form=$(this).parents('form:eq(0)');if(typeof form!==typeof undefined&&form.length>0){form.prepend('<input type="hidden" name="only_filter_apply" value="1" />');setTimeout(function(){form.submit();},150);}});$(".multi-select").multiSelect({afterInit:function()
{this.$selectableContainer.add(this.$selectionContainer).find('.ms-list').perfectScrollbar();},afterSelect:function()
{this.$selectableContainer.add(this.$selectionContainer).find('.ms-list').perfectScrollbar('update');}});$('.find-db').click(function(){var settings_json=$(this).attr('data-settings');var settings=JSON.parse(settings_json);settings.value=prompt(settings.message);if(settings.value!=''&&settings.value!=null){$.ajax({url:settings.url,type:settings.type,data:settings,success:function(data){if(data!=''){window.location.href=settings.data;}else{alert('Bulunamadı.');}},error:function(data){alert('Hata oldu.');}});}});body.on('click touchend','.js-link',function(e){e.preventDefault();if($(e.target).hasClass('js-link-none')||$(e.target).parents('.js-link-none').length>0){return false;}
var item=$(this);var href_link=item.attr('data-href');window.location.href=href_link;});$('.mail-single .write-message').click(function(){var input=$(this).parents('.mail-single:eq(0)').find('.mail-single-reply');input.focus();body.stop().animate({scrollTop:input.offset().top},'700','linear',function(){});});$('.reconciliation-table tr').mouseenter(function()
{var tr=$(this);var type=tr.attr('data-type');var connect=tr.attr('data-connect');$('tr[data-connect="'+connect+'"]').addClass('connected');}).mouseleave(function()
{var tr=$(this);var type=tr.attr('data-type');var connect=tr.attr('data-connect');$('tr[data-connect="'+connect+'"]').removeClass('connected');});body.on('click','.btn-medias',function()
{var btn=$(this);var table_type=btn.attr('data-table-type');var table_id=btn.attr('data-table-id');$.openMediasModal(table_type,table_id);});$.openMediasModal=function(table_type,table_id)
{$('.modal-content',medias_modal).append($('<iframe>',{src:window.Laravel.routes.medias.iframe+'?table_type='+table_type+'&table_id='+table_id,id:'medias-iframe',frameborder:0,scrolling:'no'}));medias_modal.modal('show');};medias_modal.on('hidden.bs.modal',function(){$('.modal-content',medias_modal).html('');});$.applyDatePickers=function(dom)
{$('.date-picker',dom).datetimepicker({locale:'tr_TR',format:'DD.MM.YYYY',showTodayButton:true});$('.date-m-picker',dom).datetimepicker({locale:'tr_TR',format:'MM',showTodayButton:true});$('.date-my-picker',dom).datetimepicker({locale:'tr_TR',format:'MM.YYYY',showTodayButton:true});$('.time-picker',dom).datetimepicker({locale:'tr_TR',format:'LT',showTodayButton:true,stepping:10});$('.date-time-picker',dom).datetimepicker({locale:'tr_TR',format:'DD.MM.YYYY HH:mm',showTodayButton:true,stepping:5});};$.applyDatePickers(body);$.widget("custom.catcomplete",$.ui.autocomplete,{_create:function(){this._super();this.widget().menu("option","items","> :not(.ui-autocomplete-category)");},_renderMenu:function(ul,items){var that=this,currentCategory="";$.each(items,function(index,item){var li;if(item.search_group!==currentCategory){ul.append("<li class='ui-autocomplete-category "+item.search_group+"'>"+item.search_group+"</li>");currentCategory=item.search_group;}
li=that._renderItemData(ul,item);if(item.search_group){li.attr("aria-label",item.search_group+" : "+item.label);}});},_renderItem:function(ul,item){return $("<li>").addClass(item.search_group).attr("data-value",item.value).append($("<a>").text(item.label)).attr('href',item.link).appendTo(ul);}});var search_form=$('form[name="userinfo_search_form"]');$('input',search_form).catcomplete({source:function(request,response)
{$.ajax({url:window.Laravel.routes.ajax_search,type:'post',data:{keyword:request.term},dataType:'json',beforeSend:function()
{$('form[name="userinfo_search_form"] button i').removeClass('linecons-search').addClass('fa-spin').addClass('fa-spinner');},complete:function()
{$('form[name="userinfo_search_form"] button i').addClass('linecons-search').removeClass('fa-spin').removeClass('fa-spinner')},success:function(data)
{response(data);},error:function()
{}});},minLength:2,select:function(event,ui){window.open(ui.item.link);return false;},position:{collision:"flip"}});search_form.on('click','.btn',function()
{$('input',search_form).catcomplete('search');});$('.sw-source').change(function()
{var sw_source=$(this);var sw_name=sw_source.attr('data-sw-name');var value=sw_source.val();$('.sw-target[data-sw-name="'+sw_name+'"]').each(function(i,ui)
{var sw_target=$(this);var filter=sw_target.attr('data-filter');var filters=filter.split('|');for(var j=0;j<filters.length;j++){if(value===filters[j]){sw_target.removeClass('hidden');break;}else{sw_target.addClass('hidden');}}});}).trigger('change');body.on('click','.btn-notes',function()
{var button=$(this);var modal_title='Notlar',table_type=button.attr('data-table-type'),table_id=button.attr('data-table-id'),title=button.attr('data-title'),types=$.parseJSON(button.attr('data-types'));if(typeof title!==typeof undefined&&title!==''){modal_title=title;}
if(!button.hasClass('disabled')){$.ajax({url:window.Laravel.routes.notes.list,type:'post',dataType:'json',data:{table_type:table_type,table_id:table_id},beforeSend:function()
{$('.notes-area',notes_modal).html('');button.addClass('disabled');},complete:function()
{button.removeClass('disabled');},success:function(data)
{$('input[name="table_type"]',notes_modal).val(table_type);$('input[name="table_id"]',notes_modal).val(table_id);$('.modal-title',notes_modal).html(modal_title);$('.notes-area',notes_modal).html(data.html);$.each(types,function(i,type)
{var selected=type.selected?'selected="selected"':null;$('select[name="type"]',notes_modal).append('<option value="'+type.value+'" '+selected+'>'+type.text+'</option>');});notes_modal.modal('show');button.addClass('active');},error:function(data)
{toastr.error('Notlar alınamadı!','Hata!')}});}});notes_modal.on('click','.btn-add',function()
{var button=$(this);if(!button.hasClass('disabled')){$.ajax({url:window.Laravel.routes.notes.store,type:'post',dataType:'json',data:$('form',notes_modal).serialize(),beforeSend:function()
{button.addClass('disabled');},complete:function()
{button.removeClass('disabled');},success:function(data)
{toastr.success('Not eklendi','Başarılı!');notes_modal.modal('hide');},error:function(data)
{toastr.error('Notlar alınamadı!','Hata!');}});}});notes_modal.on('hidden.bs.modal',function(){$('input[name="content"]',notes_modal).val('');$('input[name="table_type"]',notes_modal).val('');$('input[name="table_id"]',notes_modal).val('');$('select[name="type"] option',notes_modal).remove();$('.notes-area',notes_modal).html('');$('.btn-notes.active').removeClass('active');});CKEDITOR.editorConfig=function(config){config.language=window.Laravel.locale;config.allowedContent=true;config.entities=false;};$('.modal').on('hidden.bs.modal',function(e){if($('.modal').hasClass('in')){$('body').addClass('modal-open');}});$.buttonOnProcess=function(button)
{if(button.prop('tagName')==='INPUT'){if(button.hasClass('disabled')){button.removeClass('disabled').siblings('span.waiter').remove();}else{button.addClass('disabled');$('<span class="waiter '+button.attr('class')+'">İşleniyor <i class="fa-spin fa-spinner"></i></span>').insertAfter(button);}}else{if(button.hasClass('disabled')){button.removeClass('disabled').html(button.attr('data-button-content'));}else{button.addClass('disabled').attr('data-button-content',button.html()).html('İşleniyor <i class="fa-spin fa-spinner"></i>');}}};body.on('click','.submit-button',function()
{$.buttonOnProcess($(this));});$.areaLoaderProcess=function(button)
{var relation=button.attr('data-loader-selector-relation');var selector=button.attr('data-loader-selector');var target=null;if(relation==='siblings'){target=button.siblings(selector);}
else if(relation==='parents'){target=button.parents(selector);}
if(target!==null&&target.length>0){if(button.hasClass('area-loader-applied')){$('.page-loading-overlay',target).remove();button.removeClass('area-loader-applied');}else{target.append('<div class="page-loading-overlay absolute-overlay"><div class="loader-2"></div></div>');button.addClass('area-loader-applied');}}};body.on('click','.area-loader',function()
{$.areaLoaderProcess($(this));});body.on('click','.btn-remove-global',function()
{var button=$(this);var title=button.attr('data-title');var message=button.attr('data-message');var name=button.attr('data-name');if(typeof title===typeof undefined||title===''){title='Silme Onayı';}
if(typeof message===typeof undefined||message===''){message='Kayıt silinecek!';}
if(typeof name===typeof undefined||name===''){name='Sil';}
$.deleteConfirmation(title,message,name,function(status)
{if(status){var data=$.parseJSON(button.attr('data-data'));var url=button.attr('data-url');var redirect_url=button.attr('data-redirect-url');var remove_selector=button.attr('data-remove-selector');var trigger_selector=button.attr('data-trigger-selector');var trigger_type=button.attr('data-trigger-type');$.ajax({url:url,dataType:'json',type:'delete',data:data,beforeSend:function()
{button.addClass('disabled');button.html('<i class="fa-spinner fa-spin"></i> İşleniyor..');},complete:function()
{button.removeClass('disabled');button.html(button_html);},success:function(data)
{if(data.status==='success'){if(typeof remove_selector!==typeof undefined&&remove_selector!==''){$(remove_selector).remove();}
else if(typeof trigger_selector!==typeof undefined&&trigger_selector!==''){if(trigger_selector==='data-table-reload'){button.parents('table.dataTable').eq(0).DataTable().ajax.reload();}else{$(trigger_selector).trigger(trigger_type);}}
else if(typeof redirect_url!==typeof undefined&&redirect_url!==''){setTimeout(function()
{window.location.href=redirect_url;},1000);}
if(typeof data.message!==typeof undefined){toastr.success(data.message,data.title);}}else{toastr.warning(data.message,data.title);}},error:function(data)
{if(data.status!==401&&data.status!==422&&data.status!==403){toastr.error('Hata oluştu!');}}})}});});if(isxs()){public_vars.$sidebarMenu.removeClass('collapsed');}
$('.btn-cancel-reservations').click(function(){var button=$(this);if(!button.hasClass('disabled')){$.ajax({url:window.Laravel.routes.reservations.cancelled_supplier,dataType:'json',type:'post',data:{},beforeSend:function()
{button.addClass('disabled');$('i',button).attr('class','fa-spinner fa-spin');$('#modal-cancelled-supplier-reservations tbody').html('<tr><td class="text-center"><i class="fa-spinner fa-spin"></i> Yükleniyor</td></tr>');},complete:function()
{button.removeClass('disabled');$('i',button).attr('class','fa-ban');},success:function(data)
{var modal_dom=$('#modal-cancelled-supplier-reservations');var tbody=$('tbody',modal_dom);tbody.html('');modal_dom.modal('show');$.each(data.reservations,function(i,reservation)
{tbody.append('<tr><td>'+reservation.customer.first_name+' '+reservation.customer.last_name+'</td><td>'+reservation.start_branch.code+'</td><td>'+moment(reservation.start_date_time,'YYYY-MM-DD hh:mm:ss').format('ll')+'</td></tr>')});},error:function(data)
{if(data.status!==401&&data.status!==422&&data.status!==403){toastr.error('İptal olan rezervasyonlar alınamadı','Hata!');}}})}});$.areaLoaderProcess=function(button){var relation=button.attr('data-loader-selector-relation');var selector=button.attr('data-loader-selector');var target=null;if(relation==='siblings'){target=button.siblings(selector);}
else if(relation==='parents'){target=button.parents(selector);}
if(target!==null&&target.length>0){if(button.hasClass('area-loader-applied')){$.areaLoader(target,'remove');button.removeClass('area-loader-applied');}else{$.areaLoader(target,'add');button.addClass('area-loader-applied');}}};$.areaLoader=function(target,type){if(type==='add'){target.append('<div class="page-loading-overlay absolute-overlay"><div class="loader-2"></div></div>');}else if(type==='remove'){$('.page-loading-overlay',target).remove();}};body.on('click','.area-loader',function(){$.areaLoaderProcess($(this));});$.applyMorphUserSelect=function(main_root)
{var root=typeof main_root===typeof undefined?body:main_root;$('[data-morph-user-root]',root).each(function(i,ui){new MorphUserSelect({root:ui});})};$.applyMorphUserSelect(body);$('[data-c2c-office]').click(function(){var callerNumber=prompt('Arayan Numara',window.Laravel.callerNumber);if(callerNumber===null||callerNumber===''){return;}
if(window.Laravel.callerNumber===''){window.Laravel.callerNumber=callerNumber;}
$.ajax({url:window.Laravel.routes.click_to_call.office,type:'post',data:{caller_number:callerNumber},dataType:'json',success:function(response){toastr[response.status](response.message,response.title);},error:function(){toastr.error('Arama hizmetine bağlanılamadı');}});});$.applyCustomerClick2Call=function(main_root)
{var root=typeof main_root===typeof undefined?body:main_root;$('[data-c2c-customer-phone-number-id]',root).click(function(){var customerId=$(this).attr('data-c2c-customer-phone-number-id');if(customerId===''){return;}
var callerNumber=prompt('Arayan Numara',window.Laravel.callerNumber);if(callerNumber===null||callerNumber===''){return;}
if(window.Laravel.callerNumber===''){window.Laravel.callerNumber=callerNumber;}
$.ajax({url:window.Laravel.routes.click_to_call.customer_phone,type:'post',data:{caller_number:callerNumber,id:customerId},dataType:'json',success:function(response){toastr[response.status](response.message,response.title);},error:function(){toastr.error('Arama hizmetine bağlanılamadı');}});});};$.applyCustomerClick2Call(body);});})(jQuery);