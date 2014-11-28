{config_load file=$umLanguageFile section="Login"}

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
	<title>UebiMiau Webmail - {#lgn_title#|escape:"html"} - Skin by Beauvoir.net</title>
	<meta http-equiv="Content-Type" content="text/html; charset={$umLabel.default_char_set}">
	<link rel="stylesheet" href="inc/themes/beauvoir2/webmail.css" type="text/css">
</head>

<!--
Skinned by Arnaud BEAUVOIR -  - 

Thank you to let the copyright in place on the login page and in all sources of pages.
This skin is the work of an author, thank you to respect it and not to remove the
copyright, or worse, to put your name at the place.
-->

{$umJS}
<body>
<table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0" align="center">
<tr><td valign="middle" align="center">
<table width="750" border="0" cellspacing="0" cellpadding="0" class="normal" align="center">
	<tr><td><img src="inc/themes/beauvoir2/images/bandeau-h.gif" border="0"></td></tr>
	<tr><td><img src="inc/themes/beauvoir2/images/logo.gif" border="0" alt="Powered by Beauvoir"></td></tr>
	<tr><td><img src="inc/themes/beauvoir2/images/bandeau-h.gif" border="0"></td></tr>
	<tr>
		<td background="inc/themes/beauvoir2/images/ligne-fond.gif">
			<table width="350" border="0" cellspacing="1" cellpadding="1" align="center">
			<form name="form1" action="process.php" method=post>
				<tr><td align="center" colspan="2"><br>.: <b>{$umLabel.lgn_welcome_msg}</b> :.<br></td></tr>
				<tr><td>&nbsp;</td></tr>
				{if $umServerType neq "ONE-FOR-EACH"}
				<tr><td align="left" width="40%"><b>{$umLabel.lng_user_email}</b> :</td>
				<td><input type="text" name="f_email" value="{$umEmail}" class="normal" style="width: 140px; border: 1 solid #7F9DB9;"></td></tr>
				{else}
				<tr><td align="left" width="40%"><b>{$umLabel.lng_user_name}</b> :</td>
				<td><input type="text" name="f_user" value="{$umUser}" class="normal" style="width: 80px; border: 1 solid #7F9DB9">{if $umAvailableServers neq 0} <b>{$umServer}</b>{/if}</td></tr>
				{/if}
				<tr><td align="left" width="40%"><b>{$umLabel.lng_user_pwd}</b> :</td>
				<td><input type="password" name="f_pass" class="normal" style="width: 80px; border: 1 solid #7F9DB9"></td></tr>
				{if $umAllowSelectLanguage}
				<tr><td align="left" width="40%"><b>{$umLabel.lng_language}</b> :</td>
				<td>{$umLanguages}</td></tr>
				{/if}
				{if $umAllowSelectTheme}
				<tr><td align="left"><b>{$umLabel.lng_theme}</b> :</td>
				<td>{$umThemes}</td></tr>
				{/if}
				<tr><td>&nbsp;</td></tr>
				<tr><td class="left"></td>
				<td><input type="submit" name="submit" value="{$umLabel.lng_login_btn}" class="button"></td></tr>
				<tr><td>&nbsp;</td></tr>
			</form>
			</table>
		</td>
	</tr>
	<tr>
		<td><map name="Uebimiau">
			<area shape="rect" coords="318,5,371,18" href="" target="_blank">
			<area shape="rect" coords="442,5,552,16" href="" target="_blank">
			</map>
			<img src="inc/themes/beauvoir2/images/bandeau-b.gif" border="0" width="750" height="25" alt="Webmail powered by Uebimiau - Skinned by Forum.Beauvoir" usemap="#Uebimiau">
		</td>
	<tr>
</table>
</td></tr>
</table>
</body>
</html>
