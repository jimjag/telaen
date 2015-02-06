<title>{if $webmailTitle}{$webmailTitle} - {/if}{$umLabel.qad_title}</title>
<head>
<meta http-equiv="Content-Type" content="text/html; charset={$umLabel.default_char_set}">
{$pageMetas}
<link rel="stylesheet" href="inc/themes/outlook/webmail.css" type="text/css">
{literal}
<script language=javascript>

function addItem(obj,strText,strValue,blSel,intPos){
	var newOpt,i,ArTemp,selIndex;
	selIndex = (blSel)?intPos:obj.selectedIndex;
	newOpt = new Option(strText,strValue);
	Len = obj.options.length+1
	if (intPos > Len) return
	obj.options.length = Len
	if (intPos != Len) {
		ArTemp = new Array();
		for(i=intPos;i<obj.options.length-1;i++)
			ArTemp[i] = Array(obj.options[i].text,obj.options[i].value);
		for(i=intPos+1;i<Len;i++)
			obj.options[i] = new Option(ArTemp[i-1][0],ArTemp[i-1][1]);
	}
	obj.options[intPos] = newOpt;
	if (selIndex > intPos)
		obj.selectedIndex = selIndex+1;
	else if (selIndex == intPos)
		obj.selectedIndex = intPos;
}
function delItem(obj,intPos){
	if(intPos > obj.length) return;
	obj.options[intPos] = null
}

function Add(sTipo) {
	frm = document.forms[0];
	dest = eval("frm."+sTipo)
	orig = frm.contacts;
	if(orig.selectedIndex == -1) {
{/literal}
		alert("{$umLabel.qad_select_address}");
{literal}
		return
	}
	addItem(dest,orig.options[orig.selectedIndex].text,orig.options[orig.selectedIndex].text,false,dest.length)
}

function Dele(sTipo) {
	frm = document.forms[0];
	orig = eval("frm."+sTipo)
	if(orig.selectedIndex == -1) {
{/literal}
		alert("{$umLabel.qad_select_address}");
{literal}
		return
	}
	delItem(orig,orig.selectedIndex)
}

function AddAndExit() {
	frm = document.forms[0];
	typs = new Array("to","cc","bcc");
	for(i=0;i<typs.length;i++) {
		orig = eval("frm."+typs[i]);
		for(n=0;n<orig.length;n++)
			window.opener.AddAddress(typs[i],orig.options[n].value);
	}
	self.close();
}

function ns_clean() {
	frm = document.forms[0];
	typs = new Array("to","cc","bcc");
	for(i=0;i<typs.length;i++) {
		orig = eval("frm."+typs[i]);
		orig.selectedIndex = 0;
		Dele(typs[i]);
	}
}

</script>
{/literal}
</head>
<body style="background-color: #D4D0C8;" topmargin='0' leftmargin='0'>
<table width="450" cellpadding=0 cellspacing=0>
    <form name=form1>

  <tr>
    <td width="225" valign=top><font class='xx-normal'><b>{$umLabel.qad_select_address}</b><br>
      </font> {$umContacts} </td>
    <td valign=top width="225"><table width="" cellpadding=0 cellspacing=0>
        <tr>
          <td width="5%" valign=top class=default><font class='xx-normal'>&nbsp;<br>
            </font>
            <input type="button" value="-&gt;" class="button" onClick="Add('to')">
            <br></td>
          <td><font class='xx-normal'><b>{$umLabel.qad_to}</b><br>
            </font>
            <select name="to" size="3" style="width: 200px;" onDblClick="Dele('to')">
              <option value="">
            </select></td>
        </tr>
        <tr>
          <td width="5%" valign=top class=default><font class='xx-normal'>&nbsp;<br>
            </font>
            <input type="button" value="-&gt;" class="button" onClick="Add('cc')">
            <br></td>
          <td valign=top ><font class='xx-normal'><b>{$umLabel.qad_cc}</b></font><br>
            <select name=cc size=3 style="width: 200px;" onDblClick="Dele('cc')">
              <option value="">
            </select></td>
        </tr>
        <tr>
          <td width="5%" valign=top class=default><font class='xx-normal'>&nbsp;<br>
            </font>
            <input type="button" value="-&gt;" class="button" onClick="Add('bcc')">
            <br></td>
          <td valign=top><font class='xx-normal'><b>{$umLabel.qad_bcc}</b></font><br>
            <select name=bcc size=3 style="width: 200px;" onDblClick="Dele('bcc')">
              <option value="">
            </select></td>
        </tr>
      </table></td>
  </tr>
</table>
<hr>
<center>
  <input type=button value="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;OK&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" onClick="AddAndExit()" class=button>
</center>
<br>
</form>
<script>
// clean the spaces in selects, its fix width in netscape
ns_clean();
</script> 
