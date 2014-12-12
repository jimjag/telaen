{include file=$popupHeaderTemplate pageTitle=$umPageTitle|escape:"html"}

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
                  <td width="20%" height="18" class="headerright" style="font-weight:bold; background:#ffffff">{$umLabel.from_hea} &nbsp;</td>
                  <td class="default" style="background:#ffffff"> {section name=i loop=$umFromList}
                    &nbsp;<a href="{$umFromList[i].link}" title="{$umFromList[i].title|escape:"html"}">{$umFromList[i].name|default:#no_sender_text#|escape:"html"}</a> {/section} </td>
                </tr>
                <tr bgcolor=white>
                  <td height="18" class="headerright" style="font-weight:bold; background:#ffffff">{$umLabel.to_hea} &nbsp;</td>
                  <td class="default" style="background:#ffffff"> {section name=i loop=$umTOList}{if $firstto eq "no"};{/if}&nbsp;<a href="{$umTOList[i].link}" title="{$umTOList[i].title|escape:"html"}">{$umTOList[i].name|escape:"html"}</a>{assign var="firstto" value="no"}{sectionelse}&nbsp;{$umLabel.no_recipient_text}{/section} </td>
                </tr>
                {if $umHaveCC eq 1}
                <tr bgcolor=white>
                  <td height="18" class="headerright" style="font-weight:bold; background:#ffffff">{$umLabel.cc_hea} &nbsp;</td>
                  <td class="default" style="background:#ffffff"> {section name=i loop=$umCCList}{if $firstcc eq "no"};{/if}&nbsp;<a href="{$umCCList[i].link}" title="{$umCCList[i].title|escape:"html"}">{$umCCList[i].name|escape:"html"}</a>{assign var="firstcc" value="no"}{/section} </td>
                </tr>
                {/if}
                <tr bgcolor=white>
                  <td height="18" class="headerright" style="font-weight:bold; background:#ffffff">{$umLabel.subject_hea} &nbsp;</td>
                  <td class="default" style="background:#ffffff">&nbsp;{$umSubject|default:#no_subject_text#|truncate:100:"...":true|escape:"html"}</td>
                </tr>
                <tr bgcolor=white>
                  <td height="18" class="headerright" style="font-weight:bold; background:#ffffff">{$umLabel.date_hea} &nbsp;</td>
                  <td class="default" style="background:#ffffff">&nbsp;{$umDate|date_format:$umLabel.date_format}</td>
                </tr>
                {if $umHaveAttachments eq 1}
                <tr bgcolor=silver>
                  <td class="headerright" style="font-weight:bold; background:#ffffff">{$umLabel.attach_hea} &nbsp;</td>
                  <td><table width="100%" border=0 cellspacing=0 cellpadding=0>
                      <!--		<tr bgcolor=#f1f1f1>
												<td class="headers" width="60%" style="background:#ffffff"> &nbsp;<b>{$umLabel.attch_name_hea}</b> ({$umLabel.attch_force_hea})</td>
												<td class="headers" style="background:#ffffff"> &nbsp;<b>{$umLabel.attch_size_hea}</b></td>
												<td class="headers" style="background:#ffffff"> &nbsp;<b>{$umLabel.attch_type_hea}</b></td>--> 

                      {section name=i loop=$umAttachList}
                      <tr bgcolor=white>
                        <td class="default" style="background:#ffffff">&nbsp;{$umAttachList[i].name|truncate:30:"...":true|escape:"html"}
                          ({$umAttachList[i].size}, &nbsp;{$umAttachList[i].type})</td>
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
                        <td width="60%"{$umBackImg}{$umBackColor}><font color=black>{$umMessageBody}</font></td>
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