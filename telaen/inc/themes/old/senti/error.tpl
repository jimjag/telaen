{config_load file=$umLanguageFile section="Error"}

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
	<title>sentiMail - {$smLabel.err_title}</title>
	<meta http-equiv="Content-Type" content="text/html; charset={$smLabel.default_char_set}">
	<link rel="stylesheet" href="inc/themes/senti/webmail.css" type="text/css">
	{$smJS}
</head>
	<body><!-- Form name used to be "form1" this has been changed for w3c compliancy-->
	<form action="process.php" method="post">		
				<table border="0" align="center" cellpadding="0" cellspacing="0">
						<tr>
							<td colspan="3" align="center"><img src="inc/themes/senti/images/globe.jpg" alt=""></td>
						</tr>
						<tr>
							<td class="topEdge" align="left"><img src="inc/themes/senti/images/rounded-top-left.gif" alt=""></td>
							<td class="topEdge"></td>
							<td class="topEdge" align="right"><img src="inc/themes/senti/images/rounded-senti-top.gif" alt=""></td>
						</tr>
						<tr>		
							<td colspan="3" class="mainLoginTable">
								<table width="100%" border="0" cellspacing="1" cellpadding="1" align="center">
									<tr><td align=right class="title">.: <font color=red size=3><b>{$smLabel.err_title}</b></font> :.</td>
										<tr><td align=right class="cent"><br>
										{$smLabel.err_msg}<br><br>
										<small>{$smLabel.err_system_msg}
										{if $umErrorCode eq "1"}{$smLabel.error_connect}
										{elseif $umErrorCode eq "2"}{$smLabel.error_retrieving}
										{else}{$smLabel.error_other}{/if}

										</small><br><br>
										<a href="logout.php?sid={$umSid}&tid={$umTid}&lid={$umLid}">{$smLabel.err_exit}</a><br><br>
										</td>
									</table>
															</td>
						</tr>
						<tr>
							<td width="60" class="bottomEdge" align="left"><img src="inc/themes/senti/images/rounded-bottom-left.gif" alt=""></td>
							<td width="250" class="bottomEdge"></td>
							<td width="60" class="bottomEdge" align="right"><img src="inc/themes/senti/images/rounded-bottom-right.gif" alt=""></td>
						</tr>
						<tr>
							<td colspan="3" class="footer" align="center"><a href="http://validator.w3.org/check?uri=referer"><img src="inc/themes/senti/images/w3c2.gif" alt="" border="0"></a></td>
						</tr>
				</table>	
			</form>	
	</body>

</html>
