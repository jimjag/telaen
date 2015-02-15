{include file=$popupHeaderTemplate pageTitle=$smCCList|escape:"html"}

<body onLoad="printIt();">
<div id="popup"> {literal} 
  <script language="JavaScript" type="text/javascript">
function printIt() {
	try {
		self.print();
	} catch(err) {
		//
	}
}
</script> 
  {/literal}
  <table cellspacing="2" cellpadding="0" border="0" align="center" bgcolor="white" width="100%">
    <tr>
      <td valign=top><table cellspacing=1 cellpadding=2 width="100%" border=0 bgcolor=White align=center>
          <tr> </tr>
        </table>
        <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
          <tr>
            <td bgcolor=white><table width="100%" border=0 cellspacing=1 cellpadding=0>
                <tr bgcolor=white>
                  <td width="20%" height="18" class="headerright" style="font-weight:bold; background:#ffffff">{$smLabel.from_hea} &nbsp;</td>
                  <td class="default" style="background:#ffffff"> {section name=i loop=$smFromList}
                    &nbsp;<a href="{$smFromList[i].link}" title="{$smFromList[i].title|escape:"html"}">{$smFromList[i].name|default:#no_sender_text#|escape:"html"}</a> {/section} </td>
                </tr>
                <tr bgcolor=white>
                  <td height="18" class="headerright" style="font-weight:bold; background:#ffffff">{$smLabel.to_hea} &nbsp;</td>
                  <td class="default" style="background:#ffffff"> {section name=i loop=$smTOList}{if $firstto eq "no"};{/if}&nbsp;<a href="{$smTOList[i].link}" title="{$smTOList[i].title|escape:"html"}">{$smTOList[i].name|escape:"html"}</a>{assign var="firstto" value="no"}{sectionelse}&nbsp;{$smLabel.no_recipient_text}{/section} </td>
                </tr>
                {if $smHaveCC eq 1}
                <tr bgcolor=white>
                  <td height="18" class="headerright" style="font-weight:bold; background:#ffffff">{$smLabel.cc_hea} &nbsp;</td>
                  <td class="default" style="background:#ffffff"> {section name=i loop=$smCCList}{if $firstcc eq "no"};{/if}&nbsp;<a href="{$smCCList[i].link}" title="{$smCCList[i].title|escape:"html"}">{$smCCList[i].name|escape:"html"}</a>{assign var="firstcc" value="no"}{/section} </td>
                </tr>
                {/if}
                <tr bgcolor=white>
                  <td height="18" class="headerright" style="font-weight:bold; background:#ffffff">{$smLabel.subject_hea} &nbsp;</td>
                  <td class="default" style="background:#ffffff">&nbsp;{$smSubject|default:#no_subject_text#|truncate:100:"...":true|escape:"html"}</td>
                </tr>
                <tr bgcolor=white>
                  <td height="18" class="headerright" style="font-weight:bold; background:#ffffff">{$smLabel.date_hea} &nbsp;</td>
                  <td class="default" style="background:#ffffff">&nbsp;{$smDate|date_format:$smLabel.date_format}</td>
                </tr>
                {if $smHaveAttachments eq 1}
                <tr bgcolor=silver>
                  <td class="headerright" style="font-weight:bold; background:#ffffff">{$smLabel.attach_hea} &nbsp;</td>
                  <td><table width="100%" border=0 cellspacing=0 cellpadding=0>
                      <!--		<tr bgcolor=#f1f1f1>
												<td class="headers" width="60%" style="background:#ffffff"> &nbsp;<b>{$smLabel.attch_name_hea}</b> ({$smLabel.attch_force_hea})</td>
												<td class="headers" style="background:#ffffff"> &nbsp;<b>{$smLabel.attch_size_hea}</b></td>
												<td class="headers" style="background:#ffffff"> &nbsp;<b>{$smLabel.attch_type_hea}</b></td>-->

                      {section name=i loop=$smAttachList}
                      <tr bgcolor=white>
                        <td class="default" style="background:#ffffff">&nbsp;{$smAttachList[i].name|truncate:30:"...":true|escape:"html"}
                          ({$smAttachList[i].size}, &nbsp;{$smAttachList[i].type})</td>
                        {/section} </tr>
                    </table></td>
                </tr>
                {/if}
                <tr>
                  <td colspan=2 class="default"><table width="100%" border=0 cellspacing=0 cellpadding=0>
                      <tr bgcolor=white>
                        <td width="60%" bgcolor=white><hr width="100%" style=" border-top: 1px dotted #000000;  border-bottom: 1px solid #000000;  color: #fff;   background-color: #fff; height: 4px;"></td>
                      </tr>
                      <tr bgcolor=white>
                        <td width="60%"{$smBackImg}{$smBackColor}><font color=black>{$smMessageBody}</font></td>
                      </tr>
                      <tr bgcolor=white>
                        <td width="60%" style="background:#ffffff"><hr width="100%" style="border-top: 1px solid #000000; border-bottom: 1px dotted #000000;  color: #fff;  background-color: #fff;  height: 4px;"></td>
                      </tr>
                    </table></td>
                </tr>
              </table></td>
          </tr>
        </table></td>
    </tr>
  </table>
</div>
</body>
</html>