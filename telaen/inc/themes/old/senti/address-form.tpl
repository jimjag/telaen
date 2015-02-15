{config_load file=$umLanguageFile section="AddressBook"}
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
	<title>sentiMail - {$smLabel.adr_title}</title>
<meta http-equiv="Content-Type" content="text/html; charset={$smLabel.default_char_set}">
<link rel="stylesheet" href="inc/themes/senti/webmail.css" type="text/css">
{$smJS}
</head>

<body><br><br>
<table width="760" height="400" border="0" cellpadding="0" cellspacing="0" align="center">
	<tr valign="bottom">
		<td height="61">
			<img src="inc/themes/senti/images/mail_01.gif" width="18" height="61" alt=""></td>
		<td>
			<a class="menu" href="javascript:goinbox()"><img src="inc/themes/senti/images/inbox.gif" width="60" height="61" border="0" alt=""></a></td>
		<td>
			<img src="inc/themes/senti/images/mail_03.gif" width="33" height="61" alt=""></td>
		<td>
			<a class="menu" href="javascript:newmsg()"><img src="inc/themes/senti/images/write.gif" width="85" height="61" border="0" alt=""></a></td>
		<td>
			<img src="inc/themes/senti/images/mail_05.gif" width="32" height="61" alt=""></td>
		<td>
			<a class="menu" href="javascript:folderlist()"><img src="inc/themes/senti/images/folders.gif" width="72" height="61" border="0" alt=""></a></td>
		<td>
			<img src="inc/themes/senti/images/mail_07.gif" width="36" height="61" alt=""></td>
		<td>
			<a class="menu" href="javascript:search()"><img src="inc/themes/senti/images/search.gif" width="74" height="61" alt="" border="0"></a></td>
		<td>
			<img src="inc/themes/senti/images/mail_09.gif" width="27" height="61" alt=""></td>
		<td>
			<a class="menu" href="javascript:addresses()"><img src="inc/themes/senti/images/addresses_selected.gif" width="89" height="61" border="0" alt=""></a></td>
		<td>
			<img src="inc/themes/senti/images/mail_11.gif" width="28" height="61" alt=""></td>
		<td>
			<a class="menu" href="javascript:prefs()"><img src="inc/themes/senti/images/preferences.gif" width="88" height="61" border="0" alt=""></a></td>
		<td>
			<img src="inc/themes/senti/images/mail_13.gif" width="31" height="61" alt=""></td>
		<td>
			<a class="menu" href="javascript:goend()"><img src="inc/themes/senti/images/logout.gif" width="70" height="61" border="0" alt=""></a></td>
		<td>
			<img src="inc/themes/senti/images/mail_15.gif" width="17" height="61" alt=""></td>
	</tr>
	<tr>
<td width="18"><img src="inc/themes/senti/images/leftside.gif" width="18" height="100%"></td>
<td colspan="13">
						<table height="100%" width="100%" border="0" cellspacing="1" cellpadding="0" align="left">
                        <form name=form1 method=post action=addressbook.php>
                                                <input type=hidden name=sid value="{$umSid}">
                                                <input type=hidden name=id value="{$smAddrID}">
                                                <input type=hidden name=lid value="{$umLid}">
                                                <input type=hidden name=tid value="{$umTid}">
                                                <input type=hidden name=opt value="{$smOpt}">
							<tr><td class="default">{$smLabel.adr_name} &nbsp;<input align="left" size="40" type=text name="name" value="{$smAddrName|escape:"html"}" class="textbox"></td></tr>
							<tr><td class="default">{$smLabel.adr_email} &nbsp;<input size="40" type=text name="email" value="{$smAddrEmail|escape:"html"}" class="textbox"></td></tr>
							<tr><td class="default">{$smLabel.adr_street} &nbsp;<input size="40" type=text name="street" value="{$smAddrStreet|escape:"html"}" class="textbox"></td></tr>
							<tr><td class="default">{$smLabel.adr_city} &nbsp;<input size="40" type=text name="city" value="{$smAddrCity|escape:"html"}" class="textbox"></td></tr>
							<tr><td class="default">{$smLabel.adr_state} &nbsp;<input size="3" type=text name="state" value="{$smAddrState|escape:"html"}" class="textbox" maxlength=2></td></tr>
							<tr><td class="default">{$smLabel.adr_work} &nbsp;<input size="40" type=text name="work" value="{$smAddrWork|escape:"html"}" class="textbox"></td></tr>
							<tr><td height="18" class="default" align="center"><input type=submit value="{$smLabel.adr_save}" class=button> &nbsp;<input type=button value="{$smLabel.adr_back}" class=button onClick="location = '{$smGoBack}'"></td></tr>
</form>
						</table>
		</td><td width="17"><img src="inc/themes/senti/images/rightside.gif" width="17" height="100%"></td>
	</tr>
	<tr>
		<td colspan="15" valign="top" height="25">
			<img src="inc/themes/senti/images/footer.gif" width="760" height="25" alt=""></td>
	</tr>
</table>
</body>
</html>
