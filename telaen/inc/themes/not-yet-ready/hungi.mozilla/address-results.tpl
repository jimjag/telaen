{include file=$headerTemplate pageTitle=$smLabel.adr_title}

{include file=$menuTemplate refresh="false"}
<table cellspacing="0" cellpadding="0" border="0" align="center" bgcolor="#DDE3EB" width="100%">
  <tr>
    <td valign="top"><table width="100%" border="0" cellspacing="1" cellpadding="0">
        <tr>
          <td class="default" align="center"><br />
            {if $smOpt eq 1}{$smLabel.addr_saved}
            {elseif $smOpt eq 2}{$smLabel.addr_added}
            {elseif $smOpt eq 3}{$smLabel.addr_deleted}
            {/if} <br />
            <table class="buttonTable" cellspacing="0" >
              <tr>
                <td valign="middle" class="buttonLeft">&nbsp;</td>
                <td valign="middle" class="buttonMiddle"><a class="login" href="{$smGoBack}">{$smLabel.adr_back}</a></td>
                <td valign="middle" class="buttonRight">&nbsp;</td>
              </tr>
            </table>
            <br /></td>
        </tr>
      </table></td>
  </tr>
</table>
{include file=$footerTemplate} 