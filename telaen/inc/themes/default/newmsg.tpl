{include file=$headerTemplate pageTitle=$umLabel.newmsg_title}
<form name="composeForm" method="post" action="newmsg.php" onsubmit="return false;">
  <table width="100%" border="0" cellspacing="0" cellpadding="2" align="center" bgcolor="white">
    <tr> {$umForms}
      <td valign="top" width="20%"> {include file=$menuTemplate refresh="false"}
        {include file=$calendarTemplate}
        {include file=$newsTemplate} </td>
      <td bgcolor="white" valign="top"><table width="100%" border="0" cellspacing="1" cellpadding="0">
          <tr bgcolor=white>
            <td width="26%" height="18" class="headerright">{$umLabel.to_hea} &nbsp;<a href="javascript:addrpopup('to')"><img src="inc/themes/default/images/bookmark_it.gif" width="15" height="12" border="0" alt="<!--%address_tip%-->"></a> &nbsp;</td>
            <td class="default">&nbsp;{$umTo}</td>
          </tr>
          <tr bgcolor=white>
            <td height="18" class="headerright">{$umLabel.cc_hea} &nbsp;<a href="javascript:addrpopup('cc')"><img src="inc/themes/default/images/bookmark_it.gif" width="15" height="12" border="0" alt="<!--%address_tip%-->"></a> &nbsp;</td>
            <td class="default">&nbsp;{$umCc}</td>
          </tr>
          <tr bgcolor=white>
            <td height="18" class="headerright">{$umLabel.bcc_hea} &nbsp;<a href="javascript:addrpopup('bcc')"><img src="inc/themes/default/images/bookmark_it.gif" width="15" height="12" border="0" alt="<!--%address_tip%-->"></a> &nbsp;</td>
            <td class="default">&nbsp;{$umBcc}</td>
          </tr>
          <tr bgcolor=white>
            <td height="18" class="headerright">{$umLabel.subject_hea} &nbsp;</td>
            <td class="default">&nbsp;{$umSubject}</td>
          </tr>
          <tr bgcolor=white>
            <td height="18" class="headerright">{$umLabel.attach_hea} &nbsp;</td>
            <td><table width="100%" border=0 cellspacing=1 cellpadding=0>
                {if $umHaveAttachs eq 1}
                <tr>
                  <td width="45%" class="headers">{$umLabel.attch_name_hea}</td>
                  <td width="15%" class="headerright">{$umLabel.attch_size} &nbsp;</td>
                  <td width="30%" class="headers">{$umLabel.attch_type_hea}</td>
                  <td width="10%" class="headers">{$umLabel.attch_dele_hea}</td>
                </tr>
                {section name=i loop=$umAttachList}
                <tr>
                  <td width="50%" class="default">&nbsp;{$umAttachList[i].name|escape:"html"}</td>
                  <td width="10%" class="right">{$umAttachList[i].size} &nbsp;</td>
                  <td width="30%" class="default">&nbsp;{$umAttachList[i].type|truncate:23:"...":true}</td>
                  <td width="10%" class="default">&nbsp;<a href="{$umAttachList[i].link}">OK</a></td>
                </tr>
                {/section}
                {else}
                <tr>
                  <td width="100%" class="headers" colspan=3>&nbsp;{$umLabel.attch_no_hea}</td>
                </tr>
                {/if}
              </table>
              <table width="100%" border=0 cellspacing=1 cellpadding=0>
                <tr>
                  <td width="100%" class="default">&nbsp;<a href="javascript:upwin()" class="navigation">{$umLabel.attch_add_new}</a></td>
                </tr>
              </table></td>
          </tr>
          <tr>
            <td class="default">&nbsp;</td>
            <td class="default"><textarea cols="80" rows="24" id="body" name="body">{$umBody|escape:"html"}</textarea></td>
          </tr>
          <tr>
            <td class="headerright">{$umLabel.require_receipt}  &nbsp;</td>
            <td class="default"><input type="checkbox" value="true" name="requireReceipt"{if $requireReceipt eq true} checked{/if}></td>
          </tr>
          {if !$umAddSignature && $umHaveSignature}
          <tr>
            <td  class="headerright">{$umLabel.add_signature} &nbsp;</td>
            <td class="default"><input type="checkbox" name="cksig" onclick="return addsig()"{if $umAddSignature eq 1} checked disabled{/if}></td>
          </tr>
          {/if}
          <tr>
            <td  class="headerright">{$umLabel.priority_text} &nbsp;</td>
            <td class="default"><select name="priority">
                <option value="1"{if $umPriority eq 1} selected{/if}>{$umLabel.priority_high}
                <option value="3"{if $umPriority eq 3} selected{/if}>{$umLabel.priority_normal}
                <option value="5"{if $umPriority eq 5} selected{/if}>{$umLabel.priority_low}
              </select></td>
          </tr>
          <tr>
            <td class="default">&nbsp;</td>
            <td class="default"><input type=button name=bt_enviar value="{$umLabel.send_text}" onclick="enviar()" class="button"></td>
          </tr>
        </table></td>
    </tr>
  </table>
</form>
{include file=$footerTemplate}
