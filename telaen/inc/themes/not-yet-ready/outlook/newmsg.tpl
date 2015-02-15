<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<title>{if $webmailTitle}{$webmailTitle} - {/if}{$smLabel.compose_mnu}</title>
<link rel="stylesheet" href="inc/themes/outlook/webmail.css" type="text/css">
<meta http-equiv="Content-Type" content="text/html; charset={$smLabel.default_char_set}">
{$pageMetas}
<script src="inc/themes/outlook/webmail.js" type="text/javascript"></script>
{$smJS}
</head>

<body>
<table width='100%' cellspacing="2" cellpadding="0" class="window_inner">
  <tr>
    <td><table width='100%' cellpadding='0' cellspacing='0'>
        <tr>
          <td class="window_title"><img src='inc/themes/outlook/images/icon_outlook_newmsg.gif'></td>
          <td width='100%' class="window_title">&nbsp;{$smLabel.compose_mnu}</td>
          <td class='window_title_X'><a href='javascript:goinbox()'><img border='0' src='inc/themes/outlook/images/X.png'></a></td>
        </tr>
      </table>
      <table width='100%' height='2' cellpadding='0' cellspacing='0'>
        <tr>
          <td></td>
        </tr>
      </table>
      <table width='100%' cellpadding='0' cellspacing='0'>
        <!-- BARRA DE HERRAMIENTAS -->
        <tr>
          <td class='toolbar_outer' ><table width='100%' cellpadding='0' cellspacing='0'>
              <tr>
                <td class='toolbar_inner'><table width='0' cellpadding='0' cellspacing='0'>
                    <tr>
                      <td class="toolbar_splitter"><img src='inc/themes/outlook/images/bar_handler.gif'></td>
                      <td class="toolbar_button_off" onmouseover="this.className='toolbar_button_on'" onmouseout="this.className='toolbar_button_off'" onmousedown="this.className='toolbar_button_down'" onmouseup="this.className='toolbar_button_on'" onclick="enviar()"><acronym title="{$smLabel.send_text}"><img src="inc/themes/outlook/images/icon_send.gif"><font class='xx-normal'><br>
                        {#send_text#|truncate:13:"...":true}</font></acronym></td>
                      <td class="toolbar_splitter"><img src='inc/themes/outlook/images/bar_splitter.gif'></td>
                      <td class="toolbar_button_off" onmouseover="this.className='toolbar_button_on'" onmouseout="this.className='toolbar_button_off'" onmousedown="this.className='toolbar_button_down'" onmouseup="this.className='toolbar_button_on'"
										onclick="document.getElementById('midlayer').className='showmodal';"><acronym title="{$smLabel.attch_add_new}"><img src="inc/themes/outlook/images/icon_attachment.gif"><font class='xx-normal'><br>
                        {#attch_add_new#|truncate:13:"...":true}</font></acronym></td>
                      <td class="toolbar_button_off" onmouseover="this.className='toolbar_button_on'" onmouseout="this.className='toolbar_button_off';" onmousedown="this.className='toolbar_button_down'" onclick="setVisible('priority_window',true)"><acronym title="{$smLabel.priority_text}"><img src="inc/themes/outlook/images/icon_priority.gif"><font class='xx-normal'><br>
                        {#priority_text#|truncate:13:"...":true}</font></acronym></td>
                      {if !$smAddSignature && $smHaveSignature}
                      <td class="toolbar_splitter"><img src='inc/themes/outlook/images/bar_splitter.gif'></td>
                      <td class="toolbar_button_off" onmouseover="this.className='toolbar_button_on'" onmouseout="this.className='toolbar_button_off'" onmousedown="this.className='toolbar_button_down'" onmouseup="this.className='toolbar_button_on'" onClick="document.composeForm.cksig.click();"><acronym title="{$smLabel.add_signature}">{if $smAddSignature eq 1}<img src="inc/themes/outlook/images/icon_sign_off.gif">{else}<img src="inc/themes/outlook/images/icon_sign.gif">{/if}<font class='xx-normal'><br>
                        {#add_signature#|truncate:13:"...":true}</font></acronym></td>
                      {/if} </tr>
                  </table></td>
              </tr>
            </table></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td><DIV NAME="midlayer" ID="midlayer" CLASS="hidemodal">
        <table width=100% cellpadding="0" cellspacing="0" style="
	border-style: solid;
	border-bottom-width: 1px;
	border-top-width: 0px;
	border-left-width: 0px;
	border-right-width: 0px;
	border-bottom-color: #FFFFFF;
	">
          <form target="uploading" onsubmit="this.submit.disabled=true;window.open('inc/themes/outlook/uploading.tpl','uploading','width=400,height=120,scrollbars=0,menubar=0,status=0')" enctype="multipart/form-data" name="upload" id="upload" action="upload.php?sid={$umSid}" method=POST>
            <tr>
              <td width="100" style="
	border-style: solid;
	border-bottom-width: 1px;
	border-top-width: 0px;
	border-left-width: 0px;
	border-right-width: 0px;
	border-bottom-color: #808080;
	"><font class="xx-normal">&nbsp;&nbsp;&nbsp;{$smLabel.up_title}</font></td>
              <td style="
	padding:5;
	border-style: solid;
	border-bottom-width: 1px;
	border-top-width: 0px;
	border-left-width: 0px;
	border-right-width: 0px;
	border-bottom-color: #808080;
	"><input class=file type=file name=userfile size=35>
                <input type=submit value="&nbsp;&nbsp;&nbsp;{$smLabel.attch_add_new}&nbsp;&nbsp;&nbsp;" name=submit class=button></td>
            </tr>
          </form>
        </table>
      </DIV></td>
  </tr>
    <form name="composeForm" id="composeForm" method="post" action="newmsg.php" onsubmit="return false;">

  {$smForms}
  <tr>
    <td><table width="100%" border=0 cellspacing=3 cellpadding=0 >
        <tr>
          <td width='100'><font class='xx-normal'>&nbsp;&nbsp;&nbsp;<a href="javascript:addrpopup()"><img src="images/bookmark_it.gif" border="0" alt="{$smLabel.address_tip}"></a>&nbsp;{$smLabel.to_hea}</font></td>
          <td width='*'>{$smTo}</td>
        </tr>
        <tr>
          <td><font class='xx-normal'>&nbsp;&nbsp;&nbsp;<a href="javascript:addrpopup()"><img src="images/bookmark_it.gif" width="15" height="12" border="0" alt="{$smLabel.address_tip}"></a>&nbsp;{$smLabel.cc_hea}</font></td>
          <td>{$smCc}</td>
        </tr>
        <tr>
          <td><font class='xx-normal'>&nbsp;&nbsp;&nbsp;<a href="javascript:addrpopup()"><img src="images/bookmark_it.gif" width="15" height="12" border="0" alt="{$smLabel.address_tip}"></a>&nbsp;{$smLabel.bcc_hea}</font></td>
          <td>{$smBcc}</td>
        </tr>
        <tr>
          <td><font class='xx-normal'>&nbsp;&nbsp;&nbsp;{$smLabel.subject_hea}</font></td>
          <td>{$smSubject}</td>
        </tr>
        <tr>
          <td><font class='xx-normal'>&nbsp;&nbsp;&nbsp;{$smLabel.attach_hea}</font></td>
          <td class='newmsg_attachments_outer'><table width='100%' height='100%' cellpadding='0' cellspacing='0'>
              <tr>
                <td class='newmsg_attachments_inner'> {if $smHaveAttachs eq 1}
                  {section name=i loop=$smAttachList}
                  {$smAttachList[i].name|escape:"html"} ({$smAttachList[i].size}Kb) [<a href="{$smAttachList[i].link}">{$smLabel.attch_dele_hea}</a>]
                  {/section}
                  {else}
                  {$smLabel.attch_no_hea}
                  {/if} </td>
              </tr>
            </table></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td class="editor"><textarea cols="100" rows="15" name="body">{$smBody|escape:"html"}</textarea></td>
  </tr>
  <tr>
    <td><input type="checkbox" value="true" name="requireReceipt"{if $requireReceipt eq true} checked="checked"{/if}>
      <FONT CLASS="xx-normal">&nbsp;&nbsp;{$smLabel.require_receipt}</FONT></td>
  </tr>
  <tr>
    <td class='info_bar'>&nbsp;</td>
  </tr>
</table>

<!-- DROPDOWN PRIORITY -->
<div id="priority_window" class="priority_outer" onmouseover="setVisible('priority_window',true);" onmouseout="setVisible('priority_window',false);" onclick="setVisible('priority_window',false);">
  <div class="priority_inner">
    <select name="priority" size="3" class="priority">
      <option value="1"{if $smPriority eq 1} selected{/if}>{$smLabel.priority_high}
      <option value="3"{if $smPriority eq 3} selected{/if}>{$smLabel.priority_normal}
      <option value="5"{if $smPriority eq 5} selected{/if}>{$smLabel.priority_low}
    </select>
  </div>
</div>
<!-- CHECKBOX HIDDEN FOR SIGNATURE TO WORK -->
<input style="visibility:hidden" type="checkbox" name="cksig" onclick="return addsig()"{if $smAddSignature eq 1} checked disabled{/if}>
</form>
</body>
</html>
