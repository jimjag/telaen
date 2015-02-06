{include file=$headerTemplate pageTitle=$umLabel.adr_title}

{include file=$menuTemplate refresh="false"}
<table cellspacing="0" cellpadding="0" border="0" align="center" bgcolor="#DDE3EB" width="100%">
  <tr>
    <td valign="top"><table width="100%" border="0" cellspacing="1" cellpadding="0">
        <tr>
          <td class="default" align="center"><br />
            {if $umOpt eq 1}{$umLabel.addr_saved}
            {elseif $umOpt eq 2}{$umLabel.addr_added}
            {elseif $umOpt eq 3}{$umLabel.addr_deleted}
            {/if} <br />
            <table class="buttonTable" cellspacing="0" >
              <tr>
                <td valign="middle" class="buttonLeft">&nbsp;</td>
                <td valign="middle" class="buttonMiddle"><a class="login" href="{$umGoBack}">{$umLabel.adr_back}</a></td>
                <td valign="middle" class="buttonRight">&nbsp;</td>
              </tr>
            </table>
            <br /></td>
        </tr>
      </table></td>
  </tr>
</table>
{include file=$footerTemplate} 