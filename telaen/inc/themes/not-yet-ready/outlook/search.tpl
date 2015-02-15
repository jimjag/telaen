<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<title>{if $webmailTitle}{$webmailTitle} - {/if}{$smLabel.search_mnu}</title>
<meta http-equiv="Content-Type" content="text/html; charset={$smLabel.default_char_set}">
{$pageMetas}
<link rel="stylesheet" href="inc/themes/outlook/webmail.css" type="text/css">
<script language="JavaScript" src="inc/themes/outlook/webmail.js" type="text/javascript"></script>
{$smJS}
</head>

<body>
<table width='100%' cellspacing=2 cellpadding=0 class='window_inner'>
    <tr>

    <td>

  <table width='100%' cellpadding='0' cellspacing='0'>
    <tr>
      <td class="window_title"><img src='inc/themes/outlook/images/icon_outlook.gif'></td>
      <td width='100%' class="window_title">&nbsp;{$smLabel.search_mnu}</td>
      <td class='window_title_X'><a href='javascript:goinbox()'><img border='0' src='inc/themes/outlook/images/X.png'></a></td>
    </tr>
  </table>
  <table width='100%' cellpadding='3' cellspacing='0'>
    <tr>
      <td valign='top'><hr>
        <font class='xx-normal'>{$smLabel.sch_information_text}</font>
        <hr></td>
    </tr>
  </table>
  <table width='100%' cellpadding='3' cellspacing='0'>
    <tr>
        <td valign='top'>
      <form name="form1" action="search.php" method="POST">
        <input type=hidden name=tid value="{$umTid}">
        <input type=hidden name=lid value="{$umLid}">
        <input type=hidden name=sid value="{$umSid}">
        <table width='100%' cellpadding='3' cellspacing='0'>
          <tr>
            <td width="150"><font class='xx-normal'>&nbsp;{$smLabel.sch_from_hea}:&nbsp;</td>
              </font>
            <td width=100%><input class=textbox type=text name=srcFrom value="{$smInputFrom|escape:"html"}" size="40" maxlength="40"></td>
          </tr>
          <tr>
            <td><font class='xx-normal'>&nbsp;{$smLabel.sch_subject_hea}:&nbsp;</td>
              </font>
            <td><input class=textbox type=text name=srcSubject value="{$smInputSubject|escape:"html"}" size="40" maxlength="40"></td>
          </tr>
          <tr>
            <td><font class='xx-normal'>&nbsp;{$smLabel.sch_body_hea}:&nbsp;</font></td>
            <td><input class=textbox type=text name=srcBody value="{$smInputBody|escape:"html"}" size="40" maxlength="40"></td>
          </tr>
        </table>
          </td>
        <td width='100%' valign='top'><input type=submit value="{$smLabel.sch_button_text}" class=button>
      </form>
      </td>

      </tr>

  </table>
  <br>
    </td>

    </tr>

  {if $smDoSearch}
  <tr>
    <td valign='top' class="messages"><!-- RESULTADOS -->

      <table width='100%' cellpadding='0' cellspacing='0'>
        <tr>
          <td width="10" align="center" class="headers"><img src="inc/themes/outlook/images/icon_high_priority.gif" alt="">
          <td width="10" align="center" class="headers"><img src="inc/themes/outlook/images/icon_attachment_clip.gif" alt=""></td>
          <td class="headers" colspan=2>{$smLabel.sch_from_hea}</td>
          <td class="headers">{$smLabel.sch_subject_hea}</td>
          <td width="100" class="headers">{$smLabel.sch_date_hea}</td>
          <td class="headers">{$smLabel.sch_folder_hea}</td>
        </tr>
        {counter start=0 skip=1 print=false}
        {section name=i loop=$smMessageList}
        {counter print=false assign=contador}
        <tr>
          <td width="10" align="center" class="messagelist">{$smMessageList[i].priorimg}</td>
          <td width="10" align="center" class="messagelist">{$smMessageList[i].attachimg}</td>
          <td width="10" align="center" class="messagelist"><nobr>{$smMessageList[i].statusimg}</nobr></td>
          <td onclick="{$smMessageList[i].readlink}" id="msg_{$contador}" onmouseover="msg_{$contador}.className='messagelist_over';sub_{$contador}.className='messagelist_over';dat_{$contador}.className='messagelist_over';fol_{$contador}.className='messagelist_over';" onmouseout="msg_{$contador}.className='messagelist';sub_{$contador}.className='messagelist';dat_{$contador}.className='messagelist';fol_{$contador}.className='messagelist';" class="messagelist"><a href="{$smMessageList[i].readlink}">{if $smMessageList[i].read eq "false"}<b>{/if}{$smMessageList[i].from|truncate:30:"...":true|escape:"html"|default:$smLabel.no_subject_text}{if $smMessageList[i].read eq "false"}</b>{/if}</a></td>
          <td onclick="{$smMessageList[i].readlink}" id="sub_{$contador}" onmouseover="msg_{$contador}.className='messagelist_over';sub_{$contador}.className='messagelist_over';dat_{$contador}.className='messagelist_over';fol_{$contador}.className='messagelist_over';" onmouseout="msg_{$contador}.className='messagelist';sub_{$contador}.className='messagelist';dat_{$contador}.className='messagelist';fol_{$contador}.className='messagelist';" class="messagelist"><a href="{$smMessageList[i].readlink}">{if $smMessageList[i].read eq "false"}<b>{/if}{$smMessageList[i].subject|truncate:30:"...":true|escape:"html"|default:$smLabel.no_subject_text}{if $smMessageList[i].read eq "false"}</b>{/if}</a></acronym></td>
          <td onclick="{$smMessageList[i].readlink}" id="dat_{$contador}" onmouseover="msg_{$contador}.className='messagelist_over';sub_{$contador}.className='messagelist_over';dat_{$contador}.className='messagelist_over';fol_{$contador}.className='messagelist_over';" onmouseout="msg_{$contador}.className='messagelist';sub_{$contador}.className='messagelist';dat_{$contador}.className='messagelist';fol_{$contador}.className='messagelist';" class="messagelist">{if $smMessageList[i].read eq "false"}<b>{/if}{$smMessageList[i].date|date_format:$smLabel.date_format}{if $smMessageList[i].read eq "false"}</b>{/if}</td>
          <td id="fol_{$contador}" onmouseover="msg_{$contador}.className='messagelist_over';sub_{$contador}.className='messagelist_over';dat_{$contador}.className='messagelist_over';fol_{$contador}.className='messagelist_over';" onmouseout="msg_{$contador}.className='messagelist';sub_{$contador}.className='messagelist';dat_{$contador}.className='messagelist';fol_{$contador}.className='messagelist';" class="messagelist"><a href="{$smMessageList[i].folderlink}">{if $smMessageList[i].read eq "false"}<b>{/if}{$smMessageList[i].foldername|escape:"html"}{if $smMessageList[i].read eq "false"}</b>{/if}</td>
        </tr>
        {sectionelse}
        <tr>
          <td class="messagelist" colspan=7 align='center'><br>
            <br>
            {$smLabel.sch_no_results}<br>
            <br>
            <br>
            <br></td>
        </tr>
        {/section}
      </table>

      <!-- FIN RESULTADOS --></td>
  </tr>
  <tr>
    <td class='info_bar'>&nbsp;</td>
  </tr>
  {/if}
</table>
</body>
</html>
