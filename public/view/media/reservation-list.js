'use strict';var ReservationList=function(options){var data={loaded:false,customFilters:{}};var doms={filterForm:null,container:null,tbody:null,filterButton:null,loader:null,}
var methods={run:function(){if(typeof options==='object'){if(options.hasOwnProperty('containerSelector')){doms.container=$(options.containerSelector);doms.tbody=$('table > tbody',doms.container);}
if(options.hasOwnProperty('filterFormSelector')){doms.filterForm=$(options.filterFormSelector)}
if(options.hasOwnProperty('filterButtonSelector')){doms.filterButton=$(options.filterButtonSelector)}
if(options.hasOwnProperty('loaderSelector')){doms.loader=$(options.loaderSelector)}
if(options.hasOwnProperty('filters')){for(var key in options.filters){if(options.filters.hasOwnProperty(key)){data.customFilters[key]=options.filters[key];}}}
if(options.hasOwnProperty('get')){if(options.get===true){methods.getReservations();}}
methods.registerEvents();}},registerEvents:function(){if(doms.filterButton!==null){doms.filterButton.click(function(){if(!doms.filterButton.hasClass('disabled')){methods.getReservations();}});}
if(doms.filterForm!==null){doms.filterForm.on('change dp.change','input, select',function(){methods.getReservations();});}},serializeData:function(){var serializedData='';if(doms.filterForm!==null){serializedData=doms.filterForm.serialize()}
for(var key in data.customFilters){if(data.customFilters.hasOwnProperty(key)){serializedData+='&'+key+'='+data.customFilters[key];}}
return serializedData;},getReservations:function(){if(doms.tbody===null){toastr.error('Rezervasyon listesi için parametreler hatalı');return;}
var serializedData=methods.serializeData();if(serializedData===''){toastr.error('Rezervasyon listesi için parametreler hatalı');return;}
$.ajax({url:window.Laravel.routes.reservations.data,type:'get',dataType:'json',data:serializedData,beforeSend:function(){if(doms.loader!==null){doms.loader.removeClass('loaded');}
if(doms.filterButton!==null){doms.filterButton.addClass('disabled');}},complete:function(){if(doms.loader!==null){doms.loader.addClass('loaded');}
if(doms.filterButton!==null){doms.filterButton.removeClass('disabled');}},success:function(response){data.loaded=true;doms.tbody.html(response.html);$('[data-toggle="tooltip"]',doms.tbody).tooltip();$('[data-toggle="popover"]',doms.tbody).popover();}});}}
this.getReservations=function(oneTime){if(typeof oneTime===typeof undefined||oneTime===false||(oneTime===true&&data.loaded===false)){methods.getReservations();}};methods.run();}