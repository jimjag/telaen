<?php
/************************************************************************
Telaen is a GPL'ed software developed by

 - The Telaen Group
 - http://jimjag.github.io/telaen/

*************************************************************************/

defined('I_AM_TELAEN') or die('Direct access not permitted');

/* This is MOSTLY javascript... :) */

$jssource .= "
<script language='javascript' type='text/javascript'>
//<![CDATA[
bIs_html = $js_advanced;
bsig_added = false;
function addsig() {
with(document.composeForm) {
if(bsig_added || sig.value == '') return false;
if(cksig.checked) {
if(bIs_html) {
	body.value +='<br /><br />----<br />'+sig.value;
} else
	body.value += '\\r\\n\\r\\n----\\r\\n'+sig.value;
}
cksig.disabled = true;
bsig_added = true;
}
return true;
}

function upwin(rem) {
mywin = 'upload.php';
if (rem != null) mywin += '?rem='+rem+'';
else mywin += '';
window.open(mywin,'Upload','width=400,height=120,scrollbars=0,menubar=0,status=0');
}

function doupload() {
document.composeForm.todo.value = 'edit';
document.composeForm.submit();
}

function textmode() {
with(document.composeForm) {
textmode.value = 1;
todo.value = 'edit';
submit();
}
}

function enviar() {
error_msg = new Array();
frm = document.composeForm;
check_mail(frm.to.value);
check_mail(frm.cc.value);
check_mail(frm.bcc.value);
errors = error_msg.length;

if(frm.to.value == '' && frm.cc.value == '' && frm.bcc.value == '')
alert('".preg_replace("|'|", "\\'", $lang['error_no_recipients'])."');

else if (errors > 0) {

if (errors == 1) errmsg = '".preg_replace("|'|", "\\'", $lang['error_compose_invalid_mail1_s'])."\\r\\r';
else  errmsg = '".preg_replace("|'|", "\\'", $lang['error_compose_invalid_mail1_p'])."\\r\\r';

for(i=0;i<errors;i++)
errmsg += error_msg[i]+'\\r';

if (errors == 1) errmsg += '\\r".preg_replace("|'|", "\\'", $lang['error_compose_invalid_mail2_s'])."s';
else  errmsg += '\\r".preg_replace("|'|", "\\'", $lang['error_compose_invalid_mail2_p'])."';

alert(errmsg)

} else {
frm.todo.value = 'send';
frm.submit();
}
}

function addrpopup(where) {
url = 'quick_address.php?where=' + where;
mywin = window.open(url,'AddressBook','width=600,height=300,top=150,left=150');
}
function AddAddress(strType,strAddress) {
obj = eval('document.composeForm.'+strType);
if(obj.value == '') obj.value = strAddress
else  obj.value = obj.value + ', ' + strAddress
}

function check_mail(strmail) {
if(strmail == '') return;
chartosplit = ',;';
protectchar = '\"';
temp = '';
armail = new Array();
inthechar = false;
lt = '<';
gt = '>';
isclosed = true;

for(i=0;i<strmail.length;i++) {
thischar = strmail.charAt(i);
if(thischar == lt && isclosed) isclosed = false;
if(thischar == gt && !isclosed) isclosed = true;
if(thischar == protectchar) inthechar = (inthechar)?0:1;
if(chartosplit.indexOf(thischar) != -1 && !inthechar && isclosed) {
armail[armail.length] = temp; temp = '';
} else temp += thischar;
}

armail[armail.length] = temp;

for(i=0;i<armail.length;i++) {
thismail = armail[i]; strPat = /(.*)<(.*)>/;
matchArray = thismail.match(strPat);
if (matchArray != null) strEmail = matchArray[2];
else {
strPat = /([-a-zA-Z0-9_$+.]+@[-a-zA-Z0-9_.]+[-a-zA-Z0-9_]+)((.*))/; matchArray = thismail.match(strPat);
if (matchArray != null) strEmail = matchArray[1];
else strEmail = thismail;
}
if(strEmail.charAt(0) == '\"' && strEmail.charAt(strEmail.length-1) == '\"') strEmail = strEmail.substring(1,strEmail.length-1)
if(strEmail.charAt(0) == '<' && strEmail.charAt(strEmail.length-1) == '>') strEmail = strEmail.substring(1,strEmail.length-1)

strPat = /([-a-zA-Z0-9_$+.]+@[-a-zA-Z0-9_.]+[-a-zA-Z0-9_]+)((.*))/;
matchArray = strEmail.match(strPat);
if(matchArray == null)
error_msg[error_msg.length] = strEmail;
}
}

//]]>
</script>

<script type='text/javascript'>
//<![CDATA[
window.setInterval(function() {
$.ajax({
    url: 'ajax.php',
	type: 'POST',
	data: {action: 'pingSession'}
});
}, 60000);
//]]>
</script>

";
