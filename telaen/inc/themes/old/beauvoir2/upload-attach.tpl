{config_load file=$umLanguageFile section="Newmessage"}

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
	<title>UebiMiau Webmail - {$smLabel.up_title} - Skin by Beauvoir.net</title>
	<meta http-equiv="Content-Type" content="text/html; charset={$smLabel.default_char_set}">
	<link rel="stylesheet" href="inc/themes/beauvoir2/webmail.css" type="text/css">
	{$smJS}
</head>

<!--
Skinned by Arnaud BEAUVOIR -  - 

Thank you to let the copyright in place on the login page and in all sources of pages.
This skin is the work of an author, thank you to respect it and not to remove the
copyright, or worse, to put your name at the place.
-->

<body>
<br>
<table width="95%" border="0" cellspacing="1" cellpadding="0" align="center" class="normal" bgcolor="#2D3443">
<form enctype="multipart/form-data" action="upload.php?sid={$umSid}&lid={$umLid}&tid={$umTid}" method="POST">
<tr bgcolor="#78879C"><td height="30" align="center"><b>{$smLabel.up_information_text}</b></td></tr>
<tr bgcolor="#BFC6D3"><td align="center"><input type="file" name="userfile" class="textbox" size="22" style="width: 220px; border: 1 solid #7F9DB9" class="button"><br><input type=submit value="{$smLabel.up_button_text}" name="submit" class="button"></td></tr>
</form>
</table>
</body>
</html>
