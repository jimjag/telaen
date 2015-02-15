{include file=$headerTemplate pageTitle=$smLabel.newmsg_title}
<form name="composeForm" method="post" action="newmsg.php" onsubmit="return false;">
  <table width="100%" border="0" cellspacing="0" cellpadding="2" align="center" bgcolor="white">
    <tr> {$smForms}
      <td valign="top" width="20%"> {include file=$menuTemplate refresh="false"}
        {include file=$calendarTemplate}
        {include file=$newsTemplate} </td>
      <td bgcolor="white" valign="top"><table width="100%" border="0" cellspacing="1" cellpadding="0">
          <tr bgcolor=white>
            <td width="26%" height="18" class="headerright">{$smLabel.to_hea} &nbsp;<a href="javascript:addrpopup('to')"><img src="images/bookmark_it.gif" width="15" height="12" border="0" alt="<!--%address_tip%-->"></a> &nbsp;</td>
            <td class="default">&nbsp;{$smTo}</td>
          </tr>
          <tr bgcolor=white>
            <td height="18" class="headerright">{$smLabel.cc_hea} &nbsp;<a href="javascript:addrpopup('cc')"><img src="images/bookmark_it.gif" width="15" height="12" border="0" alt="<!--%address_tip%-->"></a> &nbsp;</td>
            <td class="default">&nbsp;{$smCc}</td>
          </tr>
          <tr bgcolor=white>
            <td height="18" class="headerright">{$smLabel.bcc_hea} &nbsp;<a href="javascript:addrpopup('bcc')"><img src="images/bookmark_it.gif" width="15" height="12" border="0" alt="<!--%address_tip%-->"></a> &nbsp;</td>
            <td class="default">&nbsp;{$smBcc}</td>
          </tr>
          <tr bgcolor=white>
            <td height="18" class="headerright">{$smLabel.subject_hea} &nbsp;</td>
            <td class="default">&nbsp;{$smSubject}</td>
          </tr>
          <tr bgcolor=white>
            <td height="18" class="headerright">{$smLabel.attach_hea} &nbsp;</td>
            <td><table width="100%" border=0 cellspacing=1 cellpadding=0>
                {if $smHaveAttachs eq 1}
                <tr>
                  <td width="45%" class="headers">{$smLabel.attch_name_hea}</td>
                  <td width="15%" class="headerright">{$smLabel.attch_size} &nbsp;</td>
                  <td width="30%" class="headers">{$smLabel.attch_type_hea}</td>
                  <td width="10%" class="headers">{$smLabel.attch_dele_hea}</td>
                </tr>
                {section name=i loop=$smAttachList}
                <tr>
                  <td width="50%" class="default">&nbsp;{$smAttachList[i].name|escape:"html"}</td>
                  <td width="10%" class="right">{$smAttachList[i].size} &nbsp;</td>
                  <td width="30%" class="default">&nbsp;{$smAttachList[i].type|truncate:23:"...":true}</td>
                  <td width="10%" class="default">&nbsp;<a href="{$smAttachList[i].link}">OK</a></td>
                </tr>
                {/section}
                {else}
                <tr>
                  <td width="100%" class="headers" colspan=3>&nbsp;{$smLabel.attch_no_hea}</td>
                </tr>
                {/if}
              </table>
              <table width="100%" border=0 cellspacing=1 cellpadding=0>
                <tr>
                  <td width="100%" class="default">&nbsp;<a href="javascript:upwin()" class="navigation">{$smLabel.attch_add_new}</a></td>
                </tr>
              </table></td>
          </tr>
          <tr>
            <td class="default">&nbsp;</td>
            <td class="default"><textarea cols="80" rows="24" id="body" name="body">{$smBody|escape:"html"}</textarea></td>
          </tr>
          <tr>
            <td class="headerright">{$smLabel.require_receipt}  &nbsp;</td>
            <td class="default"><input type="checkbox" value="true" name="requireReceipt"{if $requireReceipt eq true} checked{/if}></td>
          </tr>
          {if !$smAddSignature && $smHaveSignature}
          <tr>
            <td  class="headerright">{$smLabel.add_signature} &nbsp;</td>
            <td class="default"><input type="checkbox" name="cksig" onclick="return addsig()"{if $smAddSignature eq 1} checked disabled{/if}></td>
          </tr>
          {/if}
          <tr>
            <td  class="headerright">{$smLabel.priority_text} &nbsp;</td>
            <td class="default"><select name="priority">
                <option value="1"{if $smPriority eq 1} selected{/if}>{$smLabel.priority_high}
                <option value="3"{if $smPriority eq 3} selected{/if}>{$smLabel.priority_normal}
                <option value="5"{if $smPriority eq 5} selected{/if}>{$smLabel.priority_low}
              </select></td>
          </tr>
          <tr>
            <td class="default">&nbsp;</td>
            <td class="default"><input type=button name=bt_enviar value="{$smLabel.send_text}" onclick="enviar()" class="button"></td>
          </tr>
        </table></td>
    </tr>
  </table>
</form>
{include file=$footerTemplate}
