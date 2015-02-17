<?php
/************************************************************************
Telaen is a GPL'ed software developed by

 - The Telaen Group
 - http://jimjag.github.io/telaen/

*************************************************************************/

defined('I_AM_TELAEN') or die('Direct access not permitted');

/* This is MOSTLY javascript... :) */

$jssource <<< EOS
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

<script type="text/javascript">
$(document).ready(function() {
    var options = {
            target:   '#output',   // target element(s) to be updated with server response
            beforeSubmit:  beforeSubmit,  // pre-submit callback
            success:       afterSuccess,  // post-submit callback
            uploadProgress: OnProgress, //upload progress callback
            resetForm: true        // reset the form after successful submit
        };

     $('#addatt').submit(function() {
            $(this).ajaxSubmit(options);
            // always return false to prevent standard browser submit and page navigation
            return false;
        });


//function after succesful file upload (when server response)
function afterSuccess()
{
    $('#submit_att').show(); //hide submit button
    $('#loading-img').hide(); //hide submit button
    $('#progressbox').delay( 1000 ).fadeOut(); //hide progress bar

}

//function to check file size before uploading.
function beforeSubmit(){
    //check whether browser fully supports all File API
   if (window.File && window.FileReader && window.FileList && window.Blob)
    {

        if( !$('#userfile').val()) //check empty input filed
        {
            $("#output").html("Are you kidding me?");
            return false
        }

        var fsize = $('#userfile')[0].files[0].size; //get file size
        var ftype = $('#userfile')[0].files[0].type; // get file type


        //allow file types
        switch(ftype)
        {
            case 'image/png':
            case 'image/gif':
            case 'image/jpeg':
            case 'image/pjpeg':
            case 'text/plain':
            case 'text/html':
            case 'application/x-zip-compressed':
            case 'application/pdf':
            case 'application/msword':
            case 'application/vnd.ms-excel':
            case 'video/mp4':
                break;
            default:
                $("#output").html("<b>"+ftype+"</b> Unsupported file type!");
                return false
        }

        //Allowed file size is less than 5 MB (1048576)
        if(fsize>5242880)
        {
            $("#output").html("<b>"+bytesToSize(fsize) +"</b> Too big file! <br />File is too big, it should be less than 5 MB.");
            return false
        }

        $('#submit_att').hide(); //hide submit button
        $('#loading-img').show(); //hide submit button
        $("#output").html("");
    }
    else
    {
        //Output error to older unsupported browsers that doesn't support HTML5 File API
        //$("#output").html("Please upgrade your browser, because your current browser lacks some new features we need!");
        return true;
    }
}

//progress bar function
function OnProgress(event, position, total, percentComplete)
{
    //Progress bar
    $('#progressbox').show();
    $('#progressbar').width(percentComplete + '%') //update progressbar percent complete
    $('#statustxt').html(percentComplete + '%'); //update status text
    if(percentComplete>50)
        {
            $('#statustxt').css('color','#000'); //change status text to white after 50%
        }
}

//function to format bites bit.ly/19yoIPO
function bytesToSize(bytes) {
   var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
   if (bytes == 0) return '0 Bytes';
   var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
   return Math.round(bytes / Math.pow(1024, i), 2) + ' ' + sizes[i];
}

});

</script>

EOS;
