{include file=$headerTemplate pageTitle=$smLabel.adr_title}

{include file=$menuTemplate refresh="false"}
<table width="100%" border="0" cellspacing="0" cellpadding="2" bgcolor="#DDE3EB">
  <tr>
    <td height="15" width="40%" class="headersLeft">.: <b>{$smLabel.adr_name_hea}</b> :.</td>
    <td width="40%" class="headersLeft">.: <b>{$smLabel.adr_email_hea}</b> :.</td>
    <td width="10%" class="headers">.: <b>{$smLabel.adr_edit_hea}</b> :.</td>
    <!--
			<td width="10%" class="headers">{$smLabel.adr_expo_hea}</td>
-->
    <td width="10%" class="headers">.: <b>{$smLabel.adr_dele_hea}</b> :.</td>
  </tr>
  {section name=i loop=$smAddressList}
  <tr>
    <td colspan="4" class="separator"></td>
  </tr>
  <tr>
    <td class="default">&nbsp;<a class="menu" href="{$smAddressList[i].viewlink}">{$smAddressList[i].name}</a></td>
    <td class="default">&nbsp;<a class="menu" href="{$smAddressList[i].composelink}">{$smAddressList[i].email}</a></td>
    <td class="cent">&nbsp;<a class="menu" href="{$smAddressList[i].editlink}">OK</a></td>
    <!--
					<td class="default"> &nbsp;<a class="menu" href="{$smAddressList[i].exportlink}">OK</a></td>
-->
    <td class="cent">&nbsp;<a class="menu" href="{$smAddressList[i].dellink}">OK</a></td>
  </tr>
  {/section}
  <tr>
    <td colspan="4" class="default">&nbsp;&nbsp;<span class="menu"><b>{$smLabel.pages_text}:</b></span> {if $smPreviousLink}<!--<a href="{$smFirstLink}" class="navigation">&laquo; {$smLabel.first_text}</a>&nbsp; -->
      <a href="{$smPreviousLink}" class="navigation">&laquo; {$smLabel.previous_text}</a>&nbsp;{/if}
      {$umNavBar}
      {if $smNextLink}&nbsp;<a href="{$smNextLink}" class="navigation">{$smLabel.next_text} &raquo;</a>
      <!--&nbsp;<a href="{$smLastLink}" class="navigation">{$smLabel.last_text} &raquo;</a>-->{/if} </td>
  </tr>
  <tr>
    <td colspan="4" class="usage"><center>
        <table class="buttonTable" cellspacing="0" align="center">
          <tr>
            <td valign="middle" class="buttonLeft">&nbsp;</td>
            <td valign="middle" class="buttonMiddle"><input class="button" type="button" name="button" onclick="javascript:location = '{$smNew}'" value="{$smLabel.adr_new_entry}" /></td>
            <td valign="middle" class="buttonRight">&nbsp;</td>
          </tr>
        </table>
      </center></td>
  </tr>
</table>
{include file=$footerTemplate} 