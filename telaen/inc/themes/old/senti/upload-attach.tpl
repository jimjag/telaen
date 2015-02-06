{config_load file=$umLanguageFile section="Newmessage"}

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
	<title>UebiMiau - {$umLabel.up_title}</title>
	<link rel="stylesheet" href="inc/themes/default/webmail.css" type="text/css">
	<meta http-equiv="Content-Type" content="text/html; charset={$umLabel.default_char_set}">
</head>

<body bgcolor="#DDDCDC" text="#000000" link="#FFFFFF" vlink="#FFFFFF" alink="#FFFFFF" leftmargin=0 topmargin=0 marginwidth=0 marginheight=0>
<br>
<table width="250" border="0" cellspacing="0" cellpadding="5" align="center">
<form enctype="multipart/form-data" action="upload.php?sid={$umSid}&lid={$umLid}&tid={$umTid}" method=POST>
<tr><td class="headers"><b>{$umLabel.up_information_text}</b></td></tr>
<tr><td class="light"><input type=file name=userfile class=textbox size=22 style="width: 250px;"></td></tr>
<tr><td class="light" align=right><input type=submit value="{$umLabel.up_button_text}" name=submit class=button></td></tr>
</form>
</table>
</body>
</html>
