function NewOdnaknopka2() {
this.domain=location.href+'/';
this.domain=this.domain.substr(this.domain.indexOf('://')+3);
this.domain=this.domain.substr(0,this.domain.indexOf('/'));
this.location=false;
this.selection=function() {
var sel;
if (window.getSelection) sel=window.getSelection();
else if (document.selection) sel=document.selection.createRange();
else sel='';
if (sel.text) sel=sel.text;
return encodeURIComponent(sel);
}
this.redirect=function() {
if (this.location) location.href=this.location;
this.location=false;
}
this.go=function(i) {
this.location=this.url(i);
setTimeout('odnaknopka2.redirect()',2000);
var scr=document.createElement('script'); 
scr.type='text/javascript'; 
scr.src='http://odnaknopka.ru/save2/?domain='+this.domain+'&system='+i; 
document.body.appendChild(scr);
return false;
}
this.url=function(system) {
var title=encodeURIComponent(document.title);
var url=encodeURIComponent(location.href);
switch (system) {
case 1: return 'http://memori.ru/link/?sm=1&u_data[url]='+url+'&u_data[name]='+title;
case 2: return 'http://bobrdobr.ru/addext.html?url='+url+'&title='+title;
case 3: return 'http://www.google.com/bookmarks/mark?op=add&bkmk='+url+'&title='+title;
case 4: return 'http://zakladki.yandex.ru/userarea/links/addfromfav.asp?bAddLink_x=1&lurl='+url+'&lname='+title;
case 5: return 'http://twitter.com/home?status='+title+' '+url;
case 6: return 'http://del.icio.us/post?v=4&noui&jump=close&url='+url+'&title='+title;
case 7: return 'http://text20.ru/add/?source='+url+'&title='+title+'&text='+this.selection();
case 8: return 'http://news2.ru/add_story.php?url='+url;
case 9: return 'http://www.mister-wong.ru/index.php?action=addurl&bm_url='+url+'&bm_description='+title;
case 10: return 'http://moemesto.ru/post.php?url='+url+'&title='+title;
case 11: return 'http://smi2.ru/add/?url='+url+'&precaption='+title;
case 12: return 'http://www.vaau.ru/submit/?action=step2&url='+url;
case 13: return 'http://myscoop.ru/add/?URL='+url+'&title='+title;
case 14: return 'http://www.linkstore.ru/servlet/LinkStore?a=add&url='+url+'&title='+title;
case 15: return 'http://www.ruspace.ru/index.php?link=bookmark&action=bookmarkNew&bm=1&url='+url+'&title='+title;
case 16: return 'http://www.100zakladok.ru/save/?bmurl='+url+'&bmtitle='+title;
}
}
this.hide=function() {
if (this.timeout) clearTimeout(this.timeout);
document.getElementById('odnaknopka').style.visibility='hidden';
}
this.show=function(element) {
if (this.timeout) clearTimeout(this.timeout);
var left=0,top=0;
var style=document.getElementById('odnaknopka').style;
while (element) {
left+=element.offsetLeft;
top+=element.offsetTop;
element=element.offsetParent;
}
style.left=left+'px';
style.top=top+'px';
style.visibility='visible';
}
this.init=function() {
var titles=new Array('Memori','&#1041;&#1086;&#1073;&#1088;&#1044;&#1086;&#1073;&#1088;','&#1047;&#1072;&#1082;&#1083;&#1072;&#1076;&#1082;&#1080; Google','&#1071;&#1085;&#1076;&#1077;&#1082;&#1089;.&#1047;&#1072;&#1082;&#1083;&#1072;&#1076;&#1082;&#1080;','Twitter','del.icio.us','&#1058;&#1077;&#1082;&#1089;&#1090; 2.0','News2','&#1052;&#1080;&#1089;&#1090;&#1077;&#1088; &#1042;&#1086;&#1085;&#1075;','&#1052;&#1086;&#1105;&#1052;&#1077;&#1089;&#1090;&#1086;','&#1057;&#1052;&#1048; 2','&#1042;&#1072;&#1072;&#1091;!','AddScoop','LinkStore','RuSpace','&#1057;&#1090;&#1086; &#1047;&#1072;&#1082;&#1083;&#1072;&#1076;&#1086;&#1082;');
if (!document.getElementById('odnaknopka')) {
var div=document.createElement('div');
div.id='odnaknopka';
div.style.position='absolute';
div.style.visibility='hidden';
div.style.width='264px';
div.style.height='182px';
div.style.backgroundColor='transparent';
div.style.backgroundImage='url(http://odnaknopka.ru/images/panel.png)';
div.style.border='0';
div.style.margin='0';
div.style.padding='0 1px 4px 1px';
div.style.overflow='hidden';
div.style.zIndex='1000';
div.style.font='normal 12px arial';
div.style.lineHeight='20px';
div.style.color='#666';
html='<a href="http://odnaknopka.ru" onclick="window.open(\'http://odnaknopka.ru/add/?url=\'+encodeURIComponent(location.href)+\'&title=\'+encodeURIComponent(document.title),\'odnaknopka\',\'scrollbars=yes,menubar=no,width=600,height=500,left='+(document.body.clientWidth/2-300)+',top='+(document.body.clientHeight/2-250)+',resizable=yes,toolbar=no,location=no,status=no\');return false;" style="display:block;float:left;width:258px;height:20px;overflow:hidden;margin:1px 0;padding:0;background-color:transparent;font:bold 11px arial;color:#666;text-decoration:none"></a>';
for (var i=0;i<16;i++) {
html+='<a href="'+this.url(i+1)+'" style="display:block;float:left;width:108px;height:16px;overflow:hidden;margin:1px 0;padding:0 0 0 24px;background-color:transparent;background:url(http://odnaknopka.ru/images/panel.png) no-repeat -266px '+(-i*16)+'px;font:normal 12px arial;color:#666;text-decoration:none;text-align:left" onmouseover="this.style.textDecoration=\'underline\'" onmouseout="this.style.textDecoration=\'none\'" onclick="return odnaknopka2.go('+(i+1)+');">'+titles[i]+'</a>';
}
html+='<a href="http://odnaknopka.ru" style="display:block;float:left;width:258px;height:16px;overflow:hidden;margin:1px 0;padding:0;background-color:transparent;font:bold 11px arial;color:#666;text-decoration:none;text-align:right">&copy;&nbsp;&#1054;&#1076;&#1085;&#1072;&#1050;&#1085;&#1086;&#1087;&#1082;&#1072;.&#1088;&#1091;</a>';
div.innerHTML=html;
div.onmouseover=function() {if (odnaknopka2.timeout) clearTimeout(odnaknopka2.timeout)}
div.onmouseout=function() {odnaknopka2.timeout=setTimeout('odnaknopka2.hide()',500)};
document.body.insertBefore(div,document.body.firstChild);
}
document.write('<a href="http://odnaknopka.ru/add/" onclick="window.open(\'http://odnaknopka.ru/add/?url=\'+encodeURIComponent(location.href)+\'&title=\'+encodeURIComponent(document.title),\'odnaknopka\',\'scrollbars=yes,menubar=no,width=600,height=500,left='+(document.body.clientWidth/2-300)+',top='+(document.body.clientHeight/2-250)+',resizable=yes,toolbar=no,location=no,status=no\');return false;"><img src="http://odnaknopka.ru/images/button.gif" width="136" height="16" alt="&#1054;&#1076;&#1085;&#1072;&#1050;&#1085;&#1086;&#1087;&#1082;&#1072;" title="&#1054;&#1076;&#1085;&#1072;&#1050;&#1085;&#1086;&#1087;&#1082;&#1072;" style="border:0;margin:0;padding:0" onmouseover="odnaknopka2.show(this);" onmouseout="odnaknopka2.timeout=setTimeout(\'odnaknopka2.hide()\',500);"></a>');
}
}
odnaknopka2=new NewOdnaknopka2();
odnaknopka2.init();