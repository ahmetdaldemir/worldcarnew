var DataManipulator=function(){var dataIndex=function(obj,is,value){if(typeof is==='string'){return dataIndex(obj,is.split('.'),value);}
else if(is.length===1&&value!==undefined){return obj[is[0]]=value===''?null:value;}
else if(is.length===0){return obj;}
else{if(typeof value===typeof undefined&&obj===null){return null;}
if(!obj.hasOwnProperty(is[0])){obj[is[0]]=typeof value==='object'?{}:null;}
return dataIndex(obj[is[0]],is.slice(1),value);}};this.set=function(data,key,value){if(!key.includes('.')){if(value===''){value=null;}
data[key]=value;return;}
dataIndex(data,key,value);}
this.get=function(data,key){if(!key.includes('.')){return data[key];}
return dataIndex(data,key);}
this.tempObject=function(object){var tempObject={};for(var key in object){if(object.hasOwnProperty(key)){tempObject[key]=object[key];}}
return tempObject;}};var dm=new DataManipulator();