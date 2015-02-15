{include file=$popupHeaderTemplate pageTitle=$smLabel.qad_title}

<body>
<div id="popup"> {literal} 
  <script type="text/javascript">
//<![CDATA[
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
	obj.options[intPos] = null;
}

function Add(sTipo) {
	frm = document.forms[0];
	dest = eval("frm."+sTipo)
	orig = frm.contacts;
	if(orig.selectedIndex == -1) {
{/literal}
		alert("{$smLabel.qad_select_address}");
{literal}
		return
	}
	// check if the item is already on dest
	for(i=0; i<dest.options.length;i++) {
		if (orig.options[orig.selectedIndex].text == dest.options[i].text)
			return;
	}
	addItem(dest, orig.options[orig.selectedIndex].text, orig.options[orig.selectedIndex].text, false, dest.length);
}

function Dele(sTipo) {
	frm = document.forms[0];
	orig = eval("frm."+sTipo)
	if(orig.selectedIndex == -1) {
{/literal}
		alert("{$smLabel.qad_select_address}");
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
//]]>
</script> 
  {/literal}
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <form name="form1" action="">
      <tr>
        <td width="50%" class="default" valign="top" align="center"><table width="100%" cellspacing="0" cellpadding="0">
            <tr>
              <td class="usage"><span style="font-size:14px; color:#000066;">{$smLabel.address_mnu}</span></td>
            </tr>
            <tr>
              <td align="center"><br />
                {$smContacts}
                <script type="text/javascript">form1.contacts.style='width:200px';</script></td>
            </tr>
          </table></td>
        <td valign="top" width="50%"><table width="100%" border="0" cellspacing="1" cellpadding="0">
            <tr>
              <td colspan="2" height="22" class="headers"><b>{$smLabel.qad_to}</b></td>
            </tr>
            <tr>
              <td width="5%" valign="top" class="default"><input class="button50" type="button" onClick="Add('to')" value="&gt;&gt;" style="margin-bottom:2px">
                <input class="button50" type="button" onClick="Dele('to')" value="&lt;&lt;">
                <br /></td>
              <td valign="top"><select name="to" size="3" style="width: 260px;" ondblclick="Dele('to')">
                  <!--option value=""> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option-->
                </select></td>
            </tr>
            <tr>
              <td height="22" colspan="2" class="headers"><b>{$smLabel.qad_cc}</b></td>
            </tr>
            <tr>
              <td width="5%" valign="top" class="default"><input class="button50" type="button" onClick="Add('cc')"  value="&gt;&gt;" style="margin-bottom:2px">
                <br />
                <input class="button50" type="button" onClick="Dele('cc')"  value="&lt;&lt;">
                <br /></td>
              <td valign="top"><select name="cc" size="3" style="width: 260px;" ondblclick="Dele('cc')">
                  <!--option value=""> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option-->
                </select></td>
            </tr>
            <tr>
              <td colspan="2" height="22"  class="headers"><b>{$smLabel.qad_bcc}</b></td>
            </tr>
            <tr>
              <td width="5%" valign="top" class="default"><input class="button50" type="button" onClick="Add('bcc')" value="&gt;&gt;" style="margin-bottom:2px">
                <br />
                <input class="button50" type=button onClick="Dele('bcc')"  value="&lt;&lt;">
                <br /></td>
              <td valign="top"><select name="bcc" size="3" style="width: 260px;" onDblClick="Dele('bcc')">
                  <!--option value=""> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option-->
                </select></td>
            </tr>
          </table></td>
      </tr>
      <tr>
        <td class="usage" colspan="2"><center>
          <table class="buttonTable" cellspacing="0" >
            <tr>
              <td valign="middle" class="buttonLeft">&nbsp;</td>
              <td valign="middle" class="buttonMiddle"><input type="button" name="submit" value="{$smLabel.nav_back}" class="button" onClick="AddAndExit()"/></td>
              <td valign="middle" class="buttonRight">&nbsp;</td>
            </tr>
          </table>
      </tr>
    </form>
  </table>
  <script type="text/javascript"> 
// clean the spaces in selects, its fix width in netscape
//ns_clean();  old (unuseful??) things
//window.resizeTo(535,300);
</script> 
</div>
</body>
</html>