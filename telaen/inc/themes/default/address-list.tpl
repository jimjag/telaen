{include file=$headerTemplate pageTitle=$smLabel.adr_title}
<table width="100%" border="0" cellspacing="0" cellpadding="2" align="center" bgcolor="white">
  <tr>
    <td valign="top" width="20%"> {include file=$menuTemplate refresh="false"} {include file=$calendarTemplate} {include file=$newsTemplate} </td>
    <td bgcolor=white valign=top><table width="100%" border="0" cellspacing="1" cellpadding="0">
        <tr>
          <td width="40%" class="headers"> {$smLabel.adr_name_hea} </td>
          <td width="40%" class="headers"> {$smLabel.adr_email_hea} </td>
          <td width="10%" class="headers"> {$smLabel.adr_edit_hea} </td>
          <!---
										 <td width="10%" class="headers">{$smLabel.adr_expo_hea}</td>
--->
          <td width="10%" class="headers"> {$smLabel.adr_dele_hea} </td>
        </tr>
        {section name=i loop=$smAddressList}
        <tr>
          <td class="default">&nbsp;<a class="menu" href="{$smAddressList[i].viewlink}">{$smAddressList[i].name}</a></td>
          <td class="default">&nbsp;<a class="menu" href="{$smAddressList[i].composelink}">{$smAddressList[i].email}</a></td>
          <td class="default">&nbsp;<a class="menu" href="{$smAddressList[i].editlink}">OK</a></td>
          <!---
										<td class="default"> &nbsp;<a class="menu" href="{$smAddressList[i].exportlink}">OK</a></td>
--->
          <td class="default">&nbsp;<a class="menu" href="{$smAddressList[i].dellink}">OK</a></td>
        </tr>
        {/section}
        <tr>
          <td colspan="3" align="center" class="default">&nbsp;{$smLabel.pages_text}:&nbsp;{if $smPreviousLink}<a href="{$smPreviousLink}" class="navigation">{$smLabel.previous_text}</a> &nbsp;{/if}{$umNavBar}{if $smNextLink} &nbsp;<a href="{$smNextLink}" class="navigation">{$smLabel.next_text}</a>{/if}</td>
        </tr>
        <tr>
          <td colspan="3" align="center"><br>
            <form>
              <input type="button" value="{$smLabel.adr_new_entry}" class="button" onclick="location = '{$smNew}'">
            </form></td>
        </tr>
      </table></td>
  </tr>
</table>
{include file=$footerTemplate} 