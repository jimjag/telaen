{include file=$headerTemplate pageTitle=$smLabel.newmsg_title}
  <table width="100%" border="0" cellspacing="0" cellpadding="2" align="center" bgcolor="white">
    <tr>
      <td valign="top" width="20%"> {include file=$menuTemplate refresh="false"}
        {include file=$calendarTemplate}
        {include file=$newsTemplate} </td>
      <td bgcolor="white" valign="top">
        <form enctype="multipart/form-data" action="upload.php" method="post" id="addatt">
          {$smForms}
          <table width="100%" border="0" cellspacing="0" cellpadding="2" align="center">
            <tr><td colspan=3 class="headers">{$smLabel.attch_add_new}</td></tr>
            <tr>
              <td width="26%" height="18" class="headerright">{$smLabel.up_information_text}</td>
              <td class="default" align="center"><input type="file" id="userfile" name="userfile"  size="33"></td>
              <td class="default" align="center"><input type="submit" value="{$smLabel.up_button_text}" id="submit_att" class="button"></td>
            </tr>
            <tr>
              <td><img src="images/ajax-loader.gif" id="loading-img" style="display:none;" alt="Please Wait"/></td>
              <td><div id="progressbox" ><div id="progressbar"></div ><div id="statustxt">0%</div></div></td>
              <td><div id="output"></div></td>
           </tr>
          </table>
        </form>
        <form name="composeForm" method="post" action="newmsg.php" onsubmit="return false;">
         <table width="100%" border="0" cellspacing="1" cellpadding="0">
         {$smForms}
          <tr>
            <td  class="headerright">{$smLabel.priority_text} &nbsp;</td>
            <td class="default" align='center'><select name="priority">
                <option value="1"{if $smPriority eq 1} selected{/if}>{$smLabel.priority_high}
                <option value="3"{if $smPriority eq 3} selected{/if}>{$smLabel.priority_normal}
                <option value="5"{if $smPriority eq 5} selected{/if}>{$smLabel.priority_low}
              </select></td>
          </tr>
          <tr bgcolor=white>
            <td width="26%" height="18" class="headerright">{$smLabel.to_hea} &nbsp;<a href="javascript:addrpopup('to')"><img src="inc/themes/default/images/bookmark_it.gif" width="15" height="12" border="0" alt="<!--%address_tip%-->"></a> &nbsp;</td>
            <td class="default">&nbsp;{$smTo}</td>
          </tr>
          <tr bgcolor=white>
            <td height="18" class="headerright">{$smLabel.cc_hea} &nbsp;<a href="javascript:addrpopup('cc')"><img src="inc/themes/default/images/bookmark_it.gif" width="15" height="12" border="0" alt="<!--%address_tip%-->"></a> &nbsp;</td>
            <td class="default">&nbsp;{$smCc}</td>
          </tr>
          <tr bgcolor=white>
            <td height="18" class="headerright">{$smLabel.bcc_hea} &nbsp;<a href="javascript:addrpopup('bcc')"><img src="inc/themes/default/images/bookmark_it.gif" width="15" height="12" border="0" alt="<!--%address_tip%-->"></a> &nbsp;</td>
            <td class="default">&nbsp;{$smBcc}</td>
          </tr>
          <tr bgcolor=white>
            <td height="18" class="headerright">{$smLabel.subject_hea} &nbsp;</td>
            <td class="default">&nbsp;{$smSubject}</td>
          </tr>
          <tr bgcolor=white>
            <td height="18" class="headerright">{$smLabel.attach_hea} &nbsp;</td>
            <td><table width="100%" border=0 cellspacing=1 cellpadding=0>
                 <tr>
                  <td width="45%" class="headers">{$smLabel.attch_name_hea}</td>
                  <td width="15%" class="headerright">{$smLabel.attch_size} &nbsp;</td>
                  <td width="30%" class="headers">{$smLabel.attch_type_hea}</td>
                  <td width="10%" class="headers">{$smLabel.attch_dele_hea}</td>
                 </tr>
                </table>
               <div id="nm_attachs">
                <table width="100%" border=0 cellspacing=1 cellpadding=0>
                {section name=i loop=$smAttachList}
                 <tr>
                  <td width="50%" class="default">&nbsp;{$smAttachList[i].name|escape:"html"}</td>
                  <td width="10%" class="right">{$smAttachList[i].size} &nbsp;</td>
                  <td width="30%" class="default">&nbsp;{$smAttachList[i].type|truncate:23:"...":true}</td>
                  <td width="10%" class="default">&nbsp;<a href="{$smAttachList[i].link}">OK</a></td>
                 </tr>
                {/section}
                </table>
               </div>
            </td>
          </tr>
          <tr>
            <td class="default">&nbsp;</td>
            <td class="default"><textarea cols="80" rows="32" id="body" name="body">{$smBody|escape:"html"}</textarea></td>
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
            <td class="default">&nbsp;</td>
            <td class="default"><input type=button name=bt_enviar value="{$smLabel.send_text}" onclick="enviar()" class="button"></td>
          </tr>
         </table>
        </form>
      </td>
    </tr>
  </table>
{include file=$footerTemplate}
