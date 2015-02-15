<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<title>{if $webmailTitle}{$webmailTitle} - {/if}{$smLabel.compose_mnu}</title>
<meta http-equiv="Content-Type" content="text/html; charset={$smLabel.default_char_set}">
<link rel="stylesheet" href="inc/themes/outlook/webmail.css" type="text/css">
{$pageMetas}
<script src="inc/themes/outlook/webmail.js" type="text/javascript"></script>
{$smJS}
</head>
<body>
<table width=100% height=100%>
  <tr>
    <td align=center valign=center><table class='window_outer' width='300' cellspacing="0" cellpadding="0">
        <tr>
          <td><table class='window_inner' width="100%" cellspacing="0" cellpadding="2">
              {if $umMailSent}
              <tr>
                <td class='window_title' colspan=2>&nbsp;{$smLabel.compose_mnu}</td>
              </tr>
              <tr>
                <td><table width="100%" cellspacing="0" cellpadding="10" align="center">
                    <tr>
                      <td valign='top' width="50" align="center"><img src="inc/themes/outlook/images/msg_info.gif"></td>
                      <td valign='top'><font class=xx-normal> {$smLabel.result_success} </font></td>
                    </tr>
                      <tr>
                      <td align=center colspan=2>

                      <form name="form1" action="process.php?sid={$umSid}&tid={$umTid}&lid={$umLid}" method=post>

                    <input class=button type=submit value="&nbsp;&nbsp;&nbsp;{$smLabel.nav_continue}&nbsp;&nbsp;&nbsp;">
                    {else}

                      <tr>
                        <td class='window_title' colspan=2>&nbsp;{$smLabel.result_error}</td>
                      </tr>

                      <tr>
                        <td><table width="100%" cellspacing="0" cellpadding="10" align="center">
                          <tr>
                            <td valign='top' width="50" align="center"><img src="inc/themes/outlook/images/msg_error.gif"></td>
                            <td valign='top'><font class=xx-normal> {$umErrorMessage} </font></td>
                          </tr>
                          <tr>
                            <td align=center colspan=2>
                      <form name="form1" action="javascript:history.go(-1)" method=post>

                    <input class=button type=submit value="&nbsp;&nbsp;&nbsp;{$smLabel.nav_back}&nbsp;&nbsp;&nbsp;">
                    {/if}
                      </td>
                      </tr>

                  </table></td>
              </tr>
            </table></td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
</html>
