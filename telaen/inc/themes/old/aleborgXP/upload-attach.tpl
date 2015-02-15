{config_load file=$umLanguageFile section="Newmessage"}

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
	<title>UebiMiau - {$smLabel.up_title}</title>
	<link rel="stylesheet" href="inc/themes/aleborgXP/webmail.css" type="text/css">
</head>

<body bgcolor="#FFFFFF" text="#FFFFFF" link="#FFFFFF" vlink="#FFFFFF" alink="#FFFFFF" leftmargin=0 topmargin=0 marginwidth=0 marginheight=0>
<table width="100%" border="0" cellspacing="0" cellpadding="0" background="inc/themes/aleborgXP/images/menu_back.gif">
  <tr>
    <td height="16">&nbsp;<b>{$smLabel.up_information_text}</b></td>
  </tr>
  <tr>
    <td height="3" background="inc/themes/aleborgXP/images/list_down.gif"><img src="inc/themes/aleborgXP/images/list_down.gif" width="5" height="3"></td>
  </tr>
</table>
<br>
<table width="250" border="0" cellspacing="0" cellpadding="0" align="center">
  <form enctype="multipart/form-data" action="upload.php?sid={$umSid}" method="POST">
    <tr>
      <td><input type="file" name="userfile" class="textbox" size="22" style="width: 250px;"></td>
    </tr>
    <tr>
      <td height="5"></td>
    </tr>
    <tr>
      <td class=default align=right><input type="submit" value="{$smLabel.up_button_text}" name="submit"></td>
    </tr>
  </form>
</table>
</body>
</html>
