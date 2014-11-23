{include file=$popupHeaderTemplate  pageTitle=$umLabel.qad_title}

<body>
<div id="popup">
  <div id="logo"> <img src="images/telaen_logo.jpg" width="310" height="73" alt="logo"> </div>
  {literal} 
  <script type="text/javascript">

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
  <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
    <form name="form1">
      <tr>
        <td width="50%" valign=top> {$umContacts} <br>
          <br>
          <input type=button value=" &nbsp;OK &nbsp;" onClick="AddAndExit()" class=button></td>
        <td valign=top width="50%"><table width="100%" border="0" cellspacing="1" cellpadding="0">
            <tr>
              <td colspan=2 class="headers"><b>{$umLabel.qad_to}</b></td>
            </tr>
            <tr>
              <td width="8%" valign=top class=default><input type="button" value="&gt;&gt;" class="button" onClick="Add('to')">
                <br>
                <input type="button" value="&lt;&lt;" class="button" onClick="Dele('to')">
                <br></td>
              <td valign=top><select name="to" size="3" style="width: 250px;" onDblClick="Dele('to')">
                  <!---option value="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; -->
                </select></td>
            </tr>
            <tr>
              <td colspan=2 class="headers"><b>{$umLabel.qad_cc}</b></td>
            </tr>
            <tr>
              <td width="5%" valign=top class=default><input type="button" value="&gt;&gt;" class="button" onClick="Add('cc')">
                <br>
                <input type="button" value="&lt;&lt;" class="button" onClick="Dele('cc')">
                <br></td>
              <td valign="top" ><select name="cc" size="3" style="width: 250px;" onDblClick="Dele('cc')">
                  <!--						<option value=""> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; -->
                </select></td>
            </tr>
            <tr>
              <td colspan="2" class="headers"><b>{$umLabel.qad_bcc}</b></td>
            </tr>
            <tr>
              <td width="5%" valign="top" class="default"><input type="button" value="&gt;&gt;" class="button" onClick="Add('bcc')">
                <br>
                <input type="button" value="&lt;&lt;" class="button" onClick="Dele('bcc')">
                <br></td>
              <td valign=top><select name="bcc" size="3" style="width: 250px;" onDblClick="Dele('bcc')">
                  <!--						<option value=""> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; -->
                </select></td>
            </tr>
          </table></td>
      </tr>
    </form>
  </table>
  <script>
// clean the spaces in selects, its fix width in netscape
//ns_clean();
</script> 
</div>
</body>
</html>