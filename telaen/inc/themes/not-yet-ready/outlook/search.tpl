<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<title>{if $webmailTitle}{$webmailTitle} - {/if}{$umLabel.search_mnu}</title>
<meta http-equiv="Content-Type" content="text/html; charset={$umLabel.default_char_set}">
{$pageMetas}
<link rel="stylesheet" href="inc/themes/outlook/webmail.css" type="text/css">
<script language="JavaScript" src="inc/themes/outlook/webmail.js" type="text/javascript"></script>
{$umJS}
</head>

<body>
<table width='100%' cellspacing=2 cellpadding=0 class='window_inner'>
    <tr>

    <td>

  <table width='100%' cellpadding='0' cellspacing='0'>
    <tr>
      <td class="window_title"><img src='inc/themes/outlook/images/icon_outlook.gif'></td>
      <td width='100%' class="window_title">&nbsp;{$umLabel.search_mnu}</td>
      <td class='window_title_X'><a href='javascript:goinbox()'><img border='0' src='inc/themes/outlook/images/X.png'></a></td>
    </tr>
  </table>
  <table width='100%' cellpadding='3' cellspacing='0'>
    <tr>
      <td valign='top'><hr>
        <font class='xx-normal'>{$umLabel.sch_information_text}</font>
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
            <td width="150"><font class='xx-normal'>&nbsp;{$umLabel.sch_from_hea}:&nbsp;</td>
              </font>
            <td width=100%><input class=textbox type=text name=srcFrom value="{$umInputFrom|escape:"html"}" size="40" maxlength="40"></td>
          </tr>
          <tr>
            <td><font class='xx-normal'>&nbsp;{$umLabel.sch_subject_hea}:&nbsp;</td>
              </font>
            <td><input class=textbox type=text name=srcSubject value="{$umInputSubject|escape:"html"}" size="40" maxlength="40"></td>
          </tr>
          <tr>
            <td><font class='xx-normal'>&nbsp;{$umLabel.sch_body_hea}:&nbsp;</font></td>
            <td><input class=textbox type=text name=srcBody value="{$umInputBody|escape:"html"}" size="40" maxlength="40"></td>
          </tr>
        </table>
          </td>
        <td width='100%' valign='top'><input type=submit value="{$umLabel.sch_button_text}" class=button>
      </form>
      </td>

      </tr>

  </table>
  <br>
    </td>

    </tr>

  {if $umDoSearch}
  <tr>
    <td valign='top' class="messages"><!-- RESULTADOS -->

      <table width='100%' cellpadding='0' cellspacing='0'>
        <tr>
          <td width="10" align="center" class="headers"><img src="inc/themes/outlook/images/icon_high_priority.gif" alt="">
          <td width="10" align="center" class="headers"><img src="inc/themes/outlook/images/icon_attachment_clip.gif" alt=""></td>
          <td class="headers" colspan=2>{$umLabel.sch_from_hea}</td>
          <td class="headers">{$umLabel.sch_subject_hea}</td>
          <td width="100" class="headers">{$umLabel.sch_date_hea}</td>
          <td class="headers">{$umLabel.sch_folder_hea}</td>
        </tr>
        {counter start=0 skip=1 print=false}
        {section name=i loop=$umMessageList}
        {counter print=false assign=contador}
        <tr>
          <td width="10" align="center" class="messagelist">{$umMessageList[i].priorimg}</td>
          <td width="10" align="center" class="messagelist">{$umMessageList[i].attachimg}</td>
          <td width="10" align="center" class="messagelist"><nobr>{$umMessageList[i].statusimg}</nobr></td>
          <td onclick="{$umMessageList[i].readlink}" id="msg_{$contador}" onmouseover="msg_{$contador}.className='messagelist_over';sub_{$contador}.className='messagelist_over';dat_{$contador}.className='messagelist_over';fol_{$contador}.className='messagelist_over';" onmouseout="msg_{$contador}.className='messagelist';sub_{$contador}.className='messagelist';dat_{$contador}.className='messagelist';fol_{$contador}.className='messagelist';" class="messagelist"><a href="{$umMessageList[i].readlink}">{if $umMessageList[i].read eq "false"}<b>{/if}{$umMessageList[i].from|truncate:30:"...":true|escape:"html"|default:$umLabel.no_subject_text}{if $umMessageList[i].read eq "false"}</b>{/if}</a></td>
          <td onclick="{$umMessageList[i].readlink}" id="sub_{$contador}" onmouseover="msg_{$contador}.className='messagelist_over';sub_{$contador}.className='messagelist_over';dat_{$contador}.className='messagelist_over';fol_{$contador}.className='messagelist_over';" onmouseout="msg_{$contador}.className='messagelist';sub_{$contador}.className='messagelist';dat_{$contador}.className='messagelist';fol_{$contador}.className='messagelist';" class="messagelist"><a href="{$umMessageList[i].readlink}">{if $umMessageList[i].read eq "false"}<b>{/if}{$umMessageList[i].subject|truncate:30:"...":true|escape:"html"|default:$umLabel.no_subject_text}{if $umMessageList[i].read eq "false"}</b>{/if}</a></acronym></td>
          <td onclick="{$umMessageList[i].readlink}" id="dat_{$contador}" onmouseover="msg_{$contador}.className='messagelist_over';sub_{$contador}.className='messagelist_over';dat_{$contador}.className='messagelist_over';fol_{$contador}.className='messagelist_over';" onmouseout="msg_{$contador}.className='messagelist';sub_{$contador}.className='messagelist';dat_{$contador}.className='messagelist';fol_{$contador}.className='messagelist';" class="messagelist">{if $umMessageList[i].read eq "false"}<b>{/if}{$umMessageList[i].date|date_format:$umLabel.date_format}{if $umMessageList[i].read eq "false"}</b>{/if}</td>
          <td id="fol_{$contador}" onmouseover="msg_{$contador}.className='messagelist_over';sub_{$contador}.className='messagelist_over';dat_{$contador}.className='messagelist_over';fol_{$contador}.className='messagelist_over';" onmouseout="msg_{$contador}.className='messagelist';sub_{$contador}.className='messagelist';dat_{$contador}.className='messagelist';fol_{$contador}.className='messagelist';" class="messagelist"><a href="{$umMessageList[i].folderlink}">{if $umMessageList[i].read eq "false"}<b>{/if}{$umMessageList[i].foldername|escape:"html"}{if $umMessageList[i].read eq "false"}</b>{/if}</td>
        </tr>
        {sectionelse}
        <tr>
          <td class="messagelist" colspan=7 align='center'><br>
            <br>
            {$umLabel.sch_no_results}<br>
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
