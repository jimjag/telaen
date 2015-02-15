<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
<title>{if $webmailTitle}{$webmailTitle} - {/if}{$smCCList|escape:"html"}</title>
<meta http-equiv="Content-Type" content="text/html; charset={$smLabel.default_char_set}">
{$pageMetas}
<link rel="stylesheet" href="inc/themes/outlook/webmail.css" type="text/css">
<script language="JavaScript" src="inc/themes/outlook/webmail.js" type="text/javascript"></script>
{$smJS}
</head>

<body>
<table width='100%' cellspacing="2" cellpadding="0" class='window_inner'>
  <tr>
    <td><table width='100%' cellpadding='0' cellspacing='0'>
        <tr>
          <td class="window_title"><img src='inc/themes/outlook/images/icon_outlook_readmsg.gif'></td>
          <td width='100%' class="window_title">&nbsp;{$smSubject|default:#no_subject_text#|truncate:100:"...":true|escape:"html"}</td>
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

                    {$smReplyForm}
                      <form name="move" action="process.php" method="post">

                    {$smDeleteForm}
                    <td class="toolbar_splitter"><img src='inc/themes/outlook/images/bar_handler.gif'></td>
                    <td class="toolbar_button_off" onmouseover="this.className='toolbar_button_on'" onmouseout="this.className='toolbar_button_off'" onmousedown="this.className='toolbar_button_down'" onmouseup="this.className='toolbar_button_on'" onclick="reply()"><acronym title="{$smLabel.reply_mnu}"><img src="inc/themes/outlook/images/icon_reply.gif"><font class='xx-normal'><br>
                      {#reply_mnu#|truncate:13:"...":true}</font></td>
                    <td class="toolbar_button_off" onmouseover="this.className='toolbar_button_on'" onmouseout="this.className='toolbar_button_off'" onmousedown="this.className='toolbar_button_down'" onmouseup="this.className='toolbar_button_on'" onclick="replyall()"><acronym title="{$smLabel.reply_all_mnu}"><img src="inc/themes/outlook/images/icon_replyall.gif"><font class='xx-normal'><br>
                      {#reply_all_mnu#|truncate:13:"...":true}</font></td>
                    <td class="toolbar_button_off" onmouseover="this.className='toolbar_button_on'" onmouseout="this.className='toolbar_button_off'" onmousedown="this.className='toolbar_button_down'" onmouseup="this.className='toolbar_button_on'" onclick="forward()"><acronym title="{$smLabel.forward_mnu}"><img src="inc/themes/outlook/images/icon_forward.gif"><font class='xx-normal'><br>
                      {#forward_mnu#|truncate:13:"...":true}</font></td>
                    <td class="toolbar_splitter"><img src='inc/themes/outlook/images/bar_splitter.gif'></td>
                    <td class="toolbar_button_off" onmouseover="this.className='toolbar_button_on'" onmouseout="this.className='toolbar_button_off'" onmousedown="this.className='toolbar_button_down'" onmouseup="this.className='toolbar_button_on'" onclick="printit()"><acronym title="{$smLabel.print_mnu}"><img src="inc/themes/outlook/images/icon_print.gif"><font class='xx-normal'><br>
                      {#print_mnu#|truncate:13:"...":true}</font></td>
                    <td class="toolbar_button_off" onmouseover="this.className='toolbar_button_on'" onmouseout="this.className='toolbar_button_off'" onmousedown="this.className='toolbar_button_down'" onmouseup="this.className='toolbar_button_on'" onclick="javascript:deletemsg()"><acronym title="{$smLabel.delete_mnu}"><img src="inc/themes/outlook/images/icon_delete.gif"><font class='xx-normal'><br>
                      {#delete_mnu#|truncate:13:"...":true}</font></td>
                    <td class="toolbar_splitter"><img src='inc/themes/outlook/images/bar_splitter.gif'></td>
                    <td class="toolbar_button_off" onmouseover="this.className='toolbar_button_on'" onmouseout="this.className='toolbar_button_off'" onmousedown="this.className='toolbar_button_down'" onmouseup="this.className='toolbar_button_on'" {if $smHavePrevious eq 1}onclick="javascript:window.location='{$smPreviousLink}'"{/if}><acronym title="{$smLabel.previous_mnu}"><img src="inc/themes/outlook/images/icon_previous.gif"><font class='xx-normal'><br>
                      {#previous_mnu#|truncate:13:"...":true}</font></td>
                    <td class="toolbar_button_off" onmouseover="this.className='toolbar_button_on'" onmouseout="this.className='toolbar_button_off'" onmousedown="this.className='toolbar_button_down'" onmouseup="this.className='toolbar_button_on'" {if $smHaveNext eq 1}onclick="javascript:window.location='{$smNextLink}'"{/if}><acronym title="{$smLabel.next_mnu}"><img src="inc/themes/outlook/images/icon_next.gif"><font class='xx-normal'><br>
                      {#next_mnu#|truncate:13:"...":true}</font></td>
                    <td class="toolbar_splitter"><img src='inc/themes/outlook/images/bar_splitter.gif'></td>
                    <td class="toolbar_button_off" onmouseover="this.className='toolbar_button_on'" onmouseout="this.className='toolbar_button_off'" onmousedown="this.className='toolbar_button_down'" onmouseup="this.className='toolbar_button_on'" onclick="addresses()"><acronym title="{$smLabel.address_mnu}"><img src="inc/themes/outlook/images/icon_addressbook.gif"><font class='xx-normal'><br>
                      {#address_mnu#|truncate:13:"...":true}</font></td>
                    <td class="toolbar_button_off" onmouseover="this.className='toolbar_button_on'" onmouseout="this.className='toolbar_button_off'" onmousedown="this.className='toolbar_button_down'" onmouseup="this.className='toolbar_button_on'" onclick="window.location='{$downloadLink}';"><acronym title="{$smLabel.download_mnu}"><img src="inc/themes/outlook/images/icon_download.gif" alt=""><font class='xx-normal'><br>
                      {#download_mnu#|truncate:13:"...":true}</font></td>
                      </tr>

                  </table></td>
              </tr>
            </table></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td><iframe name="process" id="process" style="display:none;"></iframe>
      <table width="100%" border="0" cellspacing="4" cellpadding="0">
        <tr>
          <td valign=top width='120'><font class='xx-normal'>&nbsp;&nbsp;&nbsp;<b>{$smLabel.from_hea}</b></font></td>
          <td width='*'><font class='xx-normal'>{section name=i loop=$smFromList}<a href="{$smFromList[i].link}" title="{$smFromList[i].title|escape:"html"}">{$smFromList[i].name|default:#no_sender_text#|escape:"html"}</a>&nbsp;<a target="process" href="addressbook.php?name={$smFromList[i].name}&email={$smFromList[i].mail}&page_ref=readmsg&opt=add&id=N&dummy={$smFromList[i].link}" title=""><img src="inc/themes/outlook/images/icon_addtoaddressbook.gif" border=0></a>&nbsp;{/section}</font></td>
        </tr>
        <tr>
          <td valign=top width='120'><font class='xx-normal'>&nbsp;&nbsp;&nbsp;<b>{$smLabel.date_hea}</b></font></td>
          <td width='*'><font class='xx-normal'>{$smDate|date_format:$smLabel.date_format}</font></td>
        </tr>
        <tr>
          <td valign=top width='120'><font class='xx-normal'>&nbsp;&nbsp;&nbsp;<b>{$smLabel.to_hea}</b></font></td>
          <td width='*'><font class='xx-normal'>{section name=i loop=$smTOList}{if $firstto eq "no"};{/if}<a href="{$smTOList[i].link}" title="{$smTOList[i].title|escape:"html"}">{$smTOList[i].name|escape:"html"}</a>&nbsp;<a target="process" href="addressbook.php?name={$smTOList[i].name}&email={$smTOList[i].mail}&page_ref=readmsg&opt=add&id=N&dummy={$smTOList[i].link}" title=""><img src="inc/themes/outlook/images/icon_addtoaddressbook.gif" border=0></a>&nbsp;{assign var="firstto" value="no"}{sectionelse}&nbsp;{$smLabel.no_recipient_text}{/section}</font></td>
        </tr>
        {if $smHaveCC}
        <tr>
          <td valign=top width='120'><font class='xx-normal'>&nbsp;&nbsp;&nbsp;<b>{$smLabel.cc_hea}</b></font></td>
          <td width='*'><font class='xx-normal'>{section name=i loop=$smCCList}{if $firstcc eq "no"};{/if}<a href="{$smCCList[i].link}" title="{$smCCList[i].title|escape:"html"}">{$smCCList[i].name|escape:"html"}</a>&nbsp;<a target="process" href="addressbook.php?name={$smCCList[i].name}&email={$smCCList[i].mail}&page_ref=readmsg&opt=add&id=N&dummy={$smCCList[i].link}" title=""><img src="inc/themes/outlook/images/icon_addtoaddressbook.gif" border=0></a>&nbsp;{assign var="firstcc" value="no"}{/section}</font></td>
        </tr>
        {/if}
        <tr>
          <td valign=top width='120'><font class='xx-normal'>&nbsp;&nbsp;&nbsp;<b>{$smLabel.subject_hea}</b></font></td>
          <td width='*'><font class='xx-normal'>{$smSubject|default:#no_subject_text#|truncate:100:"...":true|escape:"html"}</font></td>
        </tr>
        {if $smHaveAttachments}
        <tr>
          <td width='120'><font class='xx-normal'>&nbsp;&nbsp;&nbsp;<b>{$smLabel.attach_hea}</b></font></td>
          <td class='newmsg_attachments_outer'><table width='100%' height='100%' cellpadding='0' cellspacing='0'>
              <tr>
                <td class='newmsg_attachments_inner' style="padding-left:5;"><font class='xx-normal'> {section name=i loop=$smAttachList} <nobr> {$smAttachList[i].normlink}{$smAttachList[i].name|truncate:30:"...":true|escape:"html"} ({$smAttachList[i].size}Kb)</a> {$smAttachList[i].downlink}<acronym title="{#download_mnu#|truncate:13:"...":true}"><img src="inc/themes/outlook/images/icon_attachdownl.gif" border="0" alt="{#download_mnu#|truncate:13:"...":true}"></acronym></a> </nobr> {if !$smarty.section.i.last} - {/if}

                  {/section} </font></td>
              </tr>
            </table></td>
        </tr>
        {/if}
        <tr>
          <td width='120'><font class='xx-normal'>&nbsp;&nbsp;&nbsp;<b>{$smLabel.move_mnu}</b></font></td>
          <td width='*'><font class='xx-normal'>
            <select name="aval_folders">

					{section name=i loop=$smAvalFolders}

              <option value="{$smAvalFolders[i].path|escape:"html"}">{$smAvalFolders[i].display|escape:"html"}

              {/section}
            </select>
            <a class="menu" href="javascript:movemsg()"><img border=0 src="inc/themes/outlook/images/icon_go.gif"></a></font></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td class='newmsg_attachments_outer'><table width='100%' height='100%' cellpadding='0' cellspacing='0'>
        <tr>
          <td class='newmsg_attachments_inner'> {$smMessageBody} </td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td class='info_bar'>&nbsp;</td>
  </tr>
</table>
</form>
</body>
</html>
