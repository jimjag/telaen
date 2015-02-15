{config_load file=$umLanguageFile section="Error"}

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
	<title>UebiMiau - {$smLabel.err_title}</title>
	<link rel="stylesheet" href="inc/themes/aleborgXP/webmail.css" type="text/css">
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
</head>

{$smJS}

<body bgcolor="#FFFFFF" text="#000000" link="#000000" vlink="#FFFFFF" alink="#FFFFFF" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0" background="inc/themes/aleborgXP/images/menu_back.gif">
        <tr> 
          <td height="20" class="title"><img src="inc/themes/aleborgXP/images/logo.gif" width="100" height="32"></td>
        </tr>
  <tr>
    <td height="3" background="inc/themes/aleborgXP/images/list_down.gif"><img src="inc/themes/aleborgXP/images/list_down.gif" width="5" height="3"></td>
  </tr>
      </table></td>
  </tr>
</table>
<table width="400" border="0" cellspacing="0" cellpadding="2">
  <tr> 
    <td bgcolor=white> <table width="100%" border="0" cellspacing="1" cellpadding="1" align="center">
        <tr>
          <td align=right class="title"><font color=red size=3><b>{$smLabel.err_title}</b></font></td>
        </tr>
        <tr>
          <td align=right class="cent"><br>
            {$smLabel.err_msg}<br>
            <br> <small>{$smLabel.err_system_msg} {if $umErrorCode eq "1"}{$smLabel.error_connect}
            {elseif $umErrorCode eq "2"}{$smLabel.error_retrieving} {else}{$smLabel.error_other}{/if}
            </small><br>
            <br> <a href="logout.php?sid={$umSid}&tid={$umTid}&lid={$umLid}">{$smLabel.err_exit}</a><br>
            <br> </td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
</html>
