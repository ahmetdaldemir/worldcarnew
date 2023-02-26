$.ajaxSetup({headers:{'X-CSRF-TOKEN':window.Laravel.csrf_token}});$(document).ajaxError(function(event,request,settings){if(request.status===401){window.location.href=window.Laravel.app_url+'/login';}else{if(request.statusText!=='abort'){toastr.error('İletişim hatası oluştu.','Hata!');}}});var app_url=$('meta[name="app-url"]').attr('content');var url_path=window.location.pathname;function showLaravelValidationMessages(form,messages,callback)
{var list=[];$.each(messages,function(name,messages){var label=$('label[for="'+name+'"]',form);$.each(messages,function(i,message){if(typeof label!==typeof undefined){var text=message.replace(name.replace('_',' '),label.text());label.parents('.form-group:eq(0)').addClass('has-error laravel-error').append('<p class="help-block laravel-message">'+text+'</p>');}
list.push(message);});});if(typeof callback!==typeof undefined){callback(list);}}
function showLaravelValidationMessagesList(messages,callback)
{var list=[];$.each(messages,function(name,messages){$.each(messages,function(i,message){list.push(message);});});if(typeof callback!==typeof undefined){callback(list);}}
function clearValidationMessages(form)
{$('p.help-block.laravel-message',form).remove();$('.has-error.laravel-error',form).removeClass('has-error laravel-error');}
$.fn.setNow=function(only_blank){var now=new Date($.now()),year,month,date,hours,minutes,formattedDateTime;year=now.getFullYear();month=now.getMonth().toString().length===1?'0'+(now.getMonth()+1).toString():now.getMonth()+1;date=now.getDate().toString().length===1?'0'+(now.getDate()).toString():now.getDate();hours=now.getHours().toString().length===1?'0'+now.getHours().toString():now.getHours();minutes=now.getMinutes().toString().length===1?'0'+now.getMinutes().toString():now.getMinutes();formattedDateTime=year+'-'+month+'-'+date+'T'+hours+':'+minutes;if(only_blank===true&&$(this).val()){return this;}
$(this).val(formattedDateTime);return this;};Object.size=function(obj){var size=0,key;for(key in obj){if(obj.hasOwnProperty(key))size++;}
return size;};function currencyPrice(price,exchange_currency_code,given_currency_code,callback)
{if(given_currency_code!=='TRY'){price=parseFloat(price)*parseFloat(window.Laravel.currencies.rates[given_currency_code]);}
if(exchange_currency_code!=='TRY'){price=parseFloat(price)/parseFloat(window.Laravel.currencies.rates[exchange_currency_code]);}
if(typeof callback==='function'){callback(price);return;}
return price;}
$.iframeLoad=function(target,target_in_iframe,counter,callback)
{var content=$(target).contents().find(target_in_iframe);if(content.length>0){callback(content);}else{if(counter<=90){setTimeout(function(){$.iframeLoad(target,target_in_iframe,++content,callback);},500);}else{alert('Iframe yükleme başarısız!');}}};$.deleteConfirmation=function(title,message,button_name,callback)
{if(typeof callback!==typeof undefined)
{var modal=$('#confirmation-modal-div');if(typeof title===typeof undefined||title===null){$('.modal-title',modal).addClass('hidden');}
else{$('.modal-title',modal).removeClass('hidden').html(title);}
if(typeof message===typeof undefined||message===null){$('.modal-body',modal).addClass('hidden');}
else{$('.modal-body',modal).removeClass('hidden').html(message);}
if(typeof button_name===typeof undefined||button_name===null){$('.confirm-button',modal).html('Onayla');}
else{$('.confirm-button',modal).html(button_name);}
$('.confirm-button',modal).click(function(){modal.modal('hide');callback(true);});$('.cancel-button',modal).click(function(){modal.modal('hide');callback(false);});$(document).bind("keypress.deleteModalKeys",function(event){if(event.which===13){$('.confirm-button',modal).click();}});modal.modal({backdrop:'static',keyboard:false});}};$('#confirmation-modal-div').on('hidden.bs.modal',function(){var modal=$('#confirmation-modal-div');$('.confirm-button',modal).unbind('click');$('.cancel-button',modal).unbind('click');$(document).unbind("keypress.deleteModalKeys");});function sortTable(table,n)
{var tbody,rows,switching,i,x,y,shouldSwitch,dir,switchcount=0;tbody=table[0].getElementsByTagName("TBODY");switching=true;dir="asc";while(switching){switching=false;rows=tbody[0].getElementsByTagName("TR");for(i=1;i<(rows.length-1);i++){shouldSwitch=false;x=rows[i].getElementsByTagName("TD")[n];y=rows[i+1].getElementsByTagName("TD")[n];if(dir==="asc"){if(parseFloat(x.innerHTML)>parseFloat(y.innerHTML)){shouldSwitch=true;break;}}else if(dir==="desc"){if(parseFloat(x.innerHTML)<parseFloat(y.innerHTML)){shouldSwitch=true;break;}}}
if(shouldSwitch){rows[i].parentNode.insertBefore(rows[i+1],rows[i]);switching=true;switchcount++;}else{if(switchcount===0&&dir==="asc"){dir="desc";switching=true;}}}}
$.fn.outerHTML=function()
{return(!this.length)?this:(this[0].outerHTML||(function(el){var div=document.createElement('div');div.appendChild(el.cloneNode(true));var contents=div.innerHTML;div=null;return contents;})(this[0]));};$.fn.scrollStopped=function(callback){var that=this,$this=$(that);$this.scroll(function(ev){clearTimeout($this.data('scrollTimeout'));$this.data('scrollTimeout',setTimeout(callback.bind(that),50,ev));});};$.fn.isInViewportContainer=function(container)
{var elementTop=$(this).position().top;var elementBottom=elementTop+$(this).outerHeight();var viewportTop=container.scrollTop();var viewportBottom=viewportTop+container.height();console.log(elementBottom,viewportTop,elementTop,viewportBottom);return elementBottom>viewportTop&&elementTop<viewportBottom;};