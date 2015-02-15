{include file=$headerTemplate pageTitle=$smLabel.newmsg_title}

{include file=$menuTemplate refresh="false"}
<form name="composeForm" method="post" action="newmsg.php" onsubmit="return false;">
  {$smForms}
  <table cellspacing="0" cellpadding="0" border="0" align="center"  bgcolor="#DDE3EB" width="100%">
    <tr>
      <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#DDE3EB">
          <tr bgcolor="#DDE3EB">
            <td width="26%" height="24" class="headerright">{$smLabel.to_hea} &nbsp;<a href="javascript:addrpopup()"><img src="images/bookmark_it.gif" width="15" height="12" border="0" alt="<!--%address_tip%-->" /></a>&nbsp;</td>
            <td class="default">&nbsp;{$smTo}</td>
          </tr>
          <tr>
            <td class="separator" colspan="2"></td>
          </tr>
          <tr bgcolor="#DDE3EB">
            <td height="24" class="headerright">{$smLabel.cc_hea} &nbsp;<a href="javascript:addrpopup()"><img src="images/bookmark_it.gif" width="15" height="12" alt="<!--%address_tip%-->" /></a>&nbsp;</td>
            <td class="default">&nbsp;{$smCc}</td>
          </tr>
          <tr>
            <td class="separator" colspan="2"></td>
          </tr>
          <tr bgcolor="#DDE3EB">
            <td height="24" class="headerright">{$smLabel.bcc_hea} &nbsp;<a href="javascript:addrpopup()"><img src="images/bookmark_it.gif" width="15" height="12" alt="<!--%address_tip%-->" /></a>&nbsp;</td>
            <td class="default">&nbsp;{$smBcc}</td>
          </tr>
          <tr>
            <td class="separator" colspan="2"></td>
          </tr>
          <tr bgcolor="#DDE3EB">
            <td height="24" class="headerright">{$smLabel.subject_hea} &nbsp;</td>
            <td class="default">&nbsp;{$smSubject}</td>
          </tr>
          <tr>
            <td class="separator" colspan="2"></td>
          </tr>
          <tr bgcolor="#DDE3EB">
            <td height="18" class="headerright">{$smLabel.attach_hea} &nbsp;</td>
            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                {if $smHaveAttachs eq 1}
                <tr>
                  <td width="40%" class="headersLeft">&nbsp;.: <b>{$smLabel.attch_name_hea}</b> :. </td>
                  <td width="15%" class="headers">.: <b>{$smLabel.attch_size}</b> :.</td>
                  <td width="30%" class="headersLeft">.: <b>{$smLabel.attch_type_hea}</b> :.</td>
                  <td class="headers">.: <b>{$smLabel.attch_dele_hea}</b> :.&nbsp;</td>
                </tr>
                {section name=i loop=$smAttachList}
                <tr>
                  <td class="default">&nbsp; {$smAttachList[i].name|escape:"html"}</td>
                  <td class="cent">{$smAttachList[i].size} </td>
                  <td class="default">{$smAttachList[i].type|truncate:23:"...":true}</td>
                  <td class="cent"><a href="{$smAttachList[i].link}">OK</a></td>
                </tr>
                {/section}
                {else}
                <tr>
                  <td><img src="inc/themes/hungi.mozilla/images/header-bg-left.gif" alt="" /></td>
                  <td height="22" width="100%" class="headers">&nbsp;{$smLabel.attch_no_hea}</td>
                  <td><img src="inc/themes/hungi.mozilla/images/header-bg-right.gif" alt="" /></td>
                </tr>
                {/if}
                <tr>
                  <td class="separator" colspan="4"></td>
                </tr>
              </table>
              <table width="100%" border="0" cellspacing="1" cellpadding="0">
                <tr>
                  <td width="100%" class="default">&nbsp;<a href="javascript:upwin()" class="navigation">{$smLabel.attch_add_new}</a></td>
                </tr>
              </table></td>
          </tr>
          <tr>
            <td class="separator" colspan="2"></td>
          </tr>
          <tr>
            <td class="headerright">&nbsp;</td>
            <td class="default"><textarea cols="100" rows="20" name="body">{$smBody|escape:"html"}</textarea></td>
          </tr>
          <tr>
            <td class="separator" colspan="2"></td>
          </tr>
          <tr>
            <td class="headerright">{$smLabel.require_receipt}  &nbsp;</td>
            <td class="default"><input type="checkbox" value="true" name="requireReceipt"{if $requireReceipt eq true} checked="checked"{/if}/></td>
          </tr>
          {if !$smAddSignature && $smHaveSignature}
          <tr>
            <td class="separator" colspan="2"></td>
          </tr>
          <tr>
            <td class="headerright">{$smLabel.add_signature} &nbsp;</td>
            <td class="default"><input type="checkbox" name="cksig" onclick="return addsig()"{if $smAddSignature eq 1} checked disabled{/if}></td>
          </tr>
          {/if}
          <tr>
            <td class="separator" colspan="2"></td>
          </tr>
          <tr>
            <td class="headerright">{$smLabel.priority_text} &nbsp;</td>
            <td class="default"><select name="priority">
                <option value="1"{if $smPriority eq 1} selected="selected"{/if}>{$smLabel.priority_high}</option>
                <option value="3"{if $smPriority eq 3} selected="selected"{/if}>{$smLabel.priority_normal}</option>
                <option value="5"{if $smPriority eq 5} selected="selected"{/if}>{$smLabel.priority_low}</option>
              </select></td>
          </tr>
          <tr>
            <td colspan="2" class="usage"><center>
                <table class="buttonTable" cellspacing="0" >
                  <tr>
                    <td valign="middle" class="buttonLeft">&nbsp;</td>
                    <td valign="middle" class="buttonMiddle"><a class="login" href="javascript:enviar()" >{$smLabel.send_text}</a></td>
                    <td valign="middle" class="buttonRight">&nbsp;</td>
                  </tr>
                </table>
              </center></td>
          </tr>
        </table></td>
    </tr>
  </table>
</form>
{include file=$footerTemplate} 
